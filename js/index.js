function visible() {
    const navLateral = document.querySelector('.nav-lateral');
    navLateral.style.marginLeft = '0px';
    navLateral.style.transition = '0.5s';
}
function invisible() {
    const navLateral = document.querySelector('.nav-lateral');
    navLateral.style.marginLeft = '-300px';
    navLateral.style.transition = '0.5s';
}


const botonVisible = document.querySelector('.btn-visible');
const botonInvisible = document.querySelector('.btn-invisible');

botonVisible.addEventListener('click', () => { visible(); });

botonInvisible.addEventListener('click', () => { invisible(); });
