function closeAnimation(gsap, painture, home, cart, img, details) {
    const timeLine = gsap.timeline({
        onComplete: function() {
            img.remove();
            details.remove();
            document.body.style.overflowY = 'scroll';
        }
    });
    let cardImg = painture.getElementsByClassName('card-img')[0];
    let price = painture.getElementsByClassName('paint-price');
    let rect = cardImg.getBoundingClientRect();
    let distanceTop = rect.top + 'px';
    let distanceLeft = rect.left + 'px';

    timeLine.to(img, { opacity: 1, duration: 0.2 });
    timeLine.to(details, { clipPath: 'polygon(0 100%, 100% 100%, 100% 100%, 0% 100%)', duration: 1 });
    timeLine.to(img, { width: rect.width + 'px', height: rect.height + 'px', top: distanceTop, left: distanceLeft, backgroundPosition: 'center', duration: 0.6 });
    timeLine.fromTo(cart, { translateY: '100px' }, { translateY: "00px", duration: 0.5 }, '-=0.6');
    timeLine.to(home, { opacity: 1, duration: 0.8 }, '-=0.6');
    timeLine.to(img, { opacity: 0, duration: 0.8 });
    timeLine.to(price, { opacity: 0, duration: 0.8 }, '-=0.8');
    timeLine.to(cardImg, { opacity: 1, backgroundSize: 'cover', duration: 0.2 }, '-=0.8');
}

export function showPainture(gsap, painture, home, cart) {
    const imageContainer = document.createElement('div');
    const detailsContainer = document.createElement('div');

    imageContainer.classList.add('big-img');
    detailsContainer.classList.add('painture-details');

    detailsContainer.innerHTML = `
        <div class="content"></div>
        <img class="close-details close-ico" src="./static/ico/cross-light.svg" alt="close icon"></img>
    `;

    document.body.appendChild(imageContainer);
    document.body.appendChild(detailsContainer);

    const close = detailsContainer.getElementsByTagName('img')[0];
    close.addEventListener('click', () => closeAnimation(gsap, painture, home, cart, imageContainer, detailsContainer));

    return [imageContainer, detailsContainer];
}