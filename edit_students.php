<?php include 'config.php'; ?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Study Managment System</title>

  <!-- Bootstrap CSS CDN -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
  <!-- Our Custom CSS -->
  <link rel="stylesheet" href="style.css">

  <!-- Font Awesome JS -->
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
  <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

  <!-- Datatable CSS -->
  <link href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' rel='stylesheet' type='text/css'>

  <!-- jQuery Library -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <!-- Datatable JS -->
  <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

  <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
  rel = "stylesheet">

  <script src = "https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>


</head>

<body>

  <div class="wrapper">
    <!-- Sidebar Holder -->
    <nav id="sidebar">
      <div class="sidebar-header">
        <h3>Dashboard</h3>
      </div>

      <ul class="list-unstyled components">
        <p>Study Managemnt System</p>
        <li >
          <a href="#studentSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Students</a>
          <ul class="collapse list-unstyled" id="studentSubmenu">
            <li>
              <a href="index.php">Student Listing</a>
            </li>
            <li>
              <a href="add_students.php">Add Student</a>

            </li>

          </ul>
        </li>
        <li >
          <a href="#courseSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Courses</a>
          <ul class="collapse list-unstyled" id="courseSubmenu">
            <li>
              <a href="add_courses.php">Add Courses</a>
            </li>
          </ul>
        </li>
        <li >
          <a href="#countrySubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Country</a>
          <ul class="collapse list-unstyled" id="countrySubmenu">
            <li>
              <a href="add_countries.php">Add Country</a>
            </li>
          </ul>
        </li>
        <li >
          <a href="#citySubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Cities</a>
          <ul class="collapse list-unstyled" id="citySubmenu">
            <li>
              <a href="add_cities.php">Add City</a>
            </li>
          </ul>
        </li>

      </ul>
      <div class="copyright">
        <p><strong>Study Managment Dashboard</strong> © 2021 All Rights Reserved</p>
        <p class="made-by">Made by M.Saddam</p>
      </div>


    </nav>
    <?php 

    $sql = "select * from students where id = ". $_GET['id'];
    $result = mysqli_query($con,$sql);

    $student_data = [];

    while ($row = mysqli_fetch_array($result)) {
      $student_data['id'] = $row["id"];
      $student_data['full_name'] = $row["full_name"];
      $student_data['date_of_birth'] = $row["date_of_birth"];
      $student_data['gender'] = $row["gender"];
      $student_data['telephone'] = $row["telephone"];
      $student_data['email'] = $row["email"];
      $student_data['city_id'] = $row["city_id"];
      $student_data['country_id'] = $row["country_id"];
      $student_data['photo'] = $row["photo"];
      $student_data['nationality'] = $row["nationality"];
      $student_data['city'] = $row["city"];

    }

    ?>

    <!-- Page Content Holder -->
    <div id="content">

      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

          <button type="button" id="sidebarCollapse" class="navbar-btn">
            <span></span>
            <span></span>
            <span></span>
          </button>

          <div class="float-right" >
            <img  src="<?= $student_data['photo'] ?>" style="height:50px;width:50px;align:middle;" />
          </div>
        </div>
      </nav>

      <div>
        <?php if(isset($_GET['message'])):?>
          <div class="alert alert-success" role="alert">
            <strong>Success!</strong> student created succesfully.
          </div>
        <?php endif;?>
        <?php if(isset($_GET['error']) && $_GET['error'] == 'exists'):?>
          <div class="alert alert-danger" role="alert">
            <strong>Error!</strong>either email or telephone already exists.
          </div>
        <?php endif;?>
        <?php if(isset($_GET['error']) && $_GET['error'] == 'image'):?>
          <div class="alert alert-danger" role="alert">
            <strong>Error!</strong>valid image formats are "jpg","jpeg","png" only.
          </div>
        <?php endif;?>
        <form method="post" action="process_crud_requests.php" enctype='multipart/form-data' id="edit_student_form">
          <input type="hidden" name="identifier" value="edit_student">
          <input type="hidden" name="id" value="<?=  $student_data['id']?>">
          <div class="form-group">
            <label for="exampleFormControlInput1">Full Name</label>
            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="John Smith" name="full_name" value="<?=  $student_data['full_name']?>">
          </div> 
          <div class="form-group">
            <label for="exampleFormControlInput2">Date Of Birth</label>
            <input type="text" class="form-control" id="datepicker-11"  name="date_of_birth" value="<?php echo  $student_data['date_of_birth'] ?>">
          </div>
          <div class="form-group">
            <label for="exampleFormControlSelect1">Gender</label>
            <select class="form-control" id="exampleFormControlSelect1" name="gender">

              <option value="Male" <?php  echo $student_data['gender'] == 'Male' ? 'selected' : null ?> >

                Male</option>
                <option value="Female" <?php echo $student_data['gender'] == 'Female'? 'selected': null ?>>Female</option>

                
              </select>
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput3">Telephone</label>
              <input type="text" class="form-control" id="exampleFormControlInput3" placeholder="03152611244" name="telephone" value="<?= $student_data['telephone'] ?>">
            </div> 
            <div class="form-group">
              <label for="exampleFormControlInput4">Email address</label>
              <input type="email" class="form-control" id="exampleFormControlInput4" placeholder="name@example.com" name="email" value="<?= $student_data['email'] ?>">
            </div>
            <div class="form-group">
              <label for="country">Nationality</label>
              <select class="form-control" name="country_id" id="country">
                <?php 

                $sql = "select * from countries ";
                $result = mysqli_query($con,$sql);

                while ($row = mysqli_fetch_array($result)) {
                  if($student_data['country_id'] == $row["id"])
                  {
                    $option = sprintf("<option selected value='%s'>%s</option>",$row["id"], $row["name"]);
                  }else{
                    $option = sprintf("<option  value='%s'>%s</option>",$row["id"], $row["name"]);
                  }

                  echo $option;
                }

                ?>

              </select>
            </div>

            <div class="form-group">
              <label for="city">City</label>
              <select class="form-control" name="city_id" id="city" value="<?= $student_data['city_id'] ?>">

              </select>
            </div>
            <button type="button" id="submit_btn_edit_form" class="btn btn-primary ">Submit</button>
          </form>
        </div>

      </div>
    </div>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <!--     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>


    <script src="index.js">

    </script>
    <script src="validation/form-validation.js"></script>
    <script src="validation/sad-form.js"></script>
  </body>

  </html>