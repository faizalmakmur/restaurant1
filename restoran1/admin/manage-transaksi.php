<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Transaksi</h1>

                <br /><br /><br />

                <?php 
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                    if(isset($_SESSION['detail']))
                    {
                        echo $_SESSION['detail'];
                        unset($_SESSION['detail']);
                    }
                ?>
                <br><br>

                <table class="tbl-full">
                    <tr>
                        <th width="10%">Order ID</th>
                        <th width="20%">Transaksi Date</th>
                        <th width="10%">Status Bayar</th>
                        <th width="20%">Total</th>
                        <th width="20%">Dibayar</th>
                        <th width="20%">Kembalian</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //Get all the orders from database
                        $sql = "SELECT * FROM data_transaksi ORDER BY transaksi_date DESC"; // DIsplay the Latest Order at First
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count the Rows
                        $count = mysqli_num_rows($res); //Create a Serial Number and set its initail value as 1
                        $dibayar = "";
                        $kembalian = "";
                        if($count>0)
                        {
                            //Order Available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Get all the order details
                                $id_transaksi = $row['id_transaksi'];
                                $order_id = $row['order_id'];
                                $transaksi_date = $row['transaksi_date'];
                                $status = $row['status'];
                                $total_bayar = $row['total_bayar'];
                                $dibayar = $row['dibayar'];
                                ?>

                                    <tr>
                                        <td><?php echo $order_id; ?> </td>
                                        <td><?php echo $transaksi_date; ?></td>
                                        <td><?php 
                                        if($status=="belum")
                                        {
                                            echo "<strong><label style='color: red; font-size: 30px;'>$status</label></strong>";
                                        }
                                        else
                                         {
                                            echo "<label style='color: green; font-size: 30px;'>$status</label>";
                                            } ?></td>
                                        <td><?php echo 'Rp. '.$total_bayar; ?></td>
                                        <td><?php echo 'Rp. '.$dibayar; ?></td>
                                        <td>
                                            <?php
                                            $sql2 = "SELECT dibayar-total_bayar as kembalian FROM data_transaksi WHERE order_id='$order_id'"; // DIsplay the Latest Order at First
                                            //Execute Query
                                            $res2 = mysqli_query($conn, $sql2);
                                            //Count the Rows
                                            $count2 = mysqli_num_rows($res2);

                                            $total_bayar = 0; //Create a Serial Number and set its initail value as 1

                                            if($count>0)
                                            {
                                                //Order Available
                                                while($row2=mysqli_fetch_assoc($res2))
                                                {
                                                    //Get all the order details
                                                    $kembalian = $row2['kembalian'];
                                                    echo 'Rp. '.$kembalian;

                                                }
                                            }        
                                            ?>
                                        </td>

                                

   
                                        
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-transaksi.php?id_transaksi=<?php echo $id_transaksi; ?>" class="btn-secondary">Update</a>
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