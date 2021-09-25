<section class="back">
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/home')?>"><i class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="category mt-1">
    <div class="row bg-c">
        <div class="col-12 row">
            <div class="col-2">
                <i class="flaticon-checkup ti-icon"></i>
            </div>
            <div class="col-8 p-2">
                <span class="title-m">Doctor Appionment</span>
            </div>
        </div>
    </div>
</section>

<section class="banner">
    <div class="row">
        <div class="col-12 p-3 ">
            <p class="sub-t">Choose your addiction/locations</p>
        </div>
        <div class="col-12 p-3 ">
            <?php if (session()->getFlashdata('message') !== NULL) : ?>
                <?php echo session()->getFlashdata('message'); ?>
            <?php endif; ?>
        </div>
        <form action="<?php echo base_url('mobile_app/appionment/diagnostic_center_list')?>" method="POST">
            <div class="col-12 p-3 in-fil">

                <div class="form-group">
                    <label for="division" class="lab-t"> Division </label>
                    <select class="form-control in-c" name="division" onchange="viewdistrict(this.value)" required >
                        <option value="">Please Select</option>
                        <?php echo divisionView() ; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="zila" class="lab-t"> Zila </label>
                    <select class="form-control in-c" name="zila" onchange="viewupazila(this.value)" id="district" required>
                        <option value="">Please Select</option>
                        <?php echo districtselect() ; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="upazila" class="lab-t"> Upazila: </label>
                    <select class="form-control in-c" name="upazila" id="subdistrict" onchange="checkCity(this.value)"  required>
                        <option value="">Please Select</option>
                        <?php echo upazilaselect($upazila) ; ?>
                    </select>
                </div>


            </div>
            <div class="col-12 p-1 row">
                <div class="col-9" style="padding: 0px !important;">
                    <img src="<?php echo base_url() ?>/assets/mobile/image/2nf.JPG" width="100%">
                </div>
                <div class="col-3 st">
                    <button type="submit" class="btn">
                        <div class="cb-round text-center">
                            <i class="flaticon-keyboard-right-arrow-button nw-ar"></i>
                        </div>
                    </button>
                </div>
            </div>
        </form>

    </div>
</section>