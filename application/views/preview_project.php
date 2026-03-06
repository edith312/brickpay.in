<style>
    .label-project-preview {
        font-size: 14px;
        color: #070808;
        font-weight: 600;
        margin-right: 0;
    }

    .card div {
        font-size: 16px;
    }
</style>
<?php include('includes/header.php') ?>
<!-- Shiv Web Developer  -->
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <div class="card p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Project Details</h4>
            <a href="#" class="btn btn-primary">
                <i class="bi bi-download me-1"></i> Download Now
            </a>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <span class="label-project-preview">Project Name:</span>
                <span class="value">Real Estate Investment & Development</span>
            </div>
            <div class="col-md-4">
                <span class="label-project-preview">Project Leader:</span>
                <span class="value">Iqra Khan</span>
            </div>
            <div class="col-md-4">
                <span class="label-project-preview">Total Expected Team:</span>
                <span class="value">15 Members</span>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <span class="label-project-preview">Total Number of Layers:</span>
                <span class="value">4</span>
            </div>
            <div class="col-md-4">
                <span class="label-project-preview">Project Valuation:</span>
                <span class="value">₹75 Crores</span>
            </div>
            <div class="col-md-4">
                <span class="label-project-preview">Issued Shares:</span>
                <span class="value">1,000,000</span>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <span class="label-project-preview">Face Value:</span>
                <span class="value">₹10 per share</span>
            </div>
            <div class="col-md-4">
                <span class="label-project-preview">Project Document / Policies:</span>
                <span class="value"><a href="#">Download PDF</a></span>
            </div>
            <div class="col-md-4">
                <span class="label-project-preview">Upload Your Pitch Deck:</span>
                <span class="value"><a href="#">RealEstate_PitchDeck.pdf</a></span>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <span class="label-project-preview">TAM:</span>
                <span class="value">₹5,00,000 Crores</span>
            </div>
            <div class="col-md-4">
                <span class="label-project-preview">SAM:</span>
                <span class="value">₹1,00,000 Crores</span>
            </div>
            <div class="col-md-4">
                <span class="label-project-preview">SOM:</span>
                <span class="value">₹15,000 Crores</span>
            </div>
        </div>

        <div class="mb-3">
            <strong>Elevator Pitch:</strong>
            <div>Our real estate project aims to redefine urban living by developing premium residential and commercial spaces across India. With a strong focus on sustainability, smart infrastructure, and customer-centric design, we cater to both investors and end users looking for long-term value and security in their real estate investments.</div>
        </div>

        <div class="mb-3">
            <strong>Mission:</strong>
            <div>To deliver high-quality, sustainable, and smart real estate developments that enrich lives and contribute to the future of urban living.</div>
        </div>

        <div class="mb-3">
            <strong>Vision:</strong>
            <div>To become India's most trusted and innovative real estate brand, transforming skylines and lifestyles across the country through excellence and transparency.</div>
        </div>
    </div>
</div>
<!-- Shiv Web Developer  -->

<?php include('includes/footer.php') ?>
<?php include('includes/footer-link.php') ?>
<script>
    document.getElementById('appealYes').addEventListener('change', function() {
        document.getElementById('appealContent').classList.remove('d-none');
    });

    document.getElementById('appealNo').addEventListener('change', function() {
        document.getElementById('appealContent').classList.add('d-none');
    });

    document.getElementById('docThumb').addEventListener('click', function() {
        var modal = new bootstrap.Modal(document.getElementById('docModal'));
        modal.show();
    });
</script>