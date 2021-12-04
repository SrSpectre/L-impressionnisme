import AbstractView from "./AbstractView";
import { getMargins } from "../utils";

export default class extends AbstractView {
    constructor() {
        super();
        this.Container = document.createElement('div');
    }

    async getElement() {
        this.Container.classList.add('register-data');
        this.Container.innerHTML = `
            <form id="registerForm" name="registerForm" action="src/php/register.php" onsubmit="return verifyRegister()" method="post">
                <div class="left-panel flex-panel">
                    <div class="box-container">
                        <div class="margin-container">
                            <div class="margin-title">L’impressionnisme</div>
                        </div>
                        <div class="margin-content">
                            <div class="data-container">
                                <div class="input-container">
                                    <div class="label">Usuario</div>
                                    <input type="text" name="user" onfocusout="registerUser()" required>
                                </div>
                                <div class="input-container">
                                    <div class="label">Nombre(s)</div>
                                    <input type="text" name="name" required>
                                </div>
                                <div class="input-container">
                                    <div class="label">Apellidos</div>
                                    <input type="text" name="lname" required>
                                </div>
                                <div class="input-container">
                                    <div class="label">Correo</div>
                                    <input type="email" name="email" onfocusout="registerEmail()" required>
                                </div>
                                <div class="input-container">
                                    <div class="label">Contraseña</div>
                                    <input type="password" name="pswd" onfocusout="checkPswd()" required>
                                </div>
                                <div class="input-container">
                                    <div class="label">Repite contraseña</div>
                                    <input type="password" name="rpswd" onfocusout="checkPswd()" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right-panel flex-panel">
                    <div class="box-container">
                        <div class="margin-content">
                            <div class="data-container">
                                <div class="input-container">
                                    <div class="label">Estado</div>
                                    <input type="text" name="state" required>
                                </div>
                                <div class="input-container">
                                    <div class="label">Ciudad</div>
                                    <input type="text" name="town" required>
                                </div>
                                <div class="input-container">
                                    <div class="label">Colonia</div>
                                    <input type="text" name="colony" required>
                                </div>
                                <div class="input-container">
                                    <div class="label">Dirección</div>
                                    <input type="text" name="address" required>
                                </div>
                                <div class="input-container">
                                    <div class="label">Código postal</div>
                                    <input type="text" name="zip" minlength="5" maxlength="5" required>
                                </div>
                                <div class="button-container">
                                    <input type="submit" value="" class="button">
                                </div>
                            </div>
                        </div>
                        <div class="margin-container">
                            <div class="margin-title-rev">L’impressionnisme</div>
                        </div>
                    </div>
                </div>      
            </form>
            <img class="close-reg close-ico" src="./static/ico/cross.svg" alt="close icon">
        `;
        return this.Container;
    }

    removePanel() {
        console.log(this.Container);
        document.querySelector('.register-data').remove();
    }

    openPanel() {
        let timeLine = gsap.timeline({ onReverseComplete: this.removePanel });
        timeLine.to(this.Container, { translateY: '0%', duration: 0.8 });
        timeLine.to(getMargins(this.Container), { clipPath: 'polygon(0 0, 100% 0, 100% 100%, 0% 100%)', duration: 0.5 }, '-=0.5');

        const closePanel = this.Container.getElementsByClassName('close-reg')[0];
        closePanel.addEventListener('click', () => {
            timeLine.reverse()
        });
    }
}