<?php $this->load->view('includes/header'); ?>

<!-- Shiv Web Developer -->
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
<style>
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        /* Hidden by default */
        justify-content: center;
        align-items: center;
        z-index: 9999;
    }
</style>

<style>
    .project-row {
        display: grid;
        grid-template-columns: 30px 1fr 1fr 1fr 1fr 50px;
        align-items: center;
        border: 1px solid #dce3e8;
        border-radius: 4px;
        color: #00a7cc;
        font-weight: 600;
        border-bottom: 0;
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
        font-size: 18px;
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

    .btn-primary {
        display: inline-block !important;
    }
</style>

<style>
    .timeline_container{
        /* border: 1px solid #e3e3e3; */
        /* background: #f8f9fa; */
        padding: 28px 48px;
        position: relative;
        z-index: 2;
        background: transparent !important;
    }
    .timeline_wrapper{
        position: relative;
        min-height: 500px;
        background: #f8f9fa;
        z-index: 0;
    }
    #connectionLayer{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        pointer-events: none;
        overflow: visible;  
    }
    .my_timeline{
        position: relative;
        height: 1px;
        display: flex;
        justify-content: space-evenly;
    }
    .my_timeline_line{
        position: absolute;
        height: 1px;
        width: 100%;
        background: #e3e3e3;
    }
    .context-menu {
        position: absolute;
        background: #fff;
        border: 1px solid #ccc;
        display: none;
        z-index: 1000;
        width: 200px;
    }
    .context-menu ul {
        list-style: none;
        margin: 0;
        padding: 5px 0;
    }

    .context-menu li {
        padding: 6px 12px;
        cursor: pointer;
    }

    .context-menu li:hover {
        background: #f1f1f1;
    }

    .menu-item {
        padding: 8px 12px;
        cursor: pointer;
    }

    .menu-item:hover {
        background: #f0f0f0;
    }

    .timeline-users {
        display: inline-flex;
        gap: 20px;
        height: 50px;
        width: 100%;
        justify-content: center;
        position: absolute;
        top: 35px;
        transform: translate(0px, -50%);
        align-items: center;
        flex-direction: row;
    }

    .timeline-user {
        position: relative;
        z-index: 3;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        max-width: 75px;
        min-width: 75px;
        padding: 4px 8px;
        /* background: #fff; */
        border-radius: 20px;
        cursor: grab;
    }

    .timeline-user a {
        text-align: center;
        text-decoration: none;
        color: black;
    }

    .timeline-user a .user-avatar {
        width: 35px;
        height: 35px;
        aspect-ratio: 1;
        object-fit: cover;
        border-radius: 50%;
        /* border: 1px solid blue; */
    }

    .timeline-user a span {
        font-size: 12px;
        text-align: center;
        white-space: nowrap;
    }

    .tagify__input {
        background: gainsboro;
        min-width: 150px;
    }

    .timeline-user.dragging {
        opacity: 0.5;
    }

    .connection-source {
        border: 3px solid #0d6efd !important; /* Blue border */
        box-shadow: 0 0 10px rgba(13, 110, 253, 0.5);
        background-color: #e9ecef;
        transform: scale(1.05);
        transition: all 0.2s ease;
    }

</style>

<div class="page-body container">
    <h3 class="p-2 my-5 text-center"> Welcome to Artificial Family Making! </h3>


    <div class="global-search-filter-container">

        <div class="mt-5 text-center">
            <div class="mt-2 text-center">
                <button type="button" class="btn btn-primary" id="getvaluationbyproject">Make My Book</button>
            </div>
        </div>

        <style>
            .createNameContainer {
                width: 500px;
                background-color: #d0d4d6ff;
                padding: 20px;
                border-radius: 6px;
            }
        </style>


        <!-- MAKE MY TRIP POP-UPS  -->
        <div class="modal-overlay" id="valuationModel"
            style="display:none; width:100% !important; justify-content:center; align-items:center;">
            <div class="modal-box"
                style="width:90% !important; height:90%; overflow-y:auto; background:#fff; padding:20px; border-radius:10px; position:relative;">

                <span class="modal-close" onclick="closeValuationModal()"
                    style="position:absolute; top:10px; right:20px; font-size:24px; cursor:pointer;">&times;</span>
                <h3>Make My Book
                    <button type="button" class="btn bg-primary text-white" id="createname"
                        style="padding:0px; padding: 2px 10px; font-size: 20px; font-weight:800"> + </button>
                </h3>
                <div class="createNameContainer" style="display:none;">
                    <form action="<?php echo base_url('/company/create_my_book_name') ?>" method="post"
                        id="create_makemybook">
                        <div class="d-flex">
                            <div class="form-group" style="width:80%;">
                                <label> Create Name</label>
                                <input type="text" placeholder="Title" value="My Book 1" id="makemybookname"
                                    name="makemybookname" class="form-control" required>
                            </div>
                            <div class="form-group" style="width:20%; margin-top:25px;">
                                <button type="submit" class="btn bg-primary text-white"
                                    style="padding:0px; padding: 5px 15px; font-size: 15px; font-weight:700"> Create
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card">
                    <div class="createdBookName" id="createdbookname"></div>
                    <!-- Hidden input to store created ID -->
                    <input type="hidden" name="created_book_id" id="created_book_id">
                </div>



                <!-- ✅ Simple Modal -->
                <div id="bookModal"
                    style="display:none; position:absolute; top:0; left:0; right:0; bottom:0; background:rgba(0,0,0,0.5); justify-content:center; align-items:center;">
                    <div
                        style="background:#fff; padding:20px; border-radius:8px; text-align:center; position: relative; width:100%; height:90%; overflow-y: scroll;">
                        <div>
                            <h3 id="modalBookName"></h3>
                            <div class="row">
                                <div class="col-12 col-md-6 col-lg-4">
                                    <form method="GET"
                                        action="<?php echo base_url('/company/tree-making-search-filter') ?>"
                                        class="global-search-filters" style="display:flex;" id="globalSearchForm">
                                        <div class="filter-box mt-5" style="width:90%;">
                                            <div style="text-align: left !important;"> Search Bricks </div>
                                            <input class="form-control" type="text" name="globally_search_filter"
                                                id="globally_search_filter" required placeholder="Search...."
                                                style="border-radius:0px;">
                                        </div>
                                        <div class="" style="width:10%; margin-top:72px;">
                                            <button type="submit" class="btn text-white bg-primary"
                                                style="border-radius:0px; padding:5.5px 20px">Search</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-12 col-md-6 col-lg-8">
                                </div>
                                <div style="text-align:left !important; margin-top:30px; font-size:12px;">
                                    <?php
                                        if (isset($brickfilterSetup) && ! empty($brickfilterSetup)) {
                                            echo '<div class="d-flex"> <div>Active Filters</div> <a href="' . base_url('company/tree-making') . '" class="btn btn-danger mb-2 ms-2 p-1 px-2" style="font-size:12px;">Clear Filters</a> </div>';
                                            foreach ($brickfilterSetup as $key => $value) {
                                                if (! empty($value)) {
                                                    echo '<span class="badge bg-primary me-2">' . ucfirst(str_replace('_', ' ', $key)) . ': ' . htmlspecialchars($value) . '</span>';
                                                }
                                            }
                                        } elseif (isset($brickfilterSetup) && empty($brickfilterSetup)) {
                                            echo '<div>No Active Filters</div>';
                                        } else {
                                            echo '<div>No Active Filters</div>';
                                        }
                                    ?>
                                </div>
                            </div>

                            <form action="<?php echo base_url('/company/create_brick_tree') ?>" method="post"
                                id="create_brick_tree">
                                <input type="hidden" class="form-control" id="modalBookId">

                                <!-- AJAX RESULT AREA -->
                                <div id="searchResult" style="margin-top:20px;"></div>
                                <button type="submit" class="btn bg-primary text-white px-5">Save</button>
                            </form>


                            <div id="alreadyBricksResult" style="margin-top:100px;"></div>
                            <button type="button" class="closeModal btn bg-dark text-white"
                                style="position:absolute; top:10px; right:10px;">Close</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-12"><h3>Artificial Family</h3></div>
        <pre>
            Artificial Family Concept : 

            This is Real Youth Problems/ it has never been compulsory to adopt a family where u have born. 

            For adults, life journeys are always more positive the more you explore, so explore & connect with anyone & part of your dream team with the emotion you want to share & spread more love & uplift humanity with advancements & evolutions. 

            Here, people ask people to adopt & share emotional support as well & can complete amazing projects together. 

            The whole process from onboarding to Project Execution with people participating with activity will be recorded & presented as films. 

            Mission , Vision of Associations : 

            RolePlay Project Work - 

            1. Brother ( Elder ) 
            Dos & Don’t : 
            Time : How long ? in Hours, Days, Weeks, Months, Years 

            2. Mother 
            Dos & Dont’s : How many times ? 

            3. Father 
            Dos & Don’t : How many times ? 

            4. Teacher 
            Dos & Don’t : How many times ? 

            5. One Way Declaration : Example - I m crushing on Shahrukh Khan 
            And your Ask - 

            6. Ethnicity - White, Brown, Black 

            Bidding for the Artificial Family 
            Speciality of this Group : 

            Emotional Trading 

        </pre>
        <form action="<?= base_url('/home/create_tree') ?>" method="POST">
            <div class="row w-100">
                <div class="col-auto">
                    <label class="form-label" for="">Tree/Family/Project Nomencleture/Name</label>
                    <input class="form-control" type="text" name="title" min="0">
                </div>
                <div class="col-auto">
                    <label class="form-label" for="">Timeline Count</label>
                    <input class="form-control" type="number" name="count" min="0">
                </div>
                <input type="hidden" value="3" name="tree_type">
            </div>
            <button class="btn btn-primary" type="submit">Create Tree</button>
        </form>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <select class="form-select" id="tree_select">
                <?php foreach($trees as $tree) :?>
                    <option value="<?= $tree['id'] ?>"><?= $tree['title']?></option>
                <?php endforeach;?>
            </select>
            <div class="mt-4">
                <div id="duplicate_user_alert" class="alert alert-warning d-none" role="alert"></div>
                <div id="timeline_wrapper">
                    <svg id="connectionLayer"></svg>
                    <div class="mt-md-3 timeline_container" id="timeline_container"></div>
                </div>
            </div>
        </div>
    </div>

    <div id="contextMenu" class="context-menu">
        <div id="menuAddUser" class="menu-item">Add User</div>
    </div>

    <div id="userContextMenu" class="context-menu">
        <ul>
            <li id="menuAddConnection">➕ Add Connection</li>
            <li id="menuRemoveUser" class="text-danger">❌ User</li>
        </ul>
    </div>
    
    </div>
    <?php $this->load->view('includes/footer-link'); ?>
    <?php $this->load->view('includes/footer'); ?>

    <script>
        const toggleBtn = document.getElementById('createname');
        const container = document.querySelector('.createNameContainer');

        toggleBtn.addEventListener('click', function () {
            // Toggle visibility
            if (container.style.display === 'none' || container.style.display === '') {
                container.style.display = 'block';
                toggleBtn.textContent = '−'; // change + to −
            } else {
                container.style.display = 'none';
                toggleBtn.textContent = '+'; // change − back to +
            }
        });
    </script>


    <script>
        // OPEN MODAL
        function openValuationModal() {
            document.getElementById('valuationModel').style.display = 'flex';
        }

        // CLOSE MODAL
        function closeValuationModal() {
            document.getElementById('valuationModel').style.display = 'none';
        }

        // OPEN MODAL ON BUTTON CLICK
        document.getElementById('getvaluationbyproject').addEventListener('click', function (e) {
            e.preventDefault();
            openValuationModal();
        });

        // CLOSE MODAL IF CLICKED OUTSIDE
        window.addEventListener('click', function (e) {
            const modal = document.getElementById('valuationModel');
            if (e.target === modal) {
                closeValuationModal();
            }
        });
    </script>

    <!-- CREATE MY BOOK NAME -->
    <script>
        $(document).ready(function () {

            // ✅ Create Make My Book Name
            $('#create_makemybook').on('submit', function (e) {
                e.preventDefault();

                let formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',

                    success: function (response) {
                        if (response.success) {
                            alert(response.message);
                            $('#makemybookname').val('');

                            if (response.getmakemybookname && response.getmakemybookname.length > 0) {
                                const books = response.getmakemybookname;

                                // Build clickable list with total brick count
                                let html = '<ul class="list-group">';
                                books.forEach((book, index) => {
                                    html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="#"
                                   class="openBookModal"
                                   data-id="${book.id}"
                                   data-name="${book.makemybookname}">
                                   ${index + 1}. ${book.makemybookname}
                                </a>
                                <span class="badge bg-primary rounded-pill">
                                    ${book.total_bricks || 0} Bricks
                                </span>
                            </li>`;
                                });
                                html += '</ul>';

                                // Inject the HTML into your container
                                $('#createdbookname').html(html);

                                // Store last created book ID in hidden input
                                const lastBook = books[books.length - 1];
                                $('#created_book_id').val(lastBook.id);
                            }

                        } else {
                            alert("Error: " + (response.message || response.errors));
                        }
                    },

                    error: function (xhr, status, error) {
                        alert("AJAX Error: " + error);
                        console.log(xhr.responseText);
                    }
                });
            });


            // ✅ Get All Books Button Click
            $('#getvaluationbyproject').on('click', function (e) {
                e.preventDefault();

                $.ajax({
                    url: "<?php echo base_url('company/get_all_make_my_books') ?>",
                    method: 'POST',
                    dataType: 'json',

                    success: function (response) {
                        if (response.success) {
                            const bookList = response.data;

                            if (bookList.length > 0) {

                                // Build clickable list with total brick count
                                let html = '<ul class="list-group">';
                                bookList.forEach((book, index) => {
                                    html += `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <a href="#"
                                   class="openBookModal"
                                   data-id="${book.id}"
                                   data-name="${book.makemybookname}">
                                   ${index + 1}. ${book.makemybookname}
                                </a>
                                <span class="badge bg-primary rounded-pill">
                                    ${book.total_bricks || 0} Bricks
                                </span>
                            </li>`;
                                });
                                html += '</ul>';

                                $('#createdbookname').html(html);
                            } else {
                                $('#createdbookname').html('<p>No books found.</p>');
                            }

                        } else {
                            alert("Error: " + (response.message || response.errors));
                        }
                    },

                    error: function (xhr, status, error) {
                        alert("AJAX Error: " + error);
                        console.log(xhr.responseText);
                    }
                });
            });


            // ✅ Open Modal on Book Click
            $(document).on('click', '.openBookModal', function (e) {
                e.preventDefault();

                const bookId = $(this).data('id');
                const bookName = $(this).data('name');

                // Set modal data
                $('#modalBookId').val(bookId);
                $('#modalBookName').text(bookName);

                // Show modal
                $('#bookModal').fadeIn(200);

                // Load Bricks for this Book via AJAX
                $.ajax({
                    url: "<?php echo base_url('company/get_bricks_by_book_id') ?>",
                    type: 'POST',
                    data: {
                        book_id: bookId
                    },
                    dataType: 'json',
                    beforeSend: function () {
                        $('#alreadyBricksResult').html('<p>Loading bricks...</p>');
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#alreadyBricksResult').html(response.html);
                            let modal = $('#bookModal');
                            initSteps(modal);
                        } else {
                            $('#alreadyBricksResult').html('<p style="color:red;">' + (response.message || 'Something went wrong.') + '</p>');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        $('#alreadyBricksResult').html('<p style="color:red;">AJAX Error: ' + error + '</p>');
                    }
                });
            });




            // ✅ Close Modal
            $('.closeModal').on('click', function () {
                $('#bookModal').fadeOut(200);
            });

        });
    </script>


    <script>
        $(document).ready(function () {
            $('#globalSearchForm').on('submit', function (e) {
                e.preventDefault(); // Stop page refresh

                let form = $(this);
                let actionUrl = form.attr('action'); // Controller URL
                let searchValue = $('#globally_search_filter').val();

                if (searchValue.trim() === "") {
                    $('#searchResult').html('<p style="color:red;">Please enter something to search.</p>');
                    return;
                }

                $.ajax({
                    url: actionUrl,
                    type: 'GET',
                    data: {
                        globally_search_filter: searchValue
                    },
                    beforeSend: function () {
                        $('#searchResult').html('<p>Searching...</p>');
                    },
                    success: function (response) {
                        // If controller returns HTML
                        $('#searchResult').html(response);

                        // If controller returns JSON (optional)
                        // let data = JSON.parse(response);
                        // $('#searchResult').html('<pre>' + JSON.stringify(data, null, 2) + '</pre>');
                    },
                    error: function (xhr, status, error) {
                        console.log(error);
                        $('#searchResult').html('<p style="color:red;">Something went wrong!</p>');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function () {

            // Handle form submit (Save button)
            $('#create_brick_tree').on('submit', function (e) {
                e.preventDefault(); // prevent normal submit

                let form = $(this);
                let actionUrl = form.attr('action');

                // Collect selected checkbox IDs
                let selectedBricks = [];
                $('input[name="mybookbricks[]"]:checked').each(function () {
                    selectedBricks.push($(this).val());
                });

                if (selectedBricks.length === 0) {
                    alert('Please select at least one brick before saving.');
                    return;
                }

                // Optional: collect modalBookId if you’re using it
                let modalBookId = $('#modalBookId').val();

                $.ajax({
                    url: actionUrl,
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        mybookbricks: selectedBricks,
                        modalBookId: modalBookId
                    },
                    beforeSend: function () {
                        $('.btn.bg-primary').prop('disabled', true).text('Saving...');
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            alert('Bricks saved successfully!');
                            // Optionally reset checkboxes
                            $('input[name="mybookbricks[]"]').prop('checked', false);
                        } else {
                            alert(response.message || 'Something went wrong!');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                        alert('Error while saving bricks.');
                    },
                    complete: function () {
                        $('.btn.bg-primary').prop('disabled', false).text('Save');
                    }
                });
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.35.4/tagify.min.js" integrity="sha512-sKkyJJpMbq+xZRQwXCksuVx5g4JuYQK7c3+65dF3CAx3Gcn67+BPC2PyJkJEugtRRAeDBLPfcsULXbEZ5iqYjg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            let activeTimeline = null;
            const timelineContainer = document.getElementById("timeline_container");
            const menu = document.getElementById("contextMenu");
            const menuAddUser = document.getElementById("menuAddUser");
            let treeId = $('#tree_select').val();
            let draggedUser = null;
            let selectedUser = null;
            let connectionStartUser = null;
            let connections = [];
            let activeUser = null;
            const userMenu = document.getElementById("userContextMenu");
            const menuRemoveUser = document.getElementById("menuRemoveUser");


            /* ===============================
            RENDER TIMELINES
            =============================== */
            function renderTimeLineNew(branches) {

                timelineContainer.innerHTML = '';

                const row = document.createElement("div");
                row.className = "d-flex flex-column";

                branches.forEach(branch => {

                    const timeline = document.createElement("div");
                    timeline.className = "my_timeline my-2 py-4";
                    timeline.dataset.id = branch.id;

                    const line = document.createElement("span");
                    line.className = "my_timeline_line";

                    // 🔥 ALWAYS create users wrapper
                    const usersWrapper = document.createElement("div");
                    usersWrapper.className = "timeline-users";

                    timeline.appendChild(line);
                    timeline.appendChild(usersWrapper);

                    row.appendChild(timeline);
                });

                timelineContainer.appendChild(row);
            }


            /* ===============================
            RIGHT CLICK (EVENT DELEGATION)
            =============================== */
            document.addEventListener("contextmenu", function (e) {
                // 1. Disable menu if we are currently connecting users
                if (connectionStartUser) { 
                    e.preventDefault(); 
                    return; 
                }

                // 🔥 FIX: If we clicked on a USER, do not show the timeline menu!
                if (e.target.closest(".timeline-user")) return;

                const timeline = e.target.closest(".my_timeline");

                if (!timeline) return;

                e.preventDefault();

                activeTimeline = timeline;

                menu.style.top = e.pageY + "px";
                menu.style.left = e.pageX + "px";
                menu.style.display = "block";

                userMenu.style.display = "none";
            });

            /* ===============================
            ADD USER (TAGIFY)
            =============================== */
            menuAddUser.addEventListener("click", function (e) {

                e.stopPropagation();

                if (!activeTimeline) return;

                // Prevent duplicate input
                if (activeTimeline.querySelector(".tagify")) return;

                const input = document.createElement("input");
                input.placeholder = "Add users...";
                input.className = "user-input";

                activeTimeline.appendChild(input);

                initTagify(input, activeTimeline.dataset.id);

                menu.style.display = "none";
            });

            /* ===============================
            INIT TAGIFY WITH DB SEARCH
            =============================== */
            function initTagify(inputElm, timelineId) {

                const tagify = new Tagify(inputElm, {
                    tagTextProp: "name",
                    enforceWhitelist: true,
                    skipInvalid: true,
                    dropdown: {
                        enabled: 1,
                        searchKeys: ["name", "email"]
                    },
                    whitelist: [],
                    templates: {
                        dropdownItem: suggestionItemTemplate,
                    }
                });

                // 🔍 Search users from DB
                tagify.on("input", function (e) {
                    const value = e.detail.value.trim();
                    if (!value) return;

                    tagify.loading(true);

                    fetch("<?= base_url('Home/searchUsersNew') ?>", {
                        method: "POST",
                        headers: { "Content-Type": "application/json" },
                        body: JSON.stringify({ search: value })
                    })
                    .then(res => res.json())
                    .then(res => {
                        tagify.loading(false);

                        if (!res.success || !Array.isArray(res.users)) {
                            tagify.settings.whitelist = [];
                            return;
                        }

                        const safeUsers = res.users
                            .filter(u => u && u.name) // ✅ REMOVE BAD DATA
                            .map(u => ({
                                value: String(u.value),   // must be string
                                name: String(u.name),     // must be string
                                email: u.email || '',
                                avatar: u.avatar || ''
                            }));

                        tagify.settings.whitelist = safeUsers;

                        if (safeUsers.length) {
                            if (value && safeUsers.length) {
                                tagify.dropdown.show(value);
                            }
                        }

                    });
                });

                // ➕ Save user to timeline
                tagify.on("add", function (e) {
                    saveUserToTimeline(timelineId, e.detail.data, function (status, json) {
                        // console.log('status:', status);
                        if (status === 'success') {
                            // ✅ 1. Render user immediately
                            renderUserOnTimeline(json.user, timelineId);

                            // ✅ 2. Destroy Tagify instance
                            tagify.destroy();

                            // ✅ 3. Remove input from DOM
                            inputElm.remove();

                        }else if(status === 'duplicate') {
                            $('#duplicate_user_alert').text('⚠️ This user is already added to the timeline.')
                                .removeClass('d-none')
                                .fadeIn();


                            // ✅ 2. Destroy Tagify instance
                            tagify.destroy();

                            // ✅ 3. Remove input from DOM
                            inputElm.remove()

                            // ✅ 4. Auto hide alert after 3 seconds (optional)
                            setTimeout(() => {
                                $('#duplicate_user_alert').fadeOut();
                            }, 4000);
                        }
                    });
                });

            }

            /* ===============================
            SAVE USER ↔ TIMELINE
            =============================== */
            function saveUserToTimeline(timelineId, user, callback) {
                $.ajax({
                    url: "<?= base_url('Home/add_user_to_timeline') ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        "tree_id" : treeId,
                        "timeline_id" : timelineId,
                        "user_id" : user.value
                    },
                    success: (json)=>{
                        callback(json.status, json);
                    },
                    error: (e)=>{
                        callback(false, null);
                    }
                })
            }

            /* ===============================
            RENDER USER ON TIMELINE
            =============================== */

            function renderUserOnTimeline(user, timelineId) {

                const timeline = document.querySelector(
                    `.my_timeline[data-id="${timelineId}"]`
                );
                if (!timeline) return;

                const usersWrapper = timeline.querySelector(".timeline-users");
                if (!usersWrapper) return;

                const div = document.createElement("div");
                div.className = "timeline-user";
                div.draggable = true;
                div.dataset.userId = user.id || user.user_id;
                div.dataset.timelineId = timelineId;
                // console.log('user.id', user.id);
                
                div.innerHTML = `
                <a href="<?= base_url('company/user_preview?id=') ?>${user.id}">
                    <img src="${user.user_image 
                        ? "<?= base_url('uploads/user_profile/') ?>" + user.user_image 
                        : "<?= base_url('uploads/user_profile/user.png') ?>"}"
                        class="user-avatar">
                    <span>${user.name ? user.name : user.email}</span>
                </a>
                `;

                usersWrapper.appendChild(div);
            }
            
            document.addEventListener("click", function (e) {

                if (!connectionStartUser) return;

                const link = e.target.closest("a");
                if (!link) return;

                // Only block anchor navigation during connection mode
                e.preventDefault();

            }, true); // capture phase


            /* ===============================
            CLOSE MENU
            =============================== */
            document.addEventListener("click", function () {
                menu.style.display = "none";
            });

            function suggestionItemTemplate(tagData) {
                return `
                <div ${this.getAttributes(tagData)}
                    class="tagify__dropdown__item d-flex align-items-center"
                    tabindex="0"
                    role="option">

                    ${tagData.avatar ? `
                    <div class="tagify__dropdown__item__avatar-wrap me-2">
                        <img class="rounded-circle"
                            src="${tagData.avatar}"
                            style="width:28px;height:28px"
                            onerror="this.style.display='none'">
                    </div>` : ''}

                    <div>
                        <div class="fw-bold">${tagData.name || 'Unknown User'}</div>
                        <small class="text-muted">${tagData.email || ''}</small>
                    </div>
                </div>
                `;
            }
            
            function renderUsersOnTimelines(users) {

                users.forEach(user => {
                    renderUserOnTimeline(user, user.timeline_id);
                });
            }


            $('#tree_select').on('change', function () {

                resetConnectionMode();

                treeId = $(this).val(); // 🔥 update global treeId

                connections = [];

                // 2. 🔥 CLEAR OLD SVG LINES (DOM)
                document.getElementById("connectionLayer").innerHTML = '';

                if (!treeId) {
                    timelineContainer.innerText = 'No Tree Selected';
                    return;
                }
                
                $.ajax({
                    url: '<?= base_url('home/get_branches')?>',
                    type: 'POST',
                    datatype: 'json',
                    data:{
                        tree_id: treeId
                    },
                    success: (res)=>{
                        json = JSON.parse(res);
                        renderTimeLineNew(json.branches);
                        renderUsersOnTimelines(json.users);
                        loadConnections(treeId)
                    },
                    error: (e)=>{
                        console.log(e);

                    }

                })
            })

            $('#tree_select').trigger('change');

            document.addEventListener("contextmenu", function (e) {

                // 1. Disable menu if we are currently connecting users
                if (connectionStartUser) { 
                    e.preventDefault(); 
                    return; 
                }

                const userEl = e.target.closest(".timeline-user");

                if (!userEl) return;

                e.preventDefault();
                e.stopPropagation();

                activeUser = userEl;

                userMenu.style.top = e.pageY + "px";
                userMenu.style.left = e.pageX + "px";
                userMenu.style.display = "block";
            });

            menuRemoveUser.addEventListener("click", function () {

                if (!activeUser) return;

                const userId = activeUser.dataset.userId;
                const timelineId = activeUser.dataset.timelineId;

                if (!confirm("Are you sure you want to remove this user?")) {
                    return;
                }

                $.ajax({
                    url: "<?= base_url('Home/remove_user_from_timeline') ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        tree_id: treeId,
                        timeline_id: timelineId,
                        user_id: userId
                    },
                    success: function (res) {

                        if (res.status === 'success') {
                            activeUser.remove(); // 🔥 UI update
                        }
                    }
                });

                userMenu.style.display = "none";
            });

            document.addEventListener("click", function () {
                userMenu.style.display = "none";
            });

            document.addEventListener("dragstart", function (e) {

                const user = e.target.closest(".timeline-user");
                if (!user) return;

                draggedUser = user;
                e.dataTransfer.effectAllowed = "move";
                user.classList.add("dragging");
            });

            document.addEventListener("dragend", function (e) {
                if (draggedUser) {
                    draggedUser.classList.remove("dragging");
                    requestAnimationFrame(() => {
                        updateAllLines();
                    });
                    draggedUser = null;
                }
            });

            function updateLinesForUser(userEl) {
                // Loop through all existing connections
                connections.forEach(conn => {
                    // If this connection involves the moved user, update coordinates
                    if (conn.from === userEl || conn.to === userEl) {
                        updateLinePosition(conn);
                    }
                });
            }

            document.addEventListener("dragover", function (e) {

                const usersWrapper = e.target.closest(".timeline-users");
                if (!usersWrapper) return;

                e.preventDefault();

                if (draggedUser) {
                    updateLinesForUser(draggedUser);
                }
            });

            document.addEventListener("drop", function (e) {

                const usersWrapper = e.target.closest(".timeline-users");
                if (!usersWrapper || !draggedUser) return;

                e.preventDefault();

                const timeline = usersWrapper.closest(".my_timeline");
                if (!timeline) return;

                const oldTimelineId = draggedUser.dataset.timelineId;
                const newTimelineId = timeline.dataset.id;

                // 🔥 Append to wrapper (move user)
                usersWrapper.appendChild(draggedUser);

                // 🔥 Update dataset
                draggedUser.dataset.timelineId = newTimelineId;

                requestAnimationFrame(() => {
                    updateAllLines(); // Better than just updating the single user
                });

                // 🔥 Save change in DB
                updateUserTimeline(
                    draggedUser.dataset.userId,
                    oldTimelineId,
                    newTimelineId
                );
            });

            function updateUserTimeline(userId, oldTimelineId, newTimelineId) {

                $.ajax({
                    url: "<?= base_url('Home/update_user_timeline') ?>",
                    type: "POST",
                    dataType: "json",
                    data: {
                        tree_id: treeId,
                        user_id: userId,
                        from_timeline: oldTimelineId,
                        to_timeline: newTimelineId
                    },
                    success: function (res) {
                        console.log("User moved");
                    }
                });
            }
            
            const menuAddConnection = document.getElementById("menuAddConnection");

            menuAddConnection.addEventListener("click", function (e) {

                e.stopPropagation();

                if (!activeUser) return;

                connectionStartUser = activeUser;

                activeUser.classList.add("connection-source");

                userMenu.style.display = "none";
                menu.style.display = "none";

                // alert("Now click on another user to connect");
            });
            
            document.addEventListener("click", function (e) {

                // If we are NOT in connection mode, do nothing
                if (!connectionStartUser) return;

                const targetUser = e.target.closest(".timeline-user");

                // If clicked on empty space (and not the menu), cancel mode
                if (!targetUser) {
                    // We add a small check to ensure we didn't just click the menu 
                    // (Double safety, though e.stopPropagation in step 1 handles this)
                    if(!e.target.closest('#menuAddConnection')){
                        console.log("Clicked outside, resetting mode");
                        resetConnectionMode();
                    }
                    return;
                }

                e.preventDefault();
                e.stopPropagation();

                // Prevent connecting to self
                if (targetUser === connectionStartUser) {
                    console.log("Cannot connect to self");
                    resetConnectionMode();
                    return;
                }

                // 🔥 Create connection
                createConnection(connectionStartUser, targetUser);

                resetConnectionMode();
            });


            
            function createConnection(userA, userB) {

                if (connectionExists(userA, userB)) return;

                const svg = document.getElementById("connectionLayer");

                const line = document.createElementNS("http://www.w3.org/2000/svg", "line");

                line.setAttribute("stroke", "#0d6efd");
                line.setAttribute("stroke-width", "2");
                line.setAttribute("data-from", userA.dataset.userId);
                line.setAttribute("data-to", userB.dataset.userId);

                svg.appendChild(line);

                const connection = { from: userA, to: userB, line };
                connections.push(connection);

                updateLinePosition(connection);

                // 🔥 Save to DB (optional)
                saveConnection(userA.dataset.userId, userB.dataset.userId);
            }

            // function updateLinePosition(connection) {

            //     const rectA = connection.from.getBoundingClientRect();
            //     const rectB = connection.to.getBoundingClientRect();
            //     const svgRect = document
            //         .getElementById("connectionLayer")
            //         .getBoundingClientRect();

            //     const x1 = rectA.left + rectA.width / 2 - svgRect.left;
            //     const y1 = rectA.top + rectA.height / 2 - svgRect.top;

            //     const x2 = rectB.left + rectB.width / 2 - svgRect.left;
            //     const y2 = rectB.top + rectB.height / 2 - svgRect.top;

            //     connection.line.setAttribute("x1", x1);
            //     connection.line.setAttribute("y1", y1);
            //     connection.line.setAttribute("x2", x2);
            //     connection.line.setAttribute("y2", y2);
            // }
            
            function updateLinePosition(connection) {
                // 🔥 FIX: Select the image specifically, not the whole div
                const imgA = connection.from.querySelector('.user-avatar');
                const imgB = connection.to.querySelector('.user-avatar');

                // Get rect of the Image (if image is missing, fall back to the div)
                const rectA = (imgA || connection.from).getBoundingClientRect();
                const rectB = (imgB || connection.to).getBoundingClientRect();
                
                const svgRect = document.getElementById("connectionLayer").getBoundingClientRect();

                // Calculate center based on the IMAGE dimensions
                const x1 = rectA.left + rectA.width / 2 - svgRect.left;
                const y1 = rectA.top + rectA.height / 2 - svgRect.top;

                const x2 = rectB.left + rectB.width / 2 - svgRect.left;
                const y2 = rectB.top + rectB.height / 2 - svgRect.top;

                connection.line.setAttribute("x1", x1);
                connection.line.setAttribute("y1", y1);
                connection.line.setAttribute("x2", x2);
                connection.line.setAttribute("y2", y2);
            }

            function saveConnection(fromUser, toUser) {
                $.post("<?= base_url('Home/save_connection') ?>", {
                    tree_id: treeId,
                    from_user: fromUser,
                    to_user: toUser
                });
            }

            document.addEventListener("keydown", function (e) {
                if (e.key === "Escape" && connectionStartUser) {
                    connectionStartUser.classList.remove("connection-source");
                    connectionStartUser = null;
                }
            });

            function resetConnectionMode() {
                if (connectionStartUser) {
                    connectionStartUser.classList.remove("connection-source");
                    connectionStartUser = null;
                }
            }

            function loadConnections(treeId) {
                $.get("<?= base_url('Home/get_connections') ?>", { tree_id: treeId }, function (res) {
                    // Ensure res is an object if jQuery didn't parse it automatically
                    if (typeof res === 'string') res = JSON.parse(res); 

                    if (!res.success) return;

                    res.connections.forEach(conn => {
                        // 🔥 Select by the attribute directly to be safe
                        const userA = document.querySelector(
                            `.timeline-user[data-user-id="${conn.from_user}"]`
                        );
                        const userB = document.querySelector(
                            `.timeline-user[data-user-id="${conn.to_user}"]`
                        );

                        // Debugging check
                        // console.log(`Connecting ${conn.from_user} to ${conn.to_user}`, userA, userB);

                        if (userA && userB) {
                            createConnection(userA, userB);
                        }
                    });
                }, "json");
            }
            
            function connectionExists(a, b) {
                return connections.some(c =>
                    (c.from === a && c.to === b) ||
                    (c.from === b && c.to === a)
                );
            }

            function updateAllLines() {
                connections.forEach(conn => {
                    updateLinePosition(conn);
                });
            }
        });

    </script>

    </body>

    </html>