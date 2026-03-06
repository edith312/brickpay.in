<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <article class="press-release-article">
        <div class="article-container">
            <!-- Article Header -->
            <header class="article-header">
                <h1 class="article-title">Press Release</h1>
                <time class="article-date"><?= $press_release_details['storytime'] ?></time>
            </header>
            <div class="d-flex">
                <?php if(!empty($company)) :?>
                    <h4>Company: <?= $company['company_name']?></h4>
                <?php endif; ?>
                <?php if(!empty($project)) :?>
                    <h4>Project: <?= $project['project_name']?></h4>
                <?php endif; ?>
            </div>

            <!-- Article Body -->
            <div class="article-body">
                <p><?= $press_release_details['press_release'] ?></p>
                <?= $press_release_details['editordata'] ?>
            </div>

            <!-- Author Section -->
            <div class="author-section">
                <div class="author-avatar">
                    <?php if (!empty($author['user_image'])): ?>
                        <img height="50" width="50" src="<?= base_url("uploads/user_profile/$author[user_image]") ?>" 
                             alt="<?= htmlspecialchars($author['name']) ?>">
                    <?php else: ?>
                        <div class="avatar-placeholder">
                            <?= strtoupper(substr($author['name'], 0, 1)) ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="author-info">
                    <div class="author-meta">
                        <h4 class="author-name"><?= htmlspecialchars($author['name']) ?></h4>
                        <span class="author-badge">ID: <?= $author['humontoken'] ?></span>
                        <?php if (!empty($author['education'])): ?>
                            <span class="author-detail-item">
                                <i class="fas fa-graduation-cap"></i>
                                <?= htmlspecialchars($author['education']) ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <!-- <?php if (!empty($author['summary'])): ?>
                        <p class="author-bio"><?= htmlspecialchars($author['summary']) ?></p>
                    <?php endif; ?> -->
                    <div class="author-details">
                        <p class=""><?= htmlspecialchars($author['phone']) ?></p>
                        <p class=""><?= htmlspecialchars($author['email']) ?></p>
                        <?php if (!empty($author['experience'])): ?>
                            <span class="author-detail-item">
                                <i class="fas fa-briefcase"></i>
                                <?= htmlspecialchars($author['experience']) ?>
                            </span>
                        <?php endif; ?>
                    </div>
                    <!-- <?php if (!empty($author['skills'])): ?>
                        <div class="author-skills">
                            <?php 
                            $skills = explode(',', $author['skills']);
                            foreach($skills as $skill): 
                            ?>
                                <span class="skill-tag"><?= trim(htmlspecialchars($skill)) ?></span>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?> -->
                </div>
            </div>
        </div>
    </article>
</div>

<style>
.press-release-article {
    max-width: 900px;
    margin: 0 auto;
    padding: 2rem 0;
}

.article-container {
    background: #ffffff;
    border-radius: 8px;
    padding: 3rem 2.5rem;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

/* Header Styles */
.article-header {
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #e5e7eb;
}

.article-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #111827;
    margin-bottom: 0.75rem;
    line-height: 1.2;
}

.article-date {
    display: block;
    font-size: 0.95rem;
    color: #6b7280;
    font-weight: 500;
}

/* Author Section */
.author-section {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 2.5rem;
    padding: 1rem;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-radius: 12px;
    border: 1px solid #dee2e6;
}

.author-avatar {
    flex-shrink: 0;
}

.author-avatar img {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    object-fit: cover;
    border: 3px solid #ffffff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.avatar-placeholder {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: 700;
    border: 3px solid #ffffff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.author-info {
    flex: 1;
    min-width: 0;
}

.author-meta {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 0.75rem;
    flex-wrap: wrap;
}

.author-name {
    font-size: 1.25rem;
    font-weight: 600;
    color: #111827;
    margin: 0;
}

.author-badge {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    background: #3b82f6;
    color: #ffffff;
    font-size: 0.75rem;
    font-weight: 600;
    border-radius: 12px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.author-bio {
    font-size: 0.95rem;
    color: #4b5563;
    line-height: 1.6;
    margin-bottom: 1rem;
}

.author-details {
    display: flex;
    flex-direction: column;
    margin-bottom: 1rem;
    flex-wrap: wrap;
}

.author-details p{
    margin-top: 0px;
    margin-bottom: 10px;
}

.author-detail-item {
    display: inline-flex;
    align-items: center;
    font-size: 0.875rem;
    color: #6b7280;
}

.author-detail-item i {
    color: #3b82f6;
    font-size: 0.9rem;
}

.author-skills {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
}

.skill-tag {
    display: inline-block;
    padding: 0.35rem 0.75rem;
    background: #ffffff;
    color: #374151;
    font-size: 0.8rem;
    font-weight: 500;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    transition: all 0.2s ease;
}

.skill-tag:hover {
    background: #3b82f6;
    color: #ffffff;
    border-color: #3b82f6;
}

/* Lead/Short Description */
.article-lead {
    margin-bottom: 2.5rem;
    padding: 1.5rem;
    background: #f9fafb;
    border-left: 4px solid #3b82f6;
    border-radius: 4px;
}

.lead-text {
    font-size: 1.25rem;
    line-height: 1.7;
    color: #374151;
    margin: 0;
    font-weight: 500;
}

/* Article Body */
.article-body {
    font-size: 1.05rem;
    line-height: 1.8;
    color: #1f2937;
}

.article-body p {
    margin-bottom: 1.5rem;
}

.article-body h2,
.article-body h3,
.article-body h4 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    font-weight: 600;
    color: #111827;
}

.article-body h2 {
    font-size: 1.875rem;
}

.article-body h3 {
    font-size: 1.5rem;
}

.article-body h4 {
    font-size: 1.25rem;
}

.article-body ul,
.article-body ol {
    margin-bottom: 1.5rem;
    padding-left: 2rem;
}

.article-body li {
    margin-bottom: 0.5rem;
}

.article-body img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin: 2rem 0;
}

.article-body blockquote {
    border-left: 4px solid #e5e7eb;
    padding-left: 1.5rem;
    margin: 2rem 0;
    font-style: italic;
    color: #4b5563;
}

/* Responsive Design */
@media (max-width: 768px) {
    .article-container {
        padding: 2rem 1.5rem;
    }

    .article-title {
        font-size: 2rem;
    }

    .author-section {
        flex-direction: column;
        gap: 1rem;
    }

    .author-avatar img,
    .avatar-placeholder {
        width: 64px;
        height: 64px;
    }

    .avatar-placeholder {
        font-size: 1.5rem;
    }

    .author-name {
        font-size: 1.1rem;
    }

    .author-details {
        flex-direction: column;
        gap: 0.5rem;
    }

    .lead-text {
        font-size: 1.1rem;
    }

    .article-body {
        font-size: 1rem;
    }
}

@media (max-width: 576px) {
    .press-release-article {
        padding: 1rem 0;
    }

    .article-container {
        padding: 1.5rem 1rem;
        border-radius: 0;
    }

    .article-title {
        font-size: 1.75rem;
    }

    .author-section {
        padding: 0.5rem;
    }

    .lead-text {
        font-size: 1rem;
    }

    .author-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
}
</style>