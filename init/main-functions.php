<?php
$author = "Anthony Rivas";
$base_url = "http://127.0.0.1/vendingmachineservices_git";













date_default_timezone_set('America/New_York');
session_start();




if(isset($_SESSION['user_id']) && $_SESSION['user_id']){
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = 0;
}




function logged_in(){
  if(isset($_SESSION['user_id']) && $_SESSION['user_id']){
    return true;
  } else {
    return false;
  }
}



function get_business_valuation_exit_entry(){

  global $conn;

  $entries = [];
  $start = 0;
  $end = 50;

  $get_entries = mysqli_query($conn, "SELECT * FROM business_valuation_exit_entry WHERE id >= '$start' AND id <= '$end'");
  while( $the_entry = mysqli_fetch_assoc( $get_entries ) ){
    $entries[] = $the_entry;
  }

  return $entries;
}










function get_commercial_real_estate_entry(){

  global $conn;

  $entries = [];
  $start = 0;
  $end = 50;

  $get_entries = mysqli_query($conn, "SELECT * FROM commercial_real_estate_entry WHERE id >= '$start' AND id <= '$end'");
  while( $the_entry = mysqli_fetch_assoc( $get_entries ) ){
    $entries[] = $the_entry;
  }

  return $entries;
}









function get_real_estate_disposition_opportunities_entry(){

  global $conn;

  $entries = [];
  $start = 0;
  $end = 50;

  $get_entries = mysqli_query($conn, "SELECT * FROM real_estate_disposition_opportunities_entry WHERE id >= '$start' AND id <= '$end'");
  while( $the_entry = mysqli_fetch_assoc( $get_entries ) ){
    $entries[] = $the_entry;
  }

  return $entries;
}









function get_residential_real_estate_entry(){

  global $conn;

  $entries = [];
  $start = 0;
  $end = 50;

  $get_entries = mysqli_query($conn, "SELECT * FROM residential_real_estate_entry WHERE id >= '$start' AND id <= '$end'");
  while( $the_entry = mysqli_fetch_assoc( $get_entries ) ){
    $entries[] = $the_entry;
  }

  return $entries;
}



























if( isset( $_POST['action'] ) && $_POST['action'] == "login" ){

  $errors = [];

  if( isset($_POST['username']) && $_POST['username'] ){
    $username = $_POST['username'];
  } else {
    $errors[] = "Username is required";
  }

  if( isset($_POST['password']) && $_POST['password'] ){
    $password = $_POST['password'];
  } else {
    $errors[] = "Password is required";
  }


  if( isset( $username ) && $username && isset( $password ) && $password ){
    $password = md5( $password );

    $login_query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' AND password = '$password' ");

    if( $login_query->num_rows > 0 ){
      $user = mysqli_fetch_assoc( $login_query );

      $_SESSION['user_id'] = $user['id'];

      echo $user['id'];
      exit();
      
    } else {

      $errors[] = "Invalid username or password";


    }

  }

  if( isset( $errors ) && is_array( $errors ) && count( $errors ) > 0 ){
    //make html error for return
    $html = "<ul>";

    foreach( $errors as $error ){
      $html .= "<li>".$error."</li>";
    }

    $html .= "</ul>";

    echo $html;
    exit();
  } else {
    echo "Something wen't wrong";
    exit();
  }


}































if( isset( $_POST['action'] ) && $_POST['action'] == "entry" ){
  $current_time = date('m/d/Y H:i:s');


  $errors = [];

  if( isset($_POST['firstname']) && $_POST['firstname'] ){
    $firstname = $_POST['firstname'];
  } else {
    $errors[] = "first name cannot be empty.";
  }

  if( isset($_POST['lastname']) && $_POST['lastname'] ){
    $lastname = $_POST['lastname'];
  } else {
    $errors[] = "last name cannot be empty.";
  }

  if( isset($_POST['email']) && $_POST['email'] ){
    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid Email Format";
    }

  } else {
    $errors[] = "Email cannot be empty.";
  }


  if( isset($_POST['phone']) && $_POST['phone'] ){
    $phone = $_POST['phone'];

  } else {
    $errors[] = "Phone cannot be empty.";
  }


  if( isset($_POST['messagedata']) && $_POST['messagedata'] ){
    $messagedata = $_POST['messagedata'];

  } else {
    $errors[] = "Message cannot be empty.";
  }


  if( isset($_POST['zipcode']) && $_POST['zipcode'] ){
    $zipcode = $_POST['zipcode'];

  } else {
    $errors[] = "Zipcode cannot be empty.";
  }





  if( isset( $errors ) && is_array( $errors ) && count( $errors ) > 0 ){
    //make html error for return
    $html = "<ul>";

    foreach( $errors as $error ){
      $html .= "<li>".$error."</li>";
    }

    $html .= "</ul>";

    echo $html;

  } else {
    //insert data and return success

       $sql = "INSERT INTO virtualdominance 
      (
        firstname, 
        lastname,
        phone,
        email,
        zipcode,
        messagedata,
        datetimeinserted
      ) 
      VALUES 
      (
        '$firstname', 
        '$lastname', 
        '$phone', 
        '$email', 
        '$zipcode', 
        '$messagedata', 
        '$current_time'
      ) 
      ";
        
        if ($conn->query($sql) === TRUE) {
          echo "success";
        } else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }



  }




  

  exit();
}


?>