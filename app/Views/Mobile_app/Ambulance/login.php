<section class="back">
    <form action="<?php echo base_url('Mobile_app/Ambulance/login_action') ?>" method="post">
        <div class="row">
            <img src="<?php echo base_url() ?>/assets/mobile/image/bnimg.JPG" width="100%">
            <div class="col-12 p-3 text-center">
                <img src="<?php echo base_url() ?>/assets/mobile/image/logo.png" width="100%">
            </div>
            <div class="col-12 p-3 ">
                <?php if (session()->getFlashdata('message') !== NULL) : ?>
                    <?php echo session()->getFlashdata('message'); ?>
                <?php endif; ?>
            </div>
            <div class="col-12 p-3 ">
                <div class="input-group mb-3 inp-gro">
                    <div class="input-group-prepend">
                        <span class="input-group-text inp-icon"><i class="flaticon-envelope"></i></span>
                    </div>
                    <input type="number" class="form-control inp" name="phone" placeholder="Phone Number" required>
                </div>
                <div class="input-group mb-3 inp-gro">
                    <div class="input-group-prepend">
                        <span class="input-group-text inp-icon"><i class="flaticon-lock"></i></span>
                    </div>
                    <input type="password" class="form-control inp" name="password" placeholder="Password" required>
                    <div class="input-group-append">
                        <span class="input-group-text inp-icon"><i class="flaticon-view"></i></span>
                    </div>

                </div>
                <div class=" text-right">
                    <a class="forget">Forgot password?</a>
                </div>

            </div>

            <div class="col-12 p-3 ">
                <button type="submit" class="btn-login">Login</button>
            </div>
            <div class="col-12 p-3  or-row">
                <label class="or-bor"></label> <b>Or</b> <label class="or-bor"></label>
            </div>
            <div class="col-12 p-3 " style="margin-bottom: 86px;">
                <a href="<?php echo base_url('Mobile_app/Ambulance/register') ?>" class="btn-signup"
                   style="padding: 12px 125px 12px 126px ;">Sign UP</a>
            </div>


        </div>
    </form>
</section>

</div>

</body>
</html>