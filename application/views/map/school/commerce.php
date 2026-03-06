
<?php

$market_research= [
    "Accounting" => "#",
    "Economics" => "#",
    "Business Studies" => "#"
];

?>

<div class="page-body pt-1 px-2">

    <?php $this->load->view('map/header') ?>

    <?php
        $depth = [
            ['title'=>'School<br>(1)','url'=>'company/school'],
            ['title'=>'Commerce<br>(1.2)','url'=>'company/school/commerce']
        ];
        pageDepth_new($depth);
    ?>

    <h2 align="center">Commerce</h2>

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