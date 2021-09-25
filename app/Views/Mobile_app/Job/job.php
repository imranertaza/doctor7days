<section class="back" >
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/home')  ?>" ><i class="flaticon-left-arrow back-icon"></i></a>
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
            <table class="" style="width: 100%;">
                <?php foreach ($job as $item) {?>
                <tr>
                    <td class="row">
                        <div class="col-1">
                            <div class="job-rou"></div>
                        </div>
                        <div class="col-10" style="padding-left: 10px;">
                            <p class="job-pb">Publisher</p>

                        </div>
                        <div class="col-10">
                            <p class="job-title" ><?php echo $item->title;?></p>
                            <p class="job-pti"><?php echo date('M-d-Y H:i:s', strtotime($item->createdDtm));?></p>
                        </div>
                    </td>
                    <td style="font-size: 15px">
                        <a href="<?php echo base_url('Mobile_app/job/job_apply/'.$item->job_id)  ?>"><i class="flaticon-right-arrow"></i></a>
                    </td>
                </tr>
                <?php }?>
            </table>
        </div>


    </div>
</section>