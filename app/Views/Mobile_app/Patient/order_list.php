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
                <i class="flaticon-menu ti-icon"></i>
            </div>
            <div class="col-10 p-2" >
                <span class="title-m">Order List</span>
            </div>
        </div>

    </div>
</section>


<section class="banner">
    <div class="row">
        <div class="col-12 p-3 " style="text-transform: capitalize;">
            <table class="table ">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                        <th>A</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($order as $item) { ?>
                    <tr>
                        <td><?php echo date( 'd-m-y', strtotime($item->createdDtm)); ?></td>
                        <td><?php echo priceSymbol($item->final_amount); ?></td>
                        <td><?php echo orderStatusView($item->status); ?></td>
                        <td>
                            <a href="<?php echo base_url('Mobile_app/Patient/invoice/'.$item->order_id);?>"><i class="flaticon-view"></i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>

            </table>
        </div>
    </div>


</section>