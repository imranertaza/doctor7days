<!-- services area  -->
<section class="area-hight">
    <div class="container text-capitalize" >
        <div class="service-text text-center">
            <h1>Health Tips</h1>
            <p>get best tips</p>
        </div>
        <div class="service-inner">
            <div class="row">
                <?php foreach ($blog as $item){?>
                    <div class="col-md-6 p-2">
                        <a href="<?php echo base_url('Web/Blog/details/'.$item->post_id)?>">
                            <div class="card">
                            <div class="card-body">
                                <div class="text" style="line-height: 16px">
                                    <h4><?php echo $item->title;?></h4>
                                    <span style="font-size: 12px;">Administrator</span><br>
                                    <span style="font-size: 12px;"><?php echo $item->createdDtm;?></span>
                                </div>
                                <div class="img mt-3">
                                    <?php $blogImg = no_image_view('/assets/upload/blog/'.$item->post_id.'/'.$item->image,'/assets/upload/blog/no_image.jpg',$item->image,$item->image);?>
                                    <img src="<?php echo $blogImg;?>" alt="" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                        </a>
                    </div>
                <?php }?>


            </div>
        </div>
    </div>
</section>
<!-- services area  end-->