<section class="back">
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/Ambulance_dashboard/') ?>"><i
                        class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="category mt-1">
    <div class="row ">
        <?php if (!empty($user->photo)) { ?>
            <div class="col-12">
                <center>
                    <img src="<?php echo base_url('assets/upload/ambulance/'.$user->ambulance_user_id.'/'.$user->photo) ?>" alt="user"
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
    <form action="<?php echo base_url('Mobile_app/Ambulance_dashboard/profile_update_action') ?>" method="POST"
          enctype="multipart/form-data">
        <div class="row">
            <div class="col-12 p-3 ">
                <?php if (session()->getFlashdata('message') !== NULL) : ?>
                    <?php echo session()->getFlashdata('message'); ?>
                <?php endif; ?>
            </div>

            <div class="col-12 p-3 in-fil">

                <div class="form-group">
                    <label for="photo" class="lab-t"> Image </label>
                    <input type="file" class="form-control in-c" name="photo">
                </div>

                <div class="form-group">
                    <label for="name" class="lab-t">Name</label>
                    <input class="form-control in-c" name="name" value="<?php echo $user->name; ?>" required>

                </div>

                <div class="form-group">
                    <label for="mobile" class="lab-t">Phone</label>
                    <input type="number" class="form-control in-c" name="mobile" value="<?php echo $user->mobile; ?>"
                           required>
                </div>

                <div class="form-group">
                    <label for="password" class="lab-t">Password</label>
                    <input type="password" class="form-control in-c" name="password">
                </div>


            </div>
            <div class="col-12 p-3 in-fil">
                <div class="form-group">
                    <input type="hidden" name="amb_id" value="<?php echo $ambulance->amb_id; ?>" required>
                    <button type="submit" class="btn btn-info">Update</button>
                </div>
            </div>

        </div>
    </form>

</section>