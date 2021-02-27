# Study Management System

A simple admin dashboard with elegant design, catering basic needs of  educational institute to manage their students registrations in different courses.

## Technology Stack
It is built on  PHP, database is on MySQL and validation using jQuery. Moreover the simple and elegant look of dashboard is designed through CSS.A third party plugin know as PHP datable has been used to accompany basic functionality for admin managing the system

## Features
* Personalize Dashboard
* Student Listing
  - Search Record
  - Sort records ascending/descending
  - Pagination for large number of records
* Add new students
* Update students record
* Delete students record
* Add Courses
* Add Countries
* Add Cities
* Ajax Base cites listing based on county in the forms




## Usage And Installation
In order to use the system import the database in the `db` directory and then edit the `config.php` file appropriately with you database settings

```bash

<?php

$host = "localhost"; /* Host name */
$user = "root"; /* User */
$password = ""; /* Password */
$dbname = "sample_db"; /* Database name */

$con = mysqli_connect($host, $user, $password,$dbname);
// Check connection
if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}


```
## Demo
![Demo](https://raw.githubusercontent.com/MSaddamKamal/study-management-system/main/screenshot/study_demo-min.gif)

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
Study Management Dashboard © 2021 All Rights Reserved

Made by M.Saddam
