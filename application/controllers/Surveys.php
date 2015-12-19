<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 17:34
 */
class Surveys extends CrudController
{
    public $table = 'survey';
    public $title = 'Surveys';

    public $view = array(
        'index'    => 'simple_list',
        'create'   => 'simple_form',
        'edit'     => 'simple_form',
        'response' => 'simple_list',
    );

    public function __construct()
    {
        parent::__construct();
        $this->fields = array(
            'id'           => array('column' => 'ID'),
            'title'        => array('label' => 'Title', 'type' => 'text', 'column' => 'Title'),
            'is_published' => array('label' => 'Published?', 'type' => 'checkbox', 'column' => 'Published?'),
            'response'     => array('column' => 'View Response'),
        );
    }

    public function index()
    {
        $url = site_url(uri_string() . '/response') . '/';
        $this->db->select(array(
            '*',
            "concat('<a href=\"$url',id,'\"><button>View</button></a><a href=\"$url',id,'/csv\"><button>Download CSV</button></a>') as response",
        ));
        parent::index();
    }

    public function response($id, $csv = FALSE)
    {
        $r = $this->db->select('title')->get_where('survey', array('id' => $id));
        $r = $r->row_array();
        $title = reset($r);

        $fields = array(
            '__time'   => array('column' => 'Time'),
            '__member' => array('column' => 'Created by'),
        );

        $r = $this->db->order_by('order')->get_where('survey_field', array('survey_id' => $id));
        foreach ($r->result_array() as $row) {
            $fields[$row['id']] = array(
                'label'  => $row['description'],
                'type'   => $row['type'],
                'attr'   => empty($row['is_required']) ? array() : array('required' => ''),
                'column' => $row['id'],
            );
            if (!empty($row['options'])) {
                $options = explode(PHP_EOL, $row['options']);
                $fields[$row['id']]['values'] = array_combine($options, $options);
            }
        }

        $data = array(
            'title'  => 'Response for ' . $title,
            'menu'   => $this->load->view('menu', NULL, TRUE),
            'fields' => $fields,
        );

        $this->table = 'survey_response';
        $r = $this->db->order_by('time')->get_where($this->table, array('survey_id' => $id));
        $data['data'] = array();
        foreach ($r->result_array() as $r) {
            $v = array(
                '__time'   => $r['time'],
                '__member' => $csv ? $r['writer_id'] : '<a title="Click to view member" href="' . site_url('members/edit/' . $r['writer_id']) . '">' . $r['writer_id'] . '</a>',
            );
            foreach (json_decode($r['response_json'], TRUE) as $kk => $vv)
                $v[$kk] = $vv;
            $data['data'][] = $v;
        }

        if ($csv) {
            header('content-type: text/csv');
            header('content-disposition: attachment; filename=' . $title . '.csv');

            $out = fopen("php://output", 'w');
            $keys = array_keys($fields);
            fputcsv($out, $keys);
            foreach ($data['data'] as $row) {
                $temp = array();
                foreach ($keys as $k)
                    $temp[] = $row[$k];
                fputcsv($out, $temp);
            }
            fclose($out);

            return;
        }

        $this->load->view($this->view[__FUNCTION__], $data);
    }
}