<?php require_once("Includes/DB.php"); ?>

<?php if(isset($_POST["Submit"])){
		$Name = $_POST['Name'];
		$Phone = $_POST['Phone'];
		$Email = $_POST['Email'];
		global $ConnectingDB;
		$sql = "INSERT INTO test(name,phone,email)
		VALUES(:namE,:phonE,:emaiL)";
		$stmt = $ConnectingDB->prepare($sql);
		$stmt->bindValue(':namE',$Name);
		$stmt->bindValue(':phonE',$Phone);
		$stmt->bindValue(':emaiL',$Email);
		$Execute = $stmt->execute();
		if ($Execute) {
			echo '<span class="success"> Record Has been Addedd Successfully</span>';
		}
} ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
  <link rel="stylesheet" href="Css/Styles.css">
  <title>Categories</title>
</head>
<body>
  <!-- NAVBAR -->
  <div style="height:10px; background:#27aae1;"></div>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <a href="#" class="navbar-brand">Logo</a>
      <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarcollapseCMS">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarcollapseCMS">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a href="MyProfile.php" class="nav-link"> <i class="fas fa-user text-success"></i> My Profile</a>
        </li>
        <li class="nav-item">
          <a href="Dashboard.php" class="nav-link">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="Posts.php" class="nav-link">Posts</a>
        </li>
        <li class="nav-item">
          <a href="Categories.php" class="nav-link">Categories</a>
        </li>
        <li class="nav-item">
          <a href="Admins.php" class="nav-link">Manage Admins</a>
        </li>
        <li class="nav-item">
          <a href="Comments.php" class="nav-link">Comments</a>
        </li>
        <li class="nav-item">
          <a href="Blog.php?page=1" class="nav-link" target="_blank">Live Blog</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <li class="nav-item"><a href="Logout.php" class="nav-link text-danger">
          <i class="fas fa-user-times"></i> Logout</a></li>
      </ul>
      </div>
    </div>
  </nav>
    <div style="height:10px; background:#27aae1;"></div>
    <!-- NAVBAR END -->
    <!-- HEADER -->
    <header class="bg-dark text-white py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
          <h1><i class="fas fa-edit" style="color:#27aae1;"></i> Manage Categories</h1>
          </div>
        </div>
      </div>
    </header>
    <!-- HEADER END -->

     <!-- Main Area -->
    <section class="container py-2 mb-4">
      <div class="row">
        <div class="offset-lg-1 col-lg-10" style="min-height:400px;">
          <?php
           //echo ErrorMessage();
           //echo SuccessMessage();
           ?>
          <form class="" action="test.php" method="post">
            <div class="card bg-secondary text-light mb-3">
              <div class="card-header">
                <h1>Add New Category</h1>
              </div>
              <div class="card-body bg-dark">
                <div class="form-group">
                  <label for="title"> 
                  	<span class="FieldInfo"> Name: </span>
                  </label>
                   <input class="form-control" type="text" name="Name" id="name" placeholder="Type title here" value="">
                </div>
                <div class="form-group">
                  <label for="title"> 
                  	<span class="FieldInfo"> Phone: </span>
                  </label>
                   <input class="form-control" type="tel" name="Phone" id="phone" placeholder="Type phone number here" value="">
                </div>
                <div class="form-group">
                  <label for="title"> 
                  	<span class="FieldInfo"> Email: </span>
                  </label>
                   <input class="form-control" type="email" name="Email" id="email" placeholder="Type email here" value="">
                </div>
                <div class="row">
                  <div class="col-lg-6 mb-2">
                    <button type="submit" name="Submit" class="btn btn-success btn-block">
                      <i class="fas fa-check"></i> Publish
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

    </section>
    <!-- End Main Area -->
    <!-- FOOTER -->
    <footer class="bg-dark text-white">
      <div class="container">
        <div class="row">
          <div class="col">
          <p class="lead text-center">Theme By | Raju Jeelaga | <span id="year"></span> &copy; ----All right Reserved.</p>
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