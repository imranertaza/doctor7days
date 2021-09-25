<section class="back" >
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/job')  ?>" ><i class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="category mt-1" >
    <div class="row bg-c">
        <div class="col-12 row">
            <div class="col-2">
                <i class="flaticon-suitcase ti-icon"></i>
            </div>
            <div class="col-10 p-2">
                <span class="title-m" >Job</span>
            </div>
        </div>
    </div>
</section>

<section class="banner" >
    <div class="row">
        <div class="col-12 p-3 ">
            <p class="job-pb">Publisher</p>
            <p class="job-tit" ><?php echo $job->title;?></p>

        </div>
        <div class="col-12 p-3 ">
            <p class="bl-text"><?php echo $job->description;?></p>
        </div>
        <div class="col-12 p-3 ">
            <a class="btn-apply">Apply</a>
        </div>

    </div>
</section>