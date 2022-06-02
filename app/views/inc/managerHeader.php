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
                <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
                <script src="//cdn.jsdelivr.net/jquery.shadow-animation/1/mainfile"></script>
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
                <div class="navigation">
                    <div class="mini">
                        <button class=max onclick="maximizeNavbar()"><i class="fa-solid fa-bars"></i></button>
                        <button class=navButtons onclick="location.replace('home')"><div id="home"><i class='fa-solid fa-house'></i></div></button>
                        <button  class=navButtons onclick="location.replace('sales')"><div id="sales"><i class="fa-solid fa-square-poll-vertical"></i></div></button>
                        <button  class=navButtons onclick="location.replace('productDashboard')"><div id="products"><i class="fa-solid fa-box-archive"></i></div></button>
                        <button  class=navButtons onclick="location.replace('stocks')"><div id="stocks"><i class="fa-solid fa-warehouse"></i></div></button>
                        <button  class=navButtons onclick="location.replace('order')"><div id="orders"><i class="fa-solid fa-rectangle-list"></i></div></button>
                        <button  class=navButtons onclick="location.replace('customer')"><div id="customers"><i class="fa-solid fa-user-group"></i></div></button>
                        <button  class=navButtons onclick="location.replace('delivery')"><div id="delivery"><i class="fa-solid fa-truck"></i></div></button>
                        <button  class=navButtons onclick="location.replace('survey')"><div id="survey"><i class="fa-solid fa-list-check"></i></div></button>
                        <button  class="navButtons" onclick="location.replace('<?php echo URLROOT . 'pages/logout'; ?>')"><div id="logout"><i class="fa-solid fa-right-from-bracket"></i></div></button>
                    </div>
                    <div class="magnified">
                        
                        
                        <button class=max onclick="maximizeNavbar()"><i class="fa-solid fa-bars"></i></button>
                        <div class=magList style="width: 90%;">
                            <ul style="list-style: none;text-align: left;width: 100%;">
                                <li><div id="home" onclick="location.replace('home')"><i class='fa-solid fa-house'></i>&nbsp;HOME</div></li>
                                
                                
                                <li><div id="sales" onclick="location.replace('sales')"><i class="fa-solid fa-square-poll-vertical"></i>&nbsp;SALES</div></li>

                                

                                <li><div id="products" onclick="location.replace('productDashboard')"><i class="fa-solid fa-box-archive"></i>&nbsp;PRODUCTS</div></li>
                                
                                <li><div id="stocks" onclick="location.replace('stocks')"><i class="fa-solid fa-warehouse"></i>&nbsp;STOCKS</div></li>
                                
                                <li><div id="orders" onclick="location.replace('order')"><i class="fa-solid fa-rectangle-list"></i>&nbsp;ORDERS</div></li>
                                
                                <li><div id="customers" onclick="location.replace('customer')"><i class="fa-solid fa-user-group"></i>&nbsp;CUSTOMERS</div></li>
                                
                                <li><div id="delivery" onclick="location.replace('delivery')"><i class="fa-solid fa-truck"></i>&nbsp;DELIVERY</div></li>
                                
                                <li><div id="survey" onclick="location.replace('survey')"><i class="fa-solid fa-list-check"></i>&nbsp;SURVEY</div></li>
                                
                                <li><div id="logout" onclick="location.replace('<?php echo URLROOT . 'pages/logout'; ?>')"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;LOG OUT</div></li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
                <div class = responsiveNavbar>
                    <i class="fa-solid fa-bars"></i>
                </div>
                <br>
                <script>
                    toggleNav = false
                    navItems = ["home","sales","products","stocks","orders","customers","delivery","survey","logout"]
                    
                    function maximizeNavbar() {
                        if(toggleNav === false){
                            $(".navigation").css("text-align","left")
                            // $(".navigation").css("background-color","#FBAB7E")
                            $(".navigation").stop().animate({
                                left: "30px", 
                                top: "10px",
                                height:"98%",
                                width: "25%",
                                backgroundColor: "#FBAB7E",
                                // backgroundColor: "#fff",
                                filter: "blur(100px)",
                                // backgroundColor: "rgba(255,255,255,0.4)",
                                boxShadow: "10px 5px"
                            },500)
                            // $(".navigation").stop().animate({backgroundColor:'#FBAB7E'}, 300);
                            $(".max").animate({
                                color: "#FBAB7E",
                                backgroundColor: "white",
                            },100)
                            $(".navButtons").animate({
                                color: "white",
                                backgroundColor: "#FBAB7E"
                            },100)
                            navItems.forEach((item) => {
                                $("home").html("<i class='fa-solid fa-house'></i>")
                            })
                            $(".magnified").css("display","block")
                            // $(".navButt")
                            $(".mini").css("display","none")
                            toggleNav = true
                        }
                        else{
                            
                            $(".navigation").animate({
                                left: "0px", 
                                top: "0px",
                                height:"100%",
                                width:"75px",
                                backgroundColor: "white",
                            },500)
                            $(".navigation").css("text-align","center")
                            // $(".navigation").css("background-color","white")
                            $(".max").animate({
                                color: "#fff",
                                backgroundColor: "#FBAB7E",
                            },100)
                            $(".navButtons").animate({
                                color: "#FBAB7E",
                                backgroundColor: "#fff",
                            },100)
                            $(".magnified").css("display","none")
                            $(".mini").css("display","block")
                            toggleNav = false
                        }

                    }
                </script>
            <!-- <nav class="menu nav">
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
                    <li class="menu-item"><a href="<?php //echo URLROOT . "dashboard/home";?>">Home</a></li>
                    <li class="menu-item"><a href="<?php //echo URLROOT . "dashboard/sales";?>">Sales</a></li>
                    
                    <li class="menu-item">
                    <a href="<?php //echo URLROOT . "dashboard/productDashboard" ;?>">Product</a>
                    <ol class="sub-menu">
                        <li class="menu-item"><a href="<?php //echo URLROOT . "dashboard/productDashboard" ;?>">Manage Products</a></li>
                        <li class="menu-item"><a href="<?php //echo URLROOT . "dashboard/stocks"; ?>">Stock Management</a></li>
                    </ol>
                    </li>
                    <li class="menu-item">
                    <a href="<?php //echo URLROOT . "dashboard/customer" ;?>">Customer</a>
                    <ol class="sub-menu">
                        <li class="menu-item"><a href="<?php //echo URLROOT . "dashboard/customer" ;?>">Customer List</a></li>
                        <li class="menu-item"><a href="<?php //echo URLROOT . "dashboard/delivery" ;?>">Customer Delivery</a></li>
                        <li class="menu-item"><a href="<?php //echo URLROOT . "dashboard/survey" ;?>">Customer Survey</a></li>
                        
                    </ol>
                    </li>
                    <li class="menu-item"><a href="<?php //echo URLROOT . "dashboard/order" ;?>">Orders</a></li>
                    <li class="menu-item"><a href="<?php //echo URLROOT . "pages/logout";?>">Sign Out</a></li>
                    
                </ol>
            </nav> -->