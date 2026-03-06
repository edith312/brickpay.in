<?php $this->load->view('includes/header-link'); ?>
<?php $this->load->view('includes/freelancer_header'); ?>
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">

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
    </ul>

    


<!-- Searchable Dropdown Container -->
<div class="my-3 position-relative category-dropdown-container" style="max-width: 300px;">
    <!-- Toggle Button for Opening/Closing Dropdown -->
    <button class="btn btn-outline-secondary w-100 category-toggle-btn" type="button" data-bs-toggle="collapse" data-bs-target="#customCategoryDropdown" aria-expanded="false" aria-controls="customCategoryDropdown">
        Search Categories
    </button>

    <!-- Collapsible Dropdown -->
    <div class="collapse mt-2 category-dropdown" id="customCategoryDropdown">
        <!-- Search Input Field (Non-functional, for UI only) -->
        <input type="text" class="form-control mb-2 category-search-input" placeholder="Search Categories...">
        
        <!-- Category Options -->
        <select class="form-select category-select" size="5">
            <option value="All">All Categories</option>
            <option value="App Development">App Development</option>
            <option value="Graphic Design">Graphic Design</option>
            <option value="Web Development">Web Development</option>
            <option value="Content Writing">Content Writing</option>
            <option value="Digital Marketing">Digital Marketing</option>
            <option value="SEO">SEO</option>
            <option value="Data Entry">Data Entry</option>
        </select>
    </div>
</div>






    <div class="ps-md-4 pe-md-3 px-2 py-3 page-body">

<ul class="row g-3 li_animate list-unstyled">
<li class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-header flex-nowrap align-items-center">
            <a href="#" class="card-title mb-0 text-primary fw-bold" style="font-size: 18px; text-decoration: none;">
    Website Redesign Project
</a>

                <div>
                    <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full Screen">
                        <svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 16m0 1a1 1 0 0 1 1 -1h3a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1z"></path>
                            <path d="M4 12v-6a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-6"></path>
                            <path d="M12 8h4v4"></path>
                            <path d="M16 8l-5 5"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-1">
                    <i class="fa fa-building me-3"></i>
                    <span class="pe-2">Client: </span>
                    <a href="#">John Doe</a>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <i class="fa fa-credit-card me-3"></i>
                    <span class="pe-2">Budget: </span>
                    <a href="#">$1,200</a>
                </div>
                <div class="hstack gap-3 mb-4">
                    <div>
                        <p class="mb-1 text-muted small">Skills Required:</p>
                        HTML, CSS, JavaScript, React
                    </div>
                    <div class="vr"></div>
                    <div>
                        <p class="mb-1 text-muted small">Posted:</p>
                        22 March, 2025
                    </div>
                    <div class="ms-auto">
                        <p class="mb-1 text-muted small">Deadline:</p>
                        5 April, 2025
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                <div>
    <p class="mb-1 text-muted small" style="font-size: 18px;">Description:</p>
    <p style="font-size: 15px;">Redesign a corporate website with a modern, responsive UI and enhanced accessibility</p>
</div>

<a href="#" class="btn btn-primary btn-sm" style="width: 100px; font-size: 10px; font-weight: bold; padding: 8px 4px; border-radius: 5px; text-align: center; display: inline-block;">
    View Details
</a>


                </div>
                
            </div>
        </div>
    </li>


    <li class="col-lg-6 col-md-6">
        <div class="card">
            <div class="card-header flex-nowrap align-items-center">
            <a href="#" class="card-title mb-0 text-primary fw-bold" style="font-size: 18px; text-decoration: none;">
    Website Redesign Project
</a>

                <div>
                    <a href="#" class="card-fullscreen" data-bs-toggle="tooltip" title="Card Full Screen">
                        <svg class="svg-stroke" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M3 16m0 1a1 1 0 0 1 1 -1h3a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-3a1 1 0 0 1 -1 -1z"></path>
                            <path d="M4 12v-6a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-6"></path>
                            <path d="M12 8h4v4"></path>
                            <path d="M16 8l-5 5"></path>
                        </svg>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-1">
                    <i class="fa fa-building me-3"></i>
                    <span class="pe-2">Client: </span>
                    <a href="#">John Doe</a>
                </div>
                <div class="d-flex align-items-center mb-2">
                    <i class="fa fa-credit-card me-3"></i>
                    <span class="pe-2">Budget: </span>
                    <a href="#">$1,200</a>
                </div>
                <div class="hstack gap-3 mb-4">
                    <div>
                        <p class="mb-1 text-muted small">Skills Required:</p>
                        HTML, CSS, JavaScript, React
                    </div>
                    <div class="vr"></div>
                    <div>
                        <p class="mb-1 text-muted small">Posted:</p>
                        22 March, 2025
                    </div>
                    <div class="ms-auto">
                        <p class="mb-1 text-muted small">Deadline:</p>
                        5 April, 2025
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                <div>
    <p class="mb-1 text-muted small" style="font-size: 18px;">Description:</p>
    <p style="font-size: 15px;">Redesign a corporate website with a modern, responsive UI and enhanced accessibility</p>
</div>

<a href="#" class="btn btn-primary btn-sm" style="width: 100px; font-size: 10px; font-weight: bold; padding: 8px 4px; border-radius: 5px; text-align: center; display: inline-block;">
    View Details
</a>


                </div>
                
            </div>
        </div>
    </li>

      
</ul>

</div>

  

</div>

<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>