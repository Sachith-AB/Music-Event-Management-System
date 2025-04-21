<div class="next-event-card">
    <div class="next-event-image-wrapper">
        <img src="<?=ROOT?>/assets/images/landing/top1.png" alt="Event Name">
        <div class="next-event-badge">24H EVENT</div>
    </div>
    <div class="next-event-info">
        <h3 class="next-event-title">Overnight Music Festival</h3>
        <div class="next-event-details">
            <div class="next-event-date-time next-event-multi-day">
                <span>Fri, May 30 - 8:00 PM</span>
                <span>Sat, May 31 - 6:00 AM</span>
            </div>
            <p class="next-event-venue">Central Park Main Stage</p>
        </div>
        <div class="next-event-pricing">
            <p class="next-event-price">From LKR 5000</p>
        </div>
    </div>
</div>

<style>
.next-event-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    backdrop-filter: blur(12px);
    box-shadow: 0 8px 32px rgba(0,0,0,0.2);
    overflow: hidden;
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    position: relative;
    width: 100%;
}

.next-event-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 16px 40px rgba(0,0,0,0.3);
}

.next-event-image-wrapper {
    position: relative;
}

.next-event-image-wrapper img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-bottom: 2px solid #00bdd6;
}

.next-event-badge {
    position: absolute;
    top: 16px;
    right: 16px;
    background: linear-gradient(45deg, #00bdd6, #00d68f);
    color: #fff;
    padding: 6px 12px;
    border-radius: 50px;
    font-size: 11px;
    font-weight: bold;
    letter-spacing: 1px;
}

.next-event-info {
    padding: 20px;
}

.next-event-title {
    margin: 0 0 12px 0;
    font-size: 20px;
    font-weight: 700;
    color: #222;
}

.next-event-details {
    display: grid;
    gap: 10px;
    margin-bottom: 16px;
}

.next-event-date-time {
    display: flex;
    flex-direction: column;
    gap: 4px;
    color: #555;
    font-size: 14px;
}

.next-event-date-time span {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(0, 189, 214, 0.1);
    padding: 5px 10px;
    border-radius: 6px;
}

.next-event-date-time span::before {
    content: "🎵";
}

.next-event-venue {
    color: #333;
    font-weight: 500;
}

.next-event-pricing {
    border-top: 1px solid rgba(0,0,0,0.05);
    padding-top: 12px;
}

.next-event-price {
    color: #00bdd6;
    font-weight: 700;
    font-size: 1.2rem;
}

/* Mobile tweaks */
@media (max-width: 768px) {
    .next-event-card {
        margin-bottom: 24px;
    }

    .next-event-date-time span {
        justify-content: center;
    }

    .next-event-title {
        font-size: 18px;
    }
}
</style>
