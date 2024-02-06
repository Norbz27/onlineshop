<?php
  include_once('dbconnect.php');
  
  $cat_id = $_GET['category'];
  $catname = $_GET['catname'];
  $msg = '';
  $save = isset($_POST['save']) ? $_POST['save'] : '';
  if($save == 'Add'){
      $name = $_POST['inputName'];
      $price = $_POST['inputprice'];
      $brand = $_POST['inputbrand'];
      $stock = $_POST['inputstock'];
      $image = $_POST['inputimage'];
      $description = $_POST['inputdescription'];
      $category = $_POST['inputcategory'];
      
      
      
      mysqli_query($conn, "insert into product (Name,Price,Stock,Img,Description,Category_Id,brand_Id) values('$name','$price','$stock','$image','$description','$category','$brand')") or die(mysqli_error($conn));
      
      $msg = '<div class="alert alert-success text-center" role="alert">
            Successfully added new Product!
          </div>';
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
  <script href="vendor/fontawesome-free/js/all.js" type="text/javascript"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" crossorigin="anonymous">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Poppins:700&display=swap" rel="stylesheet">


  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper" style="background-color: #151e3b;">

    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.php">
        <div class="sidebar-brand-icon">
          <img style="width: 35px; height: 30px;" src="img/logo">
        </div>
        <div class="sidebar-brand-text mx-3">LESSUSE</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="admin.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-signal"></i>
          <span>Transaction</span></a>
          <div  id="collapseOne" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="py-2 collapse-inner">
              <a class="collapse-item text-secondary" href="transaction.php">Pending</a>
              <a class="collapse-item text-secondary" href="confirmed_transaction.php">Confirmed</a>
              <a class="collapse-item text-secondary" href="declined_transaction.php">Canceled</a>
              <a class="collapse-item text-secondary" href="declined_transaction.php">Delivered</a>
          </div>
        </div>
      </li>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Sales</span></a>
      </li>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-shopping-basket"></i>
          <span>Product</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="py-2 collapse-inner">
            <?php
                  $sql = 'select * from category';
                  $result = $conn->query($sql);
                  while($row = $result->fetch_assoc()){
                  
                ?>
                  <a class="collapse-item text-secondary" href="Product.php?category=<?php echo $row['Category_Id']; ?>&catname=<?php echo $row['Category_Name']?>"><?=$row['Category_Name'];?></a>
                <?php }?>
          </div>
        </div>
      </li>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="user_accounts.php">
          <i class="fas fa-fw fa-user"></i>
          <span>User Accounts</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="delivery_accounts.php">
          <i class="fas fa-fw fa-user"></i>
          <span>Delivery Accounts</span></a>
      </li>
      
      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">3+</span>
              </a>
              <!-- Dropdown - Alerts -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                <h6 class="dropdown-header">
                  Alerts Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-primary">
                      <i class="fas fa-file-alt text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 12, 2019</div>
                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-success">
                      <i class="fas fa-donate text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 7, 2019</div>
                    $290.29 has been deposited into your account!
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="mr-3">
                    <div class="icon-circle bg-warning">
                      <i class="fas fa-exclamation-triangle text-white"></i>
                    </div>
                  </div>
                  <div>
                    <div class="small text-gray-500">December 2, 2019</div>
                    Spending Alert: We've noticed unusually high spending for your account.
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
              </div>
            </li>

            <!-- Nav Item - Messages -->
            <li class="nav-item dropdown no-arrow mx-1">
              <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-envelope fa-fw"></i>
                <!-- Counter - Messages -->
                <span class="badge badge-danger badge-counter">7</span>
              </a>
              <!-- Dropdown - Messages -->
              <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                <h6 class="dropdown-header">
                  Message Center
                </h6>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/fn_BT9fwg_E/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div class="font-weight-bold">
                    <div class="text-truncate">Hi there! I am wondering if you can help me with a problem I've been having.</div>
                    <div class="small text-gray-500">Emily Fowler · 58m</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/AU4VPcFN4LE/60x60" alt="">
                    <div class="status-indicator"></div>
                  </div>
                  <div>
                    <div class="text-truncate">I have the photos that you ordered last month, how would you like them sent to you?</div>
                    <div class="small text-gray-500">Jae Chun · 1d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/CS2uCrpNzJY/60x60" alt="">
                    <div class="status-indicator bg-warning"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Last month's report looks great, I am very happy with the progress so far, keep up the good work!</div>
                    <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                  </div>
                </a>
                <a class="dropdown-item d-flex align-items-center" href="#">
                  <div class="dropdown-list-image mr-3">
                    <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60" alt="">
                    <div class="status-indicator bg-success"></div>
                  </div>
                  <div>
                    <div class="text-truncate">Am I a good boy? The reason I ask is because someone told me that people say this to all dogs, even if they aren't good...</div>
                    <div class="small text-gray-500">Chicken the Dog · 2w</div>
                  </div>
                </a>
                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
              </div>
            </li>

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                <img class="img-profile rounded-circle" src="img/icons/admin.jpg">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                  Settings
                </a>
                <a class="dropdown-item" href="#">
                  <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                  Activity Log
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

        
        
        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add Product</h1>
            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="background-color: #151e3b; border-color: #151e3b;" data-toggle="modal" data-target="#category"><i class="fas fa-download fa-sm text-white-50"></i> Add new Brand</button>
            <?php
              $add = isset($_POST['add']) ? $_POST['add'] : '';
              if($add == 'Add'){
                  $brand = $_POST['brand'];
                  $cat_id = $_GET['category'];
                  $catname = $_GET['catname'];
                  $Q = mysqli_query($conn, "select * from brand where Brand = '$brand' and Category_Id = '$cat_id'") or die(mysqli_error($conn));

                  if(mysqli_num_rows($Q) >= 1){
                    $msg = '<script>alert("Brand Already Exist!")</script>';
                  }else{
                    mysqli_query($conn, "insert into brand(Brand,Category_Id) values('$brand','$cat_id')") or die(mysqli_error($conn));
                  
                  $msg = '<script>alert("Successfully added new brand!");</script>';

                  }
              }
            ?>
            <!-- modal -->
            <div id="category" class="modal fade">  
              <div class="modal-dialog modal-md">  
                   <div class="modal-content">  
                        <div class="modal-header">    
                             <h4 class="modal-title">Add New Brand</h4>  
                             <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>  
                        <form method="post">
                          <div class="modal-body" id="category_detail">  
                            <label class="mr-5" style="font-size:20px;">Brand Name:</label>
                            <input width="10px" type="text" class="form-control" id="name" name="brand" placeholder="Name">

                          </div>  
                          <div class="modal-footer">
                               <input type="submit" class="btn btn-success" name="add" id="add" value="Add">
                               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                          </div>  
                        </form>
                   </div>  
              </div>  
          </div>
             
          </div>
          <?php echo $msg;?>
          <form action="#" method="post">
          <div class="card-body bg-white m-2 p-5 shadow row" style="background-color: white">
           
            <div class="col-9">
              <div class="form-row">
                <div class="form-group">
                  <label for="">Product Name</label>
                  <input size="50" type="text" class="form-control" id="inputName" name="inputName" placeholder="Name" required>
                </div>
                <div class="form-group ml-3">
                  <label for="">Price</label>
                  <input size="20" type="text" class="form-control" id="inputprice" name="inputprice" placeholder="Peso" required>
                </div>
                 
              </div>
              <div class="form-row">
                <div class="form-group" hidden>
                  <label for="">Product Category</label>  
                 <select class="form-control"  name="inputcategory">
                  <option value="<?=$cat_id;?>"><?=$catname?></option>
                </select>
                </div>
                <div class="form-group" >
                  <label for="">Brand</label>
                  <select class="form-control" style="width: 150px" name="inputbrand">
                    <?php
                      $cat_id = $_GET['category'];
                      $catname = $_GET['catname'];
                    $sql = 'select * from brand where Category_Id ='.$cat_id.'';
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()){
                    
                  ?>
                     <option value="<?=$row['brand_Id'];?>"><?=$row['Brand'];?></option>

                  <?php }?>
                  </select>
                </div>
                <div class="form-group ml-3">
                    <label for="">Stock</label>
                    <input size="9" type="text" class="form-control" id="" name="inputstock" placeholder="" required>
                </div>
              </div>
              <div class="form-row ">
                <div class="form-group">
                  <label for="">Description</label>
                  <textarea style="width:670px;"type="text" class="form-control" id="inputdescription" name="inputdescription" placeholder="Description" required rows="7"></textarea>
                </div>
                
              </div>
                <div class="form-row ">
                 <div class="form-group" style="float:right;">
                  <a href="add_product.php?category=<?php echo $cat_id ?>&catname=<?php echo $catname?>"><input type="submit" class="btn btn-primary" placeholder="Add" value="Add" name="save"  style="font-size: 20px; font-family: 'Poppins', sans-serif;"></a>
                 </div>
                </div>
              </div>
              <div class="col">
              <div class="form-group ml-3 text-center" style="margin-top: 28px">
                  <img id="blah" src="img/icons/images.png" class="pt-5 mb-3" width="200" alt="your image" />
                  <label for="set" class="btn btn-outline-primary set p-2" style="font-size: 12px; padding-left: 3px; cursor: pointer;"><i class="fas fa-cloud-upload-alt pr-1"></i>Add Product Picture</label>
                   <input type='file' id="set" class="form-control" id="inputimage" name="inputimage" accept="/image" style="display:none;" onchange="readURL(this);" />
                 </div>


              </div>  
              </div>
              </form>
            </div>
              
               

         </div>
      </div>
    </div>
  </div>
  <script type="text/javascript">

  </script>
  <!-- Bootstrap core JavaScript-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/3.3.1/js/swiper.jquery.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/chart-area-demo.js"></script>
  <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>
