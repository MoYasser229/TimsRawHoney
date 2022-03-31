<!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="<?php echo $css; ?>">
                <link rel="stylesheet" href="<?php echo $headercss;?>">
                <script src="https://kit.fontawesome.com/1d1d7fdffa.js" crossorigin="anonymous"></script>
                <script src="https://cdn.lordicon.com/lusqsztk.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <title><?php echo "Tim Raw Honey"; ?></title>
                <link rel="apple-touch-icon" sizes="180x180" href="<?php echo $icon; ?>/apple-touch-icon.png">
                <link rel="icon" type="image/png" sizes="32x32" href="<?php echo $icon; ?>favicon-32x32.png">
                <link rel="icon" type="image/png" sizes="16x16" href="<?php echo $icon; ?>/favicon-16x16.png">
                <link rel="manifest" href="<?php echo $icon; ?>/site.webmanifest">
                <link rel="mask-icon" href="<?php echo $icon; ?>/safari-pinned-tab.svg" color="#5bbad5">
                <meta name="msapplication-TileColor" content="#da532c">
                <meta name="theme-color" content="#060606">
            </head>
            <body>
            <nav class="menu nav">
                <input id ="menu__toggle" type="checkbox" class='menu__toggle'/>
                <label for="menu__toggle" class="menu__toggle-label">
                    <svg preserveAspectRatio='xMinYMin' viewBox='0 0 24 24'>
                    <path d='M3,6H21V8H3V6M3,11H21V13H3V11M3,16H21V18H3V16Z' />
                    </svg>
                    <svg preserveAspectRatio='xMinYMin' viewBox='0 0 24 24'>
                    <path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z" />
                    </svg>
                </label>
                <ol class='menu__content'>
                    <li class="menu-item"><a href="<?php echo URLROOT . "dashboard/home";?>">Home</a></li>
                    <li class="menu-item"><a href="<?php echo URLROOT . "dashboard/sales";?>">Sales</a></li>
                    <li class="menu-item">
                    <a href="<?php echo URLROOT . "dashboard/productDashboard" ;?>">Product</a>
                    <ol class="sub-menu">
                        <li class="menu-item"><a href="<?php echo URLROOT . "dashboard/productDashboard" ;?>">Manage Products</a></li>
                        <li class="menu-item"><a href="<?php echo URLROOT . "dashboard/stocks"; ?>">Stock Management</a></li>
                    </ol>
                    </li>
                    <li class="menu-item">
                    <a href="<?php echo URLROOT . "dashboard/customer" ;?>">Customer</a>
                    <ol class="sub-menu">
                        <li class="menu-item"><a href="<?php echo URLROOT . "dashboard/customer" ;?>">Customer List</a></li>
                        <li class="menu-item"><a href="<?php echo URLROOT . "dashboard/delivery" ;?>">Customer Delivery</a></li>
                        <li class="menu-item"><a href="<?php echo URLROOT . "dashboard/survey" ;?>">Customer Survey</a></li>
                    </ol>
                    </li>
                    <li class="menu-item"><a href="<?php echo URLROOT . "dashboard/order" ;?>">Orders</a></li>
                </ol>
            </nav>