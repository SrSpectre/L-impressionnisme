import Login from "./panels/Login.js";
import Register from "./panels/Register.js";
import Account from "./panels/Account.js";

const router = async(pathname) => {
    const routes = [
        { path: "login", view: Login },
        { path: "register", view: Register },
        { path: "account", view: Account }
    ];

    const potentialMatches = routes.map(route => {
        return {
            route: route,
            isMatch: pathname === route.path
        };
    });

    let match = potentialMatches.find(potentialMatch => potentialMatch.isMatch);

    if (match) {
        const view = new match.route.view();
        document.body.appendChild(await view.getElement());
        view.openPanel();
    }
};

document.body.addEventListener('click', e => {
    if (e.target.matches('[panel-link]')) {
        router(e.target.getAttribute('panel-link'));
    }
});