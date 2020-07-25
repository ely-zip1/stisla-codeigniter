<div class="main-content">

	<section class="section">
		<div class="section-header section-header-custom">
			<h1>Make a Deposit</h1>
		</div>
    <div class="section-body">
      <div class="row ">
        <?php $this->load->view('templates/user_info'); ?>
      </div>

      <div class="row deposit-row">
        <div class="col-12">
          <div class="card bg-primary text-white">
            <div class="card-header">
              <h4>Account Balance:  $ <?php echo $account_balance; ?></h4>
            </div>
              <div class="card-body">
                <h6>Pending Withdrawals:  $ <?php echo $pending_withdrawal; ?></h6>
              </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="alert alert-info alert-has-icon">
            <div class="alert-icon"><i class="far fa-lightbulb"></i></div>
            <div class="alert-body">
            <div class="alert-title">
              All withdrawals are subject to 5% processing fee.<br>
							Withdrawal Request Cut off time 7:00 p.m (GMT -6)
            </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <div class="card bg-primary text-white">
              <div class="card-body">
                <div class="row">
          				<div class="col-md-12">
          					<?php echo form_open('withdraw'); ?>
          					<div class="form-row">
          						<div class="form-group col-md-5 deposit-form">
          							<label for="plan_option">Mode</label>
          							<select class="form-control" name="plan_payment_mode">
                          <option <?php if($selected_mode == 'mode1') {echo 'selected';} ?> value="mode1">Bank</option>
          								<option <?php if($selected_mode == 'mode2') {echo 'selected';} ?> value="mode2">Bitcoin</option>
          								<option <?php if($selected_mode == 'mode3') {echo 'selected';} ?> value="mode3">Ethereum</option>
          								<option <?php if($selected_mode == 'mode4') {echo 'selected';} ?> value="mode4">Abra</option>
          								<option <?php if($selected_mode == 'mode5') {echo 'selected';} ?> value="mode5">Paypal</option>
          								<option <?php if($selected_mode == 'mode6') {echo 'selected';} ?> value="mode6">Neteller</option>
          								<option <?php if($selected_mode == 'mode7') {echo 'selected';} ?> value="mode7">Advcash</option>
          							</select>
          							<div class="invalid-feedback">
          										<?php echo form_error('plan_payment_mode');?>
          							</div>
                      </div>

                      <div class="form-group col-md-5 deposit-form">
          	            <label for="withdraw_amount">Amount</label>
          	            <input type="text" class="form-control <?php if(strlen(form_error('withdraw_amount')) > 0){echo "is-invalid";} ?>"
          								name="withdraw_amount" id="deposit-amount" placeholder="Amount" value="<?php set_value('withdraw_amount','',true); ?>">
          							<div class="invalid-feedback deposit-error">
          										<?php echo form_error('withdraw_amount');?>
          							</div>
                      </div>

                      <div class="form-group col-md-2">
            	          <label for="deposit_amount" style="visibility: hidden;">Submit</label>
              					<button type="submit" class="btn btn-block btn-lg btn-dark" <?php if(isset($withdrawable)) echo 'disabled'; ?> name="deposit-submit-button">Withdraw</button>
              					<?php echo form_close(); ?>
              				</div>
                    </div>

          				</div>
          			</div>
              </div>
          </div>
        </div>
      </div>

      <div class="row deposit-row">
        <div class="col-12">
				  <div class="card bg-primary text-white text-white">
						<div class="card-header">
            	<h4>WITHDRAWAL HISTORY</h4>
            </div>
				    <div class="card-body table-responsive">
							<table class="table table-striped">
								<tbody>
									<tr>
										<th scope="col">Amount</th>
										<th scope="col">Mode</th>
										<th scope="col">Date Created</th>
										<th scope="col">Status</th>
									</tr>
									<?php
									if(isset($withdrawal_history)){
									foreach ($withdrawal_history as $row){?>
								  	<tr>
											<td>$ <?php echo $row['amount']; ?></td>
											<td><?php echo $row['mode']; ?></td>
											<td><?php echo $row['date']; ?></td>
											<td><?php echo $row['status']; ?></td>
										</tr>
									<?php }}?>
								</tbody>
							</table>
						</div>
				  </div>
        </div>
      </div>


    <?php $this->load->view('pages/prefooter'); ?>
