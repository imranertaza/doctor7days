<!-- services area  -->
<section class="area-hight">
    <div class="container">
        <div class="service-inner">
            <div class="row">
                <div class="col-md-4">
                    <?php echo $sidebar;?>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Dashboard</h4>

                            <center><h5 class="card-title mb-3">Appointment List</h5></center>
                            <nav>
                                <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">

                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><img src="<?php echo base_url() ?>/assets/mobile/image/bd.png" class="icon-css">
                                        Bangladesh</a>
                                    <a class="nav-item nav-link " id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"> <img src="<?php echo base_url() ?>/assets/mobile/image/ind.png" class="icon-css"> Indian</a>


                                </div>
                            </nav>
                            <div class="tab-content mt-4" id="nav-tabContent">
                                <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                    <table class="table ">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Doctor</th>
                                            <th>Time</th>
                                            <th>Sl</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($appointment as $key => $item) {?>
                                            <tr>
                                                <td><?php echo globalDateFormat($item->date) ?></td>
                                                <td><?php echo get_data_by_id('name','doctor','doc_id',$item->doc_id)   ?></td>
                                                <td><?php echo $item->time ?></td>
                                                <td><?php echo $item->serial_number ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('Mobile_app/Patient/view/'.$item->appointment_id)?>" class="btn" style="color: green;" title="View" ><i class="flaticon-view"></i></a>
                                                    <a href="<?php echo base_url('Mobile_app/Patient/cancel/'.$item->appointment_id)?>" class="btn" style="color: red;" title="Cencel" onclick="return confirm('Are you sure cencel appionment ？')" ><i class="flaticon-delete
"></i></a> </td>
                                            </tr>
                                        <?php } ?>

                                        </tbody>

                                    </table>
                                </div>

                                <div class="tab-pane fade " id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                    <table class="table ">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Hospital</th>
                                            <th>Branch</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($indAppionment as $key => $val) {?>
                                            <tr>
                                                <td><?php echo globalDateFormat($val->createdDtm) ?></td>
                                                <td><?php echo get_data_by_id('name','indian_hospital','ind_h_id',$val->ind_h_id) ?></td>
                                                <td><?php echo get_data_by_id('branch_name','indian_hospital_branch','ind_hos_bran_id',$val->ind_hos_bran_id) ?></td>
                                                <td><?php echo in_appoin_status_view($val->status) ?></td>
                                            </tr>
                                        <?php } ?>

                                        </tbody>

                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- services area  end-->