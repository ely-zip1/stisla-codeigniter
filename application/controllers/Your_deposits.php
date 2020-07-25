<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Your_deposits extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('DepositModel');
    $this->load->model('Members');
    $this->load->model('Deposit_Options');
    $this->load->model('PackageModel');
    $this->load->model('Referral_bonus_model');
    $this->load->model('Indirect_bonus_model');
    $this->load->model('ReferralModel');
  }

  public function index()
  {
    $data['title'] = 'Deposits';

    $member = $this->Members->get_member($this->session->username);
    $deposits = $this->DepositModel->get_deposit_per_member($member->id);

    $total_deposit = 0;
    $ultramax_deposit_data = array();
    $panamax_deposit_data = array();
    $capesize_deposit_data = array();
    $ultramax_days = 120;
    $panamax_days = 90;
    $capesize_days = 60;

    foreach ($deposits as $deposit) {
      if($deposit->is_pending == 0){
        $total_deposit += $deposit->amount;
      }

        if($deposit->package_id == 1){
          $ultramax = array();
          $ultramax['amount'] = number_format($deposit->amount, 2, '.', ',');

          $payment_mode = $this->Deposit_Options->get_by_id($deposit->deposit_options_id);
          $ultramax['mode'] = $payment_mode->name;
          $ultramax['send_to'] = $payment_mode->account;
          $ultramax['date'] = $deposit->date;
          $ultramax['date_approved'] = $deposit->date_approved;

          if($deposit->deposit_options_id == 7){
            $ultramax['status'] = 'Fulfilled';
          }else{
            $ultramax['status'] = ($deposit->is_pending == 1) ? 'Pending' : 'Fulfilled';
          }

          if($deposit->is_pending == 1){
            $ultramax['days_remaining'] = 'n/a';
          }else{
            $ultramax['days_remaining'] = $this->calculate_remaining_days($ultramax_days, $deposit->date_approved);
          }

          array_push($ultramax_deposit_data, $ultramax);
        }
        else if($deposit->package_id == 2){
          $panamax = array();
          $panamax['amount'] = number_format($deposit->amount, 2, '.', ',');

          $payment_mode = $this->Deposit_Options->get_by_id($deposit->deposit_options_id);
          $panamax['mode'] = $payment_mode->name;
          $panamax['send_to'] = $payment_mode->account;
          $panamax['date'] = $deposit->date;
          $panamax['date_approved'] = $deposit->date_approved;

          if($deposit->deposit_options_id == 7){
            $panamax['status'] = 'Fulfilled';
          }else{
            $panamax['status'] = ($deposit->is_pending == 1) ? 'Pending' : 'Fulfilled';
          }

          if($deposit->is_pending == 1){
            $panamax['days_remaining'] = 'n/a';
          }else{
            $panamax['days_remaining'] = $this->calculate_remaining_days($panamax_days, $deposit->date_approved);
          }

          array_push($panamax_deposit_data, $panamax);
        }
        else if($deposit->package_id == 3){
          $capesize = array();
          $capesize['amount'] = number_format($deposit->amount, 2, '.', ',');

          $payment_mode = $this->Deposit_Options->get_by_id($deposit->deposit_options_id);
          $capesize['mode'] = $payment_mode->name;
          $capesize['send_to'] = $payment_mode->account;
          $capesize['date'] = $deposit->date;
          $capesize['date_approved'] = $deposit->date_approved;

          if($deposit->deposit_options_id == 7){
            $capesize['status'] = 'Fulfilled';
          }else{
            $capesize['status'] = ($deposit->is_pending == 1) ? 'Pending' : 'Fulfilled';
          }

          if($deposit->is_pending == 1){
            $capesize['days_remaining'] = 'n/a';
          }else{
            $capesize['days_remaining'] = $this->calculate_remaining_days($capesize_days, $deposit->date_approved);
          }

          array_push($capesize_deposit_data, $capesize);
        }
    }

    $data['ultramax_deposit_data'] = $ultramax_deposit_data;
    $data['panamax_deposit_data'] = $panamax_deposit_data;
    $data['capesize_deposit_data'] = $capesize_deposit_data;
    $data['total_details'] = '$ '. number_format($total_deposit, 2, '.', ',');

    $this->load->view('templates/header', $data);
    $this->load->view('pages/your_deposits', $data);
    $this->load->view('templates/footer');
  }

  public function calculate_remaining_days($contract_days, $date_approved){
    $start_date = new DateTime($date_approved);
    $end_date = DateTime::createFromFormat('Y-m-d H:i:s', date('Y-m-d H:i:s'));

    $difference = $start_date->diff($end_date);
    $remaining_days = $contract_days - $difference->d;

    return abs($remaining_days);
  }

}
