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
        
        public function add_todo($user,$date,$task,$label)
        {
            $insert = $this->db->insert('todo',[
                'userid' => $user,
                'due' => $date,
                'task' => $task,
                'label' => $label,
            ]);
            $query = $this->db->order_by('id')->get_where('todo',array(
                'userid' => $user,
                'due' => $date,
                'task' => $task,
                'label' => $label,
            ));    
            foreach($query->result_array() as $key=>$value){
                $id = $value["id"];
            }
            return $id;
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

        public function fetch_label($user="")
        {
            if($user == 0 || empty($user)){
                $query = $this->db->get('labels');
            }else{
                $query = $this->db->get_where('labels',array('userid' => $user));
            }
            return $query->result_array();
        }
    }
?>