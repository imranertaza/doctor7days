<section class="back">
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <?php $isAmbulanceLogin = newSession()->isAmbulanceLogin;
            if (!empty($isAmbulanceLogin) || $isAmbulanceLogin == TRUE) { ?>
                <a href="<?php echo base_url('Mobile_app/Ambulance_dashboard') ?>" class="btn-loca"
                   style="float: right;">My account</a>
            <?php } else {
                ?>
                <a href="<?php echo base_url('Mobile_app/Ambulance/login') ?>" class="btn-loca"
                   style="float: right;">Login</a>
            <?php } ?>
            <a href="<?php echo base_url('Mobile_app/home') ?>"><i class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="category mt-1">
    <div class="row bg-c">
        <div class="col-12 row">
            <div class="col-2">
                <i class="flaticon-ambulance ti-icon"></i>
            </div>
            <div class="col-10 p-2">
                <span class="title-m pt-1">Ambulance</span>
            </div>
        </div>
    </div>
</section>

<section class="banner">
    <div class="row">
        <div class="col-12 p-3 ">
            <img src="<?php echo base_url() ?>/assets/mobile/image/ambulance.png" width="100%">
        </div>
        <div class="col-12 p-3">
            <a href="<?php echo base_url('Mobile_app/ambulance/ambulance_select') ?>" class="btn-loca"> <i
                        class="flaticon-pin"></i> Select your location</a>
        </div>
        <div class="col-12 p-3">
            <h4>New In</h4>
        </div>
        <div class="col-12 p-3 row" style="padding-right: 0px !important;">
            <?php foreach ($ambulance as $item) {
                $img = (!empty($item->image)) ? $item->image : 'noimage.jpg';
                $name = get_data_by_id('name', 'ambulance_users', 'ambulance_user_id', $item->ambulance_user_id);
                $phone = get_data_by_id('mobile', 'ambulance_users', 'ambulance_user_id', $item->ambulance_user_id);
                ?>
                <div class="col-6 " style="padding: 10px;">
                    <div class="product ">
                        <div class="col-12 pad-0">
                            <a href="<?php echo base_url('Mobile_app/Ambulance/ambulance_details/'.$item->amb_id) ?>">
                                <img src="<?php echo base_url() ?>/assets/uplode/ambulance/<?php echo $img; ?>"
                                     width="100%">
                            </a>
                        </div>
                        <div class="col-12 mt-4" style="line-height: 5px;">
                            <a href="<?php echo base_url('Mobile_app/Ambulance/ambulance_details/'.$item->amb_id) ?>">
                                <p class="proName"><?php echo $name; ?></p>
                                <p class="pro_nm"><?php echo substr($item->description, 0, 20); ?>..</p>
                                <p class="pro_pho"><?php echo $phone; ?></p>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if ($count > 10) { ?>
                <div class="col-12 pl-4">
                    <b><?= $pager->links() ?></b>
                </div>
            <?php } ?>

        </div>

        <div class="col-12 p-3">
            <h4>Most Popular</h4>
        </div>
        <div class="col-12 p-3 row" style="padding-right: 0px !important;">
            <?php foreach ($ambulance as $item) {
                $img = (!empty($item->image)) ? $item->image : 'noimage.jpg';
                $name = get_data_by_id('name', 'ambulance_users', 'ambulance_user_id', $item->ambulance_user_id);
                $phone = get_data_by_id('mobile', 'ambulance_users', 'ambulance_user_id', $item->ambulance_user_id);
                ?>
                <div class="col-6 " style="padding: 10px;">
                    <div class="product ">
                        <div class="col-12 pad-0">
                            <a href="<?php echo base_url('Mobile_app/Ambulance/ambulance_details/'.$item->amb_id) ?>">
                                <img src="<?php echo base_url() ?>/assets/uplode/ambulance/<?php echo $img; ?>"
                                     width="100%">
                            </a>
                        </div>
                        <div class="col-12 mt-4" style="line-height: 5px;">
                            <a href="<?php echo base_url('Mobile_app/Ambulance/ambulance_details/'.$item->amb_id) ?>">
                                <p class="proName"><?php echo $name; ?></p>
                                <p class="pro_nm"><?php echo substr($item->description, 0, 20); ?>..</p>
                                <p class="pro_pho"><?php echo $phone; ?></p>
                            </a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>