<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ad Package</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Ad Package</li>
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
                                <h3 class="card-title">Ad Package</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="data_table" class="table table-bordered table-striped" style="text-transform: capitalize;">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Org Type</th>
                                <th>Total View</th>
                                <th>Price</th>
                                <th>Recurring</th>
                                <th>Width</th>
                                <th>Height</th>
                                <th>Max Weight</th>
                            </tr>
                            </thead>
                        </table>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>


</div>
<!-- /.content-wrapper -->

<script>
    $(function () {
        $('#data_table').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            "ajax": {
                "url": '<?php echo base_url($controller.'/getAllPackage') ?>',
                "type": "POST",
                "dataType": "json",
                async: "true"
            }
        });
    });

    function add() {
        // reset the form
        $("#add-form")[0].reset();
        $('#add-modal').modal('show');
        // submit the add from
        $('#add-form').on('submit', function (e) {

            e.preventDefault();
            $.ajax({
                url: "<?php echo base_url($controller . '/add') ?>",
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
                            $('#data_table').DataTable().ajax.reload(null, false).draw(false);
                            $('#add-modal').modal('hide');
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

    function remove(ad_manage_id) {
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
                        ad_manage_id: ad_manage_id
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