function meny() {
    if (document.getElementById('desktop-links').getAttribute('class') == 'nav-inactive') {
        document.getElementById('desktop-links').classList.add('nav-active');
    } else {
        document.getElementById('desktop-links').classList.remove('nav-active');
        document.getElementById('desktop-links').classList.add('nav-inactive');
    }
}