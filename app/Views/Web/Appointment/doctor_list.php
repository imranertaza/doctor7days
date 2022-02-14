<!-- services area  -->
<section class="area-hight">
    <div class="container text-capitalize">
        <div class="service-text text-center">
            <h1><?php echo $hospital->name;?></h1>
        </div>
    </div>
    <div class="banner-img">

        <?php $banImg = no_image_view('/assets/upload/hospital/'.$hospital->h_id.'/'.$hospital->image,'/assets/upload/hospital/no_image.jpg',$hospital->image); ?>
        <img class="img-fluid" src="<?php echo $banImg;?>" alt="" />
    </div>
</section>
<!-- services area  end-->

<section class="area-hight mt-4">
    <div class="container text-capitalize">
        <div class="service-text text-center">
            <h4>Doctor specialties list</h4>
        </div>

        <div class="service-inner">
            <div class="row mt-4">
                <div class="col-3"></div>
                <div class="col-6">
                    <table class="" style="width: 100%;">
                        <?php foreach($specialties as $sp ){
                            $title = get_data_by_id('specialist_type_name','specialist','specialist_id ',$sp->specialist_id) ;
                            ?>
                            <tr>
                                <td >
                                    <small class="dr-n"><?php echo $sp->name;?></small><br>
                                    <small class="dr-t"><?php echo $title;?></small>
                                </td>


                                <td class="text-right">
                                    <a href="<?php echo base_url('Web/Appointment/appointment_booking_form/'.$sp->doc_id )?>" class="btn btn-sm go " >Go</a>
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