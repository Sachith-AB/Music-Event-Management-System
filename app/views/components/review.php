<div class="review-section">
    <h2>Leave Your Review</h2>

    <!-- Star Rating -->
    <div class="star-rating">
        <span class="star" data-value="1">&#9733;</span>
        <span class="star" data-value="2">&#9733;</span>
        <span class="star" data-value="3">&#9733;</span>
        <span class="star" data-value="4">&#9733;</span>
        <span class="star" data-value="5">&#9733;</span>
    </div>

    <!-- Comment Box -->
    <textarea id="review-comment" placeholder="Write your comments here..."></textarea>

    <!-- Submit Button -->
    <button id="submit-review">Submit Review</button>

    <!-- Display Reviews -->
    <div class="reviews-display">
        <h3>Recent Reviews</h3>
        <ul id="reviews-list"></ul>
    </div>
</div>

<style>
    /* Review Section */
    .review-section {
        max-width: 600px;
        margin: 2rem auto;
        padding: 1.5rem;
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        font-family: Arial, sans-serif;
        background-color: #f9f9f9;
    }

    /* Section Header */
    .review-section h2, .review-section h3 {
        text-align: center;
        color: #333;
    }

    /* Star Rating */
    .star-rating {
        text-align: center;
        margin: 1rem 0;
    }

    .star {
        font-size: 2rem;
        color: #ccc;
        cursor: pointer;
        transition: color 0.3s;
    }

    .star:hover,
    .star.active {
        color: #f39c12;
    }

    /* Comment Box */
    textarea#review-comment {
        width: 100%;
        height: 100px;
        padding: 0.5rem;
        margin: 1rem 0;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 1rem;
        resize: none;
    }

    /* Submit Button */
    button#submit-review {
        display: block;
        width: 100%;
        padding: 0.75rem;
        background-color: #00BDD6FF;
        color: #fff;
        border: none;
        border-radius: 4px;
        font-size: 1rem;
        cursor: pointer;
        transition: color 1s ease;
    }

    button#submit-review:hover {
        color: black;
    }

    /* Reviews List */
    .reviews-display ul {
        list-style: none;
        padding: 0;
    }

    .reviews-display li {
        margin-bottom: 1rem;
        padding: 0.5rem;
        border-bottom: 1px solid #ddd;
    }

    .reviews-display li p {
        margin: 0.5rem 0 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', () => {
    const stars = document.querySelectorAll('.star');
    const reviewsList = document.getElementById('reviews-list');
    const submitButton = document.getElementById('submit-review');
    const commentBox = document.getElementById('review-comment');
    let selectedRating = 0;

    // Handle star click
    stars.forEach(star => {
        star.addEventListener('click', () => {
            selectedRating = star.getAttribute('data-value');
            updateStarColors(selectedRating);
        });
    });

    // Update star colors
    function updateStarColors(rating) {
        stars.forEach(star => {
            if (star.getAttribute('data-value') <= rating) {
                star.classList.add('active');
            } else {
                star.classList.remove('active');
            }
        });
    }

        // Handle submit
        submitButton.addEventListener('click', () => {
            const comment = commentBox.value.trim();

            if (selectedRating === 0) {
                alert('Please select a star rating!');
                return;
            }

            if (!comment) {
                alert('Please add a comment!');
                return;
            }

            // Add review to the list
            const reviewItem = document.createElement('li');
            reviewItem.innerHTML = `
                <strong>Rating: ${'★'.repeat(selectedRating)}${'☆'.repeat(5 - selectedRating)}</strong>
                <p>${comment}</p>
            `;
            reviewsList.appendChild(reviewItem);

            // Reset form
            selectedRating = 0;
            updateStarColors(0);
            commentBox.value = '';
        });
    });

</script>