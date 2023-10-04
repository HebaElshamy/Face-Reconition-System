<?php
    // Update the path below to your autoload.php,
    // see https://getcomposer.org/doc/01-basic-usage.md
    // إعدادات للسماح بالوصول من أي مصدر والسماح بـ content-type
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
    header("Access-Control-Allow-Headers: content-type");
  
    use Twilio\Rest\Client;
    if (isset($_POST['latitude']) && isset($_POST['longitude'])) {
    include "db_conn.php";
    require_once 'vendor/autoload.php';
    
    $sid    = "AC0d5c5ffe3fc807ccf04e3c2c8f2288bd";
    $token  = "bfed1892c6e61da9c391ed06949763ab";
    $twilio = new Client($sid, $token);
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    
    // إنشاء الرابط باستخدام المتغيرات
    $link = "https://www.google.com/maps?q={$latitude},{$longitude}";
    $uplink="https://github.com/HebaElshamy/live-location";
    $body =$link." and this link updating every 10 min ".$uplink;
    $query = "SELECT tblattendance.Id,tblattendance.dateTimeTaken,tblclass.className,
                      tblstudents.firstName,tblstudents.lastName,tblstudents.IDno,tblstudents.phone1
                      FROM tblattendance
                      INNER JOIN tblclass ON tblclass.Id = tblattendance.classId
                      INNER JOIN tblstudents ON tblstudents.IDno = tblattendance.IDno
                      where tblattendance.status ='0' ";

    
    $result = mysqli_query($conn, $query);


    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
        $to_number = $row['phone1'];
        $id = $row['Id'];
        
        
        $message = $twilio->messages
                ->create($to_number,
                    array(
                        "from" => "whatsapp:+14155238886",
                    
                        "body" => $body
                    )
                );
                $query=mysqli_query($conn,"update tblattendance set status='1'
                    where Id='$id'");

            echo " Done " . $to_number . "<br>";
        }
    } else {
        echo "No students Yet";
    }
    mysqli_close($conn);
}
else{
    echo "error";
}
?>