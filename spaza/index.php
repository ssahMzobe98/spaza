<?php
if(session_status() !== PHP_SESSION_ACTIVE){
  session_start();
}
if(isset($_SESSION['user_agent'],$_SESSION['var_agent'])){
  //print_r($_SESSION);
  require_once("../controller/mmshightech.php");
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
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
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
          <a onclick='loadAfterQuery(".makhanyile","../model/createOrder.php")'>
            <i class='bx bx-pie-chart-alt-2' ></i>
            <span class="links_name">Create Order</span>
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
})
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