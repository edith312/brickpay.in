<style>
    .modal-overlay {
     position: fixed;
     top: 0;
     left: 0;
     width: 100vw;
     height: 100vh;
     background-color: rgba(0, 0, 0, 0.7);
     display: none;
     align-items: start;
     justify-content: center;
     z-index: 1000;
     overflow-y: auto;
     padding-top: 40px;
   }

   .modal-box {
     background: #fff;
     border-radius: 10px;
     padding: 20px 30px;
     width: 90%;
     max-width: 600px;
     box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
     position: relative;
     margin: auto;
   }

   .save-btn {
     background: #007bff;
     color: #fff;
     border: none;
     padding: 8px 16px;
     border-radius: 4px;
     cursor: pointer;
   }

   .save-btn:hover {
     background-color: #0056b3;
   }
</style>
<div class="modal-overlay" id="pinModal" style="width:100%">
  <div class="modal-box">
    <?php if($this->session->flashdata('error')) :?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error')?>
        </div>
    <?php endif; ?>
    <!-- <span class="modal-close" onclick="closeElementModal()">&times;</span> -->
    <h5 class="text-center">Enter Pin to Access This Panel</h5>
    <form action="" method="POST">
        <div class="mt-5 d-flex justify-content-around">
            <input id="pin" type="password" class="form-control" name="pin" placeholder="Enter Pin">
            <button type="submit" class="save-btn">Enter</button>
        </div>
    </form>
  </div>
</div>

<script>
    function openPinModal() {
        document.getElementById('pinModal').style.display = 'flex';
    }
    document.addEventListener('DOMContentLoaded', function () {
        openPinModal();
    })
</script>