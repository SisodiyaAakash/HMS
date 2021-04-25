function reserveHeaderReisedEvent() {
    // Header flag (for parent access)
    let headerRaisedState = false;

    // for caching
    const header = document.querySelector('.nav-container');

    function effect() {
        const posY = window.scrollY;

        if (!headerRaisedState && posY >= 80) {
            header.classList.add('toggle-nav');
            headerRaisedState = true;
        } else if (headerRaisedState && posY <= 80) {
            headerRaisedState = false;
            header.classList.remove('toggle-nav');
        }
    }

    if (header) {
        window.addEventListener('scroll', effect);

        // Called once for initial window load
        effect();
    }
}
window.onload=function(){
    reserveHeaderReisedEvent();
}