<?php include('includes/header-link.php') ?>
<?php include('includes/header.php') ?>
<style>
    .project-row {
        display: grid;
        grid-template-columns: 30px 1fr 1fr 1fr 50px;
        align-items: center;
        border: 1px solid #dce3e8;
        border-radius: 4px;
        color: #00a7cc;
        font-weight: 600;
        border-bottom: 0;
    }

    .project-cell {
        padding: 3px 10px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .project-cell.index {
        border-right: 1px solid #ccc;
        text-align: center;
    }

    .eye-icon {
        font-size: 18px;
        color: #00a7cc;
    }
</style>
<!-- Shiv Web Developer  -->
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <div class="card p-4">
        <h4 class="mb-0">Project Profile Details</h4>
        <div class="row mb-3 align-items-center">
            <div class="container">
                <div class="row align-items-center g-3">

                    <div class="col-md-6">
                        <label class="form-label d-block mb-0">
                            <?= $getUser['name'] ?> has
                            <input type="text" class="form-control d-inline-block mx-1" style="width: 100px;" value="<?= $getCompanyCount ?>" readonly>
                            companies in
                            <input type="text" class="form-control d-inline-block mx-1" style="width: 140px;" placeholder="" value="<?= $numOfCountries[0]['total_countries'] ?>">
                            country
                        </label>
                    </div>

                    <div class="col-md-6 d-flex justify-content-start align-items-center flex-wrap gap-0">
                        <button id="viewCompaniesBtn" type="button" class="btn btn-primary">View All Projects</button>
                        <input type="text" class="form-control form-control-sm w-auto" placeholder="Search...">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#filterModal">
                            <i class="fa fa-filter me-1"></i> Filter Box
                        </button>
                        <a href="<?= base_url('company/create-project') ?>" class="btn btn-primary">Create Project</a>
                    </div>

                </div>
            </div>


            <div id="companyList" style="display: block;">
                <?php if ($getProjects):
                    $i = 1;
                    foreach ($getProjects as $project):
                        $getCompany = $this->CommonModal->getSingleRowById('tbl_companies', ['id' => $project['company_id']]);
                ?>
                        <div class="project-row">
                            <div class="project-cell index" style="width:100px; text-align: left !important; padding:5px;"><?= $i++; ?></div>
                            <div class="project-cell"><?= $project['project_name'] ?></div>
                            <div class="project-cell">Project Leader: <?= $project['project_leader'] ?></div>
                            <div class="project-cell">Company: <?= $getCompany['company_name'] ?></div>
                            <div class="project-cell text-center" style="padding: 2px;">
                                <a href="<?= base_url('company/project-profile-preview?id=' . $project['id']) ?>" title="View Details">
                                    <i class="bi bi-eye-fill eye-icon"></i>
                                </a>
                                <!-- <a href="<//?= base_url('company/project-delete?id=' . $project['id']) ?>" title="Delete Project" class="text-danger" onclick="return confirm('Are you sure you want to delete this project?');">
                                    <i class="bi bi-trash"></i>
                                </a> -->
                            </div>
                        </div>

                        <div class="project-grid project-grid-bottom mb-4">
                            <div class="project-cell" style="display: flex; align-items: center; justify-content: center; padding: 0;">
                                <span class="project-dot green"></span>
                            </div>

                            <div class="project-cell">TAM: <?= $project['tam'] ?></div>
                            <div class="project-cell">SAM: <?= $project['sam'] ?></div>
                            <div class="project-cell">SOM: <?= $project['som'] ?></div>
                            <div class="project-cell">Project Valuation: <?= $project['project_valuation'] ?></div>
                            <div class="project-cell">Created: <?= convertDatedmy($project['created_at']) ?></div>
                        </div>
                <?php endforeach;
                endif; ?>

            </div>
        </div>
    </div>

</div>
</div>


<?php include('includes/footer.php') ?>
<?php include('includes/footer-link.php') ?>
<script>
    document.getElementById("viewCompaniesBtn").addEventListener("click", function() {
        document.getElementById("companyList").style.display = "block";
    });
</script>