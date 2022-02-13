<section class="back" >
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/Diagnostic')?>" ><i class="flaticon-left-arrow back-icon"></i></a>
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

<section class="category mt-1" >
    <div class="row bg-c">
        <?php
        $banImg = no_image_view('/assets/upload/hospital/'.$hospital->h_id.'/'.$hospital->image,'/assets/upload/hospital/no_image.jpg',$hospital->image);
        ?>
        <img src="<?php echo $banImg;?>" width="100%">
    </div>
</section>

<section class="banner" >
    <div class="row">
        <div class="col-12 p-3 mt-4 dr-row ">
            <table class="" style="width: 100%;">
                <?php foreach($test as $row ){ ?>
                    <tr>
                        <td>
                            <small class="dr-n"><?php echo $row->name;?></small><br>
                            <small class="dr-t" style="font-size: 12px; font-weight: 600;"><?php echo price($row->price); ?></small>
                        </td>
                        <td class="text-right">
                            <a href="<?php echo base_url('Mobile_app/Diagnostic/test_detail/'.$row->test_id )?>" class="btn btn-sm btn-col " >Go</a>
                        </td>
                    </tr>
                <?php }?>


            </table>
        </div>
        <div class="col-12 p-3 mt-2">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                    $banner_1 = no_image_view('/assets/upload/hospital/'.$hospital->h_id.'/'.$hospital->banner_1,'/assets/upload/hospital/no_image.jpg');
                    $banner_2 = no_image_view('/assets/upload/hospital/'.$hospital->h_id.'/'.$hospital->banner_2,'/assets/upload/hospital/no_image.jpg');
                    $banner_3 = no_image_view('/assets/upload/hospital/'.$hospital->h_id.'/'.$hospital->banner_3,'/assets/upload/hospital/no_image.jpg');
                    ?>no_image.jpg
                    <div class="carousel-item active">
                        <img src="<?php echo $banner_1;?>" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo $banner_2;?>" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo $banner_3;?>" class="d-block w-100" alt="...">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>