<div class="main-content">

	<section class="section">
		<div class="section-header section-header-custom">
			<h1>Your Deposits</h1>
		</div>
    <div class="section-body">
      <div class="row ">
        <?php $this->load->view('templates/user_info'); ?>
      </div>

      <div class="row deposit-row">
        <div class="col-12">
					<div class="card bg-info text-white">
				    <div class="card-header">
							<h4>Total Deposit: <?php echo $total_details; ?></h4>
						</div>
				  </div>
        </div>
      </div>

      <div class="row deposit-row">
        <div class="col-12">
				  <div class="card bg-primary text-white text-white">
						<div class="card-header">
            	<h4>ULTRAMAX PLAN</h4>
            </div>
				    <div class="card-body table-responsive">
							<table class="table table-hover table-striped table-sm">
								<thead>
									<tr>
										<th scope="col">Amount</th>
										<th scope="col">Payment Mode</th>
										<th scope="col">Send to</th>
										<th scope="col">Date Created</th>
										<th scope="col">Status</th>
										<th scope="col">Remaining days</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if(isset($ultramax_deposit_data)){
									foreach ($ultramax_deposit_data as $row){?>
								  	<tr>
											<td>$ <?php echo $row['amount']; ?></td>
											<td><?php echo $row['mode']; ?></td>
											<td><?php echo $row['send_to']; ?></td>
											<td><?php echo $row['date']; ?></td>
											<td><?php echo $row['status']; ?></td>
											<td><?php echo $row['days_remaining']; ?></td>
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
            	<h4>PANAMAX PLAN</h4>
            </div>
				    <div class="card-body table-responsive">
							<table class="table table-hover table-striped table-sm">
								<thead>
									<tr>
										<th scope="col">Amount</th>
										<th scope="col">Payment Mode</th>
										<th scope="col">Send to</th>
										<th scope="col">Date Created</th>
										<th scope="col">Status</th>
										<th scope="col">Remaining days</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if(isset($panamax_deposit_data)){
									foreach ($panamax_deposit_data as $row){?>
								  	<tr>
											<td>$ <?php echo $row['amount']; ?></td>
											<td><?php echo $row['mode']; ?></td>
											<td><?php echo $row['send_to']; ?></td>
											<td><?php echo $row['date']; ?></td>
											<td><?php echo $row['status']; ?></td>
											<td><?php echo $row['days_remaining']; ?></td>
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
				  <div class="card bg-primary text-white">
						<div class="card-header">
            	<h4>CAPESIZE PLAN</h4>
            </div>
				    <div class="card-body table-responsive">
							<table class="table table-hover table-striped table-sm">
								<thead>
									<tr>
										<th scope="col">Amount</th>
										<th scope="col">Payment Mode</th>
										<th scope="col">Send to</th>
										<th scope="col">Date Created</th>
										<th scope="col">Status</th>
										<th scope="col">Remaining days</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if(isset($capesize_deposit_data)){
									foreach ($capesize_deposit_data as $row){?>
								  	<tr>
											<td>$ <?php echo $row['amount']; ?></td>
											<td><?php echo $row['mode']; ?></td>
											<td><?php echo $row['send_to']; ?></td>
											<td><?php echo $row['date']; ?></td>
											<td><?php echo $row['status']; ?></td>
											<td><?php echo $row['days_remaining']; ?></td>
										</tr>
									<?php }}?>
								</tbody>
							</table>
						</div>
				  </div>
        </div>
      </div>

    <?php $this->load->view('pages/prefooter'); ?>
