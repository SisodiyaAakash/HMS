<?php
    $title= "Doctor Dashboard | GUNI HMS";
    $page_name= "dashboard";

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
        </div>
    </div>
</body>
</html>
