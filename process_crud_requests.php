<?php
include 'config.php';
include 'filter.php';

 // $sql = "select photo from students where id=1";
 // $result = mysqli_query($con,$sql);
 // $row = mysqli_fetch_array($result);

 // $image_src2 = $row['photo'];



if($_POST['identifier'] == 'add_student'){


	$validated = false;

	$name = $_FILES['file']['name'];
	$target_dir = "upload/";
	$target_file = $target_dir .$_POST['email'].'/'. basename($_FILES["file"]["name"]);



  // Select file type
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  // Valid file extensions
	$extensions_arr = array("jpg","jpeg","png");

  // Check extension
	if( in_array($imageFileType,$extensions_arr) ){

		$validated = true;


	}else{
		header('Location: ' . $_SERVER['HTTP_REFERER'].'?error=image');
		exit;
	}
	$email = $_POST['email'];
	$telephone = $_POST['telephone'];

	/*checking if record already exist in db*/

	$result = mysqli_query($con,"SELECT * FROM students WHERE email = '$email'  or telephone = '$telephone'");



	$num_rows = mysqli_num_rows($result);

	if ($num_rows > 0) {
		header('Location: ' . $_SERVER['HTTP_REFERER'].'?error=exists');
		exit;
	}

	if($validated)
	{
		$image_base64 = base64_encode(file_get_contents($_FILES['file']['tmp_name']) );
		$image = 'data:image/'.$imageFileType.';base64,'.$image_base64;

		$country_id = $_POST['country_id'];
		$country_query = mysqli_query($con,"SELECT name FROM countries  WHERE id =  '$country_id' LIMIT 1");

		$country_record = mysqli_fetch_assoc($country_query);

		$city_id = $_POST['city_id'];
		$city_query = mysqli_query($con,"SELECT name FROM cities  WHERE id =  '$city_id' LIMIT 1");

		$city_record = mysqli_fetch_assoc($city_query);


		$query = " INSERT INTO `students` (`full_name`, `date_of_birth`, `gender`, `telephone`, `email`, `city_id`, `country_id`, `photo`,`nationality`,`city`) VALUES ('".$_POST['full_name']."','".filterInput($_POST['date_of_birth'])."','".filterInput($_POST['gender'])."','".filterInput($_POST['telephone'])."','".filterInput($_POST['email'])."','".filterInput($_POST['city_id'])."','".filterInput($_POST['country_id'])."','".$image."','".$country_record['name']."','".$city_record['name']."')";



		if(mysqli_query($con,$query))
		{
			$student_id = mysqli_insert_id($con);

			foreach ($_POST['courses'] as $course_id) {
				
				$query = " INSERT INTO `student_registrations` (`student_id`,`course_id`) VALUES ('".$student_id."','".$course_id."')";

					mysqli_query($con,$query);

			}

			header('Location: ' . $_SERVER['HTTP_REFERER'].'?message=success');
		}else {
			echo mysqli_error($con);
		}
	}

}
elseif($_POST['identifier'] == 'add_country')
{
	
	if(isset($_POST['name']) && !empty($_POST['name']))
	{
		$name = strtolower(filterInput($_POST['name']));


		/*checking if record already exist in db*/

		$result = mysqli_query($con,"SELECT * FROM countries WHERE name = '$name' ");


		
		$num_rows = mysqli_num_rows($result);

		if ($num_rows > 0) {
			header('Location: ' . $_SERVER['HTTP_REFERER'].'?error=exists');
			exit;
		}

		$query = " INSERT INTO `countries` (`name`) VALUES ('".$name."')";


		if(mysqli_query($con,$query))
		{
			header('Location: ' . $_SERVER['HTTP_REFERER'].'?message=success');
		}else {
			echo mysqli_error($con);
		}

	}



}
elseif($_POST['identifier'] == 'add_course')
{
	
	if(isset($_POST['name']) && !empty($_POST['name']))
	{
		$name = strtolower(filterInput($_POST['name']));



		/*checking if record already exist in db*/

		$result = mysqli_query($con,"SELECT * FROM courses WHERE name = '$name' ");


		
		$num_rows = mysqli_num_rows($result);

		if ($num_rows > 0) {
			header('Location: ' . $_SERVER['HTTP_REFERER'].'?error=exists');
			exit;
		}

		$query = " INSERT INTO `courses` (`name`) VALUES ('".$name."')";


		if(mysqli_query($con,$query))
		{
			header('Location: ' . $_SERVER['HTTP_REFERER'].'?message=success');
		}else {
			echo mysqli_error($con);
		}

	}



}
elseif($_POST['identifier'] == 'add_city')
{
	
	if(isset($_POST['name']) && !empty($_POST['name']))
	{
		$name = strtolower(filterInput($_POST['name']));



		/*checking if record already exist in db*/

		$result = mysqli_query($con,"SELECT * FROM cities WHERE name = '$name' ");


		
		$num_rows = mysqli_num_rows($result);

		if ($num_rows > 0) {
			header('Location: ' . $_SERVER['HTTP_REFERER'].'?error=exists');
			exit;
		}

		$query = " INSERT INTO `cities` (`name`) VALUES ('".$name."')";


		if(mysqli_query($con,$query))
		{
			$city_id = mysqli_insert_id($con);
			$country_id = filterInput($_POST['country_id']);
			$query = " INSERT INTO `country_cities` (`country_id`,`city_id`) VALUES ('".$country_id."','".$city_id."')";

			if(mysqli_query($con,$query))
			{
				header('Location: ' . $_SERVER['HTTP_REFERER'].'?message=success');
				exit;
			}

			echo mysqli_error($con);
			
		}else {
			echo mysqli_error($con);
		}

	}



}
elseif($_POST['identifier'] == 'ajax-city')
{
	
	$response_data =  array();

	if(isset($_POST['id']))
	{
		
		$id = $_POST['id'];



		$result = mysqli_query($con,"SELECT country_cities.city_id, cities.name FROM country_cities JOIN cities on country_cities.city_id = cities.id  WHERE country_id =  '$id'");



		while ($row = mysqli_fetch_array($result)) {
			$data =  array();
			$data['id'] = $row['city_id'] ;
			$data['name'] = $row['name'] ;

			$response_data[] = $data;
		}


		echo json_encode($response_data); 

		

	}



}
elseif($_POST['identifier'] == 'ajax-delete-student')
{
	
	$response_data =  array();

	if(isset($_POST['id']))
	{
		
		$id = $_POST['id'];

		$result = mysqli_query($con,"DELETE FROM students WHERE id = '$id' ");


		
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		

	}



}
elseif($_POST['identifier'] == 'edit_student'){


	$email = $_POST['email'];
	$telephone = $_POST['telephone'];
	$student_id = $_POST['id'];



	/*checking if record already exist in db*/

	$result = mysqli_query($con,"SELECT * FROM students WHERE id != $student_id  AND ( email = '$email'  or telephone = '$telephone' ) ");



	$num_rows = mysqli_num_rows($result);

	if ($num_rows > 0) {
		header('Location: ' . $_SERVER['HTTP_REFERER'].'&error=exists');
		exit;
	}



		$country_id = $_POST['country_id'];
		$country_query = mysqli_query($con,"SELECT name FROM countries  WHERE id =  '$country_id' LIMIT 1");

		$country_record = mysqli_fetch_assoc($country_query);

		$city_id = $_POST['city_id'];
		$city_query = mysqli_query($con,"SELECT name FROM cities  WHERE id =  '$city_id' LIMIT 1");

		$city_record = mysqli_fetch_assoc($city_query);

		$full_name = $_POST['full_name'];
		$date_of_birth = $_POST['date_of_birth'];
		$gender = $_POST['gender'];
		$telephone = $_POST['telephone'];
		$email = $_POST['email'];
		$city_id = $_POST['city_id'];
		$country_id = $_POST['country_id'];
		$nationality = $country_record['name'];
		$city = $city_record['name'];


		$query = "UPDATE students SET 
		full_name = '$full_name', date_of_birth = '$date_of_birth' , gender = '$gender' , telephone = '$telephone' 
		 , email = '$email'  , city_id = '$city_id'  , country_id = '$country_id' , nationality = '$nationality' , city = '$city' 
		WHERE id = 	$student_id ";


		// $query = " INSERT INTO `students` (`full_name`, `date_of_birth`, `gender`, `telephone`, `email`, `city_id`, `country_id`, `photo`,`nationality`,`city`) VALUES ('".$_POST['full_name']."','".filterInput($_POST['date_of_birth'])."','".filterInput($_POST['gender'])."','".filterInput($_POST['telephone'])."','".filterInput($_POST['email'])."','".filterInput($_POST['city_id'])."','".filterInput($_POST['country_id'])."','".$image."','".$country_record['name']."','".$city_record['name']."')";



		if(mysqli_query($con,$query))
		{
		
			header('Location: index.php?message=success');
		}else {
			echo mysqli_error($con);
		}
	
}








