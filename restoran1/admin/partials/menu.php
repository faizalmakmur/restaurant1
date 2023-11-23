<?php 

    include('../config/constants.php'); 
    include('login-check.php');

?>


<html>
    <head>
        <title>Dashboard Admin</title>
        <style>
            
        </style>
        <link rel="stylesheet" href="uiadmin.css">
    </head>
    
    <body>
        <!-- Menu Section Starts -->
        <div class="menu text-center">
            <div class="wrapper">
                <ul>
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="manage-menu.php">Menu</a></li>
                    <li><a href="manage-admin.php">Admin</a></li>
                    <li><a href="manage-order.php">Pesanan</a></li>
                    <li><a href="manage-transaksi.php">Transaksi</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <!-- Menu Section Ends -->