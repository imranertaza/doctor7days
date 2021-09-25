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
        <div class="col-12 p-3 row">
            <div class="col-6">
                <?php
                    $img = (!empty($specialties->pic))?$specialties->pic:'noimage.jpg';;
                ?>
                <img src="<?php echo base_url()?>/assets/uplode/doctor/<?php echo $img?>" width="100%">
            </div>
            <div class="col-6">
                <p class="tit"><?php echo $specialties->name;?></p>
                <p class="sub-tit"><?php echo get_data_by_id('specialist_type_name','specialist','specialist_id ',$specialties->specialist_id);?></p>
            </div>
        </div>
        <div class="col-12 p-3 dr-row in-fil">
            <form action="" method="">
                <div class="form-group">
                    <label for="name" class="lab-t">Name</label>
                    <input type="text" class="form-control in-c" placeholder="Enter Name" id="name">
                </div>
                <div class="form-group">
                    <label for="mobile" class="lab-t">Mobile</label>
                    <input type="text" class="form-control in-c" placeholder="Enter Mobile" id="mobile">
                </div>
                <div class="form-group">
                    <label for="date" class="lab-t">Date</label>
                    <input type="text" class="form-control in-c" placeholder="Enter Date" id="date">
                </div>
                <div class="form-group">
                    <label for="time" class="lab-t">Time</label>
                    <input type="text" class="form-control in-c" placeholder="Enter Time" id="time">
                </div>
                <div class="form-group">
                    <button class="sub-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</section>