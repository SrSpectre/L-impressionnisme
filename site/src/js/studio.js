import { getRandomInRange } from "./utils.js";

const bienvenue =  document.querySelector('.bienvenue-text');
const details =  document.querySelector('.our-details');
const contactWays =  document.querySelectorAll('.way');
const contactSocial =  document.querySelectorAll('.social');
const hero1 =  document.querySelector('.hero-title');
const hero2 =  document.querySelector('.hero-title-rev');
const footerFlex = [...document.querySelectorAll('.flex')];

let letters = bienvenue.innerHTML.split('');
bienvenue.innerHTML = '';
letters.forEach(letter => {
    let container = document.createElement('span');
    let span = document.createElement('span');
    container.classList.add('letter-container');
    span.classList.add('char');

    span.innerHTML = letter;
    container.appendChild(span);
    bienvenue.appendChild(container);
});

const chars = document.querySelectorAll('.char');
chars.forEach(char => {
    gsap.to(char, { translateX: '0%', opacity: 1, duration: getRandomInRange(0.3, 1.3) });
});

gsap.fromTo(details, { translateY: '100%', opacity: 0 }, { translateY: '0%', opacity: 1, duration: 1 });

let timeLine = gsap.timeline({
    scrollTrigger: {
        trigger: '.our-details',
        start: 'top center'
    },
});

for (let i = 0; i < contactWays.length; i++) {
    timeLine.fromTo(contactWays[i], { translateY: '100%', opacity: 0 }, { translateY: '0%', opacity: 1, duration: 0.5 }, (i != 0) ? '-=0.2' : 0.2);
    timeLine.fromTo(contactSocial[i], { translateY: '100%', opacity: 0 }, { translateY: '0%', opacity: 1, duration: 0.5 }, '-=0.2');
}

function scrollHero(hero, posX) {
    gsap.fromTo(hero,
        { 
            translateX: posX, 
            opacity: 0 
        }, {
            scrollTrigger: {
                trigger: '.studio-img',
                start: 'center center'
            },
            translateX: '0%', 
            opacity: 1, 
            duration: 2
        }
    );
}

scrollHero(hero1, '100%');
scrollHero(hero2, '-100%');

gsap.to(footerFlex, { 
    scrollTrigger: {
        trigger: '.footer',
        start: 'center bottom'
    },
    opacity: 1,
    duration: 1
});
