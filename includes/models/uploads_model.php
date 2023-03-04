<?php
class Uploads_model {
  public function __construct($title, $body) {
    $this->title = $title;
    $this->body = $body;
  }

  public function uu($connection, $uid_finder, $where_, $target_file) {
    $uu_query = "INSERT INTO user_uploads (user_id, title, body, dir_route, file_name) VALUES (?, ?, ?, ?, ?)";

    $uu_send = $connection->prepare($uu_query);
    $uu_send->bind_param("sssss", $a, $b, $c, $d, $e);

      $a = $uid_finder;
      $b = $this->title;
      $c = $this->body;
      $d = $where_;
      $e = $target_file;

    $uu_send->execute();
  }

  public function new_product($connection, $new_product_indicator, $productCost, $productQuantity, $productColor, $productType, $fileName, $uploadDir, $supplierInStockBool, $supplierName, $supplierWebsite) {
    $np_query = "INSERT INTO product_list (new_product_indicator, name, description, cost, quantity, color, type, fileName, uploadDir, supplier_in_stock, supplier_name, supplier_website) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

    $np_send = $connection->prepare($np_query);
    $np_send->bind_param("issdisssssss", $l, $a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k);

      $l = intval($new_product_indicator);
      $a = $this->title;
      $b = $this->body;
      $c = floatval($productCost);
      $d = intval($productQuantity);
      $e = $productColor;
      $f = $productType;
      $g = $fileName;
      $h = $uploadDir;
      $i = $supplierInStockBool;
      $j = $supplierName;
      $k = $supplierWebsite;

    $np_send->execute();
  }
}
