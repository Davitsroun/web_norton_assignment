<?php
session_start();
?>

<?php include('../server/connection.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="styles.css">
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background-color: #f0f0f0;">
    <header style="background-color: #2f1b12; color: #fff; padding: 10px 20px;">
        <nav class="navbar" style="display: flex; justify-content: space-between; align-items: center;">
            <div class="company-name" style="font-weight: bold; font-size: 1.2em;">Halo</div>
            <ul style="list-style-type: none; margin: 0; padding: 0;">
                <li style="display: inline;"><a href="logout.php?logout=1" style="margin-left: 20px; text-decoration: none; color: white;">Sign Out</a></li>
            </ul>
        </nav>
    </header>