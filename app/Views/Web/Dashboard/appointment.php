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
                            <h4 class="card-title">Appointment View</h4>
                            <div class="row">
                                <div class="col-12 text-capitalize">
                                    <p><b>Hospital:</b> <?php echo get_data_by_id('name','hospital','h_id',$appointment->h_id) ?>  </p>
                                    <p><b>Doctor:</b> <?php $spsa = get_data_by_id('specialist_id','doctor','doc_id',$appointment->doc_id);$spsatype = get_data_by_id('specialist_type_name','specialist','specialist_id',$spsa); echo get_data_by_id('name','doctor','doc_id',$appointment->doc_id);?> <br><span class="lab-t"><?php echo $spsatype;?></span></p>
                                    <p><b>Date:</b> <?php echo globalDateFormat($appointment->date) ?>  <b>Time:</b> <?php echo $appointment->time ?></p>
                                    <p><b>Serial:</b> (<?php echo $appointment->serial_number ?>) </p>
                                </div>
                            </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- services area  end-->