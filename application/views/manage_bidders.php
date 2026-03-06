<?php $this->load->view('includes/header'); ?>

<div class="p-md-5 page-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3 class="card-title mb-0">Manage Bidders</h3>
        </div>
        <div class="container-fluid pt-4 bg-white p-4" style="border-radius: 12px; width: 100%;">
            <p class="mb-3">Bids for <span style="color:rgb(34, 200, 255);">Food Delivery Mobile Application</span></p>
            <hr>
            <!-- Shiv Web Developer -->
            <!-- Bidder List Start -->
            <div class="bidder-list">
                <ul class="list-unstyled">

                    <!-- Single Bidder -->
                    <?php for ($i = 0; $i < 2; $i++) { ?>
                        <li class="row g-lg-4 g-2 align-items-center py-3">
                            <div class="col-md-6 col-12 d-flex align-items-center">
                                <img class="avatar lg rounded-circle border border-3 me-3" src="assets/images/img/user.jpg" alt="avatar">
                                <div>
                                    <h5 class="mb-1 text-gradient title-font">Poornima Pandey</h5>
                                    <span class="text-muted small">PoornimaPandey.@gmail.com</span>
                                    <div class="mt-3 d-flex gap-2">
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                            <i class="fa-solid fa-check"></i> Accept Offer
                                        </button>
                                        <button class="btn custom-post-task-btn" data-bs-toggle="modal" data-bs-target="#sendMessageModal">
                                            <i class="fa-solid fa-envelope"></i> Send Message
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 text-md-end text-start mt-3 mt-md-0">
                                <div class="d-flex justify-content-md-end justify-content-start gap-4">
                                    <div>
                                        <h5 class="mb-0">$3,200</h5>
                                        <p class="text-muted mb-0">Fixed Price</p>
                                    </div>
                                    <div class="border-start ps-3">
                                        <h5 class="mb-0">14 Days</h5>
                                        <p class="text-muted mb-0">Delivery Time</p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <hr>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Offer Acceptance Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3" style="border-radius: 10px;">
            <div class="modal-header  text-black">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-handshake me-2"></i> Offer Accepted</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img class="avatar rounded-circle border border-3" src="assets/images/img/user.jpg" alt="Freelancer Avatar" width="80">
                <h5 class="mt-2 text-gradient title-font">Poornima Pandey</h5>
                <p class="text-muted small">PoornimaPandey.@gmail.com</p>

                <div class="d-flex justify-content-between px-3">
                    <div>
                        <h6 class="mb-1 text-success"><i class="fa-solid fa-dollar-sign"></i> $3,200</h6>
                        <p class="text-muted small">Fixed Price</p>
                    </div>
                    <div class="border-start ps-3">
                        <h6 class="mb-1 text-primary"><i class="fa-solid fa-clock"></i> 14 Days</h6>
                        <p class="text-muted small">Delivery Time</p>
                    </div>
                </div>
                <p class="mb-0 fw-medium">You have successfully accepted the offer!</p>
                <p class="text-muted small">Next steps will be communicated shortly.</p>
            </div>
            <div class="modal-footer d-flex justify-content-center">

                <button type="button" class="btn btn-primary">Proceed</button>
            </div>
        </div>
    </div>
</div>

<!-- Send Message Modal -->
<div class="modal fade" id="sendMessageModal" tabindex="-1" aria-labelledby="sendMessageModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content p-3" style="border-radius: 10px;">
            <div class="modal-header text-black">
                <h5 class="modal-title fw-bold"><i class="fa-solid fa-envelope me-2"></i> Direct Message to David</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img class="avatar rounded-circle border border-3" src="assets/images/img/user.jpg" alt="Recipient Avatar" width="80">
                <h5 class="mt-2 text-gradient title-font">Poornima Pandey</h5>



                <textarea id="messageText" class="form-control" rows="4" placeholder="Type your message here..."></textarea>
            </div>
            <div class="modal-footer d-flex justify-content-center">

                <button type="button" class="btn btn-primary">Send</button>
            </div>
        </div>
    </div>
</div>
<!-- Shiv Web Developer -->
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>