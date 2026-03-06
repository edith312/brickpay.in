<?php $this->load->view('includes/header-link'); ?>
<?php $this->load->view('includes/freelancer_header'); ?>

<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <!-- Shiv Web Developer -->
    <ul class="row g-3 list-unstyled">
        <li class="col-xl-3 col-lg-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar rounded-circle mx-auto mb-2">
                        <i class="fa fa-check-circle fa-2x text-success"></i>
                    </div>
                    <h5 class="fw-normal text-success">Completed ✅</h5>
                </div>
            </div>
        </li>

        <li class="col-xl-3 col-lg-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar rounded-circle mx-auto mb-2">
                        <i class="fa fa-spinner fa-2x text-warning"></i>
                    </div>
                    <h5 class="fw-normal text-warning">In Progress 🔄</h5>
                </div>
            </div>
        </li>

        <li class="col-xl-3 col-lg-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar rounded-circle mx-auto mb-2">
                        <i class="fa fa-hourglass-half fa-2x text-info"></i>
                    </div>
                    <h5 class="fw-normal text-info">Pending ⏳</h5>
                </div>
            </div>
        </li>

        <li class="col-xl-3 col-lg-6">
            <div class="card text-center">
                <div class="card-body">
                    <div class="avatar rounded-circle mx-auto mb-2">
                        <i class="fa fa-ban fa-2x text-danger"></i>
                    </div>
                    <h5 class="fw-normal text-danger">Not Started 🚧</h5>
                </div>
            </div>
        </li>


        <div class="ps-md-4 pe-md-3 px-2 py-3 page-body">

            <table class="table table-hover custom-table mb-0 dataTable" style="width: 100%;">
                <thead>
                    <tr>
                        <th class="fw-normal small text-muted text-uppercase" scope="col">Task Name</th>
                        <th class="fw-normal small text-muted text-uppercase" scope="col">Assigned To</th>
                        <th class="fw-normal small text-muted text-uppercase" scope="col">Due Date</th>
                        <th class="fw-normal small text-muted text-uppercase" scope="col">Status</th>
                        <th class="fw-normal small text-muted text-uppercase" scope="col">Priority</th>
                        <th class="fw-normal small text-muted text-uppercase" scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Project Doughnut Dungeon</td>
                        <td>John Doe</td>
                        <td>10 Feb 2023</td>
                        <td><span class="badge bg-warning text-dark">Pending</span></td>
                        <td><span class="badge bg-danger">High</span></td>
                        <td>
                            <button class="btn btn-success btn-sm">Accept</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Website Redesign</td>
                        <td>Jane Smith</td>
                        <td>15 Mar 2023</td>
                        <td><span class="badge bg-primary">In Progress</span></td>
                        <td><span class="badge bg-warning text-dark">Medium</span></td>
                        <td>
                            <button class="btn btn-success btn-sm">Accept</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>App Development</td>
                        <td>Michael Brown</td>
                        <td>25 Apr 2023</td>
                        <td><span class="badge bg-success">Completed</span></td>
                        <td><span class="badge bg-secondary">Low</span></td>
                        <td>
                            <button class="btn btn-success btn-sm" disabled>Accept</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div>

    </ul>

</div>

<!-- Shiv Web Developer -->
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>