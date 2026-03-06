<?php include('includes/header.php') ?>
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
	<div class="card border-0">
		<div class="card-body p-md-4">
			<h5>Your profile status</h5>
			<div class="progress-container position-relative">
				<div class="progress-bar" style="width: <?= $profile_progress ?>%;"></div>
				<span class="completed-percentage"><?= $profile_progress ?>% Completed</span>
			</div>
			<?php if ($profile_progress < 100): ?>
				<p style="color: red; font-weight: bold;">
					You cannot access any features or post bricks until your profile is 100% complete.
					<br> Please fill in the required * details to proceed.
				</p>
			<?php endif; ?>
			<!-- Shiv Web Developer -->
			<div class="col-md-12 p-3">
				<div class="text-center text-md-center mb-4">
					<div class="text-center">
						<div class="position-relative d-inline-block">
							<!-- Profile Image -->
							<img src="<?= base_url() ?>assets/images/img/user.png" alt="User Icon" class="rounded-circle" width="120">

							<!-- Status Dot -->
							<span class="status-dot"></span>
						</div>

						<!-- Name and Mobile Number -->
						<div class="mt-2">
							<div class="fw-bold">Iqra Khan</div>
							<div class="text-muted small">+91 9876543210</div>
						</div>
					</div>


					<h4 class="mt-3" style="color: #127e8f;"><?= $getProfile['director_name'] ?></h4>
					<p><?= $getProfile['director_email'] ?></p>
					<div class="d-flex flex-wrap justify-content-center justify-content-md-center">
						<div class="rounded-2 py-2 px-3 me-2 mt-2 text-center" style="background: #00b8d65e">
							<small>Experience</small>
							<div class="fs-5">5+</div>
						</div>
						<div class="rounded-2 py-2 px-3 me-2 mt-2 text-center" style="background: #00b8d65e">
							<small>Total Earnings</small>
							<div class="fs-5">₹6,50,000</div>
						</div>
						<div class="rounded-2 py-2 px-3 me-2 mt-2 text-center" style="background: #00b8d65e">
							<small>Projects Completed</small>
							<div class="fs-5">35</div>
						</div>
					</div>
				</div>

				<div class="container-fluid">
					<div class="row g-0">
						<div class="col-md-6 box"></div>
						<div class="col-md-6 box"></div>
					</div>
					<div class="row g-0">
						<div class="col-md-6 box"></div>
						<div class="col-md-6 box"></div>
					</div>
					<div class="row g-0">
						<div class="col-md-6 box"></div>
						<div class="col-md-6 box"></div>
					</div>
					<div class="row g-0">
						<div class="col-md-6 box"></div>
						<div class="col-md-6 box"></div>
					</div>
					<div class="row g-0">
						<div class="col-md-6 box"></div>
						<div class="col-md-6 box"></div>
					</div>

				</div>


				<form method="POST" action="<?= base_url('Home/update_company_profile') ?>" class="p-3">
					<div class="row">
						<div class="col-6">
							<label class="form-label small text-muted">CIIN Number <span class="text-danger fs-5">*</span></label>
							<input type="text" class="form-control" name="ciin_number" placeholder="Enter CIIN Number" required value="<?= set_value('ciin_number', $getProfile['ciin_number'] ?? ''); ?>">
						</div>

						<div class="col-6">
							<label class="form-label small text-muted">DIPP Number</label>
							<input type="text" class="form-control" name="dipp_number" placeholder="Enter DIPP Number" value="<?= set_value('dipp_number', $getProfile['dipp_number'] ?? ''); ?>">
						</div>

						<div class="col-12 mt-3">
							<label class="form-label small text-muted">Company Name <span class="text-danger fs-5">*</span></label>
							<input type="text" class="form-control" name="company_name" placeholder="Enter Company Name" required value="<?= set_value('company_name', $getProfile['company_name'] ?? ''); ?>">
						</div>

						<div class="col-6 mt-3">
							<label class="form-label small text-muted">Director Name <span class="text-danger fs-5">*</span></label>
							<input type="text" class="form-control" name="director_name" placeholder="Enter Director Name" required value="<?= set_value('director_name', $getProfile['director_name'] ?? ''); ?>">
						</div>

						<div class="col-6 mt-3">
							<label class="form-label small text-muted">Director Contact Number <span class="text-danger fs-5">*</span></label>
							<input type="text" class="form-control" name="director_number" placeholder="Enter Contact Number" required value="<?= set_value('director_number', $getProfile['director_number'] ?? ''); ?>">
						</div>

						<div class="col-12 mt-3">
							<label class="form-label small text-muted">Director Email <span class="text-danger fs-5">*</span></label>
							<input type="email" class="form-control" name="director_email" placeholder="Enter Email" required value="<?= set_value('director_email', $getProfile['director_email'] ?? ''); ?>">
						</div>

						<div class="col-6 mt-3">
							<label class="form-label small text-muted">Account Holder Name</label>
							<input type="text" class="form-control" name="account_holder_name" placeholder="Enter Account Holder Name" value="<?= set_value('account_holder_name', $getProfile['account_holder_name'] ?? ''); ?>">
						</div>

						<div class="col-6 mt-3">
							<label class="form-label small text-muted">Account Number</label>
							<input type="text" class="form-control" name="account_number" placeholder="Enter Account Number" value="<?= set_value('account_number', $getProfile['account_number'] ?? ''); ?>">
						</div>

						<div class="col-6 mt-3">
							<label class="form-label small text-muted">Bank Name</label>
							<input type="text" class="form-control" name="bank_name" placeholder="Enter Bank Name" value="<?= set_value('bank_name', $getProfile['bank_name'] ?? ''); ?>">
						</div>

						<div class="col-6 mt-3">
							<label class="form-label small text-muted">IFSC Code</label>
							<input type="text" class="form-control" name="ifsc_code" placeholder="Enter IFSC Code" value="<?= set_value('ifsc_code', $getProfile['ifsc_code'] ?? ''); ?>">
						</div>

						<div class="col-6 mt-3">
							<label class="form-label small text-muted">Category <span class="text-danger fs-5">*</span></label>
							<input type="text" class="form-control" name="category" placeholder="Enter Company Category" required value="<?= set_value('category', $getProfile['category'] ?? ''); ?>">
						</div>

						<div class="col-6 mt-3">
							<label class="form-label small text-muted">Location <span class="text-danger fs-5">*</span></label>
							<input type="text" class="form-control" name="location" placeholder="Enter Location" required value="<?= set_value('location', $getProfile['location'] ?? ''); ?>">
						</div>

						<div class="col-12 mt-3">
							<label class="form-label small text-muted">About Us <span class="text-danger fs-5">*</span></label>
							<textarea class="form-control" name="about_us" rows="5" placeholder="Enter Company Details" required><?= set_value('about_us', $getProfile['about_us'] ?? ''); ?></textarea>
						</div>

						<div class="col-12 mt-3">
							<label class="form-label small text-muted">Mission <span class="text-danger fs-5">*</span></label>
							<textarea class="form-control" name="mission" rows="3" placeholder="Enter Company Mission" required><?= set_value('mission', $getProfile['mission'] ?? ''); ?></textarea>
						</div>

						<div class="col-12 mt-3">
							<label class="form-label small text-muted">Vision <span class="text-danger fs-5">*</span></label>
							<textarea class="form-control" name="vision" rows="3" placeholder="Enter Company Vision" required><?= set_value('vision', $getProfile['vision'] ?? ''); ?></textarea>
						</div>

						<div class="col-6 mt-3">
							<label class="form-label small text-muted">Company Valuation</label>
							<input type="number" class="form-control" name="valuation" placeholder="Enter Company Valuation" step="0.01" value="<?= set_value('valuation', $getProfile['valuation'] ?? ''); ?>">
						</div>

						<div class="col-6 mt-3">
							<label class="form-label small text-muted">Equity Dilution (%)</label>
							<input type="number" class="form-control" name="equity_dilution" placeholder="Enter Equity Dilution" step="0.01" value="<?= set_value('equity_dilution', $getProfile['equity_dilution'] ?? ''); ?>">
						</div>

						<div class="col-12 text-center mt-4">
							<button type="submit" class="btn btn-primary floating-submit-btn">Save Changes</button>
						</div>
					</div>
				</form>



			</div>
		</div>
	</div>
</div>

<!-- Shiv Web Developer -->
<?php include('includes/footer.php') ?>
<?php include('includes/footer-link.php') ?>
<script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
<script>
	// Apply CKEditor to textareas
	document.addEventListener("DOMContentLoaded", function() {
		CKEDITOR.replaceAll('editor');
	});
</script>