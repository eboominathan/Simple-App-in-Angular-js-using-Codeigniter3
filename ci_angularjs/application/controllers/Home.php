<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Home extends CI_Controller{

	function __construct()
    {
        parent::__construct();
      
        $this->load->model('angular_model');
    }   


 
    public function index() {
        
        $this->load->view('design/login_header');
        $this->load->view('home/login');
        $this->load->view('design/footer');
   }
   

    public function check_login()
    {

        $data=$this->angular_model->validate();
      echo   $count =count($data);
        if($count >0)
        {
            foreach($data as $d)
            $datas= array(
                          'username'=>$d->username,                        
                          'is_logged_in'=>true 
                            );

            
            $this->session->set_userdata($datas);
        }

        
        
    }

    Public function logout()
    {
        $this->session->sess_destroy();       
        redirect('home');
    }
}
