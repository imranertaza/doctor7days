<!-- services area  -->
<section class="area-hight">
    <div class="container text-capitalize">
        <div class="service-text text-center">
            <h1>Ambulance Search</h1>
        </div>
        <div class="service-inner">
            <form action="<?php echo base_url('Web/Ambulance/search') ?>" method="POST" style="width: 100%;">
                <div class="row">
                    <div class="col-12 p-3 ">
                        <?php if (session()->getFlashdata('message') !== NULL) : ?>
                            <?php echo session()->getFlashdata('message'); ?>
                        <?php endif; ?>
                    </div>

                    <div class="col-4"></div>
                    <div class="col-4">

                        <div class="form-group">
                            <label for="division" class="lab-t"> Division </label>
                            <select class="form-control in-c" name="division" onchange="viewdistrict(this.value)"
                                    required>
                                <option value="">Please Select</option>
                                <?php echo divisionView(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="zila" class="lab-t"> Zila </label>
                            <select class="form-control in-c" name="zila" onchange="viewupazila(this.value)"
                                    id="district"
                                    required>
                                <option value="">Please Select</option>
                                <?php echo districtselect(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="upazila" class="lab-t"> Upazila: </label>
                            <select class="form-control in-c" name="upazila" id="subdistrict"
                                    onchange="checkCity(this.value)"
                                    required>
                                <option value="">Please Select</option>
                                <?php echo upazilaselect(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-default" style="background-color: #28aed6;color: white ">Submit
                            </button>
                        </div>
                    </div>
                    <div class="col-4"></div>


                </div>
            </form>
        </div>
    </div>
</section>
<!-- services area  end-->