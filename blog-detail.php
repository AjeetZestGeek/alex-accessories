<?php 
include 'layout/header.php';
$blogId = $_GET['id'];
$tableName = 'blog_post';
$sql = "SELECT $tableName.id as blogId,$tableName.title as blogTitle, blog_categary.title as categoryTitle, content, image, $tableName.created_date as blogCratedDate, username FROM $tableName JOIN blog_categary ON $tableName.category_id = blog_categary.id JOIN users ON $tableName.created_by_id = users.id WHERE $tableName.id = ".$blogId;
$stm = $dbConn->prepare($sql);
$stm->execute();
$data = $stm->fetchAll()[0];
?>
<!-- BLOG DETAIL -->
<section class="project-detail section-padding-half">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 mx-auto col-md-10 col-12 mt-lg-5 text-center" data-aos="fade-up">
        <h4 class="blog-category text-info"><?=$data['categoryTitle']?></h4>
        <h1><?=$data['blogTitle']?></h1>
        <div class="client-info">
          <div class="d-flex justify-content-center align-items-center mt-3">
            <img src="images/project/project-detail/male-avatar.png" class="img-fluid" alt="male avatar">
              <p>Sweet Candy</p>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
<div class="full-image text-center" data-aos="zoom-in">
  <img src="alexaccesories/uploads/<?=explode('_', $data['image'])[1]?>" class="img-fluid" alt="blog header">
</div>
<!-- BLOG DETAIL -->
<section class="project-detail">
  <div class="container">
    <div class="row">
      <div class="col-lg-9 mx-auto col-md-11 col-12 my-5 pt-3" data-aos="fade-up">
        <h2 class="mb-3"><?=$data['categoryTitle']?></h2>
        <p><?=$data['content']?></p>
      </div>
    </div>
    <div class="col-lg-8 mx-auto mb-5 pb-5 col-12" data-aos="fade-up">
      <h3 class="my-3" data-aos="fade-up">Leave a comment</h3>
      <form action="#" method="get"  class="contact-form" data-aos="fade-up" data-aos-delay="300" role="form">
        <div class="row">
          <div class="col-lg-6 col-12">
            <input type="text" class="form-control" name="name" placeholder="Name">
          </div>
          <div class="col-lg-6 col-12">
            <input type="email" class="form-control" name="email" placeholder="Email">
          </div>
          <div class="col-lg-12 col-12">
            <textarea class="form-control" rows="6" name="message" placeholder="Message"></textarea>
          </div>
          <div class="col-lg-5 mx-auto col-7">
            <button type="submit" class="form-control" id="submit-button" name="submit">Submit Comment</button>
          </div>
        </div>
      </form>
    </div>   
  </div>    
</section>
<?php 
include 'layout/footer.php';
?>  