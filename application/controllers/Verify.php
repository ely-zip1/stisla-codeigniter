<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verify extends CI_Controller
{
	public function __construct()
        {
            parent::__construct();
						$this->load->model('Members');

            date_default_timezone_set('Asia/Manila');
        }

	public function index($verification_code = '')
	{
    $data = array(
      'title' => 'Verification'
    );

    if(isset($verification_code)){
        if($this->Members->is_valid_v_code($verification_code)){

          $this->Members->verified($verification_code);
          $data['status'] = '1';
          $data['message'] = 'You have successfully verified your account!';
        }else{
          $data['status'] = '0';
          $data['message'] = 'Account verification failed.';
        }
    }


    $this->load->view('login/header', $data);
    $this->load->view('login/verify', $data);
    $this->load->view('login/footer');
  }

}
