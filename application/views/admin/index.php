<?php include('template/header-link.php') ?>
<?php include('template/header.php') ?>

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
		<li class="col-xl-3 col-lg-3">
			<div class="card text-center">
				<div class="card-body">
					<div class="py-3 m-0 text-center h2"><span data-purecounter-start="0" data-purecounter-separator="," data-purecounter-currency="" data-purecounter-end="<?= $totalConsultants ?>" class="purecounter">0</span></div>
					<span>Paid: <?= $totalPaidUsers ?>, Unpaid: <?= $totalUnaidUsers ?></span>
					<h5 class="fw-normal text-warning mb-0">Total Users</h5>
				</div>
			</div>
		</li>
		<li class="col-xl-3 col-lg-3">
			<div class="card text-center">
				<div class="card-body">
					<div class="py-4 m-0 text-center h2"><span data-purecounter-start="0" data-purecounter-separator="," data-purecounter-currency="" data-purecounter-end="<?= $totalProjectCreators ?>" class="purecounter"></span></div>
					<h5 class="fw-normal text-success">Total Companies</h5>
				</div>
			</div>
		</li>

		<li class="col-xl-3 col-lg-3">
			<div class="card text-center">
				<div class="card-body">
					<div class="py-4 m-0 text-center h2"><span data-purecounter-start="0" data-purecounter-separator="," data-purecounter-currency="" data-purecounter-end="<?= $totalProjects ?>" class="purecounter">0</span></div>

					<h5 class="fw-normal text-secondary">Total Projects</h5>
				</div>
			</div>
		</li>
		<li class="col-xl-3 col-lg-3">
			<div class="card text-center">
				<div class="card-body">
					<div class="py-3 m-0 text-center h2"><span data-purecounter-start="0" data-purecounter-separator="," data-purecounter-currency="" data-purecounter-end="<?= $totalBricks ?>" class="purecounter">0</span></div>
					<span>Private: <?= $totalPrivateBricks ?>, Public: <?= $totalPublicBricks ?></span>
					<h5 class="fw-normal text-primary mb-0">Total Bricks</h5>
				</div>
			</div>
		</li>

	</ul>

	<!-- Shiv Web Developer -->
</div>
</div>


<?php $this->load->view('admin/template/footer-link'); ?>