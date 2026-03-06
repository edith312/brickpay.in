
<?php

    $market_research= [
        "1.1.1 Physics" => "science/physics",
        "1.1.2 Chemistry" => "science/chemistry",
        "1.1.3 Maths" => "science/maths",
        "1.1.4 Biology" => "science/biology",
        "1.1.5 Evolution and Timeline" => "science/evolution_and_timeline"
    ];

?>

<div class="page-body pt-1 px-2">

    <?php $this->load->view('admin/map/header') ?>

    <?php
        $depth = [
            ['title'=>'School<br>(1)','url'=>'admin/school'],
            ['title'=>'Science<br>(1.1)','url'=>'admin/school/science'],
            ['title'=>'Physics<br>(1.1.1)','url'=>'school_physics']
        ];

        // $depth_2 = [
        //     ['title'=>'(1)','url'=>'company/school'],
        //     ['title'=>'(1.1)','url'=>'company/school/science'],
        //     ['title'=>'(1.1.1)','url'=>'school_physics']
        // ];

        pageDepth_new($depth);
        // pageDepth_new($depth_2);
    ?>

    <div class="container py-5">
    <h2 class="text-center mb-4 fw-bold">Physics</h2>

    <div class="row g-3">
            <?php
            $physics = [
                "Force",
                "Magnetisam",
                "Electricity",
                "Dual Nature"
            ];

            // Loop through array to generate buttons
            foreach($physics as $degree) {
                echo '<div class="col-lg-3 col-md-4 col-sm-6">';
                echo '<a href="#" class="branch-btn">'.$degree.'</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</div>