<?php
    session_start(); // starting a session
   require '../includes/connection.php';

  if (isset($_POST['adminlogin'])){
         
      // checking values from database
  
      $username = $_POST['username'];
      $password = $_POST['password'];
  
  // query to search for student in system database
      
  $sql = "SELECT * FROM tbladmin WHERE username = '$username' AND password = '$password'";
  $result = mysqli_query($conn, $sql);
        // checking query status inside DB
            if(mysqli_num_rows($result) > 0) {
        
            $row = mysqli_fetch_assoc($result);
                  if($row['username'] === $username && $row['password'] === $password){
                   
                    // creating session variables
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['firstname'] = $row['firstname'];
                    $_SESSION['lastname'] = $row['lastname'];
                    $_SESSION['middlename'] = $row['middlename'];
                    $_SESSION['program'] = $row['program'];
                    $_SESSION['studentyr'] = $row['studentyr'];
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['photo'] = $row['photo'];

                $_SESSION['status'] = "Welcome back online Admin!";
                $_SESSION['type'] = "success";
                    header('Location:admin-dashboard.php');
                    exit();
                  }
                } else{
                   $_SESSION['status'] = "There was an error in your login attempt!";
                   $_SESSION['type'] = "error";
                   header('Location:../index.php');
               }
                }

if (isset($_POST['modaladdstudent'])){  

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

    if ($studentrow['studentid'] ==  $studentid){
        $_SESSION['status'] = "Student already in system's Database!";
        $_SESSION['type'] = "error";
        header ('Location: admin-add-student.php');
 
}else{

if(in_array($student_image_type, $extensions_arr)){
// query to insert new student to system database
$sql = "INSERT INTO tblstudents
        (studentid,username, firstname, middlename, lastname,gender, level, program, password,photo,phone)
        VALUES ('$studentid','$username', '$firstname', '$middlename' ,'$lastname','$gender','$level', '$program' ,'$password', ' $db_path', '$phone')";
        
        move_uploaded_file($student_image_tempname, $root_path);

	if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "Student successfully registered!";
        $_SESSION['type'] = "success";
        header ('Location: admin-add-student.php');
       
} else {
    $_SESSION['status'] = "Failed to register student!";
    $_SESSION['type'] = "error";
    header ('Location: admin-add-student.php');
   }
}else{
    $_SESSION['status'] = "Image type not supported - Supported image type (jpg, jpeg, png)!";
    $_SESSION['type'] = "error";
    header ('Location: admin-add-student.php');
}

}
  }


// delete student action using the $_GET variable : ADMIN
if(isset($_GET['deletestudent'])){
    $id = $_GET['deletestudent'];
    $sql ="DELETE FROM tblstudents  WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "Student successfully removed";
        $_SESSION['type'] = "success";
        header ('Location: admin-add-student.php');
    } else{
        $_SESSION['status'] = "Failed to remove student";
        $_SESSION['type'] = "error";
        header ('Location: admin-add-student.php');
    }
}

// Query to update student records inside DB : ADMIN
if(isset($_POST['modalupdatestudent'])){
    
    $id = $_POST['updateid'];

    $studentid = $_POST['studentid'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $level = $_POST['level'];
    $program = $_POST['program'];
    $photoname = $_FILES['photo']['name'];
    $tempname = $_FILES['photo']['tmp_name'];
    $folder = "../studentregisteruploads/".$photoname; // storing image path to folder in root directory
    $folderdb = "studentregisteruploads/".$photoname; // storing image path into database

    move_uploaded_file($tempname, $folder);

    $sql="UPDATE tblstudents 
            SET studentid = '$studentid',
                firstname = '$firstname',
                lastname = '$lastname',
                level = '$level',
                program = '$program',
                photo = '$folderdb'  WHERE id = '$id'";
    
    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "Student details successfully updated";
        header ('Location: ../admin/admin-add-student.php');
    } else{
      $_SESSION['status'] = "Failed to update student details!";
      header ('Location: ../admin/admin-add-student.php');
    }

   
}

// Query to add course into Database : ADMIN
if (isset($_POST['modaladdcourse'])){
   // capturing input values
   $coursecode = $_POST['coursecode'];
   $coursename = $_POST['coursename'];
   $credithour = $_POST['credithour'];
   $tutor = $_POST['tutor'];
   $semester = $_POST['semester'];
   $level = $_POST['level'];
   $program = $_POST['program'];
   $courseimage = $_FILES['photo']['name'];
   $courseimage_tempname = $_FILES['photo']['tmp_name'];

     // checking image file type
     $course_image_type = strtolower(pathinfo($courseimage, PATHINFO_EXTENSION));
     // valid file extensions
    $extensions_arr = array("jpg","jpeg","png");

    $root_path = "../assets/courseimagesuploads/".$courseimage; // storing image path to folder in root directory
    $db_path = "assets/courseimagesuploads/".$courseimage; // storing image path into database

    if(in_array($course_image_type, $extensions_arr)){

   // Insert course string
   $sql = "INSERT INTO tblcourses (course_code,course_name,credit_hour,tut_ID,sem_ID,level_ID,prog_ID,courseimage)
            VALUES ('$coursecode','$coursename','$credithour','$tutor','$semester','$level','$program','$db_path')";
  
      move_uploaded_file($courseimage_tempname, $root_path);

   if (mysqli_query($conn, $sql)) {
    $_SESSION['status'] = "Course successfully added";
    $_SESSION['type'] = "success";
    header('Location: admin-add-course.php');
} else{
    $_SESSION['status'] = "Failed to add course!";
    $_SESSION['type'] = "error";
    header('Location: admin-add-course.php');
}
  }
}
 
// Query to update course values inside DB : ADMIN
if(isset($_POST['modalupdatecourse'])){
    
  $id = $_POST['updateid'];
  $photoname = $_FILES['photo']['name'];
  $tempname = $_FILES['photo']['tmp_name'];
  $folder = "../courseimagesuploads/".$photoname; // storing image path to folder in root directory
  $folderdb = "courseimagesuploads/".$photoname; // storing image path into database

 move_uploaded_file($tempname, $folder);
  $coursecode = $_POST['coursecode'];
  $coursename = $_POST['coursename'];
  $credithour = $_POST['credithour'];
  $tutor = $_POST['tutor'];

  $sql="UPDATE tblcourses SET courseimage = '$folderdb',
              course_code = '$coursecode',
              course_name = '$coursename',
              credit_hour = '$credithour',
              tut_ID = '$tutor'  WHERE Course_ID = '$id'";
  
  if (mysqli_query($conn, $sql)) {
    $_SESSION['status'] = "Course successfully updated!";
    header('Location: ../admin/admin-add-course.php');
  } else{
    $_SESSION['status'] = "Failed to update course!";
    header('Location: ../admin/admin-add-course.php');
  }

 
}

// delete course action using the $_GET variable : ADMIN
if(isset($_GET['deletecourse'])){
    $id = $_GET['deletecourse'];
    $sql ="DELETE FROM tblcourses WHERE Course_ID = '$id'";
    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "Course successfully removed";
        $_SESSION['type'] = "success";
        header ('Location: admin-add-course.php');
    } else{
        $_SESSION['status'] = "Failed to remove course!";
        $_SESSION['type'] = "error";
        header ('Location: admin-add-course.php');
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
      header ('Location: admin-add-faculty.php');

}else{

if(in_array($tutor_image_type, $extensions_arr)){

// query to insert new faculty into system database
 $sql = "INSERT INTO tbltutor
          (username, firstname, lastname, designation, password,gender,email,photo,phone)
	        VALUES ('$username', '$firstname','$lastname','$designation','$password','$gender','$email','$db_path', '$phone')";
  move_uploaded_file( $tutor_image_tempname, $root_path);

	if (mysqli_query($conn, $sql)) {
    $_SESSION['status'] = "Tutor successfully registered";
    $_SESSION['type'] = "success";
    header ('Location: admin-add-faculty.php');
} else{
  $_SESSION['status'] = "Failed to register tutor!";
  $_SESSION['type'] = "error";
  header ('Location: admin-add-faculty.php');
 }
}else{
  $_SESSION['status'] = "Image type not supported - Supported image type (jpg, jpeg, png)!";
  $_SESSION['type'] = "error";
  header ('Location: admin-add-faculty.php');
} 
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

  
// Query to add head of department message DB : ADMIN
if (isset($_POST['modalsubmitmessage']))
{  
    $hodname = $_POST['hodname'];
    $hodmessage = $_POST['hodmessage'];
    // Image type 
    $hodimage = $_FILES['hodimage']['name'];
    $hodimage_tempname = $_FILES['hodimage']['tmp_name'];

     // checking image file type
     $hodimage_type = strtolower(pathinfo( $hodimage, PATHINFO_EXTENSION));
     // valid file extensions
    $extensions_arr = array("jpg","jpeg","png");

    $root_path = "../assets/images/".$hodimage; // storing image path to folder in root directory
    $db_path = "assets/images/".$hodimage; // storing image path into database
   

if(in_array($hodimage_type, $extensions_arr)){

// query to insert new faculty into system database
 $sql = "INSERT INTO tblstudentmessage (hodimage, hodname, hodmessage) VALUES ('$db_path', '$hodname','$hodmessage')";
  move_uploaded_file( $hodimage_tempname, $root_path);

	if (mysqli_query($conn, $sql)) {
    $_SESSION['status'] = "Head of department's message successfully set!";
    $_SESSION['type'] = "success";
    header ('Location: admin-add-quote.php');
} else{
  $_SESSION['status'] = "Failed to set Head of department's message !";
  $_SESSION['type'] = "error";
  header ('Location: admin-add-quote.php');
 }
}else{
  $_SESSION['status'] = "Image type not supported - Supported image type (jpg, jpeg, png)!";
  $_SESSION['type'] = "error";
  header ('Location: admin-add-quote.php');
} 
  } 

  // delete head of department message using the $_GET variable : ADMIN
if(isset($_GET['removemessage'])){
  $id = $_GET['removemessage'];
  $sql ="DELETE FROM tblstudentmessage WHERE messageID = '$id'";
  if (mysqli_query($conn, $sql)) {
    $_SESSION['status'] = "Message successfully removed!";
    $_SESSION['type'] = "success";
    header ('Location: admin-add-quote.php');
  } else{
    $_SESSION['status'] = "Failed to remove message!";
    $_SESSION['type'] = "error";
    header ('Location: admin-add-quote.php');
  }
}

?>