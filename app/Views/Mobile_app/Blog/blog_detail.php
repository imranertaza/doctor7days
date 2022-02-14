<section class="back" >
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/blog')?>" ><i class="flaticon-left-arrow back-icon"></i></a>
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
            <p class="bl-sub">TRENDING NOW</p>
            <p class="bl-title"><?php echo $post->title;?></p>
        </div>
        <div class="col-12 p-3 pad-r-0">
            <?php $blogImg = no_image_view('/assets/upload/blog/'.$post->post_id.'/'.$post->image,'/assets/upload/blog/no_image.jpg',$post->image);?>
            <img src="<?php echo $blogImg;?>" width="100%">
        </div>
        <div class="col-12 p-3 pad-r-0">
            <?php echo $post->description;?>
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