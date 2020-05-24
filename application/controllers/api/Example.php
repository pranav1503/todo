<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

require  APPPATH . 'libraries\REST_Controller.php';
// echo APPPATH . 'libraries\REST_Controller.php';
use Restserver\Libraries\REST_Controller;
class Example extends REST_Controller{
    public function __construct(){
        parent::__construct();

        $this->load->model('todo');
    }

    public function todo_get($user = 0)
    {
        $todos = $this->todo->fetch_todo($user);
        if(!empty($todos)){
            $this->response($todos,REST_Controller::HTTP_OK);
        }else{
            $this->response([
                'message' => 'No Todos Found'
            ],REST_Controller::HTTP_NOT_FOUND);
        }
    }

    public function todo_post()
    {
        $user = $this->input->post('user');
        $date = $this->input->post('date');
        $task = $this->input->post('task');
        $abc = "hello";
        $this->todo->add_todo($user,$date,$task);   
        $this->response([
            'user' => $user,
            'due_date' => $date, 
            'task' => $task,
            'message' => 'Added Successfully.',
        ],REST_Controller::HTTP_OK);     
    }
}

?>