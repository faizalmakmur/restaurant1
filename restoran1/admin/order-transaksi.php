<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Transaksi</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
        
            <table class="tbl-30">

                <tr>
                    <td>Order ID: </td>
                    <td><p><strong><?php 
                    $order_id = $_GET['order_id'];
                    echo $order_id; ?></strong></p></td>
                </tr>
                <tr>
                    <td>Menu yang Dipesan: </td>
                    <td>
                    <?php 
                                //Create PHP Code to display categories from Database
                                //1. CReate SQL to get all active categories from database
                                $sql = "SELECT * FROM data_pesan WHERE order_id = '$order_id'";
                                
                                //Executing qUery
                                $res = mysqli_query($conn, $sql);

                                //Count Rows to check whether we have categories or not
                                $count = mysqli_num_rows($res);

                                //IF count is greater than zero, we have categories else we donot have categories
                                if($count>0)
                                {
                                    //WE have categories
                                    while($row=mysqli_fetch_assoc($res))
                                    {
                                        //get the details of categories
                                        $menu_name = $row['menu_name'];
                                        $price = $row['price'];
                                        $quantity = $row['quantity'];
                                        $order_date = $row['order_date'];
                                        $total = ['total'];

                                        ?>
                                        <p>
                                        <?php echo "$menu_name ";
                                        echo "$quantity ";?>
                                        </p>

                                        <?php
                                    }
                                }
                                else
                                {
                                    //WE do not have category
                                    ?>
                                    <option value="0">Kategori Tidak Ditemukan</option>
                                    <?php
                                }
                            

                                //2. Display on Drpopdown
                            ?>
                    </td>
                </tr>
                <tr>
                    <td>Total Bayar: </td>
                    <td><p><strong><?php 
                    $sql2 = "SELECT order_id,
                    order_date,
                    sum(price*quantity) as total FROM data_pesan WHERE order_id = '$order_id' GROUP BY order_id ORDER BY order_date DESC"; // DIsplay the Latest Order at First
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
                            $order_id = $row2['order_id'];
                            $order_date = $row2['order_date'];
                            $total_bayar = $row2['total'];
                            ?>

                                <?php echo 'Rp. '.$total_bayar; ?>

                            <?php

                        }
                    }
                    ?></strong></p></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="order_id" value="<?php echo $order_id; ?>">
                        <input type="hidden" name="total_bayar" value="<?php echo $total_bayar; ?>">
                        <input type="hidden" name="status" value="belum">
                        <input type="submit" name="submit" value="ke Transaksi" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

        
        <?php 

            //CHeck whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //Add the Food in Database
                //echo "Clicked";
                
                //1. Get the DAta from Form
                $order_id = $_POST['order_id'];
                $total_bayar = $_POST['total_bayar'];
                $status = $_POST['status'];
                //3. Insert Into Database

                //Create a SQL Query to Save or Add food
                // For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
                $sql3 = "INSERT INTO data_transaksi SET 
                order_id='$order_id',
                total_bayar='$total_bayar',
                status='$status'
                ";

                //Execute the Query
                $res3 = mysqli_query($conn, $sql3);

                //CHeck whether data inserted or not
                //4. Redirect with MEssage to Manage Food page
                if($res3 == true)
                {
                    header('location:'.SITEURL.'admin/manage-transaksi.php');
                }
                else
                {
                    header('location:'.SITEURL.'admin/manage-order.php');
                }

                
            }

        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>