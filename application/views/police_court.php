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

    .political-container{
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
        <div class="col-4 m-0 py-5 border-bottom position-relative">
            <span class="pol-line position-absolute"></span>
            Political Party
            <div class="position-absolute political-container">
                <form id="political_form">
                    <textarea class="form-control" name="political_party_text" id=""></textarea>
                    <button class="btn btn-primary mt-2" type="submit">Save</button>
                </form>
                <div id="political_data_container"></div>
            </div>
        </div>
        <div class="col-4 m-0 py-5 border-bottom position-relative">
            <span class="pol-line position-absolute"></span>
            Police
                <div class="position-absolute police-container">
                    <button class="btn btn-primary">Cases</button>
                    <button class="btn btn-primary mt-3">Constitution</button>
                    <button class="btn btn-primary mt-3">Investigation</button>
                    <button class="btn btn-primary mt-3">Introgation</button>
                    <button class="btn btn-primary mt-3">Chargesheet</button>
                </div>
        </div>
        <div class="col-4 m-0 py-5 border-bottom">
            Court
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>

    $(document).ready(async function () {
        const data = await get_political_data();
        render_political_data(data);
    });

    $(document).on('submit', '#political_form', function(e) {
        e.preventDefault();

        const editId = $(this).attr('data-edit-id');
        let formData = $(this).serialize();

        if (editId) {
            formData += `&id=${editId}`;
        }

        $.ajax({
            url: editId 
                ? "<?= base_url('Home/update_political_data') ?>" 
                : "<?= base_url('Home/save_political_data') ?>",
            type: "POST",
            data: formData,
            dataType: 'json',
            success: async function (res) {
                if (res.success) {
                    $('#political_form').removeAttr('data-edit-id');
                    $('#political_form textarea').val('');

                    const data = await get_political_data();
                    render_political_data(data);
                }
            }
        });
    });


    async function get_political_data() {
        const res = await fetch('<?= base_url('Home/get_political_data') ?>');
        const data = await res.json();
        return data;
    }

    function render_political_data(data){

        const container = $('#political_data_container');
        container.empty();

        if (!data || !data.length) {
            container.html('<p class="text-muted">No political data added yet.</p>');
            return;
        }

        let html = '<ul class="list-group mt-3">';

        data.forEach(item => {
            html += `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span class="political-text" data-id="${item.id}">
                        ${item.political_party_text}
                    </span>

                    <span class="d-flex gap-2">
                        <i 
                            class="bi bi-pencil text-primary cursor-pointer edit-political" 
                            data-id="${item.id}" 
                            title="Edit"
                        ></i>

                        <i 
                            class="bi bi-trash text-danger cursor-pointer delete-political" 
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
    $(document).on('click', '.edit-political', function () {
        const id = $(this).data('id');
        const text = $(this).closest('li').find('.political-text').text().trim();

        console.log('Edit:', id, text);

        // Example: fill textarea for editing
        $('#political_form textarea').val(text).focus();
        $('#political_form').attr('data-edit-id', id);
    });

    // Delete
    $(document).on('click', '.delete-political', async function () {
        const id = $(this).data('id');

        if (!confirm('Are you sure you want to delete this?')) return;

        $.post("<?= base_url('Home/delete_political_data') ?>", { id }, async function (res) {
            if (res.success) {
                const data = await get_political_data();
                render_political_data(data);
            }
        }, 'json');
    });
    
</script>