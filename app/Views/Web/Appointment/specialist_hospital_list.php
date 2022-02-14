<!-- services area  -->
<section class="area-hight">
    <div class="container text-capitalize">
        <div class="service-text text-center">
            <h1>Doctor Appionment</h1>
            <p>Hospital list</p>
        </div>
        <div class="service-inner">
            <?php if(!empty($hospitalData)){foreach ($hospitalData as $item) {?>
                <div class="row " style="border: 1px solid #efefef;">
                    <div class="col-3 search-user d-flex justify-content-center align-items-center">
                        <i class="flaticon-user-1 user-ic"></i>
                    </div>
                    <div class="col-5 mt-3">
                        <p class="tit-u "><b><?php echo $item->hospitalname;?></b></p>
                        <p class="tit-u" style="margin-top: -15px;"> <?php echo count_doctor_by_hospitalId_or_specialistId($item->h_id,$item->specialist_id);?> Doctors</p>
                    </div>
                    <div class="col-4 d-flex justify-content-center align-items-center">
                        <a href="<?php echo base_url('Web/Appointment/doctor_specialties_list/'.$item->h_id.'/'.$item->specialist_id); ?>" class="btn btn-sm go " >Go</a>
                    </div>
                </div>
            <?php }}else{?>
                <div class="row">
                    <div class="col-12">
                        <p>No Data found !</p>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>
</section>
<!-- services area  end-->