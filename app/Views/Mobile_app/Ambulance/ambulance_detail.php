<section class="back" >
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/Ambulance') ?>" ><i class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="category mt-1" >
    <div class="row bg-c">
        <div class="col-12 row">
            <div class="col-2">
                <i class="flaticon-ambulance ti-icon"></i>
            </div>
            <div class="col-10 p-2">
                <span class="title-m pt-1">Ambulance details</span>
            </div>
        </div>
    </div>
</section>

<section class="banner2" >
    <div class="row">
        <div class="col-12 p-3 text-center ">
            <img src="<?php echo base_url('assets/upload/ambulance/'.$ambulance->ambulance_user_id.'/'.$ambulance->image)?>" >
        </div>
        <div class="col-6 p-3">
            <?php
            $name = get_data_by_id('name', 'ambulance_users', 'ambulance_user_id', $ambulance->ambulance_user_id);
            $phone = get_data_by_id('mobile', 'ambulance_users', 'ambulance_user_id', $ambulance->ambulance_user_id);
            ?>
            <p><b>Name:</b> <?php echo $name;?></p>
            <p><b>Phone:</b> <?php echo $phone;?></p>
            <p><b>Model:</b> <?php echo $ambulance->car_model_name;?></p>



        </div>
        <div class="col-6 p-3">
            <p><b>Axygen:</b> <?php echo $ambulance->oxygen;?></p>
            <p><b>AC:</b> <?php echo $ambulance->ac;?></p>
        </div>
        <div class="col-12 p-3">
            <p><b>Details:</b><br> <?php echo $ambulance->description;?></p>
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