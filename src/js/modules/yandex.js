export default () => {
    const yMap = document.querySelector('.map');

    if (yMap) {
        const $city = yMap.dataset.city;
        const $adres = yMap.dataset.adres;
        const $phone = yMap.dataset.phone;
        const $email = yMap.dataset.email;
        const data = {
            city: $city,
            adres: $adres,
            phone: $phone,
            email: $email,
        };

        ymaps.ready(function () {
            var myMap = new ymaps.Map(
                    'yamap',
                    {
                        center: [55.730533, 37.645263],
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
                    {
                        // Чтобы балун и хинт открывались на метке, необходимо задать ей определенные свойства.
                        balloonContentHeader: 'Ritualopt',
                        balloonContentBody:
                            'г. ' + data.city + ', ' + data.adres,
                        balloonContentFooter:
                            'Телефон: <a href="' +
                            data.phone +
                            '">' +
                            data.phone +
                            '</a> <br> <br> E-mail: <a href="mailto:' +
                            data.email +
                            '">' +
                            data.email +
                            '</a>',
                        hintContent: 'Ritualopt',
                    },
                    {
                        // Опции.
                        // Необходимо указать данный тип макета.
                        // iconLayout: 'default#image',
                        // Своё изображение иконки метки.
                        // iconImageHref:
                        // '/wp-content/themes/Ritualoptcraft/assets/files/icons/svg/icon--yapin.svg',
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
