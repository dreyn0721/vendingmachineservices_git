<?php
// Vars
$page = "login";
$pagetitle = "Login | Vending Machine Service";
$description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non euismod dolor. Integer sapien ipsum, dapibus eget bibendum sed nullam sodales.";


include("template-parts/header-admin.php");

if( logged_in() ){
  header("Location: dashboard.php");
}

?>

    <div class="login-container">

      <h2>Sign In</h2>

      <form class="login-form">

        <div class="response-container"></div>


        <div class="input-group">
          <label for="username">Username</label>
          <input type="text" id="username" class="username">
        </div>

        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" class="password">
        </div>

        <button type="submit" class="login-btn">Login</button>
      </form>
    </div>


























    <style>

      body {
        background: linear-gradient(235deg, #1e3c72, #002469);
      }


      .login-container {
        background: #ffffff;
        width: 100%;
        max-width: 380px;
        padding: 40px;
        border-radius: 12px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        text-align: center;
        margin: 150px auto 0 auto;
      }


      .login-container h2 {
        margin-bottom: 25px;
        font-weight: 600;
        color: #333;
      }

      .input-group {
        margin-bottom: 20px;
        text-align: left;
      }

      .input-group label {
        display: block;
        margin-bottom: 6px;
        font-size: 14px;
        color: #555;
      }

      .input-group input {
        width: 100%;
        padding: 12px 14px;
        border-radius: 8px;
        border: 1px solid #ccc;
        font-size: 15px;
        transition: border-color 0.3s, box-shadow 0.3s;
      }

      .input-group input:focus {
        outline: none;
        border-color: #2a5298;
        box-shadow: 0 0 0 2px rgba(42, 82, 152, 0.15);
      }

      .login-btn {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        border: none;
        background: #2a5298;
        color: #ffffff;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.3s, transform 0.1s;
      }

      .login-btn:hover {
        background: #1e3c72;
      }

      .login-btn:active {
        transform: scale(0.98);
      }
    </style>







<script type="text/javascript">
  jQuery( document ).ready(function(){


    jQuery(".login-btn").on("click", function(e){
      e.preventDefault();

      var username = jQuery(".login-form .username").val();
      var password = jQuery(".login-form .password").val();



      $.ajax({
        method: "POST",
        url: "",
        data: { 
          action:"login", 
          username: username, 
          password: password
        }
      }).done(function( response ) {
          if( $.isNumeric( response ) ){
            //location.reload();


            jQuery(".response-container").show();
            jQuery(".response-container").html("<p>Login successful.</p>");

            setTimeout(function() {
              window.location.href = "<?php echo $base_url;?>/dashboard.php";
            }, 2000);

          } else {
            jQuery(".response-container").show();
            jQuery(".response-container").html(response);
          }
      });



    });



  });
</script>





<?php include("template-parts/footer-admin.php"); ?>
