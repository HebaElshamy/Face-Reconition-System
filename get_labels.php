<?php
include 'Includes/dbcon.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
header("Access-Control-Allow-Headers: content-type");


$sql = "SELECT IDno FROM tblstudents";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // استخراج العلامات وتخزينها في مصفوفة
    $labels = array();
    while($row = $result->fetch_assoc()) {
        $labels[] = $row["IDno"];
    }

    // إغلاق اتصال قاعدة البيانات
    $conn->close();

    // تحويل المصفوفة إلى JSON وطباعتها كاستجابة للطلب
    echo json_encode($labels);

  

} else {
    echo "لا توجد نتائج";
}
 ?>
