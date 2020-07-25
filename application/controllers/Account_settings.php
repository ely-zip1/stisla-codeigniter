<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Account_settings extends CI_Controller
{
	public function __construct()
        {
            parent::__construct();
						$this->load->model('PackageModel');
						$this->load->model('DepositModel');
						$this->load->model('Members');
						$this->load->model('Deposit_Options');
						$this->load->model('Bank_model');
						$this->load->model('Withdrawal_Mode_model');

            date_default_timezone_set('Asia/Manila');
        }

	public function index()
	{
		$data = array(
			'title' => "Account Settings"
		);

		$member_data = $this->Members->get_member($this->session->username);

		$data['account_name'] = $member_data->username;
		$data['date_registered'] = $member_data->date;
		$data['email_address'] = $member_data->email_address;
		$data['full_name'] = $member_data->full_name;

		$bank = $this->Bank_model->get_per_member_id($member_data->id);

		$data['bank_name'] = $bank->bank_name;

		$data['bank_account_name'] = $bank->account_name;
		$data['bank_account_number'] = $bank->account_number;
		$withdrawal_account = $this->Withdrawal_Mode_model->get_per_member($member_data->id);

		$data['bitcoin_account'] = $withdrawal_account->bitcoin;
		$data['ethereum_account'] = $withdrawal_account->ethereum;
		$data['abra_account'] = $withdrawal_account->abra;
		$data['neteller_account'] = $withdrawal_account->neteller;
		$data['paypal_account'] = $withdrawal_account->paypal;
		$data['advcash_account'] = $withdrawal_account->advcash;


		if(isset($_POST['account_submit'])){
			if($_POST['account_submit'] == 'reset_password'){
				$this->form_validation->set_rules('new_password', 'New Password', 'required|min_length[6]');
				$this->form_validation->set_rules('confirm_new_password', 'Password Confirmation', 'required|min_length[6]|matches[new_password]');
			}
			else if($_POST['account_submit'] == 'bank'){
				$this->form_validation->set_rules('bank_name', 'Bank Name', 'required');
				$this->form_validation->set_rules('bank_account_name', 'Account Name', 'required');
				$this->form_validation->set_rules('bank_account_number', 'Account Number', 'required');
			}
			else if($_POST['account_submit'] == 'bitcoin'){
				$this->form_validation->set_rules('bitcoin_account', 'Bitcoin Account', 'required');
			}
			else if($_POST['account_submit'] == 'ethereum'){
				$this->form_validation->set_rules('ethereum_account', 'Ethereum Account', 'required');
			}
			else if($_POST['account_submit'] == 'paypal'){
				$this->form_validation->set_rules('paypal_account', 'Paypal Account', 'required');
			}
			else if($_POST['account_submit'] == 'abra'){
				$this->form_validation->set_rules('abra_account', 'Abra Account', 'required');
			}
			else if($_POST['account_submit'] == 'neteller'){
				$this->form_validation->set_rules('neteller_account', 'Neteller Account', 'required');
			}
			else if($_POST['account_submit'] == 'advcash'){
				$this->form_validation->set_rules('advcash_account', 'Advcash Account', 'required');
			}
		}



		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header', $data);
	    $this->load->view('pages/account_settings', $data);
	    $this->load->view('templates/footer');
		}
		else{
			if($_POST['account_submit'] == 'reset_password'){

				$email = $this->session->email;
				$password = $_POST['new_password'];

				$this->Members->update_password($email, $password);

				if($this->Members->verify_member($this->session->username, $password)){
					$data['password_update_success'] = 'Password updated!';
				}
			}

			if($_POST['account_submit'] == 'bank'){
				$new_bank_details = array(
					'bank_name' => $_POST['bank_name'],
					'account_name' => $_POST['bank_account_name'],
					'account_number' => $_POST['bank_account_number'],
					'member_id' => $member_data->id
					);
				$this->Bank_model->update($new_bank_details);
			}
			else if($_POST['account_submit'] == 'bitcoin'){
				$this->Withdrawal_Mode_model->update_bitcoin($member_data->id, $_POST['bitcoin_account']);
			}
			else if($_POST['account_submit'] == 'ethereum'){
				$this->Withdrawal_Mode_model->update_ethereum($member_data->id, $_POST['ethereum_account']);
			}
			else if($_POST['account_submit'] == 'paypal'){
				$this->Withdrawal_Mode_model->update_paypal($member_data->id, $_POST['paypal_account']);
			}
			else if($_POST['account_submit'] == 'abra'){
				$this->Withdrawal_Mode_model->update_abra($member_data->id, $_POST['abra_account']);
			}
			else if($_POST['account_submit'] == 'neteller'){
				$this->Withdrawal_Mode_model->update_neteller($member_data->id, $_POST['neteller_account']);
			}
			else if($_POST['account_submit'] == 'advcash'){
				$this->Withdrawal_Mode_model->update_advcash($member_data->id, $_POST['advcash_account']);
			}

			$this->load->view('templates/header', $data);
	    $this->load->view('pages/account_settings', $data);
	    $this->load->view('templates/footer');
		}
  }

}
