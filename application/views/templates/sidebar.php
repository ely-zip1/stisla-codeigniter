<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="main-sidebar shadow text-white" style="background:#3E6CC7;">
	<aside id="sidebar-wrapper">
		<div class="sidebar-brand">
			  <a href="<?= base_url();?>"><img src="<?= base_url();?>assets/img/ef-logo.png" alt="logo" width="90"></a>
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			  <a href="<?= base_url();?>"><img src="<?= base_url();?>assets/img/ef-logo-icon.png" alt="logo" width="40"></a>
		</div>
		<ul class="sidebar-menu">
			<!-- <li class="menu-header">Dashboard</li> -->
			<li class="dropdown <?php echo $this->uri->segment(1) == 'dashboard' ? 'active' : ''; ?>"> <a
					href="<?= base_url();?>dashboard" class="nav-link"><i class="fas fa-home"></i><span>Cash Flow</span></a>
			</li>
			<li class="dropdown <?php echo $this->uri->segment(1) == 'plans' ? 'active' : ''; ?>"> <a
					href="<?= base_url();?>plans" class="nav-link"><i class="fas fa-piggy-bank"></i><span>Purchase Package</span></a>
			</li>
			<li class="dropdown <?php echo $this->uri->segment(1) == 'account_settings' ? 'active' : ''; ?>"> <a
					href="<?= base_url();?>account_settings" class="nav-link"><i class="fas fa-edit"></i><span>Personalize My Account</span></a>
			</li>
			<li class="dropdown <?php echo $this->uri->segment(1) == 'your_deposits' ? 'active' : ''; ?>"> <a
					href="<?= base_url();?>your_deposits" class="nav-link"><i class="fas fa-dollar-sign"></i><span>Transaction History</span></a>
			</li>
			<li class="dropdown <?php echo $this->uri->segment(1) == 'withdraw' ? 'active' : ''; ?>"> <a
					href="<?= base_url();?>withdraw" class="nav-link"><i class="fas fa-money-check-alt"></i><span>Withdraw Available Funds</span></a>
			</li>
			<!-- <li class="dropdown <?php echo $this->uri->segment(1) == 'earning_history' ? 'active' : ''; ?>"> <a
					href="earning_history" class="nav-link"><i class="fas fa-money-bill-wave-alt"></i><span>Earning History</span></a>
			</li>
			<li class="dropdown <?php echo $this->uri->segment(1) == 'referral_history' ? 'active' : ''; ?>"> <a
					href="withdraw" class="nav-link"><i class="fas fa-user-clock"></i><span>Referrals History</span></a>
			</li>
			<li class="dropdown <?php echo $this->uri->segment(1) == 'withdrawal_history' ? 'active' : ''; ?>"> <a
					href="withdrawal_history" class="nav-link"><i class="fas fa-money-bill"></i><span>Withdrawals History</span></a> -->
			<!-- </li> -->

			<li class="dropdown <?php echo $this->uri->segment(1) == 'your_referrals' ? 'active' : ''; ?>"> <a
					href="<?= base_url();?>your_referrals" class="nav-link"><i class="fas fa-comments-dollar"></i><span>My Affiliates</span></a>
			</li>
			<li class="dropdown <?php echo $this->uri->segment(1) == 'fund_transfer' ? 'active' : ''; ?>"> <a
					href="<?= base_url();?>fund_transfer" class="nav-link"><i class="fas fa-exchange-alt"></i><span>Peer to Peer Transfer</span></a>
			</li>
		</ul>
	</aside>
</div>
