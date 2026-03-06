<?php if (!empty($calendar['timeline'])): ?>
    <?php foreach ($calendar['timeline'] as $key => $item): ?>
        <?php $this->load->view('calendar/_item_wrapper', [
            'item' => $item,
            'key'  => $key,
            'dragButtonMap' => $dragButtonMap
        ]); ?>
    <?php endforeach; ?>
<?php endif; ?>
