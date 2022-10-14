export default () => {
    document.querySelector('.header-mob__nav').addEventListener('click', () => {
        document.querySelector('body').classList.add('is-fixed');
        document.querySelector('.header-mob').classList.add('active');
        document.querySelector('.nav-mob').classList.add('active');
        document.querySelector('.nav-mob__overlay').classList.add('active');
    });
    document.querySelector('.nav-mob__close').addEventListener('click', () => {
        document.querySelector('body').classList.remove('is-fixed');
        document.querySelector('.nav-mob').classList.remove('active');
        document.querySelector('.nav-mob__overlay').classList.remove('active');
    });
};
