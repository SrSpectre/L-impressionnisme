//import '../style/style.css'

/*document.querySelector('#app').innerHTML = `
  <h1>Hello Vite!</h1>
  <a href="https://vitejs.dev/guide/features.html" target="_blank">Documentation</a>
`*/

const cursor = document.querySelector('.cursor');
const cart = document.querySelector('.cart');
const miniPic = document.querySelector('.mini-pic');
const cartOpen = document.querySelector('.open-cart');
const cartClose = document.querySelector('.close-cart');
const detailsClose = document.querySelector('.close-details');
const menuOpen = document.querySelector('.hamburger-button');
const menuClose = document.querySelector('.close-menu');
const miniCursors = [...document.querySelectorAll('.mini-cursor')];
const menu = document.querySelector('.menu');
const home = document.querySelector('.home');
const bigImg = document.querySelector('.big-img');
const paintureDetails = document.querySelector('.painture-details');
const sliders = [...document.querySelectorAll('.slider')];
const paintures = [...document.querySelectorAll('.paint-card')];
const dividers = [...document.querySelectorAll('.divider')];
const details = [...document.querySelectorAll('.details')];
const dividerText = document.querySelector('.divider-text');
const footerFlex = [...document.querySelectorAll('.flex')];
const sigup = document.querySelector('.sigup');
const logPanel = document.querySelector('.login');
const logClose = document.querySelector('.close-login');

const login = sigup.getElementsByTagName('div')[0];
const register = sigup.getElementsByTagName('div')[2];

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
tl.fromTo(sigup, { opacity: 0 }, { opacity: 1, duration: 0.5 }, '-=0.3');
tl.fromTo('.scroll-ic', { opacity: 0 }, { opacity: 1, duration: 0.5 }, '-=0.3');
tl.fromTo(cart, { translateY: '100px' }, { translateY: "0px", duration: 0.5 }, '-=0.3');

login.addEventListener('click', () => {
  gsap.to(logPanel, { translateY: '0%', duration: 0.8 });
});

logClose.addEventListener('click', () => {
  gsap.to(logPanel, { translateY: '-100%', duration: 0.8 });
});

const getMargins = (element) => [element.getElementsByClassName('margin-title')[0], element.getElementsByClassName('margin-title-rev')[0]];

let menuTl;
menuOpen.addEventListener('click', () => {
  menuTl = gsap.timeline();
  gsap.fromTo(cart, { translateY: '0px' }, { translateY: "100px", duration: 0.8 });
  menuTl.fromTo(home, { translateX: '0%' }, { translateX: '-100%', duration: 1 });
  menuTl.fromTo(sliders[0], { y: 0, translateX: '100%' }, { translateX: '-100%', duration: 1.5 }, '-=1');
  menuTl.fromTo(sliders[1], { y: 0, translateX: '100%' }, { translateX: '-100%', duration: 1.5 }, '-=1');
  menuTl.fromTo(menu, { translateX: '100%' }, { translateX: '0%', duration: 1 }, '-=1.1');
  menuTl.to(getMargins(menu), { clipPath: 'polygon(0 0, 100% 0, 100% 100%, 0% 100%)', duration: 0.5 }, '-=0.5');
  [...document.querySelectorAll('.opt')].forEach((option, i) => {
    menuTl.fromTo(option, { opacity: 0 }, { opacity: 1, duration: 0.5 }, `-=${0.3 * i}`);
  });
});

menuClose.addEventListener('click', () => {
  menuTl.reverse();
  gsap.fromTo(cart, { translateY: '100px' }, { translateY: "0px", duration: 0.8, delay: 1 });
});

function cartStyles() {
  cart.style.top = 'calc(100vh - (80px + 20 * (100vw - 320px) / 1600))';
  cart.style.left = 'calc(100vw - (150px + 100 * (100vw - 320px) / 1600))';
}

let cartTl;
cartOpen.addEventListener('click', () => {
  cartTl = gsap.timeline({ onReverseComplete:cartStyles });
  cartTl.to(cartOpen, { opacity: 0, duration: 0.3 });
  cartTl.to(cart, { top: '50%', left: '0px', borderRadius: '0px', ease: 'none', duration: 0.3 });
  cartTl.to(cart, { top: '0px', duration: 0.3 });
  cartTl.to(getMargins(cart), { clipPath: 'polygon(0 0, 100% 0, 100% 100%, 0% 100%)', duration: 0.5 });
});

cartClose.addEventListener('click', () => cartTl.reverse());

let tl2 = gsap.timeline({ repeat: -1 });
tl2.to('.scroll-ball', { top: 'unset', bottom: '3px', duration: 0.5 });
tl2.to('.scroll-ball', { top: '3px', bottom: 'unset', duration: 0.3, delay: 0.5 });

let rect = dividerText.getBoundingClientRect();
let tl4 = gsap.timeline({ repeat: -1 });
tl4.fromTo(dividerText, { translateX: '0%' }, { translateX: -(rect.width - window.innerWidth) + 'px', duration: 5, ease: 'none' });

function hideImage() {
  document.body.style.overflowY = 'scroll';
  bigImg.style.display = 'none';
  bigImg.removeEventListener('click', showImg);
}

let showing = false;
function showImg() {
  let content = paintureDetails.getElementsByClassName('content')[0];
  if(showing) {
    gsap.to(content, { opacity: 1, duration: 0.3 });
    gsap.to(bigImg, { top: '50vh', duration: 0.5 });
  }
  else {
    gsap.to(content, { opacity: 0, duration: 0.3 });
    gsap.to(bigImg, { top: '0px', duration: 0.5 });
  }
  showing = !showing;
}

function onHoverImg() {
  bigImg.addEventListener('click', showImg);
}

let paintureTl;
paintures.forEach(painture => {
  let cartIco = painture.getElementsByClassName('cart-ico')[0];
  let cardImg = painture.getElementsByClassName('card-img')[0];
  let slider = cardImg.getElementsByClassName('img-slider')[0];
  let clickBtn = cardImg.getElementsByClassName('click-btn')[0];

  cartIco.addEventListener('click', () => {
    miniPic.style.backgroundImage = `url('./static/${cardImg.getAttribute('data-img')}')`;
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

  let imgTl;
  cardImg.addEventListener('mouseenter', () => {
    imgTl = gsap.timeline();
    imgTl.to(cardImg, { boxShadow: '0px 0px 10px rgba(115, 112, 104, 0.5)', duration: 0.3 });
    imgTl.to(slider, { translateX: '0%', duration: 0.3 });
    imgTl.to(cardImg, { backgroundSize: 'contain', backgroundPosition: 'center', duration: 0.3 });
    imgTl.to(slider, { translateX: '100%', duration: 0.3 });

    let tlIn2 = gsap.timeline({ repeat: 3 });
    tlIn2.to(clickBtn, { scale: 0.8, duration: 0.3 });
    tlIn2.to(clickBtn, { scale: 1, bottom: 'unset', duration: 0.3, delay: 0.5 });
  });

  cardImg.addEventListener('mouseleave', () => imgTl.reverse());

  painture.addEventListener('click', () => {
    document.body.style.overflow = 'hidden';
    paintureTl = gsap.timeline({ onReverseComplete: hideImage });
    let rect = cardImg.getBoundingClientRect();
    let elements = [...cardImg.getElementsByClassName('click-ic'), ...painture.getElementsByClassName('paint-price')];

    bigImg.style.display = 'block';
    bigImg.style.width = rect.width + 'px';
    bigImg.style.height = rect.height + 'px';
    bigImg.style.top = rect.top + 'px';
    bigImg.style.left = rect.left + 'px';
    bigImg.style.backgroundImage = `url('./static/${cardImg.getAttribute('data-img')}')`;

    paintureTl.to(cardImg, { opacity: 0, duration: 0.2 });
    paintureTl.to(elements, { opacity: 0, duration: 0.8 }, '-=0.2');
    paintureTl.to(bigImg, { opacity: 1, duration: 0.8 }, '-=0.8');
    paintureTl.to(home, { opacity: 0, duration: 0.8 });
    paintureTl.fromTo(cart, { translateY: '0px' }, { translateY: "100px", duration: 0.5 }, '-=0.8');
    paintureTl.to(bigImg, { width: '100%', height: '100vh', top: '50vh', left: '0px', duration: 0.6 });
    paintureTl.to(paintureDetails, { clipPath: 'polygon(0 0, 100% 0, 100% 100%, 0% 100%)', duration: 1, onComplete: onHoverImg }, '-=0.2');

    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        paintureDetails.getElementsByClassName('info')[0].innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "src/php/getPainture.php?name=" + painture.getAttribute('data-name'), true);
    xmlhttp.send();
  });

});

detailsClose.addEventListener('click', () => paintureTl.reverse());