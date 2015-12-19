<?php
require_once dirname(__FILE__) . '/CrudController.php';

/**
 * comp3421
 * Created by LKHO.
 * Date: 20/12/2015 0:56
 */
class DoSurvey extends CrudController
{
    public $table = 'survey_response';
    public $title = 'Do Survey';

    public $view = array(
        'index'  => 'simple_list',
        'create' => 'simple_form',
        'edit'   => FALSE,
        'delete' => FALSE,
    );

    public function __construct()
    {
        parent::__construct();
        $this->fields = array(
            'id'    => array('column' => 'ID'),
            'title' => array('label' => 'Title', 'type' => 'text', 'column' => 'Title'),
        );
    }

    public function index()
    {
        $this->table = 'survey';
        $data = array(
            'title'      => $this->title,
            'menu'       => $this->load->view('menu', NULL, TRUE),
            'detail_url' => site_url(uri_string() . '/{id}'),
            'fields'     => $this->processDynamicSource($this->fields, array(__FUNCTION__)),
        );

        $r = $this->db->get_where($this->table, array('is_published' => TRUE));
        $data['data'] = $r->result_array();
        $this->load->view($this->view[__FUNCTION__], $data);
    }

    public function create($survey_id = 0)
    {
        check_access(TRUE);

        $r = $this->db->select('title')->get_where('survey', array('id' => $survey_id));
        $r = $r->row_array();
        $title = reset($r);

        $fields = array();

        $r = $this->db->order_by('order')->get_where('survey_field', array('survey_id' => $survey_id));
        foreach ($r->result_array() as $row) {
            $fields[$row['id']] = array(
                'label' => $row['description'],
                'type'  => $row['type'],
                'attr'  => empty($row['is_required']) ? array() : array('required' => ''),
            );
            if (!empty($row['options'])) {
                $options = explode(PHP_EOL, $row['options']);
                $fields[$row['id']]['values'] = array_combine($options, $options);
            }
        }

        $data = array(
            'title'  => 'Survey: ' . $title,
            'menu'   => $this->load->view('menu', NULL, TRUE),
            'button' => 'Submit',
            'form'   => array(
                'action' => site_url(uri_string()),
                'method' => 'post',
            ),
            'fields' => $fields,
        );

        $this->load->view($this->view[__FUNCTION__], $data);
    }

    public function create_post($survey_id = 0)
    {
        check_access(TRUE);

        $set = array(
            'survey_id'     => $survey_id,
            'writer_id'     => $this->auth->user()->id,
            'response_json' => json_encode($_POST),
        );

        if ($this->db->insert($this->table, $set) !== FALSE) {
            $list = json_encode(site_url(dirname(uri_string())));

            $this->output->append_output(
                "<script>
                    alert('Thank you for your participation!');
                    window.parent.location = $list;
                </script>"
            );
        } else {
            $this->dbError();
        }
    }
}