document.addEventListener('DOMContentLoaded', () => {
    console.log('DOM fully loaded and parsed');
  

    const prevBtn = document.querySelector('.prev');
    const nextBtn = document.querySelector('.next');
    const cardContainer = document.querySelector('.card-container');

    if (!prevBtn || !nextBtn || !cardContainer) {
        console.error('One or more elements are not found');
        return;
    }
    let scrollAmount = 0;
    const cardWidth = 220; // Adjust according to your card width + margin

    nextBtn.addEventListener('click', () => {
        console.error('One or more elements are not found');
        scrollAmount += cardWidth;
        cardContainer.scrollTo({
            left: scrollAmount,
            behavior: 'smooth'
        });
    });

    prevBtn.addEventListener('click', () => {
        scrollAmount -= cardWidth;
        cardContainer.scrollTo({
            left: scrollAmount,
            behavior: 'smooth'
        });
    });
});
