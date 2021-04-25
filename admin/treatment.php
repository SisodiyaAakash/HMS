<?php
    $title= "All Treatment Records | GUNI HMS";
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
        <div class="desktop-hide">
          <h4 class="center">Please Use Wide Screen For Records</h4>
        </div>
        <!-- Treatment Records -->
        <h4 class="center">Recent Treatment Records</h4>
        <table>
          <thead>
            <tr>
              <th>Treatment Description</th>
              <th>Treatment</th>
              <th>Treatment Duration</th>
              <th>Date</th>
              <th>Time</th>
              <th>Cost</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                Recover the right side body paralysis due to high blood pressure
              </td>
              <td>Physical Therapy</td>
              <td>14 Days</td>
              <td>08 April 2021</td>
              <td>3:00:00</td>
              <td>3:00:00</td>
            </tr>
          </tbody>
        </table>

        <!-- Treatment History -->
        <h4 class="center">Treatment Record History</h4>
        <table>
          <thead>
            <tr>
              <th>Treatment Description</th>
              <th>Treatment</th>
              <th>Treatment Duration</th>
              <th>Date</th>
              <th>Time</th>
              <th>Cost</th>
              <th class="hide"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>
                Recover the right side body paralysis due to high blood pressure
              </td>
              <td>Physical Therapy</td>
              <td>14 Days</td>
              <td>08 April 2021</td>
              <td>3:00:00</td>
              <td>3:00:00</td>
              <td>
                <a href="#">Delete Record</a>
              </td>
            </tr>
            <tr>
              <td>
                Recover the right side body paralysis due to high blood pressure
              </td>
              <td>Physical Therapy</td>
              <td>14 Days</td>
              <td>08 April 2021</td>
              <td>3:00:00</td>
              <td>3:00:00</td>
              <td>
                <a href="#">Delete Record</a>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>
