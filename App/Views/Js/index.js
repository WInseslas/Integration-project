function logout() {
    $(document.getElementById('logout').setAttribute('class', 'showing')).load();
}

function profil() {
    $(document.getElementById('profil').setAttribute('class', 'showing')).load();
}

function updatePassword() {
    $(document.getElementById('updatePassword').setAttribute('class', 'showing')).load();
}

function photo() {
    $(document.getElementById('photo').setAttribute('class', 'showing')).load();
}

function modal(module) {
    $(document.getElementById(module)).hide();
}

function login() {
    var pseudo = document.getElementById('pseudo');
    var password = document.getElementById('password');

    if (pseudo.value == '') {
    pseudo.style.borderColor = "red";
    } else {
    pseudo.style.borderColor = "";
    }

    if (password.value == '') {
    password.style.borderColor = "red";
    } else {
    password.style.borderColor = "";
    }
}