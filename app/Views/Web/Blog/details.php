<!-- services area  -->
<section class="mt-3 area-hight">
    <div class="container">
        <div class="service-text text-capitalize" >
            <h1><?php echo $blog->title;?></h1>
        </div>
        <div class="service-inner mt-4 pt-md-0">
            <div class="row">
                <div class="col-md-12">
                    <?php $blogImg = no_image_view('/assets/upload/blog/'.$blog->post_id.'/'.$blog->image,'/assets/upload/blog/no_image.jpg',$blog->image,$blog->image);?>
                    <img src="<?php echo $blogImg;?>" alt="" style="width: 100%;">
                </div>
                <div class="col-md-12 mt-2">
                    <?php echo $blog->description ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- services area  end-->