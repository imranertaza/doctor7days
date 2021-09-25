<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Inventory | Amar Bangla Bazar System Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link href="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <!-- <a href="#"><b>Amar Bangla Bazar</b><br>Forgot Your Password</a> -->
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <center><a href="#"><img src="<?php echo base_url() ?>uploads/logobazar.png" style="margin-bottom: 25px;" ></a></center>
        <p class="login-box-msg">Please Enter Your Registered Email Address</p>        
        <div class="row">
            <div class="col-md-12 text-center">
                <div style="margin-top: 12px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
        </div>
        
        <form action="<?php echo base_url(); ?>login/reset_link" method="post">
          <div class="form-group has-feedback">
            <input type="email" class="form-control" placeholder="Email" name="email" required />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          
          <div class="row">
            <div class="col-xs-6">    
              <!-- <div class="checkbox icheck" style="margin-left: 20px;">
                <label>
                  <input type="checkbox"> Remember Me
                </label>
              </div>   -->                      
            </div><!-- /.col -->
            <div class="col-xs-6">
              <input type="submit" class="btn btn-warning btn-block btn-flat" value="SEND RESET LINK" />
            </div><!-- /.col -->
          </div>
        </form>

        
        
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <script src="<?php echo base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>
