<label for="">Search Project</label>
<select class="form-select" aria-label="Project Search" id="selected_project">
    <option value="" selected>Select Project</option>
    <?php foreach($projects as $p) : ?>
        <option value="<?= $p['id'] ?>"><?= $p['project_name'] ?></option>
    <?php endforeach;?>
</select>
<button id="search_bricks_btn" class="btn btn-info btn-sm text-white">Search Bricks</button>