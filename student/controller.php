<?php
    session_start(); // starting a session
   // Add database connection
   require '../includes/connection.php';

   if (isset($_POST['studentregister'])){  

  
    // capturing values from registration form to variables
    $studentid = $_POST['studentid'];
    $username = $_POST['studentid'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $level = $_POST['level'];
    $program = $_POST['program'];
    $password = $_POST['password'];
    // Image type 
    $photoname = $_FILES['photo']['name'];
    $student_image_tempname = $_FILES['photo']['tmp_name'];

     // checking image file type
     $student_image_type = strtolower(pathinfo( $photoname , PATHINFO_EXTENSION));
     // valid file extensions
    $extensions_arr = array("jpg","jpeg","png");

    $root_path = "../assets/studentregisteruploads/".$photoname; // storing image path to folder in root directory
    $db_path = "assets/studentregisteruploads/".$photoname; // storing image path into database
    $phone = $_POST['phone'];

    // Check if student already in system database
    $studentcheckquery = "SELECT * FROM tblstudents WHERE studentid = '$studentid'";
    $studentcheckqueryrun =  mysqli_query($conn, $studentcheckquery);
    $studentrow = mysqli_fetch_assoc($studentcheckqueryrun);

    if ($studentrow ['studentid'] ==  $studentid){
        $_SESSION['status'] = "Your ID Number is already registered in system's Database!";
        $_SESSION['type'] = "error";
        header ('Location: ../index.php');
 
}else{

if(in_array($student_image_type, $extensions_arr)){
// query to insert new student to system database
$sql = "INSERT INTO tblstudents
        (studentid,username, firstname, middlename, lastname,gender, level, program, password,photo,phone)
        VALUES ('$studentid','$username', '$firstname', '$middlename' ,'$lastname','$gender','$level', '$program' ,'$password', ' $db_path', '$phone')";
        
        move_uploaded_file($student_image_tempname, $root_path);

	if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "You've successfully registered!";
        $_SESSION['type'] = "success";
        header ('Location: ../index.php');
       
} else {
    $_SESSION['status'] = "There is an error in your registration process!";
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

  

// Student Login Handler

if (isset($_POST['studentlogin'])){

// checking values from database

$username = $_POST['username'];
$password = $_POST['password'];

// query to search for student in system database

$sql = "SELECT * FROM tblstudents WHERE username = '$username' AND password = '$password'";
$result = mysqli_query($conn, $sql);
// checking query status inside DB
if(mysqli_num_rows($result) > 0) {

$row = mysqli_fetch_assoc($result);
if($row['username'] === $username && $row['password'] === $password){
// creating session variables from Database
$_SESSION['id'] = $row['id'];
$_SESSION['studentid'] = $row['studentid'];
$_SESSION['username'] = $row['username'];
$_SESSION['firstname'] = $row['firstname'];
$_SESSION['middlename'] = $row['middlename'];
$_SESSION['lastname'] = $row['lastname'];
$_SESSION['gender'] = $row['gender'];
$_SESSION['program'] = $row['program'];
$_SESSION['level'] = $row['level'];
$_SESSION['photo'] = $row['photo'];
$_SESSION['phone'] = $row['phone'];

$_SESSION['status'] = "Welcome back online to your student portal!";
$_SESSION['type'] = "success";
header('Location:student-dashboard.php');
exit();

 } 
   }else{
    $_SESSION['status'] = "There was an error in your login attempt!";
    $_SESSION['type'] = "error";
    header('Location:../index.php');
   }

 }


// Query for updating personal records
if(isset($_POST['studentupdatestudent'])){
    
    $id = $_SESSION['id'];

    $username = $_POST['username'];
    $level = $_POST['level'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $photoname = $_FILES['photo']['name'];
    $tempname = $_FILES['photo']['tmp_name'];
    $folder = "../studentregisteruploads/".$photoname; // storing image path to folder in root directory
    $folderdb = "studentregisteruploads/".$photoname; // storing image path into database

    move_uploaded_file($tempname, $folder);

    $sql="UPDATE tblstudents
            SET username = '$username',
                level = '$level',
                phone = '$phone',
                password = '$password',
                photo = '$folderdb'  WHERE id = '$id'";
    
    if (mysqli_query($conn, $sql)) {
        header ('Location: ../student/student-update-record.php');
    } 

   
}

// Query for course signup
if(isset($_POST['studentcoursesignup'])){

    $studentid = $_POST['studentid'];
    $program = $_POST['program'];
    $level = $_POST['level'];
    $courseID = $_POST['coursename'];
    $tutor = $_POST['tutor'];

    // Check if alreday signup for course
    $coursecheckquery = "SELECT * FROM tblstudentcourses WHERE course_ID = '$courseID' AND student_ID = '$studentid'";
    $coursecheckqueryrun =  mysqli_query($conn,  $coursecheckquery);
    $coursecheckqueryrowcount = mysqli_num_rows( $coursecheckqueryrun);
    
    $courserow = mysqli_fetch_assoc($coursecheckqueryrun);

    if ($courserow['course_ID'] ==  $courseID){
        $_SESSION['status'] = "Already signup for this course!";
        $_SESSION['type'] = "error";
        header ('Location: student-courses.php');
 
}else{
   
    $sql = "INSERT INTO tblstudentcourses (student_ID,prog_ID,level_ID,course_ID,tut_ID)
    VALUES ('$studentid','$program','$level','$courseID','$tutor')";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "You've successfully signup for this course";
        $_SESSION['type'] = "success";
        header ('Location: student-courses.php');
    } else{
      $_SESSION['status'] = "Failed to signup for this course!";
      $_SESSION['type'] = "error";
      header ('Location: student-courses.php');
    }
}

   
}
// Query for course unsignup or course delete

if(isset($_GET['studentdeletecourse'])){
    $id = $_GET['studentdeletecourse'];
    $sql ="DELETE FROM tblstudentcourses WHERE student_courseID = '$id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "You've successfully unsign up for this course!";
        $_SESSION['type'] = "success";
        header ('Location: student-courses.php');
    } else{
        $_SESSION['status'] = "Failed to remove course!";
        $_SESSION['type'] = "error";
        header ('Location: student-courses.php');
    }
  }
?>


