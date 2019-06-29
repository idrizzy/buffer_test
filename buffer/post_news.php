<?php
session_start();
if(!isset($_SESSION['username'])){
  header("location:auth.php");
}
$conn = mysqli_connect("localhost", "root", "", "buffer");
if(!$conn){
  echo "unable to connect to the database";
}
$gets = file_get_contents('http://127.0.0.1:8000/news');
// echo "<pre>";
// print_r(); die;
//this function is used to protect the incoming HttpQueryString
function make_safe($variable)
{
  global $conn;
   $variable = strip_tags(mysqli_real_escape_string($conn, trim($variable)));
   return $variable;
}
//this is used to fetch all news
$news = sprintf("SELECT * FROM news");
$newsRs = mysqli_query($conn, $news)or die(mysqli_error($conn));
// $fetchNews = mysqli_fetch_all($newsRs, MYSQLI_ASSOC);
$fetchNews = json_decode($gets);
$message = '';
if(isset($_POST['submit'])){
  if(empty($_POST['news'])){
    $message =  "<div class='alert alert-danger'>please properly fill the input fields</div>";
  }else{
    // $ch = curl_init();
    //
    //    curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:8000/news");
    //    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    //    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
    //
    //
    //    $headers = array();
    //    $headers[] = 'Accept:Application/JSON';
    // $post = array(
    //   "id" => NULL,
    //   "news" => $_POST['news'],
    // );
    // $posts = json_encode($post);
    // // echo $posts; die;
    //    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json"));
    //    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    //    curl_setopt($ch, CURLOPT_POST, 1);
    //    curl_setopt($ch, CURLOPT_POSTFIELDS, $posts);
    //    $result = curl_exec($ch);
    //    echo $result ; die;
    //    if (curl_errno($ch)) {
    //        echo 'Error:' . curl_error($ch);
    //    }
    //    curl_close($ch);

    $sql = sprintf("INSERT INTO news (`id`, `news`) VALUES(null, '%s')",
                  make_safe($_POST['news']));
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

if(isset($_GET['del'])){
  $news = sprintf("DELETE FROM news WHERE id = %s", $_GET['del']);
  $newsRs = mysqli_query($conn, $news)or die(mysqli_error($conn));
  header("location:post_news.php");
  $message =  "<div class='alert alert-success'>News Deleted Successfully</div>";
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
            <li role="presentation" class="active"><a href="#">Home</a></li>
            <li role="presentation"><a href="#">News</a></li>
            <li role="presentation"><a href="logout.php">Logout</a></li>
          </ul>
        </nav>
        <h3 class="text-muted">NEWS</h3>
      </div>

      <div class="jumbotron">
        <h2>Post News</h2>
        <?= $message;?>
        <form id="myForm" action="" method="post">
          <div class="form-group">
            <label for=""> Enter News</label>
          <textarea name="news" rows="8" cols="80" class="form-control"></textarea>
          </div>

          <button type="submit" name="submit" class="btn btn-primary btn-lg" style="width:100%;">Post News</button>
        </form>
      </div>
      <div class="well">
        <table class="table table-bordered table-hover table-striped">
          <thead>
            <th>S/N</th>
            <th>news</th>
            <th>Action</th>
          </thead>
          <tbody>
              <?php
              $x=1;
              foreach($fetchNews as $news){?>
              <tr>
              <td><?=$x++?></td>
              <td><?=$news->news?></td>
              <td>
                <a class="btn btn-info" href="editnews.php?edit=<?=$news->id?>"> Edit</a>
                <a class="btn btn-danger" href="post_news.php?del=<?=$news->id?>">Delete</a>
              </td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>



      <footer class="footer">
        <p>&copy; <?php echo Date('Y');?> Company, Inc.</p>
      </footer>

    </div> <!-- /container -->

<script type="text/javascript" src="main.js">

</script>
  </body>
</html>
