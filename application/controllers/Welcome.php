<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Welcome extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('GoogleImageGrabber');
        $this->load->model('Condition_model','condition');
    }


    public function index()
    {
        
        $page_no = isset($_GET['per_page']) ? $_GET['per_page'] : 1;
        $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';

        $result_count = 0;
        $per_page = 12;
        $page_count = $result_count / $per_page;

        $images = array();
        
        $offset = ($page_no - 1) * $per_page;
        $result = $this->get_saveDir();
        $save_dir = $result[0]->dirName;
        $data = array(
            'save_dir' => $save_dir,
            'total' => $result_count,
            'page' => $page_no,
            'per_page' => $per_page,
            'images' => $images,
            'page_count' => $page_count);
        $this->load->view('welcome_message', $data);
    }

    public function ajax_edit($id)
    {

        $data = $this->condition->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add()
    {

        $data = array(
                'description' => $this->input->post('txtDescription'),
                'code' => $this->input->post('txtCode'),
                'category' => $this->input->post('txtCategory'),
            );
        $insert = $this->condition->save($data);
        echo json_encode(array("status" => TRUE));
    }


    public function ajax_update()
    {

        $data = array(
                'description' => $this->input->post('txtDescription'),
                'code' => $this->input->post('txtCode'),
                'category' => $this->input->post('txtCategory'),
            );
        $this->condition->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }
    public function ajax_get_condition()
    {
        $data = $this->condition->getAllGroups();
        $i = 0;
        foreach ($data as $condition ) {
            $code = $condition['code'];
            $category = $condition['category'];

            $result = $this->get_saveDir();
            $save_dir = $result[0]->dirName;
            $path = trim("uploads/".$save_dir."/".$category);        
            
            $desc = $path."/".trim($code).".png"; 
            $desc = preg_replace("/ /", "%20", $desc);

            $data[$i]['is_file'] = "false";    
            if ( file_exists($desc) ){
                $data[$i]['is_file'] = "true"; 
            }                 
             $i ++;
        }


        echo json_encode($data);
    }

    public function ajax_delete($id)
    {
        $description = $this->input->post('description');
        $code = $this->input->post('code');
        $this->condition->delete_by_id($id, $description, $code);

        echo json_encode(array("status" => TRUE));
    }

    public function list_by_id($id){

    $data['output'] = $this->condition->get_by_id_view($id);
    $this->load->view('view_Detail', $data);
    }

    /// image download /base directory/uploads/.../
    public function download()
    {
        $url_post = $this->input->post('image');
        $dir = $this->input->post('directory');
        $code = $this->input->post('code');
        $category = $this->input->post('category');
        $filetype = $this->input->post('filetype');    
        $filename = $this->input->post('filename');

        $extension = explode(".", $url_post);
        $extension = $extension[count($extension) - 1];
        $path = trim("uploads/".$dir."/".$category);
        if (!file_exists($path)) {
            $result = mkdir( $path, "0777");
        }        
        $desc = $path."/".trim($code).".png"; 
        if (!empty($extension)) {
            $desc = $path."/".trim($code).".png"; 
        }    

        $desc = preg_replace("/ /", "%20", $desc);
        $url = $url_post;
        $url = preg_replace("/ /", "%20", $url);  
        if (!@copy($url, $desc)) {
            $data = array('fileName' => $desc);    
            $this->session->userdata('item');        

            echo json_encode($data);
        }else{
            echo json_encode(array("status" => false));
            return;
        }

        
         
    }
    public function image_search($post)
    {
        if ($post != "1")return;
        $size_width = "";
        $size_height = "";
        $customSize = "false";
        $transparent = "false";
        $condition = "hp24";
        $code = "";
        $category = "";
        $size_con = "";
        $page_no = "1";
        $temp_condition = "";

        $size_width = $this->input->post('size_width');
        $size_height = $this->input->post('size_height');
        $transparent = $this->input->post('transparent');
        $condition = $this->input->post('condition');
        $category = $this->input->post('category');
        $code = $this->input->post('code');
        $size_con = $this->input->post('size_con');
        $customSize = $this->input->post('customSize');
        $page_no = $this->input->post('page_no');
        $temp_condition = $this->input->post('temp_condition');
        $images = array();
        $values = "";
        $images =  $this->condition->is_temp($temp_condition);   
        $total_count = count($images);    
         // $images = GoogleImageGrabber::grab($condition, $transparent, $customSize, $size_width, $size_height, $page_no);
 
        // var_dump($images);exit;   
        if ( $total_count == 0 ) {          
            $images = GoogleImageGrabber::grab($condition, $transparent, $customSize, $size_width, $size_height, $page_no);
            foreach ($images as $img) {
                $values .= "( \"";
                $values .= $img['url'];
                $values .= "\", \"";
                $values .= $temp_condition;
                $values .= "\", \"";
                $values .= $img['filename'];
                $values .= "\", \"";
                $values .= $img['filetype'];
                $values .= "\", \"";
                $values .= htmlentities($img['title']);
                $values .= "\", \"";
                $values .= $img['dataUrl'];                
                $values .= "\", \"";
                $values .= $img['width'];
                $values .= "\", \"";
                $values .= $img['height'];
                $values .= "\" ),";
            }
            // var_dump($images);exit;

            $values = trim($values, ',');
            $this->condition->temp_save($values);

        }     
        // var_dump($images);exit;
        $page_no = isset($_GET['per_page']) ? $_GET['per_page'] : 1;
        $keyword = isset($_POST['keyword']) ? $_POST['keyword'] : '';

        $result_count = count($images);
        $per_page = 12;
        $page_count = $result_count / $per_page;
        $image_detail;
        $i = 0;
        
        foreach ($images as $img) {
            $image_detail[$i]['url'] = $img['url'];
            $image_detail[$i]['filetype'] = $img['filetype'];
            $image_detail[$i]['filename'] = $img['filename'];
            $image_detail[$i]['width'] = $img['width'];
            $image_detail[$i]['height'] = $img['height'];
            $image_detail[$i]['download'] = "0";
            $image_detail[$i]['title'] = $img['title'];
            $image_detail[$i]['dataUrl'] = $img['dataUrl'];


            // $result = $this->get_saveDir();
            // $save_dir = $result[0]->dirName;
            // $path = trim("uploads/".$save_dir."/".$category);
            
            
            // $desc = $path."/".trim($code)."_".$img['filename'].$img['filetype']; 
            // $desc = preg_replace("/ /", "%20", $desc);
            
            // if ( file_exists($desc) )
            // {
            //     $image_detail[$i]['download'] = "0";    
                          
            // }

            $i ++;
        }  
        $offset = ($page_no - 1) * $per_page;

        $result = $this->get_saveDir();
        $save_dir = $result[0]->dirName;
        $data = array(
            'save_dir' => $save_dir,
            'total' => $result_count,
            'page' => $page_no,
            'per_page' => $per_page,
            'images' => $image_detail,
            'page_count' => $page_count);
        echo json_encode($data);
    }

    public function save_dir()
    {
        $dir = $this->input->post('dir');
        $path = preg_replace('/[^A-Za-z0-9\-]/', '', $dir);
        $dir = "uploads/".$path;

        if (!file_exists("uploads")) {
            $result = mkdir( "uploads", "0777");
        }
        if (!file_exists($dir)) {
            $result = mkdir( $dir, "0777");
        }
        $data = array(
                'dirName' => $path
            );
        $this->condition->saveDirectory(array('id' => '1'), $data);        
        echo json_encode($data);

    }
////
    public function is_file_exists()
    {
        $code = $this->input->post('code');
        $category = $this->input->post('category');

        $result = $this->get_saveDir();
        $save_dir = $result[0]->dirName;
        $path = trim("uploads/".$save_dir."/".$category);        
        
        $desc = $path."/".trim($code)."png"; 
        $desc = preg_replace("/ /", "%20", $desc);

        $data = array( 'is_file' => "false");        
        if ( file_exists($desc) )
             $data['is_file'] = "true";                         

        echo json_encode($data);
    }
////
    public function get_saveDir()
    {
        return $this->condition->getDir();
    }

}
