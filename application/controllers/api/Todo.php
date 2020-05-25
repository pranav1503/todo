<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

require  APPPATH . 'libraries\REST_Controller.php';

use Restserver\Libraries\REST_Controller;
class Todo extends REST_Controller{
    public function __construct(){
        parent::__construct();

        $this->load->model('todo_model');
    }

    public function task_get($user = 0)// signup_post
    {
        $todos = $this->todo_model->fetch_todo($user);
        if(!empty($todos)){
            $this->response($todos,REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'message' => 'No Todos Found'
            ],REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function task_post()
    {
        $user = $this->input->post('user');
        $date = $this->input->post('due');
        $task = $this->input->post('task');
        if ($date == ""){
            $date = null;
        }
        $insert = $this->todo_model->add_todo($user,$date,$task);   
        $this->response([            
            'user' => intval($user),
            'due_date' => $date, 
            'task' => $task,
            'message' => 'Added Successfully.',
        ],REST_Controller::HTTP_OK);     
    }

    public function task_delete($user,$id)
    {
        if(empty($user) || empty($id)){
            $this->response([
                'status' => false,
                'message' => "User ID or Task ID Missing",
            ],REST_Controller::HTTP_NOT_FOUND);
        }else{
            $result = $this->todo_model->delete_todo($user,$id);
            if($result){
                $this->response([
                    'status' => true,
                    'message' => "Deleted Successfully.",
                ],REST_Controller::HTTP_OK);
            }else{
                $this->response([
                    'status' => false,
                    'message' => "Some Problem Has Occured, Try Again Later.",
                ],REST_Controller::HTTP_BAD_REQUEST);
            }
        }
        
    }

    public function task_put()
    {
        $id = $this->put('id');
        $data = array(            
            "userid" => $this->put('userid'),
            "task" => $this->put('task'),
            "due" => $this->put('due'),            
        );
        if($data["task"] == "" || ctype_space($data["task"])){
            $this->response(array(
                'status' => false,                           
            ),REST_Controller::HTTP_BAD_REQUEST);
        }else{
            $result = $this->todo_model->update_todo($id,$data);
            $this->response(array(
                'status' => $result,
                'userid' => $data["userid"],
                'task' => $data["task"],
                'due' => $data["due"],            
            ),REST_Controller::HTTP_OK);
        }
    }
}

?>