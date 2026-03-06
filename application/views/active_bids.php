<?php $this->load->view('includes/header'); ?>

<div class="p-md-5 page-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">My Active Bids</h3>
        </div>

        <div class="container w-100 bg-white p-4" style="border-radius: 12px;">
            <h5 class="card-title">Bids List</h5>
            <hr>
            <!-- Shiv Web Developer -->
            <?php for ($i = 0; $i < 3; $i++): ?>
                <ul class="row g-lg-4 g-2 list-unstyled li_animate">
                    <li class="col-md-6 col-12">
                        <div class="d-flex align-items-center mt-4">
                            <div class="ms-3">
                                <h4 class="mb-0 text-gradient title-font">Design a Landing Page</h4>
                                <div style="display: flex; align-items: center; gap: 8px; padding: 6px;">
                                    <!-- Edit Icon -->
                                    <!-- Edit Icon -->
                                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                        <i class="fa-solid fa-pen"></i> Edit
                                    </button>

                                    <!-- Delete Icon -->
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#sendMessageModal">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>

                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Styled List -->
                    <li class="col-md-6 col-12 mt-4">
                        <ul class="list-unstyled d-none d-md-flex align-items-start justify-content-md-end p-0 mb-0 ps-5 ps-md-0 ms-4 ms-md-0">
                            <!-- Bids Section -->
                            <li class="px-lg-4 px-3 ps-0 text-center">
                                <h5 class="mb-0 text-primary">$40</h5>
                                <p class="text-muted mb-1">Hourly Rate</p>
                            </li>

                            <!-- Avg. Bid Section -->
                            <li class="px-lg-4 px-3 border-start text-center">
                                <h5 class="mb-0 text-success">2 Days</h5>
                                <p class="text-muted mb-1">Delivery Time</p>
                            </li>
                        </ul>
                    </li>
                </ul>
                <hr>
            <?php endfor; ?>
        </div>
    </div>
</div>
<!-- Shiv Web Developer -->
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>


<!-- CONTENT UDPATE HERE - THIS IS DUMMY TEXT TESTING FROM LAKSHMEE  -->
 