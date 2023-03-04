<div id="product_captions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#product_captions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#product_captions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#product_captions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <?php
        $npi_1_q = "SELECT * FROM product_list WHERE new_product_indicator=1";
        $npi_1_s = mysqli_query($connection, $npi_1_q);
        $npi_1_data = $npi_1_s->fetch_assoc();

        if ($npi_1_data) {
          echo "
          <img src='".$npi_1_data['uploadDir']."' class='d-block w-100' height='500px' alt='...'>
          <div class='carousel-caption d-none d-md-block'>
            <h4 class='bg-light text-dark'>".$npi_1_data['name']."</h4>
            <p class='bg-light text-dark'>".$npi_1_data['description']."</p>
            <p class='bg-light text-dark'>".$npi_1_data['cost']."</p>
          </div>
          ";
        }
      ?>
    </div>
    <div class="carousel-item">
      <?php
        $npi_2_q = "SELECT * FROM product_list WHERE new_product_indicator=2";
        $npi_2_s = mysqli_query($connection, $npi_2_q);
        $npi_2_data = $npi_2_s->fetch_assoc();

        if ($npi_2_data) {
          echo "
          <img src='".$npi_2_data['uploadDir']."' class='d-block w-100' height='500px' alt='...'>
          <div class='carousel-caption d-none d-md-block'>
            <h4 class='bg-light text-dark'>".$npi_2_data['name']."</h4>
            <p class='bg-light text-dark'>".$npi_2_data['description']."</p>
            <p class='bg-light text-dark'>".$npi_2_data['cost']."</p>
          </div>
          ";
        }
      ?>
    </div>
    <div class="carousel-item">
      <?php
        $npi_3_q = "SELECT * FROM product_list WHERE new_product_indicator=3";
        $npi_3_s = mysqli_query($connection, $npi_3_q);
        $npi_3_data = $npi_3_s->fetch_assoc();

        if ($npi_3_data) {
          echo "
          <img src='".$npi_3_data['uploadDir']."' class='d-block w-100' height='500px' alt='...'>
          <div class='carousel-caption d-none d-md-block'>
            <h4 class='bg-light text-dark'>".$npi_3_data['name']."</h4>
            <p class='bg-light text-dark'>".$npi_3_data['description']."</p>
            <p class='bg-light text-dark'>".$npi_3_data['cost']."</p>
          </div>
          ";
        }
      ?>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#product_captions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#product_captions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
