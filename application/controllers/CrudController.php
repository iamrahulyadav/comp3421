<?php

/**
 * comp3421
 * Created by LKHO.
 * Date: 14/12/2015 16:33
 */
abstract class CrudController extends CI_Controller
{
    public function _remap($action, $args)
    {
        $action = $action . '_' . $this->input->method();
        if (method_exists($this, $action)) {
            return call_user_func_array(array($this, $action), $args);
        } else {
            $this->output->set_status_header(405);
            $this->output->set_output('Method ' . $this->input->method(TRUE)
                . ' is not allowed.<br><a href="javascript:history.back()">Back</a>');
        }
    }
}