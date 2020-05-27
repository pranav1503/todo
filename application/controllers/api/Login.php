<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

require  APPPATH . 'libraries\REST_Controller.php';
// echo APPPATH . 'libraries\REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class Login extends REST_Controller{
    public function __construct(){
        parent::__construct();

        $this->load->model('signups');
       // $this->load->library('session');
    }


    public function login_post()
    {
        $email_id = $this->input->post('email_id');
        $password = $this->input->post('password');
        $query = $this->signups->login_check($email_id,$password); 
        if($query->num_rows()>0){
            foreach ($query->result() as $row)
                continue;
            $id = $row->id;
            $email_id = $row->email_id;
            $phone_no = $row->phone_no;
            $session_data = array(
                'id' => $id,
                'email_id' => $email_id,
                'phone_no' => $phone_no,
            );
            $this->session->set_userdata($session_data);
            $this->response([
                'status' => true,
                'id' => $id,
           'message' => 'Logged In Successfully.',
        ],REST_Controller::HTTP_OK);
            
            
                
        }   
        else{
//            $this->session->set_flashdata('error','Invalid USer Name and Password');
            $this->response([
                'status' => false,
           'message' => 'Failed.',
        ],REST_Controller::HTTP_OK); 
        }
             
    }

   
    
}

?>