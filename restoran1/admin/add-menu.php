<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Tambah Menu</h1>

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
                    <td>Nama Menu: </td>
                    <td>
                        <input type="text" name="menu_name" placeholder="Nama Menu">
                    </td>
                </tr>

                <tr>
                    <td>Deskripsi: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Deskripsi Menu."></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Harga: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Pilih Gambar: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

 

                <tr>
                    <td>Available: </td>
                    <td>
                        <input type="radio" name="available" value="Ya"> Ya 
                        <input type="radio" name="available" value="Tidak"> Tidak
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="TambahMenu" class="btn-secondary">
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
                $menu_name = $_POST['menu_name'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                // $id_category = $_POST['id_category'];

                if(isset($_POST['available']))
                {
                    $available = $_POST['available'];
                }
                else
                {
                    $available = "Tidak"; //Setting Default Value
                }

                //2. Upload the Image if selected
                //Check whether the select image is clicked or not and upload the image only if the image is selected
                if(isset($_FILES['image']['name']))
                {
                    //Get the details of the selected image
                    $image_name = $_FILES['image']['name'];

                    //Check Whether the Image is Selected or not and upload image only if selected
                    if($image_name!="")
                    {
                        // Image is SElected
                        //A. REnamge the Image
                        //Get the extension of selected image (jpg, png, gif, etc.)
                        $ext = end(explode('.', $image_name));

                        // Create New Name for Image
                        $image_name = "Menu-Name-".rand(0000,9999).".".$ext; //New Image Name May Be "Food-Name-657.jpg"

                        //B. Upload the Image
                        //Get the Src Path and DEstinaton path

                        // Source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        //Destination Path for the image to be uploaded
                        $dst = "../images/food/".$image_name;

                        //Finally Uppload the food image
                        $upload = move_uploaded_file($src, $dst);

                        //check whether image uploaded of not
                        if($upload==false)
                        {
                            //Failed to Upload the image
                            //REdirect to Add Food Page with Error Message
                            $_SESSION['upload'] = "<div class='error'>Gagal Upload Image.</div>";
                            header('location:'.SITEURL.'admin/add-food.php');
                            //STop the process
                            die();
                        }

                    }

                }
                else
                {
                    $image_name = ""; //SEtting DEfault Value as blank
                }

                //3. Insert Into Database

                //Create a SQL Query to Save or Add food
                // For Numerical we do not need to pass value inside quotes '' But for string value it is compulsory to add quotes ''
                $sql2 = "INSERT INTO data_menu SET 
                    menu_name = '$menu_name',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    -- id_category = $id_category,
                    available = '$available'
                ";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //CHeck whether data inserted or not
                //4. Redirect with MEssage to Manage Food page
                if($res2 == true)
                {
                    //Data inserted Successfullly
                    $_SESSION['add'] = "<div class='success'>Tambah Menu Berhasil.</div>";
                    header('location:'.SITEURL.'admin/manage-menu.php');
                }
                else
                {
                    //FAiled to Insert Data
                    $_SESSION['add'] = "<div class='error'>Tambah Menu Gagal.</div>";
                    header('location:'.SITEURL.'admin/manage-menu.php');
                }

                
            }

        ?>


    </div>
</div>

<?php include('partials/footer.php'); ?>