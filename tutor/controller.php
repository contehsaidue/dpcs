<?php
    session_start(); // starting a session
   // Add database connection
   require '../includes/connection.php';

 if (isset($_POST['tutorlogin'])){

// checking values from database

$username = $_POST['username'];
$password = $_POST['password'];

// query to search for faculty in system database

$sql = "SELECT * FROM tbltutor WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);
// checking query status inside DB
if(mysqli_num_rows($result) > 0) {        
$row = mysqli_fetch_assoc($result);
    if($row['username'] === $username && $row['password'] === $password){
    // creating session variables from Database
    $_SESSION['id'] = $row['id'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['firstname'] =  $row['firstname'];
    $_SESSION['lastname'] =  $row['lastname'];
    $_SESSION['email'] =  $row['email'];
    $_SESSION['designation'] =  $row['designation'];
    $_SESSION['photo'] = $row['photo'];
    $_SESSION['phone'] = $row['phone'];
    $_SESSION['status'] = "Welcome back online Tutor!";
    $_SESSION['type'] = "success";
    header('Location:faculty-dashboard.php');
    exit();
    }
 } else{
    $_SESSION['status'] = "There was an error in your login attempt!";
    $_SESSION['type'] = "error";
    header('Location:../index.php');
}
 }

// Query to add faculty inside DB : ADMIN
if (isset($_POST['facultyregister']))
{  
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $designation = $_POST['designation'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    // Image type 
    $photoname = $_FILES['photo']['name'];
    $tutor_image_tempname = $_FILES['photo']['tmp_name'];

     // checking image file type
     $tutor_image_type = strtolower(pathinfo( $photoname , PATHINFO_EXTENSION));
     // valid file extensions
    $extensions_arr = array("jpg","jpeg","png");

    $root_path = "../assets/facultyregisteruploads/".$photoname; // storing image path to folder in root directory
    $db_path = "assets/facultyregisteruploads/".$photoname; // storing image path into database
    $phone = $_POST['phone'];

    // Check if student already in system database
    $tutorcheckquery = "SELECT * FROM tbltutor WHERE email = '$email'";
    $tutorcheckqueryrun =  mysqli_query($conn, $tutorcheckquery );
    $tutorrow = mysqli_fetch_assoc($tutorcheckqueryrun);

    if ($tutorrow['email'] ==  $email){
      $_SESSION['status'] = "Tutor is already registered in system's Database!";
      $_SESSION['type'] = "error";
      header ('Location: ../index.php');

}else{

if(in_array($tutor_image_type, $extensions_arr)){

// query to insert new faculty into system database
 $sql = "INSERT INTO tbltutor
          (username, firstname, lastname, designation, password,gender,email,photo,phone)
	        VALUES ('$username', '$firstname','$lastname','$designation','$password','$gender','$email','$db_path', '$phone')";
  move_uploaded_file($tutor_image_tempname, $root_path);

	if (mysqli_query($conn, $sql)) {
    $_SESSION['status'] = "Successfully registered as a tutor";
    $_SESSION['type'] = "success";
    header ('Location: ../index.php');
} else{
  $_SESSION['status'] = "Failed to register as a tutor!";
  $_SESSION['type'] = "error";
  header ('Location: ../index.php');
 }
}else{
  $_SESSION['status'] = "Image type not supported - Supported image type (jpg, jpeg, png)!";
  $_SESSION['type'] = "error";
  header ('Location: ../index.php');
} 
  } 
}

 
  // query to mark student attendance into system database : FACULTY
  if (isset($_POST['markattendance'])){
    // capturing input values
    $studentid = $_POST['student_id'];
    $tut_ID = $_POST['tut_id'];
    $courseid = $_POST['Course_ID'];
    $program = $_POST['prog_ID'];
    $status = $_POST['attendancemarker'];
    //$datemarked = date('Y-m-d');
 
    foreach ($status as $studentmarked){
    $sql = "INSERT INTO tblstudentattendace (studentid,tutid,courseid,programid,status) 
    VALUES ('$studentmarked','$tut_ID','$courseid','$program','$status')";
    $sqlrun = mysqli_query($conn, $sql);
    }

  if ($sqlrun) {
    $_SESSION['status'] = "Attendance marked Successfully";
    $_SESSION['type'] = "success";
    header('Location:faculty-attendance.php');
}
else
{
    $_SESSION['status'] = "Failed to mark attendace";
    $_SESSION['type'] = "error";
    header('Location: faculty-attendance.php');
}
  }
    
  
// Query to set timetable into Database : FACULTY
if (isset($_POST['modalfacultysettimetable'])){
  // capturing input values
  $program = $_POST['program'];
  $level = $_POST['level'];
  $coursename = $_POST['coursename'];
  $tutor = $_POST['tutor'];
  $days = $_POST['days'];
  $time = $_POST['time'];
  
  // query string to insert timetable data into sys DB
  $sql = "INSERT INTO tbltutortimetable (prog_ID,level_ID,Course_ID,tut_ID,days,time)
           VALUES ('$program','$level','$coursename','$tutor','$days','$time')";

  if (mysqli_query($conn, $sql)) {
   $_SESSION['status'] = "Timetable successfully set";
   $_SESSION['type'] = "success";
   header('Location: faculty-timetable.php');
} else{
  $_SESSION['status'] = "Failed to set tiemtable!";
  $_SESSION['type'] = "error";
  header('Location: faculty-timetable.php');
}

}
// delete timetable action using the $_GET variable : FACULTY
if(isset($_GET['facultydeletetimetable'])){
  $id = $_GET['facultydeletetimetable'];
  $sql ="DELETE FROM tbltutortimetable WHERE id = '$id'";
  if (mysqli_query($conn, $sql)) {
      $_SESSION['status'] = "Timetable successfully removed!";
      $_SESSION['type'] = "success";
      header('Location: faculty-timetable.php');
  } else{
    $_SESSION['status'] = "Failed to remove timetable!";
    $_SESSION['type'] = "error";
    header('Location: faculty-timetable.php');
  }
}

  // query to insert student grades into system database : FACULTY
  if (isset($_POST['facultyaddgrade'])){
    // capturing input values
    $coursename = $_POST['coursename'];
    $program = $_POST['program'];
    $level = $_POST['level'];
    $tutor = $_POST['tutor'];
    $semester = $_POST['semester'];
    $studentid = $_POST['studentid'];
    $score = $_POST['score'];
   
 // query string
    $sql = "INSERT INTO tblgrades (course_ID,prog_ID,level_ID,tut_ID,sem_ID,student_ID,score) 
    VALUES ('$coursename','$program','$level','$tutor','$semester','$studentid','$score')";
  
  if (mysqli_query($conn, $sql)) {
    $_SESSION['status'] = "Student grade successfully added!";
    $_SESSION['type'] = "success";
    header('Location: faculty-add-grades.php');
} else{
    $_SESSION['status'] = "Failed to add student grade!";
    $_SESSION['type'] = "error";
    header('Location: faculty-add-grades.php');
}
  }

   
 // delete grade action using the $_GET variable : FACULTY
if(isset($_GET['facultydeletegrade'])){
    $id = $_GET['facultydeletegrade'];
    $sql ="DELETE FROM  tblgrades WHERE grade_ID = '$id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "Grade successfully removed";
        $_SESSION['type'] = "success";
        header('Location: faculty-view-student-grades.php');
    } else{
      $_SESSION['status'] = "Failed to removed student grade!";
      $_SESSION['type'] = "error";
      header('Location: faculty-view-student-grades.php');
    }
}


if (isset($_POST['modalfacultyaddprogram'])){ 

  $program = $_POST['program'];
  $level = $_POST['level'];
  $tutor = $_POST['tutor'];

  $sql = "INSERT INTO tbltutorprogram (prog_ID, level_ID, tut_ID)
  VALUES('$program','$level','$tutor')";

  if (mysqli_query($conn, $sql)){
  $_SESSION['status'] = "You've successfully added the selected program!";
  $_SESSION['type'] = "success";
  header ('Location: faculty-add-program.php'); 
} else {
$_SESSION['status']  = "Failed to add selected program!"; 
$_SESSION['type'] = "error";
header ('Location: faculty-add-program.php');
}

} 


// delete program action using the $_GET variable : FACULTY
if(isset($_GET['facultydeleteprogram'])){
  $id = $_GET['facultydeleteprogram'];
  $sql ="DELETE FROM tbltutorprogram WHERE tut_programID = '$id'";
  if (mysqli_query($conn, $sql)) {
      $_SESSION['status'] = "The selecetd program has been successfully removed from your course load!";
      $_SESSION['type'] = "success";
      header ('Location: faculty-add-program.php');
  } else{
      $_SESSION['status'] = "Failed to remove course from course load!";
      $_SESSION['type'] = "error";
      header ('Location: faculty-add-program.php');
  }
}



// Query to add course into Database : FACULTY
if (isset($_POST['modalfacultyaddcourse'])){
  // capturing input values
  $coursename = $_POST['coursename'];
  $program = $_POST['program'];
  $level = $_POST['level'];
  $semester = $_POST['semester'];
  $tutor = $_POST['tutor'];

  // query string
  $sql = "INSERT INTO tbltutorcourses (tut_ID,prog_ID,course_ID,level_ID,sem_ID)
           VALUES ('$tutor','$program','$coursename','$level','$semester')";

  if (mysqli_query($conn, $sql)) {
   $_SESSION['status'] = "You've successfully added the selected course!";
   $_SESSION['type'] = "success";
   header('Location: faculty-add-course.php');
} else {
  $_SESSION['status'] = "Failed to add the selected course!";
  $_SESSION['type'] = "error";
  header('Location: faculty-add-course.php');
}

}


// delete course action using the $_GET variable : FACULTY
if(isset($_GET['facultydeletecourse'])){
  $id = $_GET['facultydeletecourse'];
  $sql ="DELETE FROM tbltutorcourses WHERE tut_courseID = '$id'";
  if (mysqli_query($conn, $sql)) {
      $_SESSION['status'] = "Course successfully removed from your course load!";
      $_SESSION['type'] = "success";
      header ('Location: faculty-add-course.php');
  } else{
    $_SESSION['status'] = "Failed to remove course from course load!";
    $_SESSION['type'] = "error";
    header ('Location: faculty-add-course.php');
  }
}


// Query to add course material inside DB : FACULTY
if (isset($_POST['facultyaddmaterial'])){
  // capturing input values
  $filename = $_POST['filename'];
  $filecontent = $_FILES['filecontent'];
  $tutor = $_POST['tutor'];
  $program = $_POST['program'];
  $level = $_POST['level'];
  $semester = $_POST['semester'];
  $filecontent = $_FILES['filecontent']['name'];
  $filecontent_tempname = $_FILES['filecontent']['tmp_name'];
    // checking  file upload type
  $filecontent_type = strtolower(pathinfo($filecontent, PATHINFO_EXTENSION));
    // valid file extensions
   $extensions_arr = array("pdf","ppt","docx");
  $root_path = "../assets/studentmaterialuploads/".$filecontent; // storing image path to folder in root directory
  $db_path = "assets/studentmaterialuploads/".$filecontent; // storing image path into database

  if(in_array($filecontent_type, $extensions_arr)){
  // insert query string
  $sql = "INSERT INTO tblcoursematerial (matname,matcontent,tut_ID,prog_ID,level_ID,sem_ID) 
  VALUES ('$filename','$db_path','$tutor','$program','$level','$semester')";
  
  move_uploaded_file( $filecontent_tempname , $root_path );

if (mysqli_query($conn, $sql)) {
  $_SESSION['status'] = "Learning material successfully added!";
  $_SESSION['type'] = "success";
  header('Location: faculty-add-material.php');
} else{
  $_SESSION['status'] = "Failed to add learning material!";
  $_SESSION['type'] = "error";
  header('Location: faculty-add-material.php');
 }
}else{
  $_SESSION['status'] = "Document type not supported - Supported document type (pdf, docx, ppt)!";
  $_SESSION['type'] = "error";
  header('Location: faculty-add-material.php');
} 
  } 


// delete material action using the $_GET variable : FACULTY  
if(isset($_GET['facultydeletematerial'])){
  $id = $_GET['facultydeletematerial'];
  $sql ="DELETE FROM tblcoursematerial WHERE mat_ID = '$id'";
  if (mysqli_query($conn, $sql)) {
      $_SESSION['status'] = "Learning material removed successfully!";
      $_SESSION['type'] = "success";
      header ('Location: faculty-add-material.php');
  } else{
    $_SESSION['status'] = "Learning material removed successfully!";
    $_SESSION['type'] = "error";
    header ('Location: faculty-add-material.php');
  }
}

?>