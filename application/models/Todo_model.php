<?php
    class Todo_model extends CI_Model{

        public function fetch_todo($user="")
        {
            if($user == 0 || empty($user)){
                $query = $this->db->get('todo');
            }else{
                $query = $this->db->order_by('due','desc')->get_where('todo',array('userid' => $user));
            }
            return $query->result_array();
        }
        
        public function add_todo($user,$date,$task)
        {
            $insert = $this->db->insert('todo',[
                'userid' => $user,
                'due' => $date,
                'task' => $task,
            ]);

            return $insert;
        }

        public function delete_todo($user,$id)
        {
            $result = $this->db->delete('todo',array(
                'userid' => $user,
                'id' => $id
            ));
            return ($this->db->affected_rows() > 0);
        }

        public function update_todo($id,$data)
        {
            $result = $this->db->update('todo',$data,array(
                'id'=>$id,
                'userid' => $data["userid"],
            ));
            return ($this->db->affected_rows() > 0);
        }
    }
?>