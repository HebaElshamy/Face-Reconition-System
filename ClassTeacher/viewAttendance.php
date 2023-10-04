
<?php 
// error_reporting(0);
include '../Includes/dbcon.php';
include '../Includes/session.php';



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/attnlg.jpg" rel="icon">
  <title>Dashboard</title>
  <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
      <?php include "Includes/sidebar.php";?>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
       <?php include "Includes/topbar.php";?>
        <!-- Topbar -->

        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">View Class Attendance</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">View Class Attendance</li>
            </ol>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <!-- Form Basic -->


              <!-- Input Group -->
                 <div class="row">
              <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Class Attendance</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                    <thead class="thead-light">
                      <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Area</th>
                        <th>IDno</th>
                        <th>Date</th>
                      </tr>
                    </thead>
                   
                    <tbody>

                  <?php


                      $query = "SELECT tblattendance.Id,tblattendance.dateTimeTaken,tblclass.className,
                      tblstudents.firstName,tblstudents.lastName,tblstudents.IDno
                      FROM tblattendance
                      INNER JOIN tblclass ON tblclass.Id = tblattendance.classId
                      INNER JOIN tblstudents ON tblstudents.IDno = tblattendance.IDno
                      where tblattendance.classId = '$_SESSION[classId]'AND tblattendance.status ='1' ";
                      $rs = $conn->query($query);
                      $num = $rs->num_rows;
                      $sn=0;
                      $status="";
                      if($num > 0)
                      { 
                        while ($rows = $rs->fetch_assoc())
                          {
                             $sn = $sn + 1;
                            echo"
                              <tr>
                                <td>".$sn."</td>
                                 <td>".$rows['firstName']."</td>
                                <td>".$rows['lastName']."</td>
                                <td>".$rows['IDno']."</td>
                                <td>".$rows['className']."</td>
                                <td>".$rows['dateTimeTaken']."</td>
                              </tr>";
                          }
                      }
                      else
                      {
                           echo   
                           "<div class='alert alert-danger' role='alert'>
                            No Record Found!
                            </div>";
                      }
                    
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            </div>
          </div>
     

        </div>
        <!---Container Fluid-->
      </div>
      <!-- Footer -->
       <?php include "Includes/footer.php";?>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
   <!-- Page level plugins -->
  <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
    </script>
    <script>
document.querySelector('a').addEventListener('click', function(e) {
    e.preventDefault(); // منع سلوك الرابط الافتراضي
    window.location.href = 'file:///C:/laragon/www/final_face_reconition_system/locationtophp.html';
});
</script>
  
</body>

</html>