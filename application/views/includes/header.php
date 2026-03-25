<style>
	.beta-style {
		font-size: 0.75rem;
		font-weight: 500;
		color: #f39c12;
		margin-left: 0.5rem;
		margin-top: 0.3rem;
		display: inline-block;
	}

	.chat-modal {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        z-index: 9999;
    }

    .chat-modal-content {
        background: #fff;
        width: 90vw;
		height: 90vh;
        padding: 20px;
        border-radius: 6px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .chat-close {
        position: absolute;
        right: 12px;
        top: 8px;
        font-size: 22px;
        cursor: pointer;
    }
</style>

<style>
    /* Team Member Card Styles */
    .team-member-card {
        display: flex;
        align-items: center;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: box-shadow 0.2s;
        cursor: pointer;
    }

    .team-member-card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .team-member-card img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
        border: 2px solid #e9ecef;
    }

    .team-member-info {
        flex-grow: 1;
    }

	.chat-user.active {
		border: 2px solid #0d6efd;
		background: #f0f7ff;
	}

</style>
<!-- Shiv Web Developer -->

<body data-bvite="theme-CeruleanBlue" class="layout-border svgstroke-a layout-default">
	<main class="container-fluid px-0" style="grid-template-rows: auto 17px auto 50px;">
		<div class="px-md-4 px-2 pt-2 pb-2 brand h-68" data-bs-theme="none">
			<div>
				<div class="d-flex align-items-center pt-1">
					<button class="btn d-inline-flex d-xl-none border-0 p-0 pe-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas_Navbar">
						<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
							<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
							<path d="M4 6l16 0"></path>
							<path d="M4 12l16 0"></path>
							<path d="M4 18l16 0"></path>
						</svg>
					</button>
					<a href="<?= base_url() ?>company/dashboard" class="brand-icon text-decoration-none d-flex align-items-center" title="">
						<span class="fw-bold fs-6 d-xl-inline-flex text-gradient">
							My Digital Brick
							<span class="beta-style">(βeta)</span>
						</span>
					</a>
				</div>

			</div>
			<div class="d-none layout-a-action">
				<div class="mb-2">
					<a class="d-flex align-items-center lh-sm p-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="User">
						<img class="avatar rounded-circle border border-3 shadow" src="assets/images/profile_av.png" alt="avatar">
					</a>
					<div class="dropdown-menu dropdown-menu-end shadow p-2 p-xl-3 rounded-4">
						<div class="bg-body p-3 rounded-3">
							<a href="<?= base_url() ?>user_profile">
								<h4 class="mb-1 title-font text-gradient">Michelle Glover</h4>
							</a>
							<p class="small text-muted">michelle.glover@gmail.com</p>
							<input type="text" class="form-control form-control-sm" placeholder="Update my status">
						</div>
						<a class="btn py-2 btn-primary w-100 mt-3 rounded-pill" href="signin.html" role="button">Logout</a>
						<div class="mt-3 text-center small">
							<a class="text-muted me-1" href="#!">Privacy policy</a>•<a class="text-muted mx-1" href="#!">Terms</a>•<a class="text-muted ms-1" href="#!">Cookies</a>
						</div>
					</div>
				</div>
				<a href="#" class="btn p-1" title="Sign out">
					<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
						<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
						<path d="M7 6a7.75 7.75 0 1 0 10 0"></path>
						<path d="M12 4l0 8"></path>
					</svg>
				</a>
			</div>
		</div>

		<header class="px-md-4 px-2" data-bs-theme="none">
			<div class="d-flex justify-content-between align-items-center py-2 w-100">
				<button class="btn d-none d-xl-inline-flex me-3 px-0 sidebar-toggle" type="button">
					<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
						<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
						<path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z"></path>
						<path d="M9 4v16"></path>
						<path d="M15 10l-2 2l2 2"></path>
					</svg>
				</button>
				<?php
				$getPaymentStatus = $this->CommonModal->getSingleRowById('freelancer', ['id' => sessionId('freelancer_id')]);
				if ($getPaymentStatus['transaction_status'] != '1') {
				?>
					<div class="payment-reminder-wrapper text-center w-100">
						<div class="alert alert-warning w-75 mx-auto d-flex justify-content-between align-items-center">
							<h6 class="">Unlock the full experience by completing your payment.</h6><button class="btn btn-primary" id="userPaymentBtn">Pay Now&nbsp;<span class="fa fa-arrow-right"></span></button>
						</div>
					</div>
				<?php
				}
				?>
				<!-- Shiv Web Developer -->

				<ul class="header-menu flex-grow-1">
					<li class="nav-item dropdown px-md-1 d-none d-md-inline-flex">
						<a class="dropdown-toggle gray-6" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="notification">
							<span class="bullet-dot bg-primary animation-blink"></span>
							<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
								<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
								<path d="M10 5a2 2 0 0 1 4 0a7 7 0 0 1 4 6v3a4 4 0 0 0 2 3h-16a4 4 0 0 0 2 -3v-3a7 7 0 0 1 4 -6"></path>
								<path d="M9 17v1a3 3 0 0 0 6 0v-1"></path>
								<path d="M21 6.727a11.05 11.05 0 0 0 -2.794 -3.727"></path>
								<path d="M3 6.727a11.05 11.05 0 0 1 2.792 -3.727"></path>
							</svg>
						</a>
						<div class="dropdown-menu shadow rounded-4 notification" id="NotificationsDiv">
							<div class="card border-0">
								<div class="card-header d-flex justify-content-between align-items-center py-3">
									<h4 class="mb-0 text-gradient title-font">Notifications</h4>
									<a href="#" class="btn btn-link" title="view all">View all</a>
								</div>
								<ul class="card-body p-0 list-unstyled mb-0 custom_scroll ps-2" style="height: 400px;">
									<li class="pe-2">
										<a class="d-flex p-lg-3 p-2 rounded-3" href="javascript:void(0);">
											<div class="avatar sm">
												<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
													<path d="M7 11v8a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1v-7a1 1 0 0 1 1 -1h3a4 4 0 0 0 4 -4v-1a2 2 0 0 1 4 0v5h3a2 2 0 0 1 2 2l-1 5a2 3 0 0 1 -2 2h-7a3 3 0 0 1 -3 -3"></path>
												</svg>
											</div>
											<div class="flex-fill ms-3">
												<span class="d-flex justify-content-between"><small class="text-primary">Holiday Sale</small><small class="text-muted">11:30 AM Today</small></span>
												<p class="mb-0 mt-1">Your New Campaign sale live on themeforest and our store is approved.</p>
											</div>
										</a>
									</li>
									<li class="pe-2">
										<a class="d-flex p-lg-3 p-2 rounded-3" href="javascript:void(0);">
											<div class="avatar sm">
												<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
													<path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697"></path>
													<path d="M18 14v4h4"></path>
													<path d="M18 11v-4a2 2 0 0 0 -2 -2h-2"></path>
													<path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path>
													<path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
													<path d="M8 11h4"></path>
													<path d="M8 15h3"></path>
												</svg>
											</div>
											<div class="flex-fill ms-3">
												<span class="d-flex justify-content-between"><small class="text-info">Reports</small><small class="text-muted">04:00 PM Today</small></span>
												<p class="mb-0 mt-1">Website visits from Twitter is 27% higher than last week.</p>
											</div>
										</a>
									</li>
									<li class="pe-2">
										<a class="d-flex p-lg-3 p-2 rounded-3 align-items-start" href="javascript:void(0);">
											<img class="avatar sm rounded-circle" src="assets/images/xs/avatar4.jpg" alt="avatar">
											<div class="flex-fill ms-3">
												<span class="d-flex justify-content-between"><small class="text-warning">HTML Code</small><small class="text-muted">1day</small></span>
												<p class="mb-0 mt-1">Update new code in github and share deteail</p>
											</div>
										</a>
									</li>
									<li class="pe-2">
										<div class="d-flex p-lg-3 p-2 rounded-3">
											<img class="avatar sm rounded-circle" src="assets/images/xs/avatar1.jpg" alt="avatar">
											<div class="flex-fill ms-3">
												<span class="d-flex justify-content-between"><small class="text-success">New Request</small><small class="text-muted">1day</small></span>
												<p class="mb-0 mt-1"><strong>Tina Harris</strong> is requesting to upgrade Plan</p>
												<div class="mt-2">
													<a href="#" class="btn btn-sm bg-accent text-white">Accept</a>
													<a href="#" class="btn btn-sm btn-dark text-white">Decline</a>
												</div>
											</div>
										</div>
									</li>
									<li class="pe-2">
										<a class="d-flex p-lg-3 p-2 rounded-3" href="javascript:void(0);">
											<div class="avatar sm">
												<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
													<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
													<path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path>
													<path d="M12 8v4"></path>
													<path d="M12 16h.01"></path>
												</svg>
											</div>
											<div class="flex-fill ms-3">
												<span class="d-flex justify-content-between"><small class="text-danger">Error 404</small><small class="text-muted">Yesterday</small></span>
											</div>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</li>
					<li id="chatOpenHeader" class="nav-item px-md-1" style="margin-top: 7px !important;">
						<i class="fa-regular fa-message fs-5" style="color: #05212e;"></i>
					</li>
					<?php
					$getLogUser = $this->CommonModal->getSingleRowById('tbl_freelancer', ['id' => sessionId('freelancer_id')]);
					?>
					<li class="nav-item user ms-3">
						<a class="dropdown-toggle gray-6 d-flex text-decoration-none align-items-center lh-sm p-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="User" data-bs-auto-close="outside">
							<img class="avatar rounded-circle border border-3" src="<?= base_url('uploads/user_profile/' . $getLogUser['user_image'] ?? 'assets/images/img/user.png') ?>" alt="Avatar">
							<span class="ms-2 fs-6 d-sm-inline-flex">Digital Tasks</span>
						</a>

						<p class="owner-name"><?= $getLogUser['name'] ?></p>
						<div class="dropdown-menu dropdown-menu-end shadow p-2 p-xl-3 rounded-4">
							<div class="bg-body p-3 rounded-3">
								<a href="<?= base_url() ?>company/user_profile">
									<h4 class="mb-1 title-font text-gradient"><?= $getLogUser['name'] ?></h4>
								</a>
								<p class="small text-muted"><?= $getLogUser['email'] ?></p>
							</div>
							<a class="btn py-2 btn-primary w-100 mt-3 rounded-pill" href="<?= base_url('Home/company_logout') ?>" role="button">Logout</a>
							<!-- <div class="mt-3 text-center small">
								<a class="text-muted me-1" href="#!">Privacy policy</a>•<a class="text-muted mx-1" href="#!">Terms</a>•<a class="text-muted ms-1" href="#!">Cookies</a>
							</div> -->
						</div>
					</li>
				</ul>
			</div>
		</header>

		<aside class="ps-4 pe-3 py-3 sidebar" data-bs-theme="none">
			<nav class="navbar navbar-expand-xl py-0">
				<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvas_Navbar">
					<div class="offcanvas-header">
						<div class="d-flex">
							<a href="<?= base_url('company/dashboard') ?>" class="brand-icon me-2">
								<span class="fs-5">My Digital Tasks | beta</span>
							</a>
						</div>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
					</div>
					<div class="offcanvas-body flex-column custom_scroll ps-4 ps-xl-0">
						<ul class="list-unstyled mb-4 menu-list">
							<li>
								<a href="<?= base_url('company/dashboard') ?>" aria-label="My Dashboard">
									<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
										<path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
										<path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
										<path d="M10 12h4v4h-4z"></path>
									</svg>
									<span class="mx-2">1. Dashboard</span>
								</a>
							</li>

							<li>
								<a href="#MyProject" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle" aria-label="My Project's">
									<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
										<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
										<path d="M6 5.3a9 9 0 0 1 0 13.4"></path>
										<path d="M18 5.3a9 9 0 0 0 0 13.4"></path>
									</svg>
									<span class="mx-2">2. My Tasks</span>
								</a>
								<ul class="collapse list-unstyled" id="MyProject">
									<li>
										<a href="#createSubMenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
											2.0 Create
										</a>
										<ul class="collapse list-unstyled ps-3" id="createSubMenu">
											<li><a href="<?= base_url('company/create-brick') ?>" aria-label="Brick">Brick</a></li>
											<li><a href="<?= base_url('company/create-project') ?>" aria-label="Project">Project</a></li>
											<li><a href="<?= base_url('company/create_company') ?>" aria-label="Project Grid">Company</a></li>
										</ul>
									</li>
									
									<!-- <li><a href="<?= base_url('company/create-project') ?>" aria-label="Project Grid"> 2.1 Create Project</a></li> -->
									<li><a href="<?= base_url('company/create-team') ?>" aria-label="Project Grid"> 2.1 Add Team</a></li>
									<li><a href="<?= base_url('company/create-team-new') ?>" aria-label="Project Grid"> 2.1 Add Team New</a></li>
									
									<li><a href="<?= base_url('company/tree-making') ?>" aria-label="Project Grid">2.10 Artificial Family </a></li>
									<!-- <li><a href="<?= base_url('company/create-brick') ?>" aria-label="Project Grid"> 2.3 Create Brick</a></li> -->
									<!-- <li><a href="<?= base_url('company/create-team-member') ?>" aria-label="Project Grid"> 2.3 Create Bricks as Team Member</a></li> -->
									<li><a href="<?= base_url('company/request-panel') ?>" aria-label="Project Grid">2.2 Request Panel</a></li>
									<li><a href="<?= base_url('company/management_panel') ?>" aria-label="Project Grid">2.3 Brick Management panel</a></li>
									<!-- <li><a href="<?= base_url('company/participate_bricks') ?>" aria-label="Project Grid">2.3 Participate in Execution</a></li> -->
									<li><a href="<?= base_url('company/idea') ?>" aria-label="Project Grid">2.5.0 Brain Dating <br /> (Idea's Pay) </a></li>
									<li><a href="<?= base_url('company/trlphdpostdoc') ?>" aria-label="Project Grid">2.6 TRL/PHD/Post Doc </a></li>
									<li><a href="<?= base_url('company/ip-and-tech-transfer') ?>" aria-label="Project Grid">2.7 IP & Tech Transfer </a></li>

									<li><a href="<?= base_url('company/market-place') ?>" aria-label="Project Grid">2.8 Market Place </a></li>
									<li><a href="<?= base_url('company/buyrent') ?>" aria-label="Project Grid">2.9 Buy/Rent </a></li>

									<li><a href="<?= base_url('company/market-tracing') ?>" aria-label="Project Grid">2.11 Market Research Tracing </a></li>
									<li><a href="<?= base_url('company/crm') ?>" aria-label="Project Grid">2.14 CRM </a></li>
									<li><a href="<?= base_url('company/revenue') ?>" aria-label="Project Grid">2.15 Revenue </a></li>
									<li><a href="<?= base_url('company/plant-manufacturing-production') ?>" aria-label="Project Grid">2.16 Plant & Manufacturing & Production </a></li>
									<li><a href="<?= base_url('company/project_visualization') ?>" aria-label="Project Grid">2.4 Project Visualization</a></li>
									<li><a href="<?= base_url('company/version-delivered') ?>" aria-label="Project Grid">2.5 Version Delivered</a></li>
									<li><a href="<?= base_url('company/3d-world') ?>" aria-label="Project Grid">2.12 3D World </a></li>
									<li><a href="<?= base_url('company/police-court') ?>" aria-label="Project Grid">2.17 Police & Court </a></li>
									<li><a href="<?= base_url('company/map') ?>" aria-label="Project Grid">2.13 Map </a></li>
									<li><a href="<?= base_url('company/medical-defence') ?>" aria-label="Project Grid">2.18 Medical & Defence </a></li>
									<li><a href="<?= base_url('company/medical-identity') ?>" aria-label="Project Grid">2.19 Medical Identity </a></li>
									<li><a href="<?= base_url('company/e-commerce') ?>" aria-label="Project Grid">2.20 E-Commerce </a></li>
									<li><a href="<?= base_url('company/all-nearby-me') ?>" aria-label="Project Grid">2.21 All Nearby Me </a></li>


									<!-- <li><a href="<?= base_url('manage_tasks') ?>" aria-label="Analytics">Manage Tasks</a></li>
									<li><a href="<?= base_url('manage_bidders') ?>" aria-label="New Project">Manage Bidders</a></li>
									<li><a href="<?= base_url('active_bids') ?>" aria-label="Project List">My Active Bids </a></li> -->
								</ul>
							</li>
							<!-- <li>
								<a href="<?= base_url('company/bricks') ?>" aria-label="My Dashboard">
									<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
										<path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
										<path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
										<path d="M10 12h4v4h-4z"></path>
									</svg>
									<span class="mx-2">Posted Bricks</span>
								</a>
							</li> -->

							<!-- <li>
								<a href="<?= base_url('wallet') ?>" aria-label="My Wallet">
									<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
										<path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12"></path>
										<path d="M20 12v4h-4a2 2 0 0 1 0 -4h4"></path>
									</svg>
									<span class="mx-2">My Wallet</span>
								</a>
							</li> -->
							<!-- <li>
								<a href="<?= base_url('role_employment') ?>" aria-label="My Wallet">
									<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
										<path d="M17 8v-3a1 1 0 0 0 -1 -1h-10a2 2 0 0 0 0 4h12a1 1 0 0 1 1 1v3m0 4v3a1 1 0 0 1 -1 1h-12a2 2 0 0 1 -2 -2v-12"></path>
										<path d="M20 12v4h-4a2 2 0 0 1 0 -4h4"></path>
									</svg>
									<span class="mx-2">Role Management</span>
								</a>
							</li> -->
							<!-- Shiv Web Developer -->
							<li>
								<a href="#UsersMenu" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle" aria-label="Users">
									<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
										<path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"></path>
										<path d="M12 10m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0"></path>
										<path d="M6.168 18.849a4 4 0 0 1 3.832 -2.849h4a4 4 0 0 1 3.834 2.855"></path>
									</svg>
									<span class="mx-2">3. My Profile</span>
								</a>
								<ul class="collapse list-unstyled" id="UsersMenu">
									<li><a href="<?= base_url() ?>company/user_profile" aria-label="My Profile">3.1 User Profile <br /> (Life Book) </a></li>
									<li><a href="<?= base_url() ?>company/artifical-family" aria-label="My Profile">3.2 Artificial Family</a></li>
									<li><a href="<?= base_url() ?>company/project-profile" aria-label="Project Profile">3.3 Project Profile</a></li>
									<li><a href="<?= base_url() ?>company/company-profile" aria-label="Company Profile">3.4 Company Profile</a></li>
									<?php if (sessionId('freelancer_id')) { ?>
										<li><a href="<?= base_url() ?>UserReport" aria-label="UserReport">3.5 Users Reports</a></li>
									<?php } ?>
								</ul>
							</li>

							<li>
								<a href="<?= base_url('company/setting') ?>" aria-label="Dashboard">
									<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
										<path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z"></path>
										<path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0"></path>
									</svg>
									<span class="mx-2">4. Settings</span>
								</a>
							</li>
							<li>
								<a href="<?= base_url('company/trash') ?>" aria-label="Trash">
									<svg
										xmlns="http://www.w3.org/2000/svg"
										width="20"
										height="20"
										fill="none"
										stroke="currentColor"
										stroke-width="2"
										stroke-linecap="round"
										stroke-linejoin="round"
										viewBox="0 0 24 24">
										<polyline points="3 6 5 6 21 6"></polyline>
										<path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"></path>
										<path d="M10 11v6"></path>
										<path d="M14 11v6"></path>
										<path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"></path>
									</svg>
									<span class="mx-2">5. Trash </span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</aside>