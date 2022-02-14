<!-- services area  -->
<section class="area-hight">
    <div class="container">
        <div class="service-inner">
            <div class="row">
                <div class="col-md-4">
                    <?php echo $sidebar; ?>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Profile</h4>

                            <?php if (session()->getFlashdata('message') !== NULL) : ?>
                                <?php echo session()->getFlashdata('message'); ?>
                            <?php endif; ?>
                            <div class="row ">
                                <div class="col-12 d-flex justify-content-center align-items-center">
                                    <?php if (!empty($patient->photo)) { $profile = no_image_view('/assets/upload/patient/'.$patient->pat_id.'/'.$patient->photo,'/assets/upload/patient/no_image.jpg',$patient->photo); ?>
                                        <img src="<?php echo $profile; ?>" alt="user" class="pro-img">
                                    <?php } else { ?>
                                        <div class="af-pro ">
                                            <i class="flaticon-user-1 sm-icon-2"></i>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="col-3"></div>
                                <div class="col-6">
                                    <form action="<?php echo base_url('Web/Profile/update_action') ?>" method="POST"
                                          enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="name" class="lab-t">Name</label>
                                            <input class="form-control in-c" name="name"
                                                   value="<?php echo $patient->name; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="email" class="lab-t">Email</label>
                                            <input type="email" class="form-control in-c" name="email"
                                                   value="<?php echo $patient->email; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="phone" class="lab-t">Phone</label>
                                            <input type="number" class="form-control in-c" name="phone"
                                                   value="<?php echo $patient->phone; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="nid" class="lab-t">Nid</label>
                                            <input type="text" class="form-control in-c" name="nid"
                                                   value="<?php echo $patient->nid; ?>" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="age" class="lab-t">Age</label>
                                            <input type="number" class="form-control in-c" name="age"
                                                   value="<?php echo $patient->age; ?>" required>
                                        </div>

                                        <?php $address = (object)id_by_global_address($patient->global_address_id); ?>
                                        <div class="form-group">
                                            <label for="division" class="lab-t"> Division </label>
                                            <select class="form-control in-c" name="division"
                                                    onchange="viewdistrict(this.value)" required>
                                                <option value="">Please Select</option>
                                                <?php echo divisionView($address->division); ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="zila" class="lab-t"> Zila </label>
                                            <select class="form-control in-c" name="zila"
                                                    onchange="viewupazila(this.value)" id="district" required>
                                                <option value="">Please Select</option>
                                                <?php echo districtselect($address->zila, $address->division); ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="upazila" class="lab-t"> Upazila: </label>
                                            <select class="form-control in-c" name="upazila" id="subdistrict"
                                                    onchange="checkCity(this.value)" required>
                                                <option value="">Please Select</option>
                                                <?php echo upazilaselect($address->upazila, $address->zila); ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="password" class="lab-t">Password</label>
                                            <input type="password" class="form-control in-c" name="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="image" class="lab-t"> Image </label>
                                            <input type="file" class="form-control in-c" name="photo">
                                        </div>
                                        <div class="form-group">
                                            <button class="btn btn-info">Submit</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-3"></div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- services area  end-->