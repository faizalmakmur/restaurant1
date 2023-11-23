
<?php include('partials/menu.php'); ?>

<!-- Main Content Section Starts -->
<div class="main-content">
    <div class="wrapper">
        <h1>Administrator Dashboard</h1>
        <br><br>
        <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        ?>
        <br><br>

        <div class="col-4 text-center">

            <?php 
                //Sql Query 
                $sql2 = "SELECT * FROM data_menu";
                //Execute Query
                $res2 = mysqli_query($conn, $sql2);
                //Count Rows
                $count2 = mysqli_num_rows($res2);
            ?>

            <h1><?php echo $count2; ?></h1>
            <br />
            Menu
        </div>

        <div class="col-4 text-center">
            
            <?php 
                //Sql Query 
                $sql3 = "SELECT * FROM data_pesan";
                //Execute Query
                $res3 = mysqli_query($conn, $sql3);
                //Count Rows
                $count3 = mysqli_num_rows($res3);
            ?>

            <h1><?php echo $count3; ?></h1>
            <br />
            Total Pesanan
        </div>

        <div class="col-4 text-center">
            
            <?php 
                //Sql Query 
                $sql3 = "SELECT * FROM data_transaksi";
                //Execute Query
                $res3 = mysqli_query($conn, $sql3);
                //Count Rows
                $count3 = mysqli_num_rows($res3);
            ?>

            <h1><?php echo $count3; ?></h1>
            <br />
            Total Transaksi
        </div>

        <div class="col-4 text-center">
            
            <?php 
                //Sql Query 
                $sql8 = "SELECT * FROM data_admin";
                //Execute Query
                $res8 = mysqli_query($conn, $sql8);
                //Count Rows
                $count8 = mysqli_num_rows($res8);
            ?>

            <h1><?php echo $count8; ?></h1>
            <br />
            System Administrator
        </div>

        <div class="clearfix"></div>

    </div>
</div>
<!-- Main Content Setion Ends -->

<?php include('partials/footer.php') ?>