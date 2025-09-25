( ( w, d ) => {

  function domContentLoaded () {
    const swiperElement = d.querySelector( '.swiper' );
    if ( !swiperElement ) {
      throw new Error( 'Swiper element not found' );
    }

    const swiper = new Swiper( swiperElement, {
      observer: true,
      observeParents: true,
      //cssMode: true,
      speed: 1000,
      spaceBetween: 100,
      direction: 'horizontal',
      slidesPerView: 1,
      centeredSlides: true,

      effect: 'cards',
      cardsEffect: {
        perSlideOffset: 8,
        perSlideRotate: 2,
        rotate: true,
        slideShadows: true,
      },


      autoplay: {
        enabled: true,
        delay: 2500,
        disableOnInteraction: false,
        pauseOnMouseEnter: false,
        stopOnLastSlide: false,
      },

      pagination: {
        el: '.swiper-pagination',
        type: 'bullets',
        clickable: true,
        dynamicBullets: false,
      },

      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },

      allowTouchMove: true,
      allowSlideNext: true,
      allowSlidePrev: true,
    } );

  }

  w.addEventListener( 'DOMContentLoaded', domContentLoaded );

} )(
  window,
  document,
);