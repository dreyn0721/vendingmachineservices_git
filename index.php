<?php
// Vars
$page = "home";
$pagetitle = "Home | Vending Machine Service";
$description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non euismod dolor. Integer sapien ipsum, dapibus eget bibendum sed nullam sodales.";




include("template-parts/header.php");
?>



<!-- ===== Hero Section ===== -->
<section class="hero section-divider">
  <div class="container">
    <div class="hero-card shadow">
      <h1>Vending Machine Service</h1>
      <p>Send us a message and get vending for your place.</p>

      <div class="stars mb-3">
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <i class="fa fa-star"></i>
        <span class="ms-2">5.0 Customer Rating</span>
      </div>

      <button class="btn btn-primary scroll-to-form">
        Schedule an appointment
      </button>
    </div>
  </div>
</section>

<!-- ===== What We Do ===== -->
<section class="py-5 section-divider" style="background:#f0f0f0;">
  <div class="container">
    <h2 class="section-title text-center">What We Do</h2>
    <div class="row align-items-center">
      <div class="col-md-6 mb-3">
        <img src="assets/img/usa-map.jpg" class="img-fluid rounded">
      </div>
      <div class="col-md-6">
        <h4>Managed Vending Machine Services for All 50 States</h4>
        <p>
          We provide vending services for businesses all across the United States.
          View our service areas for more information.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ===== FAQ ===== -->
<section class="py-5 section-divider" style="background:#F4F4F4;">
  <div class="container">
    <h2 class="section-title text-center">FAQ</h2>

    <div class="accordion" id="faqAccordion">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button" data-bs-toggle="collapse" data-bs-target="#faq1">
            How much does it cost?
          </button>
        </h2>
        <div id="faq1" class="accordion-collapse collapse show">
          <div class="accordion-body">
            With our full-service program, installation and ongoing service is entirely FREE.
            No set-up fees, no charges, no monthly bills.
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq2">
            How big are vending machines?
          </button>
        </h2>
        <div id="faq2" class="accordion-collapse collapse">
          <div class="accordion-body">
            The standard size measures about 72"x39"x33".
          </div>
        </div>
      </div>

      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#faq3">
            How many flavors does a vending machine have?
          </button>
        </h2>
        <div id="faq3" class="accordion-collapse collapse">
          <div class="accordion-body">
            Traditional stack machines hold 7–9 selections,
            while glass front machines can hold more.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ===== Contact ===== -->
<section id="contact" class="py-5" style="background:#f0f0f0;">
  <div class="container">
    <h2 class="section-title text-center">Contact Us</h2>

    <form class="row g-3 main-form">


      <div class="response-container">
      </div>


      <div class="col-md-6">
        <input class="form-control firstname" placeholder="First Name">
      </div>
      <div class="col-md-6">
        <input class="form-control lastname" placeholder="Last Name">
      </div>
      <div class="col-md-6">
        <input class="form-control email" placeholder="Email">
      </div>
      <div class="col-md-6">
        <input class="form-control phone" placeholder="Phone Number">
      </div>
      <div class="col-md-6">
        <input class="form-control zipcode" placeholder="Zip Code">
      </div>
      <div class="col-12">
        <textarea class="form-control message-data" rows="4" placeholder="Message"></textarea>
      </div>
      <div class="col-12 text-center">
        <button class="btn btn-primary submit-btn">
          Request a Call
        </button>
      </div>
    </form>
  </div>
</section>




<script type="text/javascript">
  jQuery( document ).ready(function(){


    jQuery(".submit-btn").on("click", function(e){
      e.preventDefault();

      var firstname = jQuery(".main-form .firstname").val();
      var lastname = jQuery(".main-form .lastname").val();

      var phone = jQuery(".main-form .phone").val();
      var email = jQuery(".main-form .email").val();
      var zipcode = jQuery(".main-form .zipcode").val();
      var messagedata = jQuery(".main-form .message-data").val();


      $.ajax({
        method: "POST",
        url: "",
        data: { 
          action:"entry", 
          firstname: firstname, 
          lastname: lastname , 
          email: email, 
          zipcode: zipcode, 
          phone: phone,
          messagedata: messagedata

        }
      }).done(function( response ) {
          if( response == "success" ){
            //location.reload();


            jQuery(".main-form .firstname").val("");
            jQuery(".main-form .lastname").val("");
            jQuery(".main-form .email").val("");
            jQuery(".main-form .phone").val("");
            jQuery(".main-form .zipcode").val("");
            jQuery(".main-form .message-data").val("");

            jQuery(".response-container").show();
            jQuery(".response-container").html("<p>Your form submitted successfully, we will send you an email shortly. <br>Thank you</p>");

          } else {
            jQuery(".response-container").show();
            jQuery(".response-container").html(response);
          }
      });



    });



  });
</script>



<?php include("template-parts/footer.php"); ?>