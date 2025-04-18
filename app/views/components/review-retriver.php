<?php 
    if (!empty($data['ratings'])) {
        $averageRating = number_format($data['ratings'][0]['averageRating'], 1);
        $totalReviews = number_format($data['ratings'][0]['totalReviews'], 1);
        $percentage = ($averageRating / 5) * 100;
    } else {
        $averageRating = 0;
        $totalReviews = 0;
        $percentage = 0;
    }
?>


<div class="review-container">
    <div class="review-header">
        <h2>Event Reviews</h2>
        <div class="star-rating">
            <div class="star-background">
                <div class="star-filled" style="width: <?= $percentage ?>%;"></div>
            </div>
            <span class="rating-text"><?= number_format($averageRating, 1) ?>/5 (<?= $totalReviews ?> reviews)</span>
        </div>
    </div>

    <div class="review-list">
        <?php if (!empty($data['ratings'])): ?>
            <?php $counter = 0; ?>
            <?php foreach ($data['ratings'] as $rating): ?>
                <?php if ($counter >= 3) break; ?>
                <div class="review-item">
                    <p class="comment"><?= $rating['rating']->comment ?></p>
                    <div class="user-rating">
                        <span class="stars">
                            <span class="filled"><?= str_repeat('★', $rating['rating']->rating) ?></span>
                            <span class="unfilled"><?= str_repeat('★', 5 - $rating['rating']->rating) ?></span>
                        </span>
                        — <strong><?= $rating['user']->name ?></strong>
                    </div>
                    <div class="review-time">
                        <?= date("F j, Y, g:i a", strtotime($rating['rating']->created_at)) ?>
                    </div>
                </div>
                <?php $counter++; ?>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No reviews yet. Be the first to review!</p>
        <?php endif; ?>
    </div>
</div>
<div>
    
</div>
<style>
.review-container {
    max-width: 600px;
    margin: 30px auto;
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    padding: 20px;
}

.review-header h2 {
    margin: 0;
    font-size: 22px;
    color: #333;
}

.star-rating {
    display: flex;
    align-items: center;
    gap: 5px;
    margin-top: 8px;
}

.star-background {
    position: relative;
    display: inline-block;
    font-size: 22px;
    color: #ccc;
}

.star-background::before {
    content: "★★★★★";
    letter-spacing: 3px;
}

.star-filled {
    position: absolute;
    top: 0;
    left: 0;
    white-space: nowrap;
    overflow: hidden;
    color: gold;
}

.star-filled::before {
    content: "★★★★★";
    letter-spacing: 3px;
}

.stars {
    font-size: 1rem;
}

.stars .filled {
    color: gold;
}

.stars .unfilled {
    color: #ccc;
}

.rating-text {
    margin-left: 10px;
    font-size: 14px;
    color: #555;
}

.review-list {
    margin-top: 20px;
}

.review-item {
    border-top: 1px solid #eee;
    padding: 15px 0;
}

.review-item:first-child {
    border-top: none;
}

.comment {
    font-size: 15px;
    color: #444;
}

.user-rating {
    font-size: 14px;
    color: #777;
}

.review-time {
    font-size: 12px;
    color: #999;
    margin-top: 4px;
}
</style>
