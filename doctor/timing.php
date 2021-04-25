<?php
    $title= "My Timing | GUNI HMS";
    $page_name= "timing";

    include_once '../config/db.php';

    session_start();
    $user_name= $_SESSION["DOCTOR_USERNAME"];
?>
<!DOCTYPE html>
<html>
  <?php
    include_once 'comps/head.php';
  ?>
  <body>
    <?php
      include_once 'comps/header.php';
    ?>
    <div class="pagearea">
      <div class="container">
        <h2 class="heading">Timing</h2>
      </div>
    </div>
  </body>
</html>
