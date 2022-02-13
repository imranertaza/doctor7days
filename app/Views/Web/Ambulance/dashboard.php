
<!-- services area  -->
<section class="area-hight">
    <div class="container text-capitalize" >
        <div class="service-inner">
            <div class="row">
                <div class="col-md-4">
                    <?php echo $sidebar;?>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <a href="<?php echo base_url('Web/Ambulance/create')?>" class="btn btn-primary" style="float: right;">Add Ambulance</a>
                                    <h4 class="card-title">Ambulance Dashboard</h4>

                                    <?php if (session()->getFlashdata('message') !== NULL) : ?>
                                        <?php echo session()->getFlashdata('message'); ?>
                                    <?php endif; ?>
                                </div>



                                <?php foreach ($ambulance as $item) {
                                        $img = no_image_view('/assets/upload/ambulance/'.$item->ambulance_user_id.'/'.$item->image,'/assets/upload/ambulance/no_image.jpg',$item->image); ?>
                                        <div class="col-4 " style="padding: 10px;">
                                            <div class="product ">
                                                <div class="col-12 pad-0 d-flex justify-content-center align-items-center">
                                                    <img src="<?php echo $img;?>" >
                                                </div>
                                                <div class="col-12 mt-4" style="line-height: 5px;">
                                                    <p class="proName"><?php echo newSession()->name;?></p>
                                                    <p class="pro_nm"><small><?php echo substr($item->description, 0, 20); ?>..</small></p>
                                                    <p class="pro_pho"><?php echo newSession()->phone; ?></p>
                                                </div>
                                                <div class="col-12 row" style="padding-right: 0px!important;margin-left: -7px !important;">
                                                    <div class="col-6 d-flex justify-content-center align-items-center" style="padding-right: 0px!important;background-color: #17a2b8; border-bottom-left-radius: 12px;">
                                                        <a href="<?php echo  base_url('Web/Ambulance/edit_ambulance/'.$item->amb_id)?>" class="btn-amedit"><i class="flaticon-pencil btn-icon-am"></i></a>
                                                    </div>
                                                    <div class="col-6 d-flex justify-content-center align-items-center" style="padding-right: 0px!important;background-color: #ff0000; border-bottom-right-radius: 12px;">
                                                        <a href="<?php echo  base_url('Web/Ambulance/delete/'.$item->amb_id)?>" class="btn-amedit2" onclick="return confirm('Are you sure you want to delete?')"><i class="flaticon-delete btn-icon-am"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- services area  end-->