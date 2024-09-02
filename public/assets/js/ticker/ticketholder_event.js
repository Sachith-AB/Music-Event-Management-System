document.addEventListener('DOMContentLoaded', () => {
    // Carousel functionality
    const cardContainer = document.querySelector('.card-container');
    const leftArrow = document.querySelector('.left-arrow');
    const rightArrow = document.querySelector('.right-arrow');

    const scrollStep = 300; // Adjust this based on the card width
    let scrollAmount = 0;

    if (leftArrow && rightArrow && cardContainer) {
        leftArrow.addEventListener('click', () => {
            if (scrollAmount > 0) {
                scrollAmount -= scrollStep;
                cardContainer.scrollBy({
                    left: -scrollStep,
                    behavior: 'smooth'
                });
            }
        });

        rightArrow.addEventListener('click', () => {
            if (scrollAmount < cardContainer.scrollWidth - cardContainer.clientWidth) {
                scrollAmount += scrollStep;
                cardContainer.scrollBy({
                    left: scrollStep,
                    behavior: 'smooth'
                });
            }
        });
    }

    // Band image functionality
    const bandImages = [
        `<?= ROOT ?>/assets/images/ticket/band1.jpg`,
        `<?= ROOT ?>/assets/images/ticket/band2.jpg`,
        `<?= ROOT ?>/assets/images/ticket/band3.jpeg`
    ];

    const bandImageElement = document.querySelector('.band-image img');
    let currentIndex = 0;

    function changeBandImage() {
        currentIndex = (currentIndex + 1) % bandImages.length;

        // First, hide the image with a smooth transition
        bandImageElement.style.transition = 'opacity 1s ease';
        bandImageElement.style.opacity = '0';

        setTimeout(() => {
            // Change the image source when the image is hidden
            bandImageElement.src = bandImages[currentIndex];
            console.log(bandImages[currentIndex])

            // Wait for the image to load before making it visible again
            bandImageElement.onload = () => {
                bandImageElement.style.transition = 'opacity 1s ease';
                bandImageElement.style.opacity = '1';
            };
        }, 1000); // Duration must match the transition duration
    }

    // Change the image every 15 seconds
    setInterval(changeBandImage, 15000);
});
