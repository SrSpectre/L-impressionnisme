//import '../style/style.css'

/*document.querySelector('#app').innerHTML = `
  <h1>Hello Vite!</h1>
  <a href="https://vitejs.dev/guide/features.html" target="_blank">Documentation</a>
`*/

const cursor = document.querySelector('.cursor');
const cart = document.querySelector('.cart');
const miniPic = document.querySelector('.mini-pic');
const cartOpen = document.querySelector('.open-cart');
const cartClose = document.querySelector('.close-ico');
const miniCursors = [...document.querySelectorAll('.mini-cursor')];
const menuBtn = document.querySelector('.hamburger-button');
const home = document.querySelector('.home');
const sliders = [...document.querySelectorAll('.slider')];
const paintures = [...document.querySelectorAll('.paint-card')];
const dividers = [...document.querySelectorAll('.divider')];
const details = [...document.querySelectorAll('.details')];
const dividerText = document.querySelector('.divider-text');
const footerFlex = [...document.querySelectorAll('.flex')];

//gsap.fromTo('#root', { scaleX: 0.5 }, { scaleX: 1, duration: 1, delay: 0.5 });

window.addEventListener('mousemove', (event) => {
  gsap.to(cursor, { top: event.clientY + 'px', left: event.clientX + 'px', ease: 'none', duration: 0.1 });
  miniCursors.forEach((mini, index) => {
    gsap.to(mini, { top: event.clientY + 'px', left: event.clientX + 'px', ease: 'none', duration: 0.3 + (index * 0.2) });
  });
});

function loadAnimations() {
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
      start: 'top bottom'
    },
    opacity: 1,
    duration: 1,
    delay: 0.5
  });

  document.body.style.overflowY = 'scroll';
}

let tl = gsap.timeline({ onComplete: loadAnimations });
tl.fromTo(sliders[1], { translateY: '0%' }, { translateY: '-100%', duration: 0.6, delay: 0.5 });
tl.fromTo(sliders[0], { translateY: '100%' }, { translateY: '-100%', duration: 1 }, '-=0.6');
tl.fromTo(home, { translateY: '100%' }, { translateY: '0%', duration: 1.5 }, '-=1.5');
tl.fromTo('.hamburger-button', { opacity: 0 }, { opacity: 1, duration: 0.5 }, '-=0.1');
tl.fromTo('.sigup', { opacity: 0 }, { opacity: 1, duration: 0.5 }, '-=0.3');
tl.fromTo('.scroll-ic', { opacity: 0 }, { opacity: 1, duration: 0.5 }, '-=0.3');
tl.fromTo(cart, { translateY: '100px' }, { translateY: "0px", duration: 0.5 }, '-=0.3');

let isOpen = false;
menuBtn.addEventListener('click', () => {
  let tl3 = gsap.timeline();
  if(isOpen) {
    tl3.fromTo(sliders[1], { y: 0, translateX: '-100%' }, { translateX: '100%', duration: 1.5 });
    tl3.fromTo(sliders[0], { y: 0, translateX: '-100%' }, { translateX: '100%', duration: 1.5 }, '-=1');
    tl3.fromTo(home, { translateX: '-100%' }, { translateX: '0%', duration: 1 }, '-=1');
  } else {
    tl3.fromTo(home, { translateX: '0%' }, { translateX: '-100%', duration: 1 });
    tl3.fromTo(sliders[0], { y: 0, translateX: '100%' }, { translateX: '-100%', duration: 1.5 }, '-=1');
    tl3.fromTo(sliders[1], { y: 0, translateX: '100%' }, { translateX: '-100%', duration: 1.5 }, '-=1');
  }
  isOpen = !isOpen;
});

cartOpen.addEventListener('click', () => {
  let tl5 = gsap.timeline();
  tl5.to(cart, { top: '50%', left: '0px', borderRadius: '0px', ease: 'none', duration: 0.3 });
  tl5.to(cart, { top: '0px', duration: 0.3 });
});

cartClose.addEventListener('click', () => {
  let tl5 = gsap.timeline();
  tl5.to(cart, { top: '50%', ease: 'none', duration: 0.3 });
  tl5.to(cart, { top: 'calc(100vh - (80px + 20 * (100vw - 320px) / 1600))', left: 'calc(100vw - (150px + 100 * (100vw - 320px) / 1600))', borderRadius: '20px 0px 0px 0px', duration: 0.3 });
});

let tl2 = gsap.timeline({ repeat: -1 });
tl2.to('.scroll-ball', { top: 'unset', bottom: '3px', duration: 0.5 });
tl2.to('.scroll-ball', { top: '3px', bottom: 'unset', duration: 0.3, delay: 0.5 });

let rect = dividerText.getBoundingClientRect();
let tl4 = gsap.timeline({ repeat: -1 });
tl4.fromTo(dividerText, { translateX: '0%' }, { translateX: -(rect.width - window.innerWidth) + 'px', duration: 5, ease: 'none' });


paintures.forEach(painture => {
  let cartIco = painture.getElementsByClassName('cart-ico')[0];
  let cardImg = painture.getElementsByClassName('card-img')[0];
  let slider = cardImg.getElementsByClassName('img-slider')[0];
  let clickBtn = cardImg.getElementsByClassName('click-btn')[0];

  cartIco.addEventListener('click', function() {
    miniPic.style.backgroundImage = `url('./static/${this.getAttribute('data-img')}')`;
    gsap.fromTo(miniPic,{ opacity: 0 }, { opacity: 1, duration: 0.3 });
    //gsap.to(miniPic, { opacity: 0, duration: 0.3, delay: 1.5 });
  });

  cartIco.addEventListener('mouseenter', () => {
    gsap.to(cartIco, { transform: 'scale(0.5)', duration: 0.3 });
  });

  cartIco.addEventListener('mouseleave', () => {
    let tlIn = gsap.timeline();
    tlIn.to(cartIco, { transform: 'scale(1.2)', duration: 0.3 });
    tlIn.to(cartIco, { transform: 'scale(1)', duration: 0.3 });
    tlIn.to(cartIco, { transform: 'scale(1.1)', duration: 0.3 });
    tlIn.to(cartIco, { transform: 'scale(1)', duration: 0.3 });
  });

  cardImg.addEventListener('mouseenter', () => {
    let tlIn = gsap.timeline();
    gsap.to(cardImg, { boxShadow: '0px 0px 10px rgba(115, 112, 104, 0.5)', duration: 0.3 });
    tlIn.to(slider, { translateX: '0%', duration: 0.3 });
    tlIn.to(cardImg, { backgroundSize: 'contain', backgroundPosition: 'center', duration: 0.3 });
    tlIn.to(slider, { translateX: '100%', duration: 0.3 });

    let tlIn2 = gsap.timeline({ repeat: 3 });
    tlIn2.to(clickBtn, { scale: 0.8, duration: 0.5 });
    tlIn2.to(clickBtn, { scale: 1, bottom: 'unset', duration: 0.3, delay: 0.5 });
  });

  cardImg.addEventListener('mouseleave', () => {
    let tlIn = gsap.timeline();
    tlIn.to(slider, { translateX: '0%', duration: 0.3 });
    tlIn.to(cardImg, { backgroundSize: 'cover', backgroundPosition: 'top', duration: 0.3 });
    tlIn.to(slider, { translateX: '-100%', duration: 0.3 });
    tlIn.to(cardImg, { boxShadow: '0px 0px 0px rgba(115, 112, 104, 0.5)', duration: 0.3 });
  });
});