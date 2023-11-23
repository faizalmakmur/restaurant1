<?php include('partials/menu.php'); ?>

<?php 
    //CHeck whether id is set or not 
    if(isset($_GET['id_transaksi']))
    {
        //Get all the details
        $id_transaksi = $_GET['id_transaksi'];

        //SQL Query to Get the Selected Food
        $sql2 = "SELECT * FROM data_transaksi WHERE id_transaksi=$id_transaksi";
        //execute the Query
        $res2 = mysqli_query($conn, $sql2);

        //Get the value based on query executed
        $row2 = mysqli_fetch_assoc($res2);

        //Get the Individual Values of Selected Food
        $dibayar = $row2['dibayar'];
        $status = $row2['status'];

    }
    else
    {
        //Redirect to Manage Food
        header('location:'.SITEURL.'admin/manage-transaksi.php');
    }
?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Transaksi</h1>
        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">
        
        <table class="tbl-30">

            <tr>
                <td>Dibayar: </td>
                <td>
                    <p>Rp. <input type="text" name="dibayar" value="<?php echo $dibayar; ?>"></p>
                </td>
            </tr>
            <tr>
                <td>Status: </td>
                <td>
                    <input <?php if($status=="belum") {echo "checked";} ?> type="radio" name="status" value="belum"> belum 
                    <input <?php if($status=="sudah") {echo "checked";} ?> type="radio" name="status" value="sudah"> sudah
                </td>
            </tr>

            <tr>
                <td>
                    <input type="hidden" name="id_transaksi" value="<?php echo $id_transaksi; ?>">

                    <input type="submit" name="submit" value="Update Transaksi" class="btn-secondary">
                </td>
            </tr>
        
        </table>
        
        </form>

        <?php 
        
            if(isset($_POST['submit']))
            {
                //echo "Button Clicked";

                //1. Get all the details from the form
                $id_transaksi = $_POST['id_transaksi'];
                $status = $_POST['status'];
                $dibayar = $_POST['dibayar'];
                //4. Update the Food in Database
                $sql3 = "UPDATE data_transaksi SET 
                    dibayar = '$dibayar',
                    status = '$status'
                    WHERE id_transaksi=$id_transaksi
                ";

                //Execute the SQL Query
                $res3 = mysqli_query($conn, $sql3);

                //CHeck whether the query is executed or not 
                if($res3==true)
                {
                    //Query Exectued and Food Updated
                    $_SESSION['update'] = "<div class='success'>Update Transaksi Berhasil Berhasil.</div>";
                    header('location:'.SITEURL.'admin/manage-transaksi.php');
                }
                else
                {
                    //Failed to Update Food
                    $_SESSION['update'] = "<div class='error'>Update Transaksi Gagal.</div>";
                    header('location:'.SITEURL.'admin/manage-transaksi.php');
                }

                
            }
        
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>