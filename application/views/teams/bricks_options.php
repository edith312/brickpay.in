<label for="">Search Bricks</label>
<select class="form-select" aria-label="Bricks Search" id="selected_brick">
    <option value="" selected>Select Bricks</option>
    <?php foreach($bricks as $b) : ?>
        <option value="<?= $b['id'] ?>"><?= $b['brick_title'] ?></option>
    <?php endforeach;?>
</select>
<button id="save_brick" class="btn btn-info btn-sm text-white">Select Brick</button>