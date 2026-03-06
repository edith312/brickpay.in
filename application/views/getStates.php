<?php
if (!empty($getStates)):
    foreach ($getStates as $state):
?>
        <option value="<?= $state['id'] ?>" <?= $selectedState === $state['id'] ? 'selected' : '' ?>><?= $state['name'] ?></option>
<?php endforeach;
endif; ?>