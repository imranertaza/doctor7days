
<!-- services area  -->
<section class="area-hight">
    <div class="container text-capitalize" >
        <div class="service-text text-center">
            <h1>Ambulance search result</h1>
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
                    <div class="row">
                        <?php if (!empty($ambulanceData)){ foreach ($ambulanceData as $item) {

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
                        <?php } }else{?>
                        <div class="col-12 text-center" style="padding: 10px;">
                            <div class="card">
                                <div class="card-body">
                                    Ambulance not available in this address!
                                </div>
                            </div>

                        </div>
                        <?php }?>
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