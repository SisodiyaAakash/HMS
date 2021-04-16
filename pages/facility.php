<?php
    include_once '../config/db.php';
    $title= "Facilities | GUNI HMS";
    $page_name="Facility";
?>
<!DOCTYPE html>
<html>
<?php
    include_once '../comps/head.php';
?>
<body>
    <style>
        .card-container{
            margin-bottom: 1rem;
        }
    </style>
    <?php
        include_once '../comps/header.php';
    ?>
    <main class="facility">
        <h1 class="title">GUNI's Facilities</h1>
        <div class="container">
            <div class="card-container">
                <div class="card">
                    <div class="card-img">
                        <img src="../media/services/campus.png" alt="Huge Campus">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Huge campus</h3>
                        <p class="card-desc">
                            Huge campus of all Hospitals of GUNI's Hospital Chain, Campus is full of greenary so patient can get fresh air and can get well soon. 
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-img">
                        <img src="../media/services/higenic.png" alt="Higenic Services">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Care with hygiene</h3>
                        <p class="card-desc">
                            Hospital is completely managed with care of hygiene, so the viruses, bacterias not spread anymore and no one get affect with any type of unhygiene.
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-img">
                        <img src="../media/services/online.png" alt="Online Consultancy">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Online consultancy</h3>
                        <p class="card-desc">
                             Patient can get suggestions and medicine prescreption with online consultancy facility if he/she is not able to go hospital.
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-img">
                        <img src="../media/services/offline.png" alt="offline Consultancy">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Doctor consultancy</h3>
                        <p class="card-desc">
                            GUNI Hospitals have great consultancy team of doctors to suggest you the best treatment suggestions so you can get well soon.
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-img">
                        <img src="../media/services/doctors.png" alt="Talented Doctors">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Experienced doctors</h3>
                        <p class="card-desc">
                            GUNI Hospitals have great team of xperienced surgery expert, physician, nutrition, pediatrition, neurosurgen, OPD expert, etc.
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-img">
                        <img src="../media/services/ambulance.png" alt="Ambulance">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Ambulance Facility</h3>
                        <p class="card-desc">
                             GUNI Hospitals have ambulance facility so patient can comfortably come to hospital if he/she is not able to come with public/personal transport.
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-img">
                        <img src="../media/services/mri.png" alt="Advance Technology">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Advanced Equipments</h3>
                        <p class="card-desc">
                            GUNI Hospitals have all advanced equipments with best technology required, Patient can best and accurate result with best technology equipment.
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-img">
                        <img src="../media/services/medicines.png" alt="Medicines">
                    </div>
                    <div class="card-body">
                        <h3 class="card-title">Prescribed Medicines</h3>
                        <p class="card-desc">
                            Pharmacy with majorly all the medicines for all treatments, so patient don't want to go anywhere to buy medicines and other drug. 
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
