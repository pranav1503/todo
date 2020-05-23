<?php
    class Main extends CI_Controller{
        function index()
        {
            echo base_url();
            $this->load->view("todo/login");
        }
    }
?>