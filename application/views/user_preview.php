<?php include('includes/header.php') ?>
<!-- Shiv Web Developer  -->
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <div class="card p-4" style="max-width:1000px; width: 90%;">
        <div class=" g-0 mt-4 align-items-stretch">
            <div class="col-6">
                <div class="p-3 h-100">
                    <div class="position-relative ms-auto mb-2">
                        <img src="<?= base_url('uploads/user_profile/' . $getProfile['user_image'] ?? 'assets/images/img/user.png') ?>"
                            alt="User" id="profile-picture"
                            class="rounded-circle border " style="width: 70px; height: 70px; object-fit: cover; cursor: pointer;">
                        <input type="file" id="uploadImage" style="display: none;" accept="image/*">
                    </div> <span class="profileviewcont"> Views: <?= $getProfile['views']; ?> </span>
                    <div class="d-flex align-items-center mb-2">
                        <dd class="mb-0"><?= $getProfile['name'] ?></dd>
                    </div>
                    <div class="d-flex align-items-center mb-2">

                        <dd class="mb-0"><?= $getProfile['phone'] ?></dd>
                    </div>

                    <div class="d-flex justify-content-start align-items-center mb-2">

                        <dd class="mb-0"><?= $getProfile['email'] ?></dd>
                    </div>

                    <div class="d-flex align-items-center mb-2">

                        <dd class="mb-0"><?= $getProfile['dob'] ?></dd>
                    </div>


                    <div class="d-flex align-items-start mb-2">

                        <dd class="mb-0">
                            <?= $address ?? '' ?>
                    </div>
                    <div><strong></strong> <?= $getProfile['city'] ?></div>
                    <div><strong></strong> <?= getStateName($getProfile['state']) ?></div>
                    <div><strong></strong> <?= getCountryName($getProfile['country']) ?></div>
                    <div><strong></strong> <?= $getProfile['zipcode'] ?></div>
                    </dd>
                    <div class="mb-3 mt-3">

                        <!-- Boxes Row -->
                        <div class="d-flex gap-2 flex-wrap align-items-center" id="numberBoxContainer">
                            <?php for ($i = 1; $i <= 7; $i++): ?>
                                <div class="number-box d-flex justify-content-center align-items-center fw-bold text-center"
                                    style="width: 50px; height: 50px; border: 1px solid #ced4da; border-radius: 4px; cursor: pointer;"
                                    data-box="<?= $i ?>">
                                    <?= $i ?>
                                </div>
                            <?php endfor; ?>

                        </div>
                        <div id="dynamicContent" class="d-flex flex-column  gap-2 mt-3" style="max-width: 400px;  display: none;">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include('includes/footer.php') ?>
<?php include('includes/footer-link.php') ?>


<?php

$groupedBlocks = [];

foreach ($ageBlocks as $block) {
    $key = $block['gap_type'] . '_' . $block['age_range']; // Unique grouping key
    $groupedBlocks[$key] = [
        'block' => $block,
        'documents' => [],
        'images' => [],
        'videos' => []
    ];
}

// Attach documents
foreach ($documents as $doc) {
    $key = $doc['gap_type'] . '_' . $doc['age_range'];
    if (isset($groupedBlocks[$key])) {
        $groupedBlocks[$key]['documents'][] = $doc;
    }
}

// Attach images
foreach ($images as $img) {
    $key = $img['gap_type'] . '_' . $img['age_range'];
    if (isset($groupedBlocks[$key])) {
        $groupedBlocks[$key]['images'][] = $img;
    }
}

// Attach videos
foreach ($videos as $vid) {
    $key = $vid['gap_type'] . '_' . $vid['age_range'];
    if (isset($groupedBlocks[$key])) {
        $groupedBlocks[$key]['videos'][] = $vid;
    }
}



?>


<!-- Shiv Web Developer  -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const boxes = document.querySelectorAll('.number-box');
        const dynamicContent = document.getElementById('dynamicContent');

        boxes.forEach(box => {
            box.addEventListener('click', function() {
                const boxNumber = this.getAttribute('data-box');
                this.style.display = 'none';
                dynamicContent.style.display = 'flex';
                dynamicContent.innerHTML = '';

                switch (boxNumber) {
                    case '1':
                        dynamicContent.innerHTML = `
                        <p><?= $getProfile['summary'] ?></p> 
                        
                    `;
                        break;
                    case '2':
                        dynamicContent.innerHTML = `
        <div class="w-100 small">
  <p class="mb-1"><?= $getProfile['education'] ?></p>
  <p class="mb-1"><?= $getProfile['skills'] ?></p>
  <p class="mb-1"><?= $getProfile['experience'] ?></p>
</div> `;
                        break;
                    case '3':
                        dynamicContent.innerHTML = `<div class="container-fluid">   
                        
                        <div style="font-weight:700"> Gap: 10-Year Blocks </div>
                        <?php if (!empty($groupedBlocks)) : ?>
                            <?php foreach ($groupedBlocks as $item): ?>
                                <?php $block = $item['block']; ?>
                                <?php if ($block['gap_type'] == '10_year') : ?>
                                <div class="row g-0 border p-3 mb-3">
                                    <div class="col-md-6"><strong><?= $block['year_range']; ?></strong></div>
                                    <div class="col-md-6 mb-2"><?= nl2br(htmlspecialchars($block['description'])); ?></div>

                                
                                    <!-- Images -->
                                    <?php if (!empty($item['images'])) : ?>
                                        <?php foreach ($item['images'] as $img): ?>
                                            <div class="col-md-6">
                                                <img src="<?= base_url('uploads/age_block_images/' . $img['image_url']); ?>" width="97%" height="100px" />
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <!-- Videos -->
                                    <?php if (!empty($item['videos'])) : ?>
                                        <?php foreach ($item['videos'] as $vid): ?>
                                            <div class="col-md-6">
                                                <video width="100%" controls height="100px" class="mt-1">
                                                    <source src="<?= base_url('uploads/age_block_videos/' . $vid['video_url']); ?>" type="video/mp4">
                                                </video>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                     <!-- Documents -->
                                    <?php if (!empty($item['documents'])) : ?>
                                        <?php foreach ($item['documents'] as $doc): ?>
                                            <div class="col-md-12 text-center">
                                                <a href="<?= base_url('uploads/age_block_documents/' . $doc['document_url']); ?>" target="_blank">📄 View Document</a>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-muted">No blocks found.</div>
                        <?php endif; ?>

				</div>`;
                        break;
                    case '4':
                        dynamicContent.innerHTML = `
                         
                        <div style="font-weight:700"> Gap: 5-Year Blocks </div>
                        <?php if (!empty($groupedBlocks)) : ?>
                            <?php foreach ($groupedBlocks as $item): ?>
                                <?php $block = $item['block']; ?>
                                <?php if ($block['gap_type'] == '5_year') : ?>
                                <div class="row g-0 border p-3 mb-3">
                                    <div class="col-md-6"><strong><?= $block['year_range']; ?></strong></div>
                                    <div class="col-md-6 mb-2"><?= nl2br(htmlspecialchars($block['description'])); ?></div>

                                
                                    <!-- Images -->
                                    <?php if (!empty($item['images'])) : ?>
                                        <?php foreach ($item['images'] as $img): ?>
                                            <div class="col-md-6">
                                                <img src="<?= base_url('uploads/age_block_images/' . $img['image_url']); ?>" width="97%" height="100px" />
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <!-- Videos -->
                                    <?php if (!empty($item['videos'])) : ?>
                                        <?php foreach ($item['videos'] as $vid): ?>
                                            <div class="col-md-6">
                                                <video width="100%" controls height="100px" class="mt-1">
                                                    <source src="<?= base_url('uploads/age_block_videos/' . $vid['video_url']); ?>" type="video/mp4">
                                                </video>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                     <!-- Documents -->
                                    <?php if (!empty($item['documents'])) : ?>
                                        <?php foreach ($item['documents'] as $doc): ?>
                                            <div class="col-md-12 text-center">
                                                <a href="<?= base_url('uploads/age_block_documents/' . $doc['document_url']); ?>" target="_blank">📄 View Document</a>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-muted">No blocks found.</div>
                        <?php endif; ?>
                       
                    `;
                        break;
                    case '5':
                        dynamicContent.innerHTML = `
                       
                        <div style="font-weight:700"> Gap: 3-Year Blocks </div>
                        <?php if (!empty($groupedBlocks)) : ?>
                            <?php foreach ($groupedBlocks as $item): ?>
                                <?php $block = $item['block']; ?>
                                <?php if ($block['gap_type'] == '3_year') : ?>
                                <div class="row g-0 border p-3 mb-3">
                                    <div class="col-md-6"><strong><?= $block['year_range']; ?></strong></div>
                                    <div class="col-md-6 mb-2"><?= nl2br(htmlspecialchars($block['description'])); ?></div>

                                    <!-- Images -->
                                    <?php if (!empty($item['images'])) : ?>
                                        <?php foreach ($item['images'] as $img): ?>
                                            <div class="col-md-6">
                                                <img src="<?= base_url('uploads/age_block_images/' . $img['image_url']); ?>" width="97%" height="100px" />
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <!-- Videos -->
                                    <?php if (!empty($item['videos'])) : ?>
                                        <?php foreach ($item['videos'] as $vid): ?>
                                            <div class="col-md-6">
                                                <video width="100%" controls height="100px" class="mt-1">
                                                    <source src="<?= base_url('uploads/age_block_videos/' . $vid['video_url']); ?>" type="video/mp4">
                                                </video>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                     <!-- Documents -->
                                    <?php if (!empty($item['documents'])) : ?>
                                        <?php foreach ($item['documents'] as $doc): ?>
                                            <div class="col-md-12 text-center">
                                                <a href="<?= base_url('uploads/age_block_documents/' . $doc['document_url']); ?>" target="_blank">📄 View Document</a>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-muted">No blocks found.</div>
                        <?php endif; ?>


                    `;
                        break;
                    case '6':
                        dynamicContent.innerHTML = `
                       <div style="font-weight:700"> Gap: 2-Year Blocks </div>
                        <?php if (!empty($groupedBlocks)) : ?>
                            <?php foreach ($groupedBlocks as $item): ?>
                                <?php $block = $item['block']; ?>
                                <?php if ($block['gap_type'] == '2_year') : ?>
                                <div class="row g-0 border p-3 mb-3">
                                    <div class="col-md-6"><strong><?= $block['year_range']; ?></strong></div>
                                    <div class="col-md-6 mb-2"><?= nl2br(htmlspecialchars($block['description'])); ?></div>

                                    <!-- Images -->
                                    <?php if (!empty($item['images'])) : ?>
                                        <?php foreach ($item['images'] as $img): ?>
                                            <div class="col-md-6">
                                                <img src="<?= base_url('uploads/age_block_images/' . $img['image_url']); ?>" width="97%" height="100px" />
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <!-- Videos -->
                                    <?php if (!empty($item['videos'])) : ?>
                                        <?php foreach ($item['videos'] as $vid): ?>
                                            <div class="col-md-6">
                                                <video width="100%" controls height="100px" class="mt-1">
                                                    <source src="<?= base_url('uploads/age_block_videos/' . $vid['video_url']); ?>" type="video/mp4">
                                                </video>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                     <!-- Documents -->
                                    <?php if (!empty($item['documents'])) : ?>
                                        <?php foreach ($item['documents'] as $doc): ?>
                                            <div class="col-md-12 text-center">
                                                <a href="<?= base_url('uploads/age_block_documents/' . $doc['document_url']); ?>" target="_blank">📄 View Document</a>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-muted">No blocks found.</div>
                        <?php endif; ?>
                    `;
                        break;
                    case '7':
                        dynamicContent.innerHTML = `
                        <div style="font-weight:700"> Gap: 1-Year Blocks </div>
                        <?php if (!empty($groupedBlocks)) : ?>
                            <?php foreach ($groupedBlocks as $item): ?>
                                <?php $block = $item['block']; ?>
                                <?php if ($block['gap_type'] == '1_year') : ?>
                                <div class="row g-0 border p-3 mb-3">
                                    <div class="col-md-6"><strong><?= $block['year_range']; ?></strong></div>
                                    <div class="col-md-6 mb-2"><?= nl2br(htmlspecialchars($block['description'])); ?></div>

                                    <!-- Images -->
                                    <?php if (!empty($item['images'])) : ?>
                                        <?php foreach ($item['images'] as $img): ?>
                                            <div class="col-md-6">
                                                <img src="<?= base_url('uploads/age_block_images/' . $img['image_url']); ?>" width="97%" height="100px" />
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                    <!-- Videos -->
                                    <?php if (!empty($item['videos'])) : ?>
                                        <?php foreach ($item['videos'] as $vid): ?>
                                            <div class="col-md-6">
                                                <video width="100%" controls height="100px" class="mt-1">
                                                    <source src="<?= base_url('uploads/age_block_videos/' . $vid['video_url']); ?>" type="video/mp4">
                                                </video>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                     <!-- Documents -->
                                    <?php if (!empty($item['documents'])) : ?>
                                        <?php foreach ($item['documents'] as $doc): ?>
                                            <div class="col-md-12 text-center">
                                                <a href="<?= base_url('uploads/age_block_documents/' . $doc['document_url']); ?>" target="_blank">📄 View Document</a>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>

                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <div class="text-muted">No blocks found.</div>
                        <?php endif; ?>
                        
                        `;
                        break;
                    default:
                        dynamicContent.innerHTML = '';
                }
            });
        });
    });
</script>



<!-- Shiv Web Developer  -->