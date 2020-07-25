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
        <div class="col-md-6 account-summary-1">
          <div class="left">
            <img src="<?php echo base_url('assets/img/planactivebgside-min.png');?>" alt="">
            <div class="icon-container">
              <img src="<?php echo base_url('assets/img/plan1-min.png');?>" alt="">
            </div>
          </div>
          <div class="right">
            <div class="top-dash">
              <h1><?php echo $account_balance; ?></h1>
            </div>
            <div class="bottom1-dash">
              <h6>ACCOUNT BALANCE</h6>
            </div>
          </div>
        </div>

        <div class="col-md-6 account-summary-2">

          <div class="left">
            <img src="<?php echo base_url('assets/img/planactivebgside-min.png');?>" alt="">
            <div class="icon-container">
              <img src="<?php echo base_url('assets/img/plan2-min.png');?>" alt="">
            </div>
          </div>
          <div class="right">
            <div class="top-dash">
                <h1><?php echo $active_deposit; ?></h1>
            </div>
            <div class="bottom2">
              <h6>ACTIVE DEPOSIT</h6>
            </div>
          </div>
        </div>
      </div>

      <div class="row account-summary-row ">
        <div class="col-md-6 account-summary-3">
					<div class="dash-table-1">
						<table class="table go-table table-striped table-dark">
							<tr>
		          	<th class="table-rowheader">Pending Withdrawal: </th>
								<td><?php echo $pending_withdrawals; ?></td>
		          </tr>
							<tr>
		          	<th class="table-rowheader">Total Withdrawal: </th>
								<td><?php echo $total_withdrawals; ?></td>
		          </tr>
							<tr>
		          	<th class="table-rowheader">Total Earned: </th>
								<td><?php echo $total_growth; ?></td>
		          </tr>
						</table>
					</div>
        </div>

        <div class="col-md-6 account-summary-4">
					<div class="dash-table-1">
						<table class="table go-table table-striped table-dark">
							<tr>
		          	<th class="table-rowheader">Last Deposit: </th>
								<td><?php echo $last_deposit; ?></td>
		          </tr>
							<tr>
		          	<th class="table-rowheader">Total Deposit: </th>
								<td><?php echo $total_deposit; ?></td>
		          </tr>
							<tr>
		          	<th class="table-rowheader">Last Withdrawal: </th>
								<td><?php echo $last_withdrawal; ?></td>
		          </tr>
						</table>
					</div>
				</div>

      </div>

      <div class="row">
        <div class="col-lg-12 affiliate-row">
          <div class="card card-primary text-center affiliate-program-card">
            <div class="card-body">
              <h5 class="card-title">Referral Link</h5>
											<div class="alert alert-light">
												<a class="affiliate-alert" id="referral-link" href="my/ref/<?php echo $referral_code; ?>">
													<input type="text" value="https://energyfuels-affiliate.com/my/ref/<?php echo $referral_code; ?>" readonly id="link" class="span12"
													style="width:100%;
														text-align: center;
												    background: transparent;
												    border: none;
												    cursor: pointer;"/>
												</a>
												<button type="button" class="btn btn-info btn-sm" onclick="copyToClipboard('#link')">
												    Copy
												</button>
	                    </div>

            </div>
          </div>
        </div>
      </div>
		<?php $this->load->view('pages/prefooter'); ?>

<script type="text/javascript">
	function copyToClipboard(element) {
	    $(element).select();
	    document.execCommand("copy");
	}
</script>
