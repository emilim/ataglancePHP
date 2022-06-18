function account() {
    window.location.href = 'user.php';
}

function notes() {
    window.location.href = 'account.php';
}

function settings() {
    window.location.href = 'settings.php';
}

function onSignIn(googleUser) {
    var profile = googleUser;
    console.log(profile);
    var response = $.post('./backend/save-user.php', {
        userData: JSON.stringify(profile)
    });
    if (response.readyState == 1) {
        console.log('Saving user...');
        window.location.href = './app/account.php';
    }
}

const themeMap = {
    dark: "light",
    light: "solar",
    solar: "dark"
};

const theme = localStorage.getItem('theme') ||
    (tmp = Object.keys(themeMap)[0],
        localStorage.setItem('theme', tmp),
        tmp);
const bodyClass = document.body.classList;
bodyClass.add(theme);

function toggleTheme() {
    const current = localStorage.getItem('theme');
    const next = themeMap[current];

    bodyClass.replace(current, next);
    localStorage.setItem('theme', next);
}

document.getElementById('themeButton').onclick = toggleTheme;
