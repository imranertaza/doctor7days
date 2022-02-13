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
                            <h4 class="card-title">Order List</h4>

                            <?php if (session()->getFlashdata('message') !== NULL) : ?>
                                <?php echo session()->getFlashdata('message'); ?>
                            <?php endif; ?>

                            <div class="row ">

                                <div class="col-12 ">
                                    <table class="table active">
                                        <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($order as $item) { ?>
                                            <tr>
                                                <td><?php echo date( 'd-m-y', strtotime($item->createdDtm)); ?></td>
                                                <td><?php echo priceSymbol($item->final_amount); ?></td>
                                                <td><?php echo orderStatusView($item->status); ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('Web/OrderList/invoice/'.$item->order_id);?>"><i class="flaticon-view"></i></a>
                                                </td>
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