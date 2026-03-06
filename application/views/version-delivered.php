<?php $this->load->view('includes/header-link'); ?>
<style>
  .zoom-buttons {
    position: fixed;
    top: 81px;
    right: 0;
    transform: translateX(-50%);
    display: flex;
    flex-direction: row;
    gap: 10px;
    z-index: 9;
  }

  .zoom-buttons button {
    width: 40px;
    height: 40px;
    border: none;
    border-radius: 50%;
    font-size: 24px;
    background-color: #333;
    color: white;
    cursor: pointer;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    transition: all 0.2s ease;
  }

  .zoom-buttons button:hover {
    background-color: #555;
    transform: scale(1.1);
  }

  .graph-container {
    position: fixed;
    width: 100%;
    bottom: 0;
    height: auto;
    display: flex;
    justify-content: start;
    align-items: flex-end;
    padding-bottom: 13px;
    overflow: visible;
    transform-origin: bottom left;
    transition: transform 0.3s ease;
  }

  .circle-wrapper {
    position: relative;
    width: 600px;
    height: 300px;
  }

  .circle-layer {
    position: absolute;
    bottom: 0;
    left: 0;
    border: 2px solid black;
    border-radius: 0% 105% 0 0;
    background: transparent;
    width: 100%;
    height: 100%;
    ;
  }

  .center-dot {
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 8px;
    height: 8px;
    background-color: black;
    border-radius: 50%;
    z-index: 10;
  }

  .arrow-line {
    position: absolute;
    bottom: -1px;
    left: 0;
    display: flex;
    gap: 70px;
  }

  .arrow {
    width: 30px;
    height: 2px;
    background: black;
    position: relative;
  }

  .arrow::after {
    content: '';
    position: absolute;
    right: -5px;
    top: -4px;
    width: 0;
    height: 0;
    border-top: 5px solid transparent;
    border-bottom: 5px solid transparent;
    border-left: 6px solid black;
  }

  .version {
    position: absolute;
    top: -20px;
    left: 50%;
    transform: translateX(-50%);
    font-size: 10px;
    color: black;
  }

  .tooltip {
    position: absolute;
    bottom: 100%;
    left: 50%;
    transform: translateX(-50%);
    background: black;
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
    margin-bottom: 6px;
    z-index: 10;
  }

  .arrow:hover .tooltip {
    opacity: 1;
  }
</style>
<?php $this->load->view('includes/header'); ?>
<!-- Shiv Web Developer -->
<div class="zoom-buttons">
  <button onclick="zoomIn()">+</button>
  <button onclick="zoomOut()">−</button>
</div>
<div class="page-body">
  <div class="graph-container" id="graph">
    <div class="circle-wrapper d-flex flex-column justify-content-end align-items-center">
      <div class="circle-layer"></div>
      <div class="circle-layer"></div>
      <div class="circle-layer"></div>

      <div class="center-dot"></div>

      <div class="arrow-line">
        <div class="arrow">
          <span class="version">V1</span>
          <span class="tooltip">Version 1</span>
        </div>
        <div class="arrow">
          <span class="version">V2</span>
          <span class="tooltip">Version 2</span>
        </div>
        <div class="arrow">
          <span class="version">V3</span>
          <span class="tooltip">Version 3</span>
        </div>
        <div class="arrow">
          <span class="version">V4</span>
          <span class="tooltip">Version 4</span>
        </div>
        <div class="arrow">
          <span class="version">V5</span>
          <span class="tooltip">Version 5</span>
        </div>
        <div class="arrow">
          <span class="version">V6</span>
          <span class="tooltip">Version 6</span>
        </div>
        <div class="arrow">
          <span class="version">V7</span>
          <span class="tooltip">Version 7</span>
        </div>
        <div class="arrow">
          <span class="version">V8</span>
          <span class="tooltip">Version 8</span>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view('includes/footer-link'); ?>