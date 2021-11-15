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
                            <div class="col-md-4 mt-2">
                                <h3 class="card-title">Appointment</h3>
                            </div>
                            <div class="col-md-8">
                                <form action="<?php echo base_url($controller . '/search') ?>" method="post">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <select name="doc_id" class="form-control" required>
                                                <option value="">Please select</option>
                                                <?php foreach ($doctor as $item) {
                                                    $sel = ($item->doc_id == $doc_id) ? 'selected' : ''; ?>
                                                    <option value="<?php echo $item->doc_id; ?>" <?php echo $sel; ?>><?php echo $item->name; ?></option>
                                                <?php } ?>

                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <select name="time" class="form-control" required>

                                                <option value="">Please select</option>
                                                <option value="morning" <?php echo ($time == 'morning') ? 'selected' : ''; ?>>
                                                    Morning
                                                </option>
                                                <option value="evening" <?php echo ($time == 'evening') ? 'selected' : ''; ?>>
                                                    Evening
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="date" name="date" class="form-control"
                                                   min="<?php echo date('Y-m-d') ?>" value="<?php echo $date ?>"
                                                   required>
                                        </div>
                                        <div class="col-md-3">
                                            <button class="btn btn-primary">Filter</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body" id='DivIdToPrint'>
                        <div style="text-align: center; text-transform: capitalize; display: none;" id="titlehos">
                            <h3><?php echo newSession()->hospitalName; ?></h3>
                            <h5>Dr: <?php echo get_data_by_id('name','doctor','doc_id',$doc_id) ?></h5>
                            <p>Phone: <?php echo get_data_by_id('mobile','doctor','doc_id',$doc_id) ?></p>
                        </div>
                        <table id="data_table" class="table table-bordered table-striped"
                               style="text-transform: capitalize; text-align: center;">
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
                            <?php foreach ($result

                            as $item) {
                            $val = ($item->status == '1') ? '0' : '1';
                            $ch = ($item->status == '1') ? 'checked' : ''; ?>
                            <tr>
                                <td><?php echo $item->appointment_id ?></td>
                                <td><?php echo get_data_by_id('name', 'doctor', 'doc_id', $item->doc_id) ?></td>
                                <td><?php echo $item->pat_id ?></td>
                                <td><?php echo $item->day ?></td>
                                <td><?php echo $item->time ?></td>
                                <td><?php echo globalDateFormat($item->date) ?></td>
                                <td><?php echo $item->name ?></td>
                                <td><?php echo $item->phone ?></td>
                                <td><?php echo $item->serial_number ?></td>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <input type='button' class="btn btn-primary" id='btn' value='Print' onclick='printDiv();' style="float: right;">
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
    function printDiv() {
        $('#titlehos').css('display','block');
        var divToPrint = document.getElementById('DivIdToPrint');

        var newWin = window.open('', 'Print-Window');

        newWin.document.open();

        newWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
        $('#titlehos').css('display','none');
        newWin.document.close();

        setTimeout(function () {
            newWin.close();
        }, 10);

    }
</script>