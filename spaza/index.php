<?php
include "../vendor/autoload.php";
use Controller\mmshightech;
use Classes\constants\Constants;
use Controller\mmshightech\OrderPdo;
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
  $mmshightech=new mmshightech();
  $OrderPdo=new OrderPdo($mmshightech);
  $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
    date_default_timezone_set('Africa/Johannesburg');

    $isOrder=empty($OrderPdo->isUserHasActiveOrder($cur_user_row['id']))?-1:1;
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta name="description" content="E-Learning for all SGELA is an app engineered to simplify all tertiary & bursary applications and easily accessible.">
      <meta name="keywords" content=" MMS HIGH TECH | <?php echo $cur_user_row['name']." ".$cur_user_row['surname'];?> | E-Learning for all">
      <meta name="author" content="Mr M.S Mzobe">
        <link rel='dns-prefetch' href='https://netchatsa.com//s0.wp.com' />
      <link rel='dns-prefetch' href='https://netchatsa.com/'/>
      <link rel='dns-prefetch' href='https://netchatsa.com//fonts.googleapis.com' />
      <link rel='dns-prefetch' href='https://netchatsa.com//s.w.org' />
      <link rel="alternate" type="application/rss+xml" title="E-Learning for all &raquo; Feed" href="https://netchatsa.com/<?php echo $userDirect;?>/feed/" />
      <link rel="alternate" type="application/rss+xml" title="E-Learning for all &raquo; Comments Feed" href="https://netchatsa.com/<?php echo $userDirect;?>/feed/" />
      <meta property="og:title" content="MMS HIGH TECH | "/>
      <meta property="og:description" content="MMS HIGH TECH | "/>

      <title><?php echo $cur_user_row['name']." ".$cur_user_row['surname'];?></title>
      <link rel="icon" href="../img/logo-1933884_640.webp">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous">-->
      <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>-->
      <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <script src="https://www.payfast.co.za/onsite/engine.js"></script>
      
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
      <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
      <!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script> -->
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
  <script src="https://www.payfast.co.za/onsite/engine.js"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
  font-size: 12px;
}
.selected{
  border-bottom: 2px solid mediumvioletred;
  border-top: 2px solid rebeccapurple;
  background: -webkit-linear-gradient(mediumvioletred,purple,rebeccapurple);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.twinsPack{
  padding: 0 10px; 
  display: flex;
  width: 100%;
}
h3{
  font-size: 16px;
}
.sidebar{
  position: fixed;
  height: 100%;
  width: 240px;
  background: #fff;
  transition: all 0.5s ease;
  border-right: 2px solid #f1f1f1;
}
.sidebar.active{
  width: 60px;
}
.sidebar .logo-details{g
  height: 80px;
  display: flex;
  align-items: center;
  border-bottom: 2px solid #ddd;
}
.sidebar .logo-details i{
  font-size: 28px;
  font-weight: 500;
  color: #000;
  min-width: 60px;
  text-align: center
}
.largeModal{
  width:1300px;
  margin-left: -80%;
}
.sidebar .logo-details .logo_name{
  color: #000;
  font-size: 18px;
  font-weight: 500;
}
.sidebar .nav-links{
  margin-top: 10px;
  margin-left: -21px;
}
.sidebar .nav-links li{
  position: relative;
  list-style: none;
  height: 50px;
}
.sidebar .nav-links li a{
  height: 100%;
  width: 100%;
  display: flex;
  align-items: center;
  text-decoration: none;
  transition: all 0.4s ease;
  font-size: 15px;
}
.sidebar .nav-links li a.active{
  background: #f1f1f1;
}
.sidebar .nav-links li a:hover{
  background: #f1f1f1;
}
.sidebar .nav-links li i{
  min-width: 60px;
  text-align: center;
  font-size: 18px;
  color: #000;
}

.sidebar .nav-links li a .links_name{
  color: #000;
  font-size: 12px;
  font-weight: 400;
  white-space: nowrap;
  cursor: pointer;
}
.sidebar .nav-links .log_out{
  position: absolute;
  bottom: 0;
  width: 100%;
}
.home-section{
  position: relative;
  background: #fff;
  min-height: 100vh;
  width: calc(100% - 240px);
  left: 240px;
  transition: all 0.5s ease;
}
.sidebar.active ~ .home-section{
  width: calc(100% - 60px);
  left: 60px;
}
.home-section nav{
  display: flex;
  justify-content: space-between;
  height: 80px;
  background: #fff;
  display: flex;
  align-items: center;
  position: fixed;
  width: calc(100% - 240px);
  left: 240px;
  z-index: 100;
  padding: 0 20px;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  transition: all 0.5s ease;
}
.sidebar.active ~ .home-section nav{
  left: 60px;
  width: calc(100% - 60px);
}
.home-section nav .sidebar-button{
  display: flex;
  align-items: center;
  font-size: 24px;
  font-weight: 500;
  color:#000;
}
nav .sidebar-button i{
  font-size: 35px;
  margin-right: 10px;
}
.maKhathiSpazaSearch{
  padding: 0 10px;
  width: 40%;
}
.maKhathiSpazaSearch input{
  width:100%;
  padding: 10px 10px;
  background: none;
  border:1px solid #ddd;
  text-align: left;
  color:#000;
  border-radius: 10px;

}
.home-section nav .search-box{
  position: relative;
  height: 50px;
  max-width: 550px;
  width: 100%;
  margin: 0 20px;
  font-size: 18px;
  color:#000;
}
.searchMasomaneSchoolSlide .searchMasomaneSchool{
  width: 100%;
  height:100%;
  outline: none;
  background: #fff;;
  border: 2px solid #ddd;
  border-radius: 6px;
  font-size: 18px;
  padding: 0 15px;
  color:#000;
}
.searchMasomaneSchoolSlide{
  position: absolute;
  height: 40px;
  width: 250px;
  background: #fff;
  border-radius: 4px;
  line-height: 40px;
  text-align: center;
  color: #000;
  font-size: 22px;
  transition: all 0.4 ease;
  padding: 0 10px;
}
.home-section nav .profile-details{
  display: flex;
  align-items: center;
  background: #fff;;
  border: 2px solid #EFEEF1;
  border-radius: 6px;
  height: 50px;
  min-width: 190px;
  padding: 0 15px 0 2px;
}
nav .profile-details img{
  height: 40px;
  width: 40px;
  border-radius: 6px;
  object-fit: cover;
}
th,td{
  color: #000;
}

nav .profile-details .admin_name{
  font-size: 15px;
  font-weight: 500;
  color: #000;
  margin: 0 10px;
  white-space: nowrap;
}
nav .profile-details i{
  font-size: 25px;
  color: #000;
}
.home-section .home-content{
  position: relative;
  padding-top: 104px;

}
.home-content .overview-boxes{
  display: flex;
  align-items: center;
  justify-content: space-between;
  flex-wrap: wrap;
  padding: 0 20px;
  margin-bottom: 26px;
}
.overview-boxes .box{
  display: flex;
  align-items: center;
  justify-content: center;
  width: calc(100% / 4 - 15px);
  background: #fff;
  padding: 15px 14px;
  border-radius: 12px;
  box-shadow: 0 5px 10px rgba(0,0,0,0.1);
  color:#000;
}
.overview-boxes .box-topic{
  font-size: 20px;
  font-weight: 500;
  color: #ddd;
}
.home-content .box .number{
  display: inline-block;
  font-size: 35px;
  margin-top: -6px;
  font-weight: 500;
}
.home-content .box .indicator{
  display: flex;
  align-items: center;
}
.home-content .box .indicator i{
  height: 20px;
  width: 20px;
  background: #8FDACB;
  line-height: 20px;
  text-align: center;
  border-radius: 50%;
  color: #000;
  font-size: 20px;
  margin-right: 5px;
}
.box .indicator i.down{
  background: #e87d88;
}
.home-content .box .indicator .text{
  font-size: 12px;
}
.home-content .box .cart{
  display: inline-block;
  font-size: 32px;
  height: 50px;
  width: 50px;
  background: #cce5ff;
  line-height: 50px;
  text-align: center;
  color: #66b0ff;
  border-radius: 12px;
  margin: -15px 0 0 6px;
}
.home-content .box .cart.two{
   color: #2BD47D;
   background: #C0F2D8;
 }
.home-content .box .cart.three{
   color: #ffc233;
   background: #ffe8b3;
 }
.home-content .box .cart.four{
   color: #e05260;
   background: #f7d4d7;
 }
.home-content .total-order{
  font-size: 20px;
  font-weight: 500;
}
.home-content .masomane{
  display: flex;
  justify-content: space-between;
  /* padding: 0 20px; */
}
.orderDataSet{
  width: 100%;
}
.orderDataSet .orderDataSetHeader{
  width: 100%;
  padding: 10px 10px;
  display: flex;
}
.orderDataSet .orderDataSetHeader .maKhathiOrdersSearch{
  width:20%;
}
.fullBody-tech{
  width:100%;
}
.fullBody-tech .headerTech{
  padding: 10px 10px;
  border-bottom: 1px solid #ddd;
}
.orderDataSet .orderDataSetHeader .maKhathiOrdersSearch input{
  width:100%;
  padding: 4px 10px;
  border:1px solid #ddd;
  color:#000;
  background: none;
  border-radius: 10px;
}
/* left box */
.home-content .masomane .makhanyile{
  width: 100%;
  height: 100%;
  display: flex;
  background: #fff;
  padding: 20px 30px;
  margin: 0 20px;
  border-radius: 12px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  color:#000;
  overflow-y: scroll;
  overflow-wrap: break-word;
  word-wrap: break-word;
  hyphens: auto;
  height: 82vh;
  
}
.box-shadow{
  box-shadow: 2px 1px 2px 1px #000;
  border-radius: 10px;
}
.home-content .masomane .makhanyile::-webkit-scrollbar{
  width:1px;
}
.home-content .masomane .makhanyile::-webkit-scrollbar-thumb {
  background: red; 
  border-radius: 10px;
}
.home-content .masomane .makhanyileDtails{
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #fff;
  color:#000;
}
.masomane .box .title{
  font-size: 24px;
  font-weight: 500;
  border-bottom: 1px solid white;
  /* margin-bottom: 10px; */
}
.masomane .makhanyileDtails li.topic{
  font-size: 20px;
  font-weight: 500;
  color: #ddd;
}
.masomane .makhanyileDtails li{
  list-style: none;
  margin: 8px 0;
}

.masomane .makhanyileDtails li a{
  font-size: 18px;
  color: #000;
  font-size: 400;
  text-decoration: none;
  cursor: pointer;
}
.masomane .box .button{
  width: 100%;
  display: flex;
  justify-content: flex-end;
}
.masomane .box .button a{
  color: white;
  background: #0A2558;
  padding: 4px 12px;
  font-size: 15px;
  font-weight: 400;
  border-radius: 4px;
  text-decoration: none;
  transition: all 0.3s ease;
  cursor: pointer;
}
.masomane .box .button a:hover{
  background:  #0d3073;
}

/* Right box */
.home-content .masomane .maKhathi{
  width: 28%;
  height: 100%;
  background: #fff;
  padding: 20px 30px;
  margin: 0 20px 0 0;
  border-radius: 12px;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  color:#000;
  overflow-y: auto;
  overflow-wrap: break-word;
  word-wrap: break-word;
  hyphens: auto;
  height: 85vh;
}
.badge{
  cursor: pointer;
}
.home-content .masomane .maKhathi::-webkit-scrollbar{
  width:1px;
}
.home-content .masomane .maKhathi::-webkit-scrollbar-thumb {
  background: red; 
  border-radius: 10px;
}


.masomane .maKhathi li{
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin: 10px 0;
}
.masomane .maKhathi li a img{
  height: 40px;
  width: 40px;
  object-fit: cover;
  border-radius: 12px;
  margin-right: 10px;
  background: #333;
}
.masomane .maKhathi li a{
  display: flex;
  align-items: center;
  text-decoration: none;
  cursor: pointer;
}
.masomane .maKhathi li .product,
.marks{
  font-size: 17px;
  font-weight: 400;
  color: #000;
  background:#fff;
}
.modal-content{
  background: #fff;
}
.inputVals{
  width: 100%;
  padding:10px 10px;
}
.modal-title{
  text-align: center;
  color: white;

}
.inputVals .addMasomaneNewSchool{
  border:2px solid white;
  color:#000;
  border-radius: 100px;
  text-align: center;
  cursor: pointer;
}
.inputVals input,select{
  width:100%;
  border:1px solid #ddd;
  border-bottom: 2px solid #ddd;
  background:none;
  color:#000;
  padding: 10px 10px;
}
select{
  background: #fff;
  color: #000;
}
/* Responsive Media Query */
@media (max-width: 1240px) {
  .sidebar{
    width: 60px;
  }
  .sidebar.active{
    width: 220px;
  }
  .home-section{
    width: calc(100% - 60px);
    left: 60px;
  }
  .sidebar.active ~ .home-section{
    /* width: calc(100% - 220px); */
    overflow: hidden;
    left: 220px;
  }
  .home-section nav{
    width: calc(100% - 60px);
    left: 60px;
  }
  .sidebar.active ~ .home-section nav{
    width: calc(100% - 220px);
    left: 220px;
  }
}
@media (max-width: 1150px) {
  .home-content .masomane{
    flex-direction: column;
  }
  .home-content .masomane .box{
    width: 100%;
    overflow-x: scroll;
    margin-bottom: 30px;
  }
  .home-content .masomane .maKhathi{
    margin: 0;
  }
}
@media (max-width: 1000px) {
  .overview-boxes .box{
    width: calc(100% / 2 - 15px);
    margin-bottom: 15px;
  }
}
@media (max-width: 700px) {
  nav .sidebar-button .dashboard,
  nav .profile-details .admin_name,
  nav .profile-details i{
    display: none;
  }
  .home-content .masomane .makhanyile{
    margin: 0;
  }
  .home-section nav .profile-details{
    height: 50px;
    min-width: 40px;
  }
  .home-content .masomane .makhanyileDtails{
    width: 560px;
  }
}
@media (max-width: 550px) {
  .overview-boxes .box{
    width: 100%;
    margin-bottom: 15px;
  }
  .sidebar.active ~ .home-section nav .profile-details{
    display: none;
  }
}
  @media (max-width: 400px) {
  .sidebar{
    width: 0;
  }
  .sidebar.active{
    width: 60px;
  }
  .home-section{
    width: 100%;
    left: 0;
  }
  .sidebar.active ~ .home-section{
    left: 60px;
    width: calc(100% - 60px);
  }
  .home-section nav{
    width: 100%;
    left: 0;
  }
  .sidebar.active ~ .home-section nav{
    left: 60px;
    width: calc(100% - 60px);
  }
}
  </style>
  <?php
  // if($cur_user_row['background']==0){
  //   echo'<link rel="stylesheet" href="../css/dark.css">';
  // }
  // else{
  //   echo'<link rel="stylesheet" href="../css/light.css">';
  // }
  ?>
  
   </head>

   <style>
     /* Googlefont Poppins CDN Link */


   </style>
<body>
  <div class="sidebar ">
    <div class="logo-details">
      <i class='bx bxl-c-plus-plus'></i>
      <span class="logo_name">iSPAZA</span>
    </div>
      <ul class="nav-links">
        <!-- <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/ordersForm.php")'>
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Orders</span>
          </a>
        </li> -->
        <?php
        if($cur_user_row['user_type']===Constants::USER_TYPE_ADMIN){ ?>
        <li>
          <a data-bs-toggle="modal" data-bs-target="#createSupplier">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Create Supplier</span>
          </a>
        </li>
        <?php
        }
        if($cur_user_row['user_type']===Constants::USER_TYPE_ADMIN){ ?>
        <li>
          <a data-bs-toggle="modal" data-bs-target="#addNewUser">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Create User</span>
          </a>
        </li>
        <?php
        }
        if($cur_user_row['user_type']===Constants::USER_TYPE_ADMIN){ ?>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/manageUsersForm.php")'>
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Manage users</span>
          </a>
        </li>
        <?php
        }
        if($cur_user_row['user_type']===Constants::USER_TYPE_ADMIN){ ?>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/manageSpazaForm.php")'>
            <i class='bx bx-box' ></i>
            <span class="links_name">Manage Spaza</span>
          </a>
        </li>
        <?php
        }
        if($cur_user_row['user_type']===Constants::USER_TYPE_ADMIN){ ?>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/createNewProduct.php")'>
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Create Product</span>
          </a>
        </li>
        <?php
        }
        if($cur_user_row['user_type']===Constants::USER_TYPE_ADMIN){ ?>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/manageSpazaProducts.php")'>
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Manage Products</span>
          </a>
        </li>
        <?php
        }
        if($cur_user_row['user_type']===Constants::USER_TYPE_APP){ ?>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/myShop.php")'>
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">My Shop</span>
          </a>
        </li>
        <?php
        }
        
        if($cur_user_row['user_type']===Constants::USER_TYPE_APP){ ?>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/createOrder.php");getCartUpdate(<?php echo $cur_user_row['supplier_id'];?>);'>
              <i class='bx bx-pie-chart-alt-2' ></i>
              <span class="links_name">Create Order </span>
              <span style="display: flex;color: #00eeff;"><i style="width:10%;font-size: medium;cursor:pointer;color: #00eeff" class="fa fa-cart-plus"></i><sup style="margin-left: -20px;margin-top: 15%;" class="cartDisplay">0</sup></span>
          </a>
        </li>
        <?php
        }
         
        if($cur_user_row['user_type']===Constants::USER_TYPE_APP){ ?>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/myOrder.php")'>
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">My Order</span>
          </a>
        </li>
        <?php
        }
        
        if($cur_user_row['user_type']===Constants::USER_TYPE_ADMIN){ ?>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/ordersForm.php")'>
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Active Orders</span>
          </a>
        </li>
        <?php
        }
        if($cur_user_row['user_type']===Constants::USER_TYPE_APP){ ?>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/orderHistory.php?min=0&limit=10")'>
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Order History</span>
          </a>
        </li>

         <?php 
        }
        if($cur_user_row['user_type']===Constants::USER_TYPE_APP){ ?>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/wallet.php?min=0&limit=10")'>
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">My Wallet</span>
          </a>
        </li>

      <?php 
        }
        //if($cur_user_row['user_type']===Constants::USER_TYPE_APP){ ?>
        <!-- <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/user_settings.php")'>
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Settings</span>
          </a>
        </li> -->
        <?php
        //}
       ?>
        
        
        <li class="log_out">
          <a onclick="logout()">
            <i class='bx bx-log-out'></i>
            <span class="links_name logout">Log out</span>
          </a>
        </li>
      </ul>
  </div>
  <section class="home-section">
    <nav>
      <div class="sidebar-button">
        <i class='bx bx-menu sidebarBtn' style="cursor: pointer;"></i>
        <span style="padding:0 8px;" class="dashboard"><i class="fa fa-arrow-left" style="font-size:15px;cursor: pointer;" aria-hidden="true"></i></span>
          <span style="padding:0 8px;" class="dashboard"><i class="fa fa-arrow-right" style="font-size:15px;cursor: pointer;" aria-hidden="true"></i></span>
      </div>
      <div class="search-box" >
       SPAZA <span class="username"> ~ <?php echo $cur_user_row['name']." ".$cur_user_row['surname']." : ".$cur_user_row['id'];?> | 
        <input id="toggle-one" onchange="changeToggle('<?php echo $cur_user_row['background'];?>')" <?php if($cur_user_row['background']==1){echo'checked';}else{echo 'data-onstyle="default"';}?> data-size="mini" data-width="15" data-height="20" type="checkbox">
        <script>
          $(function() {
            $('#toggle-one').bootstrapToggle({
              on: '<i style="color:yellow;" class="fa fa-sun-o" aria-hidden="true"></i>',
              off: '<i style="color:darkred;" class="fa fa-moon-o" aria-hidden="true"></i>'
            });
          })
        </script>
      </div>
      <div class="maKhathiSpazaSearch">
          <input type="search-box" class="maKhathiSpazaSearchInput" placeholder="Global Search...">
      </div>
      <div class="profile-details">
        <img src="../img/logo-1933884_640.webp" alt="">
        <span class="admin_name"><?php echo $cur_user_row['name']." ".$cur_user_row['surname'];?></span>
        <i class='bx bx-chevron-down' ></i>
      </div>
    </nav>

    <div class="home-content" <?php if($cur_user_row['background']==1){echo'style="background: #f1f1f1;"';} ?> >
      <div class="masomane">
        <div class="makhanyile box">
          
        </div>
        <!-- <div class="maKhathi box">
          <div class="maKhathiSpazaSearch">
            <input type="search-box" class="maKhathiSpazaSearchInput" placeholder="Search Spaza...">
          </div>
        </div> -->
      </div>
    </div>
  </section>
  <div class="modal" id="createSupplier">
  <div class="modal-dialog">
    <div class="modal-content" style="width:670px;margin-left: -12%;">
      <div class="modal-header">
        <h4 class="modal-title" style="text-align: center;<?php if($cur_user_row['background']==1){echo'color:black;';}else{echo'color:white;';} ?>">Create New Supplier</h4>
        <button type="button" style="color: white;" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="twinsPack">
          <div class="inputVals">
            <label class="col-form-label">Supplier's Store Name</label>
            <input type="text" required class="form-control storeName" placeholder="User First Name ...">
          </div>
          <div class="inputVals">
            <label>Supplier's Store Address</label>
            <input type="text" required class="form-control storeAddress" placeholder="User Last Name">
          </div>
        </div>
        <div class="twinsPack">
          <div class="inputVals">
            <label>Nationality</label>
            <select class="form-control storeNationality" required>
              <option value="">-- Nationality --</option>
              <option value="South Africa">South Africa</option>
              <option value="Afghanistan">Afghanistan</option>
                            <option value="Åland Islands">Åland Islands</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option>
                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Aruba">Aruba</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option>
                            <option value="Benin">Benin</option>
                            <option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option>
                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option>
                            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                            <option value="Cook Islands">Cook Islands</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Cote D'ivoire">Cote D'ivoire</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                            <option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="French Guiana">French Guiana</option>
                            <option value="French Polynesia">French Polynesia</option>
                            <option value="French Southern Territories">French Southern Territories</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option>
                            <option value="Greenland">Greenland</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option>
                            <option value="Guam">Guam</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guernsey">Guernsey</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-bissau">Guinea-bissau</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Iceland">Iceland</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Isle of Man">Isle of Man</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                            <option value="Jersey">Jersey</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                            <option value="Korea, Republic of">Korea, Republic of</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Macao">Macao</option>
                            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option>
                            <option value="Malta">Malta</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                            <option value="Moldova, Republic of">Moldova, Republic of</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montenegro">Montenegro</option>
                            <option value="Montserrat">Montserrat</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Myanmar">Myanmar</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherlands">Netherlands</option>
                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option>
                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                            <option value="Norway">Norway</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau">Palau</option>
                            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Pitcairn">Pitcairn</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option>
                            <option value="Russian Federation">Russian Federation</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saint Helena">Saint Helena</option>
                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                            <option value="Saint Lucia">Saint Lucia</option>
                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                            <option value="Samoa">Samoa</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Serbia">Serbia</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                            <option value="Spain">Spain</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                            <option value="Swaziland">Swaziland</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                            <option value="Taiwan">Taiwan</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Timor-leste">Timor-leste</option>
                            <option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Viet Nam">Viet Nam</option>
                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                            <option value="Western Sahara">Western Sahara</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
            </select>
          </div>
          <div class="inputVals">
            <label>Province </label>
            <select class="form-control storeProvince" required>
              <option value="">-- Province --</option>
              <option value="KwaZulu-Natal">KwaZulu-Natal</option>
              <option value="Eastern Cape">Eastern Cape</option>
              <option value="Free State">Free State</option>
              <option value="Gauteng">Gauteng</option>
              <option value="Limpopo">Limpopo</option>
              <option value="Mpumalanga">Mpumalanga</option>
              <option value="Northern Cape">Northern Cape</option>
              <option value="North West">North West</option>
              <option value="Western Cape">Western Cape</option>
            </select>
          </div>
        </div>
        <div class="twinsPack">
          <div class="inputVals">
            <label>Supplier's Store Phone</label>
            <input type="number" required class="form-control storePhone" placeholder="Phone Number">
          </div>
          <div class="inputVals">
            <label>Reg No</label>
            <input type="text" required class="form-control storeRegNo" placeholder="Registration No">
          </div>
        </div>
        <div class="twinsPack">
          <div class="inputVals">
            <label>Supplier's Store Admin Name</label>
            <input type="text" required class="form-control storeAdminName" placeholder="Enter First Name">
          </div>
        </div>
        <div class="twinsPack">
          <div class="inputVals">
            <label>Supplier's Store Admin Surname</label>
            <input type="text" required class="form-control storeAdminSurname" placeholder="Enter Last Name">
          </div>
          <div class="inputVals">
            <label>Supplier's Store Admin ID No.</label>
            <input type="number" required class="form-control storeAdminIDNo" placeholder="ID Number">
            
          </div>
        </div>
        <div class="twinsPack">
          <div class="inputVals">
            <label>Supplier's Store Admin Employee Code</label>
            <input type="text" required class="form-control storeEmployeeCode" placeholder="Employee Code">
          </div>
          <div class="inputVals">
            <label>Supplier's Store logo</label>
            <input type="file" name="storeLogo" class="form-control storeLogo" id="storeLogo">
          </div>
        </div>
        <div class="twinsPack">
          <div class="inputVals">
            <label>Supplier's Store Admin Email</label>
            <input type="email" required class="form-control storeAdminEmail" placeholder="Enter Email Address">
          </div>
          <div class="inputVals">
            <label>Supplier's Store Admin Password</label>
            <input type="password" name="password" class="form-control storePassword" placeholder="Enter Password">
          </div>
        </div>
        
        <br>
        <div class="inputVals">
          <center>
            <span style="padding:10px 10px;border:1px solid #ddd;" class="addMasomaneNewSchool" onclick="createNewStoreSupplier()"> Create New Supplier <span style="padding:2px 2px;"><i style="padding:10px 10px;color:green;" class="fa fa-plus"></i></span></span>
          </center>
        </div>
        <div class="createUserErrorLog" hidden></div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="modal" id="addNewUser">
  <div class="modal-dialog">
    <div class="modal-content" style="width:670px;margin-left: -12%;">
      <div class="modal-header">
        <h4 class="modal-title" style="text-align: center;<?php if($cur_user_row['background']==1){echo'color:black;';}else{echo'color:white;';} ?>">Create User</h4>
        <button type="button" style="color: white;" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="twinsPack">
          <div class="inputVals">
            <label class="col-form-label">First name</label>
            <input type="text" required class="form-control fname" placeholder="User First Name ...">
          </div>
          <div class="inputVals">
            <label>Last name</label>
            <input type="text" required class="form-control lname" placeholder="User Last Name">
          </div>
        </div>
        <div class="twinsPack">
          <div class="inputVals">
            <label>Nationality</label>
            <select class="form-control nationality" required>
              <option value="">-- Nationality --</option>
              <option value="South Africa">South Africa</option>
              <option value="Afghanistan">Afghanistan</option>
                            <option value="Åland Islands">Åland Islands</option>
                            <option value="Albania">Albania</option>
                            <option value="Algeria">Algeria</option>
                            <option value="American Samoa">American Samoa</option>
                            <option value="Andorra">Andorra</option>
                            <option value="Angola">Angola</option>
                            <option value="Anguilla">Anguilla</option>
                            <option value="Antarctica">Antarctica</option>
                            <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                            <option value="Argentina">Argentina</option>
                            <option value="Armenia">Armenia</option>
                            <option value="Aruba">Aruba</option>
                            <option value="Australia">Australia</option>
                            <option value="Austria">Austria</option>
                            <option value="Azerbaijan">Azerbaijan</option>
                            <option value="Bahamas">Bahamas</option>
                            <option value="Bahrain">Bahrain</option>
                            <option value="Bangladesh">Bangladesh</option>
                            <option value="Barbados">Barbados</option>
                            <option value="Belarus">Belarus</option>
                            <option value="Belgium">Belgium</option>
                            <option value="Belize">Belize</option>
                            <option value="Benin">Benin</option>
                            <option value="Bermuda">Bermuda</option>
                            <option value="Bhutan">Bhutan</option>
                            <option value="Bolivia">Bolivia</option>
                            <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                            <option value="Botswana">Botswana</option>
                            <option value="Bouvet Island">Bouvet Island</option>
                            <option value="Brazil">Brazil</option>
                            <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                            <option value="Brunei Darussalam">Brunei Darussalam</option>
                            <option value="Bulgaria">Bulgaria</option>
                            <option value="Burkina Faso">Burkina Faso</option>
                            <option value="Burundi">Burundi</option>
                            <option value="Cambodia">Cambodia</option>
                            <option value="Cameroon">Cameroon</option>
                            <option value="Canada">Canada</option>
                            <option value="Cape Verde">Cape Verde</option>
                            <option value="Cayman Islands">Cayman Islands</option>
                            <option value="Central African Republic">Central African Republic</option>
                            <option value="Chad">Chad</option>
                            <option value="Chile">Chile</option>
                            <option value="China">China</option>
                            <option value="Christmas Island">Christmas Island</option>
                            <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                            <option value="Colombia">Colombia</option>
                            <option value="Comoros">Comoros</option>
                            <option value="Congo">Congo</option>
                            <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                            <option value="Cook Islands">Cook Islands</option>
                            <option value="Costa Rica">Costa Rica</option>
                            <option value="Cote D'ivoire">Cote D'ivoire</option>
                            <option value="Croatia">Croatia</option>
                            <option value="Cuba">Cuba</option>
                            <option value="Cyprus">Cyprus</option>
                            <option value="Czech Republic">Czech Republic</option>
                            <option value="Denmark">Denmark</option>
                            <option value="Djibouti">Djibouti</option>
                            <option value="Dominica">Dominica</option>
                            <option value="Dominican Republic">Dominican Republic</option>
                            <option value="Ecuador">Ecuador</option>
                            <option value="Egypt">Egypt</option>
                            <option value="El Salvador">El Salvador</option>
                            <option value="Equatorial Guinea">Equatorial Guinea</option>
                            <option value="Eritrea">Eritrea</option>
                            <option value="Estonia">Estonia</option>
                            <option value="Ethiopia">Ethiopia</option>
                            <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                            <option value="Faroe Islands">Faroe Islands</option>
                            <option value="Fiji">Fiji</option>
                            <option value="Finland">Finland</option>
                            <option value="France">France</option>
                            <option value="French Guiana">French Guiana</option>
                            <option value="French Polynesia">French Polynesia</option>
                            <option value="French Southern Territories">French Southern Territories</option>
                            <option value="Gabon">Gabon</option>
                            <option value="Gambia">Gambia</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Germany">Germany</option>
                            <option value="Ghana">Ghana</option>
                            <option value="Gibraltar">Gibraltar</option>
                            <option value="Greece">Greece</option>
                            <option value="Greenland">Greenland</option>
                            <option value="Grenada">Grenada</option>
                            <option value="Guadeloupe">Guadeloupe</option>
                            <option value="Guam">Guam</option>
                            <option value="Guatemala">Guatemala</option>
                            <option value="Guernsey">Guernsey</option>
                            <option value="Guinea">Guinea</option>
                            <option value="Guinea-bissau">Guinea-bissau</option>
                            <option value="Guyana">Guyana</option>
                            <option value="Haiti">Haiti</option>
                            <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                            <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                            <option value="Honduras">Honduras</option>
                            <option value="Hong Kong">Hong Kong</option>
                            <option value="Hungary">Hungary</option>
                            <option value="Iceland">Iceland</option>
                            <option value="India">India</option>
                            <option value="Indonesia">Indonesia</option>
                            <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                            <option value="Iraq">Iraq</option>
                            <option value="Ireland">Ireland</option>
                            <option value="Isle of Man">Isle of Man</option>
                            <option value="Israel">Israel</option>
                            <option value="Italy">Italy</option>
                            <option value="Jamaica">Jamaica</option>
                            <option value="Japan">Japan</option>
                            <option value="Jersey">Jersey</option>
                            <option value="Jordan">Jordan</option>
                            <option value="Kazakhstan">Kazakhstan</option>
                            <option value="Kenya">Kenya</option>
                            <option value="Kiribati">Kiribati</option>
                            <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                            <option value="Korea, Republic of">Korea, Republic of</option>
                            <option value="Kuwait">Kuwait</option>
                            <option value="Kyrgyzstan">Kyrgyzstan</option>
                            <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                            <option value="Latvia">Latvia</option>
                            <option value="Lebanon">Lebanon</option>
                            <option value="Lesotho">Lesotho</option>
                            <option value="Liberia">Liberia</option>
                            <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                            <option value="Liechtenstein">Liechtenstein</option>
                            <option value="Lithuania">Lithuania</option>
                            <option value="Luxembourg">Luxembourg</option>
                            <option value="Macao">Macao</option>
                            <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                            <option value="Madagascar">Madagascar</option>
                            <option value="Malawi">Malawi</option>
                            <option value="Malaysia">Malaysia</option>
                            <option value="Maldives">Maldives</option>
                            <option value="Mali">Mali</option>
                            <option value="Malta">Malta</option>
                            <option value="Marshall Islands">Marshall Islands</option>
                            <option value="Martinique">Martinique</option>
                            <option value="Mauritania">Mauritania</option>
                            <option value="Mauritius">Mauritius</option>
                            <option value="Mayotte">Mayotte</option>
                            <option value="Mexico">Mexico</option>
                            <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                            <option value="Moldova, Republic of">Moldova, Republic of</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Mongolia">Mongolia</option>
                            <option value="Montenegro">Montenegro</option>
                            <option value="Montserrat">Montserrat</option>
                            <option value="Morocco">Morocco</option>
                            <option value="Mozambique">Mozambique</option>
                            <option value="Myanmar">Myanmar</option>
                            <option value="Namibia">Namibia</option>
                            <option value="Nauru">Nauru</option>
                            <option value="Nepal">Nepal</option>
                            <option value="Netherlands">Netherlands</option>
                            <option value="Netherlands Antilles">Netherlands Antilles</option>
                            <option value="New Caledonia">New Caledonia</option>
                            <option value="New Zealand">New Zealand</option>
                            <option value="Nicaragua">Nicaragua</option>
                            <option value="Niger">Niger</option>
                            <option value="Nigeria">Nigeria</option>
                            <option value="Niue">Niue</option>
                            <option value="Norfolk Island">Norfolk Island</option>
                            <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                            <option value="Norway">Norway</option>
                            <option value="Oman">Oman</option>
                            <option value="Pakistan">Pakistan</option>
                            <option value="Palau">Palau</option>
                            <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                            <option value="Panama">Panama</option>
                            <option value="Papua New Guinea">Papua New Guinea</option>
                            <option value="Paraguay">Paraguay</option>
                            <option value="Peru">Peru</option>
                            <option value="Philippines">Philippines</option>
                            <option value="Pitcairn">Pitcairn</option>
                            <option value="Poland">Poland</option>
                            <option value="Portugal">Portugal</option>
                            <option value="Puerto Rico">Puerto Rico</option>
                            <option value="Qatar">Qatar</option>
                            <option value="Reunion">Reunion</option>
                            <option value="Romania">Romania</option>
                            <option value="Russian Federation">Russian Federation</option>
                            <option value="Rwanda">Rwanda</option>
                            <option value="Saint Helena">Saint Helena</option>
                            <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                            <option value="Saint Lucia">Saint Lucia</option>
                            <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                            <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                            <option value="Samoa">Samoa</option>
                            <option value="San Marino">San Marino</option>
                            <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                            <option value="Saudi Arabia">Saudi Arabia</option>
                            <option value="Senegal">Senegal</option>
                            <option value="Serbia">Serbia</option>
                            <option value="Seychelles">Seychelles</option>
                            <option value="Sierra Leone">Sierra Leone</option>
                            <option value="Singapore">Singapore</option>
                            <option value="Slovakia">Slovakia</option>
                            <option value="Slovenia">Slovenia</option>
                            <option value="Solomon Islands">Solomon Islands</option>
                            <option value="Somalia">Somalia</option>
                            <option value="South Africa">South Africa</option>
                            <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                            <option value="Spain">Spain</option>
                            <option value="Sri Lanka">Sri Lanka</option>
                            <option value="Sudan">Sudan</option>
                            <option value="Suriname">Suriname</option>
                            <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                            <option value="Swaziland">Swaziland</option>
                            <option value="Sweden">Sweden</option>
                            <option value="Switzerland">Switzerland</option>
                            <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                            <option value="Taiwan">Taiwan</option>
                            <option value="Tajikistan">Tajikistan</option>
                            <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                            <option value="Thailand">Thailand</option>
                            <option value="Timor-leste">Timor-leste</option>
                            <option value="Togo">Togo</option>
                            <option value="Tokelau">Tokelau</option>
                            <option value="Tonga">Tonga</option>
                            <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                            <option value="Tunisia">Tunisia</option>
                            <option value="Turkey">Turkey</option>
                            <option value="Turkmenistan">Turkmenistan</option>
                            <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                            <option value="Tuvalu">Tuvalu</option>
                            <option value="Uganda">Uganda</option>
                            <option value="Ukraine">Ukraine</option>
                            <option value="United Arab Emirates">United Arab Emirates</option>
                            <option value="United Kingdom">United Kingdom</option>
                            <option value="United States">United States</option>
                            <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                            <option value="Uruguay">Uruguay</option>
                            <option value="Uzbekistan">Uzbekistan</option>
                            <option value="Vanuatu">Vanuatu</option>
                            <option value="Venezuela">Venezuela</option>
                            <option value="Viet Nam">Viet Nam</option>
                            <option value="Virgin Islands, British">Virgin Islands, British</option>
                            <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                            <option value="Wallis and Futuna">Wallis and Futuna</option>
                            <option value="Western Sahara">Western Sahara</option>
                            <option value="Yemen">Yemen</option>
                            <option value="Zambia">Zambia</option>
                            <option value="Zimbabwe">Zimbabwe</option>
            </select>
          </div>
          <div class="inputVals">
            <label>Passport|SA ID No. </label>
            <input type="text" required class="form-control Passport_id" placeholder="Passport or SA ID Number">
          </div>
        </div>
        <div class="twinsPack">
          <div class="inputVals">
            <label>Gender</label>
            <select class="form-control gender">
              <option value="">-- Select Gender--</option>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
          </div>
          <div class="inputVals">
            <label>DOB</label>
            <input type="date" required class="form-control userDOB" placeholder="date of birth">
          </div>
        </div>
        <div class="twinsPack">
          <!-- <div class="inputVals">
            <label>Permit Number</label>
            <input type="text" required class="form-control permitNumber" placeholder="Permit/visa number">
          </div> -->
          <div class="inputVals">
            <label>Country of origin address</label>
            <input type="text" required class="form-control coutryOfOriginAddress" placeholder="Country of origin address">
          </div>
        </div>
        <div class="twinsPack">
          <div class="inputVals">
            <label>SA Residing Address</label>
            <input type="text" required class="form-control saResidingAddress" placeholder="SA Residing address">
          </div>
          <div class="inputVals">
            <label>Email Address</label>
            <input type="email" required class="form-control userEmailAddress" placeholder="Email Address">
            
          </div>
        </div>
        <div class="twinsPack">
          <div class="inputVals">
            <label>Certified passport|SA ID Copy</label>
            <input type="file" required name="passport_id_certifiedcopy" accept=".pdf" class="form-control passport_id_certifiedcopy" id="passport_id_certifiedcopy" placeholder="certifies copy Passport or SA ID">
          </div>
          <div class="inputVals">
            <label>Proof of country of origin address</label>
            <input type="file" name="CountryOfOriginProofOfAddress" accept=".pdf" class="form-control CountryOfOriginProofOfAddress" id="CountryOfOriginProofOfAddress">
          </div>
        </div>
        <div class="twinsPack">
          <div class="inputVals">
            <label>Facial Image</label>
            <input type="file" required name="facialImage" class="form-control facialImage" accept="image/*" id="facialImage" placeholder="facialImage">
          </div>
          <div class="inputVals">
            <label>Proof of SA Residing address</label>
            <input type="file" name="SAproofOfResidingAddress" accept=".pdf" class="form-control SAproofOfResidingAddress" id="SAproofOfResidingAddress">
          </div>
        </div>
        <div class="twinsPack">
          <div class="inputVals">
            <label>Phone Number</label>
            <input type="number" required class="form-control phoneNumber" placeholder="Phone number">
          </div>
          <div class="inputVals">
            <label>Password</label>
            <input type="password" required class="form-control userPassword" placeholder="User Password">
            
          </div>
        </div>
        <br>
        <div class="inputVals">
          <center>
            <span style="padding:10px 10px;border:1px solid #ddd;" class="addMasomaneNewSchool" onclick="createNewUser()"> Create New User <span style="padding:2px 2px;"><i style="padding:10px 10px;color:green;" class="fa fa-plus"></i></span></span>
          </center>
        </div>
        <div class="createUserErrorLog" hidden></div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="modal" id="smallModal">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="smallModal"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<div class="modal" id="largeModal">
  <div class="modal-dialog">
    <div class="modal-content largeModal">
      
      <div class="showlargeModal"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
<!-- <div class="modal" id="addNetchatsaSubjects">
  <style>
    input.errorLogMasoManeAddNetchatsaSubject{
      width: 100%;
      border:none;
      border-radius: 100px;
      background:none;
      border-top: 2px solid rebeccapurple;
      border-bottom: 2px solid mediumvioletred;
      color:rebeccapurple;
    }
    input.errorLogMasoManeAddNetchatsaSubject:hover{
      border-bottom: 2px solid rebeccapurple;
      border-top: 2px solid mediumvioletred;
      color:mediumvioletred;
    }

  </style>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="text-align: center;">Add Netchatsa Subject</h4>
        <button type="button" style="color: white;" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="inputVals">
          <input type="text" required class="SubjectNameNetchatsa" placeholder="Enter Principal Name">
        </div>
        <div class="inputVals">
          <select class="gradeNetchatsa">
            <option value=""> -- Select Grade -- </option>
            <option value="Gr12">Grade 12</option>
            <option value="Gr11">Grade 11</option>
            <option value="Gr10">Grade 10</option>
            <option value="Gr9">Grade 9</option>
            <option value="Gr8">Grade 8</option>
          </select>
        </div>
        
        <br>
        <div class="inputVals">

          <input type="submit" class="MasoManeAddNetchatsaSubject" onclick="MasoManeAddNetchatsaSubject()" value="Add new netchatsa subject" >
        </div>
        <div class="errorLogMasoManeAddNetchatsaSubjectError" hidden></div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div> -->
<script>
// let sidebar = document.querySelector(".sidebar");
// let sidebarBtn = document.querySelector(".sidebarBtn");
// sidebarBtn.onclick = function() {
//   sidebar.classList.toggle("active");
//   if(sidebar.classList.contains("active")){
//   sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
// }else
//   sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
// }
$(document).ready(function(){
  userType=['<?php echo $cur_user_row['user_type'];?>','<?php echo Constants::USER_TYPE_APP;?>'];
  if(userType[0]===userType[1]){
    homeload=<?php echo $isOrder;?>;
    if(homeload===1){
      loadAfterQuery(".makhanyile","../model/myOrder.php");
    }
    else{
      loadAfterQuery(".makhanyile","../model/myShop.php");
    }
    getCartUpdate(<?php echo $cur_user_row['supplier_id'];?>);
  }
  else{
    loadAfterQuery(".makhanyile","../model/ordersForm.php");
    
  }
})
$(document).on("change",".spazaShopsDisplay",function(){
    const spazaShopsDisplay = $('.spazaShopsDisplay').val();
    const spazaShopsDisplayClientId = $('.spazaShopsDisplayClientId').val();
    const orderTomakeUpdateOn = $(".orderTomakeUpdateOn").val();
    // console.log(spazaShopsDisplayClientId);
    $.ajax({
        url:'../controller/mmshightech/processor.php',
        type:'post',
        data:{spazaShopsDisplay:spazaShopsDisplay,spazaShopsDisplayClientId:spazaShopsDisplayClientId,orderTomakeUpdateOn:orderTomakeUpdateOn},
        success:function(e){
            response = JSON.parse(e);
            // console.log(response['response']);
            if(response['responseStatus']==='S'){
                loadAfterQuery(".makhanyile","../model/checkout.php?order_id="+orderTomakeUpdateOn);
            }
            else{
                $(".errorDisplaysetter").attr("style","padding:5px 5px;color:red;text-align:center;border:1px solid red;").html(response['responseMessage']);
            }
        }
    });
});
$(document).on("change",".updateSupplier",function(){
    const updateSupplierOnSpazaOner = $('.updateSupplier').val();
    // const spaza_owner_user_id = $('.spaza_owner_user_id').val();
    $.ajax({
        url:'../controller/mmshightech/processor.php',
        type:'post',
        data:{updateSupplierOnSpazaOner:updateSupplierOnSpazaOner},
        success:function(e){
            response = JSON.parse(e);
            // console.log(response['response']);
            if(response['responseStatus']==='S'){
              loadAfterQuery(".makhanyile","../model/createOrder.php")
                //loadAfterQuery(".makhanyile","../model/checkout.php?order_id="+orderTomakeUpdateOn);
            }
            else{
                $(".errorDisplaysetter").attr("style","padding:5px 5px;color:red;text-align:center;border:1px solid red;").html(response['responseMessage']);
            }
        }
    });

});
$(document).on("change",".changeIconImg",function(){
  const changeIconImg = document.getElementById('changeIconImg').files;
  const productId = $('.productId').val();
  var form_data = new FormData();
  for(var i=0;i<changeIconImg.length;i++){
    form_data.append("changeIconImg"+i,changeIconImg[i]);
  }
  form_data.append("changeIconImg",1);
  form_data.append("productId",productId);
  const url="../controller/mmshightech/processor.php";
  $(".displayResponse").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("<img style='width:5%;' src='../img/loader.gif'><h5 style='color:green;'>Processing Request..</h5>");
  $.ajax({
    url:url,
    processData: false,
    contentType: false,
    type:"POST",
    data:form_data,
    cache:false,
    enctype: 'multipart/form-data',
    success:function(e){
      response = JSON.parse(e);
      if(response['responseStatus']==='S'){
        $(".displayResponse").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("Product list added!!");
        domeSquareModal('productDataForm',productId);
      }
      else{
        $(".displayResponse").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:red;border:2px solid red;border-radius:10px;").html(response['responseMessage']);
      }
    }
  });
});
$(document).on("change",".filesUpload",function(){
  const filesUpload = document.getElementById('filesUpload').files;

  // console.log("sending "+filesUpload);
  var form_data = new FormData();
  for(var i=0;i<filesUpload.length;i++){
    form_data.append("filesUpload"+i,filesUpload[i]);
  }
  form_data.append("filesUpload",1);
  const url="../controller/mmshightech/processor.php";
  $(".displayResponse").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("<img style='width:5%;' src='../img/loader.gif'><h5 style='color:green;'>Processing Request..</h5>");
  $.ajax({
    url:url,
    processData: false,
    contentType: false,
    type:"POST",
    data:form_data,
    cache:false,
    enctype: 'multipart/form-data',
    success:function(e){
      response = JSON.parse(e);
      if(response['responseStatus']==='S'){
        $(".displayResponse").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("Product list added!!");
      }
      else{
        $(".displayResponse").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:red;border:2px solid red;border-radius:10px;").html(response['responseMessage']);
      }
    }
  });
});
function addNewProductDetails(){
  const add_label=$(".add_label").val();
  const add_sub_label=$(".add_sub_label").val();
  const add_description=$(".add_description").val();
  const add_manufacture=$(".add_manufacture").val();
  const add_brand=$(".add_brand").val();
  const add_category=$(".add_category").val();
  const add_seling_unit=$(".add_seling_unit").val();
  const add_qantity=$(".add_qantity").val();
  const add_content_uom=$(".add_content_uom").val();
  const add_ean_code=$(".add_ean_code").val();
  const add_alt_ean=$(".add_alt_ean").val();
  const add_alt_ean2=$(".add_alt_ean2").val();
  const add_code_single=$(".add_code_single").val();
  const add_start_date=$(".add_start_date").val();
  const add_end_date=$(".add_end_date").val();
  const add_price=$(".add_price").val();
  const add_label_promo_price=$(".add_label_promo_price").val();
  const add_percentage_discount=$(".add_percentage_discount").val();
  const add_discount_amount=$(".add_discount_amount").val();
  const addPromoToggle=$("#addPromoToggle").prop('checked')===true?'Y':'N';
  const addInstockToggle=$("#addInstockToggle").prop('checked')===true?'Y':'N';
  // console.log(addPromoToggle+' : '+addInstockToggle);
  $(".add_label").removeAttr("style");
  $(".add_sub_label").removeAttr("style");
  $(".add_description").removeAttr("style");
  $(".add_manufacture").removeAttr("style");
  $(".add_brand").removeAttr("style");
  $(".add_category").removeAttr("style");
  $(".add_seling_unit").removeAttr("style");
  $(".add_qantity").removeAttr("style");
  $(".add_content_uom").removeAttr("style");
  $(".add_ean_code").removeAttr("style");
  $(".add_alt_ean").removeAttr("style");
  $(".add_alt_ean2").removeAttr("style");
  $(".add_code_single").removeAttr("style");
  $(".add_start_date").removeAttr("style");
  $(".add_end_date").removeAttr("style");
  $(".add_price").removeAttr("style");
  $(".add_label_promo_price").removeAttr("style");
  $(".add_percentage_discount").removeAttr("style");
  $(".add_discount_amount").removeAttr("style");
  
  
  $(".displayErrorMessage").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("<img style='width:5%;' src='../img/loader.gif'><h5 style='color:green;'>Processing Request..</h5>");
  if(add_label.length<1){
    $(".add_label").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  // else if(amend_sub_label.length<1){
  //   $(".amend_sub_label").attr('style','border:1px solid red;');
  //   $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  // }
  else if(add_description.length<1){
    $(".add_description").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  else if(add_manufacture.length<1){
    $(".add_manufacture").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  else if(add_brand.length<1){
    $(".add_brand").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  else if(add_category.length<1){
    $(".add_category").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  else if(add_seling_unit.length<1){
    $(".add_seling_unit").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  else if(add_qantity.length<1){
    $(".add_qantity").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  // else if(amend_content_uom.length<1){
  //   $(".amend_content_uom").attr('style','border:1px solid red;');
  //   $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  // }
  else if(add_ean_code.length<1){
    $(".add_ean_code").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  // else if(amend_alt_ean.length<1){
  //   $(".amend_alt_ean").attr('style','border:1px solid red;');
  //   $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  // }
  // else if(amend_alt_ean2.length<1){
  //   $(".amend_alt_ean2").attr('style','border:1px solid red;');
  //   $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  // }
  // else if(amend_code_single.length<1){
  //   $(".amend_code_single").attr('style','border:1px solid red;');
  //   $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  // }
  // else if(amend_start_date.length<1){
  //   $(".amend_start_date").attr('style','border:1px solid red;');
  //   $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  // }
  // else if(amend_end_date.length<1){
  //   $(".amend_end_date").attr('style','border:1px solid red;');
  //   $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  // }
  else if(add_price.length<1){
    $(".add_price").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  else if(add_label_promo_price.length<1){
    $(".add_label_promo_price").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  else if(add_percentage_discount.length<1){
    $(".add_percentage_discount").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  else if(add_discount_amount.length<1){
    $(".add_discount_amount").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  else{
    url = "../controller/mmshightech/processor.php";
    $.ajax({
      url:url,
      type:'post',
      data:{add_label:add_label,
            add_sub_label:add_sub_label,
            add_description:add_description,
            add_manufacture:add_manufacture,
            add_brand:add_brand,
            add_category:add_category,
            add_seling_unit:add_seling_unit,
            add_qantity:add_qantity,
            add_content_uom:add_content_uom,
            add_ean_code:add_ean_code,
            add_alt_ean:add_alt_ean,
            add_alt_ean2:add_alt_ean2,
            add_code_single:add_code_single,
            add_start_date:add_start_date,
            add_end_date:add_end_date,
            add_price:add_price,
            add_label_promo_price:add_label_promo_price,
            add_percentage_discount:add_percentage_discount,
            add_discount_amount:add_discount_amount,
            addPromoToggle:addPromoToggle,
            addInstockToggle:addInstockToggle},
      success:function(e){
        // console.log(e);
        response = JSON.parse(e);
        // console.log(response);
        if(response['responseStatus']==='S'){
          $('.displayErrorMessage').removeAttr("hidden").attr("style","padding:5px 5px;color:green;text-align:center;border:1px solid green;").html('Data Updated Successfully');
        }
        else{
          $('.displayErrorMessage').removeAttr("hidden").attr("style","padding:5px 5px;color:red;text-align:center;border:1px solid green;").html(response['responseMessage']);
        }  
      }
    });
  }
}
function amendProductDetails(amend_product_id){
  const amend_label=$(".amend_label").val();
  const amend_sub_label=$(".amend_sub_label").val();
  const amend_description=$(".amend_description").val();
  const amend_manufacture=$(".amend_manufacture").val();
  const amend_brand=$(".amend_brand").val();
  const amend_category=$(".amend_category").val();
  const amend_seling_unit=$(".amend_seling_unit").val();
  const amend_qantity=$(".amend_qantity").val();
  const amend_content_uom=$(".amend_content_uom").val();
  const amend_ean_code=$(".amend_ean_code").val();
  const amend_alt_ean=$(".amend_alt_ean").val();
  const amend_alt_ean2=$(".amend_alt_ean2").val();
  const amend_code_single=$(".amend_code_single").val();
  const amend_start_date=$(".amend_start_date").val();
  const amend_end_date=$(".amend_end_date").val();
  const amend_price=$(".amend_price").val();
  const amend_label_promo_price=$(".amend_label_promo_price").val();
  const amend_percentage_discount=$(".amend_percentage_discount").val();
  const amend_discount_amount=$(".amend_discount_amount").val();
  $(".amend_label").removeAttr("style");
  $(".amend_sub_label").removeAttr("style");
  $(".amend_description").removeAttr("style");
  $(".amend_manufacture").removeAttr("style");
  $(".amend_brand").removeAttr("style");
  $(".amend_category").removeAttr("style");
  $(".amend_seling_unit").removeAttr("style");
  $(".amend_qantity").removeAttr("style");
  $(".amend_content_uom").removeAttr("style");
  $(".amend_ean_code").removeAttr("style");
  $(".amend_alt_ean").removeAttr("style");
  $(".amend_alt_ean2").removeAttr("style");
  $(".amend_code_single").removeAttr("style");
  $(".amend_start_date").removeAttr("style");
  $(".amend_end_date").removeAttr("style");
  $(".amend_price").removeAttr("style");
  $(".amend_label_promo_price").removeAttr("style");
  $(".amend_percentage_discount").removeAttr("style");
  $(".amend_discount_amount").removeAttr("style");
  $(".displayErrorMessage").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("<img style='width:5%;' src='../img/loader.gif'><h5 style='color:green;'>Processing Request..</h5>");
  if(amend_label.length<1){
    $(".amend_label").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  // else if(amend_sub_label.length<1){
  //   $(".amend_sub_label").attr('style','border:1px solid red;');
  //   $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  // }
  else if(amend_description.length<1){
    $(".amend_description").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  else if(amend_manufacture.length<1){
    $(".amend_manufacture").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  else if(amend_brand.length<1){
    $(".amend_brand").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  else if(amend_category.length<1){
    $(".amend_category").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  else if(amend_seling_unit.length<1){
    $(".amend_seling_unit").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  else if(amend_qantity.length<1){
    $(".amend_qantity").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  // else if(amend_content_uom.length<1){
  //   $(".amend_content_uom").attr('style','border:1px solid red;');
  //   $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  // }
  else if(amend_ean_code.length<1){
    $(".amend_ean_code").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  // else if(amend_alt_ean.length<1){
  //   $(".amend_alt_ean").attr('style','border:1px solid red;');
  //   $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  // }
  // else if(amend_alt_ean2.length<1){
  //   $(".amend_alt_ean2").attr('style','border:1px solid red;');
  //   $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  // }
  // else if(amend_code_single.length<1){
  //   $(".amend_code_single").attr('style','border:1px solid red;');
  //   $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  // }
  // else if(amend_start_date.length<1){
  //   $(".amend_start_date").attr('style','border:1px solid red;');
  //   $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  // }
  // else if(amend_end_date.length<1){
  //   $(".amend_end_date").attr('style','border:1px solid red;');
  //   $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  // }
  else if(amend_price.length<1){
    $(".amend_price").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  else if(amend_label_promo_price.length<1){
    $(".amend_label_promo_price").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  else if(amend_percentage_discount.length<1){
    $(".amend_percentage_discount").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  else if(amend_discount_amount.length<1){
    $(".amend_discount_amount").attr('style','border:1px solid red;');
    $(".displayErrorMessage").attr("style","color:red;").html("Field required!!");
  }
  else{
    url = "../controller/mmshightech/processor.php";
    $.ajax({
      url:url,
      type:'post',
      data:{amend_label:amend_label,
            amend_sub_label:amend_sub_label,
            amend_description:amend_description,
            amend_manufacture:amend_manufacture,
            amend_brand:amend_brand,
            amend_category:amend_category,
            amend_seling_unit:amend_seling_unit,
            amend_qantity:amend_qantity,
            amend_content_uom:amend_content_uom,
            amend_ean_code:amend_ean_code,
            amend_alt_ean:amend_alt_ean,
            amend_alt_ean2:amend_alt_ean2,
            amend_code_single:amend_code_single,
            amend_start_date:amend_start_date,
            amend_end_date:amend_end_date,
            amend_price:amend_price,
            amend_label_promo_price:amend_label_promo_price,
            amend_percentage_discount:amend_percentage_discount,
            amend_discount_amount:amend_discount_amount,amend_product_id:amend_product_id},
      success:function(e){
        // console.log(e);
        response = JSON.parse(e);
        // console.log(response);
        if(response['responseStatus']){
          $('.displayErrorMessage').removeAttr("hidden").attr("style","padding:5px 5px;color:green;text-align:center;border:1px solid green;").html('Data Updated Successfully');
        }
        else{
          $('.displayErrorMessage').removeAttr("hidden").attr("style","padding:5px 5px;color:green;text-align:center;border:1px solid green;").html(response['responseMessage']);
        }  
      }
    });
  }
}

function saveCardDetailsFromPayment(client_id_toSave2){
  const NameOnCard = $(".NameOnCard").val();
  const cardNumber = $(".cardNumber").val();
  const expiryDate = $(".expiryDate").val();
  const cvv = $(".cvv").val();
  $(".errorTagDisplay").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("<img style='width:10%;' src='../img/loader.gif'><h5 style='color:green;'>Processing Request..</h5>");
  $(".NameOnCard").attr("style","width:100%;padding:10px 10px;border:none;border-radius:10px;border:2px solid #ddd;");
  $(".cardNumber").attr("style","width:100%;padding:10px 10px;border:none;border-radius:10px;border:2px solid #ddd;");
  $(".expiryDate").attr("style","width:100%;padding:10px 10px;border:none;border-radius:10px;border:2px solid #ddd;");
  $(".cvv").attr("style","width:100%;padding:10px 10px;border:none;border-radius:10px;border:2px solid #ddd;");

  if(NameOnCard===""){
    $(".NameOnCard").attr("style","width:100%;padding:10px 10px;border:1px solid red;border-radius:10px;");
    $(".errorTagDisplay").removeAttr("hidden").attr("style","padding:10x 10px;color:red;").html("Field required!");
  }
  else if(cardNumber===""){
    $(".cardNumber").attr("style","width:100%;padding:10px 10px;border:1px solid red;border-radius:10px;");
    $(".errorTagDisplay").removeAttr("hidden").attr("style","padding:10x 10px;color:red;").html("Field required!");
  }
  else if(expiryDate===""){
    $(".expiryDate").attr("style","width:100%;padding:10px 10px;border:1px solid red;border-radius:10px;");
    $(".errorTagDisplay").removeAttr("hidden").attr("style","padding:10x 10px;color:red;").html("Field required!");
  }
  else if(cvv===""){
    $(".cvv").attr("style","width:100%;padding:10px 10px;border:1px solid red;border-radius:10px;");
    $(".errorTagDisplay").removeAttr("hidden").attr("style","padding:10x 10px;color:red;").html("Field required!");
  }
  else{
    let data={'NameOnCard':NameOnCard,'cardNumber':cardNumber,'expiryDate':expiryDate,'cvv':cvv,'client_id_toSave2':client_id_toSave2};
    // console.log("sending request");
    sendAjaxToPHP("",data,'.errorTagDisplay','Card added successfully.')?console.log("true"):console.log(false);
  }

}
function updateStatusProduct(productCodeToAttendToData,fieldToAttendTOData){
  let action = "PROMO Flag ";
  if(fieldToAttendTOData==='is_instock'){
    action = "STOCK Data ";
  }
  sendAjaxToPHP('',{'productCodeToAttendToData':productCodeToAttendToData,'fieldToAttendTOData':fieldToAttendTOData},'.displayErrorMessage',action+" updated Successfully");
}
function sendAjaxToPHP(url,dataArray,processorClass,successResponse){
  url = (url==="")?"../controller/mmshightech/processor.php":url;
  // console.log(processorClass);
  $.ajax({
      url:url,
      type:'post',
      data:dataArray,
      success:function(e){
          response = JSON.parse(e);
          if(response['responseStatus']==='F'){
              $(processorClass).removeAttr("hidden").attr("style","padding:5px 5px;color:red;text-align:center;").html($response['responseMessage']);
              return false;
          }
          else{
              $(processorClass).removeAttr("hidden").attr("style","padding:5px 5px;color:green;text-align:center;border:1px solid green;").html(successResponse);
              return true;
          }
      }
    });
}
function logout(){
  $('.logout').removeAttr("hidden").attr("style","padding:5px 5px;color:green;text-align:center;border:1px solid green;").html('Logging you out..');
  url = "../controller/mmshightech/processor.php";
  $.ajax({
    url:url,
    type:'post',
    data:{'LOGOUT':'logout'},
    success:function(e){
      $('.logout').removeAttr("hidden").attr("style","padding:5px 5px;color:green;text-align:center;border:1px solid green;").html('Good bye');
      window.location=("../");
  
    }
  });
}
function ProductSearchByName(searchProductTableColumn){
  const ProductSearchByName=$(".ProductSearchByName").val();
  searchProduct(searchProductTableColumn,ProductSearchByName);
}

function ProductSearchByUid(searchProductTableColumn){
  const ProductSearchByUid=$(".ProductSearchByUid").val();
  searchProduct(searchProductTableColumn,ProductSearchByUid);
}
function ProductSearchByDescription(searchProductTableColumn){
  const ProductSearchByDescription=$(".ProductSearchByDescription").val();
  searchProduct(searchProductTableColumn,ProductSearchByDescription);
}
function FindUserSearch(){
  const FindUserSearch=$('.findUserSearch').val();
  url = "../controller/mmshightech/search/userDetails.php";
  dataArray={'FindUserSearch':FindUserSearch};
  $.ajax({
    url:url,
    type:'post',
    data:dataArray,
    success:function(e){
      $(".userDisplay").html(e);
    }
  });
}

function maKhathiOrdersSearchInput(){
  const searchSpazaBynameOrOwner=$('.searchSpazaBynameOrOwner').val();
    url = "../controller/mmshightech/search/searchSpaza.php";
    dataArray={'searchSpazaBynameOrOwner':searchSpazaBynameOrOwner};
    $.ajax({
      url:url,
      type:'post',
      data:dataArray,
      success:function(e){
        $(".spazaDisplay").html(e);
      }
    });
}
function ProductSearchByBarcode(searchProductTableColumn){
  const ProductSearchByBarcode=$(".ProductSearchByBarcode").val();
  searchProduct(searchProductTableColumn,ProductSearchByBarcode);
}
function searchProduct(searchProductTableColumn,queryToSearchOnTable){
  url = "../controller/mmshightech/search/productSearchProcessor.php";
  dataArray={'searchProductTableColumn':searchProductTableColumn,'queryToSearchOnTable':queryToSearchOnTable};
  $.ajax({
    url:url,
    type:'post',
    data:dataArray,
    success:function(e){
      $(".productDisplay").html(e);
    }
  });
}
function productSearchCartMyShop(){
  const productSearchCartMyShop=$(".productSearchCartMyShop").val();
  if(productSearchCartMyShop.length==0){
      loadAfterQuery('.InstockProductDisplay','../model/loadMyShopProductInStock.php');
  }
  else{
    url = "../controller/mmshightech/search/productSearchCartMyShopSearch.php";
    dataArray={'productSearchCartMyShop':productSearchCartMyShop};
    $.ajax({
      url:url,
      type:'post',
      data:dataArray,
      success:function(e){
        $(".InstockProductDisplay").html(e);
      }
    });
  }
}
function findOrderNumberInput(){
  const searchOrderNumber=$(".findOrderNumberInput").val();
  if(searchOrderNumber.length==0){
      loadAfterQuery(".displayOrderData","../model/loadLiveOrdersPagination.php?min=0&limit=10");
  }
  else{
    url = "../controller/mmshightech/search/orderSearchProcessor.php";
    dataArray={'searchOrderNumber':searchOrderNumber};
    $.ajax({
      url:url,
      type:'post',
      data:dataArray,
      success:function(e){
        $(".displayOrderData").html(e);
      }
    });
  }
}
function validateNewOrder(order_total_amount,order_total_Vat,order_subTotal_amount,order_deliveryFee){
  $.ajax({
      url:'../controller/mmshightech/processor.php',
      type:'post',
      data:{'order_total_amount':order_total_amount,'order_total_Vat':order_total_Vat,'order_subTotal_amount':order_subTotal_amount,'order_deliveryFee':order_deliveryFee},
      success:function(e){
          // console.log(e);
          response=JSON.parse(e);
          // console.log(response);
          if(response['responseStatus']!=='S'){
              $(".validateOrder").attr("style","padding:5px 5px;color:red;text-align:center;").html(response['responseMessage']);
          }
          else{
              $(".validateOrder").attr("style","padding:5px 5px;color:green;text-align:center;border:1px solid green;").html("ORDER OK!!");
              loadAfterQuery('.makhanyile','../model/checkout.php?order_id='+response['orderNo']);
          }
      }
  });
}
function makePayment(order_number_toPay,client_id2Pay,amountToPayInTotal){
  let data={'client_id2Pay':client_id2Pay,'amountToPayInTotal':amountToPayInTotal,'order_number_toPay':order_number_toPay};
  url = "../controller/mmshightech/processor.php";
  $(".errorTagDisplay").removeAttr("hidden").html("Processing payment request...");
  $.ajax({
      url:url,
      type:'post',
      data:data,
      success:function(e){
        // console.log(e);
        data = JSON.parse(e);
        $(".errorTagDisplay").removeAttr("hidden").html("Contacting the bank..");
          if(data['responseStatus']==="S"){
            window.payfast_do_onsite_payment({"uuid":data['identifier']}, function (result){
              if(result){
                const client_id="";
                const amountToPay="";
                const pfData ="";
                const pfParamString ="";
                $(".errorTagDisplay").removeAttr("hidden").html(result +"Prossesing..");
                $.ajax({
                url:'processPayment.php',
                type:'post',
                data:{client_id:client_id,amountToPay:amountToPay,pfData:pfData,pfParamString:pfParamString},
                success:function(e){
                  data = JSON.parse(e);
                    if(data['responseStatus']==="S"){
                        $(".errorTagDisplay").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:green;border:2px solid white;text-align:center;font-size:14px;");
                        $(".errorTagDisplay").html("Payment Successful. please wait, redirecting you to your order.");
                        loadAfterQuery('.makhanyile','../model/myOrder.php?order_id='+order_number_toPay);

                    }
                    else{
                        $(".errorTagDisplay").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;");
                        $(".errorTagDisplay").html(data['responseMessage']);
                    }

                }
                });
              }
              else{
                  //window.location=("./?_=apply&failedProcessing=true");
                  $(".errorTagDisplay").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;");
                $(".errorTagDisplay").html("Payment Cancelled ");

              }
            }); 
          }
          else{
              $(".errorTagDisplay").removeAttr("hidden").attr("style","padding:5px 5px;color:red;text-align:center;border:1px solid red;").html(data['responseMessage']);
              return true;
          }
      }
  });
}
function productInfo(productId){
  domeSquareModal('productDataForm',productId);
}
function createNewStoreSupplier(){
    const storeName  = $(".storeName").val();
    const storeAddress  = $(".storeAddress").val();
    const storeNationality  = $(".storeNationality").val();
    const storeProvince  = $(".storeProvince").val();
    const storePhone  = $(".storePhone").val();
    const storeRegNo  = $(".storeRegNo").val();
    const storeAdminName  = $(".storeAdminName").val();
    const storeAdminSurname  = $(".storeAdminSurname").val();
    const storeAdminIDNo  = $(".storeAdminIDNo").val();
    const storeEmployeeCode  = $(".storeEmployeeCode").val();
    const storeAdminEmail = $(".storeAdminEmail").val();
    const storePassword  = $(".storePassword").val();
    const storeLogo = document.getElementById('storeLogo').files;
    $(".createUserErrorLog").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("<img style='width:5%;' src='../img/loader.gif'><h5 style='color:green;'>Processing Request..</h5>");
    if(storeName.length==0){
      $(".storeName").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(storePhone.length==0){
      $(".storePhone").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(storeNationality.length==0){
      $(".storeNationality").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(storeProvince.length==0){
      $(".storeProvince").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(storeAddress.length==0){
      $(".storeAddress").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(storeRegNo.length==0){
      $(".storeRegNo").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(storeAdminName.length==0){
      $(".storeAdminName").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(storeAdminSurname.length==0){
      $(".storeAdminSurname").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(storeAdminIDNo.length==0){
      $(".storeAdminIDNo").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(storeEmployeeCode.length==0){
      $(".storeEmployeeCode").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(storeAdminEmail.length==0){
      $(".storeAdminEmail").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(storePassword.length<5){
      $(".storePassword").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Password too short**");
    }
    else{
      $(".createUserErrorLog").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("<img style='width:5%;' src='../img/loader.gif'><h5 style='color:green;'>Verifying Request..</h5>");
      var form_data = new FormData();
      form_data.append("storeName",storeName);
      form_data.append("storePhone",storePhone);
      form_data.append("storeNationality",storeNationality);
      form_data.append("storeProvince",storeProvince);
      form_data.append("storeAddress",storeAddress);
      form_data.append("storeRegNo",storeRegNo);
      form_data.append("storeAdminName",storeAdminName);
      form_data.append("storeAdminSurname",storeAdminSurname);
      form_data.append("storeAdminIDNo",storeAdminIDNo);
      form_data.append("storeEmployeeCode",storeEmployeeCode);
      form_data.append("storeAdminEmail",storeAdminEmail);
      form_data.append("storePassword",storePassword);
      form_data.append("storeLogo",storeLogo[0]);
      const url="../controller/mmshightech/processor.php";
      $(".createUserErrorLog").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("<img style='width:5%;' src='../img/loader.gif'><h5 style='color:green;'>Submitting Request..</h5>");
      $.ajax({
        url:url,
        processData: false,
        contentType: false,
        type:"POST",
        data:form_data,
        cache:false,
        enctype: 'multipart/form-data',
        success:function(e){
          // 
          data=JSON.parse(e);
          // console.log(data);
          if(data['responseStatus']==='S'){
            $(".createUserErrorLog").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("New Supplier added.");
          }
          else{
            $(".createUserErrorLog").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:red;border:2px solid red;border-radius:10px;").html(data['responseMessage']);
          }
        }
      });
    }
}
function createNewUser(){
    const fname  = $(".fname").val();
    const lname  = $(".lname").val();
    const nationality  = $(".nationality").val();
    const Passport_id  = $(".Passport_id").val();
    const gender  = $(".gender").val();
    const userDOB  = $(".userDOB").val();
    const permitNumber  = $(".permitNumber").val();
    const coutryOfOriginAddress  = $(".coutryOfOriginAddress").val();
    const saResidingAddress  = $(".saResidingAddress").val();
    const userEmailAddress  = $(".userEmailAddress").val();
    const phoneNumber = $(".phoneNumber").val();
    // const passport_id_certifiedcopy  = $(".passport_id_certifiedcopy").val();
    // const CountryOfOriginProofOfAddress  = $(".CountryOfOriginProofOfAddress").val();
    // const facialImage  = $(".facialImage").val();
    // const SAproofOfResidingAddress  = $(".SAproofOfResidingAddress").val();
    const userPassword  = $(".userPassword").val();

    const passport_id_certifiedcopy = document.getElementById('passport_id_certifiedcopy').files;
    const countryOfOriginProofOfAddress = document.getElementById('CountryOfOriginProofOfAddress').files;
    const facialImage = document.getElementById('facialImage').files;
    const saproofOfResidingAddress = document.getElementById('SAproofOfResidingAddress').files;

    $(".createUserErrorLog").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("<img style='width:5%;' src='../img/loader.gif'><h5 style='color:green;'>Processing Request..</h5>");
    if(fname.length==0){
      $(".fname").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(phoneNumber.length==0){
      $(".phoneNumber").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(lname.length==0){
      $(".lname").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(nationality.length==0){
      $(".nationality").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(Passport_id.length==0){
      $(".Passport_id").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(gender.length==0){
      $(".gender").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(userDOB.length==0){
      $(".userDOB").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    // else if(permitNumber.length==0){
    //   $(".permitNumber").attr("style","border:1px solid red");
    //   $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    // }
    else if(coutryOfOriginAddress.length==0){
      $(".coutryOfOriginAddress").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(saResidingAddress.length==0){
      $(".saResidingAddress").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(userEmailAddress.length==0){
      $(".userEmailAddress").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(userPassword.length==0){
      $(".userPassword").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    // else if(passport_id_certifiedcopy.length==0){
    //   $(".passport_id_certifiedcopy").attr("style","border:1px solid red");
    //   $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    // }
    // else if(countryOfOriginProofOfAddress.length==0){
    //   $(".countryOfOriginProofOfAddress").attr("style","border:1px solid red");
    //   $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    // }
    // else if(facialImage.length==0){
    //   $(".facialImage").attr("style","border:1px solid red");
    //   $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    // }
    // else if(saproofOfResidingAddress.length==0){
    //   $(".saproofOfResidingAddress").attr("style","border:1px solid red");
    //   $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    // }
    else{
      $(".createUserErrorLog").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("<img style='width:5%;' src='../img/loader.gif'><h5 style='color:green;'>Verifying Request..</h5>");
      var form_data = new FormData();
      form_data.append("fnameNewUser",fname);
      form_data.append("lnameNewUser",lname);
      form_data.append("nationalityNewUser",nationality);
      form_data.append("Passport_idNewUser",Passport_id);
      form_data.append("genderNewUser",gender);
      form_data.append("userDOBNewUser",userDOB);
      form_data.append("permitNumberNewUser",permitNumber);
      form_data.append("coutryOfOriginAddressNewUser",coutryOfOriginAddress);
      form_data.append("saResidingAddressNewUser",saResidingAddress);
      form_data.append("userEmailAddressNewUser",userEmailAddress);
      form_data.append("userPasswordNewUser",userPassword);
      form_data.append("phoneNumberNewUser",phoneNumber);
      form_data.append("passport_id_certifiedcopyNewUser",passport_id_certifiedcopy[0]);
      form_data.append("countryOfOriginProofOfAddressNewUser",countryOfOriginProofOfAddress[0]);
      form_data.append("facialImageNewUser",facialImage[0]);
      form_data.append("sproofOfResidingAddressNewUser",saproofOfResidingAddress[0]);
      const url="../controller/mmshightech/processor.php";
      $(".createUserErrorLog").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("<img style='width:5%;' src='../img/loader.gif'><h5 style='color:green;'>Submitting Request..</h5>");
      $.ajax({
        url:url,
        processData: false,
        contentType: false,
        type:"POST",
        data:form_data,
        cache:false,
        enctype: 'multipart/form-data',
        success:function(e){
          // console.log(e);
          data=JSON.parse(e);
          if(data['responseStatus']==='S'){
            $(".createUserErrorLog").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("New user added.");
          }
          else{
            $(".createUserErrorLog").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:red;border:2px solid red;border-radius:10px;").html(data['responseMessage']);
          }
        }
      });
    }
}
function deliverOrder(deliverOrder_order_id){
  $(".displayResponseOrder").removeAttr('hidden').attr("style","color:green;").html("Delivering Order, please wait...");
  $.ajax({
      url:'../controller/mmshightech/processor.php',
      type:'post',
      data:{deliverOrder_order_id:deliverOrder_order_id},
      success:function(e){
          // console.log(e);
          response=JSON.parse(e);
          if(response['responseStatus']!=='S'){
              $(".displayResponseOrder").attr("style","padding:5px 5px;color:red;text-align:center;").html(response['responseMessage']);
          }
          else{
              $(".displayResponseOrder").attr("style","padding:5px 5px;color:green;text-align:center;border:1px solid green;").html("Order Delivered.");
              getOrderInfo(deliverOrder_order_id);
              
          }
      }
  });
}
function CancelOrder(CancelOrder_order_id){
  $(".displayResponseOrder").removeAttr('hidden').attr("style","color:green;").html("Cancelling Order, please wait...");
  $.ajax({
      url:'../controller/mmshightech/processor.php',
      type:'post',
      data:{CancelOrder_order_id:CancelOrder_order_id},
      success:function(e){
          response=JSON.parse(e);
          if(response['responseStatus']!=='S'){
              $(".displayResponseOrder").attr("style","padding:5px 5px;color:red;text-align:center;").html(response['responseMessage']);
          }
          else{
              $(".displayResponseOrder").attr("style","padding:5px 5px;color:green;text-align:center;border:1px solid green;").html("Order Cancelled.");
              getOrderInfo(CancelOrder_order_id);
              
          }
      }
  });
}
function removeThisProductFromOrder(removeThisProductFromOrder_order_id,removeThisProductFromOrder_product_id){
  $(".removeThisProductFromOrder").html("Removing Product-"+removeThisProductFromOrder_product_id+" please wait...");
  $.ajax({
      url:'../controller/mmshightech/processor.php',
      type:'post',
      data:{removeThisProductFromOrder_order_id:removeThisProductFromOrder_order_id,removeThisProductFromOrder_product_id:removeThisProductFromOrder_product_id},
      success:function(e){
          response=JSON.parse(e);
          if(response['responseStatus']!=='S'){
              $(".removeThisProductFromOrder").attr("style","padding:5px 5px;color:red;text-align:center;").html(e);
          }
          else{
              $(".proceremoveThisProductFromOrderssing").attr("style","padding:5px 5px;color:green;text-align:center;border:1px solid green;").html("Item Removed.");
              getOrderInfo(removeThisProductFromOrder_order_id);
              
          }
      }
  });
}
function removeUser(remove_this_user_id){
    $(".remove_this_user_id_response_error"+remove_this_user_id).removeAttr('hidden').html("Removing user-"+remove_this_user_id+", please wait...");
  $.ajax({
      url:'../controller/mmshightech/processor.php',
      type:'post',
      data:{remove_this_user_id:remove_this_user_id},
      success:function(e){
        // console.log(e);
          response=JSON.parse(e);
          if(response['responseStatus']!=='S'){
              $(".remove_this_user_id_response_error"+remove_this_user_id).attr("style","padding:5px 5px;color:red;text-align:center;").html(response['responseMessage']);
          }
          else{
              $(".remove_this_user_id_response_error"+remove_this_user_id).attr("style","padding:5px 5px;color:green;text-align:center;border:1px solid green;").html("user Removed.");
              $(".removeUser"+remove_this_user_id).attr('hidden','true');
              
          }
      }
  });
}
function acceptOrder(acceptOrderId){
  $(".displayResponseOrder").removeAttr('hidden').attr("style","padding:5px 5px;color:green;text-align:center;").html('Accepting Order...');
  $.ajax({
      url:'../controller/mmshightech/processor.php',
      type:'post',
      data:{acceptOrderId:acceptOrderId},
      success:function(e){
          response=JSON.parse(e);
          if(response['responseStatus']==="S"){
            $(".displayResponseOrder").removeAttr('hidden').attr("style","padding:5px 5px;color:green;text-align:center;").html('Order Accepted.');
            $(".invoiceOrder").removeAttr("onclick").html("ORDER ACCEPTED");
            getOrderInfo(acceptOrderId);
          }
          else{
            $(".displayResponseOrder").removeAttr('hidden').attr("style","padding:5px 5px;color:red;text-align:center;").html(response['responseMessage']);
          }
      }
  });
}
function markDownPicker(markDownPicker_order_id,markDownPicker_product_id){
  $(".displayResponseOrder").removeAttr('hidden').attr("style","padding:5px 5px;color:green;text-align:center;").html('Picking Item...');
  $.ajax({
      url:'../controller/mmshightech/processor.php',
      type:'post',
      data:{markDownPicker_order_id:markDownPicker_order_id,markDownPicker_product_id:markDownPicker_product_id},
      success:function(e){
        // console.log(e);
          response=JSON.parse(e);
          // console.log(e);
          if(response['responseStatus']==="S"){
            $(".displayResponseOrder").removeAttr('hidden').attr("style","padding:5px 5px;color:green;text-align:center;").html(markDownPicker_product_id+' Product Picked');
            // $(".invoiceOrder").removeAttr("onclick").html("ORDER ACCEPTED");
            getOrderInfo(markDownPicker_order_id);
          }
          else{
            $(".displayResponseOrder").removeAttr('hidden').attr("style","padding:5px 5px;color:red;text-align:center;").html(response['responseMessage']);
          }
      }
  });
}
function markAsArrived(OrderIdToMarkAsArrived,productIdToMarkAsArrived,current_value){
  $(".displayResponseOrder").removeAttr('hidden').attr("style","padding:5px 5px;color:green;text-align:center;").html('Marking Item...');
  current_value=(current_value==='N')?'Y':'N';
  $.ajax({
      url:'../controller/mmshightech/processor.php',
      type:'post',
      data:{OrderIdToMarkAsArrived:OrderIdToMarkAsArrived,productIdToMarkAsArrived:productIdToMarkAsArrived,current_value:current_value},
      success:function(e){
          response=JSON.parse(e);
          // console.log(response);
          if(response['responseStatus']==="S"){
            $(".displayResponseOrder").removeAttr('hidden').attr("style","padding:5px 5px;color:green;text-align:center;").html(productIdToMarkAsArrived+' Product Arrived.');
            // $(".invoiceOrder").removeAttr("onclick").html("ORDER INVOICED");
            loadAfterQuery(".makhanyile","../model/myOrder.php");
          }
          else{
            $(".displayResponseOrder").removeAttr('hidden').attr("style","padding:5px 5px;color:red;text-align:center;").html(response['responseMessage']);
          }
      }
  });

}
function addToSpazaCustomerInvoice(product_id_on_spaza,product_id,action_type_from_spaza,current_spaza_shop_id){
  // $(".errorDisplayLog").removeAttr('hidden').attr("style","padding:5px 5px;color:green;text-align:center;").html('Marking Item...');
  // current_value=(current_value==='N')?'Y':'N';
  $.ajax({
      url:'../controller/mmshightech/processor.php',
      type:'post',
      data:{product_id_on_spaza:product_id_on_spaza,product_id:product_id,action_type_from_spaza:action_type_from_spaza,current_spaza_shop_id:current_spaza_shop_id},
      success:function(e){
          response=JSON.parse(e);
          // console.log(response);
          if(response['responseStatus']==="S"){
            $(".itemQuantity"+product_id_on_spaza).removeAttr('hidden').html(response['responseMessage']);
            loadAfterQuery(".InvoicingProductDisplay","../model/spazaInvoiceForm.php?spaza="+current_spaza_shop_id);
            $(".errorDisplayLog").attr('hidden','true');
          }
          else{
            $(".errorDisplayLog").removeAttr('hidden').attr("style","padding:5px 5px;color:red;text-align:center;").html(response['responseMessage']);
          }
      }
  });
}
function spazaInvoiceProduct(invoicing_spaza_id,invoicing_spaza_amount){
  const invoicingSpazaInputAmount = $('.paymentAmount').val();
  // console.log(invoicingSpazaInputAmount+' : '+invoicing_spaza_amount);
  if(invoicingSpazaInputAmount.length>0){
    $(".displayLogInvoicing").removeAttr('hidden').attr("style","padding:5px 5px;color:red;font-size:9px;text-align:center;").html("Amount Entered is less than R"+invoicing_spaza_amount);
    $.ajax({
      url:'../controller/mmshightech/processor.php',
      type:'post',
      data:{invoicing_spaza_id:invoicing_spaza_id,invoicing_spaza_amount:invoicing_spaza_amount,invoicingSpazaInputAmount:invoicingSpazaInputAmount},
      success:function(e){
          response=JSON.parse(e);
          // console.log(response);
          if(response['responseStatus']==="S"){
            $(".displayLogInvoicing").removeAttr('hidden').attr("style","padding:5px 5px;color:green;text-align:center;").html("INVOICE COMPLETE");
            loadAfterQuery(".InvoicingProductDisplay","../model/invoiceComplete.php?invoice="+response['responseMessage']);
            loadAfterQuery('.InstockProductDisplay','../model/loadMyShopProductInStock.php');
          }
          else{
            $(".displayLogInvoicing").removeAttr('hidden').attr("style","padding:5px 5px;color:red;text-align:center;").html(response['responseMessage']);
          }
      }
    });
  }
}
function receiveMyOrder(orderNo_received_by_user){
  $(".errorDisplayLog").removeAttr('hidden').attr("style","padding:5px 5px;color:green;text-align:center;").html('Marking Item...');
  // current_value=(current_value==='N')?'Y':'N';
  $.ajax({
      url:'../controller/mmshightech/processor.php',
      type:'post',
      data:{orderNo_received_by_user:orderNo_received_by_user},
      success:function(e){
          response=JSON.parse(e);
          // console.log(response);
          if(response['responseStatus']==="S"){
            $(".errorDisplayLog").removeAttr('hidden').attr("style","padding:5px 5px;color:green;text-align:center;").html("ORDER -"+orderNo_received_by_user+' RECEIVED.');
            // $(".invoiceOrder").removeAttr("onclick").html("ORDER INVOICED");
            loadAfterQuery(".makhanyile","../model/myOrder.php");
          }
          else{
            $(".errorDisplayLog").removeAttr('hidden').attr("style","padding:5px 5px;color:red;text-align:center;").html(response['responseMessage']);
          }
      }
  });
}
function invoiceOrder(invoiceOrder_orderNo){
  $(".displayResponseOrder").removeAttr('hidden').attr("style","padding:5px 5px;color:green;text-align:center;").html('Processing Invoice...');
  $.ajax({
      url:'../controller/mmshightech/processor.php',
      type:'post',
      data:{invoiceOrder_orderNo:invoiceOrder_orderNo},
      success:function(e){
          response=JSON.parse(e);
          // console.log(response);
          if(response['responseStatus']==="S"){
            $(".displayResponseOrder").removeAttr('hidden').attr("style","padding:5px 5px;color:green;text-align:center;").html('Order Invoiced.');
            $(".invoiceOrder").removeAttr("onclick").html("ORDER INVOICED");
            getOrderInfo(invoiceOrder_orderNo);
          }
          else{
            $(".displayResponseOrder").removeAttr('hidden').attr("style","padding:5px 5px;color:red;text-align:center;").html(response['responseMessage']);
          }
      }
  });
}
function getOrderInfo(orderNo){
  domeSquareModal('ordersFormData',orderNo);
}
function getSpazaInfo(spazaNo){
  domeSquareModal('spazaFormData',spazaNo);
}
function addNewSpaza(userId){
  domeSmallModal('addNewSpaza',userId);
}
function getUserInfo(userId){
  domeSquareModal('manageUsersFormData',userId);
}
let sidebar = document.querySelector(".sidebar");
let sidebarBtn = document.querySelector(".sidebarBtn");
sidebarBtn.onclick = function() {
  sidebar.classList.toggle("active");
  if(sidebar.classList.contains("active")){
    sidebarBtn.classList.replace("bx-menu" ,"bx-menu-alt-right");
  }
  else{
    sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
  }
}
function changeToggle(domea){
  const dome = (domea==1)?0:1;
  $.ajax({
      url:'../controller/mmshightech/processor.php',
      type:'post',
      data:{dome:dome},
      success:function(e){
          response = JSON.parse(e);
          if(response['responseStatus']==='S'){
              $(".processing").attr("style","padding:5px 5px;color:red;text-align:center;").html(response['responseMessage']);
          }
          else{
              $(".processing").attr("style","padding:5px 5px;color:green;text-align:center;border:1px solid green;").html("Signing onto to your account..");
              window.location=("./");
          }
      }
  });
}
function addNewSpazaDetails(spazaOwnerId){
    const userEmailAddress = $("#userEmailAddress").val();
    const userPhoneNo = $("#userPhoneNo").val();
    const userDOB = $("#userDOB").val();
    const gender = $("#gender").val();
    const country = $("#country").val();
    const id_passport = $("#id_passport").val();
    const lname = $("#lname").val();
    const fname = $("#fname").val();
    const spaza = $("#spaza").val();
    $(".errorLogaddNewSpazaDetails").removeAttr("hidden");
    if(userEmailAddress===""){
        $(".userEmailAddress").attr("style","border:1px solid red;");
        $(".errorLogaddNewSpazaDetails").attr("style","border:2px solid red;color:red;border-radius:10px;").html("Email Address required!!");
    }
    else if(userPhoneNo ===""){
        $(".userPhoneNo").attr("style","border:1px solid red;");
        $(".errorLogaddNewSpazaDetails").attr("style","border:2px solid red;color:red;border-radius:10px;").html("Phone Number required!!");
    }
    else if(userDOB ===""){
        $(".userDOB").attr("style","border:1px solid red;");
        $(".errorLogaddNewSpazaDetails").attr("style","border:2px solid red;color:red;border-radius:10px;").html("Date of birth required!!");
    }
    else if(gender ===""){
        $(".gender").attr("style","border:1px solid red;");
        $(".errorLogaddNewSpazaDetails").attr("style","border:2px solid red;color:red;border-radius:10px;").html("Gender required!!");
    }
    else if(country ===""){
        $(".country").attr("style","border:1px solid red;");
        $(".errorLogaddNewSpazaDetails").attr("style","border:2px solid red;color:red;border-radius:10px;").html("Country required!!");
    }
    else if(id_passport ===""){
        $(".id_passport").attr("style","border:1px solid red;");
        $(".errorLogaddNewSpazaDetails").attr("style","border:2px solid red;color:red;border-radius:10px;").html("ID/Passport required!!");
    }
    else if(lname ===""){
        $(".lname").attr("style","border:1px solid red;");
        $(".errorLogaddNewSpazaDetails").attr("style","border:2px solid red;color:red;border-radius:10px;").html("Last Name required!!");
    }
    else if(fname ===""){
        $(".fname").attr("style","border:1px solid red;");
        $(".errorLogaddNewSpazaDetails").attr("style","border:2px solid red;color:red;border-radius:10px;").html("First Name required!!");
    }
    else if(spaza ===""){
        $(".spaza").attr("style","border:1px solid red;");
        $(".errorLogaddNewSpazaDetails").attr("style","border:2px solid red;color:red;border-radius:10px;").html("Spaza required!!");
    }
    else{
        $.ajax({
            url:'../controller/mmshightech/processor.php',
            type:'post',
            data:{
                spazaOwnerId:spazaOwnerId,
                userEmailAddress:userEmailAddress,
                userPhoneNo:userPhoneNo,
                userDOB:userDOB,
                gender:gender,
                country:country,
                id_passport:id_passport,
                lname:lname,
                fname:fname,
                spaza:spaza
            },
            success:function(e){
                response = JSON.parse(e);
                if(response['responseStatus']==='S'){
                    $(".errorLogaddNewSpazaDetails").attr("style","padding:5px 5px;color:red;text-align:center;border:1px solid red;").html("Failed to add spaza due to: "+response['responseMessage']);
                }
                else{
                    $(".errorLogaddNewSpazaDetails").attr("style","padding:5px 5px;color:green;text-align:center;border:1px solid green;").html("Spaza Added Successfully");
                    getSpazaInfo(response['responseMessage']);
                }
            }
        });
    }
}
function removeSpazaPermanetly(spaza_id_toBeRemoved){
    $.ajax({
        url:'../controller/mmshightech/processor.php',
        type:'post',
        data:{spaza_id_toBeRemoved:spaza_id_toBeRemoved},
        success:function(e){
            response = JSON.parse(e);
            if(response['responseStatus']==='S'){
                $(".removeSpaza"+spaza_id_toBeRemoved).attr("hidden","true");
            }
            else{
                $(".processing").attr("style","padding:5px 5px;color:red;text-align:center;border:1px solid red;").html(response['responseMessage']).removeAttr("hidden");
            }
        }
    });
}

function removeProductToCart(productIdToActionOnCart,actionType,cartProcessor_supplier_store_id){
    // console.log(actionType);
    $.ajax({
        url:'../controller/mmshightech/processor.php',
        type:'post',
        data:{productIdToActionOnCart:productIdToActionOnCart,actionType:actionType,cartProcessor_supplier_store_id:cartProcessor_supplier_store_id},
        success:function(e){
            response = JSON.parse(e);
            // console.log(response);
            if(response['responseStatus']==='S'){
                $(".itemQuantity"+productIdToActionOnCart).html(response['responseMessage']);
                getCartUpdate(<?php echo $cur_user_row['supplier_id'];?>);
            }
            else{
                $(".processing").attr("style","padding:5px 5px;color:green;text-align:center;border:1px solid green;").html(response['responseMessage']);

            }
        }
    });
}

function getCartUpdate(get_supplier_store_id){
    let getCartUpdates = 'getCartUpdates';
    $.ajax({
        url:'../controller/mmshightech/processor.php',
        type:'post',
        data:{getCartUpdates:getCartUpdates,get_supplier_store_id:get_supplier_store_id},
        success:function(e){
            $(".cartDisplay").html(e);
        }
    });
}
function setAddress(map_dir,spaza_id_to_add_address){
    const countryOfOriginAddress = $(".pac-input").val();
    $(".setAddress").html("processing...");
    if(countryOfOriginAddress===""){
        $(".countryOfOriginAddress").attr("style","border:1px solid red;");
        $(".setAddress").attr("style","color:red;").html("Address Field required!");
    }
    else{
        $.ajax({
            url:"../controller/mmshightech/processor.php",
            type:"POST",
            data:{countryOfOriginAddress:countryOfOriginAddress,map_dir:map_dir,spaza_id_to_add_address:spaza_id_to_add_address},
            cache:false,
            success:function(e){
                response = JSON.parse(e);
                if(response['responseStatus']==='S'){
                    $(".setAddress").html("Address set success.");
                }
                else{
                    $(".setAddress").html(response['responseMessage']);
                }
            }
        });
    }
}
function saveVisaDetails(spazaVisaDetailsId){
    const visa_number = $(".visa_number").val();
    const permit_number = $(".permit_number").val();
    // const copyOfVisa = $('#copyOfVisa').prop("files")[0];
    // const copyOfPermit = $('#copyOfPermit').prop("files")[0];
    const copyOfVisa = document.getElementById('copyOfVisa').files[0];
    // console.log(copyOfVisa);
    const copyOfPermit = document.getElementById('copyOfPermit').files[0];
    // console.log(copyOfPermit);
    $(".errorNotifier").removeAttr('hidden').attr("style","color:green;").html('Processing...');
    if(visa_number===''){
        $(".visa_number").attr('style','border:1px solid red;');
        $(".errorNotifier").removeAttr('hidden').attr("style","color:red;").html('Visa Number|Passport Number|ID no is required!!.');
    }
    else if(permit_number === ''){
        $(".permit_number").attr('style','border:1px solid red;');
        $(".errorNotifier").removeAttr('hidden').attr("style","color:red;").html('Permit Number is required!!.')
    }
    else if(copyOfVisa===undefined){
        $(".copyOfVisa").attr('style','border:1px solid red;');
        $(".errorNotifier").removeAttr('hidden').attr("style","color:red;").html('Copy of VISA or Passport Required!!.');
    }
    else if(copyOfPermit===undefined){
        $(".copyOfPermit").attr('style','border:1px solid red;');
        $(".errorNotifier").removeAttr('hidden').attr("style","color:red;").html('Copy of permit is required!!')
    }
    else{
        let form_data=new FormData();
        form_data.append("visa_number",visa_number);
        form_data.append("permit_number",permit_number);
        form_data.append("copyOfVisa",copyOfVisa);
        form_data.append("copyOfPermit",copyOfPermit);
        form_data.append('spazaVisaDetailsId',spazaVisaDetailsId);
        $.ajax({
            url:'../controller/mmshightech/processor.php',
            processData: false,
            contentType: false,
            type:"POST",
            data:form_data,
            cache:false,
            enctype: 'multipart/form-data',
            success:function(e){
                response = JSON.parse(e);
                if(response['responseStatus']==='S'){
                    $(".errorNotifier").removeAttr("hidden").attr("style","color:green;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html('Docs added successfully');
                }
                else{
                    $(".errorNotifier").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html(response['responseMessage']);
                }
            }
        });
    }
}
function saveLegalDocuments(spazaLegalDocumentId){
    const photo = document.getElementById('photo').files[0];
    const spazaAddress = document.getElementById('spazaAddress').files[0];
    const residentalAddress = document.getElementById('residentalAddress').files[0];
    const countryOfOriginAddress = document.getElementById('countryOfOriginAddress').files[0];
    if(photo===undefined){
        $(".photo").attr('style','border:1px solid red;');
        $(".errorNotifier").removeAttr('hidden').attr("style","color:red;").html('Facial Photo is required!!.');
    }
    else if(spazaAddress === undefined){
        $(".spazaAddress").attr('style','border:1px solid red;');
        $(".errorNotifier").removeAttr('hidden').attr("style","color:red;").html('proof of spaza address is required!!.')
    }
    else if(residentalAddress===undefined){
        $(".residentalAddress").attr('style','border:1px solid red;');
        $(".errorNotifier").removeAttr('hidden').attr("style","color:red;").html('Proof of residential address Required!!.');
    }
    else if(countryOfOriginAddress===undefined){
        $(".countryOfOriginAddress").attr('style','border:1px solid red;');
        $(".errorNotifier").removeAttr('hidden').attr("style","color:red;").html('Country of origin residential address required!!')
    }
    else{
        let form_data=new FormData();
        form_data.append("photo",photo);
        form_data.append("spazaAddress",spazaAddress);
        form_data.append("residentalAddress",residentalAddress);
        form_data.append("countryOfOriginAddress",countryOfOriginAddress);
        form_data.append('spazaLegalDocumentId',spazaLegalDocumentId);
        $.ajax({
            url:'../controller/mmshightech/processor.php',
            processData: false,
            contentType: false,
            type:"POST",
            data:form_data,
            cache:false,
            enctype: 'multipart/form-data',
            success:function(e){
                response = JSON.parse(e);
                if(response['responseStatus']==='S'){
                    $(".errorNotifier").removeAttr("hidden").attr("style","color:green;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html('Docs added successfully');
                }
                else{
                    $(".errorNotifier").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html(response['responseMessage']);
                }
            }
        });
    }

}
function emptyCart(empty_supplier_store_id){
    let emptyCart = 'emptyCart';
    $.ajax({
        url:'../controller/mmshightech/processor.php',
        type:'post',
        data:{emptyCart:emptyCart,empty_supplier_store_id:empty_supplier_store_id},
        success:function(e){
            response = JSON.parse(e);
            if(response['responseStatus']==='S'){
                loadAfterQuery('.flexible-loader','../model/cart.php');
            }
            else{
                $(".errorDisplay").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html(response['responseMessage']);
            }
        }
    });
}
function removeThisProduct(cartIdToRemove,remove_supplier_store_id){
    $.ajax({
        url:'../controller/mmshightech/processor.php',
        type:'post',
        data:{cartIdToRemove:cartIdToRemove,remove_supplier_store_id:remove_supplier_store_id},
        success:function(e){
            response = JSON.parse(e);
            if(response['responseStatus']==='S'){
                loadAfterQuery('.flexible-loader','../model/cart.php');
            }
            else{
                $(".errorDisplay").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html(response['responseMessage']);
            }
        }
    });
}
function saveCardDetails(clientIdToAddBankDetailsTo,spazaId){
    let cname=$("#cname").val();
    let ccnum=$("#ccnum").val();
    let expmonth=$("#expmonth").val();
    let expyear=$("#expyear").val();
    let cvv=$("#cvv").val();
    if(cname===''){
        $("#cname").attr('style','border:1px solid red;');
        $(".errorDisplay").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html(e);
    }
    else if(ccnum===''){
        $("#ccnum").attr('style','border:1px solid red;');
        $(".errorDisplay").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html(e);
    }
    else if(expmonth===''){
        $("#expmonth").attr('style','border:1px solid red;');
        $(".errorDisplay").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html(e);
    }
    else if(expyear===''){
        $("#expyear").attr('style','border:1px solid red;');
        $(".errorDisplay").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html(e);
    }
    else if(cvv===''){
        $("#cvv").attr('style','border:1px solid red;');
        $(".errorDisplay").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html(e);
    }
    else{
        $.ajax({
            url:'../controller/mmshightech/processor.php',
            type:'post',
            data:{clientIdToAddBankDetailsTo:clientIdToAddBankDetailsTo,cname:cname,ccnum:ccnum,expmonth:expmonth,expyear:expyear,cvv:cvv},
            success:function(e){
                response = JSON.parse(e);
                if(response['responseStatus']==='S'){
                    getSpazaInfo(spazaId);
                }
                else{
                    $(".errorDisplay").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html(response['responseMessage']);
                }
            }
        });
    }
}
function removeCardDetails(clientIdFromRemoveCardDetails,spazaId){
    $.ajax({
        url:'../controller/mmshightech/processor.php',
        type:'post',
        data:{clientIdFromRemoveCardDetails:clientIdFromRemoveCardDetails},
        success:function(e){
            response = JSON.parse(e);
            if(response['responseStatus']==='S'){
                getSpazaInfo(spazaId);
            }
            else{
                $(".errorDisplay").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html(response['responseMessage']);
            }
        }
    });
}
function addProductToCart(productIdToActionOnCart,actionType,cartProcessor_supplier_store_id){
  // console.log(productIdToActionOnCart+" - "+actionType);
    removeProductToCart(productIdToActionOnCart,actionType,cartProcessor_supplier_store_id);
}
function domeSmallModal(filename,request){
  $.ajax({
    url:'../model/'+filename+'.php',
    type:'post',
    data:{'request':request},
    beforeSend:function(){
      $(".smallModal").html("<img style='width:10%;' src='../img/loader.gif'><h5 style='color:green;'>Fetching Data..</h5>");
    },
    success:function(e){
      // console.log(e);
      $(".smallModal").html(e);
    }
  });
  $("#smallModal").modal("show");
}

function domeSquareModal(filename,request){
  $.ajax({
      url:'../model/'+filename+'.php',
      type:'post',
      data:{'request':request},
      beforeSend:function(){
          $(".showlargeModal").html("<img style='width:10%;' src='../img/loader.gif'><h5 style='color:green;'>Fetching Data..</h5>");
      },
      success:function(e){
          // console.log(e);
          $(".showlargeModal").html(e);
      }
    });
  $("#largeModal").modal("show");
}
function ShowMissingDataForm(map,spazaID){
    loadAfterQuery('.launchData','../model/dataFormDisplaySpazaMap.php?map='+map+'&spazaID='+spazaID);
}
function loadAfterQuery(rclass,dir){
  $(rclass).html("<center><img src='../img/loader.gif' style='width:30%;padding:10px 10px;justify-content:center;align-content:center;text-align:center;'></center>").load(dir);
}
</script>
</body>
</html>
<?php 
}
else{
  session_destroy();
  ?>
  <script>
    window.location=("../");
  </script>

  <?php
}
?>