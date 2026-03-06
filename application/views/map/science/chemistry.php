<style>
    .periodic-table{
        display:grid;
        grid-template-columns: repeat(18, 1fr);
        gap:8px;
        max-width:1200px;
        margin:auto;
    }
    .element{
        background:#fff;
        border-radius:6px;
        padding:10px;
        text-align:center;
        box-shadow:0 2px 5px rgba(0,0,0,.1);
        cursor:pointer;
        transition:0.3s;
    }
    .element:hover{
        transform:scale(1.05);
        background:#dfefff;
    }
    .atomic{
        font-size:12px;
        color:#555;
    }
    .symbol{
        font-size:22px;
        font-weight:bold;
    }
    .name{
        font-size:12px;
    }
</style>
<div class="page-body pt-1 px-2">

    <?php $this->load->view('map/header') ?>

    <?php
        $depth = [
            ['title'=>'School<br>(1)','url'=>'company/school'],
            ['title'=>'Science<br>(1.1)','url'=>'company/school/science'],
            ['title'=>'Chemistry<br>(1.1.2)','url'=>'']
        ];
        pageDepth_new($depth);
    ?>
    <h2 align="center">Periodic Table</h2>

    <div class="periodic-table px-4 overflow-scroll">
        <?php foreach($elements as $row) :?>
            <a href="<?php echo base_url('science/chemistry/element') . '/' . $row['id']?>">
                <div class="element">
                    <div class="atomic"><?=$row['atomic_number']?></div>
                    <div class="symbol"><?=$row['symbol']?></div>
                    <div class="name"><?=$row['name']?></div>
                </div>
            </a>
        <?php endforeach ?>
    </div>
</div>