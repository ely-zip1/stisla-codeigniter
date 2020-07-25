<div class="main-content">
  <section class="section">
    <div class="section-header section-header-custom">
      <h1>Account Settings</h1>
    </div>
    <div class="section-body">
      <div class="row ">
        <?php $this->load->view('templates/user_info'); ?>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="edit-account-table">
            <table>
              <tbody>
                <tr>
                  <td>Account name: </td>
                  <th><?php echo $account_name; ?></th>
                </tr>
                <tr>
                  <td>Registration date: </td>
                  <th><?php echo $date_registered; ?></th>
                </tr>
                <tr>
                  <td>Email address: </td>
                  <th><?php echo $email_address; ?></th>
                </tr>
                <tr>
                  <td>Full name: </td>
                  <th><?php echo $full_name; ?></th>
                </tr>
              </tbody>
            </table>
            <?php
            if(isset($this->session->error)){
              echo '<div class="alert alert-danger alert-dismissible show fade">
                      <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                          <span>×</span>
                        </button>
                        '.$this->session->error.'
                      </div>
                    </div>';
            }

            ?>

            <?php echo form_open_multipart('upload/do_upload');?>

            <input class="btn" type="file" name="userfile" size="20" style="margin-right:20px;"/>

            <input class="btn btn-lg rounded-button" type="submit" value="Upload" style="margin:20px;"/>

            </form>
          </div>
        </div>
				<div class="col-md-6">
					<div class="reset-password">
						<div class="alert alert-success alert-dismissible"
							<?php if(!isset($password_update_success)){echo 'style="display: none;"';} ?>>
							<div class="alert-body">
								<button class="close" data-dismiss="alert">
								<span>×</span>
								</button>
								Password has been updated.
							</div>
						</div>
						<?php echo form_open('account_settings'); ?>
						<!-- <form action="/action_page.php" method="get"> -->
						<div class="form-group">
							<label for="new_password" class="form-label">New Password</label>
							<input type="password" name="new_password"
								class="form-control <?php if(strlen(form_error('new_password')) > 0){echo "is-invalid";} ?>" autofocus>
							<div class="invalid-feedback">
								<?php echo form_error('new_password');?>
							</div>
						</div>
						<div class="form-group">
							<label for="confirm_new_password" class="form-label">Confirm New Password</label>
							<input type="password" name="confirm_new_password" value=""
								class="form-control <?php if(strlen(form_error('confirm_new_password')) > 0){echo "is-invalid";} ?>">
							<div class="invalid-feedback">
								<?php echo form_error('confirm_new_password');?>
							</div>
						</div>
						<div class="form-group text-right">
							<button type="submit" class="btn btn-primary btn-lg rounded-button" name="account_submit" value="reset_password"
								tabindex="4">
							Update
							</button>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
      </div>

			<div class="row">

				<?php echo form_open('account_settings'); ?>

				<div class="col-md-12 user-account-form">
					<div class="row">
						<div class="col-12">
							<h2 class="section-title">Bank Account</h2>
							<div class="form-row">
								<div class="form-group col-md-4">
		              <label for="bank_name">Bank Name
		              </label>
		              <input id="bank_name" type="text" value="<?php if(set_value('bank_name','',true) == null){echo $bank_name;}else{ echo set_value('bank_name','',true);}?>"
		                     class="form-control <?php if(strlen(form_error('bank_name')) > 0){echo "is-invalid";} ?>" name="bank_name"
		                     autofocus />
		              <div class="invalid-feedback">
		                <?php echo form_error('bank_name');?>
		              </div>
		            </div>
								<div class="form-group col-md-4">
		              <label for="bank_account_name">Account Name
		              </label>
		              <input id="bank_account_name" type="text" value="<?php if(set_value('bank_account_name','',true) == null){echo $bank_account_name;}else{ echo set_value('bank_account_name','',true);}?>"
		                     class="form-control <?php if(strlen(form_error('bank_account_name')) > 0){echo "is-invalid";} ?>" name="bank_account_name"
		                     autofocus />
		              <div class="invalid-feedback">
		                <?php echo form_error('bank_account_name');?>
		              </div>
		            </div>
								<div class="form-group col-md-4">
		              <label for="bank_account_number">Account Number
		              </label>
		              <input id="bank_account_number" type="text" value="<?php if(set_value('bank_account_number','',true) == null){echo $bank_account_number;}else{ echo set_value('bank_account_number','',true);}?>"
		                     class="form-control <?php if(strlen(form_error('bank_account_number')) > 0){echo "is-invalid";} ?>" name="bank_account_number"
		                     autofocus />
		              <div class="invalid-feedback">
		                <?php echo form_error('bank_account_number');?>
		              </div>
		            </div>
              </div>
						</div>
						<div class="col-md-12 text-right">
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-lg rounded-button" name="account_submit" value="bank"
									tabindex="4">
									Update
								</button>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
							<h2 class="section-title">Bitcoin</h2>
							<div class="form-group">
								<label for="bitcoin_account">Bitcoin Account
								</label>
								<input id="bitcoin_account" type="text" value="<?php if(set_value('bitcoin_account','',true) == null){echo $bitcoin_account;}else{ echo set_value('bitcoin_account','',true);}?>"
											 class="form-control <?php if(strlen(form_error('bitcoin_account')) > 0){echo "is-invalid";} ?>" name="bitcoin_account"
											 autofocus />
								<div class="invalid-feedback">
									<?php echo form_error('bitcoin_account');?>
								</div>
							</div>
							<div class="col-md-12 text-right">
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-lg rounded-button" name="account_submit" value="bitcoin"
										tabindex="4">
										Update
									</button>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<h2 class="section-title">Ethereum</h2>
							<div class="form-group">
								<label for="ethereum_account">Ethereum Account
								</label>
								<input id="ethereum_account" type="text" value="<?php if(set_value('ethereum_account','',true) == null){echo $ethereum_account;}else{ echo set_value('ethereum_account','',true);}?>"
											 class="form-control <?php if(strlen(form_error('ethereum_account')) > 0){echo "is-invalid";} ?>" name="ethereum_account"
											 autofocus />
								<div class="invalid-feedback">
									<?php echo form_error('ethereum_account');?>
								</div>
							</div>
							<div class="col-md-12 text-right">
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-lg rounded-button" name="account_submit" value="ethereum"
										tabindex="4">
										Update
									</button>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<h2 class="section-title">Paypal</h2>
							<div class="form-group">
								<label for="paypal_account">Paypal Account
								</label>
								<input id="paypal_account" type="text" value="<?php if(set_value('paypal_account','',true) == null){echo $paypal_account;}else{ echo set_value('paypal_account','',true);}?>"
											 class="form-control <?php if(strlen(form_error('paypal_account')) > 0){echo "is-invalid";} ?>" name="paypal_account"
											 autofocus />
								<div class="invalid-feedback">
									<?php echo form_error('paypal_account');?>
								</div>
							</div>
							<div class="col-md-12 text-right">
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-lg rounded-button" name="account_submit" value="paypal"
										tabindex="4">
										Update
									</button>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<h2 class="section-title">Abra</h2>
							<div class="form-group">
								<label for="abra_account">Abra Account
								</label>
								<input id="abra_account" type="text" value="<?php if(set_value('abra_account','',true) == null){echo $abra_account;}else{ echo set_value('abra_account','',true);}?>"
											 class="form-control <?php if(strlen(form_error('abra_account')) > 0){echo "is-invalid";} ?>" name="abra_account"
											 autofocus />
								<div class="invalid-feedback">
									<?php echo form_error('abra_account');?>
								</div>
							</div>
							<div class="col-md-12 text-right">
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-lg rounded-button" name="account_submit" value="abra"
										tabindex="4">
										Update
									</button>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<h2 class="section-title">Neteller</h2>
							<div class="form-group">
								<label for="neteller_account">Neteller Account
								</label>
								<input id="neteller_account" type="text" value="<?php if(set_value('neteller_account','',true) == null){echo $neteller_account;}else{ echo set_value('neteller_account','',true);}?>"
											 class="form-control <?php if(strlen(form_error('neteller_account')) > 0){echo "is-invalid";} ?>" name="neteller_account"
											 autofocus />
								<div class="invalid-feedback">
									<?php echo form_error('neteller_account');?>
								</div>
							</div>
							<div class="col-md-12 text-right">
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-lg rounded-button" name="account_submit" value="neteller"
										tabindex="4">
										Update
									</button>
								</div>
							</div>
						</div>

						<div class="col-md-6">
							<h2 class="section-title">Advcash</h2>
							<div class="form-group">
								<label for="advcash_account">Advcash Account
								</label>
								<input id="advcash_account" type="text" value="<?php if(set_value('advcash_account','',true) == null){echo $advcash_account;}else{ echo set_value('advcash_account','',true);}?>"
											 class="form-control <?php if(strlen(form_error('advcash_account')) > 0){echo "is-invalid";} ?>" name="advcash_account"
											 autofocus />
								<div class="invalid-feedback">
									<?php echo form_error('advcash_account');?>
								</div>
							</div>
							<div class="col-md-12 text-right">
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-lg rounded-button" name="account_submit" value="advcash"
										tabindex="4">
										Update
									</button>
								</div>
							</div>
						</div>



					</div>
				</div>


				<?php echo form_close(); ?>
			</div>

    <?php $this->load->view('pages/prefooter'); ?>
