<?php
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT");
  header("Access-Control-Allow-Headers: content-type");
  if (isset($_POST['latitude']) && isset($_POST['longitude'])) {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
       // اسم الملف الذي تريد حفظ البيانات فيه
       $filename = "README.md";
       file_put_contents($filename, " ");
       // البيانات التي تريد حفظها
      //  $data = "Latitude: $latitude, Longitude: $longitude";
       $data1 = "#The students are here now\n";
       $data2 = "https://www.google.com/maps?q={$latitude},{$longitude}\n";
   
       file_put_contents($filename, $data1, FILE_APPEND); // FILE_APPEND يُضيف البيانات إلى الملف بدلاً من استبداله
       file_put_contents($filename, $data2, FILE_APPEND);

     
          // تنفيذ git add *
          shell_exec("git add * 2>&1");
          // تنفيذ git commit
          shell_exec("git commit -m 'commit11' 2>&1");
          // تنفيذ git push
          shell_exec("git push -u origin main 2>&1");



       // حفظ البيانات في الملف
   
       echo "تم حفظ البيانات بنجاح في ملف $filename";
   } else {
       echo "لم يتم توفير البيانات اللازمة.";
   }

  ?>