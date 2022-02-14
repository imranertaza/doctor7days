<!-- services area  -->
<section class="mt-3 area-hight" >
    <div class="container">
        <div class="service-text text-capitalize" >
            <center><h2><?php echo get_data_by_id('name','hospital','h_id',$jobs->h_id) ;?></h2></center>
            <h4><?php echo $jobs->title;?></h4>
        </div>
        <div class="service-inner">
            <div class="row">
                <div class="col-md-12">
                    <p><b>Salary:</b> $<?php echo $jobs->salary ?> <b>Time:</b> <?php echo $jobs->daily_time ?> Hours</p>
                </div>
                <div class="col-md-12">
                    <?php if (!empty($jobs->location)){ ?>
                    <p><b>Address: </b><?php echo $jobs->location ?></p>
                    <?php } ?>

                    <?php echo $jobs->description ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- services area  end-->