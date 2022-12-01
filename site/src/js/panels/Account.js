import AbstractView from "./AbstractView.js";
import { getMargins } from "../utils.js";
import { createRecuest } from "../async/httpRequest.js";

export default class extends AbstractView {
    constructor() {
        super();
        this.Container = document.createElement('div');
    }

    async getElement() {
        this.Container.classList.add('account-data');
        const container = this.Container;
        function callback(request) {
            container.innerHTML = request.responseText;
            gsap.to(getMargins(container), { clipPath: 'polygon(0 0, 100% 0, 100% 100%, 0% 100%)', duration: 0.5 }, '-=0.5');

            let isOpen = false;
            const closePanel = container.getElementsByClassName('close-data')[0];
            const historyContainer = document.querySelector('.history-container');
            closePanel.addEventListener('click', () => {
                if (isOpen) gsap.to(historyContainer, { translateY: '100%', duration: 0.8 });
                else gsap.to(container, { translateY: '100%', duration: 0.8, onComplete: function() { document.querySelector('.account-data').remove(); } });
                isOpen = false;
            });

            const history = document.querySelector('.history');
            history.addEventListener('click', () => {
                function innerCallback(request2) {
                    const historyElement = document.querySelector('.history-element');
                    historyElement.innerHTML = request2.responseText;
                    gsap.to(historyContainer, { translateY: '0%', duration: 0.8 });
                    isOpen = true;
                }

                createRecuest("GET", "src/php/get_history.php", innerCallback);
            });
        }
        createRecuest("GET", "src/php/account_data.php", callback);
        return this.Container;
    }

    removePanel() {
        document.querySelector('.account-data').remove();
    }

    openPanel() {
        gsap.to(this.Container, { translateY: '0%', duration: 0.8 });
    }
}