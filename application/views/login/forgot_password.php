<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="row">
                            <div class="col-12">
                                <div class="login-brand">
                                </div>
                            </div>
                        </div>

                        <div class="card card-primary">

                            <div class="card-body">

                                <div class="row">
                                  <div class="col-12 text-center">
                                    <a href="<?= base_url();?>"><img src="<?= base_url();?>assets/img/ef-logo.png" alt="logo" width="150"></a> <br>
                                    <br>
                                      <h3>Reset Password</h3> <br>
                                  </div>
                                </div>

                                <?php if($this->session->flashdata('reset_message') != null){
                                    echo '<div class="alert alert-info">';
                                    echo $this->session->flashdata('reset_message');
                                    echo '</div>';
                                }?>
                                <?php echo form_open('Forgot_password'); ?>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control <?php if(strlen(form_error('email')) > 0){echo "is-invalid";} ?>"
                                         name="email" tabindex="1" autofocus
                                          value="<?= set_value('email','',true)?>">
                                       <div class="invalid-feedback">
                                         <?php echo form_error('email');?>
                                       </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Continue
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="simple-footer">

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
