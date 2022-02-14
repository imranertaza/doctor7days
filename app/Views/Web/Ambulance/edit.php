<!-- services area  -->
<section class="area-hight">
    <div class="container text-capitalize">
        <div class="service-inner">
            <div class="row">
                <div class="col-md-4">
                    <?php echo $sidebar; ?>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">

                                <div class="col-12">
                                    <h4 class="card-title">Ambulance Edit</h4>

                                    <?php if (session()->getFlashdata('message') !== NULL) : ?>
                                        <?php echo session()->getFlashdata('message'); ?>
                                    <?php endif; ?>
                                </div>

                                <div class="col-12 text-center" >
                                    <?php $image = (!empty($ambulance->image)) ? $ambulance->image : 'noimage.jpg'; ?>
                                    <img src="<?php echo base_url('assets/upload/ambulance/'.$ambulance->ambulance_user_id.'/'. $image) ?>" alt="ambulance" >
                                </div>

                                <div class="col-3 "></div>
                                <div class="col-6 ">
                                    <form action="<?php echo base_url('Web/Ambulance/update_action')?>" method="post" enctype="multipart/form-data" >

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

                                        <div class="form-group">
                                            <input type="hidden"  name="amb_id" value="<?php echo $ambulance->amb_id;?>">
                                            <button type="submit" class="btn btn-info">Update</button>
                                        </div>

                                    </form>
                                </div>
                                <div class="col-3 "></div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
<!-- services area  end-->