<?php
    class Completed extends CI_Controller{
        public function index()
        {
            $id = $this->input->post('id');
            $userid = $this->input->post('userid');
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => base_url()."api/todo/completed",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "PUT",
            CURLOPT_POSTFIELDS => "id=".$id."&userid=".$userid,
            CURLOPT_HTTPHEADER => array(
                "x-api-key: webdeveloper1510",
                "Content-Type: application/x-www-form-urlencoded",
                "Authorization: Basic cHJhbmF2OnByYW5hdjE1MDM=",
                "Cookie: ci_session=6anaeu79lclth1vsld7as7o16e8gkb7p"
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            echo $response;
        }
    }
?>