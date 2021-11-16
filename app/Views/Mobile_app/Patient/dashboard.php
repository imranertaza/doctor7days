

<section class="category mt-5">
    <div class="row">
        <div class="col-12 p-3  in-fil text-center">
            <?php if (!empty($patient->photo)){?>
                <center>
                    <img src="<?php echo base_url('assets/uplode/patient/'.$patient->photo)?>" alt="user" class="pro-img" >
                </center>
            <?php }else{?>
                <div class="af-pro">
                    <i class="flaticon-user-1 sm-icon-2"></i>
                </div>
            <?php } ?>
            <p><?php echo $patient->name;?></p>
            <a href="<?php echo  base_url('Mobile_app/Patient/profile')?>" class="btn-ambu">Edit profile</a>
        </div>

    </div>
</section>

<section class="banner">
    <div class="row">
        <div class="col-12 p-3 ">
            <?php if (session()->getFlashdata('message') !== NULL) : ?>
                <?php echo session()->getFlashdata('message'); ?>
            <?php endif; ?>
        </div>
        <div class="col-12 p-3 row" style="padding-right: 0px !important; text-transform: capitalize;">
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


    </div>


</section>