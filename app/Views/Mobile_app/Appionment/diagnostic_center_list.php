<section class="back" >
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/appionment')?>" ><i class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="category mt-1" >
    <div class="row bg-c">
        <div class="col-12 row">
            <div class="col-2">
                <i class="flaticon-checkup ti-icon"></i>
            </div>
            <div class="col-10 p-2">
                <span class="title-m" >Doctor Appionment</span>
            </div>
        </div>
    </div>
</section>

<section class="banner" >
    <div class="row">
        <div class="col-12 p-3 ">
            <p class="sub-t">Clinic / Hospital / Diagnostic / Center List</p>
        </div>


        <?php if(!empty($hospitalData)){foreach ($hospitalData as $item) {?>
        <div class="col-12 p-3 row">
            <div class="col-3">
                <div class="user-round">
                    <i class="flaticon-user-1 user-ic"></i>
                </div>
            </div>
            <div class="col-5 map">
                <p class="tit-u mt-2"><b><?php echo $item->name;?></b></p>
            </div>
            <div class="col-4 map">
                <a href="<?php echo base_url('Mobile_app/appionment/doctor_specialties/'.$item->h_id); ?>" class="btn btn-sm btn-col mt-2" >Go</a>
            </div>
        </div>
        <?php }}else{?>
            <div class="col-12 p-3 row">
                <div class="col-12">
                    <p>No Data found !</p>
                </div>
            </div>
        <?php }?>


        <div class="col-12 p-3 ">
            <img src="<?php echo base_url()?>/assets/mobile/image/home-img.png" class="ban-img">
        </div>
    </div>
</section>