<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Deposits_admin extends CI_Controller
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

    $pending_deposits = $this->DepositModel->get_pending();

    // print_r($pending_deposits);

    $deposit_data = array();
    foreach($pending_deposits as $pending){
      // print_r($pending);

      if(isset($pending->member_id)){

        if(!$this->Members->is_exist($pending->member_id)){
          continue;
        }

        $member_data = $this->Members->get_member_by_id($pending->member_id);
        $deposit_mode = $this->Deposit_Options->get_by_id($pending->deposit_options_id);
        $package_data = $this->PackageModel->get_package_by_id($pending->package_id);

        $temp = array();
        $temp['id'] = $pending->id;
        $temp['client_name'] = ucfirst($member_data->full_name);
        $temp['email'] = $member_data->email_address;
        $temp['amount'] = number_format($pending->amount,2);
        $temp['plan'] = $package_data->package_name;
        $temp['date'] = $pending->date;
        $temp['mode'] = $deposit_mode->name;

        array_push($deposit_data, $temp);
      }
    }

    $data['deposit_data'] = $deposit_data;

    $this->load->view('admin/templates/header', $data);
    $this->load->view('admin/pages/pending_deposits', $data);
    $this->load->view('admin/templates/footer');
  }

  public function approve_deposit($deposit_id){

    $root_member = $this->Members->get_root();
    $deposit = $this->DepositModel->get_by_id($deposit_id);
    $member = $this->Members->get_member_by_id($deposit->member_id);

    $x = $this->ReferralModel->get_referrer($member->id);
    // print_r($x);

    if($this->ReferralModel->get_referrer($member->id)->referrer_id != 1){
      $level_1 = $this->ReferralModel->get_referrer($member->id);
      // print_r($level_1);
      $bonus_1 = $deposit->amount * 0.05;
      $bonus_1_data = array(
        'deposit_id' => $deposit->id,
        'referrer_id' => $level_1->referrer_id,
        'amount' => $bonus_1
      );
      $this->Referral_bonus_model->add($bonus_1_data);

      if($this->ReferralModel->get_referrer($level_1->referrer_id)->referrer_id != 1){
        $level_2 = $this->ReferralModel->get_referrer($level_1->referrer_id);
        // print_r($level_2);
        $bonus_2 = $deposit->amount * 0.03;
        $bonus_2_data = array(
          'deposit_id' => $deposit->id,
          'referrer_id' => $level_2->referrer_id,
          'amount' => $bonus_2
        );
        $this->Referral_bonus_model->add($bonus_2_data);

        if($this->ReferralModel->get_referrer($level_2->referrer_id)->referrer_id != 1){
          $level_3 = $this->ReferralModel->get_referrer($level_2->referrer_id);
          // print_r($level_3);
          $bonus_3 = $deposit->amount * 0.02;
          $bonus_3_data = array(
            'deposit_id' => $deposit->id,
            'referrer_id' => $level_3->referrer_id,
            'amount' => $bonus_3
          );
          $this->Referral_bonus_model->add($bonus_3_data);
        }
      }
    }

    $this->DepositModel->Approve_pending($deposit_id);

    redirect('deposits_admin', 'refresh');

  }


  public function delete_deposit($deposit_id){

    $this->DepositModel->delete_deposit($deposit_id);

    redirect('deposits_admin', 'refresh');

  }

}
