<?php
    $title= "My Treatment Records | GUNI HMS";
    $page_name= "treatment";

    include_once '../config/db.php';
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
            <h2 class="heading">Treatment Records</h2>
            <div class="desktop-hide">
                <h4 class="center">Please Use Wide Screen For Records</h4>
            </div>
            <table>
                <thead>
                  <tr>
                    <th>Treatment</th>
                    <th>Doctor</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Time</th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                      <td>Dialysis</td>
                      <td>Dr.Aakash Sisodiya</td>
                      <td>Dialysis due to excessive diabetes.</td>
                      <td>08 April 2021</td>
                      <td>3:00:00</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
