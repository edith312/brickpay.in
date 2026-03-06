<style>
    .element-card {
        max-width: 500px;
        background: #fff;
        margin: 50px auto;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 3px 10px rgba(0, 0, 0, .15);
    }

    h2 {
        text-align: center;
    }

    .row {
        margin: 8px 0;
    }

    .label {
        font-weight: bold;
    }

    .back {
        display: block;
        margin-top: 15px;
        text-align: center;
    }

    h3 {
        margin-top: 20px;
        color: #333;
    }

    .row {
        margin-bottom: 10px;
        background: #f8f9fa;
        padding: 8px;
        border-radius: 5px;
    }

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
   }

   .modal-close {
     position: absolute;
     top: 10px;
     right: 15px;
     font-size: 22px;
     cursor: pointer;
   }

   .custom-table {
     width: 100%;
     border-collapse: collapse;
     margin-top: 10px;
   }

   .custom-table th,
   .custom-table td {
     padding: 10px;
     border: 1px solid #ddd;
   }

   .table-input {
     width: 100%;
     padding: 6px 8px;
     border-radius: 4px;
     border: 1px solid #ccc;
     font-size: 0.95rem;
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
   .cursor-pointer {
        cursor: pointer;
    }
</style>
<div class="page-body pt-1 px-2">

    <?php $this->load->view('admin/map/header') ?>

    <?php
        $element_id = $element[0]['id'];
        $depth = [
            ['title'=>'School<br>(1)','url'=>'admin/school'],
            ['title'=>'Science<br>(1.1)','url'=>'admin/school/science'],
            ['title'=>'Chemistry<br>(1.1.2)','url'=>'admin/school/science/chemistry'],
            ['title'=> $element[0]['name'] . "<br>(1.1.2.$element_id)",'url'=>''],
        ];
        pageDepth_new($depth);
    ?>

    <?php if($this->session->flashdata('success')): ?>
        <div class="alert alert-success">
            <?= $this->session->flashdata('success')?>
        </div>
    <?php endif; ?>
    <?php if($this->session->flashdata('error')): ?>
        <div class="alert alert-danger">
            <?= $this->session->flashdata('error')?>
        </div>
    <?php endif; ?>

    <div class="element-card">
        <h2>
            <?=$element[0]['name']?> (
            <?=$element[0]['symbol']?>)
        </h2>

        <div class="row"><span class="label">Atomic Number:</span>
            <?=$element[0]['atomic_number']?>
        </div>
        <div class="row"><span class="label">Atomic Weight:</span>
            <?=$element[0]['atomic_weight']?>
        </div>
        <div class="row"><span class="label">Group:</span>
            <?=$element[0]['group_no']?>
        </div>
        <div class="row"><span class="label">Period:</span>
            <?=$element[0]['period_no']?>
        </div>
        <div class="row"><span class="label">Category:</span>
            <?=$element[0]['category']?>
        </div>
        <div class="row"><span class="label">State:</span>
            <?=$element[0]['state']?>
        </div>
        <div class="row"><span class="label">Discovered By:</span>
            <?=$element[0]['discovered_by']?>
        </div>

        <p>
            <?=$element[0]['description']?>
        </p>

        <div class="d-flex justify-content-between align-items-center">
            <h3>SWOT Analysis</h3>
            <span id="editElementBtn" title="Edit Details" class="text-center text-primary cursor-pointer">
                <i class="bi bi-pencil"></i>
            </span>
        </div>
        <div class="row">
            <strong>Strength:</strong><br>
            <?=$element[0]['strength'];?>
        </div>

        <div class="row">
            <strong>Weakness:</strong><br>
            <?=$element[0]['weakness'];?>
        </div>

        <div class="row">
            <strong>Opportunity:</strong><br>
            <?=$element[0]['opportunity'];?>
        </div>

        <div class="row">
            <strong>Threat:</strong><br>
            <?=$element[0]['threat'];?>
        </div>
        <hr>
        <div class="row mt-4">
            <strong>Mining:</strong><br>
            <?=$element[0]['mining'];?>
        </div>

        <div class="row">
            <strong>Extraction:</strong><br>
            <?=$element[0]['extraction'];?>
        </div>

        <div class="row">
            <strong>Sythenization:</strong><br>
            <?=$element[0]['sythenization'];?>
        </div>

        <div class="row">
            <strong>Processing:</strong><br>
            <?=$element[0]['processing'];?>
        </div>

        <div class="row">
            <strong>Education:</strong><br>
            <?=$element[0]['education'];?>
        </div>

        <div class="row">
            <strong>Industry:</strong><br>
            <?=$element[0]['industry'];?>
        </div>



        <!-- <a class="back" href="index.php">⬅ Back to Periodic Table</a> -->
    </div>
</div>

<!-- Element Edit Modal -->
 <div class="modal-overlay" id="elementEditModal" style="width:100%">
  <div class="modal-box">
    <span class="modal-close" onclick="closeElementModal()">&times;</span>
    <h5>Edit Element SWOT Details</h5>
    <form action="<?= base_url("adminHome/element_edit/$element_id") ?>" method="POST">
        <div class="mb-3">
            <label for="Strength" class="form-label">Strength</label>
            <textarea id="Strength" type="" class="form-control" name="strength"><?=$element[0]['strength']?></textarea>
        </div>
        <div class="mb-3">
            <label for="Weakness" class="form-label">Weakness</label>
            <textarea id="Weakness" type="textarea" class="form-control" name="weakness"><?=$element[0]['weakness']?></textarea>
        </div>
        <div class="mb-3">
            <label for="Opportunity" class="form-label">Opportunity</label>
            <textarea id="Opportunity" type="textarea" class="form-control" name="opportunity"><?=$element[0]['opportunity']?></textarea>
        </div>
        <div class="mb-4">
            <label for="Threat" class="form-label">Threat</label>
            <textarea id="Threat" type="textarea" class="form-control" name="threat"><?=$element[0]['threat']?></textarea>
        </div>
        <hr>
        <div class="mb-3">
            <label for="Mining" class="form-label">Mining</label>
            <textarea id="Mining" type="textarea" class="form-control" name="mining"><?=$element[0]['mining']?></textarea>
        </div>
        <div class="mb-3">
            <label for="Extraction" class="form-label">Extraction</label>
            <textarea id="Extraction" type="textarea" class="form-control" name="extraction"><?=$element[0]['extraction']?></textarea>
        </div>
        <div class="mb-3">
            <label for="Sythenization" class="form-label">Sythenization</label>
            <textarea id="Sythenization" type="textarea" class="form-control" name="sythenization"><?=$element[0]['sythenization']?></textarea>
        </div>
        <div class="mb-3">
            <label for="Processing" class="form-label">Processing</label>
            <textarea id="Processing" type="textarea" class="form-control" name="processing"><?=$element[0]['processing']?></textarea>
        </div>
        <div class="mb-3">
            <label for="Education" class="form-label">Education</label>
            <textarea id="Education" type="textarea" class="form-control" name="education"><?=$element[0]['education']?></textarea>
        </div>
        <div class="mb-3">
            <label for="Industry" class="form-label">Industry</label>
            <textarea id="Industry" type="textarea" class="form-control" name="industry"><?=$element[0]['industry']?></textarea>
        </div>
        <div class="mb-3">
            <button type="submit" class="save-btn">Save</button>
        </div>
    </form>
  </div>
</div>


<script>
    function openElementEditModal() {
     document.getElementById('elementEditModal').style.display = 'flex';
   }

   function closeElementModal() {
     document.getElementById('elementEditModal').style.display = 'none';
   }
   document.getElementById('editElementBtn').addEventListener('click', function(e) {
     e.preventDefault();
     openElementEditModal();
   });
   window.addEventListener('click', function(e) {
     const modal = document.getElementById('elementEditModal');
     if (e.target === modal) {
       closeElementModal();
     }
   });
</script>