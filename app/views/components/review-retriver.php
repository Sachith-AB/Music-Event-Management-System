<div class="review-container">
    <div class="review-header">
        <h2>Event Reviews</h2>
        <div class="star-rating">
            <span class="star" data-value="1">★</span>
            <span class="star" data-value="2">★</span>
            <span class="star" data-value="3">★</span>
            <span class="star" data-value="4">★</span>
            <span class="star" data-value="5">★</span>
            <span class="rating-text">3.6/5 (15 reviews)</span>
        </div>
    </div>

    <div class="review-list">
        <div class="review-item">
            <p class="comment">Amazing event! The vibes were perfect and the sound system was top-notch!</p>
            <div class="user-rating">
                <span>★★★★☆</span> — <strong>by Alex</strong>
            </div>
        </div>

        <div class="review-item">
            <p class="comment">Loved the decorations and the singer's performance. Great experience!</p>
            <div class="user-rating">
                <span>★★★★★</span> — <strong>by Sam</strong>
            </div>
        </div>

        <div class="review-item">
            <p class="comment">Nice event but the waiting time was too long.</p>
            <div class="user-rating">
                <span>★★★☆☆</span> — <strong>by Chris</strong>
            </div>
        </div>
    </div>
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

.star-rating .star {
    font-size: 24px;
    color: #ccc;
}

.star-rating .star.active {
    color: gold;
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

</style>

<script>
    // Example average rating
    let average = 3.6;
    let stars = document.querySelectorAll('.star-rating .star');

    stars.forEach((star, index) => {
        if (index < Math.round(average)) {
            star.classList.add('active');
        }
    });
</script>
