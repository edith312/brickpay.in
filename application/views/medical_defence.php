<style>
    .border-bottom{
        border-bottom: 1px solid black !important;
    }

    .pol-line{
        height: 100vh;
        width: 1px;
        background: black;
        top: 0px;
        right: 0px;
    }

    .police-container{
        top: 150px;
    }

    .defence-container{
        top: 150px;
        width: 90%;
    }
    .medical-container{
        top: 150px;
        width: 90%;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .list-group{
        max-height: 60vh;
    }
</style>

<div class="page-body pt-1 px-2">
    <div class="row text-center">
        <div class="col-6 m-0 py-5 border-bottom position-relative">
            <span class="pol-line position-absolute"></span>
            Defence
            <div class="position-absolute defence-container">
                <form id="defence_form">
                    <textarea class="form-control" name="defence_text" id=""></textarea>
                    <button class="btn btn-primary mt-2" type="submit">Save</button>
                </form>
                <div id="defence_data_container"></div>
            </div>
        </div>
        <div class="col-6 m-0 py-5 border-bottom position-relative">
            <span class="pol-line position-absolute"></span>
            Medical
            <div class="position-absolute medical-container">
                <form id="medical_form">
                    <textarea class="form-control" name="medical_text" id=""></textarea>
                    <button class="btn btn-primary mt-2" type="submit">Save</button>
                </form>
                <div id="medical_data_container"></div>
            </div>
                <!-- <div class="position-absolute police-container">
                    <button class="btn btn-primary">Cases</button>
                    <button class="btn btn-primary mt-3">Constitution</button>
                    <button class="btn btn-primary mt-3">Investigation</button>
                    <button class="btn btn-primary mt-3">Introgation</button>
                    <button class="btn btn-primary mt-3">Chargesheet</button>
                </div> -->
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

    $(document).ready(async function () {
        const defence_data = await get_defence_data();
        const medical_data = await get_medical_data();
        render_defence_data(defence_data);
        render_medical_data(medical_data);
    });

    $(document).on('submit', '#defence_form', function(e) {
        e.preventDefault();

        const editId = $(this).attr('data-edit-id');
        let formData = $(this).serialize();

        if (editId) {
            formData += `&id=${editId}`;
        }

        $.ajax({
            url: editId 
                ? "<?= base_url('Home/update_defence_data') ?>" 
                : "<?= base_url('Home/save_defence_data') ?>",
            type: "POST",
            data: formData,
            dataType: 'json',
            success: async function (res) {
                if (res.success) {
                    $('#defence_form').removeAttr('data-edit-id');
                    $('#defence_form textarea').val('');

                    const data = await get_defence_data();
                    render_defence_data(data);
                }
            }
        });
    });

    $(document).on('submit', '#medical_form', function(e) {
        e.preventDefault();

        const editId = $(this).attr('data-edit-id');
        let formData = $(this).serialize();

        if (editId) {
            formData += `&id=${editId}`;
        }

        $.ajax({
            url: editId 
                ? "<?= base_url('Home/update_medical_data') ?>" 
                : "<?= base_url('Home/save_medical_data') ?>",
            type: "POST",
            data: formData,
            dataType: 'json',
            success: async function (res) {
                if (res.success) {
                    $('#medical_form').removeAttr('data-edit-id');
                    $('#medical_form textarea').val('');

                    const data = await get_medical_data();
                    render_medical_data(data);
                }
            }
        });
    });


    async function get_defence_data() {
        const res = await fetch('<?= base_url('Home/get_defence_data') ?>');
        const data = await res.json();
        return data;
    }

    async function get_medical_data() {
        const res = await fetch('<?= base_url('Home/get_medical_data') ?>');
        const data = await res.json();
        return data;
    }

    function render_defence_data(data){

        const container = $('#defence_data_container');
        container.empty();

        if (!data || !data.length) {
            container.html('<p class="text-muted">No defence data added yet.</p>');
            return;
        }

        let html = '<ul class="list-group mt-3">';

        data.forEach(item => {
            html += `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="defence-text" data-id="${item.id}">
                        ${item.defence_text}
                    </span>

                    <span class="d-flex gap-2">
                        <i 
                            class="bi bi-pencil text-primary cursor-pointer edit-defence" 
                            data-id="${item.id}" 
                            title="Edit"
                        ></i>

                        <i 
                            class="bi bi-trash text-danger cursor-pointer delete-defence" 
                            data-id="${item.id}" 
                            title="Delete"
                        ></i>
                    </span>
                </li>
            `;
        });

        html += '</ul>';

        container.html(html);
    }

    function render_medical_data(data){

        const container = $('#medical_data_container');
        container.empty();

        if (!data || !data.length) {
            container.html('<p class="text-muted">No medical data added yet.</p>');
            return;
        }

        let html = '<ul class="list-group mt-3">';

        data.forEach(item => {
            html += `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="medical-text" data-id="${item.id}">
                        ${item.medical_text}
                    </span>

                    <span class="d-flex gap-2">
                        <i 
                            class="bi bi-pencil text-primary cursor-pointer edit-medical" 
                            data-id="${item.id}" 
                            title="Edit"
                        ></i>

                        <i 
                            class="bi bi-trash text-danger cursor-pointer delete-medical" 
                            data-id="${item.id}" 
                            title="Delete"
                        ></i>
                    </span>
                </li>
            `;
        });

        html += '</ul>';

        container.html(html);
    }

    // Edit
    $(document).on('click', '.edit-defence', function () {
        const id = $(this).data('id');
        const text = $(this).closest('li').find('.defence-text').text().trim();

        console.log('Edit:', id, text);

        // Example: fill textarea for editing
        $('#defence_form textarea').val(text).focus();
        $('#defence_form').attr('data-edit-id', id);
    });

    // Delete
    $(document).on('click', '.delete-defence', async function () {
        const id = $(this).data('id');

        if (!confirm('Are you sure you want to delete this?')) return;

        $.post("<?= base_url('Home/delete_defence_data') ?>", { id }, async function (res) {
            if (res.success) {
                const data = await get_defence_data();
                render_defence_data(data);
            }
        }, 'json');
    });

    // Edit
    $(document).on('click', '.edit-medical', function () {
        const id = $(this).data('id');
        const text = $(this).closest('li').find('.medical-text').text().trim();

        console.log('Edit:', id, text);

        // Example: fill textarea for editing
        $('#medical_form textarea').val(text).focus();
        $('#medical_form').attr('data-edit-id', id);
    });

    // Delete
    $(document).on('click', '.delete-medical', async function () {
        const id = $(this).data('id');

        if (!confirm('Are you sure you want to delete this?')) return;

        $.post("<?= base_url('Home/delete_medical_data') ?>", { id }, async function (res) {
            if (res.success) {
                const data = await get_medical_data();
                render_medical_data(data);
            }
        }, 'json');
    });
    
</script>