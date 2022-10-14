export default () => {
    const yMap = document.querySelector('.map');

    if (yMap) {
        ymaps.ready(function () {
            var myMap = new ymaps.Map(
                    'yamap',
                    {
                        center: [55.791030068948096, 37.356791499999936],
                        zoom: 17,
                        controls: [],
                        behaviors: [
                            'drag',
                            'dblClickZoom',
                            'rightMouseButtonMagnifier',
                            'multiTouch',
                        ],
                    },
                    {
                        searchControlProvider: 'yandex#search',
                    }
                ),
                myPlacemark = new ymaps.Placemark(
                    myMap.getCenter(),
                    {},
                    {
                        // Опции.
                        // Необходимо указать данный тип макета.
                        // iconLayout: 'default#image',
                        // Своё изображение иконки метки.
                        // iconImageHref:
                        // '/wp-content/themes/kanscraft/assets/files/icons/svg/icon--yapin.svg',
                        // Размеры метки.
                        // iconImageSize: [74, 94],
                        // Смещение левого верхнего угла иконки относительно
                        // её "ножки" (точки привязки).
                        // iconImageOffset: [-25, -58],
                    }
                );

            myMap.geoObjects.add(myPlacemark);
            // myPlacemark.balloon.open();
        });
    }
};
