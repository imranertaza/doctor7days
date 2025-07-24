<!-- services area  -->
<div id="searchResult">
<section class="area-hight">
    <div class="container text-capitalize">
        <div class="service-text text-center">
            <h1>Doctor Appionment</h1>
            <p>Choose your addiction/locations</p>
        </div>
        <div class="service-inner">
            <div class="row">
                    <div class="col-12 p-2 ">
                        <?php if (session()->getFlashdata('message') !== NULL) : ?>
                            <?php echo session()->getFlashdata('message'); ?>
                        <?php endif; ?>
                    </div>
                    <div class="col-4"></div>
                    <div class="col-4 p-2 ">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">

                                <a class="nav-item nav-link active show " id="nav-home-tab" data-toggle="tab"
                                   href="#nav-home" role="tab"
                                   aria-controls="nav-home" aria-selected="true"><img
                                            src="<?php echo base_url() ?>/assets/mobile/image/bd.png" class="icon-css">
                                    Bangladesh</a>
                                <a class="nav-item nav-link " id="nav-profile-tab" data-toggle="tab"
                                   href="#nav-profile" role="tab"
                                   aria-controls="nav-profile" aria-selected="false"> <img
                                            src="<?php echo base_url() ?>/assets/mobile/image/ind.png" class="icon-css">
                                    Indian</a>

                            </div>
                        </nav>
                        <div class="tab-content mt-2" id="nav-tabContent">

                            <div class="tab-pane fade active show" id="nav-home" role="tabpanel"
                                 aria-labelledby="nav-home-tab">

                                <form id="searchForm" action="<?php echo base_url('Web/Appointment/search_location') ?>" method="POST">
                                    <div class="form-group">
                                        <label for="division" class="lab-t"> Division </label>
                                        <select class="form-control in-c" name="division"
                                                onchange="viewdistrict(this.value)"
                                                required>
                                            <option value="">Please Select</option>
                                            <?php echo divisionView(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="zila" class="lab-t"> Zila </label>
                                        <select class="form-control in-c" name="zila"
                                                onchange="viewupazila(this.value)"
                                                id="district" >
                                            <option value="">Please Select</option>
                                            <?php echo districtselect(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="upazila" class="lab-t"> Upazila: </label>
                                        <select class="form-control in-c" name="upazila" id="subdistrict"
                                                onchange="checkCity(this.value)" >
                                            <option value="">Please Select</option>
                                            <?php echo upazilaselect(); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="specialist" class="lab-t"> Specialist: </label>
                                        <select class="form-control in-c" name="specialist">
                                            <option value="">Please select</option>
                                            <?php echo getListInOption('', 'specialist_id', 'specialist_type_name', 'specialist') ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <button class="btn btn-default" style="background-color: #28aed6;color: white " id="sub-btn" onclick="searchHospital()">Search </button>
                                    </div>
                                </form>
                            </div>

                            <div class="tab-pane fade " id="nav-profile" role="tabpanel"
                                 aria-labelledby="nav-profile-tab">
                                <?php if (newSession()->isPatientLoginWeb == true) { ?>
                                    <form action="<?php echo base_url('Web/Appointment/indian_appionment_action') ?>"
                                          method="POST">
                                        <div class="form-group">
                                            <label for="name" class="lab-t"> Name</label>
                                            <input type="text" class="form-control in-c" name="name" placeholder="Name"
                                                   value="<?php echo newSession()->Patient_name; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="phone" class="lab-t"> Phone</label>
                                            <input type="number" class="form-control in-c" name="phone"
                                                   placeholder="Phone"
                                                   value="<?php echo newSession()->Patient_phone; ?>" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="division" class="lab-t"> Hospital </label>
                                            <select class="form-control in-c" name="inHospital"
                                                    onchange="getBranch(this.value)"
                                                    required>
                                                <option value="">Please Select</option>
                                                <?php foreach ($inhospital as $hos) { ?>
                                                    <option value="<?php echo $hos->ind_h_id ?>"><?php echo $hos->name ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="hos_branch" class="lab-t"> Branch </label>
                                            <select class="form-control in-c" name="hos_branch" id="hos_branch"
                                                    required>
                                                <option value="">Please Select</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-default"
                                                    style="background-color: #28aed6;color: white ">Submit
                                            </button>
                                        </div>

                                    </form>
                                <?php } else { ?>
                                    <div class="form-group text-center">
                                        <p> After login, you can send indian appointment request. </p>
                                        <center><a href="<?php echo base_url('Web/login') ?>">Please
                                                click here to login</a></center>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>

                    </div>
                    <div class="col-4"></div>


                </div>
        </div>
    </div>
</section>
</div>
<!-- services area  end-->

<script>
    function searchHospital(){
        $('#searchForm').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
                type     : "POST",
                cache    : false,
                url: $(this).attr('action'),
                data: $(this).serialize(),
                beforeSend: function () {
                    $('#sub-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function (data) {
                    $('#searchResult').html(data);
                    $('#sub-btn').html('Search');
                }
            });
        });
    }
</script>