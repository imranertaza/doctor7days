<section>
    <div class="banner-img">
        <?php $banner = no_image_view('/assets/web/image/ambulance_banner.jpg','/assets/upload/ambulance/no_ban.jpg')?>
        <img class="img-fluid" src="<?php echo $banner;?>" alt="" />
    </div>
</section>
<!-- services area  -->
<section class="area-hight">
    <div class="container text-capitalize" >
        <div class="service-text text-center">
            <h1>Ambulance</h1>
            <p>get best ambulance</p>
        </div>
        <div class="service-inner">
            <div class="row">

                <div class="col-6 mt-3 text-right">
                    <a href="<?php echo base_url('Web/Ambulance/search_location') ?>" class="btn-loca"> <i
                                class="flaticon-pin"></i> Select your location</a>

                </div>

                <div class="col-6 mt-3 ">
                    <a href="<?php echo base_url('Web/Ambulance/login') ?>" class="btn-loca" > <i
                                class="flaticon-user-1"></i> Ambulance Login</a>
                </div>
                <div class="col-12 mt-5">
                    <h4>New In</h4>

                    <div class="row">
                    <?php foreach ($ambulance as $item) {
                        $img = no_image_view('/assets/upload/ambulance/'.$item->ambulance_user_id.'/'.$item->image,'/assets/upload/ambulance/no_image.jpg',$item->image);
                        $name = get_data_by_id('name', 'ambulance_users', 'ambulance_user_id', $item->ambulance_user_id);
                        $phone = get_data_by_id('mobile', 'ambulance_users', 'ambulance_user_id', $item->ambulance_user_id);
                        ?>
                        <div class="col-3 " style="padding: 10px;">
                            <div class="product ">
                                <div class="col-12 pad-0 d-flex justify-content-center align-items-center ">
                                    <a href="<?php echo base_url('Web/Ambulance/ambulance_details/'.$item->amb_id) ?>">
                                        <img src="<?php echo $img; ?>" width="100%">
                                    </a>
                                </div>
                                <div class="col-12 mt-4" style="line-height: 5px;">
                                    <a href="<?php echo base_url('Web/Ambulance/ambulance_details/'.$item->amb_id) ?>">
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
                </div>


                <div class="col-12 mt-5">
                    <h4>Most Popular</h4>

                    <div class="row">
                        <?php foreach ($ambulance as $item) {
                            $img2 = no_image_view('/assets/upload/ambulance/'.$item->ambulance_user_id.'/'.$item->image,'/assets/upload/ambulance/no_image.jpg',$item->image);
                            $name = get_data_by_id('name', 'ambulance_users', 'ambulance_user_id', $item->ambulance_user_id);
                            $phone = get_data_by_id('mobile', 'ambulance_users', 'ambulance_user_id', $item->ambulance_user_id);
                            ?>
                            <div class="col-3 " style="padding: 10px;">
                                <div class="product ">
                                    <div class="col-12 pad-0 d-flex justify-content-center align-items-center ">
                                        <a href="<?php echo base_url('Web/Ambulance/ambulance_details/'.$item->amb_id) ?>">
                                            <img src="<?php echo $img2; ?>" width="100%">
                                        </a>
                                    </div>
                                    <div class="col-12 mt-4" style="line-height: 5px;">
                                        <a href="<?php echo base_url('Web/Ambulance/ambulance_details/'.$item->amb_id) ?>">
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
                </div>

            </div>
        </div>
    </div>
</section>
<!-- services area  end-->