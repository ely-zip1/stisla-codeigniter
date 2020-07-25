<div class="col-12 user-basic-info">
  <div class="row">
    <div class="col-md-3 text-center">
      <!-- <img src="<?php echo base_url('assets/img/user-logo.png'); ?>" alt="" class="user-img"> -->
      <?php
        if($this->session->image_orientation == 'landscape'){
          echo '<div class="circular--landscape">';
        }
        else if($this->session->image_orientation == 'portrait'){
          echo '<div class="circular--portrait">';
        }
        else{
          echo '<div class="circular--square">';
        }
       ?>
        <img src="<?php
        if(strlen($this->session->image_name) > 0){
          echo base_url().'uploads/'.$this->session->image_name;
        }else{
          echo base_url('assets/img/user-logo.png');
        }?>" />
      </div>
    </div>
    <div class="col-md-6 text-center">
      <h4>WELCOME BACK, <?php echo strtoupper($this->session->userdata('username')); ?></h4>
      <p>
        Signup Date: <span class="bold-text"> <?php echo strtoupper($this->session->userdata('date_registered')); ?></span><br>
        <!-- Last Access: <?php echo strtoupper($this->session->userdata('username')); ?> -->
      </p>
    </div>
    <div class="col-md-3 text-center">
      <a href="<?php echo base_url('account_settings'); ?>" class="btn btn-icon icon-left btn-dark rounded-button rounded-button-settings"><i class="fas fa-cogs"></i> Settings</a>
    </div>
  </div>
</div>
