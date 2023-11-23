<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
            if(isset($_GET['id_admin']))
            {
                $id_admin=$_GET['id_admin'];
            }
        ?>

        <form action="" method="POST">
        
            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Password Saat Ini">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="Password Baru">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Konfirmasi Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id_admin" value="<?php echo $id_admin; ?>">
                        <input type="submit" name="submit" value="Ganti Password" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php 

            //CHeck whether the Submit Button is Clicked on Not
            if(isset($_POST['submit']))
            {
                //echo "CLicked";

                //1. Get the DAta from Form
                $id_admin=$_POST['id_admin'];
                $current_password = ($_POST['current_password']);
                $new_password = ($_POST['new_password']);
                $confirm_password = ($_POST['confirm_password']);


                //2. Check whether the user with current id_admin and Current Password Exists or Not
                $sql = "SELECT * FROM data_admin WHERE id_admin=$id_admin AND password='$current_password'";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    //CHeck whether data is available or not
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                        //User Exists and Password Can be CHanged
                        //echo "User FOund";

                        //Check whether the new password and confirm match or not
                        if($new_password==$confirm_password)
                        {
                            //Update the Password
                            $sql2 = "UPDATE data_admin SET 
                                password='$new_password' 
                                WHERE id_admin=$id_admin
                            ";

                            //Execute the Query
                            $res2 = mysqli_query($conn, $sql2);

                            //CHeck whether the query exeuted or not
                            if($res2==true)
                            {
                                //Display Succes Message
                                //REdirect to Manage Admin Page with Success Message
                                $_SESSION['change-pwd'] = "<div class='success'>Berhasil Ubah Password. </div>";
                                //Redirect the User
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                            else
                            {
                                //Display Error Message
                                //REdirect to Manage Admin Page with Error Message
                                $_SESSION['change-pwd'] = "<div class='error'>Gagal Ubah Password. </div>";
                                //Redirect the User
                                header('location:'.SITEURL.'admin/manage-admin.php');
                            }
                        }
                        else
                        {
                            //REdirect to Manage Admin Page with Error Message
                            $_SESSION['pwd-not-match'] = "<div class='error'>Password Tidak Sesuai. </div>";
                            //Redirect the User
                            header('location:'.SITEURL.'admin/manage-admin.php');

                        }
                    }
                    else
                    {
                        //User Does not Exist Set Message and REdirect
                        $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
                        //Redirect the User
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }

                //3. CHeck Whether the New Password and Confirm Password Match or not

                //4. Change PAssword if all above is true
            }

?>


<?php include('partials/footer.php'); ?>