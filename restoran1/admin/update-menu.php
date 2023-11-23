<?php include('partials/menu.php'); ?>

<?php 
    //CHeck whether id is set or not 
    if(isset($_GET['id_menu']))
    {
        //Get all the details
        $id_menu = $_GET['id_menu'];

        //SQL Query to Get the Selected Food
        $sql2 = "SELECT * FROM data_menu WHERE id_menu=$id_menu";
        //execute the Query
        $res2 = mysqli_query($conn, $sql2);

        //Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //Get the Individual Values of Selected Food
        $menu_name = $row2['menu_name'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $available = $row2['available'];

    }
    else
    {
        //Redirect to Manage Food
        header('location:'.SITEURL.'admin/manage-menu.php');
    }
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Menu</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
        
        <table class="tbl-30">

            <tr>
                <td>Nama Menu: </td>
                <td>
                    <input type="text" name="menu_name" value="<?php echo $menu_name; ?>">
                </td>
            </tr>

            <tr>
                <td>Deskripsi: </td>
                <td>
                    <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                </td>
            </tr>

            <tr>
                <td>Harga: </td>
                <td>
                    <input type="number" name="price" value="<?php echo $price; ?>">
                </td>
            </tr>

            <tr>
                <td>Gambar Sekarang: </td>
                <td>
                    <?php 
                        if($current_image == "")
                        {
                            //Image not Available 
                            echo "<div class='error'>Gambar Tidak Tersedia.</div>";
                        }
                        else
                        {
                            //Image Available
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $current_image; ?>" width="150px">
                            <?php
                        }
                    ?>
                </td>
            </tr>

            <tr>
                <td>Pilih Gambar Baru: </td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

 
                <td>Available: </td>
                <td>
                    <input <?php if($available=="Ya") {echo "checked";} ?> type="radio" name="available" value="Ya"> Ya 
                    <input <?php if($available=="Tidak") {echo "checked";} ?> type="radio" name="available" value="Tidak"> Tidak 
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id_menu" value="<?php echo $id_menu; ?>">
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">

                    <input type="submit" name="submit" value="Update Menu" class="btn-secondary">
                </td>
            </tr>
        
        </table>
        
        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //echo "Button Clicked";

                //1. Get all the details from the form
                $id_menu = $_POST['id_menu'];
                $menu_name = $_POST['menu_name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                // $id_category = $_POST['id_category'];
                $available = $_POST['available'];

                //2. Upload the image if selected

                //CHeck whether upload button is clicked or not
                if(isset($_FILES['image']['name']))
                {
                    //Upload BUtton Clicked
                    $image_name = $_FILES['image']['name']; //New Image NAme

                    //CHeck whether th file is available or not
                    if($image_name!="")
                    {
                        //IMage is Available
                        //A. Uploading New Image

                        //REname the Image
                        $ext = end(explode('.', $image_name)); //Gets the extension of the image

                        $image_name = "Menu-Name-".rand(0000, 9999).".".$ext; //THis will be renamed image

                        //Get the Source Path and DEstination PAth
                        $src_path = $_FILES['image']['tmp_name']; //Source Path
                        $dest_path = "../images/food/".$image_name; //DEstination Path

                        //Upload the image
                        $upload = move_uploaded_file($src_path, $dest_path);

                        /// CHeck whether the image is uploaded or not
                        if($upload==false)
                        {
                            //FAiled to Upload
                            $_SESSION['upload'] = "<div class='error'>Gagal Upload Gambar.</div>";
                            //REdirect to Manage Food 
                            header('location:'.SITEURL.'admin/manage-menu.php');
                            //Stop the Process
                            die();
                        }
                        //3. Remove the image if new image is uploaded and current image exists
                        //B. Remove current Image if Available
                        if($current_image!="")
                        {
                            //Current Image is Available
                            //REmove the image
                            $remove_path = "../images/food/".$current_image;

                            $remove = unlink($remove_path);

                            //Check whether the image is removed or not
                            if($remove==false)
                            {
                                //failed to remove current image
                                $_SESSION['remove-failed'] = "<div class='error'Gagal Hapus Gambar.</div>";
                                //redirect to manage food
                                header('location:'.SITEURL.'admin/manage-menu.php');
                                //stop the process
                                die();
                            }
                        }
                    }
                    else
                    {
                        $image_name = $current_image; //Default Image when Image is Not Selected
                    }
                }
                else
                {
                    $image_name = $current_image; //Default Image when Button is not Clicked
                }

                

                //4. Update the Food in Database
                $sql3 = "UPDATE data_menu SET 
                    menu_name = '$menu_name',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    -- id_category = '$id_category',
                    available = '$available'
                    WHERE id_menu=$id_menu
                ";

                //Execute the SQL Query
                $res3 = mysqli_query($conn, $sql3);

                //CHeck whether the query is executed or not 
                if($res3==true)
                {
                    //Query Exectued and Food Updated
                    $_SESSION['update'] = "<div class='success'>Update Menu Berhasil.</div>";
                    header('location:'.SITEURL.'admin/manage-menu.php');
                }
                else
                {
                    //Failed to Update Food
                    $_SESSION['update'] = "<div class='error'>Update Menu Gagal.</div>";
                    header('location:'.SITEURL.'admin/manage-menu.php');
                }

                
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>