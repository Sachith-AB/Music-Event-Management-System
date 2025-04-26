<div class="event-card" onclick="window.location.href='view-event?id=<?= $event->id ?>'">
    <?php
        $coverImages = json_decode($event->cover_images, true);
        $firstImage = $coverImages[0] ?? '1.jpg';
    ?>
    <div class="event-image-wrapper">
        <img src="<?= ROOT ?>/assets/images/events/<?= $firstImage ?>" alt="Event Image">
    </div>
    <div class="event-info">
        <h3><?= htmlspecialchars($event->event_name) ?></h3>
        <p class="date">📅 <?= $event->eventDate ?> | <?= $event->start_time ?></p>
        <p class="location">📍 <?= htmlspecialchars($event->address) ?></p>

        <div class="event-pricing">
            <?php if($event->pricing == 'paid'):?>
                <span class="pricing paid">PAID</span> 
            <?php else:?>
                <span class="pricing free">FREE</span>
            <?php endif?>

            <?php if($event->type == 'indoor'):?>
                <span class="pricing indoor">INDOOR</span> 
            <?php else:?>
                <span class="pricing outdoor">OUTDOOR</span>
            <?php endif?>
        </div>

        <div class="star-rating">
            <?php
                $fullStars = floor($event->averageRating);
                $halfStar = ($event->averageRating - $fullStars) >= 0.5;
                $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

                for ($i = 0; $i < $fullStars; $i++) {
                    echo '<span class="star full">&#9733;</span>';
                }
                if ($halfStar) {
                    echo '<span class="star half">&#9733;</span>';
                }
                for ($i = 0; $i < $emptyStars; $i++) {
                    echo '<span class="star empty">&#9733;</span>';
                }
            ?>
            <span class="rating-text"><?= number_format($event->averageRating, 1) ?>/5 (<?= $event->totalReviews ?> reviews)</span>
        </div>
    </div>
</div>

<style>
.event-card {
    display: flex;
    background-color: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    cursor: pointer;
    height: 200px;
    width: 90%; 
    margin: 20px auto;
}

.event-pricing {
    display: flex;
}

.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

.event-image-wrapper {
    flex: 0 0 35%;
    max-width: 35%;
    height: 100%;
}

.event-image-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.event-info {
    flex: 1;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.event-info h3 {
    color: #2c3e50;
    margin-bottom: 10px;
    font-size: 1.2rem;
}

.date, .location {
    color: #666;
    margin-bottom: 8px;
    font-size: 0.9rem;
}

.pricing {
    display: inline-block;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    margin-right: 8px;
    margin-top: 10px;
    color: white;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    position: relative;
    overflow: hidden;

}

.pricing::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: all 0.5s ease;
}

.pricing:hover::before {
    left: 100%;
}


.star-rating {
    margin-top: 10px;
    font-size: 0.85rem;
    color: #f1c40f;
}

.star.full,
.star.half,
.star.empty {
    color: #f1c40f;
    font-size: 1rem;
}

.star.empty {
    opacity: 0.3;
}

.rating-text {
    color: #555;
    margin-left: 8px;
}
</style>