
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <div class="row">
        <div class="col-4">
            <div class="d-flex gap-2 flex-column align-items-start">
                <label for="">Search Company</label>
                <select class="form-select" aria-label="Company Search" id="selected_company">
                    <option value="" selected>Select Company</option>
                    <?php foreach($companies as $c) : ?>
                        <option value="<?= $c['id'] ?>"><?= $c['company_name'] ?></option>
                    <?php endforeach;?>
                </select>
                <button id="search_project_btn" class="btn btn-info btn-sm text-white">Search Project</button>
            </div>
        </div>
        <div class="col-4">
            <div class="d-flex gap-2 flex-column align-items-start" id="projects_container"></div>
        </div>
        <div class="col-4">
            <div class="d-flex gap-2 flex-column align-items-start justify-content-start" id="bricks_container"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info" role="alert">
                <p><b>Selected Company:</b> <span id="show_selected_company">Not Selected</span></p>
                <p><b>Selected Project:</b> <span id="show_selected_project">Not Selected</span></p>
                <p><b>Selected Brick:</b> <span id="show_selected_brick">Not Selected</span></p>
            </div>
        </div>
        <div class="col-12">
            <div class="d-flex justify-content-center">
                <button id="fetch_team_structure_btn" class="btn btn-primary">Fetch Team Structure</button>
            </div>
        </div>
        <div class="col-12">
            <div class="" id="team_structure_container"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-4">
           <div class="d-flex gap-2 flex-column align-items-start">
                <label for="create_department">Create Department</label>
                <input id="new_department_name" type="text" class="form-control" list="departmentOptions">
                <datalist id="departmentOptions">
                    <option value="R&amp;D &amp; Innovation"></option>
                    <option value="Vendor listing"></option>
                    <option value="Manufacturing"></option>
                    <option value="Production"></option>
                    <option value="Quality check"></option>
                    <option value="Warehousing/storage"></option>
                    <option value="Logistics / Supply chain"></option>
                    <option value="Operational"></option>
                    <option value="Investor relations"></option>
                    <option value="HR"></option>
                    <option value="Sales"></option>
                    <option value="Marketing"></option>
                    <option value="Account"></option>
                    <option value="Public relation"></option>
                    <option value="Management"></option>
                    <option value="Top Leaders"></option>
                    <option value="Growth strategy / Merger-acquisition"></option>
                </datalist>
            <button id="create_department_btn" class="btn btn-primary btn-sm">Create Department</button>
           </div>
        </div>
    </div>
</div>

<?php $this->load->view('includes/footer-link'); ?>

<script>
    let selectedCompanyId = null;
    let selectedProjectId = null;
    let selectedBrickId = null;
    let selectedCompanyName = null;
    let selectedProjectName = null;
    let selectedBrickName = null;

    $(document).on('click', '#search_project_btn', function () {
        if(!selectedCompanyId){
            alert('select company first');
            return;

        }
        selectedCompanyId = $('#selected_company').val();
        selectedCompanyName = $('#selected_company').find('option:selected').text();
        
        $.ajax({
            url: '<?= base_url('Teams/get_projects') ?>',
            type: 'POST',
            data: {
                selectedCompanyId: selectedCompanyId
            },
            dataType: 'json',
            success: function (res) {
                $('#projects_container').append(res.html);
            },
            error: function (res) {
                console.error(res)
            }
        })
    })

    $(document).on('click', '#search_bricks_btn', function () {
        if(!selectedProjectId){
            alert('select project first');
            return;
        }
        selectedProjectId = $('#selected_project').val();
        selectedProjectName = $('#selected_project').find('option:selected').text();

        // console.log("selectedCompanyId",selectedCompanyId);
        
        $.ajax({
            url: '<?= base_url('Teams/get_bricks') ?>',
            type: 'POST',
            data: {
                selectedProjectId: selectedProjectId
            },
            dataType: 'json',
            success: function (res) {
                // console.log(res)
                $('#bricks_container').append(res.html);
            },
            error: function (res) {
                console.error(res)
            }
        })
    })

    $(document).on('change', '#selected_company', function () {
        selectedCompanyId = $('#selected_company').val();
        selectedCompanyName = $('#selected_company').find('option:selected').text()
        resetProject();
        resetBricks();
        updateSelection();
    })

    $(document).on('change', '#selected_project', function () {
        selectedProjectId = $('#selected_project').val();
        selectedProjectName = $('#selected_project').find('option:selected').text();
        resetBricks()
        updateSelection();
    })

    $(document).on('change', '#selected_brick', function () {
        selectedBrickId = $('#selected_brick').val();
        selectedBrickName = $('#selected_brick').find('option:selected').text();
        updateSelection();
    })

    function updateSelection(){
        if(selectedCompanyName !== null && selectedCompanyId !== null){
            let selected_company_text = `${selectedCompanyName} (${selectedCompanyId})`
            $('#show_selected_company').text(selected_company_text)
        }
        if(selectedProjectName !== null && selectedProjectId !== null){
            let selected_project_text = `${selectedProjectName} (${selectedProjectId})`
            $('#show_selected_project').text(selected_project_text)
        }
        if(selectedBrickName !== null && selectedBrickId !== null){
            let selected_brick_text = `${selectedBrickName} (${selectedBrickId})`
            $('#show_selected_brick').text(selected_brick_text)
        }
    }
    
    function resetProject() {
        selectedProjectId = null;
        selectedProjectName = null;
        $('#projects_container').empty();
        $('#show_selected_project').text('Not Selected');
        
    }

    function resetBricks() {
        selectedBrickId = null;
        selectedBrickName = null;
        $('#bricks_container').empty();
        $('#show_selected_brick').text('Not Selected');
    }

    $(document).on('click', '#fetch_team_structure_btn', function () {
        if(!selectedCompanyId){
            alert('select company first');
        }
        
        let formData = new FormData();

        selectedCompanyId != null && formData.append('selectedCompanyId',selectedCompanyId);
        selectedProjectId != null && formData.append('selectedProjectId',selectedProjectId);
        selectedBrickId != null && formData.append('selectedBrickId',selectedBrickId);
        
        $.ajax({
            url: '<?= base_url('Teams/get_team_structure') ?>',
            type: 'post',
            data: formData,
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function (res) {
                $('#team_structure_container').empty();
                $('#team_structure_container').append(res.html);
            },
            error: function (res) {
                console.error(res)
            }
        })
    })

    $(document).on('click', '#create_department_btn', function () {
        const deptName = $('#new_department_name').val().trim();

        if (!selectedCompanyId) {
            alert('Select company first');
            return;
        }

        if (!deptName) {
            alert('Enter department name');
            return;
        }

        let formData = new FormData();
        formData.append('department_name', deptName);
        formData.append('company_id', selectedCompanyId);

        selectedProjectId != null && formData.append('project_id', selectedProjectId);
        selectedBrickId != null && formData.append('brick_id', selectedBrickId);

        $.ajax({
            url: '<?= base_url('Teams/create_department') ?>',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    $('#new_department_name').val('');
                    alert('Department created successfully');

                    // 🔥 auto refresh team structure
                    $('#fetch_team_structure_btn').click();
                } else {
                    alert(res.msg || 'Failed to create department');
                }
            },
            error: function (err) {
                console.error(err);
            }
        });
    });

    $(document).on('input', '.member-search-input', function () {
        const $box = $(this).closest('.add-team-member');
        const query = $(this).val().trim();
        const $suggestions = $box.find('.member-suggestions');

        if (query.length < 2) {
            $suggestions.hide().empty();
            return;
        }

        $.ajax({
            url: '<?= base_url("Teams/search_freelancers") ?>',
            type: 'GET',
            data: { q: query },
            dataType: 'json',
            success: function (res) {
                if (!res.success || !res.users.length) {
                    $suggestions.hide().empty();
                    return;
                }

                let html = '';
                res.users.forEach(u => {
                    html += `
                        <button type="button" 
                            class="list-group-item list-group-item-action select-member"
                            data-id="${u.id}"
                            data-name="${u.name}">
                            ${u.name} (${u.email})
                        </button>
                    `;
                });

                $suggestions.html(html).show();
            }
        });
    });

    $(document).on('click', '.select-member', function () {
        const $box = $(this).closest('.add-team-member');
        $box.find('.member-search-input').val($(this).data('name'));
        $box.find('.selected-member-id').val($(this).data('id'));
        $box.find('.member-suggestions').hide().empty();
    });

    $(document).on('click', '.add-member-btn', function () {
        const $box = $(this).closest('.add-team-member');
        const departmentId = $box.data('dept-id');
        const memberId = $box.find('.selected-member-id').val();

        if (!memberId) {
            alert('Select a user first');
            return;
        }

        $.ajax({
            url: '<?= base_url("Teams/add_team_member") ?>',
            type: 'POST',
            data: {
                department_id: departmentId,
                member_id: memberId
            },
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    alert('Member added to department');
                    $('#fetch_team_structure_btn').click(); // refresh UI
                } else {
                    alert(res.msg || 'Failed to add member');
                }
            }
        });
    });
</script>