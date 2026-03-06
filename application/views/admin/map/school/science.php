
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
            ['title'=>'Science<br>(1.1)','url'=>'admin/science']
        ];

        // $depth_2 = [
        //     ['title'=>'(1)','url'=>'company/school'],
        //     ['title'=>'(1.1)','url'=>'company/science']
        // ];

        pageDepth_new($depth);
        // pageDepth_new($depth_2);
    ?>

    <h2 align="center">Science</h2>

    <div class="my-table">
        <?php foreach ($market_research as $ministry => $link) { ?>
            <a href="<?= $link ?>">
                <div class="element">
                    <div class="name"><?= htmlspecialchars($ministry) ?></div>
                </div>
            </a>
        <?php } ?>
    </div>
</div>