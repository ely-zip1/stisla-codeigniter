<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
		public function __construct()
        {
            parent::__construct();
						$this->load->model('DepositModel');
						$this->load->model('Members');
						$this->load->model('WithdrawalModel');
						$this->load->model('Referral_bonus_model');
						$this->load->model('ReferralModel');
						$this->load->model('Referral_codes');
						$this->load->model('Indirect_bonus_model');
            $this->load->model('Fund_transfer_model');
        }

	public function index() {

		$data = array(
			'title' => "Dashboard",
			'profit' => '0',
			'deposit' => '0',
			'referral_bonus' => '0',
			'balance' => '0'
		);

		$member_data = $this->Members->get_member($this->session->userdata('username'));

		$data['username'] = $this->session->userdata('username');
		$data['email'] = $this->session->userdata('email');
		$data['fullname'] = $this->session->userdata('fullname');
		$data['date_registered'] = $this->session->userdata('date_registered');

		if(isset($member_data)){
			$pending_withdrawal = $this->WithdrawalModel->get_pending_withdrawal($member_data->id);
			$total_withdrawal = $this->WithdrawalModel->get_total_withdrawal_per_member($member_data->id);
			$last_withdrawal = $this->WithdrawalModel->get_latest_withdrawal_amount($member_data->id);
			$total_growth = $this->DepositModel->get_total_growth($member_data->id);
			$last_deposit = $this->DepositModel->get_latest_deposit_amount($member_data->id);
			$total_deposit = $this->DepositModel->get_total_deposit($member_data->id);
			$total_bonus = $this->Referral_bonus_model->get_total_bonus($member_data->id);
			$total_reinvestment = $this->DepositModel->get_total_member_reinvestment($member_data->id);
	    $total_sent = $this->Fund_transfer_model->get_total_sent($member_data->id);
	    $total_received = $this->Fund_transfer_model->get_total_received($member_data->id);
			$active_deposit = $this->DepositModel->get_total_approved_deposit_per_member($member_data->id);

	    $account_balance = ($total_growth + $total_bonus + $total_received) - $total_withdrawal->amount - $total_reinvestment->amount - $total_sent;

			$data['active_deposit'] = '$ '.number_format($active_deposit, 2, '.', ',');
			$data['account_balance'] = '$ '.number_format($account_balance, 2, '.', ',');
			$data['pending_withdrawals'] = '$ '.number_format($pending_withdrawal->total, 2, '.', ',');
			$data['total_withdrawals'] = '$ '.number_format($total_withdrawal->amount, 2, '.', ',');
			$data['last_withdrawal'] = '$ '.number_format($last_withdrawal->amount, 2, '.', ',');
			$data['total_growth'] = '$ '.number_format($total_growth, 2, '.', ',');
			$data['last_deposit'] = '$ '.number_format($last_deposit->amount, 2, '.', ',');
			$data['total_deposit'] = '$ '.number_format($total_deposit->amount, 2, '.', ',');
			// '$'.number_format($_POST['deposit_amount'], 2, '.', ',');

			// print_r($this->WithdrawalModel->get_pending_withdrawal($member_data->id));
		}
		$data['referral_code'] = $this->Referral_codes->get_members_code($member_data->referral_code_id)->code;

		$this->load->view('templates/header', $data);
		$this->load->view('pages/dashboard', $data);
		$this->load->view('templates/footer', $data);
	}
}
?>
