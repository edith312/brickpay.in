<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />


<style>
    #map {
        width: 100%;
        height: 77vh;
        background: #bcdff1;
    }

    .box {
        border: 2px solid black;
        width: 40px;
        text-align: center;
        font-weight: bold;
    }
</style>

<div class="page-body pt-1 px-2">
    <?php $this->load->view('map/header')?>

    <?php

        $languages = [

            "english" => [
                "name"  => "English",
                "start" => "0041",
                "end"   => "005A",
                "extra" => []
            ],

            "hindi" => [
                "name"  => "Hindi",
                "start" => "0900",
                "end"   => "097F",
                "extra" => []
            ],

            "spanish" => [
                "name"  => "Spanish",
                "start" => "0041",
                "end"   => "005A",
                "extra" => ["00D1","00C1","00C9","00CD","00D3","00DA","00DC"] // Ñ Á É Í Ó Ú Ü
            ],

            "arabic" => [
                "name"  => "Arabic",
                "start" => "0600",
                "end"   => "06FF",
                "extra" => []
            ],

            "bengali" => [
                "name"  => "Bengali",
                "start" => "0980",
                "end"   => "09FF",
                "extra" => []
            ],

            "portuguese" => [
                "name"  => "Portuguese",
                "start" => "0041",
                "end"   => "005A",
                "extra" => ["00C1","00C2","00C3","00C0","00C7","00C9","00CA","00CD","00D3","00D4","00D5","00DA"]
            ],

            "russian" => [
                "name"  => "Russian",
                "start" => "0400",
                "end"   => "04FF",
                "extra" => []
            ],

            "japanese" => [
                "name"  => "Japanese",
                "start" => "3040",
                "end"   => "309F",
                "extra" => []
            ],

            "punjabi" => [
                "name"  => "Punjabi",
                "start" => "0A00",
                "end"   => "0A7F",
                "extra" => []
            ],

            "german" => [
                "name"  => "German",
                "start" => "0041",
                "end"   => "005A",
                "extra" => ["00C4","00D6","00DC","00DF"] // Ä Ö Ü ß
            ]

        ];

        $characters = [];

        /* Generate characters for each language */
        foreach ($languages as $key => $lang) {

            $start = hexdec($lang['start']);
            $end   = hexdec($lang['end']);

            for ($i = $start; $i <= $end; $i++) {
                $characters[$key][] = mb_chr($i,'UTF-8');
            }

            // add extra characters
            if(!empty($lang['extra'])){
                foreach($lang['extra'] as $hex){
                    $characters[$key][] = mb_chr(hexdec($hex),'UTF-8');
                }
            }
        }

        /* Find longest script so rows align */
        $maxRows = 0;
        foreach ($characters as $set) {
            $maxRows = max($maxRows, count($set));
        }

    ?>

    <table border="1" cellpadding="6" style="width:100%; text-align:center">

        <tr>
            <th>#</th>

            <?php foreach ($languages as $lang) {?>
            <th>
                <?php echo $lang['name'] ?>
            </th>
            <?php }?>

        </tr>

        <?php for ($i = 0; $i < $maxRows; $i++) {?>

        <tr>

            <td>
                <?php echo str_pad($i + 1, 2, "0", STR_PAD_LEFT) ?>
            </td>

            <?php foreach ($languages as $key => $lang) {?>

            <td>
                <?php
                    if (isset($characters[$key][$i])) {
                        echo $characters[$key][$i] . "<br>";
                    }
                    ?>
            </td>

            <?php }?>

        </tr>

        <?php }?>

    </table>
</div>