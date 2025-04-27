<div class="recent-events-row">
<?php
foreach ($recentEvents as $event):
    $startDate = date('D, M d', strtotime($event->start_time));
    $startTime = date('g:i A', strtotime($event->start_time));
    $endDate = date('D, M d', strtotime($event->end_time));
    $endTime = date('g:i A', strtotime($event->end_time));
    $coverImages = json_decode($event->cover_images, true);
    $firstImage = $coverImages[0] ?? ''; // fallback if empty
    // $imgSrc = !empty($event->cover_images) && $event->cover_images !== 'default-image.jpg'
    //     ? ROOT . '/assets/images/events/' . $event->cover_images
    //     : ROOT . '/assets/images/landing/top1.png';
        $imgSrc = ROOT . '/assets/images/events/' . $firstImage;
        $priceText = $event->ticketPrice;
?>
    <div class="next-event-card" onclick="location.href='<?= ROOT ?>/view-event?id=<?= $event->id ?>'">
        <div class="next-event-image-wrapper">
            <img src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= htmlspecialchars($event->event_name) ?>">
            <?php if (strtotime($event->end_time) - strtotime($event->start_time) >= 60*60*12): ?>
                <div class="next-event-badge">24H EVENT</div>
            <?php endif; ?>
        </div>
        <div class="next-event-info">
            <h3 class="next-event-title"><?= htmlspecialchars($event->event_name) ?></h3>
            <div class="next-event-details">
                <div class="next-event-date-time next-event-multi-day">
                    <span><?= $startDate . ' - ' . $startTime ?></span>
                    <span><?= $endDate . ' - ' . $endTime ?></span>
                </div>
                <p class="next-event-venue"><?= htmlspecialchars($event->address) ?></p>
            </div>
            <div class="next-event-pricing">
                <p class="next-event-price">LKR <?= $priceText ?></p>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>

<style>
.recent-events-row {
    display: flex;
    justify-content: flex-start;
    flex-wrap: nowrap;
    gap: 24px;
    width: 90%;
    margin: 0 auto;
    overflow-x: auto;
    padding-bottom: 10px;
}

.next-event-card {
    flex: 0 0 300px;
    max-width: 300px;
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.08);
    overflow: hidden;
    display: flex;
    flex-direction: column;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    cursor: pointer;
}

.next-event-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.15);
}

.next-event-image-wrapper {
    position: relative;
}

.next-event-image-wrapper img {
    width: 100%;
    height: 180px;
    object-fit: cover;
    border-bottom: 1px solid #eee;
}

.next-event-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    background: #ff4757;
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
}

.next-event-info {
    padding: 15px;
}

.next-event-title {
    margin: 0 0 8px;
    font-size: 18px;
    color: #00BDD6FF;
}

.next-event-details {
    margin-bottom: 10px;
}

.next-event-date-time span {
    display: block;
    font-size: 14px;
    color: #555;
}

.next-event-venue {
    font-size: 14px;
    color: #777;
}

.next-event-pricing .next-event-price {
    font-size: 16px;
    font-weight: bold;
    color: #00BDD6FF;
    margin-top: 20px;
}
</style>
