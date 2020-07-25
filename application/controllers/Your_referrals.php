<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Your_referrals extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();

    $this->load->model('DepositModel');
    $this->load->model('Members');
    $this->load->model('Deposit_Options');
    $this->load->model('PackageModel');
    $this->load->model('ReferralModel');
    $this->load->model('Referral_bonus_model');
  }

  public function index()
  {
    $data['title'] = 'Referrals';

    $member = $this->Members->get_member($this->session->username);
    $level_1_list = $this->ReferralModel->get_referees($member->id);
    // print_r($level_1_list);
    $referral_bonus = $this->Referral_bonus_model->get_total_bonus($member->id);

    $total_downline = 0;
    $total_active = 0;

    $referral_list = array();
    $inactive_referral_list = array();

    foreach ($level_1_list as $level_1) {
      $total_downline++;
        if($this->Members->get_member_by_id($level_1->referee_id) != null){

          $referral1 = array();

          $level_1_data = $this->Members->get_member_by_id($level_1->referee_id);

          if($this->DepositModel->has_active_deposit($level_1->referee_id)){
            $total_active++;

            $total_deposit_1 = $this->DepositModel->get_total_deposit($level_1->referee_id);

            $referral1['username'] = $level_1_data->username;
            $referral1['email'] = $level_1_data->email_address;
            $referral1['total_deposit'] = '$ '.number_format($total_deposit_1->amount, '2', '.', ',');
            $referral1['level'] = 'Level 1';

            array_push($referral_list, $referral1);
          }
          else{
            $referral1['username'] = $level_1_data->username;
            $referral1['email'] = $level_1_data->email_address;
            $referral1['level'] = 'Level 1';

            array_push($inactive_referral_list, $referral1);
          }
        }

        if($this->ReferralModel->count_referrals($level_1->referee_id) > 0){
          $level_2_list = $this->ReferralModel->get_referees($level_1->referee_id);
          // print_r($level_2_list);

          foreach ($level_2_list as $level_2) {
            $total_downline++;

              if($this->Members->get_member_by_id($level_2->referee_id) != null){

                $referral2 = array();

                $level_2_data = $this->Members->get_member_by_id($level_2->referee_id);

                if($this->DepositModel->has_active_deposit($level_2->referee_id)){
                  $total_active++;

                  $total_deposit_2 = $this->DepositModel->get_total_deposit($level_2->referee_id);

                  $referral2['username'] = $level_2_data->username;
                  $referral2['email'] = $level_2_data->email_address;
                  $referral2['total_deposit'] = '$ '.number_format($total_deposit_2->amount, '2', '.', ',');
                  $referral2['level'] = 'Level 2';

                  array_push($referral_list, $referral2);
                }
                else{
                  $referral2['username'] = $level_2_data->username;
                  $referral2['email'] = $level_2_data->email_address;
                  $referral2['level'] = 'Level 2';

                  array_push($inactive_referral_list, $referral2);
                }
              }

              if($this->ReferralModel->count_referrals($level_2->referee_id) > 0){
                $level_3_list = $this->ReferralModel->get_referees($level_2->referee_id);
                // print_r($level_3_list);

                foreach ($level_3_list as $level_3) {
                  $total_downline++;

                    if($this->Members->get_member_by_id($level_3->referee_id) != null){

                      $referral3 = array();

                      $level_3_data = $this->Members->get_member_by_id($level_3->referee_id);



                      if($this->DepositModel->has_active_deposit($level_3->referee_id)){
                        $total_active++;

                        $total_deposit_3 = $this->DepositModel->get_total_deposit($level_3->referee_id);

                        $referral3['username'] = $level_3_data->username;
                        $referral3['email'] = $level_3_data->email_address;
                        $referral3['total_deposit'] = '$ '.number_format($total_deposit_3->amount, '2', '.', ',');
                        $referral3['level'] = 'Level 3';

                        array_push($referral_list, $referral3);
                      }
                      else{
                        $referral3['username'] = $level_3_data->username;
                        $referral3['email'] = $level_3_data->email_address;
                        $referral3['level'] = 'Level 3';

                        array_push($inactive_referral_list, $referral3);
                      }
                    }
                  }
                }
              }
            }
          }

    $data['referral_list'] = $referral_list;

    $data['inactive_referral_list'] = $inactive_referral_list;

    // print_r($referral_list);
    // print_r($inactive_referral_list);

    $data['total_bonus'] = '$'. number_format($referral_bonus, '2', '.', ',');
    $data['total_referrals'] = $total_downline;
    $data['active_referrals'] = $total_active;

    $this->load->view('templates/header', $data);
    $this->load->view('pages/your_referrals', $data);
    $this->load->view('templates/footer');
  }

  public function list_referrals($member_id, $level){
    $referees = $this->ReferralModel->get_referees($member_id);

    $list = array();

    foreach ($referees as $referee) {
      $referral = array();

      $referee_data = $this->Members->get_member_by_id($referee->referee_id);
      $total_deposit = $this->DepositModel->get_total_deposit($referee->referee_id);

      $referral['username'] = $referee_data->username;
      $referral['email'] = $referee_data->email_address;
      $referral['total_deposit'] = $total_deposit->amount;
      $referral['level'] = $level;

      array_push($list, $referral);
    }

    return $list;
  }

}
