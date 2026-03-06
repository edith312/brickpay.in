<?php

$departments= [
            "Concept Visualization" => "#",
            "Budgeting Team" => "#",
            "Investor Relations" => "#",
            "Product Development" => "#",
            "Quality and Standards" => "#",
            "Manufacturing" => "#",
            "Production" => "#",
            "Operations and Logistics" => "#",
            "Business Development" => "#",
            "Marketing" => "#",
            "Sales" => "#",
            "IT Automation" => "#",
            "Research and Development" => "#",
            "Finance and Accounts" => "#",
            "Legal and Compliance" => "#",
            "Administration" => "#",
            "Closed-Loop Feedback and Research Optimization" => "#"

];


?>

<div class="page-body pt-1 px-2">

    <?php $this->load->view('map/header') ?>

    <h2 align="center" class="mt-3 mb-4">Department</h2>

    <div class="my-table" style="grid-template-columns: repeat(10, 1fr) !important;">
        <?php foreach ($departments as $department => $link) { ?>
            <a href="<?= $link ?>">
                <div class="element">
                    <div class="name"><?= htmlspecialchars($department) ?></div>
                </div>
            </a>
        <?php } ?>
    </div>
</div>