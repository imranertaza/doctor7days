
<!-- services area  -->
<section class="area-hight">
    <div class="container text-capitalize" >
        <div class="service-text text-center">
            <h1>Ambulance details</h1>
        </div>
        <div class="service-inner">
            <div class="row">
                <div class="col-12 p-3 text-center ">
                    <?php $img = no_image_view('/assets/upload/ambulance/'.$ambulance->ambulance_user_id.'/'.$ambulance->image,'/assets/upload/ambulance/no_image.jpg',$ambulance->image);?>
                    <img src="<?php echo $img;?>" >
                </div>
                <div class="col-6 p-3 text-center">
                    <?php
                    $name = get_data_by_id('name', 'ambulance_users', 'ambulance_user_id', $ambulance->ambulance_user_id);
                    $phone = get_data_by_id('mobile', 'ambulance_users', 'ambulance_user_id', $ambulance->ambulance_user_id);
                    ?>
                    <p><b>Name:</b> <?php echo $name;?></p>
                    <p><b>Phone:</b> <?php echo $phone;?></p>
                    <p><b>Model:</b> <?php echo $ambulance->car_model_name;?></p>



                </div>
                <div class="col-6 p-3 text-center">
                    <p><b>Axygen:</b> <?php echo $ambulance->oxygen;?></p>
                    <p><b>AC:</b> <?php echo $ambulance->ac;?></p>
                </div>
                <div class="col-12 p-3">
                    <p><b>Details:</b><br> <?php echo $ambulance->description;?></p>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- services area  end-->