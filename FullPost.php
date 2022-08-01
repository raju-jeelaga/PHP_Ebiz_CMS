<?php require_once("Includes/DB.php"); ?>
<?php require_once("Includes/Functions.php"); ?>
<?php require_once("Includes/Sessions.php"); ?>
<?php 
$SearchQueryParameter = $_GET["id"];
if(isset($_POST["Submit"])){
  $Name     = $_POST["CommenterName"];
  $Email    = $_POST["CommenterEmail"];
  $Comment  = $_POST["CommenterThoughts"];
  date_default_timezone_set("Asia/Karachi");
  $CurrentTime=time();
  $DateTime=strftime("%B-%d-%Y %H:%M:%S",$CurrentTime);

  // if(empty($Name) || empty($Email) || empty($Comment) ){
  //   $_SESSION["ErrorMessage"]= "All fields must be filled out";
  //   Redirect_to("FullPost.php?id={$SearchQueryParameter}");
  // }elseif (strlen($Comment)>500) {
  //   $_SESSION["ErrorMessage"]= "Comment length should be less than 500 characters";
  //   Redirect_to("FullPost.php?id={$SearchQueryParameter}");
  // }else{
    // Query to insert Post in DB When everything is fine
    global $ConnectingDB;
    $sql  = "INSERT INTO comments(datetime,name,email,comment)";
    $sql .= "VALUES(:dateTime,:name,:email,:comment)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt -> bindValue(':dateTime',$DateTime);
    $stmt -> bindValue(':name',$Name);
    $stmt -> bindValue(':email',$Email);
    $stmt -> bindValue(':comment',$Comment);
    $Execute = $stmt -> execute();
    //var_dump($Execute);
    if($Execute){
      $_SESSION["SuccessMessage"]="Comment Submitted Successfully";
      Redirect_to("FullPost.php?id={$SearchQueryParameter}");
    }else {
      $_SESSION["ErrorMessage"]="Something went wrong. Try Again !";
      Redirect_to("FullPost.php?id={$SearchQueryParameter}");
    }

  //}
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="Css/Styles.css">
  <title>Post Detail</title>
</head>
<body>
  <!-- NAVBAR -->
  <div style="height:10px; background:#27aae1;"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="#" class="navbar-brand">Ebiz</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarcollapseCMS">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a href="Blog.php?page=1" class="nav-link">Home</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">About Us</a>
        </li>
        <li class="nav-item">
          <a href="Blog.php?page=1" class="nav-link">Blog</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Contact Us</a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">Features</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <form class="form-inline d-none d-sm-block" action="Blog.php">
          <div class="form-group">
          <input class="form-control mr-2" type="text" name="Search" placeholder="Search here"value="">
          <button  class="btn btn-primary" name="SearchButton">Go</button>
          </div>
        </form>
      </ul>
      </div>
    </div>
  </nav>

    <div style="height:10px; background:#27aae1;"></div>
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <div class="container">
      <div class="row mt-4">

        <!-- Main Area Start-->
        <div class="col-sm-8">
          <h1>The Complete Responsive CMS Blog</h1>
          <h1 class="lead">The Complete blog by using PHP by Raju Jeelaga</h1>
          <?php 
            global $ConnectingDB;
            if(isset($_GET['SearchButton'])){
              $Search = $_GET["Search"];
              $sql = "SELECT * FROM posts
              WHERE datetime LIKE :search
              OR title LIKE :search
              OR category LIKE :search
              OR description LIKE :search";
              $stmt = $ConnectingDB->prepare($sql);
              $stmt->bindValue(':search','%'.$Search.'%');
              $stmt->execute();
            } else{
            	$PostIdFromURL = $_GET['id'];
            	if(!isset($PostIdFromURL)){
            		$_SESSION['ErrorMessage'] = "Bad Request !";
            		Redirect_to("Blog.php?page=1");
            	}
              	$sql = "SELECT * FROM posts WHERE id = '$PostIdFromURL'";
              	$stmt = $ConnectingDB->query($sql);
            }
            global $ConnectingDB;
            
            while( $DataRows = $stmt->fetch()){
              $PostId           = $DataRows["id"];
              $Datetime         = $DataRows["datetime"];
              $PostTitle        = $DataRows["title"];
              $category         = $DataRows["category"];
              $Author           = $DataRows["author"];
              $Image            = $DataRows["image"];
              $PostDescription  = $DataRows["description"];
          ?>
          <div class="card mb-5">
              <img src="Uploads/<?php echo htmlentities($Image); ?>" class="img-fluid card-img-top" />
              <div class="card-body">
                <h4 class="card-title"><?php echo htmlentities($PostTitle); ?></h4>
                <small class="text-muted">Category:<?php echo htmlentities($category); ?></small>
                <span style="float:right;" class="badge badge-dark text-light">Comments:20</span>
                <p class="card-text">
                  <?php 
                    echo htmlentities($PostDescription); 
                  ?>
                </p>
              </div>

          </div>
          <?php } // while loop ends?>

          <div>
            <form class="" action="FullPost.php?id=<?php echo $SearchQueryParameter ?>" method="post">
              <div class="card mb-3">
                <div class="card-header">
                  <h5 class="FieldInfo">Share your thoughts about this post</h5>
                </div>
                <div class="card-body">

                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                      </div>
                    <input class="form-control" type="text" name="CommenterName" placeholder="Name" value="">
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                      </div>
                    <input class="form-control" type="text" name="CommenterEmail" placeholder="Email" value="">
                    </div>
                  </div>

                  <div class="form-group">
                    <textarea name="CommenterThoughts" class="form-control" rows="6" cols="80"></textarea>
                  </div>
                  <div class="">
                    <button type="submit" name="Submit" class="btn btn-primary">Submit</button>
                  </div>

                </div>
              </div>
            </form>
          </div>
        </div>

        <div class="col-sm-3 offset-sm-1" style="height:auto; background:green;">

        </div>
      </div>

    </div>
    <!-- HEADER END -->
    <!-- FOOTER -->
    <footer class="bg-dark text-white">
      <div class="container">
        <div class="row">
          <div class="col">
          <p class="lead text-center">Theme By | Raju Jeelaga | <span id="year"></span> &copy; ----All right Reserved.</p>
          <p class="text-center small"><a style="color: white; text-decoration: none; cursor: pointer;" href="#" target="_blank"> This is own site </a></p>
           </div>
         </div>
      </div>
    </footer>
        <div style="height:10px; background:#27aae1;"></div>
    <!-- FOOTER END-->

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
<script>
  $('#year').text(new Date().getFullYear());
</script>
</body>
</html>