<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Pesanan</h1>

                <br /><br /><br />

                <br><br>

                <table class="tbl-full">
                    <tr>
                        <th width="30%">Order ID</th>
                        <th width="30%">Order Date</th>
                        <th width="40%">Total</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //Get all the orders from database
                        $sql = "SELECT order_id,
                        order_date,
                        sum(price*quantity) as total FROM data_pesan GROUP BY order_id ORDER BY order_date ASC"; // DIsplay the Latest Order at First
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count the Rows
                        $count = mysqli_num_rows($res);

                        $total = 0; //Create a Serial Number and set its initail value as 1

                        if($count>0)
                        {
                            //Order Available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Get all the order details
                                $order_id = $row['order_id'];
                                $order_date = $row['order_date'];
                                $total = $row['total'];
                                ?>

                                    <tr>
                                        <td><?php echo $order_id; ?> </td>
                                        <td><?php echo $order_date; ?></td>
                                        <td><?php echo 'Rp. '.$total; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/order-transaksi.php?order_id=<?php echo $order_id; ?>" class="btn-secondary">Status Transaksi</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            //Order not Available
                            echo "<tr><td colspan='12' class='error'>Orders not Available</td></tr>";
                        }
                    ?>

 
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>