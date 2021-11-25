<section class="back" >
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/home') ?>" ><i class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="category mt-1" >
    <div class="row bg-c">
        <div class="col-12 row">
            <div class="col-2">
                <i class="flaticon-ambulance ti-icon"></i>
            </div>
            <div class="col-10 p-2">
                <span class="title-m pt-1"  >Ambulance</span>
            </div>
        </div>
    </div>
</section>

<section class="banner" >
    <div class="row">
        <div class="col-12 p-3 ">
            <img src="<?php echo base_url()?>/assets/mobile/image/ambulance.png" width="100%">
        </div>
        <div class="col-12 p-3">
            <a href="<?php echo base_url('Mobile_app/ambulance/ambulance_select')?>" class="btn-loca"> <i class="flaticon-pin"></i> Select your location</a>
        </div>
        <div class="col-12 p-3">
            <h4>New In</h4>
        </div>
        <div class="col-12 p-3 row" style="padding-right: 0px !important;">
            <?php foreach ($ambulanceData as $item) {
                $img = (!empty($item->image))?$item->image:'noimage.jpg';?>
                <div class="col-6 " style="padding: 10px;">
                    <div class="product ">
                        <div class="col-12 pad-0">
                            <img src="<?php echo base_url()?>/assets/upload/ambulance/<?php echo $img;?>" width="100%">
                        </div>
                        <div class="col-12 mt-4" style="line-height: 5px;">
                            <p class="proName"><?php echo $item->contact_name;?></p>
                            <p class="pro_nm"><?php echo substr($item->description, 0, 20); ?>..</p>
                            <p class="pro_pho"><?php echo $item->mobile; ?></p>
                        </div>
                    </div>
                </div>
            <?php } ?>

        </div>


    </div>
</section>