<section class="back" >
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app')?>" ><i class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="category mt-1" >
    <div class="row bg-c">
        <div class="col-12 row">
            <div class="col-2">
                <i class="flaticon-chat ti-icon"></i>
            </div>
            <div class="col-10 p-2">
                <span class="title-m" >Health Tips</span>
            </div>
        </div>
    </div>
</section>

<section class="banner2" >
    <div class="row pad-r-0">
        <div class="col-12 p-3 pad-r-0">
            <?php foreach ($post as $item) { ?>
            <a href="<?php echo base_url()?>/Mobile_app/blog/blog_detail/<?php echo $item->post_id ;?>">
            <div class="col-12 row pad-r-0 pt-4">
                <div class="col-4 pad-0">
                    <?php $blogImg = no_image_view('/assets/upload/blog/'.$item->post_id.'/'.$item->featured_image,'/assets/upload/blog/no_image.jpg',$item->featured_image);?>
                    <img src="<?php echo $blogImg; ?>" width="100%">

                </div>
                <div class="col-8 pad-0 pl-2">
                    <p class="b-st">Administrator</p>
                    <p class="b-tf"><?php echo $item->title;?></p>
                    <p class="b-sd"><?php echo $item->createdDtm;?></p>
                </div>
            </div></a>
            <?php } ?>


        </div>
    </div>
</section>

<section class="banner" >
    <div class="row">
        <div class="col-12 p-3 " >
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" id="addView">
                </div>
            </div>
            <div class="num"></div>
        </div>
    </div>
</section>