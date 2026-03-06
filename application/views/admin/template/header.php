<body data-bvite="theme-CeruleanBlue" class="layout-border svgstroke-a layout-default m-0">
	<!-- Shiv Web Developer -->
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
					<a href="<?= base_url() ?>" class="brand-icon text-decoration-none d-flex align-items-center" title="">
						<span class="fw-bold fs-5 d-none d-xl-inline-flex text-gradient">My Digtal Bricks</span>
					</a>
				</div>
				<!-- <div>Company Account</div> -->

			</div>
			<div class="d-none layout-a-action">
				<div class="mb-2">
					<a class="d-flex align-items-center lh-sm p-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="User">
						<img class="avatar rounded-circle border border-3 shadow" src="assets/images/profile_av.png" alt="avatar">
					</a>
					<div class="dropdown-menu dropdown-menu-end shadow p-2 p-xl-3 rounded-4">
						<div class="bg-body p-3 rounded-3">
							<h4 class="mb-1 title-font text-gradient">Michelle Glover</h4>
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
												<p class="mb-0 mt-1">BVITE admin template on website analytics configurations</p>
											</div>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</li>

					<li class="nav-item user ms-3">
						<a class="dropdown-toggle gray-6 d-flex text-decoration-none align-items-center lh-sm p-0" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="User" data-bs-auto-close="outside">
							<img class="avatar rounded-circle border border-3" src="assets/images/img/user.jpg" alt="avatar">
							<span class="ms-2 fs-6 d-none d-sm-inline-flex">Admin</span>

						</a>
						<div class="dropdown-menu dropdown-menu-end shadow p-2 p-xl-3 rounded-4">
							<a class="btn py-2 btn-primary w-100 mt-3 rounded-pill" href="<?= base_url('admin/logout') ?>" role="button">Logout</a>
						</div>
					</li>
				</ul>
			</div>
		</header>
		<!-- Shiv Web Developer -->
		<aside class="ps-4 pe-3 py-3 sidebar mt-100" data-bs-theme="none">
			<nav class="navbar navbar-expand-xl py-0">
				<div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvas_Navbar">
					<div class="offcanvas-header">
						<div class="d-flex">
							<a href="<?= base_url('company/dashboard') ?>" class="brand-icon me-2">
								<span class="fs-5">My Digital Bricks</span>
							</a>
						</div>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
					</div>
					<div class="offcanvas-body flex-column custom_scroll ps-4 ps-xl-0">
						<ul class="list-unstyled mb-4 menu-list">
							<li>
								<a href="<?= base_url() ?>admin/dashboard" aria-label="My Dashboard">
									<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
										<path d="M5 12l-2 0l9 -9l9 9l-2 0"></path>
										<path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7"></path>
										<path d="M10 12h4v4h-4z"></path>
									</svg>
									<span class="mx-2">Dashboard</span>
								</a>
							</li>

							<li>
								<a href="<?= base_url() ?>admin/project-creators" aria-label="My Dashboard">
									<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
										<path d="M12 2a10 10 0 1 0 10 10a10 10 0 0 0 -10 -10"></path>
										<path d="M12 6v2"></path>
										<path d="M12 16v2"></path>
										<path d="M16.5 7.5l-1.5 1.5"></path>
										<path d="M7.5 16.5l1.5 -1.5"></path>
										<path d="M6 12h2"></path>
										<path d="M16 12h2"></path>
									</svg>
									<span class="mx-2">Project Creators</span>
								</a>
							</li>
							<li>
								<a href="<?= base_url() ?>admin/total-projects" aria-label="My Dashboard">
									<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
										<path d="M12 2a10 10 0 1 0 10 10a10 10 0 0 0 -10 -10"></path>
										<path d="M12 6v2"></path>
										<path d="M12 16v2"></path>
										<path d="M16.5 7.5l-1.5 1.5"></path>
										<path d="M7.5 16.5l1.5 -1.5"></path>
										<path d="M6 12h2"></path>
										<path d="M16 12h2"></path>
									</svg>
									<span class="mx-2">Total Project</span>
								</a>
							</li>
							<li>
								<a href="<?= base_url() ?>admin/project-consultant" aria-label="My Dashboard">
									<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
										<path d="M12 2a10 10 0 1 0 10 10a10 10 0 0 0 -10 -10"></path>
										<path d="M12 6v2"></path>
										<path d="M12 16v2"></path>
										<path d="M16.5 7.5l-1.5 1.5"></path>
										<path d="M7.5 16.5l1.5 -1.5"></path>
										<path d="M6 12h2"></path>
										<path d="M16 12h2"></path>
									</svg>
									<span class="mx-2">Project Consultant</span>
								</a>
							</li>
							<li>
								<a href="<?= base_url() ?>admin/user-kyc" aria-label="User KYC">
									<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
										<path d="M12 2a10 10 0 1 0 10 10a10 10 0 0 0 -10 -10"></path>
										<path d="M12 6v2"></path>
										<path d="M12 16v2"></path>
										<path d="M16.5 7.5l-1.5 1.5"></path>
										<path d="M7.5 16.5l1.5 -1.5"></path>
										<path d="M6 12h2"></path>
										<path d="M16 12h2"></path>
									</svg>
									<span class="mx-2"> User KYC</span>
								</a>
							</li>
							<li>
								<a href="<?= base_url() ?>admin/celebrity-management" aria-label="Celebrity Management">
									<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
										<path d="M12 2a10 10 0 1 0 10 10a10 10 0 0 0 -10 -10"></path>
										<path d="M12 6v2"></path>
										<path d="M12 16v2"></path>
										<path d="M16.5 7.5l-1.5 1.5"></path>
										<path d="M7.5 16.5l1.5 -1.5"></path>
										<path d="M6 12h2"></path>
										<path d="M16 12h2"></path>
									</svg>
									<span class="mx-2"> Celebrity Management</span>
								</a>
							</li>
							<li>
								<a href="<?= base_url() ?>admin/event-management" aria-label="Event Management">
									<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
										<path d="M12 2a10 10 0 1 0 10 10a10 10 0 0 0 -10 -10"></path>
										<path d="M12 6v2"></path>
										<path d="M12 16v2"></path>
										<path d="M16.5 7.5l-1.5 1.5"></path>
										<path d="M7.5 16.5l1.5 -1.5"></path>
										<path d="M6 12h2"></path>
										<path d="M16 12h2"></path>
									</svg>
									<span class="mx-2"> Event Management</span>
								</a>
							</li>
							<li>
								<a href="<?= base_url() ?>admin/police-court" aria-label="User KYC">
									<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
										<path d="M12 2a10 10 0 1 0 10 10a10 10 0 0 0 -10 -10"></path>
										<path d="M12 6v2"></path>
										<path d="M12 16v2"></path>
										<path d="M16.5 7.5l-1.5 1.5"></path>
										<path d="M7.5 16.5l1.5 -1.5"></path>
										<path d="M6 12h2"></path>
										<path d="M16 12h2"></path>
									</svg>
									<span class="mx-2"> Police & Court</span>
								</a>
							</li>
							<li>
								<a href="<?= base_url() ?>admin/map" aria-label="User KYC">
									<svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
										<path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
										<path d="M12 2a10 10 0 1 0 10 10a10 10 0 0 0 -10 -10"></path>
										<path d="M12 6v2"></path>
										<path d="M12 16v2"></path>
										<path d="M16.5 7.5l-1.5 1.5"></path>
										<path d="M7.5 16.5l1.5 -1.5"></path>
										<path d="M6 12h2"></path>
										<path d="M16 12h2"></path>
									</svg>
									<span class="mx-2"> Map</span>
								</a>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</aside>
		<!-- Shiv Web Developer -->