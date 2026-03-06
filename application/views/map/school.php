<?php 
    $market_research= [
        "1.1 Science" => "school/science",
        "1.2 Commerce" => "school/commerce",
        "1.3 Arts" => "school/arts"
    ];
?>

<div class="page-body pt-1 px-2">
    <?php $this->load->view('map/header') ?>

    <?php
        $depth = [
            ['title'=>'School<br>(1)','url'=>'company/school']
        ];
        pageDepth_new($depth);
    ?>
    
    <h2 align="center">School</h2>



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

