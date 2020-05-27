<?php
    class Add extends CI_Controller{
        public function index()
        {
            $users = $this->session->all_userdata();            
            $data = array(
                'user' => $users['id'],
                'task' => $this->input->post('task'),
                'due'=> $this->input->post('due'),
                'label'=> $this->input->post('label'),
            );
            $postData = "";
            foreach( $data as $key => $val ) {
                $postData .=$key."=".$val."&";
            }
            $postData = rtrim($postData, "&");

            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => base_url()."api/todo/task/",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postData,
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

        // public function adds()
        // {
        //     $curl = curl_init();

        //     $data = array('user' => '108','task' => 'Pranav');
        //     $postData = "";
        //     foreach( $data as $key => $val ) {
        //         $postData .=$key."=".$val."&";
        //     }
        //     $postData = rtrim($postData, "&");

        //     curl_setopt_array($curl, array(
        //     CURLOPT_URL => base_url()."api/example/todo",
        //    // CURLOPT_URL => "http://localhost/todo/todo/api/example/todo",
        //     CURLOPT_RETURNTRANSFER => true,
        //     CURLOPT_ENCODING => "",
        //     CURLOPT_MAXREDIRS => 10,
        //     CURLOPT_TIMEOUT => 0,
        //     CURLOPT_FOLLOWLOCATION => true,
        //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        //     CURLOPT_CUSTOMREQUEST => "POST",
        //     CURLOPT_POSTFIELDS => $postData,
        //     CURLOPT_HTTPHEADER => array(
        //         "x-api-key: webdeveloper1510",
        //         "Content-Type: application/x-www-form-urlencoded",
        //         "Authorization: Basic cHJhbmF2OnByYW5hdjE1MDM=",
        //         "Cookie: ci_session=87l7cdpb9vvfuaf8gnital27tp7k2pbj"
        //     ),
        //     ));

        //     $response = curl_exec($curl);

        //     curl_close($curl);
        //     echo $response;
        // }
    }
?>