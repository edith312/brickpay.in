<style>
    .border-bottom{
        border-bottom: 1px solid black !important;
    }

    .pol-line{
        height: 100vh;
        width: 1px;
        background: black;
        top: 0px;
        right: 0px;
    }

    .police-container{
        top: 150px;
    }
</style>
<div class="page-body pt-1 px-2">
    <div class="row text-center">
        <div class="col-4 m-0 py-5 border-bottom position-relative">
            <span class="pol-line position-absolute"></span>
            Political Party
        </div>
        <div class="col-4 m-0 py-5 border-bottom position-relative">
            <span class="pol-line position-absolute"></span>
            Police
                <div class="position-absolute police-container">
                    <button class="btn btn-primary">Cases</button>
                    <button class="btn btn-primary mt-3">Constitution</button>
                    <button class="btn btn-primary mt-3">Investigation</button>
                    <button class="btn btn-primary mt-3">Introgation</button>
                    <button class="btn btn-primary mt-3">Chargesheet</button>
                </div>
        </div>
        <div class="col-4 m-0 py-5 border-bottom">
            Court
        </div>
    </div>
</div>