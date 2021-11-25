


<section class="category mt-5">
    <div class="row">
        <div class="col-12 p-3  in-fil text-center">
            <?php $userId = newSession()->user_id; if (!empty($image)){?>
                    <center>
                        <img src="<?php echo base_url('assets/upload/ambulance/'.$userId.'/'.$image)?>" alt="user" class="pro-img" >
                    </center>
            <?php }else{?>
            <div class="af-pro">
                <i class="flaticon-user-1 sm-icon-2"></i>
            </div>
            <?php } ?>
            <p><?php echo newSession()->name;?></p>
            <a href="<?php echo  base_url('Mobile_app/Ambulance_dashboard/add_ambulance')?>" class="btn-ambu">Add Ambulance</a>
        </div>

    </div>
</section>

<section class="banner">
        <div class="row">
            <div class="col-12 p-3 ">
                <?php if (session()->getFlashdata('message') !== NULL) : ?>
                    <?php echo session()->getFlashdata('message'); ?>
                <?php endif; ?>
            </div>
            <div class="col-12 p-3 row" style="padding-right: 0px !important;">
                <?php foreach ($ambulance as $item) {
                    $img = (!empty($item->image))?$item->image:'noimage.jpg';?>
                    <div class="col-6 " style="padding: 10px;">
                        <div class="product ">
                            <div class="col-12 pad-0">
                                <img src="<?php echo base_url()?>/assets/upload/ambulance/<?php echo $item->ambulance_user_id;?>/<?php echo $img;?>" width="100%">
                            </div>
                            <div class="col-12 mt-4" style="line-height: 5px;">
                                <p class="proName"><?php echo newSession()->name;?></p>
                                <p class="pro_nm"><?php echo substr($item->description, 0, 20); ?>..</p>
                                <p class="pro_pho"><?php echo newSession()->phone; ?></p>
                            </div>
                            <div class="col-12 row" style="padding-right: 0px!important;">
                                <div class="col-6" style="padding-left:3px!important;padding-right: 0px!important;">
                                    <a href="<?php echo  base_url('Mobile_app/Ambulance_dashboard/edit_ambulance/'.$item->amb_id)?>" class="btn-amedit"><i class="flaticon-pencil btn-icon-am"></i></a>
                                </div>
                                <div class="col-6" style="padding-left:7px!important;padding-right: 0px!important;">
                                    <a href="<?php echo  base_url('Mobile_app/Ambulance_dashboard/delete/'.$item->amb_id)?>" class="btn-amedit2" onclick="return confirm('Are you sure you want to delete?')"><i class="flaticon-delete btn-icon-am"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>


        </div>
    

</section>