<?php
require_once (rtrim(FCPATH, '\\') . '/application/xcrud/xcrud.php');
if (!function_exists('xcrud_get_instance'))
{
    function xcrud_get_instance($name = false)
    {
        $CI = &get_instance();
        $CI->load->library('session');
        $CI->load->helper('url');
        Xcrud_config::$scripts_url = base_url('');
        $xcrud = Xcrud::get_instance($name);
        return $xcrud;
    }
}
if (!function_exists('xcrud_store_session'))
{
    function xcrud_store_session()
    {
        $CI = &get_instance();
        $CI->load->library('session');
        $CI->session->set_userdata(array('xcrud_sess' => Xcrud::export_session()));
    }
}
if (!function_exists('xcrud_restore_session'))
{
    function xcrud_restore_session()
    {
        $CI = &get_instance();
        $CI->load->library('session');
        Xcrud::import_session($CI->session->userdata('xcrud_sess'));
    }
}

