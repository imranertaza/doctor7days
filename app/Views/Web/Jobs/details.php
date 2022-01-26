<!-- services area  -->
<section class="mt-3 area-hight" >
    <div class="container">
        <div class="service-text text-capitalize" >
            <h1><?php echo $jobs->title;?></h1>
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