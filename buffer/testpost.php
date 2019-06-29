<?php
$ch = curl_init();

   curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/news");
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');


   $headers = array();
   $headers[] = 'Accept:Application/JSON';
$post = array(
  "id" => NULL,
  "news" => $_POST['news'],
);
$posts = json_encode($post);
   curl_setopt($ch, CURLOPT_HTTPHEADER, "Content_Type:application/json");
   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
   curl_setopt($ch, CURLOPT_POST, 1);
   curl_setopt($ch, CURLOPT_POSTFIELDS, $posts);
   $result = curl_exec($ch);
   if (curl_errno($ch)) {
       echo 'Error:' . curl_error($ch);
   }
   curl_close($ch);
?>
