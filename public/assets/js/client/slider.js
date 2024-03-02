// Get the DOM elements for the image carousel
const wrapper = document.querySelector(".wrapper"),
  carousel = document.querySelector(".carousel"),
  images = document.querySelectorAll(".img-slide"),
  buttons = document.querySelectorAll(".button");

let imageIndex = 1,
  intervalId;

  const slideImage = () => {
    // Filter out non-existing images
    const existingImages = Array.from(images).filter((img) => img.complete);
  
    if (existingImages.length === 0) return;
  
    // Ensure that imageIndex is within the bounds of existing images
    imageIndex = (imageIndex + existingImages.length) % existingImages.length;
  
    // Set the transform property to show the current image
    carousel.style.transform = `translate(-${imageIndex * 80}%)`;
  };
  
  const updateClick = (e) => {
    clearInterval(intervalId);
    const existingImages = Array.from(images).filter((img) => img.complete);
  
    if (existingImages.length === 0) return;
  
    imageIndex += e.target.id === "next" ? 1 : -1;
    slideImage(imageIndex);
   
  };


buttons.forEach((button) => button.addEventListener("click", updateClick));

