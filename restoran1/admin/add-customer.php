<?php include('partials/menu2.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Buat Akun Customer</h1>

        <br><br>

        <?php 
            if(isset($_SESSION['add'])) //Checking whether the SEssion is Set of Not
            {
                echo $_SESSION['add']; //Display the SEssion Message if SEt
                unset($_SESSION['add']); //Remove Session Message
            }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Nama Lengkap: </td>
                    <td>
                        <input type="text" name="customer_name" placeholder="Enter Your Name">
                    </td>
                </tr>

                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" placeholder="Your Username">
                    </td>
                </tr>

                <tr>
                    <td>Password: </td>
                    <td>
                        <input type="password" name="password" placeholder="Your Password">
                    </td>
                </tr>

                <tr>
                    <td>Nomer HP: </td>
                    <td>
                        <input type="phone" name="phone" placeholder="Your Number">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="BuatAkun" class="btn-secondary" >
                    </td>
                </tr>

            </table>

        </form>
        <a href="../login.php">Login Akun Customer</a>


    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php 
    //Process the Value from Form and Save it in Database

    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        //echo "Button Clicked";

        //1. Get the Data from form
        $customer_name = $_POST['customer_name'];
        $username = $_POST['username'];
        $password = ($_POST['password']); //Password Encryption with MD5
        $phone = ($_POST['phone']); //Password Encryption with MD5

        //2. SQL Query to Save the data into database
        $sql = "INSERT INTO data_customer SET 
            customer_name='$customer_name',
            username='$username',
            password='$password',
            phone='$phone'
        ";
 
        //3. Executing Query and Saving Data into Datbase
        $res = mysqli_query($conn, $sql);

        //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
        if($res==TRUE)
        {
            //Data Inserted
            //echo "Data Inserted";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='success'>Berhasil Membuat Akun.</div>";
            //Redirect Page to Manage Admin
            header("location:".SITEURL.'/admin/add-customer.php');
        }
        else
        {
            //FAiled to Insert DAta
            //echo "Faile to Insert Data";
            //Create a Session Variable to Display Message
            $_SESSION['add'] = "<div class='error'>Gagal Membuat Akun.</div>";
            //Redirect Page to Add Admin
            header("location:".SITEURL.'admin/add-customer.php');
        }

    }
    
?>