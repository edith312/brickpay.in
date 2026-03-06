
    <div class="page-body pt-1 px-2">
        <?php $this->load->view('admin/map/header') ?>


    <div class="container py-5">
        <h2 class="text-center mb-4 fw-bold">Doctorate / PhD Degrees</h2>

        <div class="row g-3">
                <?php
                // PhD / Doctorate degrees array
                $phdDegrees = [
                    "PhD / DPhil - Doctor of Philosophy",
                    "DM - Doctorate in Medicine",
                    "MCh - Master of Chirurgiae (Surgery Specialty)",
                    "EdD - Doctor of Education",
                    "DBA - Doctor of Business Administration"
                ];

                // Loop through array to generate buttons
                foreach($phdDegrees as $degree) {
                    echo '<div class="col-lg-3 col-md-4 col-sm-6">';
                    echo '<a href="#" class="branch-btn">'.$degree.'</a>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
