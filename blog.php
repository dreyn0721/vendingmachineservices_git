<?php
// Vars
$page = "blogs";
$pagetitle = "Blogs | AI consultation";
$description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non euismod dolor. Integer sapien ipsum, dapibus eget bibendum sed nullam sodales.";




include("template-parts/header.php");
?>

<h1 class="page-title">Blog</h1>



<!-- Blog Form -->
<?php if( isset( $userdata['role'] ) && $userdata['role'] && $userdata['role'] == "admin" ): ?>
<div class="blog-form">
  <h2>Create a Blog Post</h2>



  <form class="form-grid article-form" method="post" action="">

    <div class="response-container">
    </div>
    <input type="hidden" name="action" value="article-post">


    <input type="text" class="article-title" name="article_title" placeholder="Blog Title">


    <div class="upload-wrapper">
      <input type="file" id="imageUpload" name="article_img" accept="image/*" hidden>
      
      <label for="imageUpload" class="upload-box">
        <i class="fa-solid fa-cloud-arrow-up"></i>
        <span>Upload blog image</span>
        <small>PNG, JPG, WEBP</small>
      </label>

      <div class="image-preview" id="imagePreview">
        <div class="upload-spinner" id="uploadSpinner">
          <i class="fa fa-spinner" aria-hidden="true"></i>
        </div>
        <img id="previewImg" alt="Preview">
      </div>


    </div>


    <textarea name="article_description" class="article-description" placeholder="Write your blog description..." rows="8"></textarea>
  </form>
  <button class=" article-submit-btn"><i class="fa fa-pencil-square-o"></i> Publish Post</button>
</div>


<script type="text/javascript">
  const imageUpload = document.getElementById('imageUpload');
  const imagePreview = document.getElementById('imagePreview');
  const previewImg = document.getElementById('previewImg');
  const uploadSpinner = document.getElementById('uploadSpinner');

  imageUpload.addEventListener('change', () => {
    const file = imageUpload.files[0];
    if (!file) return;

    // Show preview container + spinner
    imagePreview.style.display = 'block';
    uploadSpinner.style.display = 'flex';
    previewImg.style.display = 'none';

    const reader = new FileReader();

    reader.onload = () => {
      // Simulate realistic loading delay (optional but nice UX)
      setTimeout(() => {
        previewImg.src = reader.result;
        uploadSpinner.style.display = 'none';
        previewImg.style.display = 'block';
      }, 600);
    };

    reader.readAsDataURL(file);
  });
</script>



<?php endif; ?>








<!-- Blog Cards -->
<div class="blog-container">
  <?php 

  $the_articles = get_articles_feeds();

  foreach( $the_articles as $the_article ): ?>

    <a href="<?=$base_url;?>/blog-single.php?id=<?=$the_article['id'];?>" class="blog-card">

      <div class="image-wrapper">
        <div class="image-loader">
          <i class="fa fa-spinner" aria-hidden="true"></i>
        </div>
        <img src="<?php echo $base_url.$the_article['img_url']; ?>" loading="lazy">
      </div>

      
      <div class="blog-content">
        <h3><?php echo $the_article['title'];?></h3>
        <div class="date"><?php echo date("M d Y h:i A", strtotime( $the_article['datetimeinserted'] ));?></div>
        <p><?php  
          if( strlen( $the_article['description'] ) > 150 ){
            echo substr($the_article['description'], 0, 150)."...";
          } else {
            $the_article['description'];
          }
            

          ?></p>
      </div>
      <div class="blog-footer">
        <!-- <span><i class="fa fa-heart"></i> 3</span> -->
        <span><i class="fa fa-comment"></i> <?=$the_article['comment_counts'];?></span>
      </div>
    </a>

  <?php endforeach; ?>

  




</div>


<style>
:root {
  --primary: #6c63ff;
  --secondary: #00e5ff;
  --bg: #0b0f1a;
  --card-bg: rgba(255,255,255,0.08);
  --glass: rgba(255,255,255,0.12);
  --text: #ffffff;
  --muted: #b9c0d4;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Inter', sans-serif;
}

body {
  background: radial-gradient(circle at top, #141b34, var(--bg));
  color: var(--text);
  min-height: 100vh;
}

/* ===== Page Title ===== */
.page-title {
  text-align: center;
  padding: 40px 20px 20px;
  font-size: 2.8rem;
  font-weight: 700;
  background: linear-gradient(90deg, var(--secondary), var(--primary));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

/* ===== Blog Form ===== */
.blog-form {
  max-width: 1100px;
  margin: 30px auto;
  padding: 30px;
  background: linear-gradient(145deg, rgba(255,255,255,0.15), rgba(255,255,255,0.05));
  border-radius: 20px;
  backdrop-filter: blur(18px);
  box-shadow: 0 20px 40px rgba(0,0,0,0.4);
}

.blog-form h2 {
  margin-bottom: 20px;
  font-size: 1.6rem;
}

.blog-form .form-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
  gap: 20px;
}

.blog-form input,
.blog-form textarea {
  width: 100%;
  padding: 14px 16px;
  border-radius: 12px;
  border: none;
  outline: none;
  background: var(--glass);
  color: var(--text);
  font-size: 0.95rem;
}

.blog-form textarea {
  grid-column: 1 / -1;
  resize: none;
}

.blog-form button {
  margin-top: 20px;
  padding: 14px 28px;
  border: none;
  border-radius: 50px;
  font-size: 1rem;
  font-weight: 600;
  cursor: pointer;
  color: #fff;
  background: linear-gradient(90deg, var(--primary), var(--secondary));
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.blog-form button:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 30px rgba(0,229,255,0.4);
}

/* ===== Blog Grid ===== */
.blog-container {
  max-width: 1300px;
  margin: 60px auto;
  padding: 0 20px;
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 30px;
}

/* Tablet */
@media (max-width: 1024px) {
  .blog-container {
    grid-template-columns: repeat(3, 1fr);
  }
}

/* Mobile */
@media (max-width: 640px) {
  .blog-container {
    grid-template-columns: repeat(2, 1fr);
  }
}

/* ===== Blog Card ===== */
.blog-card {

  display: flex;
  flex-direction: column;
  justify-content: space-between;

  background: linear-gradient(180deg, rgba(255,255,255,0.12), rgba(255,255,255,0.04));
  border-radius: 20px;
  overflow: hidden;
  backdrop-filter: blur(16px);
  box-shadow: 0 15px 35px rgba(0,0,0,0.35);
  transition: transform 0.35s ease, box-shadow 0.35s ease;

  text-decoration: none;
  color: #fff;
}

.blog-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 25px 55px rgba(0,0,0,0.55);
}

.blog-card a{
  text-decoration: none;
}

.blog-card img {
  width: 100%;
  height: 180px;
  object-fit: cover;
}

.blog-content {
  padding: 20px;
  flex-grow: 1;
}

.blog-content h3 {
  font-size: 1.1rem;
  margin-bottom: 6px;
}

.blog-content .date {
  font-size: 0.75rem;
  color: var(--muted);
  margin-bottom: 10px;
}

.blog-content p {
  font-size: 0.85rem;
  line-height: 1.6;
  color: #dce1f3;
}

/* ===== Card Footer ===== */
.blog-footer {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 14px 20px;
  border-top: 1px solid rgba(255,255,255,0.15);
}

.blog-footer span {
  font-size: 0.8rem;
  color: var(--muted);
  cursor: pointer;
}

.blog-footer i {
  margin-right: 6px;
  color: var(--secondary);
}











.upload-wrapper {
  display: flex;
  gap: 20px;
  align-items: center;
  grid-column: 1 / -1;
  max-width: 400px;
}

.upload-box {
  flex: 1;
  height: 150px;
  border-radius: 16px;
  border: 2px dashed rgba(255,255,255,0.35);
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  background: linear-gradient(
    145deg,
    rgba(255,255,255,0.15),
    rgba(255,255,255,0.05)
  );
  backdrop-filter: blur(12px);
  transition: all 0.35s ease;
  text-align: center;
}

.upload-box i {
  font-size: 2rem;
  color: var(--secondary);
  margin-bottom: 8px;
}

.upload-box span {
  font-weight: 600;
}

.upload-box small {
  color: var(--muted);
  margin-top: 4px;
}

.upload-box:hover {
  border-color: var(--secondary);
  box-shadow: 0 0 30px rgba(0,229,255,0.25);
  transform: translateY(-3px);
}

.image-preview {
  width: 180px;
  height: 150px;
  border-radius: 16px;
  overflow: hidden;
  position: relative;
  display: none;
  background: rgba(0,0,0,0.35);
}


/* Spinner overlay */
.upload-spinner {
  position: absolute;
  inset: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(
    145deg,
    rgba(0,0,0,0.55),
    rgba(0,0,0,0.25)
  );
  z-index: 2;
}

.upload-spinner i {
  font-size: 1.8rem;
  color: var(--secondary);
  animation: spin 1.2s linear infinite;
}



.image-preview img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: none;
}



.image-wrapper {
  position: relative;
  width: 100%;
  height: 180px;
  overflow: hidden;
}

.image-wrapper img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: block;
}

/* Loader Overlay */
.image-loader {
  position: absolute;
  inset: 0;
  background: linear-gradient(
    145deg,
    rgba(0,0,0,0.55),
    rgba(0,0,0,0.25)
  );
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 2;
}

.image-loader i {
  font-size: 1.8rem;
  color: var(--secondary);
  animation: spin 1.2s linear infinite;
}

/* Spinner animation */
@keyframes spin {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}




</style>


<script type="text/javascript">
  
  







    // Loading IMG JS
    document.querySelectorAll('.image-wrapper img').forEach(img => {
      const loader = img.previousElementSibling;

      if (img.complete) {
        loader.style.display = 'none';
      }

      img.addEventListener('load', () => {
        loader.style.display = 'none';
      });

      img.addEventListener('error', () => {
        loader.innerHTML = '<i class="fa fa-image"></i>';
      });
    });

















    // Article Form
    jQuery( document ).ready(function(){
      jQuery(".article-submit-btn").on("click", function(e){
        e.preventDefault();
        
        jQuery(".article-form").submit();
      });
    });




    jQuery(".article-form").on("submit", function(e){
      e.preventDefault();


      // Serialize the form data into a query string
      var formDataString = jQuery(this).serialize();



      jQuery.ajax({
        method: "POST",
        url: "<?php echo $base_url; ?>/blog.php",
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData:false,
      }).done(function( response ) {
        if( response == "success" ){

          jQuery(".response-container").show();
          jQuery(".response-container").html("<p>Article has been created successfully</p>");




          /////////////////////REMOVE UPLOADED
          const imageUpload = document.getElementById('imageUpload');
          const imagePreview = document.getElementById('imagePreview');
          const previewImg = document.getElementById('previewImg');
          const uploadSpinner = document.getElementById('uploadSpinner');

          // Clear file input
          imageUpload.value = '';

          // Reset preview
          previewImg.src = '';
          previewImg.style.display = 'none';

          // Hide spinner
          if (uploadSpinner) {
            uploadSpinner.style.display = 'none';
          }

          // Hide preview container
          imagePreview.style.display = 'none';
          /////////////////////



          jQuery(".article-description").val("");
          jQuery(".article-title").val("");



        }else{

          jQuery(".response-container").show();
          jQuery(".response-container").html(response);
        }
      });



      
    });


</script>

<?php include("template-parts/footer.php"); ?>
