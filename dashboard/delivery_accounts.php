<?php
  session_start();
  include_once('dbconnect.php');
  
  $msg = ''; $displayResult = ''; 
    $all_records = mysqli_query($conn, "select * from delivery_service") or die(mysqli_error($conn));
  if(mysqli_num_rows($all_records) >= 1){
    $ctr = 1;
    $displayResult .= '<div class="table-responsive">
          <table class="table" id="dataTable" width="100%" cellspacing="0" style="width: 100%;">
          <thead>
            <tr  class="m-0 font-weight-bold text-dark">
              <th style="border:none;"></th>
              <th style="border:none;">ID</th>
              <th style="border:none;">Image</th>
              <th style="border:none;">Name</th>
              <th style="border:none;">Email</th>
              <th style="border:none;">Edit</th>
              <th style="border:none;">Delete</th>
            </tr>
           </thead>
           <tbody>';
    while($rowUsers = mysqli_fetch_array($all_records, MYSQLI_ASSOC)){
      $user_id = $rowUsers['delivery_Id'];
      $name = $rowUsers['Name'];
      $email = $rowUsers['Email'];
      $address = $rowUsers['Address'];
      $pnum = $rowUsers['Phone'];
      $username = $rowUsers['Username'];
      $password = $rowUsers['Password'];
      $img = $rowUsers['Profile_img'];
      
      $displayResult .= '<tr class="text-secondary">
              <td style="border:none;"><a class="btn btn-outline-info view" id="'.$user_id.'" data-toggle="modal" data-target="#user" href="#" style="border:none;"><i class="fas fa-eye"></i></a></td>
              <th style="border:none;" scope="row">'.$user_id.'</th>
              <td style="border:none;"><img src="img/'.$img.'" width="70px" height="70px" class="img-profile rounded-circle"></td>
              <td style="border:none;">'.$name.'</td>
              <td style="border:none;">'.$email.'</td>
              <td style="border:none;"><a class="btn btn-outline-success edit" id="'.$user_id.'" href="#"><i class="fas fa-pencil-alt"></i></a></td>
              <td style="border:none;"><a class="btn btn-danger" href="delete_users.php?did='.$user_id.'" onclick="return confirm(\'Are you sure you want to delete record?\')"><i class="fas fa-trash-alt"></i></a></td> 
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
      $name = $_POST['ename'];
      $email = $_POST['eemail'];
      $address = $_POST['eaddress'];
      $phone = $_POST['epnum'];
      $username = $_POST['eusername'];
      $password = $_POST['epassword'];
      
      mysqli_query($conn, "update delivery_service set Name='$name', Email='$email', Address='$address', Phone='$phone', Username='$username', Password='$password' where delivery_Id = '$_POST[user_id]'") or die(mysqli_error($conn));


  }

  $save = isset($_POST['add']) ? $_POST['add'] : '';
  if($save == 'Add'){
      $name = $_POST['name'];
      $email = $_POST['email'];
      $address = $_POST['address'];
      $phone = $_POST['phone'];
      $img = $_POST['inputimage'];
      $username = $_POST['user'];
      $password = $_POST['password'];

      mysqli_query($conn, "insert into delivery_service (Name,Address,Phone,Email,Username,Password,Profile_img) values('$name','$address','$phone','$email','$username','$password','$img')") or die(mysqli_error($conn));
      
      $msg = '<script>
            alert("Successfully added new Delivery Service!")
          </script>';
      header("Location: delivery_accounts.php");
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
        <div class="sidebar-brand-text mx-3">BIOLOGIC</div>
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
      <li class="nav-item">
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

      <li class="nav-item active">
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
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
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

          <div id="category" class="modal fade">  
          <div class="modal-dialog modal-lg">  
               <div class="modal-content">  
                    <div class="modal-header">    
                         <h4 class="modal-title">Add New Delivery Service</h4>  
                         <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>  
                    <form method="post">
                      <div class="modal-body" id="category_detail">  
                        <div class="row">
                          <div class="col">
                            <label class="mr-5" style="font-size:20px;">Name:</label>
                            <input width="10px" type="text" class="form-control" id="name" name="name" placeholder="Name">
                            <label class="mr-5" style="font-size:20px;">Address:</label>
                            <input width="10px" type="text" class="form-control" id="address" name="address" placeholder="Address">
                            <label class="mr-5" style="font-size:20px;">Phone Number:</label>
                            <input width="10px" type="text" class="form-control" id="phone" name="phone" placeholder="Phone Number">
                            <label class="mr-5" style="font-size:20px;">Email:</label>
                            <input width="10px" type="text" class="form-control" id="email" name="email" placeholder="Email">
                            <label class="mr-5" style="font-size:20px;">Username:</label>
                            <input width="10px" type="text" class="form-control" id="user" name="user" placeholder="Username">
                            <label class="mr-5" style="font-size:20px;">Password:</label>
                            <input width="10px" type="text" class="form-control" id="password" name="password" placeholder="Password">
                          </div>
                          <div class="col">
                             <div class="form-group ml-3 text-center" style="margin-top: 28px">
                              <img id="blah" src="img/icons/admin.jpg" class="pt-5 mb-3 rounded" width="200" height="250" alt="your image" /><br/>
                              <label for="set" class="btn btn-outline-primary set p-2" style="font-size: 12px; padding-left: 3px; cursor: pointer;"><i class="fas fa-cloud-upload-alt pr-1"></i>Add Profile Picture</label>
                               <input type='file' id="set" class="form-control" id="inputimage" name="inputimage" accept="/image" style="display:none;" onchange="readURL(this);" />
                             </div>
                          </div>
                        </div>
                      </div>  
                      <div class="modal-footer">
                           <input type="submit" class="btn btn-success" style="width: 100px" name="add" id="add" value="Add">
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                      </div>  
                    </form>
               </div>  
          </div>  
      </div>

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Delivery Accounts</h1>
            <a href="" data-toggle="modal" data-target="#category" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" style="background-color: #151e3b; border-color: #151e3b;"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Add New Service</a>
          </div>
            <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
                  <?php echo $msg; ?>
                  <form action="delivery_accounts.php" method="post">
                    <?php echo $displayResult; ?>
                    <div id="usermodal" class="modal fade">  
                        <div class="modal-dialog">  
                             <div class="modal-content">  
                                  <div class="modal-header">    
                                       <h4 class="modal-title">User Details</h4>  
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>  
                                  <div class="modal-body" id="user_detail">  
                                    
                                  </div>  
                                  <div class="modal-footer">
                                       <input type="submit" class="btn btn-success save" name="save" id="save" value="Update">
                                       <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                                  </div>  
                             </div>  
                        </div>  
                    </div> 
                    <div id="user1" class="modal fade">  
                        <div class="modal-dialog">  
                             <div class="modal-content">
                                  <div class="modal-header">    
                                       <h4 class="modal-title">Account Details</h4>  
                                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>  
                                  <div class="modal-body" id="user_detail1">  
                                    <div class="table-responsive">  
                                      <table class="table">
                                        <tr>   
                                            <center>
                                            <img src="" width="100px" height="100px" id="img" class="img-profile rounded-circle mb-4">
                                            </center>
                                        </tr>
                                        <tr>  
                                             <td style="border:none;" width="30%"><label>Name:</label></td>  
                                             <td style="border:none;" width="50%"><input type="text" id="ename" name="ename" class="form-control" style=" font-size: 15px; background-color: white;"></td>  
                                        </tr>  
                                        <tr>  
                                             <td style="border:none;" width="30%"><label>Email:</label></td>  
                                             <td style="border:none;" width="50%"><input type="text" id="eemail" name="eemail" class="form-control" style=" font-size: 15px; background-color: white;"></td>  
                                        </tr>  
                                        <tr>  
                                             <td style="border:none;" width="30%"><label>Address:</label></td>  
                                             <td style="border:none;" width="50%"><input type="text" id="eaddress" name="eaddress" class="form-control" style=" font-size: 15px; background-color: white;"></td>  
                                        </tr>  
                                        <tr>  
                                             <td style="border:none;" width="30%"><label>Phone Number:</label></td>  
                                             <td style="border:none;" width="50%"><input type="text" id="epnum" name="epnum" class="form-control" style=" font-size: 15px; background-color: white;"></td>  
                                        </tr>  
                                        <tr>  
                                             <td style="border:none;padding-top:50px;" width="30%"><label>Username:</label></td>  
                                             <td style="border:none;padding-top:50px;" width="50%"><input type="text" id="eusername" name="eusername" class="form-control" style=" font-size: 15px; background-color: white;"></td>  
                                        </tr>
                                        <tr>  
                                             <td style="border:none;" width="30%"><label>Password:</label></td>  
                                             <td style="border:none;" width="50%"><input type="text" id="epassword" name="epassword" class="form-control" style="font-size: 15px; background-color: white;" value=""></td>  
                                        </tr>
                                        <input type="hidden" name="user_id" id="user_id">
                                        </table>

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
          </div>
         </div>
      </div>
    </div>
  </div>

  <script>  
 $(document).ready(function(){  
      $('.view').click(function(){  
           $('.save').hide();
           var del_id = $(this).attr("id");  
           $.ajax({  
                url:"view.php",  
                method:"post",  
                data:{del_id:del_id},  
                success:function(data){  
                     $('#user_detail').html(data);  
                     $('#usermodal').modal("show");  
                }  
           });  
      });  
 });
 $(document).on('click', '.edit', function(){  
          $('.save').show();
           var del_id = $(this).attr("id");  
           $.ajax({  
                url:"Edit.php",  
                method:"POST",  
                data:{del_id:del_id},  
                dataType:"json",  
                success:function(data){  
                     $('#user_id').val(data.delivery_Id);  
                     $('#ename').val(data.Name);  
                     $('#eemail').val(data.Email);  
                     $('#eaddress').val(data.Address);  
                     $('#epnum').val(data.Phone);  
                     $('#img').attr("src","img/" + data.Profile_img);
                     $('#eusername').val(data.Username); 
                     $('#epassword').val(data.Password);
                     $('#save').val("Update");  
                     $('#user1').modal("show");  
                }  
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
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>
</body>

</html>
