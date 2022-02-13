<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ad Management Update</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ad Management Update</li>
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
                                <h3 class="card-title">Ad Management Update</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#registered">Basic</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#basic">Address</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-12">
                                <div class="tab-content">
                                    <div class="tab-pane active container" id="registered">
                                        <form id="updaue-reg" class="pl-3 pr-3">
                                            <div class="row pt-4">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name"> Package: <span class="text-danger">*</span> </label>
                                                        <select id="ad_package_id" name="ad_package_id" class="form-control" placeholder="Package"  required>
                                                            <option value="">Please select</option>
                                                            <?php foreach ($adPack as $item) { $sel = ($item->ad_package_id == $admanage->ad_package_id)?'selected':''; ?>
                                                                <option value="<?php echo $item->ad_package_id?>"  <?php echo $sel;?>><?php echo $item->name?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="org_type"> Org Type: <span class="text-danger">*</span> </label>
                                                        <select id="org_type" name="org_type" class="form-control" required>
                                                            <option value="">Please select</option>
                                                            <option value="hospital" <?php echo ('hospital' == $admanage->org_type)?'selected':'';?> >Hospital</option>
                                                            <option value="national" <?php echo ('national' == $admanage->org_type)?'selected':'';?>>National</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="banner"> Banner: </label>
                                                        <input type="file" id="banner" name="banner" class="form-control" >
                                                    </div>
                                                </div>

                                                <div class="col-md-6" id="imgrelode">
                                                    <?php $id = (!empty($admanage->h_id))?$admanage->h_id:$admanage->ad_com_id;?>
                                                    <?php $adBann = no_image_view('/assets/upload/adbanner/'.$id.'/'.$admanage->banner,'/assets/upload/adbanner/no_image.jpg',$admanage->banner);?>
                                                    <img src="<?php echo $adBann; ?>" alt="banner" width="250">
                                                </div>

                                                <div class="col-md-12">
                                                    <input type="hidden" id="ad_id" name="ad_id"
                                                           value="<?php echo $admanage->ad_id; ?>" required>
                                                    <button type="submit" onclick="updateReg()" class="btn btn-success"
                                                            id="add-form-btn"
                                                            style="float: right;">Update
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>


                                    <div class="tab-pane container" id="basic">
                                        <form id="update-basic" class="pl-3 pr-3">
                                            <div class="row pt-4">
                                                <?php foreach (division() as $key => $dis){?>
                                                    <div class="col-md-6">
                                                        <ul class="list-unstyled">
                                                            <li>
                                                                <div class="form-check">
                                                                    <!-- <input class="form-check-input" name="district[]" type="checkbox"  id="flexCheckDefault_--><?php //echo $key+1?><!--" value="--><?php //echo $dis['id'];?><!--">-->
                                                                    <label class="form-check-label" for="flexCheckDefault_<?php echo $key+1?>"><?php echo $dis['name'];?></label>
                                                                </div>
                                                                <ul>
                                                                    <li class="list-unstyled">
                                                                        <?php echo div_by_dist($dis['id'], $admanage->district_id);?>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                <?php }?>

                                                <div class="col-md-6 text-center">
                                                    <input type="hidden" id="ad_id" name="ad_id"
                                                           value="<?php echo $admanage->ad_id; ?>" required>
                                                    <button type="submit" onclick="updateBasic()"
                                                            class="btn btn-success"
                                                            id="up-basic-btn" style="margin-top: 30px;">Update
                                                    </button>

                                                </div>

                                            </div>
                                        </form>
                                    </div>



                                </div>
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


</div>
<!-- /.content-wrapper -->

<script>

    function updateReg(){
        $('#updaue-reg').on('submit', function (e) {

            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url($controller . '/update_action') ?>",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function () {
                    $('#add-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function (response) {
                    if (response.success === true) {
                        Swal.fire({
                            position: 'bottom-end',
                            icon: 'success',
                            title: response.messages,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            $('#banner').val('');
                            $('#imgrelode').load(document.URL + ' #imgrelode');
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
                    $('#add-form-btn').html('Update');
                }
            });

        });
    }
    function updateBasic() {
        $('#update-basic').on('submit', function (e) {

            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url($controller . '/update_add_action') ?>",
                method: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                beforeSend: function () {
                    $('#up-basic-btn').html('<i class="fa fa-spinner fa-spin"></i>');
                },
                success: function (response) {
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
                    $('#up-basic-btn').html('Update');
                }
            });

        });
    }

    function remove(ad_id) {
        Swal.fire({
            title: 'Are you sure of the deleting process?',
            text: "You cannot back after confirmation",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm',
            cancelButtonText: 'Cancel'
        }).then((result) => {

            if (result.value) {
                $.ajax({
                    url: '<?php echo base_url($controller.'/remove') ?>',
                    type: 'post',
                    data: {
                        ad_id: ad_id
                    },
                    dataType: 'json',
                    success: function(response) {

                        if (response.success === true) {
                            Swal.fire({
                                position: 'bottom-end',
                                icon: 'success',
                                title: response.messages,
                                showConfirmButton: false,
                                timer: 1500
                            }).then(function() {
                                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
                            })
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
                });
            }
        })
    }
</script>