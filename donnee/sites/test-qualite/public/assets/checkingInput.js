class AuthentificationControleField {

    errors = {
        username: true,
        password: true
    }
    static errorIdUsername = 'username';
    static errorIdPassword = 'password';

    constructor(usernameGroup, usernameInput, passwordGroup, passwordInput, submitBtn) {
        this.usernameInput = usernameInput;
        this.passwordInput = passwordInput;

        this.usernameGroup = usernameGroup;
        this.passwordGroup = passwordGroup;
        this.submitBtn = submitBtn;
    }

    checkIntegrity() {
        this.usernameInput.addEventListener('input', e => {
            if (!this.checkUsername(e.target.value)) {
                this.addError(
                    this.usernameGroup,
                    this.usernameInput,
                    AuthentificationControleField.errorIdUsername,
                    'Votre nom d\'utilisateur doit comprendre entre en 3 et 150 caractères'
                );
            } else {
                this.removeError(this.usernameGroup, this.usernameInput, AuthentificationControleField.errorIdUsername);
            }
            this.isSubmited();
        });

        this.passwordInput.addEventListener('input', e => {
            if (!this.checkPassword(e.target.value)) {
                this.addError(
                    this.passwordGroup,
                    this.passwordInput,
                    AuthentificationControleField.errorIdPassword,
                    'Votre mot de passe doit faire minimum 6 characters, une minuscule, une majuscule, un nombre et un caractère special'
                );
            } else {
                this.removeError(this.passwordGroup, this.passwordInput, AuthentificationControleField.errorIdPassword);
            }
            this.isSubmited();
        });
    }

    isSubmited() {
        if (this.errors.username || this.errors.password) {
            this.submitBtn.setAttribute('disabled', true);
        } else {
            this.submitBtn.removeAttribute('disabled');
        }
    }

    addError(parentElement, element, errorId, content) {
        this.errors[errorId] = true;
        element.classList.add('error');
        if (parentElement.querySelector('#error-' + errorId) === null) {
            parentElement.appendChild(this.createElement(`<p id="error-${errorId}" class="error-${errorId}">${content}</p>`));
        }
    }

    removeError(parentElement, element, errorId) {
        this.errors[errorId] = false;
        element.classList.remove('error');
        parentElement.querySelector('#error-' + errorId)?.parentNode.removeChild(parentElement.querySelector('#error-' + errorId));
    }

    checkUsername(username) {
        return (typeof username === 'string') && username.length >= 3 && username.length <= 150;
    }

    checkPassword(password) {
        return (new RegExp('^(?=.*\\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*]).{6,}$')).test(password);
    }

    createElement(str) {
        let frag = document.createDocumentFragment();
        let elem = document.createElement('div');
        elem.innerHTML = str;
        while (elem.childNodes[0]) {
            frag.appendChild(elem.childNodes[0]);
        }
        return frag;
    }
}

let authentificationControleField = new AuthentificationControleField(
    document.querySelector('#username-group'),
    document.querySelector('#username'),
    document.querySelector('#password-group'),
    document.querySelector('#password'),
    document.querySelector('#authentification-btn')
);

authentificationControleField.checkIntegrity();