<?php
  session_start();
  include_once('dbconnect.php');
  
  $msg = ''; $displayResult = ''; 
  if(isset($_GET['category'])){ 
    $cat_id = $_GET['category'];
    $catname = $_GET['catname'];

  $all_records = mysqli_query($conn, "select * from product inner join brand on product.brand_Id = brand.brand_Id inner join category on product.Category_Id = category.Category_Id where product.Category_Id = $cat_id") or die(mysqli_error($conn));
  
  if(mysqli_num_rows($all_records) >= 1){
    $displayResult .= '<div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0" style="`width: 100%;">
          <thead>
            <tr  class="m-0 font-weight-bold text-dark">
              <th style="border:none;"></th>
              <th style="border:none;" scope="col">ID</th>
              <th style="border:none;">Image</th>
              <th style="border:none;">Product Name</th>
              <th style="border:none;">Price</th>
              <th style="border:none;">Brand</th>
              <th style="border:none;">Stock</th>
              <th style="border:none;">Edit</th>
              <th style="border:none;">Delete</th>
            </tr>
           </thead>
           <tbody>';
    while($rowUsers = mysqli_fetch_array($all_records, MYSQLI_ASSOC)){
      $product_id = $rowUsers['ID'];
      $name = $rowUsers['Name'];
      $price = $rowUsers['Price'];
      $price1 = number_format($price);
      $brand = $rowUsers['Brand'];
      $stock = $rowUsers['Stock'];
      $img = $rowUsers['Img'];
      $category = $rowUsers['Category_Id'];

      
      $displayResult .= '<span class="cat" style="border:none;" hidden id="'.$catname.'">'.$category.'</span>
      <tr class="text-secondary">
              <td style="border:none;"><a class="btn btn-outline-info view" id="'.$product_id.'" href="#" style="border:none;"><i class="fas fa-eye"></i></a></td>
              <td style="border:none;" scope="row">'.$product_id.'</td>
              <td style="border:none;"><img src="img/'.$img.'" width="70px"></td>
              <td style="border:none;">'.$name.'</td>
              <td style="border:none;">'.$price1.'</td>
              <td style="border:none;">'.$brand.'</td>
              <td style="border:none;">'.$stock.'</td>
              <td style="border:none;"><a class="btn btn-outline-success edit" id="'.$product_id.'" href="#"><i class="fas fa-pencil-alt"></i></a></td>
              <td style="border:none;"><a class="btn btn-danger mx-3" href="delete_product.php?pid='.$product_id.'&cat='.$category.'&catname='.$catname.'" onclick="return confirm(\'Are you sure you want to delete record?\')"><i class="fas fa-trash-alt"></i></a></td>
            </tr>';
    }
    $displayResult .= '</tbody>
              </table>
              </div>';
           
  }else{
    $msg = '<div class="alert alert-info text-center" role="alert">
            Record is empty!
          </div>';
  }
  
   $bsave = isset($_POST['save']) ? $_POST['save'] : '';
  if($bsave == 'Update'){
      $name = $_POST['name'];
      $price = $_POST['price'];
      $brand = $_POST['brand'];
      $stock = $_POST['stock'];
      $product_cat = $_POST['product_cat'];
      $description = $_POST['description'];
      $img = $_POST['img'];
      
      if(isset($img)){
      mysqli_query($conn, "update product set Name='$name', Price='$price', brand_Id='$brand', stock='$stock', Category_Id='$product_cat', Description='$description' where ID = '$_POST[product_id]'") or die(mysqli_error($conn));
      }else{
      mysqli_query($conn, "update product set Name='$name', Price='$price', brand_Id='$brand', stock='$stock', Category_Id='$category', Description='$description', Img='$img' where ID = '$_POST[product_id]'") or die(mysqli_error($conn));
    }


  }
  $bsave = isset($_POST['del']) ? $_POST['del'] : '';
  if($bsave == 'Delete'){
      $id = $_POST['cat1'];

         mysqli_query($conn, "delete from category where Category_Id = $id") or die(mysqli_error($conn));
        
        $msg = '<script>alert("Successfully Deleted")</script>';
          


  }
  $bsave = isset($_POST['up']) ? $_POST['up'] : '';
  if($bsave == 'Update'){
      $id = $_POST['cat2'];
      $name = $_POST['category_name3'];


         mysqli_query($conn, "update category set Category_Name = '$name' where Category_Id = $id") or die(mysqli_error($conn));
        
        $msg = '<script>alert("Successfully Updated")</script>';
          


  }
  }

              $addbrand = isset($_POST['addbrand1']) ? $_POST['addbrand1'] : '';
              if($addbrand == 'Add'){
                  $brand = $_POST['brand'];
                  $cat_id = $_GET['category'];
                  $catname = $_GET['catname'];
                  $Q = mysqli_query($conn, "select * from brand where Brand = '$brand' and Category_Id = '$cat_id'") or die(mysqli_error($conn));

                  if(mysqli_num_rows($Q) >= 1){
                    $msg = '<script>alert("Brand is Already Existed!");</script>';
                  }else{
                  mysqli_query($conn, "insert into brand(Brand,Category_Id) values('$brand','$cat_id')") or die(mysqli_error($conn));
                  
                  $msg = '<script>alert("Successfully added new Brand!");</script>';

                  }
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.css" rel="stylesheet" type="text/css">
  <script href="vendor/fontawesome-free/js/all.js" type="text/javascript"></script>
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">

  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
<script type="text/javascript">
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img').attr('src', e.target.result);
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
        <div class="sidebar-brand-text mx-3">Biologic</div>
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
              <a class="collapse-item text-secondary" href="delivered.php">Delivered</a>
          </div>
        </div>
      </li>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="sales.php">
          <i class="fas fa-fw fa-dollar-sign"></i>
          <span>Sales</span></a>
      </li>
      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-shopping-basket"></i>
          <span>Product</span>
        </a>
        <div style="background-color: #151e3b; border-radius: 5px;" id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="py-2 collapse-inner">
            <?php
                  $sql = 'select * from category';
                  $result = $conn->query($sql);
                  while($row = $result->fetch_assoc()){
                  
                ?>
                  <a class="collapse-item text-secondary" href="Product.php?category=<?php echo $row['Category_Id']; ?>&catname=<?php echo $row['Category_Name']?>"><?=$row['Category_Name'];?></a>
                <?php }?>
                 <button class="collapse-item text-secondary mb-2" style=" border: none;" data-toggle="modal" data-target="#category"><i class="fas fa-plus-circle"></i> Add new category</button>
                 <button class="collapse-item text-secondary mb-2" style=" border: none; width: 160px" data-toggle="modal" data-target="#categoryd"><i class="fas fa-trash-alt"></i> Delete category</button>
                 <button class="collapse-item text-secondary" style=" border: none; width: 160px" data-toggle="modal" data-target="#categorye"><i class="fas fa-pencil-alt"></i> Edit category</button>
          </div>
          
        </div>
      </li>
      <!-- add new category modal -->
      <?php
        $add = isset($_POST['add']) ? $_POST['add'] : '';
        if($add == 'Add'){
            $cat_name = $_POST['category_name'];

            $Q = mysqli_query($conn, "select Category_Name from category where Category_Name='$cat_name'") or die(mysqli_error($conn));

            if(mysqli_num_rows($Q) >= 1){
              $msg = '<script>alert("Category is Already Existed!");</script>';
            }else{
            mysqli_query($conn, "insert into category(Category_Name) values('$cat_name')") or die(mysqli_error($conn));
            
            $msg = '<script>alert("Successfully added new category!");</script>';

            }
        }
      ?>
      <div id="category" class="modal fade">  
          <div class="modal-dialog modal-md">  
               <div class="modal-content">  
                    <div class="modal-header">    
                         <h4 class="modal-title">Add New Category</h4>  
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>  
                    <form method="post">
                      <div class="modal-body" id="category_detail">  
                        <label class="mr-5" style="font-size:20px;">Category Name:</label>
                        <input width="10px" type="text" class="form-control" id="category_name" name="category_name" placeholder="Name">

                      </div>  
                      <div class="modal-footer">
                           <input type="submit" class="btn btn-success" name="add" id="add" value="Add">
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                      </div>  
                    </form>
               </div>  
          </div>  
      </div>
      <div id="categoryd" class="modal fade">  
          <div class="modal-dialog modal-md">  
               <div class="modal-content">  
                    <div class="modal-header">    
                         <h4 class="modal-title">Delete Category</h4>  
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>  
                    <form method="post">
                      <div class="modal-body" id="category_detail">  
                        <label class="mr-5" style="font-size:20px;">Category Name:</label>
                         <select class="form-control" name="cat1">
                          <?php
                            $sql = 'select * from category';
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()){
                            
                          ?>
                          <option value="<?=$row['Category_Id']?>"><?=$row['Category_Name']?></option>
                          <?php }?>
                        </select>
                      </div>  
                      <div class="modal-footer">
                           <input type="submit" class="btn btn-success" name="del" id="del" value="Delete">
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                      </div>  
                    </form>
               </div>  
          </div>  
      </div>
      <div id="categorye" class="modal fade">  
          <div class="modal-dialog modal-md">  
               <div class="modal-content">  
                    <div class="modal-header">    
                         <h4 class="modal-title">Edit Category</h4>  
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>  
                    <form method="post">
                      <div class="modal-body" id="category_detail"> 
                      <label class="mr-5" style="font-size:20px;">Category Name:</label> 
                        <select class="form-control" name="cat2">
                          <?php
                            $sql = 'select * from category';
                            $result = $conn->query($sql);
                            while($row = $result->fetch_assoc()){
                            
                          ?>
                          <option value="<?=$row['Category_Id']?>"><?=$row['Category_Name']?></option>
                          <?php }?>
                        </select>
                        <label class="mr-5" style="font-size:20px;">Change:</label>
                        <input width="10px" type="text" class="form-control" id="category_name3" name="category_name3" placeholder="Name">

                      </div>  
                      <div class="modal-footer">
                           <input type="submit" class="btn btn-success" name="up" id="update" value="Update">
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                      </div>  
                    </form>
               </div>  
          </div>  
      </div>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item ">
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
                <a class="dropdown-item" href="C:/wamp64/www/onlineshop/login.php" data-toggle="modal" data-target="#logoutModal">
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
            <h1 class="h3 mb-0 text-gray-800">List of <?php echo $catname?></h1>
            <a href="add_product.php?category=<?php echo $cat_id ?>&catname=<?php echo $catname?>" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="background-color: #151e3b; border-color: #151e3b;"><i class="fas fa-download fa-sm text-white-50"></i> Add Product</a>
          </div>
            <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <?php echo $msg; ?>
                  <form method="post">
                    <?php echo $displayResult; ?>
                      <div id="product" class="modal fade">  
                        <div class="modal-dialog modal-lg">  
                             <div class="modal-content">  
                                  <div class="modal-header">    
                                       <h4 class="modal-title">Product Details</h4>  
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>  
                                  <div class="modal-body" id="product_detail">  
                                    
                                  </div>  
                                  <div class="modal-footer">
                                       <input type="submit" class="btn btn-success save" name="save" id="save" value="Update">
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                                  </div>  
                             </div>  
                        </div>  
                    </div>
                    <div id="brand" class="modal fade">  
                        <div class="modal-dialog modal-md">  
                             <div class="modal-content">  
                                  <div class="modal-header">    
                                       <h4 class="modal-title">Edit Brand</h4>  
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>  
                                  <div class="modal-body" id="ebrand">  
                                    
                                  </div>  
                                  <div class="modal-footer">
                                       <input type="submit" class="btn btn-success save" name="brsave" id="brsave" value="Update">
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                                  </div>  
                             </div>  
                        </div>  
                    </div>
                    <div id="product1" class="modal fade">  
                        <div class="modal-dialog modal-lg">  
                             <div class="modal-content">  
                                  <div class="modal-header">    
                                       <h4 class="modal-title">Product Details</h4>  
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>  
                                  <div class="modal-body" id="product_detail">  
                                    <div class="row">
                                      <div class="col-6 ml-5 mt-5">
                                        <form runat="server">
                                          <a class="text-dark" href="#" role="button">
                                            <img id="img" src="" width="240px" height="240px" class="mb-3" width="200"/>
                                            <div class="row" style="padding-left: 87px">
                                              <label for="set" id="select" class="btn btn-outline-secondary mt-4" style="letter-spacing: 0.5px; font-size: 12px; cursor: pointer; margin-left: 15px;">Select Photo</label>
                                              <input type="file" id="set" class="form-control" name="img" accept="/image" style="display:none;" onchange="readURL(this);">
                                          </div>                        
                                          </a>
                                        </form>
                                      </div>
                                      <div class="col" style="font-size:20px; margin-top:30px;">
                                        <label class="mr-5" style="font-size:20px;">Name:</label>
                                        <span class="ml-1" style="font-weight:bold; font-size:25px;"><input size="10" type="text" class="form-control" id="name" name="name" placeholder="Name"></span>
                                        <label class="mr-4">Price:</label>
                                        <span class="ml-5"><input size="10" type="text" class="form-control" id="price" name="price" placeholder="Peso"></span>
                                        <span class="ml-3">
                                          <div class="form-group" >
                                            <label class="mr-3" for="">Brand: </label><input size="10" type="text" style="border:none;" class="text-secondary" readonly id="brand1">
                                            <select class="form-control" style="width: 150px" id="" name="brand">
                                              <?php
                                                $cat_id = $_GET['category'];
                                                $catname = $_GET['catname'];
                                              $sql = 'select * from brand where Category_Id = '.$cat_id.'';
                                              $result = $conn->query($sql);
                                              while($row = $result->fetch_assoc()){
                                              
                                            ?>
                                               <option value="<?=$row['brand_Id'];?>"><?=$row['Brand'];?></option>
                                            <?php }?>
                                            </select>
                                          </div>
                                        </span>
                                        <label class="mr-5">Stock:</label>
                                        <span class="ml-3"><input size="10" type="text" class="form-control" id="stock" name="stock" placeholder=""></span>
                                        <label class="mr-3">Category:</label><input size="10" type="text" style="border:none;" class="text-secondary" readonly id="product_cat">
                                        <span class="ml-2">
                                          <select class="form-control" id="" name="product_cat">
                                            <?php
                                                $cat_id = $_GET['category'];
                                                $catname = $_GET['catname'];
                                              $sql = 'select * from category';
                                              $result = $conn->query($sql);
                                              while($row = $result->fetch_assoc()){
                                              
                                            ?>
                                            <option value="<?=$row['Category_Id'];?>"><?=$row['Category_Name'];?></option>
                                            <?php }?>

                                          </select>
                                        </span>
                                      </div>
                                      </div>
                                      <center><input type="button" id="btndes2" class="btn btn-info mb-2 rounded-circle" value="&plus;"><input type="button" id="btndes3" class="btn btn-info mb-2 rounded-circle" value="&minus;"></center>
                                      <div class="mx-5" id="des1">
                                        <center><h5>Description</h5></center>
                                        <div class="pt-2 pl-3">
                                          <textarea style="width:670px;"type="text" class="form-control" id="description" name="description" placeholder="Description" rows="7"></textarea>
                                          <input type="hidden" name="product_id" id="product_id">
                                        </div>
                                      </div>
                                  </div>  
                                  <div class="modal-footer">
                                       <input type="submit" class="btn btn-success save" name="save" id="save" value="Update">
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                                  </div>  
                             </div>  
                        </div>  
                    </div>  
                  </form>
              </div>
            </div>
            </div>
            <button class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="background-color: #151e3b; border-color: #151e3b; height: 50px" data-toggle="modal" data-target="#addbrand"><i class="fas fa-download fa-sm text-white-50"></i> Add new Brand</button>

          </div>

          <div id="addbrand" class="modal fade">  
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
                               <input type="submit" class="btn btn-success" name="addbrand1" id="add" value="Add">
                               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                          </div>  
                        </form>
                   </div>  
              </div>  
          </div>
          <div class="text-center mb-3"><h3>Edit Brand</h3></div>
          <div class="row">
          <?php 
              $result = mysqli_query($conn, "SELECT * from brand where Category_Id = ".$_GET['category']."") or die(mysqli_error($conn));
              while($row = mysqli_fetch_array($result)){
            ?>
            <div class="col-lg-2 mb-4" id="showbrand">
                  <div class="card bg-info text-white shadow">
                    <div class="card-body">
                      <div class="text-right"><a class="sbrand" id="<?=$row['brand_Id']?>"><i class="fas fa-pencil-alt"></i></a></div>
                      <input type="hidden" name="cat1" value="<?=$_GET['category']?>">
                      <div class="text-xl font-weight-bold text-uppercase mb-1" style="margin-top: -23px"><?=$row['Brand']?></div>
                    </div>
                  </div>
                </div>
              <?php }?>
            </div>
            <div class="text-center mb-3"><h3>Delete Brand</h3></div>
          <div class="row">
          <?php 
          $catname = $_GET['catname'];
          $category = $_GET['category'];
              $result = mysqli_query($conn, "SELECT * from brand where Category_Id = ".$_GET['category']."") or die(mysqli_error($conn));
              while($row = mysqli_fetch_array($result)){
            ?>
            <div class="col-lg-2 mb-4" id="showbrand">
                  <div class="card bg-danger text-white shadow">
                    <div class="card-body">
                     <?php echo ' <div class="text-right"><a class="text-white" href="delete_product.php?brand_Id='.$row['brand_Id'].'&category='.$category.'&catname='.$catname.'" onclick="return confirm(\'Are you sure you want to delete record?\');"><i class="fas fa-trash-alt"></i></a></div>';?>
                      <input type="hidden" name="cat1" value="<?=$_GET['category']?>">
                      <div class="text-xl font-weight-bold text-uppercase mb-1" style="margin-top: -23px"><?=$row['Brand']?></div>
                    </div>
                  </div>
                </div>
              <?php }?>
            </div>
         </div>
      </div>
    </div>
  </div>

         
  <script>  
 $(document).ready(function(){  
      $('.view').click(function(){  
           $('.save').hide();
           var product_id = $(this).attr("id");
           var catname = $('.cat').attr("id");
           $.ajax({  
                url:"view.php",  
                method:"post",  
                data:{product_id:product_id,catname:catname},  
                success:function(data){  
                     $('#product_detail').html(data);  
                     $('#product').modal("show");  
                }  
           });  
      });  
 });
 $(document).ready(function(){  
      $('.sbrand').click(function(){  
           var brand_id = $(this).attr("id");
           var catid = $('.cat1').val();
           $.ajax({  
                url:"view.php",  
                method:"post",  
                data:{brand_id:brand_id,catid:catid},  
                success:function(data){  
                     $('#ebrand').html(data); 
                     $('#brand').modal("show");  
                }  
           });  
      });  
 });
  $(document).on('click', '.edit', function(){  
          $('.save').show();
           var product_id = $(this).attr("id");  
           var catname = $('.cat').attr("id");
           $.ajax({  
                url:"Edit.php",  
                method:"POST",  
                data:{product_id:product_id,catname:catname},  
                dataType:"json",  
                success:function(data){  
                     $('#product_id').val(data.ID);  
                     $('#price').val(data.Price);  
                     $('#name').val(data.Name);  
                     $('#brand1').val(data.Brand);
                     $('#stock').val(data.Stock);
                     $('#product_cat').val(data.Category_Name);  
                     $('#description').val(data.Description);  
                     $('#img').attr("src","img/" + data.Img);
                     $('#set').attr("value","img/" + data.Img);
                     $('#save').val("Update");  
                     $('#product1').modal("show");  
                }  
           });  
      });

  $('#des1').hide();
  $('#btndes3').hide();
   $(document).ready(function(){  
      $('#btndes2').click(function(){
        $('#des1').show("slow", "linear");
        $('#btndes3').show();
        $('#btndes2').hide();
      });  
      $('#btndes3').click(function(){
        $('#des1').hide("slow", "linear");
        $('#btndes3').hide();
        $('#btndes2').show();
      });  
 }); 
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

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
