<?php
    include_once 'config/db.php';
    $title= "GUNI HMS | Hospital Management System";
    $page_name="Home";
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
    <div class="hero-home">
        <div class="container">
            <div class="hero-text">
                <h1 class="quote">FIND DOCTOR EASY</h1>
                <h2 class="hero-title">Let's Find Your<br />Doctor</h2>
                <p class="hero-desc">Book an online appointment now with your <br /> favourite doctor.</p>
                <a href="pages/appointment.php"><div class="hero-btn">Book appointment</div></a>
            </div>
        </div>
    </div>
</body>
</html>
