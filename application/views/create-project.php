<?php $this->load->view('includes/header'); ?>

<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <?php
    if ($this->session->has_userdata('projectMsg')) {
        echo $this->session->userdata('projectMsg');
        $this->session->unset_userdata('projectMsg');
    }
    ?>
    <!-- Shiv Web Developer -->
    <form method="POST" class="flex flex-col gap-4" enctype="multipart/form-data">
        <div class="container w-100 pt-24 shadow-lg bg-white p-md-4 p-3" style="border-radius: 12px;">
            <h4>Create Project</h4>
            <hr>
            <div class="row">
                <div class="mb-3 col-md-4 col-12">
                    <label for="project_name" class="form-label">Project Name</label>
                    <input class="form-control" type="text" name="project_name" id="project_name" value="<?= set_value('project_name'); ?>" required>
                    <?= form_error('project_name', '<div class="text-danger">', '</div>'); ?>
                </div>
                <div class="mb-3 col-md-4 col-12 mt-md-4">
                    <?= form_error('selected_company_id', '<div class="text-danger">', '</div>'); ?>
                    <div class="input-group position-relative">
                        <span class="input-group-text">
                            <i class="bi bi-search"></i>
                        </span>
                        <input class="form-control" type="text" id="searchInput" placeholder="Search companies...">
                        <input type="hidden" id="selectedCompanyId" name="selected_company_id" value="">
                        <div class="company-list">
                            <?php if ($getCompanies):
                                foreach ($getCompanies as $company): ?>
                                    <div class="company-box" data-id="<?= $company['id']; ?>">
                                        <h6 class="company-name"><?= $company['company_name']; ?></h6>
                                        <p class="company-cin"><?= $company['ciin_number']; ?></p>
                                    </div>
                                <?php endforeach;
                            else: ?>
                                <div class="company-box">
                                    <h6 class="company-name">No companies found</h6>
                                <?php endif; ?>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-4 col-12">
                        <label for="project_leader" class="form-label">Project Leader</label>
                        <input class="form-control" type="text" name="project_leader" id="project_leader" value="<?= set_value('project_leader'); ?>" required>
                        <?= form_error('project_leader', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <!-- <div class="mb-3 col-md-3 col-12">
                    <label class="col-form-label">Total Number of Layers</label>
                    <input type="text" class="form-control" placeholder="Total number of layers" name="total_layers" value="<?= set_value('total_layers'); ?>">
                    <?= form_error('total_layers', '<div class="text-danger">', '</div>'); ?>
                </div> -->
                    <div class="mb-3 col-md-3 col-6">
                        <label class="col-form-label" style="font-size: 12px;">Total Number of Layers</label>
                        <div class="input-range-wrapper">
                            <input class="form-control" type="number" name="layer_range_from" maxlength="5" oninput="limitLength(this, 3)" required value="<?= set_value('layer_range_from'); ?>">
                            <span class="range-separator">-</span>
                            <input class="form-control" type="number" name="layer_range_to" maxlength="5" oninput="limitLength(this, 3)" required value="<?= set_value('layer_range_to'); ?>">
                        </div>
                        <?= form_error('layer_range_from', '<div class="text-danger">', '</div>'); ?>
                        <?= form_error('layer_range_to', '<div class="text-danger">', '</div>'); ?>

                    </div>
                    <div class="mb-3 col-md-3 col-6">
                        <label class="col-form-label" style="font-size: 12px;">Total Expected Team</label>
                        <div class="input-range-wrapper">
                            <input class="form-control" type="number" name="team_range_from" maxlength="5" oninput="limitLength(this, 3)" required value="<?= set_value('team_range_from'); ?>">
                            <span class="range-separator">-</span>
                            <input class="form-control" type="number" name="team_range_to" maxlength="5" oninput="limitLength(this, 3)" required value="<?= set_value('team_range_to'); ?>">
                        </div>
                        <?= form_error('team_range_from', '<div class="text-danger">', '</div>'); ?>
                        <?= form_error('team_range_to', '<div class="text-danger">', '</div>'); ?>
                    </div>
                </div>


                <div class="row g-0">
                    <div class="mb-3 col-md-3 col-6">
                        <label for="project_valuation" class="form-label">Project Valuation</label>
                        <input class="form-control" type="number" name="project_valuation" id="project_valuation" value="<?= set_value('project_valuation'); ?>" required>
                        <?= form_error('project_valuation', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <div class="mb-3 col-md-3 col-6">
                        <label for="issued_shares" class="form-label">Issued Shares</label>
                        <input class="form-control" type="number" name="issued_shares" id="issued_shares" value="<?= set_value('issued_shares'); ?>" required>
                        <?= form_error('issued_shares', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <div class="mb-3 col-md-3 col-6">
                        <label for="face_value" class="form-label">Face Value</label>
                        <input class="form-control" type="number" name="face_value" id="face_value" value="<?= set_value('face_value'); ?>" required>
                        <?= form_error('face_value', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <div class="mb-3 col-md-3 col-6">
                        <label for="face_value" class="form-label">Current Price</label>
                        <input class="form-control" type="number" name="current_price" id="current_price" value="<?= set_value('current_price'); ?>" required>
                        <?= form_error('current_price', '<div class="text-danger">', '</div>'); ?>
                    </div>
                </div>


                <div class="row">
                    <div class="mb-3 col-md-6 col-12">
                        <label class="col-form-label text-end d-flex justify-content-between align-items-center">
                            <span class="fs-13">Project Document/Policies</span>
                            <small class="text-muted">(Max 2MB per file)</small>
                        </label>

                        <div class="input-group">
                            <input type="file" class="form-control" name="project_document" onchange="validateFiles(this)">
                            <span class="input-group-text">
                                <i class="fas fa-file-alt me-2 text-primary"></i>
                                <i class="fas fa-download text-success"></i>
                            </span>

                            <a href="path/to/your-draft-document.pdf" download class="btn btn-outline-secondary">
                                Draft Document
                            </a>
                        </div>

                        <div id="file-error" class="text-danger mt-2"></div>
                        <?= form_error('project_document', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label class="col-form-label text-end d-flex justify-content-between align-items-center">
                            <span class="fs-13">Upload Your Pitch Deck</span>
                            <small class="text-muted">(Max 2MB per file)</small>
                        </label>

                        <div class="input-group">
                            <input type="file" class="form-control" name="project_pitch" onchange="validateFiles(this)">

                            <span class="input-group-text">
                                <i class="fas fa-file-alt me-2 text-primary"></i>
                                <i class="fas fa-download text-success"></i>
                            </span>

                            <a href="path/to/your-draft-document.pdf" download class="btn btn-outline-secondary">
                                Draft Document
                            </a>
                        </div>

                        <div id="file-error" class="text-danger mt-2"></div>
                        <?= form_error('project_pitch', '<div class="text-danger">', '</div>'); ?>
                    </div>
                </div>


                <!-- Issued Shares -->
                <!-- <div class="row g-0">
                <div class="mb-3 col-md-4 col-12">
                    <label for="issued_shares" class="form-label">Issued Shares</label>
                    <input class="form-control" type="number" name="issued_shares" id="issued_shares" value="<?= set_value('issued_shares'); ?>" required>
                    <?= form_error('issued_shares', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="mb-3 col-md-4 col-12">
                    <label for="issued_shares" class="form-label">Face Value</label>
                    <input class="form-control" type="number" name="issued_shares" id="issued_shares" value="<?= set_value('issued_shares'); ?>" required>
                    <?= form_error('issued_shares', '<div class="text-danger">', '</div>'); ?>
                </div>
            </div> -->

                <!-- <div class="row">
                <div class="mb-3 col-md-6 col-12">
                    <label class="col-form-label">Total Number of Layers</label>
                    <input type="text" class="form-control" placeholder="Total number of layers" name="total_layers" value="<?= set_value('total_layers'); ?>">
                    <?= form_error('total_layers', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="mb-3 col-md-6 col-12">
                    <label class="col-form-label">Total Expected Team</label>
                    <input class="form-control" type="number" name="tam" value="<?= set_value('tam'); ?>" required>
                    <?= form_error('tam', '<div class="text-danger">', '</div>'); ?>
                </div>
            </div> -->
                <!-- TAM, SAM, SOM -->
                <div class="d-md-flex d-block">
                    <div class="mb-3 px-2 col-md-4 col-12">
                        <label>TAM(Total Available Market) </label>
                        <input class="form-control" type="number" name="tam" value="<?= set_value('tam'); ?>" required>
                        <?= form_error('tam', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    <div class="mb-3 px-2 col-md-4 col-12">
                        <label>SAM (Serviceable Available Market)</label>
                        <input class="form-control" type="number" name="sam" value="<?= set_value('sam'); ?>" required>
                        <?= form_error('sam', '<div class="text-danger">', '</div>'); ?>
                    </div>
                    <div class="mb-3 px-2 col-md-4 col-12">
                        <label>SOM (Serviceable Obtainable Market)</label>
                        <input class="form-control" type="number" name="som" value="<?= set_value('som'); ?>" required>
                        <?= form_error('som', '<div class="text-danger">', '</div>'); ?>
                    </div>
                </div>

                <!-- Project Overview -->
                 <div class="row">
                    <div class="mb-3 col-md-4">
                    <label for="money_invested">Money Invested</label>
                    <input id="money_invested" type="number" class="form-control" name="money_invested" value="<?= $getProject['money_invested']; ?>">
                 </div>
                 <div class="mb-3 col-md-4">
                     <label for="physicalScale">
                        Physical World Scale
                    </label>
                     <select id="physicalScale" class="form-select" name="physical_scale">
                        <option value="" selected disabled>Select scale</option>

                        <?php
                            for ($i = -15; $i <= 15; $i++) {
                                $selected = ($getProject['physical_scale'] == $i) ? 'selected' : '';
                                
                                // Superscript formatting
                                $sup = str_replace(
                                ['-','0','1','2','3','4','5','6','7','8','9'],
                                ['⁻','⁰','¹','²','³','⁴','⁵','⁶','⁷','⁸','⁹'],
                                (string)$i
                                );

                                echo "<option value=\"$i\" $selected>10$sup</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="project_start_date">Project Start Date</label>
                    <input id="project_start_date" type="date" class="form-control" name="project_start_date" value="<?= $getProject['project_start_date']; ?>">
                </div>
                <div class="mb-3 w-100">
                    <label>Elevator Pitch (Max 300 Words)</label>
                    <textarea class="form-control" name="project_overview" rows="4" id="project_overview" placeholder="Write your elevator pitch here..." required><?= set_value('project_overview'); ?></textarea>
                    <div id="charCount">0/300 characters</div>
                    <?= form_error('project_overview', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="row">
                    <div class="mb-3 col-md-6 col-12">
                        <label>Mission (Max 100 Words)</label>
                        <textarea class="form-control" name="mission" rows="3" placeholder="Write your Mission..." required><?= set_value('mission'); ?></textarea>
                        <?= form_error('mission', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label>Vision (Max 100 Words)</label>
                        <textarea class="form-control" name="vision" rows="3" placeholder="Write your Vision..." required><?= set_value('vision'); ?></textarea>
                        <?= form_error('vision', '<div class="text-danger">', '</div>'); ?>
                    </div>

                    <div class="mb-3 col-md-6 col-12">
                        <label class="form-label">Search Through Registered Companies</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fa fa-search text-muted"></i>
                            </span>
                            <input
                                type="text"
                                class="form-control border-start-0"
                                placeholder="Search companies..."
                                name="company_search" />

                            <button class="btn btn-primary d-flex align-items-center" type="button">
                                <i class="fa fa-paper-plane me-1"></i> Request
                            </button>

                            <button class="btn btn-outline-secondary d-flex align-items-center" type="button" data-bs-toggle="modal" data-bs-target="#filterModal">
                                <i class="fa fa-filter me-1"></i> Filter Box
                            </button>
                        </div>
                    </div>

                </div>

                <!-- Submit Button -->
                <div class="mb-3 m-3 d-flex flex-column flex-md-row gap-3">
                    <button class="btn custom-post-task-btn d-flex align-items-center gap-2">
                        <i class="bi bi-send"></i> Create Project
                    </button>

                    <a href="<?= base_url('company/preview_project') ?>" class="d-none btn custom-post-task-btn d-flex align-items-center gap-2">
                        <i class="bi bi-send"></i> Preview Project
                    </a>
                    <div class="col-md-2 col-12 d-none">
                        <button class="btn custom-upload-btn w-100">Save Draft</button>
                    </div>
                </div>
            </div>
    </form>

    <!-- Shiv Web Developer -->

</div>

<script>
    const messageField = document.getElementById("project_overview");
    const charCount = document.getElementById("charCount");
    const maxLength = 300;

    messageField.addEventListener("input", () => {
        const currentLength = messageField.value.length;

        if (currentLength > maxLength) {
            messageField.value = messageField.value.substring(0, maxLength);
        }

        const newLength = messageField.value.length;
        const remaining = maxLength - newLength;

        charCount.textContent = `${newLength}/${maxLength} characters used`;
        if (remaining <= 50) {
            charCount.classList.add("warning");
        } else {
            charCount.classList.remove("warning");
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById("searchInput");
        const hiddenInput = document.getElementById("selectedCompanyId");
        const companyBoxes = document.querySelectorAll(".company-box");

        searchInput.addEventListener("keyup", function() {
            const input = this.value.toLowerCase();
            let anyVisible = false;

            if (input.length > 0) {
                document.querySelector(".company-list").style.display = "block";
            } else {
                document.querySelector(".company-list").style.display = "none";
            }

            companyBoxes.forEach(function(box) {
                const name = box.querySelector(".company-name").textContent.toLowerCase();
                const cin = box.querySelector(".company-cin")?.textContent.toLowerCase() || "";

                if (name.includes(input) || cin.includes(input)) {
                    box.style.display = "block";
                    anyVisible = true;
                } else {
                    box.style.display = "none";
                }
            });

            const noResultBox = document.querySelector(".company-box .company-name")?.textContent === "No companies found";
            if (noResultBox) {
                const box = document.querySelector(".company-box");
                box.style.display = anyVisible ? "none" : "block";
            }
        });


        companyBoxes.forEach(function(box) {
            box.addEventListener("click", function() {
                const companyName = this.querySelector(".company-name").textContent;
                const companyCIN = this.querySelector(".company-cin")?.textContent || "";
                const companyId = this.getAttribute("data-id");

                if (companyName !== "No companies found") {
                    searchInput.value = `${companyName} (CIN: ${companyCIN})`;
                    hiddenInput.value = companyId;
                    companyBoxes.forEach(b => b.style.display = "none");
                }
            });
        });
    });

    document.addEventListener("click", function(e) {
        const companyList = document.querySelector(".company-list");
        if (!e.target.closest(".input-group")) {
            companyList.style.display = "none";
        }
    });
</script>





<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>
<script>
    function validateFiles(input) {
        const maxSize = 3 * 1024 * 1024; // 3MB in bytes
        const errorDiv = document.getElementById('file-error');
        errorDiv.textContent = ''; // Clear old messages

        for (let i = 0; i < input.files.length; i++) {
            if (input.files[i].size > maxSize) {
                errorDiv.textContent = "Each file must be 3MB or less.";
                input.value = ""; // Clear the file input
                break;
            }
        }
    }
</script>



<script>
    function limitLength(el, max) {
        if (el.value.length > max) {
            el.value = el.value.slice(0, max);
        }
    };
</script>