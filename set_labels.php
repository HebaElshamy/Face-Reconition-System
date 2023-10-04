<?php 
include 'Includes/dbcon.php';
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: content-type");



$data = file_get_contents("php://input");
$array = json_decode($data);
$techerId =$_SESSION['userId'];
foreach ($array as $value) 
{
    $dateCreated = date("Y-m-d");
    $sql = "SELECT IDno FROM tblattendance WHERE dateTimeTaken = '$dateCreated'AND IDno = '$value' ";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) 
    {
        $sql = "SELECT classId FROM tblstudents WHERE IDno = '$value'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) 
        {
            $row = $result->fetch_assoc();
            $classId = $row["classId"];
            
            $query=mysqli_query($conn,"insert into  tblattendance(IDno,classId,status,dateTimeTaken) 
            value('$value','$classId','0','$dateCreated')");
            
        }
    } 
}
print_r($_SESSION['userId']);
$response = "تم استقبال المصفوفة بنجاح";
echo $response;

