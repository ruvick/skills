        <div class="block__map" id="map"></div>
        <script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script> 

        <script>
            ymaps.ready(init); 

            function init () {
                var myMap = new ymaps.Map("map", {
        // Координаты центра карты
        center:<?php echo carbon_get_theme_option('map_point') ?>,
        // Масштаб карты
        zoom: 17,
        // Выключаем все управление картой
        controls: []
      }); 

                var myGeoObjects = [];

    // Указываем координаты метки
    myGeoObjects = new ymaps.Placemark(<?php echo carbon_get_theme_option('map_point') ?>,{
                                    // hintContent: '<div class="map-hint">Авто профи, Курск, ул.Комарова, 16</div>',
                                    balloonContent: '<div class="map-hint"><?php echo carbon_get_theme_option('text_map') ?>', },{
                                    iconLayout: 'default#image',
                    // Путь до нашей картинки
                    iconImageHref:  '<?php bloginfo("template_url"); ?>/img/icons/map-marker.svg',  
                    // Размеры иконки
                    iconImageSize: [65, 65],
                    // Смещение верхнего угла относительно основания иконки
                    iconImageOffset: [-25, -100]
                  });

    var clusterer = new ymaps.Clusterer({
        clusterDisableClickZoom: false,
        clusterOpenBalloonOnClick: false,
    });
    
    clusterer.add(myGeoObjects);
    myMap.geoObjects.add(clusterer);
    // Отключим zoom
    myMap.behaviors.disable('scrollZoom');

  }
</script>

