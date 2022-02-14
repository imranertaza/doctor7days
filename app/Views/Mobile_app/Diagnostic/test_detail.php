<section class="back">
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/Diagnostic') ?>"><i class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="category mt-1">
    <div class="row bg-c">
        <div class="col-12 row">
            <div class="col-2">
                <i class="flaticon-diagnostic ti-icon"></i>
            </div>
            <div class="col-10 p-2">
                <span class="title-m"><?php echo $hospital->name;?></span>
            </div>
        </div>
    </div>
</section>

<section class="category mt-1">
    <div class="row bg-c">
        <?php
        $banImg = no_image_view('/assets/upload/hospital/'.$hospital->h_id.'/'.$hospital->image,'/assets/upload/hospital/no_image.jpg',$hospital->image);
        ?>
        <img src="<?php echo $banImg;?>" width="100%">
    </div>
</section>



<section class="banner">
    <div class="row">
        <div class="col-12 p-3 mt-4 dr-row row">
            <div class="col-10">

                <h6><?php echo $test->name; ?></h6>
            </div>
            <div class="col-2">
                <p style="float: right; font-weight: 500;"><?php echo price($test->price); ?></p>
            </div>
            <div class="col-12">
                <p><?php echo $test->description; ?></p>
            </div>

        </div>
        <div class="col-12 p-3 mt-2">


            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php if (!empty($hospital->banner_1)) { ?>
                        <div class="carousel-item active">
                            <img src="<?php echo base_url() ?>/assets/upload/hospital/<?php echo $hospital->h_id;?>/<?php echo $hospital->banner_1; ?>"
                                 class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo base_url() ?>/assets/upload/hospital/<?php echo $hospital->h_id;?>/<?php echo $hospital->banner_2; ?>"
                                 class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo base_url() ?>/assets/upload/hospital/<?php echo $hospital->h_id;?>/<?php echo $hospital->banner_3; ?>"
                                 class="d-block w-100" alt="...">
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>