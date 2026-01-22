<?php
$author = "Anthony Rivas";
$base_url = "http://127.0.0.1/boldwolfenterprises_git";













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


  if( isset($_POST['message']) && $_POST['message'] ){
    $message = $_POST['message'];

  } else {
    $errors[] = "Message cannot be empty.";
  }







  if( isset( $_POST['businessvaluation'] ) && $_POST['businessvaluation'] ){
    $businessvaluation = $_POST['businessvaluation'];
  } else {
    $businessvaluation = "0";
  }

  if( isset( $_POST['selling'] ) && $_POST['selling'] ){
    $selling = $_POST['selling'];
  } else {
    $selling = "0";
  }

  if( isset( $_POST['buying'] ) && $_POST['buying'] ){
    $buying = $_POST['buying'];
  } else {
    $buying = "0";
  }

  if( isset( $_POST['other'] ) && $_POST['other'] ){
    $other = $_POST['other'];
  } else {
    $other = "0";
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

      mysqli_query($conn, "INSERT INTO residential_real_estate_entry 
      (
        firstname, 
        lastname,
        phone,
        email,
        message,


        datetimeinserted,
        businessvaluation,
        selling,
        buying,
        other
      ) 
      VALUES 
      (
        '$firstname', 
        '$lastname', 
        '$phone', 
        '$email', 
        '$message', 



        '$current_time',
        '$businessvaluation',
        '$selling',
        '$buying',
        '$other'
      ) 
      ");

      echo "success";


  }




  

  exit();
}

?>