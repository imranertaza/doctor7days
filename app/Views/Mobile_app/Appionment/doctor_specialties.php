<section class="back" >
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/appionment')?>" ><i class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="category mt-1" >
    <div class="row bg-c">
        <img src="<?php echo base_url()?>/assets/mobile/image/imgti.png" width="100%">
    </div>
</section>

<section class="banner" >
    <div class="row">
        <div class="col-12 p-3 text-right">
            <small class="sm-ti">Doctor specialties</small><br>
            <button class="btn-card" >Cardiologist</button>
        </div>
        <div class="col-12 p-3 dr-row ">
            <table class="" style="width: 100%;">
                <?php foreach($specialties as $sp ){
                    $title = get_data_by_id('specialist_type_name','specialist','specialist_id ',$sp->specialist_id) ;
                    ?>
                <tr>
                    <td >
                        <small class="dr-n"><?php echo $sp->name;?></small><br>
                        <small class="dr-t"><?php echo $title;?></small>
                    </td>
                    <td style="font-size: 10px">
                        <a href="<?php echo base_url('Mobile_app/appionment/appionment_booking_form/'.$sp->doc_id )?>"><i class="flaticon-right-arrow"></i></a>
                    </td>
                </tr>
                <?php }?>


            </table>
        </div>
        <div class="col-12 p-3 ">
            <img src="<?php echo base_url()?>/assets/mobile/image/home-img.png" class="ban-img">
        </div>
    </div>
</section>