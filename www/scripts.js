let slideIndex = 0;
showSlides();

function showSlides() {
  let i;
  let slides = document.getElementsByClassName("slide");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}
  slides[slideIndex-1].style.display = "block";
  setTimeout(showSlides, 4000); // Change image every 2 seconds
}

//const defaultLinksDisplay = document.querySelector('.hideOnMobile').style.display;
document.addEventListener('DOMContentLoaded', () => {
  const button = document.querySelector('.main-nav-bar button');    const navBar = document.querySelector('.main-nav-bar');
  const links = document.querySelectorAll('.mobileMenu');
      button.addEventListener('click', () => {
        
        const websiteName = document.querySelector('.first-nav-element');

        if (websiteName.style.display === '')
          websiteName.style.display = 'none';
        else
          websiteName.style.display = ''

        navBar.classList.toggle('full-screen-menu');
          for (const link of links)
        link.style.display = (link.style.display == 'block') ? 'none' : 'block';
    });
});