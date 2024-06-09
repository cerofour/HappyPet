function showSidebar(){
    const sidebar = document.querySelector('.sidebar');
    sidebar.style.display = 'flex';
}

function hideSidebar(){
    const sidebar = document.querySelector('.sidebar');
    sidebar.style.display = 'none';
}

class Carousel{

    constructor(){
        this.currentSlide = 0;
        this.slides = document.querySelectorAll('.carousel-item');
        this.totalSlides = this.slides.length;
        this.nextSlide = this.nextSlide.bind(this);
    }

    nextSlide(){
        this.slides[this.currentSlide].classList.remove('active');
        if(this.currentSlide === this.totalSlides-1) this.currentSlide = 0;
        else this.currentSlide++;
        this.slides[this.currentSlide].classList.add('active');
        document.querySelector('.carousel-inner')
            .style.transform = `translateX(-${this.currentSlide * 100}%)`;
    }


}

const carousel = new Carousel();

setInterval(carousel.nextSlide, 3000);
