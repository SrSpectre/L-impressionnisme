import { getMargins } from "./utils";
import { createSliders } from "./sliders";

const home = document.querySelector('.home');
const studio = document.querySelector('.studio');
const cursor = document.querySelector('.cursor');
const cart = document.querySelector('.cart');
const menuOpen = document.querySelector('.hamburger-button');
const menuClose = document.querySelector('.close-menu');
const miniCursors = [...document.querySelectorAll('.mini-cursor')];
const menu = document.querySelector('.menu');

window.addEventListener('mousemove', (event) => {
  gsap.to(cursor, { top: event.clientY + 'px', left: event.clientX + 'px', ease: 'none', duration: 0.1 });
  miniCursors.forEach((mini, index) => {
    gsap.to(mini, { top: event.clientY + 'px', left: event.clientX + 'px', ease: 'none', duration: 0.3 + (index * 0.2) });
  });
});

let menuTimeLine;
menuOpen.addEventListener('click', () => {
  const [slider1, slider2] = createSliders();
  menuTimeLine = gsap.timeline({ 
    onReverseComplete: function() {
      slider1.remove();
      slider2.remove();
    } 
  });
  gsap.fromTo(cart, { translateY: '0px' }, { translateY: "100px", duration: 0.8 });
  menuTimeLine.fromTo(home ? home : studio, { translateX: '0%' }, { translateX: '-100%', duration: 1 });
  menuTimeLine.fromTo(slider2, { y: 0, translateX: '100%' }, { translateX: '-100%', duration: 1.5 }, '-=1');
  menuTimeLine.fromTo(slider1, { y: 0, translateX: '100%' }, { translateX: '-100%', duration: 1.5 }, '-=1');
  menuTimeLine.fromTo(menu, { translateX: '100%' }, { translateX: '0%', duration: 1 }, '-=1.1');
  menuTimeLine.to(getMargins(menu), { clipPath: 'polygon(0 0, 100% 0, 100% 100%, 0% 100%)', duration: 0.5 }, '-=0.5');
  [...document.querySelectorAll('.opt')].forEach((option, i) => {
    menuTimeLine.fromTo(option, { opacity: 0 }, { opacity: 1, duration: 0.5 }, `-=${0.3 * i}`);
  });
});

menuClose.addEventListener('click', () => {
  menuTimeLine.reverse();
  gsap.fromTo(cart, { translateY: '100px' }, { translateY: "0px", duration: 0.8, delay: 1 });
});