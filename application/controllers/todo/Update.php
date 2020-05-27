<?php
    class Update extends CI_Controller{
        public function index()
        {            
            $id = $this->input->post('id');
            $userid = $this->input->post('userid');
            $task = $this->input->post('task');
            $due = $this->input->post('due');
            if($due == "" || ctype_space($due)){
                $due = null;
            }
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => base_url()."api/todo/task/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => "id=".$id."&userid=".$userid."&task=".$task."&due=".$due,
            CURLOPT_HTTPHEADER => array(
                "x-api-key: webdeveloper1510",
                "Content-Type: application/x-www-form-urlencoded",
                "Authorization: Basic cHJhbmF2OnByYW5hdjE1MDM="
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
        }
    }
?>