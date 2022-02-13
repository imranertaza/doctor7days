<!DOCTYPE html>
<html lang="en">
<head>
    <title>Doctor7days</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>/assets/web/css/style.css" />
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/web/css/responcive.css" />
    <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo base_url();?>/assets/web/css/bootstrap.min.css"
    />
    <link
        rel="stylesheet"
        type="text/css"
        href="<?php echo base_url();?>/assets/web/flaticon/font/flaticon.css"
    />
    <script src="<?php echo base_url();?>/assets/web/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>/assets/web/js/popper.min.js"></script>
    <script src="<?php echo base_url();?>/assets/web/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>/assets/js/sweetalert2@11.js"></script>
<!--    <link rel="stylesheet" href="--><?php //echo base_url();?><!--/assets/web/css/all.min.css" />-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap"
        rel="stylesheet"
    />
    <link rel="stylesheet" href="<?php echo base_url();?>/assets/web/css/owl.carousel.min.css" />
</head>
<body>
<!-- main header start -->
<section id="header">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url();?>"
            ><img
                    class="img-fluid"
                    src="<?php echo base_url();?>/assets/web/image/logo 200.png"
                    alt=""
                /></a>
            <button
                class="navbar-toggler"
                type="button"
                data-toggle="collapse"
                data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto" id="reloadCart">
                    <?php if(!empty(newSession()->isPatientLoginWeb) || newSession()->isPatientLoginWeb == TRUE) {?>
                        <li class="nav-item mr-2">
                            <a href="<?php echo base_url('/Web/dashboard')?>" class="btn menu-btn">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo base_url('Web/Login/logout')?>" class="btn login-btn">Logout</a>
                        </li>

                    <?php }else{  if(!empty(newSession()->isAmbulanceLoginWeb) || newSession()->isAmbulanceLoginWeb == TRUE) { ?>
                        <li class="nav-item mr-2">
                            <a href="<?php echo base_url('/Web/Ambulance/dashboard')?>" class="btn menu-btn">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo base_url('Web/Ambulance/logout');?>" class="btn login-btn">Logout</a>
                        </li>
                    <?php }else{ ?>
                        <li class="nav-item">
                            <a href="<?php echo base_url('Web/Login')?>" class="btn login-btn">Login</a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo base_url('/register')?>" class="btn menu-btn">sign UP</a>
                        </li>
                    <?php } } ?>

                    <?php if(!empty(Cart()->totalItems())){ ?>
                        <li class="nav-item ml-2" >
                            <a href="<?php echo base_url('Web/Cart') ?>" class="btn login-btn" style="color: red"><i
                                        class="flaticon-shopping-cart " ></i>(<?php echo Cart()->totalItems(); ?>)</a>
                        </li>
                    <?php } ?>

                </ul>
            </div>
        </div>
    </nav>
</section>
<!-- main header end -->