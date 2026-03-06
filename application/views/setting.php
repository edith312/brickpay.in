<?php $this->load->view('includes/header'); ?>
<!-- Shiv Web Developer  -->
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body pt-0">
    <div>
        <h4 class="mb-md-5 mb-3 text-center">Settings</h4>
    </div>
    <form method="POST" class="flex flex-col gap-4">
        <div class="container max-width-1470 w-100 bg-white d-flex gap-3 mt-md-3">
            <div class="w-100">
                <div class="row mt-md-0 mb-md-0  pb-md-0 align-items-start">
                    <div class="col-md-4 mb-3 mt-md-0">
                        <label for="project_component" class="form-label d-flex align-items-center gap-2">
                            Choose Nomenclature?
                            <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Select how you'd like to label this section: Brick, Task, or Milestone."></i>
                        </label>
                        <select class="form-select p-md-2" name="project_component" id="project_component" required>
                            <option value="">-- Select --</option>
                            <option value="brick">Brick</option>
                            <option value="task">Task</option>
                            <option value="milestone">Milestone</option>
                            <option value="strategie">Strategie</option>
                            <option value="scene">Scene</option>
                            <option value="updates">Updates</option>
                            <option value="events">Events</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label class="form-label">Define total numbers of:</label>
                        <select class="form-select form-select-sm" name="department_nomenclature">
                            <option value="">-- Select --</option>
                            <option value="department" selected>Department</option>
                            <option value="cluster">Cluster</option>
                            <option value="group">Group</option>
                            <option value="layer">Layer</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3 position-relative textarea-upload-container">
                        <label>Feedback Note to System
                            <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Describe your task in detail."></i>
                        </label>
                        <textarea id="feedbackSystem" class="form-control pe-5" name="feedback_system" rows="5" placeholder="Feedback here"><?= isset($task['feedback_system']) ? htmlspecialchars($task['feedback_system']) : set_value('feedback_system'); ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>

<!-- Shiv Web Developer  -->
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>