<!-- services area  -->
<section class="area-hight">
    <div class="container">
        <div class="service-inner">
            <div class="row">
                <div class="col-md-4">
                    <?php echo $sidebar; ?>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Inbox</h4>
                            <?php if (session()->getFlashdata('message') !== NULL) : ?>
                                <?php echo session()->getFlashdata('message'); ?>
                            <?php endif; ?>

                            <div class="row ">
                                <div class="col-12 ">
                                    <table class="table active">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Title</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($inbox as $val){ if ($val->for_patient == 'Specific'){
                                            $cusId = newSession()->Patient_user_id;
                                            $table = DB()->table('message');
                                            $specific = $table->join('message_to','message_to.message_id = message.message_id')->where('message.message_id',$val->message_id)->where('message_to.to_patient_id',$cusId)->get()->getRow();
                                            ?>
                                            <tr>
                                                <td><?php echo $specific->message_id;?></td>
                                                <td><?php echo $specific->title;?></td>
                                                <td>
                                                    <a href="<?php echo base_url('Web/Inbox/view/'.$specific->message_id)?>"><i class="flaticon-view"></i></a>
                                                </td>
                                            </tr>
                                        <?php } if ($val->for_patient == 'All'){ ?>
                                            <tr>
                                                <td><?php echo $val->message_id;?></td>
                                                <td><?php echo $val->title;?></td>
                                                <td>
                                                    <a href="<?php echo base_url('Web/Inbox/view/'.$val->message_id)?>"><i class="flaticon-view"></i></a>
                                                </td>
                                            </tr>
                                        <?php } }?>
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