<!-- ===== Footer ===== -->
<footer class="pt-5">
  <div class="container">
    <div class="row">
      <div class="col-md-4 mb-3">
        <img src="https://dummyimage.com/200x80/000/fff&text=LOGO">
      </div>

      <div class="col-md-4 mb-3">
        <h5>Services</h5>
        <ul class="list-unstyled">
          <li>Office Vending</li>
          <li>Micro Markets</li>
          <li>Snack Machines</li>
          <li>Drink Machines</li>
        </ul>
      </div>

      <div class="col-md-4 mb-3">
        <h5>Quick Links</h5>
        <ul class="list-unstyled">
          <li><a href="#">About Us</a></li>
          <li><a href="#">Blog</a></li>
          <li><a href="#">Media</a></li>
          <li><a href="#contact" class="scroll-to-form">Contact Us</a></li>
          <li><a href="#">Terms & Conditions</a></li>
          <li><a href="#">Privacy Policy</a></li>
        </ul>
      </div>
    </div>
  </div>

  <div class="footer-bottom">
    © All rights reserved
  </div>
</footer>


<script>
$(".scroll-to-form").on("click", function(){
  $('html, body').animate({
    scrollTop: $("#contact").offset().top - 80
  }, 700);
});
</script>

</body>
</html>