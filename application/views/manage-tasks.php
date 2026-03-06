<?php $this->load->view('includes/header'); ?>


<div class="p-md-5 page-body">
	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center">
			<h4 class="card-title mb-0">My Tasks</h4>
			<div class="card-action d-flex align-items-center gap-3">
				<a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Full Screen">
					<i class="fas fa-expand"></i>
				</a>
				<div class="dropdown">
					<a href="#" class="dropdown-toggle after-none" data-bs-toggle="dropdown" aria-expanded="false" title="More Action">
						<i class="fas fa-ellipsis-h"></i>
					</a>
					<div class="dropdown-menu dropdown-menu-end shadow rounded-4 p-2">
						<a href="#" class="dropdown-item rounded-pill"><i class="me-2 fa fa-share"></i> Share</a>
						<a href="#" class="dropdown-item rounded-pill"><i class="me-2 fa fa-pencil"></i> Rename</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item rounded-pill"><i class="me-2 fa fa-link"></i> Copy Link</a>
						<a href="#" class="dropdown-item rounded-pill"><i class="me-2 fa fa-folder"></i> Move to</a>
						<a href="#" class="dropdown-item rounded-pill"><i class="me-2 fa fa-download"></i> Download</a>
						<div class="dropdown-divider"></div>
						<a href="#" class="dropdown-item rounded-pill text-danger"><i class="me-2 fa fa-trash"></i> Delete</a>
					</div>
				</div>
			</div>
		</div>
		<!-- Shiv Web Developer -->
		<div class="p-3">
			<div class="task-container d-flex justify-content-between align-items-center p-3 border rounded mb-3 flex-wrap">
				<div class="task-details flex-grow-1">
					<h5 class="task-title mb-1">Design a Landing Page <span class="badge bg-warning">Expiring</span></h5>
					<p class="task-time text-muted mb-2"><i class="fas fa-clock"></i> 23 hours left</p>
					<a href="<?= base_url() ?>manage_bidders"> <button class="btn btn-sm btn-primary"><i class="fas fa-users"></i> Manage Bidders <span class="badge bg-light text-dark">3</span></button></a>
				</div>
				<div class="info-box d-flex justify-content-center gap-3 text-center">
					<div style="border-right: 1px solid #00b8d6;
    padding-right: 15px;">
						<span class="value d-block fw-bold">3</span>
						<p class="mb-0 text-muted p-manage-task">Bids</p>
					</div>
					<div style="border-right: 1px solid #00b8d6;
    padding-right: 15px;">
						<span class="value d-block fw-bold">$22</span>
						<p class="mb-0 text-muted p-manage-task">Avg. Bid</p>
					</div>
					<div>
						<span class="value d-block fw-bold">$15 - $30</span>
						<p class="mb-0 text-muted p-manage-task">Hourly Rate</p>
					</div>
				</div>
			</div>

			<div class="task-container d-flex justify-content-between align-items-center p-3 border rounded flex-wrap">
				<div class="task-details flex-grow-1">
					<h5 class="task-title mb-1">Food Delivery Mobile Application</h5>
					<p class="task-time text-muted mb-2"><i class="fas fa-clock"></i> 6 days, 23 hours left</p>
					<a href="<?= base_url() ?>manage_bidders"> <button class="btn btn-sm btn-primary"><i class="fas fa-users"></i> Manage Bidders <span class="badge bg-light text-dark">3</span></button></a>
				</div>
				<div class="info-box d-flex justify-content-center gap-3 text-center">
					<div style="border-right: 1px solid #00b8d6;
    padding-right: 15px;">
						<span class="value d-block fw-bold">3</span>
						<p class="mb-0 text-muted p-manage-task">Bids</p>
					</div>
					<div style="border-right: 1px solid #00b8d6;
    padding-right: 15px;">
						<span class="value d-block fw-bold">$3,200</span>
						<p class="mb-0 text-muted p-manage-task">Avg. Bid</p>
					</div>
					<div>
						<span class="value d-block fw-bold">$2,500 - $4,500</span>
						<p class="mb-0 text-muted p-manage-task">Fixed Price</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>
<!-- Shiv Web Developer -->