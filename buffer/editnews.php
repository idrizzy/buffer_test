<?php
session_start();
if(!isset($_SESSION['username'])){
  header("location:auth.php");
}
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
//this is used to fetch all news
if(isset($_GET['edit'])){
  $news = sprintf("SELECT * FROM news WHERE id = %s", $_GET['edit']);
  $newsRs = mysqli_query($conn, $news)or die(mysqli_error($conn));
  $fetchNews = mysqli_fetch_assoc($newsRs);
}

$message = '';
if(isset($_POST['submit'])){
  if(empty($_POST['news'])){
    $message =  "<div class='alert alert-danger'>please properly fill the input fields</div>";
  }else{
    echo $sql = sprintf("UPDATE news SET `news` ='%s' WHERE id = %s",
                  make_safe($_POST['news']),  make_safe($_GET['edit']));
    $sqlRs = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    if($sqlRs){
      header("location:post_news.php");
      $message =  "<div class='alert alert-success'>News Posted Successfully</div>";
      exit();
    }else{
      $message =  "<div class='alert alert-danger'>Unable to Post News</div>";
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
            <li role="presentation" class="active"><a href="post_news.php">Home</a></li>
            <li role="presentation"><a href="logout.php">Logout</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">EDIT NEWS</h3>
      </div>

      <div class="jumbotron">
        <h2>Post News</h2>
        <?= $message;?>
        <form id="myForm" action="" method="post">
          <div class="form-group">
            <label for=""> Enter News</label>
          <textarea name="news" rows="8" cols="80" class="form-control"><?= $fetchNews['news']?></textarea>
          </div>

          <button type="submit" name="submit" class="btn btn-primary btn-lg" style="width:100%;">Post News</button>
        </form>
      </div>

      <footer class="footer">
        <p>&copy; <?php echo Date('Y');?> Company, Inc.</p>
      </footer>

    </div> <!-- /container -->

<script type="text/javascript" src="main.js">

</script>
  </body>
</html>
