import AbstractView from "./AbstractView.js";
import { getMargins } from "../utils.js";

export default class extends AbstractView {
    constructor() {
        super();
        this.Container = document.createElement('div');
    }

    async getElement() {
        this.Container.classList.add('login');
        this.Container.innerHTML = `
            <div class="login-container">
                <div class="login-showcase login-flex"></div>
                <div class="login-data login-flex">
                    <div class="box-container">
                        <div class="margin-container">
                            <div class="margin-title">L’impressionnisme</div>
                        </div>
                        <div class="margin-content">
                            <form id="loginForm" name="loginForm" action="src/php/login.php" onsubmit="return verifyLogin()" method="post">
                            <div class="data-container">
                                <div class="input-container">
                                    <div class="label">Usuario</div>
                                    <input type="text" name="user" onfocusout="loginUser()" required>
                                </div>
                                <div class="input-container">
                                    <div class="label">Contraseña</div>
                                    <input type="password" name="pswd" required>
                                </div>
                            </div>
                            <div class="button-container">
                                <input type="submit" value="" class="button">
                            </div>
                            <div class="register-link" panel-link="register">Aún no eres miembro? Unete</div>
                            </form>
                        </div>
                        <div class="margin-container">
                            <div class="margin-title-rev">L’impressionnisme</div>
                        </div>
                    </div>
                    <img class="close-login close-ico" src="./static/ico/cross.svg" alt="close icon">
                </div>
            </div>
        `;
        return this.Container;
    }

    removePanel() {
        console.log(this.Container);
        document.querySelector('.login').remove();
    }

    openPanel() {
        let timeLine = gsap.timeline({ onReverseComplete: this.removePanel });
        timeLine.to(this.Container, { translateY: '0%', duration: 0.8 });
        timeLine.fromTo('.login-showcase', { opacity: 0 }, { opacity: 1, duration: 0.8 }, '-=0.6');
        timeLine.to(getMargins(this.Container), { clipPath: 'polygon(0 0, 100% 0, 100% 100%, 0% 100%)', duration: 0.5 }, '-=0.5');

        const closePanel = this.Container.getElementsByClassName('close-login')[0];
        closePanel.addEventListener('click', () => {
            timeLine.reverse()
        });
    }
}