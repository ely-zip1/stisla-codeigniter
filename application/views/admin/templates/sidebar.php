<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<div class="main-sidebar sidebar-style-2 shadow sidebar">
	<aside id="sidebar-wrapper">

		<div class="sidebar-brand">
			<a href="<?= base_url('deposits_admin');?>">Energy Fuels</a>
			  <!-- <a href="<?= base_url();?>AdminDashboard"><img src="<?= base_url();?>assets/img/MPD_Logo_blue.png" alt="logo" width="150"></a> -->
		</div>
		<div class="sidebar-brand sidebar-brand-sm">
			<a href="<?= base_url('deposits_admin');?>">EF</a>
			  <!-- <a href="<?= base_url();?>AdminDashboard"><img src="<?= base_url();?>assets/img/MPD_Logo_small_blue.png" alt="logo" width="40"></a> -->
		</div>

		<ul class="sidebar-menu">

      <li class="menu-header">Deposit</li>
			<li class="dropdown <?php echo $this->uri->segment(1) == 'deposits_admin' ? 'active' : ''; ?>"> <a
					href="<?= base_url();?>deposits_admin" class="nav-link"><i
						class="far fa-clock"></i><span>Pending Deposits</span></a>
			</li>
			<li class="dropdown <?php echo $this->uri->segment(1) == 'approved_deposits' ? 'active' : ''; ?>"> <a
					href="<?= base_url();?>approved_deposits" class="nav-link"><i
						class="far fa-check-circle"></i><span>Approved Deposits</span></a>
			</li>

      <li class="menu-header">Withdrawal</li>
			<li class="dropdown <?php echo $this->uri->segment(1) == 'withdrawals_admin' ? 'active' : ''; ?>"> <a
					href="<?= base_url();?>withdrawals_admin" class="nav-link"><i
						class="fas fa-clock"></i><span>Pending Withdrawals</span></a>
			</li>
			<li class="dropdown <?php echo $this->uri->segment(1) == 'approved_withdrawals' ? 'active' : ''; ?>"> <a
					href="<?= base_url();?>approved_withdrawals" class="nav-link"><i
						class="fas fa-check-circle"></i><span>Approved Withdrawals</span></a>
			</li>

      <li class="menu-header">User</li>
			<li class="dropdown <?php echo $this->uri->segment(1) == 'manage_users' ? 'active' : ''; ?>"> <a
					href="<?= base_url();?>manage_users" class="nav-link"><i
						class="fas fa-users-cog"></i><span>Manage Users</span></a>
			</li>

      <li class="menu-header">Transferred Funds</li>
			<li class="dropdown <?php echo $this->uri->segment(1) == 'fund_transfer_admin' ? 'active' : ''; ?>"> <a
					href="<?= base_url();?>fund_transfer_admin" class="nav-link"><i
						class="fas fa-exchange-alt"></i><span>Transferred Funds</span></a>
			</li>

		</ul>
	</aside>
</div>
