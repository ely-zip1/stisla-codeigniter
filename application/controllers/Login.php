<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login  extends CI_Controller
{
		public function __construct()
        {
            parent::__construct();
						$this->load->model('members');
						$this->load->model('Referral_codes');
        }

	public function index()
	{
		 // for($i = 1; $i < 1000; $i++){
		 // 	$this->Referral_codes->add_code(random_string('alnum', 6));
		 // }

		if(isset($this->session->username)){

			if($this->session->is_admin){

				redirect('deposits_admin', 'refresh');
			}else{

				redirect('dashboard', 'refresh');
			}
		}else{
			$data = array(
				'title' => "Login"
			);

			$this->form_validation->set_rules('username', 'Username', 'required|callback_is_login_valid');
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]|callback_is_login_valid');

			if ($this->form_validation->run() == FALSE) {
					$this->load->view('login/header', $data);
					$this->load->view('login/login', $data);
					$this->load->view('login/footer');
			}
			else {

				if($this->is_login_valid()){

					// printf($this->members->get_member($_POST['email']));
					$member_data = $this->members->get_member($_POST['username']);

					// echo '<pre>';
					// print_r($member_data);
					// echo '</pre>';

					$userdata = array(
						'email' => $member_data->email_address,
						'fullname' => $member_data->fullname,
						'date_registered' => $member_data->date,
						'username' => $member_data->username,
						'image_name' => $member_data->image_name,
						'image_orientation' => $member_data->image_orientation
					);

					if($member_data->account_type_id == '1' || $member_data->account_type_id == '3'){
						$userdata['is_admin'] = true;
					}else{
						$userdata['is_admin'] = false;
					}

					$this->session->set_userdata($userdata);

					$this->load->model('DepositModel');

					if($member_data->account_type_id == '1' || $member_data->account_type_id == '3'){
						redirect('deposits_admin');
					}else{

						if($this->DepositModel->has_deposit($member_data->id)){
							redirect('dashboard');
						}else{
							redirect('plans');
						}
					}

				}else{
					$this->load->view('login/header', $data);
					$this->load->view('login/login', $data);
					$this->load->view('login/footer');

				}
			}

		}

	}

	function is_login_valid(){

		$is_valid = $this->members->verify_member($_POST['username'],$_POST['password']);

		if($is_valid){
			return true;
		}else{
			$this->form_validation->set_message('is_login_valid','Invalid username or password.');
			return false;
		}
	}

}
