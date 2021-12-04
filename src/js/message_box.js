export function alertDialog(message) {
    if (!isEmpty(message)) {
        if(!document.querySelector('.message-box')) {
            let container = document.createElement('div');
            container.classList.add('message-box');
            container.innerHTML = message;
            document.body.appendChild(container);

            gsap.to(container, { translateY: '-100%', duration: 0.5 });
            gsap.to(container, { 
                translateY: '100%', 
                duration: 0.5, 
                delay: 2, 
                onComplete: function() {
                    container.remove();
                } 
            });
        }
    }
}