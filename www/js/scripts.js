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
        this.changeSlide = this.changeSlide.bind(this);
        this.slideNextButton = this.slideNextButton.bind(this);
        this.slidePrevButton = this.slidePrevButton.bind(this);
    }

    changeSlide(position){
        this.slides[this.currentSlide].classList.remove('active');
        this.currentSlide += position;

        if(this.currentSlide === this.totalSlides) this.currentSlide = 0;
        else if (this.currentSlide < 0) this.currentSlide = this.totalSlides-1;

        this.slides[this.currentSlide].classList.add('active');
        document.querySelector('.carousel-inner')
            .style.transform = `translateX(-${(this.currentSlide)*100}%)`;
    }

    slideNextButton(){
        this.changeSlide(1);
    }

    slidePrevButton(){
        this.changeSlide(-1);
    }


}

const carousel = new Carousel();

document.getElementById("prev").addEventListener("click", function(){
    carousel.slidePrevButton()
})

document.getElementById("next").addEventListener("click", function(){
    carousel.slideNextButton()
})


setInterval(carousel.slideNextButton, 5000);
