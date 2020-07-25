<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Withdraw extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('DepositModel');
    $this->load->model('WithdrawalModel');
    $this->load->model('Members');
    $this->load->model('Deposit_Options');
    $this->load->model('PackageModel');
    $this->load->model('Referral_bonus_model');
    $this->load->model('Indirect_bonus_model');
    $this->load->model('ReferralModel');
    $this->load->model('Withdrawal_Mode_model');
    $this->load->model('Bank_model');
    $this->load->model('Fund_transfer_model');

    date_default_timezone_set('Asia/Manila');
  }

  public function index()
  {
    $data['title'] = 'Withdraw';

    $member = $this->Members->get_member($this->session->username);



    $withdrawals = $this->WithdrawalModel->get_total_withdrawal_per_member($member->id);
    $withdrawal_modes = $this->Withdrawal_Mode_model->get_per_member($member->id);
    $bank = $this->Bank_model->get_per_member_id($member->id);

    $pending_withdrawal = $this->WithdrawalModel->get_pending_withdrawal($member->id);
    $total_growth = $this->DepositModel->get_total_growth($member->id);
    $total_withdrawn = $this->WithdrawalModel->compute_total_withdrawn ($member->id);
    $total_bonus = $this->Referral_bonus_model->get_total_bonus($member->id);
		$total_reinvestment = $this->DepositModel->get_total_member_reinvestment($member->id);
    $total_sent = $this->Fund_transfer_model->get_total_sent($member->id);
    $total_received = $this->Fund_transfer_model->get_total_received($member->id);

    $account_balance = ($total_growth + $total_bonus + $total_received) - $total_withdrawn - $total_reinvestment->amount - $total_sent;
    if($account_balance < 10){
      $data['withdrawable'] = 'not withdrawable';
    }

    $data['account_balance'] = number_format($account_balance, 2, '.', ',');
    $data['pending_withdrawal'] = number_format($pending_withdrawal->total, 2, '.', ',');

    $data['selected_mode'] = 'mode1';

    $withdrawal_history = array();
    $all_withdrawals = $this->WithdrawalModel->get_withdrawal_per_member($member->id);
    foreach ($all_withdrawals as $withdrawal) {
        $history = array();
        $history['amount'] = $withdrawal->amount;
        $history['mode'] = $withdrawal->payment_method;
        $history['date'] = $withdrawal->date;
        $history['status'] = ($withdrawal->is_pending == 1)?'Pending':'Fulfilled';

        array_push($withdrawal_history, $history);
    }
    $data['withdrawal_history'] = $withdrawal_history;

    $this->form_validation->set_rules('plan_payment_mode', 'Payment Mode', 'required');
    $this->form_validation->set_rules('withdraw_amount', 'Withdraw Amount', 'required|regex_match[/^(\d*\.)?\d+$/]|greater_than_equal_to[10]|callback_valid_amount|callback_has_pending');

    if ($this->form_validation->run() == FALSE) {
      if(isset($_POST['plan_payment_mode'])){
				$data['selected_mode'] = $_POST['plan_payment_mode'];
      }
      $this->load->view('templates/header', $data);
      $this->load->view('pages/withdraw', $data);
      $this->load->view('templates/footer');
    }
    else{
        $withdrawal_data['member_id'] = $member->id;
        $withdrawal_data['date'] = date('Y-m-d H:i:s');
        $withdrawal_data['amount'] = $_POST['withdraw_amount'];

        if($_POST['plan_payment_mode'] == 'mode1'){
          $withdrawal_data['payment_method'] = 'Bank';
          if(strlen($bank->bank_name) <= 0){
              redirect('account_settings', 'refresh');
          }
  			}else if($_POST['plan_payment_mode'] == 'mode2'){
          $withdrawal_data['payment_method'] = 'Bitcoin';
          if(strlen($withdrawal_modes->bitcoin) <= 0){
            redirect('account_settings', 'refresh');
          }
  			}else if($_POST['plan_payment_mode'] == 'mode3'){
          $withdrawal_data['payment_method'] = 'Ethereum';
          if(strlen($withdrawal_modes->ethereum) <= 0){
            redirect('account_settings', 'refresh');
          }
  			}else if($_POST['plan_payment_mode'] == 'mode4'){
          $withdrawal_data['payment_method'] = 'Abra';
          if(strlen($withdrawal_modes->abra) <= 0){
            redirect('account_settings', 'refresh');
          }
  			}else if($_POST['plan_payment_mode'] == 'mode5'){
          $withdrawal_data['payment_method'] = 'Paypal';
          if(strlen($withdrawal_modes->paypal) <= 0){
            redirect('account_settings', 'refresh');
          }
  			}else if($_POST['plan_payment_mode'] == 'mode6'){
          $withdrawal_data['payment_method'] = 'Neteller';
          if(strlen($withdrawal_modes->neteller) <= 0){
            redirect('account_settings', 'refresh');
          }
  			}else if($_POST['plan_payment_mode'] == 'mode7'){
          $withdrawal_data['payment_method'] = 'Advcash';
          if(strlen($withdrawal_modes->advcash) <= 0){
            redirect('account_settings', 'refresh');
          }
  			}

        $withdrawal_data['is_pending'] = 1;

        $this->WithdrawalModel->add_new_withdrawal($withdrawal_data);

        redirect('withdraw','refresh');
    }

  }

  public function valid_amount()
  {
        $member = $this->Members->get_member($this->session->username);

        $pending_withdrawal = $this->WithdrawalModel->get_pending_withdrawal($member->id);
        $total_growth = $this->DepositModel->get_total_growth($member->id);
        $total_withdrawn = $this->WithdrawalModel->compute_total_withdrawn ($member->id);
        $total_bonus = $this->Referral_bonus_model->get_total_bonus($member->id);
    		$total_reinvestment = $this->DepositModel->get_total_member_reinvestment($member->id);
        $total_sent = $this->Fund_transfer_model->get_total_sent($member->id);
        $total_received = $this->Fund_transfer_model->get_total_received($member->id);

        $account_balance = ($total_growth + $total_bonus + $total_received) - $total_withdrawn - $total_reinvestment->amount - $total_sent;

    if($_POST['withdraw_amount'] > $account_balance){
      $this->form_validation->set_message('valid_amount', 'Invalid amount.');
			return false;
    }else {
      return true;
    }
  }

  public function has_pending(){

        $member = $this->Members->get_member($this->session->username);

        $pending_withdrawal = $this->WithdrawalModel->get_pending_withdrawal($member->id);
        $total_growth = $this->DepositModel->get_total_growth($member->id);
        $total_withdrawn = $this->WithdrawalModel->compute_total_withdrawn ($member->id);
        $total_bonus = $this->Referral_bonus_model->get_total_bonus($member->id);
    		$total_reinvestment = $this->DepositModel->get_total_member_reinvestment($member->id);
        $total_sent = $this->Fund_transfer_model->get_total_sent($member->id);
        $total_received = $this->Fund_transfer_model->get_total_received($member->id);

        $account_balance = ($total_growth + $total_bonus + $total_received) - $total_withdrawn - $total_reinvestment->amount - $total_sent;

    if(($pending_withdrawal->total + $_POST['withdraw_amount']) > $account_balance){
      $this->form_validation->set_message('has_pending', 'Pending withdrawal will be more than account balance.');
      return false;
    }else{
      return true;
    }
  }

}
