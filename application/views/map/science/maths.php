
<?php

    $market_research= [
        "Physics" => "science/physics",
        "Chemistry" => "science/chemistry",
        "Maths" => "science/maths",
        "Biology" => "science/biology",
        "Evolution and Timeline" => "science/evolution_and_timeline"
    ];

?>

<style>
  body {
    background: #f1f3f6;
  }

  .main-wrapper {
    display: flex;
    justify-content: center;
    gap: 30px;
    flex-wrap: wrap;
  }

  .math-grid-wrapper {
    position: relative;
  }

  .math-grid {
    display: grid;
    grid-template-columns: repeat(10, 30px);
    grid-template-rows: repeat(10, 30px);
  }

  .cell {
    width: 30px;
    height: 30px;
    border: 1px solid #333;
    font-size: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    background: #fff;
    user-select: none;
  }

  .x-axis {
    display: grid;
    grid-template-columns: repeat(10, 30px);
    margin-top: 5px;
    text-align: center;
    font-weight: bold;
  }

  .y-axis {
    display: grid;
    grid-template-rows: repeat(10, 30px);
    margin-left: 5px;
    font-weight: bold;
  }

  /* Right Color Panel */
  .color-panel {
    width: 240px;
    background: #fff;
    padding: 15px;
    border-radius: 10px;
    border: 1px solid #ddd;
  }

  .color-panel label {
    font-size: 13px;
    margin-top: 10px;
  }

  .preview {
    width: 100%;
    height: 50px;
    border-radius: 6px;
    border: 1px solid #000;
    margin-top: 10px;
  }

  input[type="range"] {
    width: 100%;
  }
</style>

<div class="page-body pt-1 px-2">

    <?php $this->load->view('map/header') ?>

    <?php
        $depth = [
            ['title'=>'School<br>(1)','url'=>'company/school'],
            ['title'=>'Science<br>(1.1)','url'=>'company/school/science'],
            ['title'=>'Math<br>(1.1.3)','url'=>''],
        ];
        pageDepth_new($depth);
    ?>

    <div class="container py-5">
        <h2 class="text-center mb-4 fw-bold">Maths</h2>

        <div class="row g-3">
            <?php
            $maths = [
                "Logic Gates",
                "Intregation",
                "Differentiation"
            ];

            // Loop through array to generate buttons
            foreach($maths as $math) {
                echo '<div class="col-lg-3 col-md-4 col-sm-6">';
                echo '<a href="#" class="branch-btn">'.$math.'</a>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    
    <div class="container py-5">
        <h2 class="text-center fw-bold mb-4">Maths – RGB Color Grid</h2>

        <div class="main-wrapper">

            <!-- GRID -->
            <div class="d-flex">
            <div class="math-grid-wrapper">
                <div class="math-grid" id="grid"></div>
                <div class="x-axis" id="x-axis"></div>
            </div>
            <div class="y-axis" id="y-axis"></div>
            </div>

            <!-- COLOR PANEL -->
            <div class="color-panel">
            <h6 class="fw-bold text-center">🎨 RGB Color Selector</h6>

            <label>Red (0–255)</label>
            <input type="range" id="r" min="0" max="255" value="255">

            <label>Green (0–255)</label>
            <input type="range" id="g" min="0" max="255" value="0">

            <label>Blue (0–255)</label>
            <input type="range" id="b" min="0" max="255" value="0">

            <div class="preview" id="preview"></div>

            <div class="mt-2 small">
                <strong>RGB:</strong> <span id="rgbValue"></span><br>
                <strong>HEX:</strong> <span id="hexValue"></span>
            </div>

            <button class="btn btn-sm btn-danger w-100 mt-3" id="reset">
                Reset Grid
            </button>
            </div>

        </div>
        </div>

</div>

<script>
  const grid = document.getElementById("grid");
  const xAxis = document.getElementById("x-axis");
  const yAxis = document.getElementById("y-axis");

  const r = document.getElementById("r");
  const g = document.getElementById("g");
  const b = document.getElementById("b");

  const preview = document.getElementById("preview");
  const rgbValue = document.getElementById("rgbValue");
  const hexValue = document.getElementById("hexValue");
  const resetBtn = document.getElementById("reset");

  let selectedColor = "";

  // Update Color (0–255 only)
  function updateColor() {
    const red = Math.min(255, Math.max(0, parseInt(r.value)));
    const green = Math.min(255, Math.max(0, parseInt(g.value)));
    const blue = Math.min(255, Math.max(0, parseInt(b.value)));

    selectedColor = `rgb(${red}, ${green}, ${blue})`;
    preview.style.backgroundColor = selectedColor;
    rgbValue.textContent = selectedColor;

    const hex =
      "#" +
      red.toString(16).padStart(2, "0") +
      green.toString(16).padStart(2, "0") +
      blue.toString(16).padStart(2, "0");

    hexValue.textContent = hex;
  }

  r.oninput = g.oninput = b.oninput = updateColor;
  updateColor();

  // Create Grid 1–100
  for (let i = 1; i <= 100; i++) {
    const cell = document.createElement("div");
    cell.className = "cell";
    cell.textContent = i;

    cell.onclick = () => {
      cell.style.backgroundColor = selectedColor;
      cell.style.color = "#fff";
    };

    grid.appendChild(cell);
  }

  // Axis
  for (let i = 1; i <= 10; i++) {
    xAxis.innerHTML += `<div>${i}</div>`;
    yAxis.innerHTML += `<div>${i}</div>`;
  }

  // Reset Grid
  resetBtn.onclick = () => {
    document.querySelectorAll(".cell").forEach(cell => {
      cell.style.backgroundColor = "#fff";
      cell.style.color = "#000";
    });
  };
</script>
