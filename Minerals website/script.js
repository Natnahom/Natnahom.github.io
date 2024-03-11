const textElement = document.getElementById("typingText");
const text = "Unearth the Beauty: Discover Nature's Hidden Gems";

let index = 0;
function typeText() {
  textElement.textContent = text.slice(0, index);
  index++;
  if (index > text.length) {
    index = 0;
  }
  setTimeout(typeText, 100);
}

typeText();

// For image slider
// const images = document.querySelectorAll('.slider img');
// let currentIndex = 0;

// function showImage(index) {
//   images.forEach((image, i) => {
//     if (i === index) {
//       image.classList.add('active');
//     } else {
//       image.classList.remove('active');
//     }
//   });
// }

// function changeImage() {
//   currentIndex = (currentIndex + 1) % images.length;
//   showImage(currentIndex);
// }

// window.addEventListener('load', () => {
//   showImage(currentIndex);
//   setInterval(changeImage, 5000);
// });