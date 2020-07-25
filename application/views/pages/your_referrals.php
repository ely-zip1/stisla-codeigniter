<div class="main-content">

	<section class="section">
		<div class="section-header section-header-custom">
			<h1>Account Overview</h1>
		</div>

		<div class="section-body">
      <div class="row ">
        <?php $this->load->view('templates/user_info'); ?>
      </div>

      <div class="row account-summary-row ">
        <div class="col-sm-4 account-summary-1">

          <div class="right">
            <div class="ref-top">
              <h1><?php echo $total_bonus; ?></h1>
            </div>
            <div class="bottom1 ref-card">
              <h6>TOTAL REFERRAL COMMISSION</h6>
            </div>
          </div>
        </div>

        <div class="col-sm-4 account-summary-1">

          <div class="right">
            <div class="ref-top">
              <h1><?php echo $total_referrals; ?></h1>
            </div>
            <div class="bottom2 ref-card">
              <h6>REFERRALS</h6>

            </div>
          </div>
        </div>

        <div class="col-sm-4 account-summary-1">

          <div class="right">
            <div class="ref-top">
              <h1><?php echo $active_referrals; ?></h1>
            </div>
            <div class="bottom3 ref-card">
              <h6>ACTIVE REFERRALS</h6>

            </div>
          </div>
        </div>
      </div>

			<div class="row deposit-row">
        <div class="col-12">
				  <div class="card bg-primary text-white text-white">
						<div class="card-header">
            	<h4>ACTIVE REFERRALS</h4>
            </div>
				    <div class="card-body table-responsive">
							<table class="table table-striped">
								<tbody>
									<tr>
										<th scope="col">Username</th>
										<th scope="col">Email</th>
										<th scope="col">Total Deposit</th>
										<th scope="col">Level</th>
									</tr>
									<?php
									if(isset($referral_list)){
									foreach ($referral_list as $row){?>
								  	<tr>
											<td><?php echo $row['username']; ?></td>
											<td><?php echo $row['email']; ?></td>
											<td><?php echo $row['total_deposit']; ?></td>
											<td><?php echo $row['level']; ?></td>
										</tr>
									<?php }}?>
								</tbody>
							</table>
						</div>
				  </div>
        </div>
      </div>

			<div class="row deposit-row">
        <div class="col-12">
				  <div class="card bg-primary text-white text-white">
						<div class="card-header">
            	<h4>INACTIVE REFERRALS</h4>
            </div>
				    <div class="card-body table-responsive">
							<table class="table table-striped">
								<tbody>
									<tr>
										<th scope="col">Username</th>
										<th scope="col">Email</th>
										<th scope="col">Level</th>
									</tr>
									<?php
									if(isset($inactive_referral_list)){
									foreach ($inactive_referral_list as $row){?>
								  	<tr>
											<td><?php echo $row['username']; ?></td>
											<td><?php echo $row['email']; ?></td>
											<td><?php echo $row['level']; ?></td>
										</tr>
									<?php }}?>
								</tbody>
							</table>
						</div>
				  </div>
        </div>
      </div>


		<?php $this->load->view('pages/prefooter'); ?>
