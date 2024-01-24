<?php
include "../vendor/autoload.php";
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
  <?php
  if($cur_user_row['background']==0){
    echo'<link rel="stylesheet" href="../css/dark.css">';
  }
  else{
    echo'<link rel="stylesheet" href="../css/light.css">';
  }
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
        <li>
          <a onclick='loadAfterQuery(".makhanyile","../model/ordersForm.php")'>
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Orders</span>
          </a>
        </li>
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
          <a onclick='loadAfterQuery(".makhanyile","../model/activeOrder.php")'>
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
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" style="text-align: center;<?php if($cur_user_row['background']==1){echo'color:black;';}else{echo'color:white;';} ?>">Create User</h4>
        <button type="button" style="color: white;" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="inputVals">
          <input type="text" required class="fname" placeholder="User First Name ...">
        </div>
        <div class="inputVals">
          <input type="text" required class="lname" placeholder="User Last Name">
        </div>
        <div class="inputVals">
          <select class="gender">
            <option value="">-- Select Gender--</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
        <div class="inputVals">
          <input type="date" required class="userDOB" placeholder="date of birth">
        </div>
        <div class="inputVals">
          <input type="number" required class="userPhoneNo" placeholder="User Phone No.">
        </div>
        <div class="inputVals">
          <input type="email" required class="userEmailAddress" placeholder="Email Address">
        </div>
        <div class="inputVals">
          <input type="password" required class="userPassword" placeholder="User Password">
        </div>
        
        <br>
        <div class="inputVals">
          <center>
            <span style="padding:10px 10px;border:1px solid #ddd;" class="addMasomaneNewSchool" onclick="maSomaneAddNewSchool()"> Create New User <span style="padding:2px 2px;"><i style="padding:10px 10px;color:green;" class="fa fa-plus"></i></span></span>
          </center>
        </div>
        <div class="errorLogMasoManeAddSchool" hidden></div>
        
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
    $.ajax({
        url:'../controller/mmshightech/processor.php',
        type:'post',
        data:{spazaShopsDisplay:spazaShopsDisplay},
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
}else
  sidebarBtn.classList.replace("bx-menu-alt-right", "bx-menu");
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
function addNewSpazaDetails(){
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