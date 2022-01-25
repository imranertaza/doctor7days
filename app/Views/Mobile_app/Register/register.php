<section class="back">
    <form action="<?php echo base_url('Mobile_app/Patient/reg_action')?>" method="post">
        <div class="row">
<!--            <img src="--><?php //echo base_url() ?><!--/assets/mobile/image/sign.JPG" class="pt-3" width="100%">-->
            <div class="col-12 p-3 text-center">
                <img src="<?php echo base_url() ?>/assets/mobile/image/logo.png" width="100%">
            </div>

            <div class="col-12 text-center">
                <h4>Patient Sign UP</h4>
            </div>

            <div class="col-12 p-3 ">
                <?php if (session()->getFlashdata('message') !== NULL) : ?>
                    <?php echo session()->getFlashdata('message'); ?>
                <?php endif; ?>
            </div>

            <div class="col-12 p-3 ">
                <div class="input-group mb-3 inp-gro">
                    <div class="input-group-prepend">
                        <span class="input-group-text inp-icon"><i class="flaticon-user"></i></span>
                    </div>
                    <input type="text" name="name" class="form-control inp" placeholder="User name">
                </div>

                <div class="input-group mb-3 inp-gro">
                    <div class="input-group-prepend">
                        <span class="input-group-text inp-icon"><i class="flaticon-envelope"></i></span>
                    </div>
                    <input type="number" name="phone" class="form-control inp" placeholder="Phone number">
                </div>
                <div class="input-group mb-3 inp-gro">
                    <div class="input-group-prepend">
                        <span class="input-group-text inp-icon"><i class="flaticon-lock"></i></span>
                    </div>
                    <input type="password" name="password" id="password" class="form-control inp"
                           placeholder="Password">
                    <div class="input-group-append">
                        <a href="javascript:void(0);" onclick="passShow()" class="input-group-text inp-icon"><i
                                    class="flaticon-view"></i></a>
                    </div>

                </div>
                <div class=" text-right">
                    <a class="forget">Forgot password?</a>
                </div>

            </div>

            <div class="col-12 p-3 ">
                <button class="btn-login btn-block">Sign UP</button>
            </div>
            <div class="col-12 p-3  or-row">
                <label class="or-bor"></label> <b>Or</b> <label class="or-bor"></label>
            </div>
            <div class="col-12 p-3 " style="margin-bottom: 86px;">
                <a href="<?php echo base_url('Mobile_app/Patient/login') ?>" class="btn-signup btn-block"
                   style="padding: 12px 135px 12px 136px ;">Login</a>
            </div>


        </div>
    </form>

</section>

</div>

</body>
</html>