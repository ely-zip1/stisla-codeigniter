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
                            <h5 class="card-title">Verification</h5>
                            <?php if(isset($status)){
                              if($status == 1){
                                echo '<div class="alert alert-success">
                                      '.$message.'&nbsp<a href="'.base_url().'">Proceed to Login</a>
                                  </div>';
                              }else{
                                echo '<div class="alert alert-danger">
                                      '.$message.'
                                    </div>';
                              }
                            } ?>
                          </div>
                        </div>

                        <div class="simple-footer">

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
