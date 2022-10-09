import 'focus-visible';
// import lazyImages from './modules/lazyImages';
import main from './modules/main';
import popup from './modules/popup';
import header from './modules/header';
import slider from './modules/swiper';
import yandex from './modules/yandex';
import svg4everybody from 'svg4everybody';

import documentReady from './helpers/documentReady';

documentReady(() => {
    main();
    popup();
    header();
    slider();
    yandex();
    svg4everybody();
});
