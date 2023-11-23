<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Mengelola Menu</h1>

        <br /><br />

                <!-- Button to Add Admin -->
                <a href="<?php echo SITEURL; ?>admin/add-menu.php" class="btn-primary">Tambah Menu</a>

                <br /><br /><br />

                <?php 
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['upload']))
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['unauthorize']))
                    {
                        echo $_SESSION['unauthorize'];
                        unset($_SESSION['unauthorize']);
                    }

                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }
                
                ?>

                <table class="tbl-full">
                    <tr>
                        <th>No.</th>
                        <th>Nama Menu</th>
                        <th>Harga</th>
                        <th>Gambar</th>
                        <th>Available</th>
                        <th>Actions</th>
                    </tr>

                    <?php 
                        //Create a SQL Query to Get all the Food
                        $sql = "SELECT * FROM data_menu";

                        //Execute the qUery
                        $res = mysqli_query($conn, $sql);

                        //Count Rows to check whether we have foods or not
                        $count = mysqli_num_rows($res);

                        //Create Serial Number VAriable and Set Default VAlue as 1
                        $sn=1;

                        if($count>0)
                        {
                            //We have food in Database
                            //Get the Foods from Database and Display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //get the values from individual columns
                                $id_menu = $row['id_menu'];
                                $menu_name = $row['menu_name'];
                                $price = $row['price'];
                                $image_name = $row['image_name'];
                                $available = $row['available'];
                                ?>

                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $menu_name; ?></td>
                                    <td>Rp. <?php echo $price; ?></td>
                                    <td>
                                        <?php  
                                            //CHeck whether we have image or not
                                            if($image_name=="")
                                            {
                                                //WE do not have image, DIslpay Error Message
                                                echo "<div class='error'>Gambar Tidak Ditambahkan.</div>";
                                            }
                                            else
                                            {
                                                //WE Have Image, Display Image
                                                ?>
                                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                                <?php
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $available; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL; ?>admin/update-menu.php?id_menu=<?php echo $id_menu; ?>" class="btn-secondary">Update Menu</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-menu.php?id_menu=<?php echo $id_menu; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Menu</a>
                                    </td>
                                </tr>

                                <?php
                            }
                        }
                        else
                        {
                            //Food not Added in Database
                            echo "<tr> <td colspan='7' class='error'> Menu Belum Ditambahkan. </td> </tr>";
                        }

                    ?>

                    
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>