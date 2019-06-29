
<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "buffer");
if(!$conn){
  echo "unable to connect to the database";
}
//this function is used to protect the incoming HttpQueryString
function make_safe($variable)
{
  global $conn;
   $variable = strip_tags(mysqli_real_escape_string($conn, trim($variable)));
   return $variable;
}
$message = '';
// this is for the authentiation
if(isset($_POST['submit'])){
  if(empty($_POST['username']) || empty($_POST['password'])){
    $message =  "<div class='alert alert-danger'>please properly fill the input fields</div>";
  }else{
    $sql = sprintf("SELECT * FROM `users` WHERE `username` = '%s' AND `password` = '%s'",
                  make_safe($_POST['username']), make_safe(md5($_POST['password'])));
    $sqlRs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $fetch = mysqli_fetch_assoc($sqlRs);
    $countSql = mysqli_num_rows($sqlRs);

    if($countSql > 0){
      $_SESSION['username'] = $fetch['username'];
      $message =  "<div class='alert alert-success'>You are an authenticated User</div>";
      header("location:post_news.php");
    }else{
      $message =  "<div class='alert alert-danger'>You are not authenticated User</div>";
    }
  }
}

?>
 <!doctype html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1">

     <title>Buffer Test</title>

     <!-- Bootstrap core CSS -->
     <link href="assets/css/bootstrap.min.css" rel="stylesheet">
     <link href="assets/style.css" rel="stylesheet">


   </head>

   <body>

     <div class="container">
       <div class="header clearfix">
         <nav>
           <ul class="nav nav-pills pull-right">
             <li role="presentation" class="active"><a href="#">Login</a></li>
           </ul>
         </nav>
         <h3 class="text-muted">AUTHENTICATION SYSTEM</h3>
       </div>

       <div class="jumbotron">
         <h2>LOGIN SYSTEM</h2>
         <?= $message;?>
         <form id="myForm" action="" method="post">
           <div class="form-group">
             <label for=""> Username</label>
             <input type="text" name="username" value="" class="form-control">
           </div>
           <div class="form-group">
             <label for="">Pasword</label>
             <input type="password" name="password" value="" class="form-control">
           </div>
           <button type="submit" name="submit" class="btn btn-primary btn-sm">Login</button>
         </form>
       </div>
       <div id="response">

       </div>



       <footer class="footer">
         <p>&copy; <?php echo Date('Y');?> Company, Inc.</p>
       </footer>

     </div> <!-- /container -->

 <script type="text/javascript" src="main.js">

 </script>
   </body>
 </html>
