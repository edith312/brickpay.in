<?php
if (!empty($getCities)):
    foreach ($getCities as $city):
?>
        <option value="<?= $city['id'] ?>"><?= $city['name'] ?></option>
<?php
    endforeach;
endif;
?>