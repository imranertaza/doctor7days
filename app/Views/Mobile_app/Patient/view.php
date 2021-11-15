<section class="back">
    <div class="row">
        <div class="col-12 p-2 pl-3 pt-3">
            <a href="<?php echo base_url('Mobile_app/Patient/dashboard') ?>"><i
                        class="flaticon-left-arrow back-icon"></i></a>
        </div>
    </div>
</section>

<section class="category mt-1">
    <div class="row bg-c">
        <div class="col-12 row">
            <div class="col-2">
                <i class="flaticon-checkup ti-icon"></i>
            </div>
            <div class="col-10 p-2">
                <span class="title-m">Appionment view</span>
            </div>
        </div>
    </div>
</section>

<section class="banner">
    <div class="row">
        <div class="col-12 p-3 in-fil mt-4" style="text-transform: capitalize;">
            <p><b>Hospital:</b> <?php echo get_data_by_id('name','hospital','h_id',$appointment->h_id) ?>  </p>

            <p><b>Doctor:</b> <?php $spsa = get_data_by_id('specialist_id','doctor','doc_id',$appointment->doc_id);$spsatype = get_data_by_id('specialist_type_name','specialist','specialist_id',$spsa); echo get_data_by_id('name','doctor','doc_id',$appointment->doc_id);?> <br><span class="lab-t"><?php echo $spsatype;?></span></p>

            <p><b>Date:</b> <?php echo globalDateFormat($appointment->date) ?>  <b>Time:</b> <?php echo $appointment->time ?></p>
            <p><b>Serial:</b> (<?php echo $appointment->serial_number ?>) </p>
        </div>
    </div>

</section>