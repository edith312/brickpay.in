<?php include('includes/header.php') ?>
<!-- Shiv Web Developer -->
<style>
    .filters {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        grid-gap: 10px;
    }
</style>
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">

    <ul class="row g-3 list-unstyled">
        <li class="col-xl-6 col-lg-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="py-4 m-0 text-center h2"><span data-purecounter-start="0" data-purecounter-separator="," data-purecounter-currency="" data-purecounter-end="250000" class="purecounter">0</span></div>
                    <h5 class="fw-normal text-success">Total Live Projects</h5>
                </div>
            </div>
        </li>

        <li class="col-xl-6 col-lg-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="py-4 m-0 text-center h2"><span data-purecounter-start="0" data-purecounter-separator="," data-purecounter-currency="" data-purecounter-end="30000000" class="purecounter">0</span></div>

                    <h5 class="fw-normal text-warning">Total Live bricks</h5>
                </div>
            </div>
        </li>
    </ul>
    <h2>Filters:</h2>
    <div class="filters">
        <div class="filter-box">
            <label for="">Industry</label>
            <input class="form-control" type="text" name="filter-category" id="filter-category" placeholder="Industry">
        </div>
        <div class="filter-box">
            <label for="">Department</label>
            <input class="form-control" type="text" name="filter-department" id="filter-department" placeholder="Department">
        </div>
        <div class="filter-box">
            <label for="">Work Type</label>
            <input class="form-control" type="text" name="filter-work" id="filter-work" placeholder="Work Type">
        </div>
        <div class="filter-box">
            <label for="">Skills</label>
            <input class="form-control" type="text" name="skills" id="filter-skills" placeholder="Skills">
        </div>
        <div class="filter-box">
            <label for="">Education</label>
            <input class="form-control" type="text" name="filter-education" id="filter-education" placeholder="Education">
        </div>
        <div class="filter-box">
            <label for="">Country</label>
            <input class="form-control" type="text" name="filter-country" id="filter-country" placeholder="Country">
        </div>
        <div class="filter-box">
            <label for="">State</label>
            <input class="form-control" type="text" name="filter-state" id="filter-state" placeholder="State">
        </div>
        <div class="filter-box">
            <label for="">Project Revenue</label>
            <input class="form-control" type="text" name="filter-revenue" id="filter-revenue" placeholder="Project Revenue">
        </div>
        <div class="filter-box">
            <label for="">Monetization Range</label>
            <input class="form-control" type="text" name="filter-range" id="filter-range" placeholder="Monetization Range">
        </div>
        <div class="filter-box">
            <label for="">Execution Time</label>
            <input class="form-control" type="text" name="filter-execution" id="filter-execution" placeholder="Execution Time">
            <div class="d-flex gap-1">
                <div class="form-check">
                    <input id="credit" name="paymentMethod" type="radio" class="form-check-input" required="">
                    <label class="form-check-label" for="credit">Days</label>
                </div>
                <div class="form-check">
                    <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required="">
                    <label class="form-check-label" for="debit">Hours</label>
                </div>
            </div>
        </div>
        <div class="filter-box">
            <label for="">Location</label>
            <input class="form-control" type="text" name="filter-location" id="filter-location">
        </div>
    </div>

    <div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
        <h1 class="title-font h1-register mb-5">My Bids</h1>
        <table class="table table-hover custom-table mb-0 dataTable" style="width: 100%;">
            <thead>
                <tr>
                    <th class="fw-normal small text-muted text-uppercase" scope="col">Task Name</th>
                    <th class="fw-normal small text-muted text-uppercase" scope="col">Bidder Name</th>
                    <th class="fw-normal small text-muted text-uppercase" scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="task-name">
                        <div class="task-name">Web Developer</div>
                        <div style="font-size: 13px;"><b>Project:</b> Web Development</div>
                        <div style="font-size: 13px;"><b>Budget:</b> ₹1000</div>
                        <div style="font-size: 13px;"><b>Duration:</b>10 Days</div>
                    </td>
                    <td class="bidder-name">
                        <div class="task-name">Sagar Thakur</div>
                        <div style="font-size: 13px;"><b>Project:</b> Web Development</div>
                        <div style="font-size: 13px;"><b>Experience:</b> 5 Years</div>
                        <div style="font-size: 13px;"><b>Rating:</b>★★★★★</div>
                    </td>
                    <td>
                        <a href="<?= base_url() ?>view_posted">
                            <button class="btn btn-success btn-sm btn-view">View</button>
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>

    </div>

</div>
</div>
<!-- Shiv Web Developer -->


<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>