<?php
// Vars
$page = "blog";
$pagetitle = "Blog | AI consultation";
$description = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non euismod dolor. Integer sapien ipsum, dapibus eget bibendum sed nullam sodales.";




include("template-parts/header.php");


if( isset( $_GET['id'] ) && $_GET['id'] ){
} else {
  header("Location: ".$base_url."/blog.php");
}


$article_data = get_article_single( $_GET['id'] );

if( isset( $article_data ) && is_array( $article_data ) && count( $article_data ) > 0 ){
} else {
  header("Location: ".$base_url."/blog.php");
}

$author_data = get_userdata_by_id( $article_data['posted_by_id'] );
?>

<div class="container">

  <nav class="breadcrumbs" aria-label="Breadcrumb">
    <a href="<?=$base_url;?>"><i class="fa fa-house"></i> Home</a>
    <i class="fa fa-chevron-right"></i>
    <a href="<?=$base_url;?>/blog.php"><i class="fa fa-newspaper"></i> Blogs</a>
    <i class="fa fa-chevron-right"></i>
    <span><?=$article_data['title'];?></span>
  </nav>


  <!-- Hero Image -->
  <div class="hero-single ">
    <div class="loader" id="heroLoader">
      <i class="fa fa-spinner"></i>
    </div>
    <img id="heroImage" src="<?=$base_url.$article_data['img_url'];?>" alt="Blog Image">
  </div>

  <!-- Meta -->
  <div class="meta">
    <span><i class="fa fa-user"></i> <?=$author_data['username'];?></span>
    <span><i class="fa fa-calendar"></i> <?=date("M d, Y", strtotime( $article_data['datetimeinserted'] ));?></span>
    <!-- <span><i class="fa fa-clock"></i> 6 min read</span> -->
  </div>

  <!-- Title -->
  <h1><?=$article_data['title'];?></h1>

  <!-- Article -->
  <div class="article">
    <p>
      <?=$article_data['description'];?>
    </p>

    <p>
      By combining glassmorphism, subtle animations, and responsive layouts,
      you can create an experience that feels similar to Medium, Webflow, or
      Notion — but fully customized to your brand.
    </p>

    <p>
      Loading spinners, image previews, and real-time feedback all play a huge
      role in perceived performance. Even small details dramatically improve
      trust and engagement.
    </p>

    <!-- Actions -->
    <!-- <div class="actions">
      <span><i class="fa fa-heart"></i> 124 Likes</span>
      <span><i class="fa fa-comment"></i> 18 Comments</span>
    </div> -->
  </div>



  <!-- Comments Section -->
<div class="comments-section">

  <h2> <i class="fa fa-comments"></i> <?=$article_data['comment_counts'];?> Comments</h2>

  <?php 
   
  
  if( isset( $article_data['comment_counts'] ) && $article_data['comment_counts'] && $article_data['comment_counts'] > 0 ): 
    $comments = get_comments_by_article_id( $_GET['id'] );
    foreach( $comments as $comment ): ?>



      <div class="comment">
        <div class="avatar"><?php echo ucwords( $comment['firstname'][0] ).ucwords( $comment['lastname'][0] ); ?></div>
        <div class="comment-body">
          <div class="comment-header">
            <strong><?=ucwords($comment['firstname']);?> <?=ucwords( $comment['lastname'] );?></strong>
            <span><?=date("M d, Y h:i A", strtotime( $comment['datetimeinserted'] ));?></span>
          </div>
          <p><?=$comment['comment'];?></p>
         
        </div>
      </div>


    <?php 
    endforeach;

  else:
  ?>
  <p>Be the first to comment on this article.</p>
  <?php
  endif; 
  ?>





  <!-- Comment Form -->
  <?php if( isset( $user_id ) && $user_id ): ?>
  <form class="comment-form w-100 m-0" action="" method="">


    <div class="response-container">
    </div>



    <h3>Leave a Comment</h3>
    <textarea placeholder="Write your comment..." class="comment-msg" rows="5"></textarea>
    <button class="comment-btn">
      <i class="fa fa-paper-plane"></i> Post Comment
    </button>
  </form>

  <?php else: ?>
    <p>Please <a href="#">Login</a> to continue.</p>
  <?php endif; ?>

</div>





</div>











<style>
:root {
  --primary: #6c63ff;
  --secondary: #00e5ff;
  --bg: #0b0f1a;
  --card: rgba(255,255,255,0.08);
  --text: #ffffff;
  --muted: #aab1c7;
}

* {
  box-sizing: border-box;
  font-family: 'Inter', sans-serif;
}

body {
  margin: 0;
  background: radial-gradient(circle at top, #141b34, var(--bg));
  color: var(--text);
}

/* ===== Container ===== */
.container {
  max-width: 900px;
  margin: auto;
  padding: 40px 20px 80px;
}

/* ===== Hero Image ===== */
.hero-single {
  position: relative;
  height: 420px;
  border-radius: 24px;
  overflow: hidden;
  margin-bottom: 40px;
}

.hero-single img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  display: none;
}

.hero-single .loader {
  position: absolute;
  inset: 0;
  display: flex;
  justify-content: center;
  align-items: center;
  background: linear-gradient(
    145deg,
    rgba(0,0,0,0.7),
    rgba(0,0,0,0.3)
  );
}

.loader i {
  font-size: 2.5rem;
  color: var(--secondary);
  animation: spin 1.2s linear infinite;
}

/* ===== Meta ===== */
.meta {
  display: flex;
  gap: 20px;
  flex-wrap: wrap;
  font-size: 0.85rem;
  color: var(--muted);
  margin-bottom: 16px;
}

.meta i {
  color: var(--secondary);
  margin-right: 6px;
}

/* ===== Title ===== */
h1 {
  font-size: 2.6rem;
  margin-bottom: 20px;
  line-height: 1.2;
}

/* ===== Article ===== */
.article {
  background: linear-gradient(180deg, rgba(255,255,255,0.12), rgba(255,255,255,0.03));
  border-radius: 24px;
  padding: 40px;
  backdrop-filter: blur(16px);
  box-shadow: 0 30px 60px rgba(0,0,0,0.45);
}

.article p {
  font-size: 1rem;
  line-height: 1.9;
  color: #dce1f3;
  margin-bottom: 24px;
}

/* ===== Footer Actions ===== */
.actions {
  display: flex;
  gap: 30px;
  border-top: 1px solid rgba(255,255,255,0.15);
  padding-top: 20px;
  margin-top: 40px;
}

.actions span {
  cursor: pointer;
  font-size: 0.9rem;
  color: var(--muted);
}

.actions i {
  margin-right: 8px;
  color: var(--secondary);
}

/* ===== Spinner Animation ===== */
@keyframes spin {
  from { transform: rotate(0deg); }
  to { transform: rotate(360deg); }
}

/* ===== Mobile ===== */
@media(max-width: 640px) {
  h1 {
    font-size: 2rem;
  }

  .article {
    padding: 24px;
  }

  .hero-single {
    height: 260px;
  }
}






.comments-section {
  margin-top: 80px;
}

.comments-section h2 {
  margin-bottom: 30px;
  font-size: 1.5rem;
}

.comments-section h2 i {
  color: var(--secondary);
  margin-right: 8px;
}

/* Comment Card */
.comment {
  display: flex;
  gap: 16px;
  padding: 20px;
  margin-bottom: 20px;
  border-radius: 18px;
  background: linear-gradient(
    145deg,
    rgba(255,255,255,0.14),
    rgba(255,255,255,0.04)
  );
  backdrop-filter: blur(14px);
  box-shadow: 0 15px 35px rgba(0,0,0,0.35);
}

.avatar {
  width: 44px;
  height: 44px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--primary), var(--secondary));
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
}

.comment-body {
  flex: 1;
}

.comment-header {
  display: flex;
  justify-content: space-between;
  font-size: 0.8rem;
  color: var(--muted);
  margin-bottom: 6px;
}

.comment-body p {
  font-size: 0.9rem;
  line-height: 1.6;
  margin-bottom: 0;
  color: #e3e7f6;
}

.comment-actions span {
  margin-right: 16px;
  font-size: 0.8rem;
  color: var(--muted);
  cursor: pointer;
}

.comment-actions i {
  margin-right: 5px;
  color: var(--secondary);
}

/* Comment Form */
.comment-form {
  margin-top: 40px;
  padding: 30px;
  border-radius: 20px;
  background: linear-gradient(
    145deg,
    rgba(255,255,255,0.18),
    rgba(255,255,255,0.06)
  );
  backdrop-filter: blur(16px);
  max-width: unset;
}

.comment-form h3 {
  margin-bottom: 16px;
}

.comment-form input,
.comment-form textarea {
  width: 100%;
  padding: 14px 16px;
  margin-bottom: 14px;
  border-radius: 12px;
  border: none;
  background: rgba(255,255,255,0.12);
  color: var(--text);
  outline: none;
}

.comment-form textarea {
  resize: none;
}

.comment-form button {
  border: none;
  padding: 14px 26px;
  border-radius: 50px;
  font-weight: 600;
  cursor: pointer;
  background: linear-gradient(90deg, var(--primary), var(--secondary));
  color: #fff;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.comment-form button:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 30px rgba(0,229,255,0.4);
}




</style>




<script>
const heroImg = document.getElementById('heroImage');
const heroLoader = document.getElementById('heroLoader');

heroImg.addEventListener('load', () => {
  heroLoader.style.display = 'none';
  heroImg.style.display = 'block';
});

heroImg.addEventListener('error', () => {
  heroLoader.innerHTML = '<i class="fa fa-image"></i>';
});


















jQuery(".comment-btn").on("click", function(e){
  e.preventDefault();

  jQuery(".comment-form ").submit();
});


jQuery( document ).ready( function(){
  jQuery(".comment-form ").on("submit", function(e){
    e.preventDefault();


    var commentmsg = jQuery(".comment-msg").val();


    jQuery.ajax({
        method: "post",
        data: { 
          action:"comment", 
          article_id: "<?php if( isset( $_GET['id'] ) && $_GET['id'] ): echo $_GET['id']; endif; ?>",  
          commentmsg: commentmsg
        }
      }).done(function( response ) {
        if( response == "success" ){

          jQuery(".response-container").show();
          jQuery(".response-container").html("<p>Comment has been added successfully</p>");


          jQuery(".comment-msg").val("");



        }else{

          jQuery(".response-container").show();
          jQuery(".response-container").html(response);
        }
      });
  });
}); 




</script>


<?php include("template-parts/footer.php"); ?>
