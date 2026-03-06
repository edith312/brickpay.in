<?php $this->load->view('includes/header'); ?>

<?php
if ($this->session->has_userdata('taskMsg')) {
    echo $this->session->userdata('taskMsg');
    $this->session->unset_userdata('taskMsg');
}
?>

<style>
    .table {
        position: absolute;
        top: 350px !important;
        left: 57% !important;
        transform: translateX(-50%);
        width: 80% !important;
        height: auto !important;
        background: #ffff;
        border-radius: 10px;
    }
    .switch {
        position: relative;
        display: inline-block;
        width: 43px;
        height: 100%;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 34px;
        height: 17px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 10px;
        width: 10px;
        border-radius: 50%;
        left: 4px;
        bottom: 3px;
        background-color: white;
        transition: 0.4s;
    }

    input:checked+.slider {
        background-color: #007bff;
    }

    input:checked+.slider:before {
        transform: translateX(26px);
    }
</style>

<!-- Shiv Web Developer  -->
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body pt-0 mt-5" style="height:2000px;">
    <!-- <div>
        <h4 class="mb-md-5 mb-3 text-center"> Welcome to Market Tracing! </h4>
    </div> -->
    <div class="py-3" style="background-color: #f0f4f7;">
        <h4 class="mb-md-5 mb-3 text-center "> S9 - Market Research & Tracing </h4>
        <!-- Section Enabled Disable -->
        <div id="questionBox1" class="p-md-5 mx-3 pt-md-3 pb-md-3 dotted-bottom ps-md-3" style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
            <div class="d-flex align-items-center">
                <label class="me-2">S<sub>9</sub> - <span style="font-size:12px; color:red;">*</span> Market Research & Tracing </label>
                <label class="switch me-2">
                    <input type="checkbox" class="enableSwitch" data-index="1" name="show_form_1" checked>
                    <span class="slider round"></span>
                </label>
                <span class="enableDisableLabel" data-index="1">Yes</span> <br />
            </div>
        </div>
        <style>
            select:disabled {
                background-color: #e9ecef;
                /* light gray blur */
                color: #6c757d;
            }
        </style>
    </div>
    <form action="" method="POST" class="flex flex-col gap-4">
        <div class="container max-width-1470 w-100 bg-white d-flex gap-3 mt-md-3">
            <div class="w-100">
                <!-- <p>
                    Market Tracing - <br>
                    1. Potential Customers ? <br>
                    Docs, Excel<br>
                    2. Quantity ? <br>
                    3. Price we want to sale ? <br>
                    4. Followups ? Converted? <br>
                    5. Invested on Project. <br>
                    6. Total Revanue. <br>
                </p> -->

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th> Potential Customers (Company/Humans)</th>
                            <th> Quantitiy</th>
                            <th> Price We Want to Sale</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Docs Link" name="dosc">
                                </div>
                                <div class="form-group mt-1">
                                    <input type="text" class="form-control" placeholder="Excel Link" name="excel">
                                </div>
                            </td>
                            <td>
                                <!-- <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Quantity" name="quantity">
                                </div> -->
                            </td>
                            <td>
                                <!-- <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Price" name="pricewewant">
                                </div> -->
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered" style="margin-top:260px;">
                    <thead>
                        <tr>
                            <th> Followups</th>
                            <th>Converted </th>
                            <th> Total Revenue </th>
                            <th> Invoicing </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Docs Link" name="dosc">
                                </div>
                                <div class="form-group mt-1">
                                    <input type="text" class="form-control" placeholder="Excel Link" name="excel">
                                </div>
                            </td>
                            <td>
                                <!-- <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Quantity" name="quantity">
                                </div> -->
                            </td>
                            <td>
                                <!-- <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Price" name="pricewewant">
                                </div> -->
                            </td>
                            <td>
                                <!-- <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Price" name="pricewewant">
                                </div> -->
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered" style="margin-top:500px;">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Problem Statement</th>
                            <th>Solutions </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> 50 Characters </td>
                            <td>
                                <div class="form-group">
                                    <textarea type="text" class="form-control" placeholder="Description" name="textarea"></textarea>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <textarea type="text" class="form-control" placeholder="Description" name="textarea"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> 100 Words </td>
                            <td>
                                <div class="form-group">
                                    <textarea type="text" class="form-control" placeholder="Description" name="textarea"></textarea>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <textarea type="text" class="form-control" placeholder="Description" name="textarea"></textarea>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td> 500 Words </td>
                            <td>
                                <div class="form-group">
                                    <textarea type="text" class="form-control" placeholder="Description" name="textarea"></textarea>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <textarea type="text" class="form-control" placeholder="Description" name="textarea"></textarea>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table class="table table-bordered" style="margin-top:900px;">
                    <thead>
                        <tr>
                            <th> Competitor Analysis </th>
                            <th> </th>

                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Docs Link" name="dosc">
                                </div>
                                <div class="form-group mt-1">
                                    <input type="text" class="form-control" placeholder="Excel Link" name="excel">
                                </div>
                            </td>
                            <td>
                                <!-- <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Quantity" name="quantity">
                                </div> -->
                            </td>
                        </tr>
                    </tbody>
                </table>


            </div>
        </div>
    </form>
</div>

<!-- Shiv Web Developer  -->
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>