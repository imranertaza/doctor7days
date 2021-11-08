<section class="back">
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/Ambulance_dashboard/') ?>"><i class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="category mt-1">
    <div class="row ">
        <?php if (!empty($image)) { ?>
            <div class="col-12">
                <center>
                    <img src="<?php echo base_url('assets/uplode/ambulance_user/' .$image) ?>" alt="user"
                         class="pro-img">
                </center>
                <div class="small-icon-pro">
                    <center><i class="flaticon-pencil" style="color: #ffffff;"></i></center>
                </div>
            </div>
        <?php } else { ?>

            <div class="col-4"></div>
            <div class="col-4">
                <div class="c-round-user ">
                    <center><i class="flaticon-user-1 icon-profile"></i></center>
                </div>
                <div class="small-icon">
                    <center><i class="flaticon-pencil" style="color: #ffffff;"></i></center>
                </div>

            </div>
            <div class="col-4"></div>
        <?php } ?>
    </div>
</section>

<section class="banner">
    <form action="<?php echo base_url('Mobile_app/Ambulance_dashboard/create_action') ?>" method="POST" enctype="multipart/form-data">
        <div class="row">

            <div class="col-12 p-3 ">
                <?php if (session()->getFlashdata('message') !== NULL) : ?>
                    <?php echo session()->getFlashdata('message'); ?>
                <?php endif; ?>
            </div>

            <div class="col-12 p-3 in-fil">

                <div class="form-group">
                    <label for="division" class="lab-t">Ambulance Number</label>
                    <input class="form-control in-c" name="car_model_name" required>
                </div>

                <div class="form-group">
                    <label for="Oxygen" class="lab-t"> Oxygen </label>
                    <select class="form-control in-c" name="oxygen" required>
                        <option value="">Please Select</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="ac" class="lab-t"> AC </label>
                    <select class="form-control in-c" name="ac" required>
                        <option value="">Please Select</option>
                        <option value="yes">Yes</option>
                        <option value="no">No</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="image" class="lab-t"> Image </label>
                    <input type="file" class="form-control in-c" name="image" required>
                </div>

                <div class="form-group">
                    <label for="description" class="lab-t"> Description </label>
                    <textarea class="form-control" rows="6" name="description" required>

                    </textarea>
                </div>


            </div>
            <div class="col-12 p-3 in-fil">
                <div class="form-group">
                    <button class="btn btn-info">Submit</button>
                </div>
            </div>

        </div>
    </form>

</section>