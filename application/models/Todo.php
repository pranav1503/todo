<?php
    class Todo extends CI_Model{

        public function fetch_todo($user="")
        {
            if($user == 0 || empty($user)){
                $query = $this->db->get('todo');
            }else{
                $query = $this->db->get_where('todo',array('userid' => $user));
            }
            return $query->result_array();
        }
        
        public function add_todo($user,$date,$task)
        {
            $this->db->insert('todo',[
                'userid' => $user,
                'due' => $date,
                'task' => $task,
            ]);
        }
    }
?>