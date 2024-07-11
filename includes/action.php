<?php
session_start();
require 'connection.php';
 /* ADMIN CONTROLLER SECTION */




// delete course action using the $_GET variable : ADMIN
if(isset($_GET['deletecourse'])){
    $id = $_GET['deletecourse'];
    $sql ="DELETE FROM tblcourses WHERE Course_ID = '$id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "Course successfully removed";
        header ('Location: ../admin/admin-add-course.php');
    } else{
        $_SESSION['status'] = "Failed to remove course!";
        header ('Location: ../admin/admin-add-course.php');
    }
}


// Query to add course material inside DB : ADMIN
 if (isset($_POST['modaladdmaterial'])){
    // capturing input values
    $filename = $_POST['filename'];
    $filecontent = $_FILES['filecontent'];
    $tutor = $_POST['tutor'];
    $program = $_POST['program'];
    $level = $_POST['level'];
    $semester = $_POST['semester'];
    $filecontent = $_FILES['filecontent']['name'];
    $tempname = $_FILES['filecontent']['tmp_name'];
    $folder = "../studentmaterialuploads/".$filecontent; // storing image path to folder in root directory
    $folderdb = "studentmaterialuploads/".$filecontent; // storing image path into database

    move_uploaded_file($tempname, $folder);
    // query string
    $sql = "INSERT INTO tblcoursematerial (matname,matcontent,tut_ID,prog_ID,level_ID,sem_ID) 
    VALUES ('$filename','$folderdb','$tutor','$program','$level','$semester')";
  
  if (mysqli_query($conn, $sql)) {
    $_SESSION['status'] = "Material successfully added";
    header('Location: ../admin/admin-add-material.php');
} else{
    $_SESSION['status'] = "Failed to add material!";
    header('Location: ../admin/admin-add-material.php');
}
  }

  // delete material action using the $_GET variable : ADMIN
if(isset($_GET['deletematerial'])){
    $id = $_GET['deletematerial'];
    $sql ="DELETE FROM tblcoursematerial WHERE mat_ID = '$id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "Material successfully removed";
        header ('Location: ../admin/admin-add-material.php');
    } 
}


// Query to add faculty inside DB : ADMIN
if (isset($_POST['modaladdfaculty']))
{  

    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $designation = $_POST['designation'];
    $password = $_POST['password'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $photoname = $_FILES['photo']['name'];
    $tempname = $_FILES['photo']['tmp_name'];
    $folder = "../facultyregisteruploads/".$photoname; // storing image path to folder in root directory
    $folderdb = "facultyregisteruploads/".$photoname; // storing image path into database
    $phone = $_POST['phone'];

    move_uploaded_file($tempname, $folder);

// query to insert new faculty into system database
 $sql = "INSERT INTO tbltutor
          (username, firstname, lastname, designation, password,gender,email,photo,phone)
	        VALUES ('$username', '$firstname','$lastname','$designation','$password','$gender','$email','$folderdb', '$phone')";

	if (mysqli_query($conn, $sql)) {
    $_SESSION['status'] = "Tutor successfully added";
    header ('Location: ../admin/admin-add-faculty.php');
       
} else{
  $_SESSION['status'] = "Failed to add tutor!";
  header ('Location: ../admin/admin-add-faculty.php');
}
  } 
  
// Query to update faculty records inside DB : ADMIN
if(isset($_POST['modalupdatefaculty'])){
    
    $id = $_POST['updateid'];
  
    $photo = $_POST['photo'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $photoname = $_FILES['photo']['name'];
    $tempname = $_FILES['photo']['tmp_name'];
    $folder = "../facultyregisteruploads/".$photoname; // storing image path to folder in root directory
    $folderdb = "facultyregisteruploads/".$photoname; // storing image path into database
    $phone = $_POST['phone'];

    move_uploaded_file($tempname, $folder);

    $sql="UPDATE  tbltutorr SET photo = '$folderdb',
                email = '$email',
                phone = '$phone' WHERE id = '$id'";
    
    if (mysqli_query($conn, $sql)) {
      $_SESSION['status'] = "Tutor successfully updated";
      header('Location: ../admin/admin-add-faculty.php');
    } else{
      $_SESSION['status'] = "Failed to upadte tutor details!";
      header('Location: ../admin/admin-add-faculty.php');
    }
  
   
  }

  
// delete faculty action using the $_GET variable : ADMIN
if(isset($_GET['deletefaculty'])){
    $id = $_GET['deletefaculty'];
    $sql ="DELETE FROM  tbltutor WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "Tutor successfully removed!";
        header ('Location: ../admin/admin-add-faculty.php');
    } else{
        $_SESSION['status'] = "Failed to remove tutor!";
        header ('Location: ../admin/admin-add-faculty.php');
    }
}



  // Query to insert news into system database : ADMIN
  if (isset($_POST['modaladdnews'])){
    // capturing input values
    $posttitle = $_POST['posttitle'];
    $postauthor = $_POST['postauthor'];
    $postcontent = $_POST['postcontent'];
    $date_published = date("Y-m-d H:i:s");
    
 // query string
    $sql = "INSERT INTO tblnews (posttitle,postauthor,postcontent,date_published) 
    VALUES ('$posttitle','$postauthor','$postcontent','$date_published')";
  
  if (mysqli_query($conn, $sql)) {
    $_SESSION['status'] = "Annoucement successfully made!";
    header('Location: ../admin/admin-add-news.php');
} else{
    $_SESSION['status'] = "Fail to add announcement!";
    header('Location: ../admin/admin-add-news.php');
}
  }
// delete news action using the $_GET variable : ADMIN
if(isset($_GET['deletenews'])){
    $id = $_GET['deletenews'];
    $sql ="DELETE FROM tblnews WHERE news_ID = '$id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "News successfully deleted!";
        header ('Location: ../admin/admin-add-news.php');
    } 
}


  // query to insert student grades into system database : ADMIN
 if (isset($_POST['modaladdgrade'])){
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
    header('Location: ../admin/admin-add-firstgrades.php');
} else{
  $_SESSION['status'] = "Failed to add student grades!";
  header('Location: ../admin/admin-add-firstgrades.php');
}
  }



  // Query to set student message into Database : ADMIN
if (isset($_POST['modalsubmitmessage'])){
    // capturing input values
    $studentID = $_POST['studentID'];
    $studentmessage = $_POST['studentmessage'];
 
    // query string
    $sql = "INSERT INTO tblstudentmessage (stud_ID,message)
             VALUES ('$studentID','$studentmessage')";
 
    if (mysqli_query($conn, $sql)) {
     header('Location: ../admin/admin-add-quote.php');
 } 
 
  }

  
 /* FACULTY CONTROLLER SECTION */



  

// delete course action using the $_GET variable : ADMIN
if(isset($_GET['studentdeletecourse'])){
  $id = $_GET['studentdeletecourse'];
  $sql ="DELETE FROM tblstudentcourses WHERE student_courseID = '$id'";
  if (mysqli_query($conn, $sql)) {
      $_SESSION['status'] = "You've successfully unsign up for this course!";
      header ('Location: ../student/student-courses.php');
  } else{
      $_SESSION['status'] = "Failed to remove course!";
      header ('Location: ../student/student-courses.php');
  }
}
?>