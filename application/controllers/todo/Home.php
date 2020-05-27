<?php
    class Home extends CI_Controller{
        public function index()
        {
            // $user = 100;
            $users = $this->session->all_userdata();
            $user = $users['id'];
            $curl = curl_init();
            curl_setopt_array($curl, array(
            CURLOPT_URL => base_url()."api/todo/task/".$user,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "x-api-key: webdeveloper1510",
                "Content-Type: application/x-www-form-urlencoded",
                "Authorization: Basic cHJhbmF2OnByYW5hdjE1MDM=",
                "Cookie: ci_session=s5dfgfuknjhd0j9bvii9ve7ktqmduutb"
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo "<pre>";
            // print_r(json_decode($response,true));            
            $data["tasks"] = json_decode($response,true);

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => base_url()."api/label/label/".$user,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "x-api-key: webdeveloper1510",
                "Content-Type: application/x-www-form-urlencoded",
                "Authorization: Basic cHJhbmF2OnByYW5hdjE1MDM=",
                "Cookie: ci_session=r8n8fnks2kj7atbmku2lfe5u9naatsvo"
            ),
            ));

            $labels = curl_exec($curl);

            curl_close($curl);
            $labels = json_decode($labels,true);
            if($labels["status"])
                $data["labels"] = $labels["data"];
            else
                $labels["data"] = array("empty");
                $data["labels"] = $labels["data"];            
            $this->load->view("todo/home",$data);
        }
    }
?>