<section class="back">
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/Inbox') ?>"><i class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="category mt-1">
    <div class="row bg-c">
        <div class="col-12 row">
            <div class="col-2">
                <i class="flaticon-envelope ti-icon"></i>
            </div>
            <div class="col-8 p-2">
                <span class="title-m">Message</span>
            </div>
        </div>
    </div>
</section>

<section class="banner2">
    <div class="row">
        <div class="col-12 p-3 ">
            <p class="sub-t"><b><?php echo $inbox->title;?></b></p>
        </div>
        <div class="col-12 p-3 in-fil">
            <?php echo $inbox->description;?>

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