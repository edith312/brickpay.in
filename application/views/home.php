<style>
	.filters {
		display: grid;
		grid-template-columns: repeat(4, 1fr);
		grid-gap: 10px;
	}

	.smoking-wrapper {
		width: 50px;
		overflow: hidden;
	}

	.smoking-wrapper.show {
		width: 100%;
	}

	@media (max-width: 991px) {
		.smoking-wrapper {
			width: auto;
			padding: 0;
		}

		.filters {
			grid-template-columns: repeat(1, 1fr);
		}
	}
</style>

<style>
	.project-row-one {
		position: relative;
		display: grid;
		grid-template-columns: auto 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		/* border-radius: 4px; */
		color: #00a7cc;
		font-weight: 600;
		border-bottom: 0;
	}

	.project-row-two {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		/* border-radius: 4px; */
		color: #00a7cc;
		font-weight: 600;
		border-bottom: 0;
	}

	.project-row-three {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		/* border-radius: 4px; */
		color: #00a7cc;
		font-weight: 600;
		border-bottom: 0;
	}

	.project-row-four {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		color: #00a7cc;
		font-weight: 600;
	}

	.project-row-five {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		color: #00a7cc;
		font-weight: 600;
	}
	.project-row-six {
		display: grid;
		grid-template-columns: 30px 1fr 1fr 1fr 1fr 25px;
		align-items: center;
		border: 1px solid #dce3e8;
		color: #00a7cc;
		font-weight: 600;
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
		font-size: 16px;
		color: #00a7cc;
	}

	.project-grid-bottom-1 {
		grid-template-columns: 30px repeat(4, 1fr);
	}
</style>

<style>
	.assigned-section {
		padding: 20px;
		background: #fff;
		border-radius: 8px;
	}

	.assigned-boxes {
		display: flex;
		justify-content: space-around;
		flex-wrap: wrap;
	}

	.box {
		padding: 15px;
		margin: 10px;
		background: #f1f1f1;
		border-radius: 5px;
		min-width: 150px;
	}


	.press-release button {
		font-size: 12px !important;
	}

	.press_release_showcase p {
		text-align: justify;
	}

	.press_release_showcase {
		border-bottom: 1px solid #ccc;
		padding-top: 10px;
	}

	.datetime {
		float: right;
		color: grey;
	}

	.socialMediaFeed {
		border: 1px solid grey;
		padding: 10px;
		border-radius: 10px;
		height: 600px;
		overflow-y: scroll !important;
	}

	.socialMediaFeedTitle {
		border-bottom: 1px solid grey;
	}

	.press_release_profile_pic{
		width: 30px;
		height: 30px;
		aspect-ratio: 1;
		object-fit: cover;
		border-radius: 50%;
	}
</style>

<style>
	.search-field tags, 
	.search-field input{
		padding-inline: 10px !important;
		border-radius: 25px;
	}
	.search-btn{
		right: 10px; 
		top: 50%; 
		transform: translateY(-50%); 
		border-radius: 50%; 
		background-color: transparent; 
		border: none; 
		cursor: pointer;
	}
	.progress-bar{
		background-color: #4772f3 !important;
	}
</style>

<?php include('includes/header.php') ?>
<div class="toggle-smoking-icon text-start my-3" style="position: relative;">
	<i class="fas fa-smoking fa-2x text-primary smokingToggleWrapper" id="smokingIcon" style="cursor: pointer;"></i>
</div>

<div class="ps-md-4 pe-md-3 px-2 py-3 page-body d-flex vh-100">
	<div class="smoking-wrapper">
		<div id="smokingPanel" class="smoking-panel">
			<div class="panel-content">
				<div class="d-flex justify-content-between">
					<h5>Smoking Panel</h5>
					<div>
						<a href="<?= base_url('/calendar/index') ?>" class="btn btn-primary"> Calendar </a>
					</div>
				</div>
				<p>You will see all brick creation and company updates.</p>
			</div>
			<div class="me-2">
				<div class="position-relative mb-2 search-field">
					<input id="user-search" class="form-control" type="text" placeholder="Search User" value='' name='user_search'>
					<button type="button" class="btn btn-outline-secondary position-absolute search-btn">
						<i class="fa fa-search" style="color: #555;"></i>
					</button>
				</div>
				<div class="position-relative mb-2 search-field">
					<input id="company-search" class="form-control" type="text" placeholder="Search Company" value='' name='company_search'>
					<button type="button" class="btn btn-outline-secondary position-absolute search-btn">
						<i class="fa fa-search" style="color: #555;"></i>
					</button>
				</div>
				<div class="position-relative mb-2 search-field">
					<input id="project-search" class="form-control" type="text" placeholder="Search Project">
					<button type="button" class="btn btn-outline-secondary position-absolute search-btn">
						<i class="fa fa-search" style="color: #555;"></i>
					</button>
				</div>
				<div class="position-relative mb-2 search-field">
					<input id="task-search" class="form-control" type="text" placeholder="Search Task">
					<button type="button" class="btn btn-outline-secondary position-absolute search-btn">
						<i class="fa fa-search" style="color: #555;"></i>
					</button>
				</div>
				

				<div class="socialMediaFeed mt-5">
					<div class="socialMediaFeedTitle">
						<h5>Social Media Feed</h5>
					</div>
					<div class="SocialMediaFeedContainer">
						<?php foreach ($press_releases as $release) { ?>

							<div class="press_release_showcase">

								<!-- HEADER -->
								<div class="d-flex align-items-center gap-3 mb-2">

									<img
										class="press_release_profile_pic"
										src="<?= !empty($release->user_image)
											? base_url('uploads/user_profile/' . $release->user_image)
											: base_url('assets/images/img/user.png'); ?>"
										alt="User"
									>

									<div class="flex-grow-1">
										<?php if (!empty($release->name)) { ?>

											<div class="fw-semibold">
												<?= $release->name; ?>
											</div>

										<?php } elseif (!empty($release->email)) { ?>

											<div class="fw-semibold text-muted">
												<?= $release->email; ?>
											</div>

										<?php } else { ?>

											<div class="fw-semibold text-muted">
												Anonymous
											</div>

										<?php } ?>
									</div>

									<a href="<?= base_url("$release->type/press-release/$release->id") ?>">
										👁️
									</a>

									<div class="text-muted small">
										<?= date('d M Y · h:i A', strtotime($release->created_date)); ?>
									</div>

								</div>

								<!-- CONTEXT -->
								<div class="mb-2 text-muted small d-flex flex-column">

									<?php if (in_array($release->type, ['company', 'project']) && !empty($release->company_name)) { ?>
										<span class="ms-2">
											Company: <strong><?= $release->company_name; ?></strong>
										</span>
									<?php } ?>

									<?php if ($release->type === 'project' && !empty($release->project_name)) { ?>
										<span class="ms-2">
											Project: <strong><?= $release->project_name; ?></strong>
										</span>
									<?php } ?>

								</div>

								<!-- CONTENT -->
								<p class="press_release_content">
									<?= nl2br($release->press_release); ?>
								</p>

								<!-- FOOTER -->
								<div class="mt-2 small text-muted">
									ID: <?= $release->uniq_id; ?>
									<span class="badge bg-light text-dark border">
										<?= ucfirst($release->type); ?>
									</span>
								</div>

							</div>

							<?php } ?>


					</div>

				</div>

			</div>

		</div>
	</div>
	<div class="w-100">
		<ul class="row g-3 list-unstyled main-content">
			<div class="col-12">
				<div class="aiboxintegration" style="float:right;">
					<img src="<?= base_url('assets/images/jarvisai.png') ?>" alt="jarvisai" id="jarvisai" style="height:50px; width:50px; border-radius:100%; cursor:pointer; border: 1px solid grey; padding:2px;">
				</div>
				<div class="aiboxintegration me-2" style="float:right;">
					<img src="<?= base_url('assets/images/gurukul.png') ?>" alt="jarvisai" id="jarvisai" style="height:50px; width:50px; border-radius:100%; cursor:pointer; border: 1px solid grey; padding:2px;">
				</div>
			</div>
			<li class="col-xl-3 col-lg-3">
				<div class="card text-center">
					<div class="card-body">
						<div class="py-4 m-0 text-center h2"><span data-purecounter-start="0" data-purecounter-separator="," data-purecounter-currency="" data-purecounter-end="<?= $totalConsultants ?>" class="purecounter">0</span></div>

						<h5 class="fw-normal text-warning">Total Users</h5>
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
		<div class="col-md-2">
			<h2 id="filterToggle" class="filters-toggle">
				<i class="fa-solid fa-filter me-2 text-white"></i> Filters:
			</h2>
		</div>

		<form method="GET" action="" class="filters" id="filtersSection" style="display: none;">
			<div class="border-bottom pb-3 mb-3" style="border-bottom: 1px dotted #999;">
				<div class="filter-box">
					<label for="">Work Type</label>
					<div class="d-flex gap-1 mt-1">
						<div class="form-check">
							<input id="fitler-both" name="filter_work" value="both" type="radio" class="form-check-input" checked>
							<label class="form-check-label" for="fitler-both">Both</label>
						</div>
						<div class="form-check">
							<input id="fitler-onsite" name="filter_work" value="Onsite" type="radio" class="form-check-input">
							<label class="form-check-label" for="fitler-onsite">Onsite</label>
						</div>
						<div class="form-check">
							<input id="filter-remote" name="filter_work" value="Remote" type="radio" class="form-check-input">
							<label class="form-check-label" for="filter-remote">Remote</label>
						</div>
					</div>
				</div>
				<div class="filter-box">
					<label for="">Monetization Range</label>
					<div class="d-flex gap-3 mt-2">
						<div class="bg-white rounded shadow-sm border p-2 text-start flex-fill">
							<div class="d-flex align-items-center justify-content-between mb-2">
								<div class="form-check d-flex align-items-center gap-2 m-0">
									<input class="form-check-input" type="radio" name="monetization" id="hourly" value="hourly">
									<label class="form-check-label m-0" for="hourly">Duration</label>
								</div>
								<i class="fas fa-clock" style="font-size: 19px;color:#274bb7;"></i>
							</div>
							<select class="form-control" name="hourly-units" id="hourly-units">
								<option value="">Select Time Unit</option>
								<option value="seconds">Seconds</option>
								<option value="minutes">Minutes</option>
								<option value="hours">Hours</option>
								<option value="days">Days</option>
								<option value="weeks">Week</option>
								<option value="months">Month</option>
								<option value="years">Year</option>
							</select>
							<div class="filter-box mt-md-1">
								<input class="form-control" type="text" name="" placeholder="No of Units">
							</div>
						</div>


						<div class="bg-white rounded shadow-sm border p-2 text-start flex-fill">
							<div class="d-flex align-items-center justify-content-between mb-2">
								<div class="form-check d-flex align-items-center gap-2 m-0">
									<input class="form-check-input" type="radio" name="monetization" id="fixed" value="fixed">
									<label class="form-check-label m-0" for="fixed">Fixed Price</label>
								</div>
								<i class="fas fa-tag" style="font-size: 19px;color:#274bb7;"></i>
							</div>
							<select class="form-control" name="fixed-options" id="fixed-options">
								<option value="">Select Option</option>
								<option value="feature">Feature Wise</option>
								<option value="commission">Commission Wise %</option>
							</select>
							<div class="filter-box mt-md-1">
								<input class="form-control" type="text" name="" placeholder="Com (%) / Feature(Amount)">
							</div>
						</div>

					</div>
				</div>



				<div class="filter-box mt-md-1">
					<label for="brick_type">Select Type of Tasks</label>
					<select class="form-control" name="brick_type" id="brick_type">
						<option value="">Select </option>
						<option value="Silver">L1 - Silver Task (0 - 1000 INR)</option>
						<option value="Golden">L2 - Golden Task (1000 INR to 10,000 INR)</option>
						<option value="Platinum">L3 - Platinum Task (10,000 INR to 1,00,000 INR)</option>
						<option value="Titanium">L4 - Titanium Task (1,00,000 INR to 10,00,000 INR)</option>
						<option value="Vibranium">L5 - Vibranium Task (10,00,000 INR to 100,000,000 INR)</option>
					</select>
				</div>


				<div class="filter-box">
					<label for="">Execution Time</label>
					<input class="form-control" type="text" name="filter-execution" id="filter-execution" placeholder="Execution Time">
					<div class="d-flex gap-1 mt-1">
						<div class="form-check">
							<input id="debit" name="execution_unit" value="seconds" type="radio" class="form-check-input">
							<label class="form-check-label" for="debit">Seconds</label>
						</div>
						<div class="form-check">
							<input id="debit" name="execution_unit" value="minutes" type="radio" class="form-check-input">
							<label class="form-check-label" for="debit">Minutes</label>
						</div>
						<div class="form-check">
							<input id="debit" name="execution_unit" value="hours" type="radio" class="form-check-input">
							<label class="form-check-label" for="debit">Hours</label>
						</div>
						<div class="form-check">
							<input id="credit" name="execution_unit" value="days" type="radio" class="form-check-input">
							<label class="form-check-label" for="credit">Days</label>
						</div>
						<div class="form-check">
							<input id="debit" name="execution_unit" value="week" type="radio" class="form-check-input">
							<label class="form-check-label" for="debit">Week</label>
						</div>
						<div class="form-check">
							<input id="debit" name="execution_unit" value="months" type="radio" class="form-check-input">
							<label class="form-check-label" for="debit">Month</label>
						</div>
						<div class="form-check">
							<input id="debit" name="execution_unit" value="years" type="radio" class="form-check-input">
							<label class="form-check-label" for="debit">Years</label>
						</div>
					</div>
				</div>



				<!-- NEW SEARCH FILTE ADDED BY @Shiv Web Developerr -->
				<div class="my-3" style="height: 2px; width: 100%; border:1px dashed grey;"></div>

				<div class="row g-0" style="width:600px;">
					<div class="col-md-4 col-lg-4 p-0">
						<div class="input-group py-2">
							<span class="input-group-text bg-white border-end-0 d-flex align-items-center"
								style="height: 100%;">
								<i class="fa fa-search text-muted" style="height: 21px;"></i>
							</span>
							<select class="form-control mb-0" name="company_id" id="company_id">
								<option disabled selected>Select Company</option>
								<?php if ($getCompanies) {
									foreach ($getCompanies as $company) { ?>
										<option value="<?= $company['id']; ?>">
											<?= $company['company_name']; ?> (CIN: <?= $company['ciin_number']; ?>)
										</option>
									<?php }
								} else { ?>
									<option disabled selected>No Company Found</option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="col-md-4 col-lg-4 p-0">
						<div class="input-group py-2">
							<span class="input-group-text bg-white border-end-0 d-flex align-items-center"
								style="height: 100%;">
								<i class="fa fa-search text-muted" style="height: 21px;"></i>
							</span>
							<select class="form-control mb-0" name="project_id" id="project_id">
								<option disabled selected>Select Project</option>
							</select>
						</div>
					</div>

					<div class="col-md-4 col-lg-4 p-0">
						<div class="input-group py-2">
							<span class="input-group-text bg-white border-end-0 d-flex align-items-center"
								style="height: 100%;">
								<i class="fa fa-search text-muted" style="height: 20px;"></i>
							</span>
							<select class="form-control mb-0" name="brick_id" id="brick_id">
								<option disabled selected>Select Brick</option>
							</select>
						</div>
					</div>
					<div class="mb-3 col-md-6 col-lg-6 row g-0">
						<div class="col-md-12 g-0">
							<div class="input-group" style="width:500px !important;">
								<span class="input-group-text">
									<i class="bi bi-search"></i>
								</span>
								<input class="form-control" id="team-member-input" name='user_search' placeholder='Search user by name' value=''>
							</div>
						</div>
					</div>
				</div>

				<!-- Selection Type Display -->
				<!-- <div class="col-12 mt-3">
					<div class="alert alert-info" id="selectionTypeAlert" style="display: none;">
						<strong>Current Selection:</strong> <span id="selectionTypeText"></span>
						<span id="modeIndicator" class="badge bg-primary ms-2"></span>
					</div>
				</div> -->
			</div>
			<!-- New Searches Added by @Shiv Web Developer -->


			<div class=" pb-3 mb-3">
				<div class="filter-box">
					<label for="">Current Location</label>
					<input class="form-control" type="text" name="filter-location" id="filter-location" placeholder="Location">
				</div>
				<div class="filter-box">
					<label for="">Country</label>
					<input class="form-control" type="text" name="filter_country" id="filter-country" placeholder="Country">
				</div>
				<div class="filter-box">
					<label for="">State</label>
					<input class="form-control" type="text" name="filter_state" id="filter-state" placeholder="State">
				</div>

				<div class="filter-box">
					<label for="">Location Range
					</label>
					<input class="form-control" type="text" name="filter_range" id="" placeholder="Location Range in (Km.)">
				</div>

				<div class="filter-box mt-5">
					<label for="">Search by Brick Title
					</label>
					<input class="form-control" type="text" name="filter_brick_details" id="" placeholder="Enter Brick Title">
				</div>

				<div class="filter-box mt-5">
					<label for=""> Globally Search Filter </label>
					<input class="form-control" type="text" name="globally_search_filter" id="globally_search_filter" placeholder="Search....">
				</div>

			</div>

			<div class=" pb-3 mb-3">
				<div class="filter-box">
					<label for="filter-revenue">Revenue</label>
					<div class="d-flex">
						<input class="form-control" type="number" name="filter_revenue_from" id="" placeholder="Amount">
						<span class="mx-0 mt-2">-</span>
						<input class="form-control" type="number" name="filter_revenue_to" id="" placeholder="Amount">

						<!-- Revenue Type Dropdown placed next to the first one -->
						<select class="form-control" name="filter-revenue-type" id="filter-revenue-type">
							<option value="">Select</option>
							<option value="project">Project</option>
							<option value="company">Company</option>
						</select>
					</div>
				</div>


				<div class="filter-box">
					<label for="filter-industry">Industry</label>
					<div class="d-flex">
						<select class="form-control" name="filter-industry" id="filter-industry">
							<option value="">Select Industry</option>
							<option value="it">IT</option>
							<option value="construction">Construction</option>
							<option value="finance">Finance</option>
							<option value="healthcare">Healthcare</option>
						</select>

						<!-- Example of second dropdown placed beside the first one -->
						<select class="form-control" name="filter-industry-type" id="filter-industry-type">
							<option value="">Select</option>
							<option value="project">Project</option>
							<option value="company">Company</option>
						</select>
					</div>
				</div>

				<div class="filter-box">
					<label for="filter-department">Department</label>
					<div class="d-flex">
						<select class="form-control" name="filter-department" id="filter-department">
							<option value="">Select Department</option>
							<option value="sales">Sales</option>
							<option value="marketing">Marketing</option>
							<option value="hr">HR</option>
							<option value="admin">Admin</option>
						</select>

						<!-- Example of second dropdown placed beside the first one -->
						<select class="form-control" name="filter-department-type" id="filter-department-type">
							<option value="">Select</option>
							<option value="project">Company</option>
							<option value="company">Company</option>
						</select>
					</div>
				</div>

			</div>


			<div class=" pb-3 mb-3" style="">
				<div class="filter-box">
					<label for="">Skills</label>
					<input class="form-control" type="text" name="filter_skills" id="filter_skills" placeholder="Skills">
				</div>
				<div class="filter-box">
					<label for="">Education</label>
					<input class="form-control" type="text" name="filter_education" id="filter_education" placeholder="Education">
				</div>
			</div>
			<div class="" style="text-align: right;">
				<button type="submit" class="btn btn-primary">Search</button>
			</div>
		</form>




		<div>
			<?php
			if (isset($filterSetup) && !empty($filterSetup)) {
				echo '<div class="d-flex"> <h5>Active Filters</h5> <a href="' . base_url('company/dashboard') . '" class="btn btn-danger mb-2 ms-2 p-1 px-2" style="font-size:12px;">Clear Filters</a> </div>';
				foreach ($filterSetup as $key => $value) {
					if (!empty($value)) {
						echo '<span class="badge bg-primary me-2">' . ucfirst(str_replace('_', ' ', $key)) . ': ' . htmlspecialchars($value) . '</span>';
					}
				}
			} elseif (isset($filterSetup) && empty($filterSetup)) {
				echo '<h5>No Active Filters</h5>';
			} else {
				echo '<h5>No Active Filters</h5>';
			}

			?>
		</div>

		<style>
			.bg-artificialbrick {
				background-color: silver;
				color: black !important;
			}

			.bg-artificialbrickartificial {
				background-color: #ebe306ff;
				/* font-weight: 700; */
				color: black !important;
			}

			.bg-markascompleted {
				background-color: #ff6501;
			}
		</style>


		<div id="companyList">
			<?php
				if ($getBricks) {
					$brickCount = 1;
					foreach ($getBricks as $bricks) {
						$brickFunding = $this->CommonModal->getSingleRowById('tbl_brick_funding', 'brick_id = ' . $bricks['id']);
				?>
						<div class="mt-md-5 rounded-0" style="border-left: 4px solid <?= brickColor($bricks['brick_type']) ?>">
							<div class="project-row-one">
								<span class="brickStatus
									<?php
									if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] == NULL) {
										echo 'bg-markascompleted';
									} else if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] != NULL) {
										echo 'bg-artificialbrickartificial';
									} else if ($bricks['artificialdate'] != NULL) {
										echo 'bg-artificialbrick';
									} else { ?>
										bg-<?= ($bricks['brick_status'] == 'draft' ? 'warning' : 'primary') ?> text-white <?php } ?>  
										text-white  text-capitalize">
										<?php
										if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] == NULL) {
											echo 'Completed';
										} else if ($bricks['brick_completed'] == 'completed' && $bricks['artificialdate'] != NULL) {
											echo 'Artificial Brick - Completed';
										} else if ($bricks['artificialdate'] != NULL) {
											echo 'Artificial Brick'; ?>
											<?= ($bricks['brick_status'] == 'draft' ? 'Draft' : ' - Live'); ?>
										<?php } else { ?>
										<?= ($bricks['brick_status'] == 'draft' ? 'Draft' : 'Live');
										} ?>
									</span>
									<div class="project-cell"><?= $brickCount++ ?></div>
									<div class="project-cell">Brick Title: <?= $bricks['brick_title'] ?></div>
									<div class="project-cell text-center px-1">
										<a href="<?= base_url('company/preview_brick?id=' . $bricks['id']) ?>" title="View Details">
											<i class="bi bi-eye-fill eye-icon"></i>
										</a>
									</div>
							</div>
							<div class="project-row-two border-top-0 border-bottom-0">
								<div class="project-cell" style="display: flex; align-items: center; justify-content: center; padding: 0; height: 100%;">
									<span class="project-dot green"></span>
								</div>
								<div class="project-cell">
									Project: <?= projectName($bricks['project_id']) ?></div>
								<div class="project-cell">Company: <?= companyName($bricks['company_id']) ?></div>
								<div class="project-cell">Brick Id: <?= generateBrickId($bricks['id']) ?></div>
								<div class="project-cell">Privacy : <span class="text-capitalize"><?= $bricks['brick_privacy'] ?></span></div>
								<?php if ($bricks['user_id'] == sessionId('freelancer_id')) {?>
										<a href="<?= base_url('company/create-brick?id=' . $bricks['id']) ?>" title="Edit Details" class="text-center">
											<i class="bi bi-pencil"></i>
										</a>
								<?php } else { ?>
										<div class="project-cell h-100"></div>
								<?php } ?>
							</div>
							<div class="project-row-three border-top-0">
								<div class="project-cell h-100"></div>
								<div class="project-cell">Step 1 - Fund Required: <span id="total_amount">
									<?php
										$cur_arr = explode('|',$bricks['currency_symbol']); 
										echo $cur_arr[1]; echo ' - '; echo $cur_arr[0];
									?>
									<?= $bricksFunding['fund_required'] ?></span>
								</div>
								<div class="project-cell h-100">Step 2 - Reward: <?= $bricks['reward_disclosed'] ?></div>
								<div class="project-cell h-100">Step 3 - Completion Report:</div>
								<div class="project-cell h-100">Step 4 - Voting:</div>
								<div class="project-cell h-100 px-1 text-center">
									<?php
										if ($bricks['user_id'] == sessionId('freelancer_id')) {
										?>
											<a href="<?= base_url('company/brick-trash?id=' . $bricks['id']) ?>" title="Delete Company" class="text-danger" onclick="return confirm('Are you sure you want to delete this brick?');">
												<i class="bi bi-trash"></i>
											</a>
									<?php } ?>
								</div>
							</div>
							<div class="project-row-five border-top-0">
								<div class="project-cell h-100"></div>
								<div class="project-cell h-100">Step 1.1 - Type: <?= $bricksFunding['funding_type'] ?></div>
								<div class="project-cell h-100">Step 2.1 - Resources: </div>
								<div class="project-cell h-100">Step 3.1 - Updated Valuation:</div>
								<div class="project-cell h-100"></div>
								<div class="project-cell h-100 px-1 text-center">
									<a href="<?= base_url("Home/brick_pdf?brick_id=$bricks[id]")?>" >
										<i class="fa-solid fa-arrow-down"></i>
									</a>
								</div>
							</div>
							<div class="project-row-six border-top-0">
								<div class="project-cell h-100"></div>
								<div class="project-cell h-100">Step 1.12 - Network Marketing for Fund : <br> 11111</div>
								<div class="project-cell h-100">Step 2.12 - Network Marketing for Resources : <br> 11111</div>
								<div class="project-cell h-100">Step 3.12 -  :</div>
								<div class="project-cell h-100"></div>
								<div class="project-cell h-100"></div>
							</div>
							<div class="project-row-four border-top-0">
								<div class="project-cell h-100"></div>
								<div class="project-cell h-100">Currency: <?php
									$cur_arr = explode('|',$bricks['currency_symbol']); 
									echo $cur_arr[1]; echo ' - '; echo $cur_arr[0];
									?></div>
								<div class="project-cell" style=""><?= brickType($bricks['brick_type']) ?></div>
								<div class="project-cell">Date: <span class="text-capitalize"><?= $bricks['create_date'] ?></span></div>
								<div class="project-cell"> Artificial Date: <span class="text-capitalize">
										<?php
										if ($bricks['artificialdate'] != NULL) { ?>
											<?= $bricks['artificialdate'] ?>

										<?php } else {
											echo '...';
										} ?>
									</span>
								</div>
								<div class="project-cell h-100"></div>
							</div>
						</div>
						<div class="">
							<?php
							if ($bricks['brick_completed'] == 'completed') {
							?>
								<!-- <h6>Completed:</h6> -->
								<div class="progress">
									<div style="width: 100%; background-color: #ff6501 !important;" class="progress-bar"></div>
								</div>
								<small class="text-muted">Brick completed in <strong>100%</strong>. Remaining close the Brick.</small>

							<?php } else { ?>
								<!-- <h6>Completed:</h6> -->
								<div class="progress">
									<div style="width: 60%;" class="progress-bar"></div>
								</div>
								<small class="text-muted">Brick completed in <strong>60%</strong>. Remaining close the Brick.</small>
							<?php } ?>
						</div>
						<!-- <div class="project-grid project-grid-bottom-1 rounded-0 position-relative" style="border-left: 4px solid <?= brickColor($bricks['brick_type']) ?>">
							
							
							<div class="project-cell" style="width:30px;"></div>

						</div> -->
				<?php
					}
				} else {
					echo '<div class="alert alert-info my-5">No Bricks Found</div>';
				}
			?>

		</div>
	</div>
</div>
</div>

<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>
<script>
	const toggleSmokingIcon = document.querySelector('.smokingToggleWrapper');
	const smokingWrapper = document.querySelector('.smoking-wrapper');

	toggleSmokingIcon?.addEventListener('click', function() {
		smokingWrapper?.classList.toggle('show')
	})
	const smokingIcon = document.getElementById("smokingIcon");
	const smokingPanel = document.getElementById("smokingPanel");
	const closePanel = document.getElementById("closePanel");

	smokingIcon.addEventListener("click", () => {
		smokingPanel.classList.toggle("open");
	});

	closePanel.addEventListener("click", () => {
		smokingPanel.classList.remove("open");
	});
</script>
<script>
	function performSearch() {
		const searchTerm = document.getElementById('project_name_1').value;
		if (searchTerm) {
			console.log('Searching for:', searchTerm);
		}
	}
</script>

<script>
	const toggleBtn = document.getElementById("filterToggle");
	const filtersSection = document.getElementById("filtersSection");

	toggleBtn.addEventListener("click", () => {
		if (filtersSection.style.display === "none") {
			filtersSection.style.display = "grid";
		} else {
			filtersSection.style.display = "none";
		}
	});
</script>

<script>
	document.getElementById('filtersSection').addEventListener('submit', function(e) {
		const inputs = this.querySelectorAll('input, select, textarea');

		inputs.forEach(function(input) {
			if (!input.value.trim()) {
				input.disabled = true; // disables empty fields so they won't be included in URL
			}
		});
	});
</script>

<script>
	// @Shiv Web Developer on 07 July 2025
	$(document).ready(function() {

		let currentCompanyId = null;
		let currentProjectId = null;
		let currentBrickId = null;
		let currentSelectionType = null;


		var tagify = new Tagify(inputElm, {
			tagTextProp: 'label', // show name in UI
			templates: {
				tag: tagTemplate
			}
		});

		// ✅ Before form submit: replace JSON with only values
		document.querySelector("form").addEventListener("submit", function(e) {
			let tags = tagify.value; // array of objects
			if (tags.length > 0) {
				// Replace field value with only comma-separated values
				inputElm.value = tags.map(t => t.value).join(",");
			}
		});


		//SEARCH USER FILTER
		var inputElm = document.querySelector('#team-member-input');

		function tagTemplate(tagData) {
			return `
            <tag title="${tagData.email || ''}" 
                 contenteditable='false' 
                 spellcheck='false' 
                 tabIndex="-1" 
                 class="tagify__tag" 
                 value="${tagData.value}">
                <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
                <div class="d-flex align-items-center">
                    <img src="${tagData.avatar || 'assets/user-icon.png'}" 
                         class="rounded-circle me-2" 
                         style="width: 24px; height: 24px;">
                    <div>
                        <div class="fw-bold">${tagData.label || tagData.value}</div>
                        <small class="text-muted">${tagData.email || ''}</small>
                    </div>
                </div>
            </tag>
        `;
		}

		function suggestionItemTemplate(tagData) {
			return `
            <div ${this.getAttributes(tagData)}
                class='tagify__dropdown__item d-flex align-items-center ${tagData.class ? tagData.class : ""}'
                tabindex="0"
                role="option">
                ${ tagData.avatar ? `
                <div class='tagify__dropdown__item__avatar-wrap'>
                    <img onerror="this.style.visibility='hidden'" class="avatar rounded me-2" src="${tagData.avatar}">
                </div>` : ''
                }
                <div>
                    <div class="fw-bold">${tagData.label || tagData.value}</div>
                    <small class="text-muted">${tagData.email || ''}</small>
                </div>
            </div>
        `;
		}

		function dropdownHeaderTemplate(suggestions) {
			return `
            <div class="${this.settings.classNames.dropdownItem} ${this.settings.classNames.dropdownItem}__addAll">
                <strong>${this.value.length ? `Add remaining ${suggestions.length}` : 'Add All'}</strong>
                <span>${suggestions.length} members</span>
            </div>
        `;
		}

		// INISILIZE USER SEARCH
		var tagify = new Tagify(inputElm, {
			tagTextProp: 'name',
			enforceWhitelist: true,
			skipInvalid: true,
			dropdown: {
				closeOnSelect: false,
				enabled: 0,
				classname: 'users-list',
				searchKeys: ['name', 'email']
			},
			templates: {
				tag: tagTemplate,
				dropdownItem: suggestionItemTemplate,
				dropdownHeader: dropdownHeaderTemplate
			},
			whitelist: []
		});

		tagify.on('input', function(e) {
			var value = e.detail.value.trim();
			tagify.loading(true);

			fetch('<?php echo base_url('Home/searchUsers'); ?>', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json'
					},
					body: JSON.stringify({
						search: value
					})
				})
				.then(response => response.json())
				.then(data => {
					tagify.loading(false);
					if (data.success && Array.isArray(data.users)) {
						tagify.settings.whitelist = data.users.map(user => ({
							value: user.id,
							name: user.name,
							label: user.name,
							email: user.email,
							avatar: user.avatar || 'assets/user-icon.png'
						}));
						tagify.dropdown.show(value);
					} else {
						tagify.settings.whitelist = [];
						tagify.dropdown.hide();
						alert('No users found or invalid response from server.');
					}
				})
				.catch(error => {
					tagify.loading(false);
					console.error('Error searching users:', error);
					alert('Failed to search users: ' + error.message);
				});
		});

		// USER SEARCH END


		// Company change handler
		$('#company_id').on('change', function() {
			currentCompanyId = $(this).val();
			currentProjectId = null;
			currentBrickId = null;
			currentSelectionType = 'company';

			$('#project_id').html('<option disabled selected>Select Project</option>');
			$('#brick_id').html('<option disabled selected>Select Brick</option>');

			updateSelectionDisplay();
			if (currentCompanyId) {
				fetchProjects(currentCompanyId);
				if (currentMode === 'edit') {
					loadExistingTeamStructure();
				}
			};

		});

		// Project change handler
		$('#project_id').on('change', function() {
			currentProjectId = $(this).val();
			currentBrickId = null;

			if (currentProjectId) {
				currentSelectionType = 'project';
				$('#brick_id').html('<option disabled selected>Select Brick</option>');

				updateSelectionDisplay();

				if (currentCompanyId && currentProjectId) {

					fetchBricks(currentCompanyId, currentProjectId);
					if (currentMode === 'edit') {
						loadExistingTeamStructure();
					}
				}

			}
		});

		// Brick change handler
		$('#brick_id').on('change', function() {
			currentBrickId = $(this).val();

			if (currentCompanyId && currentProjectId && currentBrickId) {

				currentSelectionType = 'brick';
				updateSelectionDisplay();
				if (currentMode === 'edit') {
					loadExistingTeamStructure();
				}
			}
		});

		function updateSelectionDisplay() {
			const alert = $('#selectionTypeAlert');
			const text = $('#selectionTypeText');

			if (currentSelectionType) {
				let displayText = '';
				switch (currentSelectionType) {
					case 'company':
						displayText = `Company Selected (ID: ${currentCompanyId})`;
						break;
					case 'project':
						displayText = `Project Selected (ID: ${currentProjectId})`;
						break;
					case 'brick':
						displayText = `Brick Selected (ID: ${currentBrickId})`;
						break;
				}
				text.text(displayText);
				alert.show();
			} else {
				alert.hide();
			}
		}

		function getCurrentId() {
			if (currentSelectionType === 'brick' && currentBrickId) return currentBrickId;
			if (currentSelectionType === 'project' && currentProjectId) return currentProjectId;
			if (currentSelectionType === 'company' && currentCompanyId) return currentCompanyId;
			return null;
		}

		function updateSelectionDisplay() {
			const alert = $('#selectionTypeAlert');
			const text = $('#selectionTypeText');

			if (currentSelectionType) {
				let displayText = '';
				switch (currentSelectionType) {
					case 'company':
						displayText = `Company Selected (ID: ${currentCompanyId})`;
						break;
					case 'project':
						displayText = `Project Selected (ID: ${currentProjectId})`;
						break;
					case 'brick':
						displayText = `Brick Selected (ID: ${currentBrickId})`;
						break;
				}
				text.text(displayText);
				alert.show();
			} else {
				alert.hide();
			}
		}



		function fetchProjects(companyId) {
			$.post('<?= base_url('Home/fetch_projects') ?>', {
					company_id: companyId
				})
				.done(function(response) {
					try {
						let res = (typeof response === "string") ? JSON.parse(response) : response;

						if (res.success && res.projects.length > 0) {
							let options = '<option disabled selected>Select Project</option>';
							res.projects.forEach(project => {
								options += `<option value="${project.id}">${project.project_name}</option>`;
							});
							$('#project_id').html(options);
						} else {
							$('#project_id').html('<option disabled selected>No Projects Found</option>');
						}
					} catch (e) {
						console.error("Invalid JSON:", e, response);
						$('#project_id').html('<option disabled selected>Error Parsing Projects</option>');
					}
				})
				.fail(function() {
					$('#project_id').html('<option disabled selected>Error Loading Projects</option>');
				});
		}

		function fetchBricks(companyId, projectId) {
			$.post('<?= base_url('Home/fetch_bricks') ?>', {
					company_id: companyId,
					project_id: projectId
				})
				.done(function(response) {
					console.log("Bricks", response);
					if (response.success) {
						let options = '<option disabled selected>Select Brick</option>';
						response.bricks.forEach(brick => {
							options += `<option value="${brick.id}">${brick.brick_title}</option>`;
						});
						$('#brick_id').html(options);
					} else {
						$('#brick_id').html('<option disabled selected>No Bricks Found</option>');
					}
				})
				.fail(function() {
					$('#brick_id').html('<option disabled selected>Error Loading Bricks</option>');
				});
		}
		
		var userSearchElem = document.querySelector('#user-search');
		// console.log(userSearch);
		// INISILIZE USER SEARCH PRESS RELEASE
		var userSearch = new Tagify(userSearchElem, {
			tagTextProp: 'name',
			enforceWhitelist: true,
			skipInvalid: true,
			dropdown: {
				closeOnSelect: false,
				enabled: 0,
				classname: 'users-list',
				searchKeys: ['name', 'email']
			},
			templates: {
				// tag: tagTemplate,
				dropdownItem: suggestionItemTemplate,
				// dropdownHeader: dropdownHeaderTemplate
			},
			whitelist: []
		});

		userSearch.on('input', function(e) {
			var value = e.detail.value.trim();
			userSearch.loading(true);

			fetch('<?php echo base_url('Home/searchUsers'); ?>', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/json'
					},
					body: JSON.stringify({
						search: value
					})
				})
				.then(response => response.json())
				.then(data => {
					userSearch.loading(false);
					if (data.success && Array.isArray(data.users)) {
						userSearch.settings.whitelist = data.users.map(user => ({
							value: user.id,
							name: user.name,
							label: user.name,
							email: user.email,
							avatar: user.avatar || 'assets/user-icon.png'
						}));
						userSearch.dropdown.show(value);
					} else {
						userSearch.settings.whitelist = [];
						userSearch.dropdown.hide();
						alert('No users found or invalid response from server.');
					}
				})
				.catch(error => {
					userSearch.loading(false);
					console.error('Error searching users:', error);
					alert('Failed to search users: ' + error.message);
				});
		});

	});

</script>

<script>
	var companySearchElem = document.querySelector('#company-search');
	// console.log(companySearch);

	
	var companySearch = new Tagify(companySearchElem, {
		tagTextProp: 'company_name',
		enforceWhitelist: true,
		skipInvalid: true,
		dropdown: {
			closeOnSelect: false,
			enabled: true,
			classname: 'company-list',
			searchKeys: ['company_name', 'ciin_number']
		},
		templates: {
			// tag: tagTemplate,
			dropdownItem: suggestionCompanyItemTemplate,
			// dropdownHeader: dropdownHeaderTemplate
		},
		whitelist: []
	});

	companySearch.on('input', function(e) {

		var value = e.detail.value.trim();

		if (value.length < 2) {          
			companySearch.dropdown.hide();
			return;
		}


		companySearch.loading(true);

		fetch('<?php echo base_url('Home/searchCompany'); ?>', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({
					search: value
				})
			})
			.then(response => response.json())
			.then(data => {
				companySearch.loading(false);

				console.log(data.companies)
				if (data.success && Array.isArray(data.companies)) {

					companySearch.settings.whitelist = data.companies.map(company => ({
						value: company.value,
						company_name: company.company_name || '',
						ciin_number: company.ciin_number || '',
					}));

					companySearch.dropdown.show(value);
					
				} else {
					companySearch.settings.whitelist = [];
					companySearch.dropdown.hide();
					alert('No companys found or invalid response from server.');
				}
			})
			.catch(error => {
				companySearch.loading(false);
				console.error('Error searching companys:', error);
				alert('Failed to search companys: ' + error.message);
			});
	});

	function suggestionCompanyItemTemplate(tagData) {
		return `
		<div ${this.getAttributes(tagData)}
			class='tagify__dropdown__item d-flex align-items-center ${tagData.class ? tagData.class : ""}'
			tabindex="0"
			role="option">
			<div>
				<div class="fw-bold">${tagData.company_name}</div>
				<small class="text-muted">${tagData.ciin_number}</small>
			</div>
		</div>
	`;
	}
</script>