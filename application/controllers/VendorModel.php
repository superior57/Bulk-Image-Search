
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Model Name: vendor_model;
 */
class VendorModel extends CI_model
{

    function __construct()
    {
        parent::__construct();
    }
    public function record_count() {
        return $this->db->count_all("vendor");
    }
    function get_vendor_list($start = 0, $limit = 0, $keyword = '') {
        $key = isset($keyword) ? $keyword : '';

        $this->db->select('*');
        if($key != ''){
            $this->db->like('name', $key);
            $this->db->or_like('street', $key);
            $this->db->or_like('extStreetNumber', $key);
            $this->db->or_like('inStreetNumber', $key);
            $this->db->or_like('complementaryInfo', $key);
            $this->db->or_like('city', $key);
            $this->db->or_like('zipcode', $key);
            $this->db->or_like('country', $key);
            $this->db->or_like('phoneNumber', $key);
            $this->db->or_like('mail', $key);
        }
        $this->db->limit($limit,$start);
        $query = $this->db->get("vendor");
        return $query->result_array();
    }

    function get_all_phonenumberlist($start = 0, $limit = 0)
    {
        $myphonenumber = str_replace('+', '', $this->session->userdata('myphonenumber'));
        //var_dump($myphonenumber);exit;
        $this->db->select('*');
        $this->db->where('active','active');
        $this->db->where('phonenumber <>', $myphonenumber);
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        return $this->db->get("phone_register")->result_array();
    }

    function savemessage($myphonenumber, $phonelst, $msgcontent)
    {
        $res_time = date("Y-m-d h:i:s");
        $from = $myphonenumber;
        $messageid = "msgid=+/".strval(rand(2,10));
        $msgcontent = htmlentities($msgcontent);
        foreach ($phonelst as $value) {
            $to = $value['phonenumber'];
            $query = "insert  into `messages` value (NULL,'$res_time','$from','$to','$msgcontent','sent','out','1','$messageid')";
            $this->db->query($query);
        }        
    }



    function get_count_list()
    {
         $myphonenumber = str_replace('+', '', $this->session->userdata('myphonenumber'));
         return $this->db->query("select count(*) as count from phone_register where active='active' and phonenumber <> '$myphonenumber'")->result();
    }

    function get_my_phonenumber()
    {
        $username = $this->session->userdata("user")['username'];
        $this->db->select('phone');
        $this->db->where('name', $username);
        return $this->db->get("user")->result_array();
    }

    function get_phone_list() {

        $this->db->select('phonenumber');
        $this->db->where('active','active');
        $this->db->order_by('id','desc');
        $query = $this->db->get("phone_register");
        return $query->result_array();
    }

    function search_result($key_word) {
        $this->db->select('*');
        $this->db->like('name', $key_word);
        $this->db->or_like('street', $key_word);
        $this->db->or_like('extStreetNumber', $key_word);
        $this->db->or_like('inStreetNumber', $key_word);
        $this->db->or_like('complementaryInfo', $key_word);
        $this->db->or_like('city', $key_word);
        $this->db->or_like('zipcode', $key_word);
        $this->db->or_like('country', $key_word);
        $this->db->or_like('phoneNumber', $key_word);
        $this->db->or_like('mail', $key_word);
        $query = $this->db->get('vendor');
        return $query->result_array();
    }

    function vendor_add($vendor) {
        $this->db->select('*');
        $this->db->where('mail', $vendor['mail']);
        $result = $this->db->get('vendor');
        if ($result->row() != '') {
            return false;
        }
        return $this->db->insert('vendor', $vendor);
    }

    function vendor_edit($id, $vendor) {
        $this->db->where('vid', $id);
        return $this->db->update('vendor', $vendor);
    }

    function delete_vendor($del_id) {
        $this->db->where('vid', $del_id);
        return $this->db->delete('vendor');
    }
}