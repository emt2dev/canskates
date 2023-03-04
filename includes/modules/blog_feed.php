<div id="blog_captions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#blog_captions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#blog_captions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#blog_captions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <?php
        $art_1_q = "SELECT * FROM posts WHERE new_post_indicator=1 AND admin_bool=1";
        $art_1_s = mysqli_query($connection, $art_1_q);
        $art_1_data = $art_1_s->fetch_assoc();

        if ($art_1_data) {
          echo "
          <div class='container bg-dark'>
            <center>
              <p class='bg-light text-dark'><strong>".$art_1_data['title']."</strong><br /><em>".$art_1_data['body']."</em></p>
            </center>
          </div>
          ";
        }
      ?>
    </div>
    <div class="carousel-item">
      <?php
        $art_2_q = "SELECT * FROM posts WHERE new_post_indicator=2 AND admin_bool=1";
        $art_2_s = mysqli_query($connection, $art_2_q);
        $art_2_data = $art_2_s->fetch_assoc();

        if ($art_2_data) {
          echo "
          <div class='container bg-dark'>
            <center>
              <p class='bg-light text-dark'><strong>".$art_2_data['title']."</strong><br /><em>".$art_2_data['body']."</em></p>
            </center>
          </div>
          ";
        }
      ?>
    </div>
    <div class="carousel-item">
      <?php
        $art_3_q = "SELECT * FROM posts WHERE new_post_indicator=3 AND admin_bool=1";
        $art_3_s = mysqli_query($connection, $art_3_q);
        $art_3_data = $art_3_s->fetch_assoc();

        if ($art_3_data) {
          echo "
          <div class='container bg-dark'>
            <center>
              <p class='bg-light text-dark'><strong>".$art_3_data['title']."</strong><br /><em>".$art_3_data['body']."</em></p>
            </center>
          </div>
          ";
        }
      ?>
    </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#blog_captions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#blog_captions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
