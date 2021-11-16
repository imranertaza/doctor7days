<section class="back">
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/Patient/dashboard') ?>"><i class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="category mt-1">
    <div class="row ">
        <?php if (!empty($patient->photo)) { ?>
            <div class="col-12">
                <center>
                    <img src="<?php echo base_url('assets/uplode/patient/'.$patient->photo)?>" alt="user"
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
    <form action="<?php echo base_url('Mobile_app/Patient/update_action') ?>" method="POST" enctype="multipart/form-data">
        <div class="row">

            <div class="col-12 p-3 ">
                <?php if (session()->getFlashdata('message') !== NULL) : ?>
                    <?php echo session()->getFlashdata('message'); ?>
                <?php endif; ?>
            </div>

            <div class="col-12 p-3 in-fil">

                <div class="form-group">
                    <label for="name" class="lab-t">Name</label>
                    <input class="form-control in-c" name="name" value="<?php echo $patient->name;?>" required>
                </div>
                <div class="form-group">
                    <label for="email" class="lab-t">Email</label>
                    <input type="email" class="form-control in-c" name="email" value="<?php echo $patient->email; ?>" required>
                </div>
                <div class="form-group">
                    <label for="phone" class="lab-t">Phone</label>
                    <input type="number" class="form-control in-c" name="phone" value="<?php echo $patient->phone; ?>" required>
                </div>

                <div class="form-group">
                    <label for="nid" class="lab-t">Nid</label>
                    <input type="text" class="form-control in-c" name="nid" value="<?php echo $patient->nid; ?>" required>
                </div>
                <div class="form-group">
                    <label for="age" class="lab-t">Age</label>
                    <input type="number" class="form-control in-c" name="age" value="<?php echo $patient->age; ?>" required>
                </div>

                <?php $address = id_by_global_address($patient->global_address_id); ?>
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
                    <label for="password" class="lab-t">Password</label>
                    <input type="password" class="form-control in-c" name="password" >
                </div>


                <div class="form-group">
                    <label for="image" class="lab-t"> Image </label>
                    <input type="file" class="form-control in-c" name="photo" >
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