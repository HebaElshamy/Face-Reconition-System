<?php
include 'Includes/dbcon.php';
session_start();



if(isset($_POST['login'])){

  $userType = $_POST['userType'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $password = md5($password);

  if($userType == "Administrator"){

    $query = "SELECT * FROM tbladmin WHERE emailAddress = '$username' AND password = '$password'";
    $rs = $conn->query($query);
    $num = $rs->num_rows;
    $rows = $rs->fetch_assoc();

    if($num > 0){

      $_SESSION['userId'] = $rows['Id'];
      $_SESSION['firstName'] = $rows['firstName'];
      $_SESSION['lastName'] = $rows['lastName'];
      $_SESSION['emailAddress'] = $rows['emailAddress'];

      echo "<script type = \"text/javascript\">
      window.location = (\"Admin/index.php\")
      </script>";
    }

    else{

      echo "<div class='alert alert-danger' role='alert'>
      Invalid Username/Password!
      </div>";

    }
  }
  else if($userType == "ClassTeacher"){

    $query = "SELECT * FROM tblclassteacher WHERE emailAddress = '$username' AND password = '$password'";
    $rs = $conn->query($query);
    $num = $rs->num_rows;
    $rows = $rs->fetch_assoc();

    if($num > 0){

      $_SESSION['userId'] = $rows['Id'];
      $_SESSION['firstName'] = $rows['firstName'];
     ;
      $_SESSION['emailAddress'] = $rows['emailAddress'];
      $_SESSION['classId'] = $rows['classId'];
      // var_dump($_SESSION);
      // exit();

      echo "<script type = \"text/javascript\">
      window.location = (\"ClassTeacher/index.php\")
      </script>";
    }

    else{

      echo "<div class='alert alert-danger' role='alert'>
      Invalid Username/Password!
      </div>";

    }
  }
  else{

      echo "<div class='alert alert-danger' role='alert'>
      Invalid Username/Password!
      </div>";

  }
}
?>
?>