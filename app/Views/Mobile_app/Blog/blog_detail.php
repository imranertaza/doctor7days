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

<section class="banner" >
    <div class="row pad-r-0">
        <div class="col-12 p-3 pad-r-0">
            <p class="bl-sub">TRENDING NOW</p>
            <p class="bl-title"><?php echo $post->title;?></p>
        </div>
        <div class="col-12 p-3 pad-r-0">
            <img src="<?php echo base_url()?>/assets/uplode/blog/<?php echo $post->image;?>" width="100%">
        </div>
        <div class="col-12 p-3 pad-r-0">
            <?php echo $post->description;?>
        </div>
    </div>
</section>