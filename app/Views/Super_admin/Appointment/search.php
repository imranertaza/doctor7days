<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Appointment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Appointment</li>
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
                            <div class="col-md-8 mt-2">
                                <h3 class="card-title">Appointment</h3>
                            </div>
                            <div class="col-md-4">
                                <button type="button" class="btn btn-block btn-success" onclick="add()" title="Add"> <i class="fa fa-plus"></i> Add</button>

                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <form action="<?php echo base_url('Super_admin/appointment/appointment_search')?>" method="post">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="division" class="lab-t"> Division </label>
                                    <select class="form-control in-c" name="division"
                                            onchange="viewdistrict(this.value)"
                                            required>
                                        <option value="">Please Select</option>
                                        <?php echo divisionView(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="zila" class="lab-t"> Zila </label>
                                    <select class="form-control in-c" name="zila"
                                            onchange="viewupazila(this.value)"
                                            id="district" >
                                        <option value="">Please Select</option>
                                        <?php echo districtselect(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="upazila" class="lab-t"> Upazila: </label>
                                    <select class="form-control in-c" name="upazila" id="subdistrict"
                                            onchange="checkCity(this.value)" >
                                        <option value="">Please Select</option>
                                        <?php echo upazilaselect(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <button type="submit" class="btn btn-info " style="margin-top: 35px">Search</button>
                                </div>

                            </div>
                        </form>
                        <table id="data_table" class="table table-bordered table-striped" style="text-transform: capitalize;">
                            <thead>
                                <tr>
                                    <th>Appointment id</th>
                                    <th>Doctor</th>
                                    <th>Pat id</th>
                                    <th>Day</th>
                                    <th>Time</th>
                                    <th>Date</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Serial number</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($appointment as $value){ ?>
                                    <tr>
                                        <td><?php echo $value->appointment_id; ?></td>
                                        <td><?php echo get_data_by_id('name','doctor','doc_id',$value->doc_id); ?></td>
                                        <td><?php echo $value->pat_id; ?></td>
                                        <td><?php echo $value->day; ?></td>
                                        <td><?php echo $value->time; ?></td>
                                        <td><?php echo globalDateFormat($value->date); ?></td>
                                        <td><?php echo $value->name; ?></td>
                                        <td><?php echo $value->phone; ?></td>
                                        <td><?php echo $value->serial_number; ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
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
    <!-- Add modal content -->



</div>
<!-- /.content-wrapper -->

<script>
</script>