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
            <h4>All test list</h4>
        </div>

        <div class="service-inner">
            <div class="row mt-4">
                <div class="col-3"></div>
                <div class="col-6">
                    <table class="" style="width: 100%;">
                        <?php foreach($test as $sp ){ ?>
                            <tr>
                                <td >
                                    <small class="dr-n"><?php echo $sp->name;?></small><br>
                                    <small class="dr-t"><?php echo price($sp->price);?></small>
                                </td>


                                <td class="text-right">
                                    <a href="<?php echo base_url('Web/Diagnostic/test_detail/'.$sp->test_id )?>" class="btn btn-sm go " >Go</a>
                                </td>
                            </tr>
                        <?php }?>


                    </table>

                </div>
                <div class="col-3"></div>
            </div>
        </div>
    </div>
</section>