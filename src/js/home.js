import { getMargins } from "./utils"; 
import { showPainture } from "./painture_details";
import { createRecuest } from "./async/httpRequest";
import { alertDialog } from "./message_box";
import { createSliders } from "./sliders";

const home = document.querySelector('.home');
const cart = document.querySelector('.cart');
const showcase = document.querySelector('.mini-showcase');
const miniPic = document.querySelector('.mini-pic');
const cartOpen = document.querySelector('.open-cart');
const cartClose = document.querySelector('.close-cart');
const dividers = [...document.querySelectorAll('.divider')];
const details = [...document.querySelectorAll('.details')];
const dividerText = document.querySelector('.divider-text');
const footerFlex = [...document.querySelectorAll('.flex')];
const floatingRight = document.querySelector('.floating-right');

const cartContent = document.querySelectorAll('.cart-content');
const toPay = document.querySelector('#to-pay');

export function loadAnimations() {
  gsap.to('.paintures-title', {
      scrollTrigger: {
        trigger: '.paintures-title',
        start: 'top center'
      },
      opacity: 1,
      translateY: '0%',
      ease: 'none',
      duration: 0.5
  });
    
  paintures.forEach(painture => {
      gsap.to(painture, { 
          scrollTrigger: {
              trigger: painture,
              start: 'top bottom'
          },
          opacity: 1,
          translateY: '0%',
          ease: 'none',
          duration: 0.8
      });
  });
    
  gsap.to(dividers, { 
      scrollTrigger: {
      trigger: '.info-container',
      start: 'top bottom'
      },
      clipPath: 'polygon(0 0, 100% 0, 100% 100%, 0% 100%)',
      duration: 1,
      delay: 0.5
  });
    
  gsap.to(details, { 
      scrollTrigger: {
        trigger: '.info-container',
        start: 'top 50px'
      },
      opacity: 1,
      duration: 1
  });

  gsap.to(footerFlex, { 
    scrollTrigger: {
      trigger: '.footer',
      start: 'center bottom'
    },
    opacity: 1,
    duration: 1
  });

  document.body.style.overflowY = 'scroll';
}

const [slider1, slider2] = createSliders();
let startAnimation = gsap.timeline({ 
  onComplete: function() {
    slider1.remove();
    slider2.remove();
    loadAnimations();
  } 
});
startAnimation.fromTo(slider2, { translateY: '0%' }, { translateY: '-100%', duration: 0.6 });
startAnimation.fromTo(slider1, { translateY: '100%' }, { translateY: '-100%', duration: 1 }, '-=0.6');
startAnimation.fromTo(home, { translateY: '100%' }, { translateY: '0%', duration: 1.5 }, '-=1.5');
startAnimation.fromTo('.hamburger-button', { opacity: 0 }, { opacity: 1, duration: 0.5 }, '-=0.1');
startAnimation.fromTo(floatingRight, { opacity: 0 }, { opacity: 1, duration: 0.5 }, '-=0.3');
startAnimation.fromTo('.scroll-ic', { opacity: 0 }, { opacity: 1, duration: 0.5 }, '-=0.3');
startAnimation.fromTo(cart, { translateY: '100px' }, { translateY: "0px", duration: 0.5 }, '-=0.3');

let icScrollAnimation = gsap.timeline({ repeat: -1 });
icScrollAnimation.to('.scroll-ball', { translateY: '200%', duration: 0.5, delay: 0.2 });
icScrollAnimation.to('.scroll-ball', { translateY: '0%', duration: 0.1, delay: 0.5 });

let rect = dividerText.getBoundingClientRect();
let bannerAnimation = gsap.timeline({ repeat: -1 });
bannerAnimation.fromTo(dividerText, { translateX: '0%' }, { translateX: -(rect.width - window.innerWidth) + 'px', duration: 5, ease: 'none' });

const marginTimLine = gsap.timeline({ paused: true, ease: 'none' });
marginTimLine.to(getMargins(cart), { clipPath: 'polygon(0 0, 100% 0, 100% 100%, 0% 100%)', duration: 0.5 });


cartOpen.addEventListener('click', () => {
  function callback(request) {
    showcase.innerHTML = request.responseText;

    const timeLine = gsap.timeline({ ease: 'none' });
    timeLine.to(cartOpen, { opacity: 0, duration: 0.3 });
    timeLine.to(miniPic, { opacity: 0, duration: 0.3, onComplete: function() { miniPic.style.backgroundImage = 'none' } }, '-=0.3');
    timeLine.to(cart, { left: '0px', borderRadius: '0px', duration: 0.3 });
    timeLine.to(cart, { top: '0px', duration: 0.9, onComplete: function() { marginTimLine.play() } }, '-=0.3');
    timeLine.to(showcase, { opacity: 1, duration: 0.5 }, '-=0.5');

    let paintures = [...showcase.getElementsByClassName('mini-card')];
    paintures.forEach(painture => {
      let deleteBtn = painture.getElementsByClassName('delete')[0];

      deleteBtn.addEventListener('click', () => {
        let url = "src/php/remove_from_cart.php?painture=" + deleteBtn.getAttribute('data-name');
        function innerCallback() {
          let rect = painture.getBoundingClientRect();
          painture.style.width = rect.width + 'px';
          painture.style.minWidth = 'unset';

          let innerTimeLine = gsap.timeline();
          innerTimeLine.to(painture, { opacity: 0, duration: 0.5 });
          innerTimeLine.to(painture, { width: '0%', duration: 0.5, onComplete: function() { painture.remove() } });
        }

        createRecuest("GET", url, innerCallback);
      });
    });
  }
  createRecuest("GET", "src/php/load_cart.php", callback);
});

const contentTimeLine = gsap.timeline({ paused: true });
contentTimeLine.to(cart, { backgroundColor: '#515151', duration: 0.3 });
contentTimeLine.to(cartContent[0], { translateX: '-100%', duration: 0.5 }, '-=0.2');
contentTimeLine.to(cartContent[1], { translateX: '0%', duration: 0.5 }, '-=0.5');

toPay.addEventListener('click', () => {
  let paintures = [...showcase.getElementsByClassName('mini-card')];
  if(paintures.length > 0) {
    function callback(request) {
      if(request.responseText) {
        const cardView = document.querySelector('.card-view');
        cardView.innerHTML = request.responseText;
        contentTimeLine.play();
      } else alertDialog("Debes iniciar sesión");
    }

    createRecuest("GET", "src/php/bank_card.php", callback);
  } else alertDialog("Carrito vacío");
  
});

cartClose.addEventListener('click', () => {
  contentTimeLine.reverse();
  let timeLine = gsap.timeline({ ease: 'none' });
  timeLine.to(showcase, { opacity: 0, duration: 0.5 });
  timeLine.to(cart, { top: 'calc(100vh - (80px + 20 * (100vw - 320px) / 1600))', duration: 0.6 });
  timeLine.to(cart, { left: 'calc(100vw - (150px + 100 * (100vw - 320px) / 1600))', borderRadius: '20px 0px 0px 0px', duration: 0.3 }, '-=0.3');
  timeLine.to(miniPic, { opacity: 1, duration: 0.3 });
  timeLine.to(cartOpen, { opacity: 1, duration: 0.3 }, '-=0.3');
  marginTimLine.reverse();
});

const paintures = [...document.querySelectorAll('.paint-card')];
paintures.forEach(painture => {
  let cartIco = painture.getElementsByClassName('cart-ico')[0];
  let cardImg = painture.getElementsByClassName('card-img')[0];

  cartIco.addEventListener('click', () => { 
    let url = "src/php/add_to_cart.php?painture=" + painture.getAttribute('data-name');
    function callback(request) {
      miniPic.style.backgroundImage = `url('./static/${cardImg.getAttribute('data-img')}')`;
      gsap.fromTo(miniPic,{ opacity: 0 }, { opacity: 1, duration: 0.3 });
    }
    createRecuest("GET", url, callback);
  });

  cartIco.addEventListener('mouseenter', () => gsap.to(cartIco, { transform: 'scale(1.5)', duration: 0.3 }));
  cartIco.addEventListener('mouseleave', () => gsap.to(cartIco, { transform: 'scale(1)', duration: 0.3 }));

  let hoverTl;
  cardImg.addEventListener('mouseenter', () => {
    const slider = cardImg.getElementsByClassName('img-slider')[0];
    hoverTl = gsap.timeline();
    hoverTl.to(cardImg, { boxShadow: '0px 0px 10px rgba(115, 112, 104, 0.5)', duration: 0.3 });
    hoverTl.to(slider, { translateX: '0%', duration: 0.3 });
    hoverTl.to(cardImg, { backgroundSize: 'contain', backgroundPosition: 'center', duration: 0.3 });
    hoverTl.to(slider, { translateX: '-100%', duration: 0.3 });
  });

  cardImg.addEventListener('mouseleave', () => hoverTl.reverse());

  cardImg.addEventListener('click', () => {
    document.body.style.overflow = 'hidden';

    const rect = cardImg.getBoundingClientRect();
    const price = painture.getElementsByClassName('paint-price');
    const [bigImg, paintureDetails] = showPainture(gsap, painture, home, cart);

    bigImg.style.width = rect.width + 'px';
    bigImg.style.height = rect.height + 'px';
    bigImg.style.top = rect.top + 'px';
    bigImg.style.left = rect.left + 'px';
    bigImg.style.backgroundImage = `url('./static/${cardImg.getAttribute('data-img')}')`;

    let url = "src/php/get_painture.php?name=" + painture.getAttribute('data-name');

    function callback(request) {
      paintureDetails.getElementsByClassName('content')[0].innerHTML = request.responseText;
      let paintureImg = paintureDetails.getElementsByClassName('painture-img')[0];
      let rect2 = paintureImg.getBoundingClientRect();
      let distanceTop = rect2.top + 'px';

      const timeLine = gsap.timeline();
      timeLine.to(cardImg, { opacity: 0, duration: 0.2 });
      timeLine.to(price, { opacity: 0, duration: 0.8 }, '-=0.2');
      timeLine.to(bigImg, { opacity: 1, duration: 0.8 }, '-=0.8');
      timeLine.to(home, { opacity: 0, duration: 0.8 });
      timeLine.fromTo(cart, { translateY: '0px' }, { translateY: "100px", duration: 0.5 }, '-=0.8');
      timeLine.to(bigImg, { width: '100%', height: '100vh', top: distanceTop, left: '0px', backgroundPosition: 'top', duration: 0.6 });
      timeLine.to(paintureDetails, { clipPath: 'polygon(0 0, 100% 0, 100% 100%, 0% 100%)', duration: 1 }, '-=0.2');
      timeLine.to(bigImg, { opacity: 0, duration: 0.2 });
    }

    createRecuest("GET", url, callback);
  });

});