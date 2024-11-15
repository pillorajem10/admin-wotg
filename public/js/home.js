document.addEventListener('DOMContentLoaded', function () {
    // Once the content is loaded, hide the loading overlay
    const loadingOverlay = document.getElementById('loading-overlay');
    
    // Ensure the overlay stays visible for a minimum of 1 second for better UX
    setTimeout(function () {
        loadingOverlay.style.visibility = 'hidden';  // Make it invisible after the fade-out
        loadingOverlay.style.opacity = 0;  // Fade it out
    }, 1000);  // Increased delay to make sure it's visible for at least 1 second

    const images = [
        '/images/bible-reading.jpg',  
        '/images/prayer1.jpg',
        '/images/prayer.jpg',
        '/images/prayer2.jpg',
        '/images/prayer3.jpg',          
    ];

    const getRandomImage = () => images[Math.floor(Math.random() * images.length)];

    // Set the random background image for the header-container
    const headerContainer = document.querySelector('.header-container');
    if (headerContainer) {
        headerContainer.style.backgroundImage = `url('${getRandomImage()}')`;
    }
});
