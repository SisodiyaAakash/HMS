<?php
    include_once '../config/db.php';
    $title = "Contact Us | GUNI HMS";
    $page_name = "Contact";
?>
<!DOCTYPE html>
<html>
<?php
include_once '../comps/head.php';
?>
<body>
    <style>
        .container{
            margin-top: 5rem;
        }
        .cont-content{
            margin-top: 3rem;
            margin-bottom: 5rem;
        }
        form{
            margin-top: 8rem!important;
        }
    </style>
    <?php
include_once '../comps/header.php';
?>
    <main class="contact-page">
        <div class="container">
            <h1 class="title">Contact Us</h1>
            <div class="cont-content">
                <img src="../media/contact/contact-hero.png" alt="Contact Hero">
                <h2 class="cont-desc" data-aos="fade-down" data-aos-duration="800">
                    We are always here to help you if you have any <br />type of query or other,
                    Give us feedback  or contact us<br /> for suggestions or services so we can make our
                    self more better,<br /> Because better service can make you helthier.
                </h2>
            </div>
            <div class="form-container contact-form">
                <form action="" class="contact">
                    <h2 class="heading">Contact Us Form</h2>
                    <input type="text" placeholder="Name"/>
                    <input type="email" placeholder="Email">
                    <textarea type="text" placeholder="Message" rows="4">We like your services very much</textarea>
                    <button type="Submit">Send Message</button>
                </form>
            </div>
        </div>
    </main>
</body>
<script>
    AOS.init();
</script>
</html>
