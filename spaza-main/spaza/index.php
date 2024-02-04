<?php
include "../vendor/autoload.php";
include "../controller/mmshightech.php";
use Controller\mmshightech;

if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
  $mmshightech=new mmshightech();
  $cur_user_row = $mmshightech->userInfo($_SESSION['user_agent']);
  $userDirect=$cur_user_row['user_type'];
  if($cur_user_row['user_type']==$userDirect){

    date_default_timezone_set('Africa/Johannesburg');
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
.sidebar .logo-details{
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
  width:1350px;
  margin-left: -85%;
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
  box-shadow: 3px 5px 3px #000;
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
      <span class="logo_name">SPAZA</span>
    </div>
      <ul class="nav-links">
        <!-- <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/ordersForm.php")'>
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Orders</span>
          </a>
        </li> -->
        <li>
          <a data-bs-toggle="modal" data-bs-target="#addNewUser">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Create User</span>
          </a>
        </li>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/manageUsersForm.php")'>
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Manage users</span>
          </a>
        </li>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/manageSpazaForm.php")'>
            <i class='bx bx-box' ></i>
            <span class="links_name">Manage Spaza</span>
          </a>
        </li>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/createNewProduct.php")'>
            <i class='bx bx-list-ul' ></i>
            <span class="links_name">Create Product</span>
          </a>
        </li>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/matricUpgrade.php")'>
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Manage Products</span>
          </a>
        </li>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/createOrder.php");getCartUpdate();'>
              <i class='bx bx-pie-chart-alt-2' ></i>
              <span class="links_name">Create Order </span>
              <span style="display: flex;color: #00eeff;"><i style="width:10%;font-size: medium;cursor:pointer;color: #00eeff" class="fa fa-cart-plus"></i><sup style="margin-left: -20px;margin-top: 15%;" class="cartDisplay">0</sup></span>
          </a>
        </li>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/ordersForm.php")'>
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Active Orders</span>
          </a>
        </li>
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/orderHistory.php")'>
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Order History</span>
          </a>
        </li>
        
        
        <li class="log_out">
          <a onclick="logout()">
            <i class='bx bx-log-out'></i>
            <span class="links_name">Log out</span>
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
          <div class="inputVals">
            <label>Permit Number</label>
            <input type="text" required class="form-control permitNumber" placeholder="Permit/visa number">
          </div>
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
<div class="modal" id="addNetchatsaSubjects">
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
</div>
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
  loadAfterQuery(".makhanyile","../model/ordersForm.php");
  getCartUpdate();
})
$(document).on("change",".spazaShopsDisplay",function(){
    const spazaShopsDisplay = $('.spazaShopsDisplay').val();
    const spazaShopsDisplayClientId = $('.spazaShopsDisplayClientId').val();
    // console.log(spazaShopsDisplayClientId);
    $.ajax({
        url:'../controller/mmshightech/processor.php',
        type:'post',
        data:{spazaShopsDisplay:spazaShopsDisplay,spazaShopsDisplayClientId:spazaShopsDisplayClientId},
        success:function(e){
            console.log(e);
            if(e.length===1){
                loadAfterQuery('.spazaAddressDetails','../model/spazaDisplay.php?spazaId='+spazaShopsDisplay);
            }
            else{
                $(".errorDisplaysetter").attr("style","padding:5px 5px;color:red;text-align:center;border:1px solid red;").html(e);
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
  $(".displayResponse").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("<img style='width:10%;' src='../img/loader.gif'><h5 style='color:green;'>Processing Request..</h5>");
  $.ajax({
    url:url,
    processData: false,
    contentType: false,
    type:"POST",
    data:form_data,
    cache:false,
    enctype: 'multipart/form-data',
    success:function(e){
      if(e.length==1){
        $(".displayResponse").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("Product list added!!");
      }
      else{
        $(".displayResponse").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:red;border:2px solid red;border-radius:10px;").html(e);
      }
    }
  });
});
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
    console.log("sending request");
    sendAjaxToPHP("",data,'.errorTagDisplay','Card added successfully.')?console.log("true"):console.log(false);
  }

}
function sendAjaxToPHP(url,dataArray,processorClass,successResponse){
  url = (url==="")?"../controller/mmshightech/processor.php":url;
  console.log(processorClass);
  $.ajax({
      url:url,
      type:'post',
      data:dataArray,
      success:function(e){
          if(e.length>1){
              $(processorClass).removeAttr("hidden").attr("style","padding:5px 5px;color:red;text-align:center;").html(e);
              return false;
          }
          else{
              $(processorClass).removeAttr("hidden").attr("style","padding:5px 5px;color:green;text-align:center;border:1px solid green;").html(successResponse);
              return true;
          }
      }
    });
}
function makePayment(client_id2Pay,amountToPayInTotal){
  let data={'client_id2Pay':client_id2Pay,'amountToPayInTotal':amountToPayInTotal};
  url = "../controller/mmshightech/processor.php";
  $(".errorTagDisplay").removeAttr("hidden").html("Processing payment request...");
  $.ajax({
      url:url,
      type:'post',
      data:data,
      success:function(e){
        data = JSON.parse(e);
        $(".errorTagDisplay").removeAttr("hidden").html("Contacting the bank..");
          if(data['response']==="S"){
            
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
                    if(e.length<=2){
                        $(".errorTagDisplay").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:green;border:2px solid white;text-align:center;font-size:14px;");
                        $(".errorTagDisplay").html("Payment Successful. please wait, redirecting you to your order.");
                    }
                    else{
                        $(".errorTagDisplay").attr("style","width:100%;padding:10px 10px;color:#45f3ff;background:red;border:2px solid white;text-align:center;font-size:14px;");
                        $(".errorTagDisplay").html(e);
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
              $(".processorClass").removeAttr("hidden").attr("style","padding:5px 5px;color:red;text-align:center;border:1px solid red;").html(data['data']);
              return true;
          }
      }
  });
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

    $(".createUserErrorLog").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("<img style='width:10%;' src='../img/loader.gif'><h5 style='color:green;'>Processing Request..</h5>");
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
    else if(permitNumber.length==0){
      $(".permitNumber").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
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
    else if(passport_id_certifiedcopy.length==0){
      $(".passport_id_certifiedcopy").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(countryOfOriginProofOfAddress.length==0){
      $(".countryOfOriginProofOfAddress").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(facialImage.length==0){
      $(".facialImage").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else if(saproofOfResidingAddress.length==0){
      $(".saproofOfResidingAddress").attr("style","border:1px solid red");
      $(".createUserErrorLog").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:10px 10px;border-radius:10px;").html("Field required**");
    }
    else{
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
      $(".createUserErrorLog").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("<img style='width:10%;' src='../img/loader.gif'><h5 style='color:green;'>Processing Request..</h5>");
      $.ajax({
        url:url,
        processData: false,
        contentType: false,
        type:"POST",
        data:form_data,
        cache:false,
        enctype: 'multipart/form-data',
        success:function(e){
          if(e.length===1){
            $(".createUserErrorLog").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:green;").html("New user added.");
          }
          else{
            $(".createUserErrorLog").removeAttr("hidden").attr("style","padding:10px 10px;width:100%;color:red;border:2px solid red;border-radius:10px;").html(e);
          }
        }
      });
    }
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
          console.log(e);
          if(e.length>1){
              $(".processing").attr("style","padding:5px 5px;color:red;text-align:center;").html(e);
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
                console.log(e);
                if(e.length>10){
                    $(".errorLogaddNewSpazaDetails").attr("style","padding:5px 5px;color:red;text-align:center;border:1px solid red;").html("Failed to add spaza due to: "+e);
                }
                else{
                    $(".errorLogaddNewSpazaDetails").attr("style","padding:5px 5px;color:green;text-align:center;border:1px solid green;").html("Spaza Added Successfully");
                    getSpazaInfo(e);
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
            console.log(e);
            if(e.length===1){
                $(".removeSpaza"+spaza_id_toBeRemoved).attr("hidden","true");
            }
            else{
                $(".processing").attr("style","padding:5px 5px;color:red;text-align:center;border:1px solid red;").html(e).removeAttr("hidden");
            }
        }
    });
}
function removeProductToCart(productIdToActionOnCart,actionType){
    console.log(actionType);
    $.ajax({
        url:'../controller/mmshightech/processor.php',
        type:'post',
        data:{productIdToActionOnCart:productIdToActionOnCart,actionType:actionType},
        success:function(e){
            console.log(e);
            if(e.length<5){
                $(".itemQuantity"+productIdToActionOnCart).html(e);
                getCartUpdate();
            }
            else{
                $(".processing").attr("style","padding:5px 5px;color:green;text-align:center;border:1px solid green;").html("Signing onto to your account..");

            }
        }
    });
}

function getCartUpdate(){
    let getCartUpdates = 'getCartUpdates';
    $.ajax({
        url:'../controller/mmshightech/processor.php',
        type:'post',
        data:{getCartUpdates:getCartUpdates},
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
                if(e.length===1){
                    $(".setAddress").html("Address set success.");
                }
                else{
                    $(".setAddress").html(e);
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
                if(e.length===1){
                    $(".errorNotifier").removeAttr("hidden").attr("style","color:green;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html('Docs added successfully');
                }
                else{
                    $(".errorNotifier").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html(e);
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
                if(e.length===1){
                    $(".errorNotifier").removeAttr("hidden").attr("style","color:green;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html('Docs added successfully');
                }
                else{
                    $(".errorNotifier").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html(e);
                }
            }
        });
    }

}
function emptyCart(){
    let emptyCart = 'emptyCart';
    $.ajax({
        url:'../controller/mmshightech/processor.php',
        type:'post',
        data:{emptyCart:emptyCart},
        success:function(e){
            if(e.length===1){
                loadAfterQuery('.flexible-loader','../model/cart.php');
            }
            else{
                $(".errorDisplay").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html(e);
            }
        }
    });
}
function removeThisProduct(cartIdToRemove){
    $.ajax({
        url:'../controller/mmshightech/processor.php',
        type:'post',
        data:{cartIdToRemove:cartIdToRemove},
        success:function(e){
            if(e.length===1){
                loadAfterQuery('.flexible-loader','../model/cart.php');
            }
            else{
                $(".errorDisplay").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html(e);
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
                if(e.length===1){
                    getSpazaInfo(spazaId);
                }
                else{
                    $(".errorDisplay").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html(e);
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
            if(e.length===1){
                getSpazaInfo(spazaId);
            }
            else{
                $(".errorDisplay").removeAttr("hidden").attr("style","color:red;border:1px solid red;padding:5px 5px;font-size:smaller;border-radius:10px;").html(e);
            }
        }
    });
}
function addProductToCart(productIdToActionOnCart,actionType){
  // console.log(productIdToActionOnCart+" - "+actionType);
    removeProductToCart(productIdToActionOnCart,actionType);
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