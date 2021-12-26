<section class="banner ">
        <div class="row">
            <div class="col-12 p-3 pt-5  text-center" >
                <h3>Thank You!</h3>
                <div class="hr-div"></div>
            </div>

            <div class="col-6 " style="padding-right:unset;">
                <h4>Order Receipt</h4>
                <div style="font-size: 10px;">
                <b>Data:</b> <?php echo date( 'd-m-Y', strtotime($order->createdDtm)); ?><br>
                <b>OrderId:</b> <?php echo $order->order_id; ?><br>
                <b>Customer Number:</b> <?php echo get_data_by_id('phone', 'patient', 'pat_id', $order->patient_id);?><br>
                </div>
            </div>
            <div class="col-6">
                <h6>Billed to:</h6>
                <div style="font-size: 10px;">
                    <b>Method:</b> Bkash<br>
                    <b>Date:</b> <?php echo date( 'd-m-Y', strtotime($order->createdDtm)); ?><br>
                    <b>Number:</b>01923121212<br>
                </div>
            </div>
            <div class="col-12 p-3 text-center">
                <div class="hr-div"></div>
            </div>
            <div class="col-12 " style="text-transform: capitalize;font-size: 14px;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($orderItem as $item){?>
                        <tr>
                            <td><?php echo get_data_by_id('name', 'products', 'prod_id',$item->prod_id);?></td>
                            <td><?php echo priceSymbol($item->price) ?></td>
                            <td><?php echo $item->quantity?></td>
                            <td><?php echo priceSymbol($item->total_price) ?></td>
                        </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="2">Shipping</td>
                        <td></td>
                        <td><?php echo priceSymbol($order->delivery_charge);?></td>
                    </tr>
                    </tbody>
                    <tfoot>

                        <tr>
                            <th colspan="2">Total</th>
                            <th></th>
                            <th><?php echo priceSymbol($order->final_amount);?></th>
                        </tr>
                    </tfoot>

                </table>
            </div>

            <div class="col-12 p-3 text-right no-print">
                <button class="btn " onclick="window.print();" style="background-color: #0a0e14;color: #ffffff">Print</button>
            </div>

            <div class="col-12 mb-4">

                <center><a href="<?php echo base_url('Mobile_app/Patient/order')?>" type="submit" class="btn" style="margin-top: -45px;">
                        <div class="cb-round text-center"  style="transform: rotate(
180deg);">
                            <i class="flaticon-keyboard-right-arrow-button nw-ar"></i>
                        </div>
                    </a></center>
                <center><img src="<?php echo superLogo()?>" class="logo-main"></center>

            </div>
        </div>

</section>