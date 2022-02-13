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
        <div class="col-12 text-center" >
            <?php $image = no_image_view('/assets/upload/ambulance/'.$ambulance->ambulance_user_id.'/'.$ambulance->image,'/assets/upload/ambulance/no_image.jpg',$ambulance->image) ?>
            <img src="<?php echo $image; ?>" alt="ambulance" >
        </div>
    </div>
</section>

<section class="banner">
    <form action="<?php echo base_url('Mobile_app/Ambulance_dashboard/update_action') ?>" method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-12 p-3 ">
                <?php if (session()->getFlashdata('messageAddress') !== NULL) : ?>
                    <?php echo session()->getFlashdata('messageAddress'); ?>
                <?php endif; ?>
                <?php if (session()->getFlashdata('message') !== NULL) : ?>
                    <?php echo session()->getFlashdata('message'); ?>
                <?php endif; ?>
            </div>

            <div class="col-12 p-3 in-fil">

                <div class="form-group">
                    <label for="image" class="lab-t"> Image </label>
                    <input type="file" class="form-control in-c" name="image">
                </div>

                <div class="form-group">
                    <label for="division" class="lab-t">Ambulance Number</label>
                    <input class="form-control in-c" name="car_model_name" value="<?php echo $ambulance->car_model_name; ?>" required>

                </div>

                <div class="form-group">
                    <label for="Oxygen" class="lab-t"> Oxygen </label>
                    <select class="form-control in-c" name="oxygen" required>
                        <option value="">Please Select</option>
                        <option value="yes" <?php if ($ambulance->oxygen == 'yes') {
                            echo 'selected';
                        } ?> >Yes
                        </option>
                        <option value="no" <?php if ($ambulance->oxygen == 'no') {
                            echo 'selected';
                        } ?>>No
                        </option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="ac" class="lab-t"> AC </label>
                    <select class="form-control in-c" name="ac" required>
                        <option value="">Please Select</option>
                        <option value="yes" <?php if ($ambulance->ac == 'yes') {
                            echo 'selected';
                        } ?>>Yes
                        </option>
                        <option value="no" <?php if ($ambulance->ac == 'no') {
                            echo 'selected';
                        } ?>>No
                        </option>
                    </select>
                </div>


                <?php
                $address = (object) id_by_global_address($ambulance->global_address_id);
                ?>
                <div class="form-group">
                    <label for="division" class="lab-t"> Division </label>
                    <select class="form-control in-c" name="division" onchange="viewdistrict(this.value)" required>
                        <option value="">Please Select</option>
                        <?php echo divisionView($address->division); ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="zila" class="lab-t"> Zila </label>
                    <select class="form-control in-c" name="zila" onchange="viewupazila(this.value)" id="district" required>
                        <option value="">Please Select</option>
                        <?php echo districtselect($address->zila, $address->division); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="upazila" class="lab-t"> Upazila: </label>
                    <select class="form-control in-c" name="upazila" id="subdistrict" onchange="checkCity(this.value)" required>
                        <option value="">Please Select</option>
                        <?php echo upazilaselect($address->upazila, $address->zila); ?>
                    </select>
                </div>




                <div class="form-group">
                    <label for="description" class="lab-t"> Description </label>
                    <textarea class="form-control" rows="6" name="description" id="" required><?php echo $ambulance->description; ?></textarea>
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