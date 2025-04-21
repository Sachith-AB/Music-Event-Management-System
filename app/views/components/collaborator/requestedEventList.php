<div class="event-list">
    <h2>My Events</h2>
    <ul id="eventList">
        <?php foreach ($events as $event): ?>
            <li class="event-card">
                <div class="event-img">
                    <img src="uploads/<?php echo htmlspecialchars($event->cover_images); ?>" alt="<?php echo htmlspecialchars($event->event_name); ?>">
                </div>
                <div class="event-details">
                    <h3><?php echo htmlspecialchars($event->event_name); ?></h3>
                    <div class="event-meta">
                        <span class="meta-item">
                            <i class="fa-regular fa-calendar"></i>
                            <?php echo htmlspecialchars($event->eventDate); ?>
                        </span>
                        <span class="meta-item">
                            <i class="fa-solid fa-layer-group"></i>
                            <?php echo htmlspecialchars($event->type); ?>
                        </span>
                        <span class="meta-item">
                            <i class="fa-solid fa-location-dot"></i>
                            <?php echo htmlspecialchars($event->event_place); ?>
                        </span>
                    </div>
                    <p>
                        <strong>Status:</strong>
                        <span class="badge <?php echo htmlspecialchars($event->status); ?>">
                            <?php echo ucfirst(htmlspecialchars($event->status)); ?>
                        </span>
                    </p>
                    <p>
                        <strong>Address:</strong>
                        <span class="address"><?php echo htmlspecialchars($event->address); ?></span>
                    </p>
                    <p class="description"><?php echo htmlspecialchars($event->description); ?></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>

<!-- Font Awesome CDN for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style>
.event-list {
    padding: 32px 18px;
    background: linear-gradient(135deg, #f9fafc 60%, #e3eefe 100%);
    border-radius: 16px;
    box-shadow: 0 8px 32px rgba(44, 62, 80, 0.08);
    max-width: 780px;
    margin: 30px auto;
}

.event-list h2 {
    margin-bottom: 24px;
    font-size: 2rem;
    color: #263159;
    letter-spacing: 1px;
    text-align: center;
    font-weight: 700;
}

#eventList {
    list-style: none;
    padding: 0;
}

.event-card {
    display: flex;
    gap: 24px;
    padding: 22px 18px;
    margin-bottom: 20px;
    border: none;
    border-radius: 14px;
    background: #fff;
    box-shadow: 0 4px 16px rgba(44, 62, 80, 0.07);
    transition: transform 0.18s, box-shadow 0.18s;
    align-items: flex-start;
}

.event-card:hover {
    transform: translateY(-6px) scale(1.015);
    box-shadow: 0 12px 32px rgba(44, 62, 80, 0.13);
}

.event-img img {
    width: 140px;
    height: 100px;
    object-fit: cover;
    border-radius: 10px;
    border: 2px solid #e3eefe;
    box-shadow: 0 2px 8px rgba(44, 62, 80, 0.04);
    background: #f4f8fb;
}

.event-details {
    flex: 1;
}

.event-details h3 {
    margin: 0 0 10px;
    font-size: 1.3rem;
    color: #1b2c4a;
    font-weight: 600;
}

.event-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 18px;
    margin-bottom: 8px;
}

.meta-item {
    font-size: 0.98rem;
    color: #4b5c6b;
    display: flex;
    align-items: center;
    gap: 6px;
    background: #f1f6fa;
    padding: 4px 10px;
    border-radius: 6px;
}

.event-details p {
    margin: 4px 0;
    color: #4b5c6b;
    font-size: 1rem;
}

.event-details .description {
    margin-top: 12px;
    font-size: 0.96rem;
    color: #6c7a89;
    line-height: 1.5;
}

.address {
    color: #3b5998;
    font-weight: 500;
}

.badge {
    padding: 4px 12px;
    border-radius: 7px;
    font-size: 0.92rem;
    font-weight: 600;
    color: #fff;
    margin-left: 6px;
    letter-spacing: 0.5px;
    box-shadow: 0 2px 6px rgba(44, 62, 80, 0.07);
}

.badge.processing { background: linear-gradient(90deg, #ff9800 70%, #ffb347 100%); }
.badge.completed { background: linear-gradient(90deg, #27ae60 70%, #52d681 100%); }
.badge.scheduled { background: linear-gradient(90deg, #2980ef 70%, #6ec6ff 100%); }

/* Responsive Design */
@media (max-width: 650px) {
    .event-card {
        flex-direction: column;
        align-items: stretch;
        gap: 16px;
        padding: 15px 8px;
    }
    .event-img img {
        width: 100%;
        height: 140px;
    }
    .event-list {
        padding: 10px 2px;
    }
}
</style>
