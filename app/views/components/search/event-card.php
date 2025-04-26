<div class="event-card" onclick="window.location.href='view-event?id=<?= $event->id ?>'">
    <?php
        $coverImages = json_decode($event->cover_images, true);
        $firstImage = $coverImages[0] ?? ''; // fallback if empty
    ?>
    <img src="<?= ROOT ?>/assets/images/events/<?php echo $firstImage ?>" alt="Event Image">
    <div class="event-info">
        <h3><?php echo $event->event_name ?></h3>
        <p class="date">📅 <?php echo $event->eventDate ?> | <?php echo $event->start_time ?></p>
        <p class="location">📍 <?php echo $event->address ?></p>
        <?php if($event->pricing == 'paid'):?>
            <span class="pricing paid"><?php echo "PAID" ?></span> 
        <?php else:?>
            <span class="pricing free"><?php  echo "FREE" ?></span>
        <?php endif?>

        <?php if($event->type == 'indoor'):?>
            <span class="pricing indoor"><?php echo "INDOOR" ?></span> 
        <?php else:?>
            <span class="pricing outdoor"><?php echo "OUTDOOR" ?></span>
        <?php endif?>
        <div class="star-rating">
            <?php
                $fullStars = floor($event->averageRating);
                $halfStar = ($event->averageRating - $fullStars) >= 0.5;
                $emptyStars = 5 - $fullStars - ($halfStar ? 1 : 0);

                for ($i = 0; $i < $fullStars; $i++) {
                    echo '<span class="star full">&#9733;</span>'; // ★
                }
                if ($halfStar) {
                    echo '<span class="star half">&#9733;</span>'; // Will style as half
                }
                for ($i = 0; $i < $emptyStars; $i++) {
                    echo '<span class="star empty">&#9733;</span>'; // ★ (faded)
                }
            ?>
            <span class="rating-text">
                <?= number_format($event->averageRating, 1) ?>/5 (<?= $event->totalReviews ?> reviews)
            </span>
        </div>
    </div>
    
</div>

<style>
    .event-card {
    background-color: #fff;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    cursor: pointer;
    height: 300px;
}

.event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
}

.event-card img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    transition: transform 0.3s ease;
}


.event-info {
    padding: 20px;
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
    transition: all 0.3s ease;
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

.pricing:hover {
    color: blue
}

.pricing:hover::before {
    left: 100%;
}

.paid {
    background-color: #00BDD6;
}

.free {
    background-color: #00BDD6;
}

.outdoor {
    background-color: #00BDD6;
}

.indoor {
    background-color: #00BDD6;
}
</style>