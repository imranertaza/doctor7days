<div id="searchResult">
<section class="back">
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/diagnostic')?>"><i class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="category mt-1">
    <div class="row bg-c">
        <div class="col-12 row">
            <div class="col-2">
                <i class="flaticon-diagnostic ti-icon"></i>
            </div>
            <div class="col-10 p-2">
                <span class="title-m">Diagnostic & Pathology</span>
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
        <form id="searchForm" action="<?php echo base_url('Mobile_app/Diagnostic/diagnostic_center_list') ?>" method="POST" style="width: 100%;" >
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
                        <?php echo upazilaselect() ; ?>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-default" style="background-color: #28aed6;color: white " id="sub-btn" onclick="searchHospital()">Submit
                    </button>
                </div>

            </div>

        </form>
    </div>
</section>

<section class="banner" >
    <div class="row">
        <div class="col-12 p-3 " >
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner" id="addView">
                </div>
            </div>
            <div class="num"></div>
        </div>
    </div>
</section>
</div>

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