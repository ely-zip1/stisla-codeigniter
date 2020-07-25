<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Plans extends CI_Controller
{
	public function __construct()
        {
            parent::__construct();
						$this->load->model('PackageModel');
						$this->load->model('DepositModel');
						$this->load->model('Members');
						$this->load->model('Deposit_Options');
						$this->load->model('WithdrawalModel');
						$this->load->model('Referral_bonus_model');
						$this->load->model('Fund_transfer_model');
						$this->load->model('ReferralModel');

            date_default_timezone_set('Asia/Manila');
        }

	public function index()
	{
		$data = array(
			'title' => "Plans"
		);

		// if($_POST != null){
		// 	print_r($_POST);
		// }
		$packages = $this->PackageModel->get_packages();

		$data['plan1'] = strtoupper($packages[0]->package_name);
		$data['plan2'] = strtoupper($packages[1]->package_name);
		$data['plan3'] = strtoupper($packages[2]->package_name);

		$modes_of_payment = $this->Deposit_Options->get_all();

		$data['mode1'] = ucfirst($modes_of_payment[0]->name);
		$data['mode2'] = ucfirst($modes_of_payment[1]->name);
		$data['mode3'] = ucfirst($modes_of_payment[2]->name);
		$data['mode4'] = ucfirst($modes_of_payment[3]->name);
		$data['mode5'] = ucfirst($modes_of_payment[4]->name);
		$data['mode6'] = ucfirst($modes_of_payment[5]->name);


		$data['selected_plan'] = 'plan1';
		$data['selected_mode'] = 'mode1';

		$member_data = $this->Members->get_member($this->session->username);

		$total_growth = $this->DepositModel->get_total_growth($member_data->id);
    $total_withdrawn = $this->WithdrawalModel->compute_total_withdrawn ($member_data->id);
    $total_bonus = $this->Referral_bonus_model->get_total_bonus($member_data->id);
		$total_reinvestment = $this->DepositModel->get_total_member_reinvestment($member_data->id);
    $total_sent = $this->Fund_transfer_model->get_total_sent($member_data->id);
    $total_received = $this->Fund_transfer_model->get_total_received($member_data->id);

    $account_balance = ($total_growth + $total_bonus + $total_received) - $total_withdrawn - $total_reinvestment->amount - $total_sent;

		$data['account_balance'] = number_format($account_balance, 2, '.', ',');

		$this->form_validation->set_rules('chosen_plan', 'Plan', 'required');
		$this->form_validation->set_rules('plan_payment_mode', 'Payment Mode', 'required');
		$this->form_validation->set_rules('deposit_amount', 'Deposit Amount', 'required|regex_match[/^(\d*\.)?\d+$/]|callback_valid_deposit|callback_validate_reinvestment');

		if ($this->form_validation->run() == FALSE) {
			if(isset($_POST['chosen_plan'])){
				$data['selected_plan'] = $_POST['chosen_plan'];
				$data['selected_mode'] = $_POST['plan_payment_mode'];
			}

			$this->load->view('templates/header', $data);
			$this->load->view('pages/plans', $data);
			$this->load->view('templates/footer');
		}
		else {
			$deposit_data = array();

			$deposit_data['member_id'] = $member_data->id;
			$deposit_data['date'] = date('Y-m-d H:i:s');
			$deposit_data['amount'] = $_POST['deposit_amount'];

			if($_POST['chosen_plan'] == 'plan1'){
				$deposit_data['package_id'] = '1';
				$data['deposit_selected_plan'] = strtoupper($packages[0]->package_name);
			}else if($_POST['chosen_plan'] == 'plan2'){
				$deposit_data['package_id'] = '2';
				$data['deposit_selected_plan'] = strtoupper($packages[1]->package_name);
			}else if($_POST['chosen_plan'] == 'plan3'){
				$deposit_data['package_id'] = '3';
				$data['deposit_selected_plan'] = strtoupper($packages[2]->package_name);
			}

			if($_POST['plan_payment_mode'] == 'mode1'){
				$deposit_data['deposit_options_id'] = '1';
				$data['deposit_payment_mode'] = strtoupper($modes_of_payment[0]->name);
				$data['deposit_address'] = $modes_of_payment[0]->account;
			}
			else if($_POST['plan_payment_mode'] == 'mode2'){
				$deposit_data['deposit_options_id'] = '2';
				$data['deposit_payment_mode'] = strtoupper($modes_of_payment[1]->name);
				$data['deposit_address'] = $modes_of_payment[1]->account;
			}
			else if($_POST['plan_payment_mode'] == 'mode3'){
				$deposit_data['deposit_options_id'] = '3';
				$data['deposit_payment_mode'] = strtoupper($modes_of_payment[2]->name);
				$data['deposit_address'] = $modes_of_payment[2]->account;
			}
			else if($_POST['plan_payment_mode'] == 'mode4'){
				$deposit_data['deposit_options_id'] = '4';
				$data['deposit_payment_mode'] = strtoupper($modes_of_payment[3]->name);
				$data['deposit_address'] = $modes_of_payment[3]->account;
			}
			else if($_POST['plan_payment_mode'] == 'mode5'){
				$deposit_data['deposit_options_id'] = '5';
				$data['deposit_payment_mode'] = strtoupper($modes_of_payment[4]->name);
				$data['deposit_address'] = $modes_of_payment[4]->account;
			}
			else if($_POST['plan_payment_mode'] == 'mode6'){
				$deposit_data['deposit_options_id'] = '6';
				$data['deposit_payment_mode'] = strtoupper($modes_of_payment[5]->name);
				$data['deposit_address'] = $modes_of_payment[5]->account;
			}
			else if($_POST['plan_payment_mode'] == 'mode7'){
				$deposit_data['deposit_options_id'] = $modes_of_payment[6]->id;
				$data['deposit_payment_mode'] = strtoupper($modes_of_payment[6]->name);
				$data['deposit_address'] = $modes_of_payment[6]->account;
			}

			if($_POST['plan_payment_mode'] == 'mode7'){
				$deposit_data['is_pending'] = '0';
				$deposit_data['date_approved'] = date('Y-m-d H:i:s');
			}else{
				$deposit_data['is_pending'] = '1';
			}

			$this->DepositModel->add_deposit($deposit_data);


			if($_POST['plan_payment_mode'] == 'mode7'){
				$last_deposit = $this->DepositModel->get_latest_deposit($member_data->id);
				$this->credit_referral_bonus($last_deposit->id);
			}

			redirect('deposit_details', 'refresh');
		}
	}

	function valid_deposit(){

		if($_POST['chosen_plan'] == 'plan1'){
			if($_POST['deposit_amount'] >= 60 && $_POST['deposit_amount'] <= 999){
				return true;
			}else {
    		$this->form_validation->set_message('valid_deposit', 'Deposit Amount does not match your selected plan.');
				return false;
			}
		}
		else if($_POST['chosen_plan'] == 'plan2'){
			if($_POST['deposit_amount'] >= 1000 && $_POST['deposit_amount'] <= 5999){
				return true;
			}else {
    		$this->form_validation->set_message('valid_deposit', 'Deposit Amount does not match your selected plan.');
				return false;
			}
		}
		else if($_POST['chosen_plan'] == 'plan3'){
			if($_POST['deposit_amount'] >= 6000 && $_POST['deposit_amount'] <= 9999){
				return true;
			}else {
    		$this->form_validation->set_message('valid_deposit', 'Deposit Amount does not match your selected plan.');
				return false;
			}
		}

	}

	public function validate_reinvestment(){
		if($_POST['plan_payment_mode'] == 'mode7'){
			$member_data = $this->Members->get_member($this->session->username);

			$total_growth = $this->DepositModel->get_total_growth($member_data->id);
	    $total_withdrawn = $this->WithdrawalModel->compute_total_withdrawn ($member_data->id);
	    $total_bonus = $this->Referral_bonus_model->get_total_bonus($member_data->id);
			$total_reinvestment = $this->DepositModel->get_total_member_reinvestment($member_data->id);
	    $total_sent = $this->Fund_transfer_model->get_total_sent($member_data->id);
	    $total_received = $this->Fund_transfer_model->get_total_received($member_data->id);

	    $account_balance = ($total_growth + $total_bonus + $total_received) - $total_withdrawn - $total_reinvestment->amount - $total_sent;

			if($_POST['chosen_plan'] == 'plan1'){
				if($_POST['deposit_amount'] >= 60 && $_POST['deposit_amount'] <= 999){
					if($account_balance < 60){
						$this->form_validation->set_message('validate_reinvestment', 'Insufficient Account Balance.');
						return false;
					}else{
						return true;
					}
				}else {
	    		$this->form_validation->set_message('validate_reinvestment', 'Reinvestment Amount does not match your selected plan.');
					return false;
				}
			}
			else if($_POST['chosen_plan'] == 'plan2'){
				if($_POST['deposit_amount'] >= 1000 && $_POST['deposit_amount'] <= 5999){
					if($account_balance < 1000){
						$this->form_validation->set_message('validate_reinvestment', 'Insufficient Account Balance.');
						return false;
					}else{
						return true;
					}
				}else {
	    		$this->form_validation->set_message('validate_reinvestment', 'Reinvestment Amount does not match your selected plan.');
					return false;
				}
			}
			else if($_POST['chosen_plan'] == 'plan3'){
				if($_POST['deposit_amount'] >= 6000 && $_POST['deposit_amount'] <= 9999){
					if($account_balance < 6000){
						$this->form_validation->set_message('validate_reinvestment', 'Insufficient Account Balance.');
						return false;
					}else{
						return true;
					}
				}else {
	    		$this->form_validation->set_message('validate_reinvestment', 'Reinvestment Amount does not match your selected plan.');
					return false;
				}
			}else{
				return true;
			}
		}else{
			return true;
		}
	}

	public function credit_referral_bonus($deposit_id){

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
        $bonus_2 = $deposit->amount * 0.01;
        $bonus_2_data = array(
          'deposit_id' => $deposit->id,
          'referrer_id' => $level_2->referrer_id,
          'amount' => $bonus_2
        );
        $this->Referral_bonus_model->add($bonus_2_data);

        if($this->ReferralModel->get_referrer($level_2->referrer_id)->referrer_id != 1){
          $level_3 = $this->ReferralModel->get_referrer($level_2->referrer_id);
          // print_r($level_3);
          $bonus_3 = $deposit->amount * 0.01;
          $bonus_3_data = array(
            'deposit_id' => $deposit->id,
            'referrer_id' => $level_3->referrer_id,
            'amount' => $bonus_3
          );
          $this->Referral_bonus_model->add($bonus_3_data);
        }
      }
    }

  }

}
