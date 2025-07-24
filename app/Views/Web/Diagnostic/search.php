<!-- services area  -->
<div id="searchResult">
<section class="area-hight">
    <div class="container text-capitalize">
        <div class="service-text text-center">
            <h1>Diagnostic & Pathology search</h1>
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
                    <form id="searchForm" action="<?php echo base_url('Web/Diagnostic/search_result') ?>" method="POST">
                                <div class="form-group">
                                    <label for="division" class="lab-t"> Division </label>
                                    <select class="form-control in-c" name="division" onchange="viewdistrict(this.value)" required>
                                        <option value="">Please Select</option>
                                        <?php echo divisionView(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="zila" class="lab-t"> Zila </label>
                                    <select class="form-control in-c" name="zila" onchange="viewupazila(this.value)" id="district" >
                                        <option value="">Please Select</option>
                                        <?php echo districtselect(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="upazila" class="lab-t"> Upazila: </label>
                                    <select class="form-control in-c" name="upazila" id="subdistrict" >
                                        <option value="">Please Select</option>
                                        <?php echo upazilaselect(); ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-default" style="background-color: #28aed6;color: white " id="sub-btn" onclick="searchHospital()" >Search </button>
                                </div>
                            </form>
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