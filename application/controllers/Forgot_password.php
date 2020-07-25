<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Forgot_password  extends CI_Controller
{
	public function __construct()
        {
            parent::__construct();
            $this->load->model('Members');
            $this->load->helper('url');
            $this->load->config('email');
        }

	public function index()
	{
        $data = array(
            'title' => 'Reset Password'
        );

        $this->form_validation->set_rules('email', 'Email Address', 'required|valid_email|callback_is_email_valid');

        if ($this->form_validation->run() == FALSE) {
                $this->load->view('login/header', $data);
                $this->load->view('login/forgot_password', $data);
                $this->load->view('login/footer');
        }
        else {
            $temp = $this->set_new_password($_POST['email']);
            $issent = $this->send_reset_email($_POST['email'], $temp);

            if($issent){
                $this->session->set_flashdata('reset_message', 'A message has been sent to your email.');
                redirect('forgot_password','refresh');
            }else{
                $this->session->set_flashdata('reset_message', 'Something went wrong. The email has not been sent.');
                redirect('forgot_password','refresh');
            }
        }

    }

    function set_new_password($email){
        $temporary_password = random_string('alnum', 8);
        $this->Members->update_password($email, $temporary_password);

        return $temporary_password;
    }

    function send_reset_email($email, $password){

        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        // $from = "energyfuelmainoffice@gmail.com";
				//
        // //$to = "elisha.lapiz@gmail.com";
        // $to = $email;
        // $subject = "Password Reset";
        // $message = "Your temporary password is: $password .";
        // $headers = "From:" . $from;
				//
				//
        // if(mail($to,$subject,$message, $headers)){
        //     return true;
        // }else{
        //     return false;
        // }
				$data['email'] = $email;

				$this->load->library('email');

        $this->email->from('energyfuelsmainoffice@gmail.com', 'EnergyFuels-Affiliate')
            ->to($data['email'])
            ->subject('Update Password')
						->message('Your temporary password is: '.$password);

        if($this->email->send()){
					return true;
				}else{
					return false;
				}
    }

    function is_email_valid($email){
        if($this->Members->has_duplicate_email($email)){
            return true;
        }else{
            $this->form_validation->set_message('is_email_valid','Invalid email address.');
            return false;
        }
    }

}
