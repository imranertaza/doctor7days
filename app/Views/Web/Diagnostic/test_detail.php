<!-- services area  -->
<section class="area-hight">
    <div class="container text-capitalize">
        <div class="service-text text-center">
            <h1><?php echo $diagnostic->name;?></h1>
        </div>
    </div>
    <div class="banner-img">
        <?php $banImg = no_image_view('/assets/upload/hospital/'.$diagnostic->h_id.'/'.$diagnostic->image,'/assets/upload/hospital/no_image.jpg',$diagnostic->image); ?>
        <img class="img-fluid" src="<?php echo $banImg;?>" alt="" />
    </div>
</section>
<!-- services area  end-->

<section class="area-hight mt-4">
    <div class="container text-capitalize">
        <div class="service-text text-center">
            <h4><?php echo $test->name?></h4>
            <h5>Price :<?php echo price($test->price);?></h5>
        </div>

        <div class="service-inner">
            <div class="row mt-4">
                <div class="col-12">
                    <?php echo $test->description;?>
                </div>
            </div>
        </div>
    </div>
</section>