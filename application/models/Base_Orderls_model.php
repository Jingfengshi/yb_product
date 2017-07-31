<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Base_Orderls_model extends CI_Model
{

    public function insert($arr)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->insert(tab_m('order_ls'),$arr);
    }

    public function delete($where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->delete(tab_m('order_ls'),$where);
    }

    public function update($data,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->update(tab_m('order_ls'),$data,$where);
    }

    public function update_pro($data,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_update_model');
        return $CI->Base_update_model->update(tab_m('order_pro_ls'),$data,$where);
    }
    
    public  function get_list($field,$where,$order_by)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_list(tab_m('order_ls'),$field,$where,$order_by);
    }


   
    public  function get_pro_list($field,$where,$order_by)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_list(tab_m('order_pro_ls'),$field,$where,$order_by);
    }

    public function  get_row($field,$where)
    {
        $CI = & get_instance();
        $CI->load->model('Base_get_model');
        return $CI->Base_get_model->get_row(tab_m('order_ls'),$field,$where,'id desc');
    }
}
