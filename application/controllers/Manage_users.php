<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Manage_users extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('WithdrawalModel');
    $this->load->model('Members');
    $this->load->model('PackageModel');
    $this->load->model('Withdrawal_Mode_model');
    $this->load->model('Bitcoin_model');
    $this->load->model('Bank_model');
    $this->load->model('Gcash_model');
    $this->load->model('Remittance_model');
    $this->load->model('DepositModel');
    $this->load->model('ReferralModel');
    $this->load->model('Referral_codes');
  }

  public function index($offset = 0)
  {
    $my_offset = $offset;
    $my_limit = 10;
    $member_list = $this->Members->get_members_offset_limit($my_offset, $my_limit);

    $total_members = $this->Members->count_members();
    $total_pages = $total_members /10;

    if(($total_members % 10) > 0){
      $total_pages += 1;
    }

    $data['total_pages'] = $total_pages;
    $data['title'] = 'Manage Users';

    $users_data = array();

    foreach($member_list as $member){
      if($member->account_type_id != '2'){
        continue;
      }

      $deposit_data = $this->DepositModel->get_deposit_per_member($member->id);
      $referred_by = $this->ReferralModel->get_referrer($member->id);
      $referrer = $this->Members->get_member_by_id($referred_by->referrer_id);
      $referral_code = $this->Referral_codes->get_members_code($member->referral_code_id);

      $total_deposit = 0;
      foreach($deposit_data as $deposit){
        $total_deposit += $deposit->amount;
      }

      $temp['id'] = $member->id;
      $temp['full_name'] = $member->full_name;
      $temp['email'] = $member->email_address;
      $temp['date_joined'] = $member->date;
      $temp['total_deposit'] = $total_deposit;
      $temp['referred_by'] = $referrer->full_name;
      $temp['referral_code'] = $referral_code->code;

      array_push($users_data, $temp);
    }

    $data['users'] = $users_data;


    $this->load->view('admin/templates/header', $data);
    $this->load->view('admin/pages/manage_users', $data);
    $this->load->view('admin/templates/footer');

  }

}
