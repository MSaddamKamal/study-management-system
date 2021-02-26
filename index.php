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
            Students List
          </div>
        </div>
      </nav>

              <?php if(isset($_GET['message'])):?>
          <div class="alert alert-success" role="alert">
            <strong>Success!</strong> student info updated succesfully.
          </div>
        <?php endif;?>

      <!-- Table -->
      <table id="empTable" class="table table-bordered table-hover table-warning table-responsive-sm w-100">

        <thead>
          <tr>
            <th>Full Name</th>
            <th>Image</th>
            <th>Gender</th>
            <th>City</th>
            <th>Country</th>
            <th>Actions</th>

       
          </tr>
        </thead>

      </table>

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

      <script type="text/javascript">


  $(document).ready(function () {
              setTimeout(function(){ 

    window.history.replaceState(null, null, window.location.pathname);
    $('.alert-danger').remove();
    $('.alert-success').remove();
  }, 3000);

  })


  </script>
</body>

</html>