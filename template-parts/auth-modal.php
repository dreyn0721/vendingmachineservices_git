<!-- Auth Modal -->
<div class="modal fade" id="authModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md">
    <div class="modal-content auth-modal">

      <!-- Modal Header -->
      <div class="modal-header border-0">
        <h5 class="modal-title">Welcome</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>

      <!-- Tabs -->
      <ul class="nav nav-tabs auth-tabs" role="tablist">
        <li class="nav-item">
          <button class="nav-link active auth-tab-btn" data-bs-toggle="tab" data-bs-target="#loginTab">
            Login
          </button>
        </li>
        <li class="nav-item">
          <button class="nav-link auth-tab-btn" data-bs-toggle="tab" data-bs-target="#registerTab">
            Register
          </button>
        </li>
      </ul>

      <!-- Tab Content -->
      <div class="tab-content p-4">





        <!-- Login -->
        <div class="tab-pane fade show active login-form" id="loginTab">

        	<div class="modal-response-container"></div>

          <input type="text" class="username" placeholder="Username">
          <input type="password" class="password" placeholder="Password">
          <button class="auth-btn login-btn">Login</button>
        </div>

        <!-- Register -->
        <div class="tab-pane fade register-form" id="registerTab">

        	<div class="modal-response-container"></div>


          <input type="text" class="firstname" placeholder="Firstname">
          <input type="text" class="lastname" placeholder="Lastname">
          <input type="email" class="email" placeholder="Email address">
          <input type="text" class="username" placeholder="username">
          <input type="password" class="password" placeholder="Password">
          <input type="password" class="confirmpassword" placeholder="Confirm Password">

          <button class="auth-btn register-btn">Create Account</button>

        </div>

      </div>

    </div>
  </div>
</div>

<style type="text/css">
	/* Modal shell */
	.auth-modal {
	  background: linear-gradient(
	    145deg,
	    rgba(15,20,45,0.95),
	    rgba(5,8,25,0.95)
	  );
	  backdrop-filter: blur(18px);
	  border-radius: 20px;
	  box-shadow: 0 30px 70px rgba(0,0,0,0.6);
	  color: #fff;
	}

	/* Tabs */
	.auth-tabs {
	  border-bottom: 1px solid rgba(255,255,255,0.15);
	}

	.auth-tabs .nav-link {
	  border: none;
	  color: #b8c0ff;
	  font-weight: 500;
	}

	.auth-tabs .nav-link.active {
	  background: none;
	  color: #fff;
	  border-bottom: 2px solid var(--secondary);
	}

	/* Inputs */
	.auth-modal input {
	  width: 100%;
	  padding: 14px 16px;
	  margin-bottom: 14px;
	  border-radius: 12px;
	  border: none;
	  background: rgba(255,255,255,0.12);
	  color: #fff;
	  outline: none;
	}

	/* Button */
	.auth-btn {
	  width: 100%;
	  padding: 14px;
	  border-radius: 50px;
	  border: none;
	  font-weight: 600;
	  background: linear-gradient(90deg, var(--primary), var(--secondary));
	  color: #fff;
	  cursor: pointer;
	  transition: transform 0.25s ease, box-shadow 0.25s ease;
	}

	.auth-btn:hover {
	  transform: translateY(-2px);
	  box-shadow: 0 10px 30px rgba(0,229,255,0.45);
	}











.modal-response-container{
  display: none;
}

.modal-response-container ul{
  padding: 0;
  margin: 0;
}
.modal-response-container ul li{
  list-style-type: none;
  color: #fff;
  background-color: #DB2122;
  padding: 5px 30px;
  margin-bottom: 10px;
  border-radius: 10px;
}

.modal-response-container p{
  color: #fff;
  background-color: #316300;
  padding: 10px 30px;
  margin-bottom: 10px;
  border-radius: 10px;
}

</style>




<script type="text/javascript">
  jQuery( document ).ready(function(){


  	jQuery(".auth-tab-btn").click(function(){

      jQuery(".modal-response-container").hide();
      jQuery(".modal-response-container").html("");
  	})










    
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


            jQuery(".modal-response-container").show();
            jQuery(".modal-response-container").html("<p>Login successful.</p>");

            setTimeout(function() {
              window.location.href = "";
            }, 2000);

          } else {
            jQuery(".modal-response-container").show();
            jQuery(".modal-response-container").html(response);
          }
      });



    });











jQuery(".register-btn").on("click", function(e){
      e.preventDefault();



      var firstname = jQuery(".register-form .firstname").val();
      var lastname = jQuery(".register-form .lastname").val();
      var email = jQuery(".register-form .email").val();
      var username = jQuery(".register-form .username").val();
      var password = jQuery(".register-form .password").val();
      var confirmpassword = jQuery(".register-form .confirmpassword").val();


      $.ajax({
        method: "POST",
        url: "",
        data: { 
          action:"register", 
          firstname: firstname, 
          lastname: lastname, 
          email: email, 
          username: username, 
          password: password, 
          confirmpassword: confirmpassword
        }
      }).done(function( response ) {
          if( response == "success" ){
            //location.reload();


            jQuery(".modal-response-container").show();
            jQuery(".modal-response-container").html("<p>Registration successful. Logging in...</p>");

            setTimeout(function() {
              window.location.href = "";
            }, 3000);

          } else {
            jQuery(".modal-response-container").show();
            jQuery(".modal-response-container").html(response);
          }
      });



    });



  });
</script>