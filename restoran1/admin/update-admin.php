<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php 
            //1. Get the ID of Selected Admin
            $id_admin=$_GET['id_admin'];

            //2. Create SQL Query to Get the Details
            $sql="SELECT * FROM data_admin WHERE id_admin=$id_admin";

            //Execute the Query
            $res=mysqli_query($conn, $sql);

            //Check whether the query is executed or not
            if($res==true)
            {
                // Check whether the data is available or not
                $count = mysqli_num_rows($res);
                //Check whether we have admin data or not
                if($count==1)
                {
                    // Get the Details
                    //echo "Admin Available";
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                }
                else
                {
                    //Redirect to Manage Admin PAge
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
        
        ?>


        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Nama Lengkap: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id_admin" value="<?php echo $id_admin; ?>">
                        <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                    </td>
                </tr>

                

            </table>

        </form>
    </div>
</div>

<?php 

    //Check whether the Submit Button is Clicked or not
    if(isset($_POST['submit']))
    {
        //echo "Button CLicked";
        //Get all the values from form to update
        $id_admin = $_POST['id_admin'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        //Create a SQL Query to Update Admin
        $sql = "UPDATE data_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id_admin='$id_admin'
        ";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the query executed successfully or not
        if($res==true)
        {
            //Query Executed and Admin Updated
            $_SESSION['update'] = "<div class='success'>Update Admin Berhasil.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
        else
        {
            //Failed to Update Admin
            $_SESSION['update'] = "<div class='error'>Gagal Update Admin.</div>";
            //Redirect to Manage Admin Page
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }

?>


<?php include('partials/footer.php'); ?>