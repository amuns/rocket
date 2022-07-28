<?php 
  session_start();
  require '../../utils.php';
  require '../../db/db-conn.php';

  if(!isset($_SESSION['user_logged_in'], $_SESSION['userData'])){
    $_SESSION['error']="Please Log in!";
    header('location: ../../auth/login.php');
    exit;
  }

  if(isset($_POST, $_POST['clear'])){
    unset($_POST);
    header("location: addcompany.php?uid=".$_GET['uid']);
    exit;
  }

  if(isset($_POST, $_POST['cid'], $_POST['cname'], $_POST['ccode'])){
    $cid=validate($_POST['cid']);
    $cname=validate($_POST['cname']);
    $ccode=validate($_POST['ccode']);

   
    try{
      $stmt=$conn->prepare("INSERT into company(company_id, company_name, company_code) VALUES(:cid, :cname, :ccode)");
      $stmt->execute(array(
        ":cid"=>$cid, 
        ":cname"=>$cname,
        ":ccode"=>$ccode
      ));

      if($stmt){
        $_SESSION['success']="Company table updated!";
        header("location: company.php?uid=".$_GET['uid']);
        exit;
      }
    }
    catch(Exception $e){
      $_SESSION['error']="Invalid Company Details!";
      header("location: addcompany.php?uid=".$_GET['uid']);
      exit;
    }
    
    
    
  }
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Rocket Trade Concern</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../vendors/feather/feather.css">
  <link rel="stylesheet" href="../vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../vendors/typicons/typicons.css">
  <link rel="stylesheet" href="../vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
  <link rel="stylesheet" href="../js/select.dataTables.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <style rel="stylesheet">
    .button {
     
      text-align: center;
      text-decoration: none;
      
      
      margin: 4px 2px;
      transition-duration: 0.4s;
      cursor: pointer;
    }
    .button1 {
    
      background-color: #4CAF50;
      color: white;
      padding: 15px 32px;
      border:none;
      border-radius:10px;
    }

    .button1:hover {
      background-color: white;
      color: #4CAF50;
    }

    .button2 {
    
    background-color: #008CBA;
    color: white;
    padding: 15px 32px;
    border:none;
    border-radius:10px;
  }

  .button2:hover {
    background-color: white;
    color: #008CBA;
  }
  </style>
  
</head>
<body>
  <div class="container-scroller">
    <div class="row p-0 m-0 proBanner" id="proBanner">
      <div class="col-md-12 p-0 m-0">
        <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
          <!-- <div class="ps-lg-1">
            <div class="d-flex align-items-center justify-content-between">
              <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
              <a href="https://www.bootstrapdash.com/product/star-admin-pro/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
            </div>
          </div> -->
          <!-- <div class="d-flex align-items-center justify-content-between">
            <a href="https://www.bootstrapdash.com/product/star-admin-pro/"><i class="mdi mdi-home me-3 text-white"></i></a>
            <button id="bannerClose" class="btn border-0 p-0">
              <i class="mdi mdi-close text-white me-0"></i>
            </button>
          </div> -->
        </div>
      </div>
    </div>
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
            <span class="icon-menu"></span>
          </button>
        </div>
        <div>
          <a class="navbar-brand brand-logo" href="dashboard.php?uid=<?=$_GET['uid']?>">
            <span><marquee behavior="" direction="">Rocket Trade Concern</marquee></span>
          </a>
          <!-- <a class="navbar-brand brand-logo-mini" href="dashboard.php">
            <img src="images/logo-mini.svg" alt="logo" />
          </a> -->
        </div>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-top"> 
        <ul class="navbar-nav">
          <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
            <h1 class="welcome-text">Welcome <span class="text-black fw-bold"><?=ucfirst($_SESSION['userData']['uname'])?>!</span></h1>
          </li>
        </ul>
        <ul class="navbar-nav ms-auto">
          
          <li class="nav-item d-none d-lg-block">
            <div id="datepicker-popup" class="input-group date datepicker navbar-date-picker">
              <span class="input-group-addon input-group-prepend border-right">
                <span class="icon-calendar input-group-text calendar-icon"></span>
              </span>
              <input type="text" class="form-control">
            </div>
          </li>
          <li class="nav-item">
            <form class="search-form" action="#">
              <i class="icon-search"></i>
              <input type="search" class="form-control" placeholder="Search Here" title="Search here">
            </form>
          </li>
         
          </li> 
          <li class="nav-item dropdown d-none d-lg-block user-dropdown">
            <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
              <img class="img-xs rounded-circle" src="../images/faces/user.png" alt="Profile image"> </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
              <div class="dropdown-header text-center">
                <p class="mb-1 mt-3 font-weight-semibold" style="font-size: 14px;"><?=$_SESSION['userData']['uname']?></p>
                <p class="fw-light text-muted mb-0" style="font-size: 14px;"><?=$_SESSION['userData']['email']?></p>
              </div>
              <!-- <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile <span class="badge badge-pill badge-danger">1</span></a>
              <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-message-text-outline text-primary me-2"></i> Messages</a>
              <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-calendar-check-outline text-primary me-2"></i> Activity</a>
              <a class="dropdown-item"><i class="dropdown-item-icon mdi mdi-help-circle-outline text-primary me-2"></i> FAQ</a> -->
              <a href="../logout.php" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
            </div>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
          <span class="mdi mdi-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border me-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border me-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        
        
      </div>
      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="../dashboard.php?uid=<?=$_GET['uid']?>">
              <i class="mdi mdi-grid-large menu-icon"></i>
              <span class="menu-title" style="font-size: 16px;">Dashboard</span>
            </a>
          </li>

          

          
          <li class="nav-item nav-category" style="font-size: 16px;">UI Elements</li>
          <li class="nav-item">
            <a class="nav-link"  href="company.php?uid=<?=$_GET['uid']?>">
              <!-- <i class="menu-icon mdi mdi-floor-plan"></i> -->
              <span class="menu-title" style="font-size: 15px;">Company</span>
              <!-- <i class="menu-arrow"></i>  -->
            </a>
            
          </li>

          <li class="nav-item">
            <a class="nav-link"  href="../products/products.php?uid=<?=$_GET['uid']?>">
              <!-- <i class="menu-icon mdi mdi-floor-plan"></i> -->
              <span class="menu-title" style="font-size: 15px;">Products</span>
              <!-- <i class="menu-arrow"></i>  -->
            </a>
            
          </li>
          
          
          
          
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                  <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active ps-0" href="company.php?uid=<?=$_GET['uid']?>" style="font-size: 14px;">Overview</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="addcompany.php?uid=<?=$_GET['uid']?>" role="tab" aria-selected="true" style="font-size: 14px;">Add Company</a>
                    </li>
                   
                  </ul>
                  <!-- <div>
                    <div class="btn-wrapper">
                      <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
                      <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                      <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
                    </div>
                  </div> -->
                </div>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                    
                    
                    <div class="row">
                    &nbsp;<h2>Add Company</h2>
                    <p style="font-size: 14px;"><?=flashMessages()?></p>
                      <div class="col-lg-8 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  
                                  
                                  <form method="POST" action="addcompany.php?uid=<?=$_GET['uid']?>"> 
                                    Company ID: <input type="text" name="cid" required><br><br>
                                    Company Name: <input type="text" name="cname" required><br><br>
                                    Company Code: <input type="text" name="ccode" required><br><br>
                                    <button class="button1" name="add">Add</button> &nbsp;&nbsp; <button class="button2" name="clear">Clear</button>
                                  </form>

                                </div>
                                
                              </div>
                            </div>
                          </div>
                        </div>
                        
                       
                        
                      </div>
                      <div class="col-lg-4 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="d-flex justify-content-between align-items-center">
                                      <h4 class="card-title card-title-dash">Todo list</h4>
                                      <div class="add-items d-flex mb-0">
                                        <!-- <input type="text" class="form-control todo-list-input" placeholder="What do you need to do today?"> -->
                                        <button class="add btn btn-icons btn-rounded btn-primary todo-list-add-btn text-white me-0 pl-12p"><i class="mdi mdi-plus"></i></button>
                                      </div>
                                    </div>
                                    <div class="list-wrapper">
                                      <ul class="todo-list todo-list-rounded">
                                        <!-- <li class="d-block">
                                          <div class="form-check w-100">
                                            <label class="form-check-label">
                                              <input class="checkbox" type="checkbox"> Lorem Ipsum is simply dummy text of the printing <i class="input-helper rounded"></i>
                                            </label>
                                            <div class="d-flex mt-2">
                                              <div class="ps-4 text-small me-3">24 June 2020</div>
                                              <div class="badge badge-opacity-warning me-3">Due tomorrow</div>
                                              <i class="mdi mdi-flag ms-2 flag-color"></i>
                                            </div>
                                          </div>
                                        </li> -->
                                        <!-- <li class="d-block">
                                          <div class="form-check w-100">
                                            <label class="form-check-label">
                                              <input class="checkbox" type="checkbox"> Lorem Ipsum is simply dummy text of the printing <i class="input-helper rounded"></i>
                                            </label>
                                            <div class="d-flex mt-2">
                                              <div class="ps-4 text-small me-3">23 June 2020</div>
                                              <div class="badge badge-opacity-success me-3">Done</div>
                                            </div>
                                          </div>
                                        </li> -->
                                       
                                        <!-- <li class="border-bottom-0">
                                          <div class="form-check w-100">
                                            <label class="form-check-label">
                                              <input class="checkbox" type="checkbox"> Lorem Ipsum is simply dummy text of the printing <i class="input-helper rounded"></i>
                                            </label>
                                            <div class="d-flex mt-2">
                                              <div class="ps-4 text-small me-3">24 June 2020</div>
                                              <div class="badge badge-opacity-danger me-3">Expired</div>
                                            </div>
                                          </div>
                                        </li> -->
                                      </ul>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      
                       
                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
       
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="../vendors/chart.js/Chart.min.js"></script>
  <script src="../vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <script src="../vendors/progressbar.js/progressbar.min.js"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
  <script src="../js/template.js"></script>
  <script src="../js/settings.js"></script>
  <script src="../js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="../js/jquery.cookie.js" type="text/javascript"></script>
  <script src="../js/dashboard.js"></script>
  <script src="../js/Chart.roundedBarCharts.js"></script>
  <!-- End custom js for this page-->
</body>

</html>

