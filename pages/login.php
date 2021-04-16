<?php
    include_once '../config/db.php';
    $title= "Login | GUNI HMS";
    $page_name= "Login";
?>
<!DOCTYPE html>
<html>
<?php
    include_once '../comps/head.php';
?>
<body>
    <?php
        include_once '../comps/header.php';
    ?>
    <main>
        <div class="container">
            <div class="form-container contact-form">
                <form action="" class="contact">
                    <h2 class="heading">Login Form</h2>
                    <input type="text" placeholder="User name / User ID"/>
                    <input type="password" placeholder="password">
                    <button type="Submit">Login Now</button>
                    <p class="redirect">
                        New User! <a href="registration.php">Register Now</a>
                    </p>
                </form>
            </div>
        </div>
    </main>
</body>
</html>
