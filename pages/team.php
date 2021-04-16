<?php
    include_once '../config/db.php';
    $title= "Team | GUNI HMS";
    $page_name= "Team";
?>
<!DOCTYPE html>
<html>
  <?php
      include_once '../comps/head.php';
  ?>
  <body>
    <style>
      .container,
      hr {
        margin-top: 4rem;
      }
      .card-container {
        margin-bottom: 1rem;
      }
    </style>
    <?php
      include_once '../comps/header.php';
    ?>
    <main class="team">
      <div class="container">
        <h1 class="title" data-aos="fade-right" data-aos-duration="1100">GUNI's family like team</h1>
        <div class="hero">
          <div class="content">
            <h2 class="team-desc" data-aos="fade-down" data-aos-duration="800">
              Team is the root or foundation of any system, <br />
              if you build nice team with amazing skills sets, enthusiastic
              <br />to learn new things, and respect every member <br />you can
              achieve anything.
            </h2>
            <img src="../media/team/team-hero.png" alt="Team Hero Image" />
          </div>
          <hr />
          <div class="team-list">
            <h2 class="team-name mt-5" data-aos="fade-right" data-aos-duration="1100">Experienced Doctors</h2>
            <div class="team-card-container">
              <div class="card-team" data-aos="fade-down" data-aos-duration="800">
                <div class="img">
                  <img src="../media/team/aakash.jpg" alt="Aakash" />
                </div>
                <div class="team-card-body">
                  <h3 class="name">Dr.Aakash Sisodiya</h3>
                  <h5 class="designation">Neurosurgen</h5>
                </div>
              </div>
              <div class="card-team" data-aos="fade-down" data-aos-duration="1000">
                <div class="img">
                  <img src="../media/team/ani.jpg" alt="Aakash" />
                </div>
                <div class="team-card-body">
                  <h3 class="name">Dr.Aniruddhsinh Solanki</h3>
                  <h5 class="designation">Physician</h5>
                </div>
              </div>
              <div class="card-team" data-aos="fade-down" data-aos-duration="1200">
                <div class="img">
                  <img src="../media/team/shubhlo.jpg" alt="Shubham Rastogi" />
                </div>
                <div class="team-card-body">
                  <h3 class="name">Dr.Shubham Rastogi</h3>
                  <h5 class="designation">Cardiologist</h5>
                </div>
              </div>
            </div>
            <h2 class="team-name mt-5" data-aos="fade-right" data-aos-duration="1100">Talented IT Team</h2>
            <div class="team-card-container">
              <div class="card-team" data-aos="fade-down" data-aos-duration="800">
                <div class="img">
                  <img src="../media/team/aakash.jpg" alt="Aakash" />
                </div>
                <div class="team-card-body">
                  <h3 class="name">Aakash Sisodiya</h3>
                  <h5 class="designation">Full Stack Developer</h5>
                </div>
              </div>
              <div class="card-team" data-aos="fade-down" data-aos-duration="1000">
                <div class="img">
                  <img src="../media/team/ani.jpg" alt="Aakash" />
                </div>
                <div class="team-card-body">
                  <h3 class="name">Aniruddhsinh Solanki</h3>
                  <h5 class="designation">Presentation Manager</h5>
                </div>
              </div>
              <div class="card-team" data-aos="fade-down" data-aos-duration="1200">
                <div class="img">
                  <img src="../media/team/shubhlo.jpg" alt="Shubham Rastogi" />
                </div>
                <div class="team-card-body">
                  <h3 class="name">Shubham Rastogi</h3>
                  <h5 class="designation">Analyst</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </body>
    
  <script>
    AOS.init();
  </script>
</html>
