<!-- services area  -->
<section class="area-hight">
    <div class="container text-capitalize">
<!--        <div class="service-text text-center">-->
<!--            <h1>Login</h1>-->
<!--        </div>-->
        <div class="service-inner">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4 p-5 border">
                    <center><img class="img-fluid" src="<?php echo base_url(); ?>/assets/web/image/logo 200.png"
                                 alt=""/>
                    <h6 class="mt-3">Patient Login</h6></center>
                    <form method="post" action="<?php echo base_url('Web/login/login_action')?>">
                        <div class="input-group mb-3 pt-3">
                            <?php if (session()->getFlashdata('message') !== NULL) : ?>
                                <?php echo session()->getFlashdata('message'); ?>
                            <?php endif; ?>
                        </div>

                        <div class="input-group mb-3 pt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><i class="fas fa-phone-alt"></i></span>
                            </div>
                            <input type="number" class="form-control" name="phone"  placeholder="Phone Number" required>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon2"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <div class="input-group mb-3 ">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                            <a href="<?php echo base_url('/register')?>" class="btn btn-outline-secondary btn-block">sign UP</a>
                        </div>
                    </form>

                </div>
                <div class="col-md-4"></div>


            </div>
        </div>
    </div>
</section>
<!-- services area  end-->