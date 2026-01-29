<?php
$author = "Anthony Rivas";
$base_url = "http://127.0.0.1/vendingmachineservices_git";













date_default_timezone_set('America/New_York');
session_start();



if(isset($_SESSION['user_id']) && $_SESSION['user_id']){
  $user_id = $_SESSION['user_id'];

  $get_user = mysqli_query($conn, "SELECT * FROM users WHERE id = '$user_id'");
  $userdata = mysqli_fetch_assoc($get_user);

} else {
  $user_id = 0;

}




function logged_in( $role = false ){
  global $userdata;

  if(isset($_SESSION['user_id']) && $_SESSION['user_id']){

    if( isset( $role ) && $role && $role == "admin" ){
      if( isset( $userdata ) && is_array( $userdata ) && isset( $userdata['role'] ) && $userdata['role'] == "admin" ){
        return true;
      } else {
        return false;
      }

    } else {
      return true;
    }
    
  } else {
    return false;
  }
}










function email_exist( $email ){
  global $conn;
  $email_exist_query = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' ");

    if( $email_exist_query->num_rows > 0 ){
      return true;
    } else {
      return false;
    }
}

function username_exist( $username ){
  global $conn;
  $username_exist_query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' ");

    if( $username_exist_query->num_rows > 0 ){
      return true;
    } else {
      return false;
    }
}


if( isset( $_POST['action'] ) && $_POST['action'] == "register" ){
  $current_time = date('m/d/Y H:i:s');


  $errors = [];

  if( isset($_POST['firstname']) && $_POST['firstname'] ){
    $firstname = $_POST['firstname'];
  } else {
    $errors[] = "Firstname is required";
  }

  if( isset($_POST['lastname']) && $_POST['lastname'] ){
    $lastname = $_POST['lastname'];
  } else {
    $errors[] = "Lastname is required";
  }

  if( isset($_POST['email']) && $_POST['email'] ){
    $email = $_POST['email'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $errors[] = "Invalid Email Format";
    } else {
      if( email_exist( $email ) ){
        $errors[] = "Email is already taken";
      }
    }
    

  } else {
    $errors[] = "Email is required";
  }



  if( isset($_POST['username']) && $_POST['username'] ){

    $username = $_POST['username'];

    if( username_exist( $username ) ){
      $errors[] = "Username is already taken";
    }

  } else {
    $errors[] = "Username is required";
  }

  if( isset($_POST['password']) && $_POST['password'] ){

    if( isset($_POST['confirmpassword']) && $_POST['confirmpassword'] ){

      if( $_POST['password'] == $_POST['confirmpassword'] ){

        if( strlen( $_POST['password'] ) >= 8 ){
          if( strlen( $_POST['password'] ) > 32 ){
            $errors[] = "Password must not exceed 32 characters.";
          } else {
            $password = md5( $_POST['password'] );
          }
        } else {
          $errors[] = "Password must be atleast 8 characters.";
        }


      } else {
        $errors[] = "Password and confirm password doesn't match";
      }
      
    } else {
      $errors[] = "Confirm Password is required";
    }

  } else {
    $errors[] = "Password is required";
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
    
    $password = md5( $password );

    $register_query = 
      "
      INSERT INTO users 
      (
        firstname, 
        lastname,
        username,
        password,
        email,
        role,
        datetimeinserted
      ) 
      VALUES 
      (
        '$firstname', 
        '$lastname', 
        '$username', 
        '$password', 
        '$email', 
        'user', 
        '$current_time'
      )
      ";

    if (mysqli_query($conn, $register_query)) {
        $last_id = mysqli_insert_id($conn);



        $_SESSION['user_id'] = $last_id;
        echo "success";
        exit();
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      exit();
    }


  }


  exit();
}







function get_articles_feeds( $get_start=false, $get_end=false){
  global $conn;
  $articles = [];


  // if( isset( $get_start ) && $get_start ){
  //   $start = $get_start;
  // } else {
  //   $start = 0;
  // }


  // if( isset( $get_end ) && $get_end ){
  //   $end = $get_end;
  // } else {
  //   $end = 14;
  // }

  $get_articles = mysqli_query($conn, 
    "SELECT
        M.*,
        COUNT(J.id) AS comment_counts
    FROM
        articles AS M
    LEFT JOIN
        comments AS J ON M.id = J.article_id
    GROUP BY
        M.id -- Include all non-aggregated columns from the SELECT list in the GROUP BY clause
    ORDER BY
        M.datetimeinserted
        DESC;

    "
  );

  while( $the_articles = mysqli_fetch_assoc( $get_articles ) ){
    $articles[] = $the_articles;
  }

  return $articles;

}






function get_comments_by_article_id( $article_id ){
  global $conn;
  $comments = [];

  $get_comments = mysqli_query($conn, 
    "SELECT
        M.*,
        J.firstname AS firstname,
        J.lastname AS lastname
    FROM
        comments AS M
    LEFT JOIN
        users AS J ON M.user_id = J.id

    WHERE M.article_id = '$article_id'

    GROUP BY
        M.id -- Include all non-aggregated columns from the SELECT list in the GROUP BY clause

    ORDER BY
        M.datetimeinserted
        ASC;

    "
  );
  while( $the_comments = mysqli_fetch_assoc( $get_comments ) ){
    $comments[] = $the_comments;
  }
  return $comments;
}







function get_article_single( $article_id ){
  global $conn;

  // $get_article = mysqli_query($conn, "SELECT * FROM articles WHERE id = '$article_id' ");

  $get_article = mysqli_query($conn, 

    "SELECT
        M.*,
        COUNT(J.id) AS comment_counts
    FROM
        articles AS M
    LEFT JOIN
        comments AS J ON M.id = J.article_id

    WHERE M.id = '$article_id'

    GROUP BY
        M.id -- Include all non-aggregated columns from the SELECT list in the GROUP BY clause
    ORDER BY
        M.datetimeinserted
        DESC;

    "
  );
  $the_article = mysqli_fetch_assoc( $get_article );
  return $the_article;
}



function get_userdata_by_id( $id ){
  global $conn;

  $get_user = mysqli_query($conn, "SELECT * FROM users WHERE id = '$id'");
  $userdata = mysqli_fetch_assoc($get_user);

  return $userdata;
}














if( isset( $_POST['action'] ) && $_POST['action'] == "article-post" ){

  $current_time = date('m/d/Y H:i:s');
  global $conn;
  global $user_id;

  $errors = [];


  

  if( isset($_POST['article_title']) && $_POST['article_title'] ){
    $article_title = ucwords( $_POST['article_title'] );
  } else {
    $errors[] = "Article title cannot be empty.";
  }

  if( isset($_POST['article_description']) && $_POST['article_description'] ){
    $article_description = $_POST['article_description'];
  } else {
    $errors[] = "Article description cannot be empty.";
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

    if(isset($_FILES['article_img'])){
      $file_name = $_FILES['article_img']['name'];

      $file_size =$_FILES['article_img']['size'];
      $file_tmp =$_FILES['article_img']['tmp_name'];
      $file_type=$_FILES['article_img']['type'];
      $getting_extn = explode('.',$_FILES['article_img']['name']);
      $file_ext=strtolower(end($getting_extn));
      $article_pic = md5(date("YmDHis"))."x".rand(0,100).".".$file_ext;

      $extensions= array("png","jpg","jpeg");

      if(in_array($file_ext,$extensions) == true){
        if($file_size > 2097152){
          $errors[]='Article image size must be lower than 2 MB.';
        } else {
          move_uploaded_file($file_tmp,"assets/article_imgs/".$article_pic);
          $img_url = "/assets/article_imgs/".$article_pic;


          $sql = "INSERT INTO articles 
          (
            title, 
            description,
            img_url,
            posted_by_id,
            datetimeinserted
          ) 
          VALUES 
          (
            '$article_title', 
            '$article_description', 
            '$img_url', 
            '$user_id', 
            '$current_time'
          ) 
          ";


        
          if ($conn->query($sql) === TRUE) {
            echo "success";
            exit();
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }

        }

      } else {
        $errors[] = "We only allow Png, Jpeg, Jpg file types to be uploaded in profile picture";
      }
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
  }


  exit();
}



















if( isset( $_POST['action'] ) && $_POST['action'] == "comment" ){



  $current_time = date('m/d/Y H:i:s');


  $errors = [];



  if( isset($user_id) && $user_id ){
  } else {
    $errors[] = "You're not logged in, please refresh the page";
  }


  if( isset($_POST['article_id']) && $_POST['article_id'] ){
    $article_id = $_POST['article_id'];
  } else {
    $errors[] = "There has been error loading page data, please refresh the page";
  }


  if( isset($_POST['commentmsg']) && $_POST['commentmsg'] ){
    $commentmsg = $_POST['commentmsg'];

  } else {
    $errors[] = "Comment cannot be empty.";
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
    //insert data and return success

       $sql = "INSERT INTO comments 
      (
        article_id, 
        user_id,
        comment,
        datetimeinserted
      ) 
      VALUES 
      (
        '$article_id', 
        '$user_id', 
        '$commentmsg', 
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

       $sql = "INSERT INTO vending_machines_cta_entries 
      (
        firstname, 
        lastname,
        phone,
        email,
        zipcode,
        messagedata,
        
        posted_by_id,
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
        
        '$user_id',
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