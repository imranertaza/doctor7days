
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ad Management View</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ad Management View</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 mt-2">
                                <h3 class="card-title">Ad Management View</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 mt-4" >
                                <?php if (!empty($add->h_id)){?>
                                    <?php $adBann = no_image_view('/assets/upload/adbanner/'.$add->h_id.'/'.$add->banner,'/assets/upload/adbanner/no_image.jpg',$add->banner);?>
                                <img src="<?php echo $adBann; ?>" alt="adbanner" style="max-width: 100%;">
                                <?php }else{ $adBann = no_image_view('/assets/upload/adbanner/'.$add->ad_com_id.'/'.$add->banner,'/assets/upload/adbanner/no_image.jpg',$add->banner);?>
                                <img src="<?php echo $adBann; ?>" alt="adbanner" style="max-width: 100%;">
                                <?php } ?>
                            </div>
                            <div class="col-6 mt-4">
                                <label>Company</label>
                                <p><?php echo get_data_by_id('name','hospital','h_id',$add->h_id);?></p>
                            </div>
                            <div class="col-6 mt-4">
                                <label>Package</label>
                                <p><?php echo get_data_by_id('name','ad_package','ad_package_id',$add->ad_package_id);?></p>
                            </div>
                            <div class="col-6" style="text-transform: capitalize;">
                                <label>Org Type</label>
                                <p><?php echo $add->org_type;?></p>
                            </div>
                            <div class="col-6" >
                                <label>Payment Status</label>
                                <?php $pval = ($add->payment_status == 0)?1:0; $psel = ($add->payment_status == 1)?'checked':''; ?>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="switch2" onchange="paymentStatusChange(this.value,'<?php echo $add->ad_id?>')" <?php echo $psel;?> value="<?php echo $pval;?>">
                                    <label class="custom-control-label" for="switch2"></label>
                                </div>
                            </div>
                            <div class="col-6" style="text-transform: capitalize;">
                                <label>Package View Limit</label>
                                <p><?php echo get_data_by_id('total_views','ad_package','ad_package_id',$add->ad_package_id);?></p>
                            </div>
                            <div class="col-6" style="text-transform: capitalize;">
                                <label>Ad Total View</label>
                                <p><?php echo $adCount;?></p>
                            </div>



                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- Add modal content -->

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script>


    function paymentStatusChange(status,id){

        $.ajax({
            url: '<?php echo base_url($controller.'/paumentstatusChange') ?>',
            type: 'post',
            data: {status:status,id:id}, // /converting the form data into array and sending it to server
            dataType: 'json',
            beforeSend: function() {
                $('#add-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
            },
            success: function(response) {

                if (response.success === true) {
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: response.messages,
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    if (response.messages instanceof Object) {
                        $.each(response.messages, function(index, value) {
                            var id = $("#" + index);

                            id.closest('.form-control')
                                .removeClass('is-invalid')
                                .removeClass('is-valid')
                                .addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

                            id.after(value);

                        });
                    } else {
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'error',
                            title: response.messages,
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                }
            }
        });
    }
</script>