const track = document.querySelector('.carousel-track');
const cards = document.querySelectorAll('.carousel-card');
let multiSlideIndex = 0; 
const cardsPerMove = 1; 


function moveCarousel(direction) {
    if (!track || cards.length === 0) return; 
   
    multiSlideIndex += direction * cardsPerMove;

  
    const maxIndex = cards.length - 4; 

  
    if (multiSlideIndex < 0) {
        multiSlideIndex = 0; 
    } else if (multiSlideIndex > maxIndex) {
        multiSlideIndex = maxIndex; 
    }

   
    const cardWidth = cards[0].offsetWidth + (parseFloat(getComputedStyle(cards[0]).marginLeft) * 2);

    const translateValue = -multiSlideIndex * cardWidth;

  
    track.style.transform = `translateX(${translateValue}px)`;
}


moveCarousel(0);