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

    .project-grid-bottom{
        grid-template-columns: 30px repeat(5, 1fr) 50px;
    }

</style>
<!-- Shiv Web Developer -->
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <div class="card flex-row p-4">
        <div class="row mb-3 align-items-center">
            <h4 class="mb-0">Company Profile Details</h4>
            <?php
                if ($this->session->has_userdata('deleteMsg')) {
                    echo $this->session->userdata('deleteMsg');
                    $this->session->unset_userdata('deleteMsg');
                }
            ?>
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
                        <button id="viewCompaniesBtn" type="button" class="btn btn-primary">View All Companies</button>
                        <input type="text" class="form-control form-control-sm w-auto" placeholder="Search...">
                        <button class="btn btn-sm btn-outline-secondary" type="button" data-bs-toggle="modal" data-bs-target="#filterModal">
                            <i class="fa fa-filter me-1"></i> Filter Box
                        </button>
                        <a href="<?= base_url('company/create_company') ?>" class="btn btn-primary">Create Company</a>
                    </div>

                </div>
            </div>

            <div id="companyList" style="display: block;">
                <?php if ($getCompanies):
                    $i = 1;
                    foreach ($getCompanies as $company):
                ?>
                        <div class="project-row">
                            <div class="project-cell index"><?= $i++; ?></div>
                            <div class="project-cell"><?= $company['company_name'] ?? 'No Name' ?></div>
                            <div class="project-cell">Total Bricks: 0</div>
                            <div class="project-cell">Country: <?= $company['location'] ?></div>
                            <div class="project-cell text-center" style="padding: 2px;">
                                <a href="<?= base_url('company/company-preview?id=' . $company['id']) ?>" title="View Details">
                                    <i class="bi bi-eye-fill eye-icon"></i>
                                </a>
                            </div>
                        </div>

                        <div class="project-grid project-grid-bottom mb-4">
                            <div class="project-cell" style="display: flex; align-items: center; justify-content: center; padding: 0;">
                                <span class="project-dot green"></span>
                            </div>

                            <div class="project-cell">Founded Year: <?= convertDatedmy($company['founded_year']) ?></div>
                            <div class="project-cell">TAM: <?= $company['tan_number'] ?></div>
                            <div class="project-cell">Valuation: <?= $company['valuation'] ?></div>
                            <div class="project-cell">Equity Dilution: (<?= $company['equity_dilution'] ?> %)</div>
                            <div class="project-cell">Team: 0 Members</div>
                            <div class="project-cell mx-auto">
                                <a href="<?= base_url('company/company-trash?id=' . $company['id']) ?>" title="Delete Company" class="text-danger" onclick="return confirm('Are you sure you want to delete this company?');">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </div>
                        </div>
                <?php endforeach;
                endif; ?>

            </div>

            
        </div>
        </div>
    </div>
</div>
<!-- Shiv Web Developer -->
<?php include('includes/footer.php') ?>
<?php include('includes/footer-link.php') ?>
<script>
    document.getElementById("viewCompaniesBtn").addEventListener("click", function() {
        document.getElementById("companyList").style.display = "block";
    });
</script>