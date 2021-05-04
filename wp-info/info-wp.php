
<!-- Подключения template-parts -->
<?php get_template_part('template-parts/header-cat');?> 
<!-- =========================================================================================================================================== -->



<!-- Подключения страниц, категорий -->
<a href="<?php echo get_permalink(25);?>">Смотреть квалификацию</a> <!-- Подключение страниц -->

<a href="<?php echo get_category_link(31);?>"> <!-- Подключение рубрик -->
<!-- =========================================================================================================================================== -->



<!-- Подключение картинок -->
<img src="<?php echo get_template_directory_uri();?>/images/bus-card.jpg" class="spacer" alt=""> <!-- Подключение картинок -->

<section class="booking-title-wrapper" style="background-image: url(<?php echo get_template_directory_uri();?>/images/mir/contact.png);">
<!-- =========================================================================================================================================== -->



<!-- Подключение логотипа -->
<?php bloginfo( 'name' ); ?> <!-- Подключение ссылки логотипа. Вставляем вместо Cлова-логотипа в ссылке. 
Чтобы клиент сам мог его менять из админки -->
<a href="#"><?php bloginfo( 'name' ); ?></a>
<!-- =========================================================================================================================================== -->


<!-- Подпись главной стр. Выводится из настроек админки -->
<title><?php wp_title(); ?></title>
<!-- =========================================================================================================================================== -->


<!-- В html файле вставляем вместо сверстанного меню код. Три разных меню. Создаются в файле functions.php -->
<!-- Меню -->
	<?php wp_nav_menu( array('theme_location' => 'menu-1','menu_class' => 'ul-clean',
		'container_class' => 'ul-clean','container' => false )); ?> 

	<?php wp_nav_menu( array('theme_location' => 'menu-2','menu_class' => 'ul-clean',
		'container_class' => 'ul-clean','container' => false )); ?>

	<?php wp_nav_menu( array('theme_location' => 'menu-3','menu_class' => 'ul-clean',
		'container_class' => 'ul-clean','container' => false )); ?>

<!-- Создание меню в файле functions.php -->
add_action( 'after_setup_theme', function(){
	register_nav_menus( [
		'menu-1' => 'Меню Товары',
		'menu-2' => 'Меню Сотрудничество',
		'menu-3' => 'Меню Доставка',
	] );
} ); 

<!-- Добавляем свой класс к пункту меню в админке -->
add_filter( 'nav_menu_css_class', 'change_menu_item_css_classes', 10, 4 );

function change_menu_item_css_classes( $classes, $item, $args, $depth ) {
  if( 3674 === $item->ID  && 'menu_main' === $args->theme_location ){
    $classes[] = 'menu__catalogy';
  }

  if( 3670 === $item->ID  && 'menu_main' === $args->theme_location ){
    $classes[] = 'menu__shares';
  }

  return $classes;
}

<!-- =========================================================================================================================================== -->



<!-- Для управления интерфейсами, телефонами, текстовыми блоками и прочими блоками из админки,
ставим плагин Redux framework -->

<!-- =========================================================================================================================================== -->




<!-- Хлебные крошки (работают с плагином breadcrumb) -->
<div class="breadcrumb breadcrumbMrBottom">
		<?php
		if(function_exists('bcn_display'))
		{
			bcn_display();
		}
		?>
	</div>
<!-- =========================================================================================================================================== -->




<!-- Постраничная навигация встроенная в WP -->
function wp_corenavi() {
  global $wp_query;
  $total = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
  $a['total'] = $total;
  $a['mid_size'] = 3; // сколько ссылок показывать слева и справа от текущей
  $a['end_size'] = 1; // сколько ссылок показывать в начале и в конце
  $a['prev_text'] = '&laquo;'; // текст ссылки "Предыдущая страница"
  $a['next_text'] = '&raquo;'; // текст ссылки "Следующая страница"

  if ( $total > 1 ) echo '<nav class="pagination">';
  echo paginate_links( $a );
  if ( $total > 1 ) echo '</nav>';
}
<!-- Код выше необходимо поместить в файл functions.php  -->
<?php if ( function_exists( 'wp_corenavi' ) ) wp_corenavi(); ?> <!-- Для того, чтобы вывести навигацию в нужном месте -->

<!-- В HTML-коде, который получается в результате вывода функции, присутствуют все необходимые CSS-классы, 
которые можно использовать для оформления любого элемента навигации  -->

<!-- css --> 
.page-numbers.current {
    background-color: #7cce45;
    color: #fff;
}
.page-numbers {
    padding: 4px 6px;
    border: 1px solid #7cce45;
    margin: 2px;
    text-align: center;
    width: 30px;
    color: #7cce45;
}
.prev.page-numbers, .next.page-numbers {
    width: auto;
}
<!-- =========================================================================================================================================== -->




<!-- Выводим свои записи в Категории -->
		<div class="materials__column d-flex">

			<?php if (have_posts()) { while (have_posts()) { the_post(); ?>

				<a href="<?php echo get_permalink();?>" class="materials__item-link">
					<div class="materials__item">
						<div class="materials__img-01">
							<picture>
								<?php echo get_the_post_thumbnail( $post->ID, "turImg", array("alt" => $post->post_title, "title" => $post->post_title));?>
							</picture>
						</div>
						<div class="materials__text">
							<h3><?php echo $post->post_title?></h3>
							<p><?php the_content(); ?></p>
							<a href="<?php echo get_permalink();?>" class="materials__btn btn">Подробнее</a>
						</div>
					</div>
				</a>

			<?php 	} //конец while
		} //конец if ?>

	</div>
<!-- =========================================================================================================================================== -->




<!-- Вывод определенных записией в любом месте -->
<!-- https://wp-kama.ru/function/get_posts#include -->
<?php 
$posts = get_posts( array(
	'numberposts' => 3,
	'category'    => 5,
	'orderby'     => 'date',
	// 'orderby'     => '612,616,626',
	'order'       => 'DESC',
	// 'include'     => '612,608,606',
	'include'     => array(),
	'exclude'     => array(),
	'meta_key'    => '',
	'meta_value'  =>'',
	'post_type'   => 'post',
	'suppress_filters' => true, // подавление работы фильтров изменения SQL запроса
) );

$result = wp_get_recent_posts( $args );

foreach( $posts as $post ){
	?>
				<a href="<?php echo get_permalink($p['ID']) ?>" class="materials__item-link">
					<div class="materials__item">
						<div class="materials__img-01">
							<picture>
								<?php echo get_the_post_thumbnail();?>
							</picture>
						</div>
						<div class="materials__text">
							<h3><?php echo $post->post_title?></h3>
							<p><?php the_excerpt(); ?></p> <!-- 55 символов -->
							<a href="<?php echo get_permalink();?>" class="materials__btn btn">Подробнее</a>
						</div>
					</div>
				</a>	<?php 
} 
?>

<?php the_excerpt(); ?> - настраиваемая функция
<!-- =========================================================================================================================================== -->




<!-- Вывод записей таксономий. Конкретной таксономии, и определнного колличества записей -->
				<div class="smart-equip__col d-flex">

        <?
           $args = array(
            'posts_per_page' => 4,
            'post_type' => 'asgproduct',
            'tax_query' => array(
              array(
                'taxonomy' => 'asgproductcat',
                'field' => 'id',
                'terms' => array(41)
              )
            )
          );
          $query = new WP_Query($args);
          
          foreach( $query->posts as $post ){
            $query->the_post();
            get_template_part('template-parts/product-loop-new');
          }  
          wp_reset_postdata();
        ?>

				</div>
<!-- =========================================================================================================================================== -->


<!-- Вывод Заголовка страницы из админки -->
		<h1 class="header-services__title">
			<?php the_title();?>
		</h1>


<!-- Вывод Заголовка категорий из админки -->
		<h1 class="header-services__title">
			<?php echo get_queried_object()->name;?>
		</h1>


<!-- Вывод текста страницы из админки -->
<?php the_content(); ?>

<!-- Вывод части текста записи из админки -->
<?php the_excerpt(); ?>
<!-- =========================================================================================================================================== -->



<!-- Добавляем разные фишки к выводу изображений. Превьюшки и т.д.-->
<!-- Ссылка - https://wp-kama.ru/function/add_theme_support -->
add_theme_support()



<!-- Установим картинку Шапки по умолчанию и дадим возможность изменять её пользователям в настройках темы -->
<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
add_theme_support( 'custom-header', array(
	'width'         => 1070,
	'height'        => 758,
	'default-image' => get_template_directory_uri() . '/img/header-02.jpg',
	'uploads'       => true,
) );
<!-- =========================================================================================================================================== -->



<!-- Позволяет регестрировать свои миниатюры изображений -->
add_image_size()
<!-- =========================================================================================================================================== -->



<!-- Добавление "Цитаты" для страниц -->
function page_excerpt() {
add_post_type_support('page', array('excerpt'));
}
add_action('init', 'page_excerpt');

Вывод на странице
		<div class="header-services-sub">
			<?php the_excerpt(); ?>
		</div>
<!-- =========================================================================================================================================== -->



<!-- Вывод хлебных крошек из плагина Yoast SEO -->
		<div class="header-copy__breadcrumb">
			<?php
			if (function_exists ('yoast_breadcrumb')) {
				yoast_breadcrumb ('<p id = "breadcrumbs">', '</p>');
			}
			?>
		</div>
<!-- ============================================================================================================================================ -->




<!-- Вывод e-mail из поля карбон -->
<a href="mailto:<? echo $mail = carbon_get_theme_option("as_email"); ?>" class="mobile-mail contact-mail"><? echo $mail; ?></a>


<!-- Вывод телефона из поля карбон -->
<a href="tel:<? echo preg_replace('/[^0-9]/', '', $tel); ?>" class="contact-tel"><? echo $tel = carbon_get_theme_option("as_phones_1"); ?></a>
<!-- ============================================================================================================================================ -->



<!-- Вывод картинки из админки страницы в шапку или в любое место -->

<!-- Создаем поле в carbon -->
Container::make('post_meta', 'resort_city', 'Доп. поля')
// ->show_on_template('page-services.php')
->add_fields(array(
  Field::make('image', 'resort_banner', 'Фото баннера')
  ->help_text( 'Изображение не менее 1070 х 758px'),
));

<!-- Пишем php-код на странице где выводим картинку -->
<?php 
	$banner = wp_get_attachment_image_src( carbon_get_the_post_meta('resort_banner'), 'full')[0];
		if(empty($banner)) {
	$banner = get_template_directory_uri() . 'img/header-01.jpg';
} ?>

<!-- Выводим картинку в img -->
	<img src="<?php echo $banner?>" alt="">

<!-- Выводим картинку фоном в блоке -->
	<div class="header-services__img" style="background-image: url(<?php echo $banner?>);"></div>
<!-- ============================================================================================================================================ -->




<!-- Яндекс карта с инд меткой и адресом из админки -->
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

.block__map {
  /* max-width: 1300px; */
  width: 100%;
  height: 600px;
}
.ymaps-2-1-77-gotoymaps__container, .ymaps-2-1-77-gototech, .ymaps-2-1-77-copyright__content, .ymaps-2-1-78-copyright__wrap, .ymaps-2-1-78-map-copyrights-promo {
    display: none !important;
}
<!-- ============================================================================================================================================ -->



<!-- Правильное подключение карты на сайт -->
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<!-- ============================================================================================================================================ -->





<!-- Валидация формы в связвке с формой отправки ниже -->
<script>
    jQuery(".form__btn").click(function(e){ 

        e.preventDefault();
        var name = $(this).siblings('input[name=name]').val();
        var email = $(this).siblings('input[name=email]').val();
        var tel = $(this).siblings('input[name=tel]').val();
        
        if((tel == "")||(tel.indexOf("_")>0)) {
            $(this).siblings('input[name=tel]').css("background-color","#ff91a4")
        } else {
            var  jqXHR = jQuery.post(
                allAjax.ajaxurl,
                {
                    action: 'send_work',        
                    nonce: allAjax.nonce,
                    name: name,
                    email: email,
                    tel: tel,
                    formsubject: jQuery(this).data("formname"),
                }   
            );
                    
            jqXHR.done(function (responce) {  //Всегда при удачной отправке переход для страницу благодарности
                document.location.href = 'http://lipskiy-konsalting.ru/stranicza-blagodarnosti/';   
            });
                    
            jqXHR.fail(function (responce) {
                alert("Произошла ошибка. Попробуйте позднее.");
            }); 

        }
    });
</script>
<!-- ============================================================================================================================================ -->




<!-- Подключение Ajax в файл function -->
<script>
// function lipsky_scripts() {
// 	wp_enqueue_style( 'lipsky-style', get_stylesheet_uri() );

// 	wp_enqueue_script( 'jquery');

// 	wp_enqueue_script( 'lipsky-inputmask', get_template_directory_uri() . '/js/jquery.inputmask.bundle.js', array(), 1.0, true );

// 	wp_enqueue_script( 'lipsky-main', get_template_directory_uri() . '/js/main.js', array(), 1.0, true );




	wp_localize_script( 'lipsky-main', 'allAjax', array( //- lipsky-main - название главного стиля js
      'ajaxurl' => admin_url( 'admin-ajax.php' ),
      'nonce'   => wp_create_nonce( 'NEHERTUTLAZIT' )
    ) );




// 	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
// 		wp_enqueue_script( 'comment-reply' );
// 	}
// }
</script>
<!-- ============================================================================================================================================ -->





<!-- Отправщик в файле fuction -->
add_action( 'wp_ajax_send_work', 'send_work' );
add_action( 'wp_ajax_nopriv_send_work', 'send_work' );

  function send_work() {
    if ( empty( $_REQUEST['nonce'] ) ) {
      wp_die( '0' );
    }
    
    if ( check_ajax_referer( 'NEHERTUTLAZIT', 'nonce', false ) ) {
      
      $headers = array(
        'From: Сайт «ЛИПСКИЙ И ПАРТНЕРЫ» <noreply@lipskiy-konsalting.ru>',
        'content-type: text/html',
      );
    
      add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
      if (wp_mail(carbon_get_theme_option( 'as_email_send' ), 'Заявка с сайта «ЛИПСКИЙ И ПАРТНЕРЫ»', '<strong>Имя:</strong> '.$_REQUEST["name"]. '<br/> <strong>E-mail:</strong> '.$_REQUEST["email"]. ' <br/> <strong>Телефон:</strong> '.$_REQUEST["tel"], $headers))
        wp_die("<span style = 'color:green;'>Мы свяжемся с Вами в ближайшее время.</span>");
      else wp_die("<span style = 'color:red;'>Сервис недоступен попробуйте позднее.</span>");
      
    } else {
      wp_die( 'НО-НО-НО!', '', 403 );
    }
  }
<!-- ============================================================================================================================================ -->





<!-- Кнопка окрашивания поля или любого присвоенного класса css -->
В carbon-filds создаем поле:
  Field::make('color', 'color_field', 'Цвет секции'),
    // ->add_class('color-section'),

В файле function.php пишем код:
function my_styles_method() {
	// #ff0000
	$color = carbon_get_the_post_meta('color_field');
	$custom_css = "  
		.services-info__g {    - <!-- присваиваем класс которому нужно изменить цвет. -->
			background: {$color} ;
		}
	";

	wp_add_inline_style( 'lipsky-style', $custom_css );
}


add_action( 'wp_enqueue_scripts', 'my_styles_method' );
<!-- ============================================================================================================================================ -->





<!-- Вывод комплексного поля. Чекбокс выбора секции с классом + рич-поле. Если чек стоит то эта секция, если нет то другая -->
<main>

	<?php	 $complex = carbon_get_post_meta( $post->ID, 'complex_field');
	if ( ! empty( $complex ) ): ?>
		<?php foreach ( $complex as $compl ): ?>


		<?php	if (!empty($compl['checkbox_pay_exc'])) {
				echo '<section id="services-info" class="services-info services-info__g">';
			}
			else {
				echo '<section id="services-info" class="services-info services-info__w">';
			}
			?> 

			<!-- <section id="services-info" class="services-info services-info__g"> -->
				<div class="container">
					<?php echo $compl['text_field'] ?>
				</div>
			</section>
		<?php endforeach; ?>
	<?php endif; ?>

</main>
<main>
<!-- ============================================================================================================================================ -->



<!-- Вывод блока. Один показываем, другой скрываем -->
jqXHR.done(function (responce) {
	jQuery(".headen_form_blk, .newButton").hide();
	jQuery('.SendetMsg').show();
});
<!-- ============================================================================================================================================ -->




<!-- Выводим текст из записи и обрезаем колличество символов -->
<!-- https://wp-kama.ru/id_31/obrezka-teksta-zamenyaem-the-excerpt.html -->
<p>
	<?php 
		$maxchar = 200;
		$text = strip_tags( get_the_excerpt() );
		echo mb_substr( $text, 0, $maxchar );
	?>
</p>
<!-- ============================================================================================================================================ -->



Отзывчивый margin
	li {
@media (max-width: 1100px) {
	margin: 0px 54px / 1170px * 100vw 0px 0px;
	}									
}
<!-- ============================================================================================================================================ -->


Выводим описание рубрики
<?php echo category_description(); ?> Любой
<?php echo category_description(3); ?> Конкретной по id
<!-- ============================================================================================================================================ -->



Создаем переменную. Если она пуста то выводим что то или ничего не выводим.
<?php
	$price_old = carbon_get_post_meta(get_the_ID(),"offer_old_price");
		if( strlen($price_old) == 0 ) { 
			//echo '	Скидки нет';
		} else if ( $price_old === 0 || $price_old === '0' ) {
			//echo '<div class="availability-order">Скидки нет</div>';
		} else {
			echo "<p class='prod-card__price-old'> $price_old руб.</p>";
		}
?>
<!-- ============================================================================================================================================ -->


!EMPTY
<!-- В комплексном поле да и не только, если у блока ничего не выводится, то не выводим этот блок -->
<? if ( !empty($item['slider_discount'])) { ?>
	<div class="info-sl__discounts">
		<? echo $item['slider_discount']; ?>
	</div>
<? } ?>

<!-- Тоже самое только переменная и не из комплексного поля -->
<? $sku = carbon_get_post_meta(get_the_ID(),"offer_sku");	
		if (!empty($sku)) { ?>
		<div class="spacer__vendor">Артикул: <span><? echo $sku; ?></span></div>
	<? } ?>

<!-- Если подзаголовок пустой, секция не выводится -->
<? if ( !empty(carbon_get_theme_option('about_home'))) { ?>
		<section id="index-title" class="index-title">
			<div class="container">
			<h1><?php echo carbon_get_theme_option('about_home_title'); ?></h1>
			<div class="index-title__subtitle">
				<?php echo carbon_get_theme_option('about_home'); ?>
			</div>

			</div>
		</section>
	<? } ?>


<!-- Выводим комплексное поле размеров чекбокса. Если ни один размер не задан, не выводим блок -->
	<? 
		$size_chart = carbon_get_the_post_meta('size_chart_complex'); 
		if($size_chart) { ?>
	
		<p>Размер</p>
		<div class="actions-block__options options d-flex">
	<?
		foreach($size_chart as $chart) { 
	?>
		<div onclick = "set_size('<? echo $chart['size_chart']; ?>')" class="option">
			<? echo $chart['size_chart']; ?>
			<input type="radio"  value="1" name="form[type]">
		</div>
	<?
		}
	?>
	</div>
	<? } ?>
<!-- ============================================================================================================================================ -->



<!-- Выводим в пунктах меню заголовки постов -->
<ul class="galery-block__menu menu-galery">
	<?php
  	global $post;
  	$args = array( 'numberposts' => -1, 'order' => 'ASC', 'offset'=> 1, 'category' => 21 );
  	$myposts = get_posts( $args );
  		foreach( $myposts as $post ){
    		setup_postdata($post);
  ?>
		<li><a href="<?php the_permalink(); ?>" 
			class="menu-galery__link"><?php the_title(); ?> (<?php echo carbon_get_post_meta(get_the_ID(),"number_img"); ?>)</a></li>
  <?php 
 					 		}
  	wp_reset_postdata();
  ?>
</ul>
<!-- ============================================================================================================================================ -->



<!-- Добавляем класс active к выбранному пункту меню -->
$(".menu-galery li a").click(function (e) {
		e.preventDefault();
		$(".menu-galery li a").removeClass('active');
		$(this).addClass('active');
	})
<!-- ============================================================================================================================================ -->



<!-- МОДАЛЬНОЕ ОКНО ============================================================================================================================= -->
<div style="display: none;">
		<div class="box-modal box-modal-new box-modal-new__cust" id="question">
			<div class="box-modal_close box-modal_close_new arcticmodal-close">X</div>
			<img src = "<?php bloginfo("template_url")?>/img/similar-01.jpg" loading="lazy"/>
			<div class = "formArctikBlk mod-zagr-tur">
				<h2>Заказать звонок <span class = 'tkName'></span></h2>
				<p>Наши специалисты свяжутся с Вами в течение 15 минут</p>  

				<form action="#" class="form-question">
					<div class = "SendetMsg" style = "display:none"> 
						Ваше сообщение успешно отправлено.
					</div>
					<div class="headen_form_blk">
						<input type = "text" name = "name" placeholder = "Имя*" id="form-question-name" class = "form-question__input input">
						<input type = "tel" name = "tel" placeholder = "Телефон*" id="form-question-tel" class = "form-question__input input">
					</div>
					<div class="callback-note mod-zagr-tur__note">Нажимая на кнопку "Отправить", вы соглашаетесь с <a class="tdu" href="<?php echo get_permalink(1312);?>">условиями обработки персональных данных</a>.</div>
					<button type="submit" class="newButton btn">Отправить</button>
				</form>

			</div>
		</div>
	</div>

<!-- CSS  -->
.box-modal-new {
  max-width: 600px;
  width: 100%;
  padding: 0;
  border-radius: 8px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.25);
  position: relative;
  min-height: 500px;
  display: flex;
  overflow: hidden;
  background: #fff;
  margin: 0 auto;
}
.box-modal_close_new {
  position: absolute;
  right: 5px;
  top: 5px;
  cursor: pointer;
  padding: 6px;
  font-size: 20px;
}
#question img {
  width: 36%;
}
.mod-zagr-tur h2 {
  font-size: 28px;
  line-height: 25px;
  margin-bottom: 30px;
}
.mod-zagr-tur p {
  margin-bottom: 35px;
  line-height: 1.2;
}
/*.mod-zagr-tur .SendetMsg {
    margin-bottom: 60px;
}*/
.SendetMsg {
  padding: 10px 0;
  text-align: center;
  font-size: 18px;
  font-weight: 600;
}
.SendetMsg:before {
  content: "";
  width: 100%;
  height: 70px;
  background-image: url("data:image/svg+xml,%3Csvg version='1.1' id='Layer_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 507.2 507.2' style='enable-background:new 0 0 507.2 507.2;' xml:space='preserve'%3E%3Ccircle style='fill:%2332BA7C;' cx='253.6' cy='253.6' r='253.6'/%3E%3Cpath style='fill:%230AA06E;' d='M188.8,368l130.4,130.4c108-28.8,188-127.2,188-244.8c0-2.4,0-4.8,0-7.2L404.8,152L188.8,368z'/%3E%3Cg%3E%3Cpath style='fill:%23FFFFFF;' d='M260,310.4c11.2,11.2,11.2,30.4,0,41.6l-23.2,23.2c-11.2,11.2-30.4,11.2-41.6,0L93.6,272.8 c-11.2-11.2-11.2-30.4,0-41.6l23.2-23.2c11.2-11.2,30.4-11.2,41.6,0L260,310.4z'/%3E%3Cpath style='fill:%23FFFFFF;' d='M348.8,133.6c11.2-11.2,30.4-11.2,41.6,0l23.2,23.2c11.2,11.2,11.2,30.4,0,41.6l-176,175.2 c-11.2,11.2-30.4,11.2-41.6,0l-23.2-23.2c-11.2-11.2-11.2-30.4,0-41.6L348.8,133.6z'/%3E%3C/g%3E%3C/svg%3E%0A");
  background-size: contain;
  background-position: center;
  background-repeat: no-repeat;
  float: left;
  margin: 10px 0;
}
.formArctikBlk {
  padding: 35px 25px 20px 25px;
}
.form-question__input {
  max-width: 300px;
  width: 100%;
  height: 40px;
  border: 2px solid #ececec;
  border-radius: 5px;
  padding: 0 15px;
  font-family: Lato;
  font-weight: 400;
  font-size: 14px;
  margin-bottom: 10px;
}
.mod-zagr-tur__note {
  margin-top: 30px;
  margin-bottom: 20px;
}
.newButton {
  width: 155px;
  height: 45px;
  cursor: pointer;
  color: #fff;
  border-radius: 10px;
}

@media (max-width: 550px) {
	.box-modal-new {
  	min-height: auto;}
}
@media (max-width: 515px) {
	#question img {
  	display: none;}
	.formArctikBlk {
    padding: 30px 15px;}
		.form-question__input {
    max-width: 100%;}
}




<!-- Отправщик из js  -->
$('.newButton').click(function (e) {

e.preventDefault();
var name = $("#form-question-name").val();
var tel = $("#form-question-tel").val();

if (jQuery("#form-question-tel").val() == "") {
	jQuery("#form-question-tel").css("border", "1px solid red");
	return;
}

// if (jQuery("#sig-inp-e").val() == ""){
// 	jQuery("#sig-inp-e").css("border","1px solid red");
// 	return;
// }

else {
	var jqXHR = jQuery.post(
		allAjax.ajaxurl,
		{
			action: 'sendphone',
			nonce: allAjax.nonce,
			name: name,
			tel: tel,
		}
	);

	jqXHR.done(function (responce) {
		jQuery(".headen_form_blk").hide();
		jQuery('.SendetMsg').show();
	});

	jqXHR.fail(function (responce) {
		alert("Произошла ошибка. Попробуйте позднее.");
	});

}
});

<!-- Открытие модального окна -->
$(".popup-quest").on('click', function (e) {
	e.preventDefault();
	jQuery(".windows_form h2").html(jQuery(this).data("winheader"));
	jQuery(".windows_form .subtitle").html(jQuery(this).data("winsubheader"));
	jQuery("#question").arcticmodal();
});

<!-- Отправщик из functions  -->
add_action( 'wp_ajax_sendphone', 'sendphone' );
add_action( 'wp_ajax_nopriv_sendphone', 'sendphone' );

  function sendphone() {
    if ( empty( $_REQUEST['nonce'] ) ) {
      wp_die( '0' );
    }
    
    if ( check_ajax_referer( 'NEHERTUTLAZIT', 'nonce', false ) ) {
      
      $headers = array(
        'From: Сайт '.COMPANY_NAME.' <'.MAIL_RESEND.'>', 
        'content-type: text/html',
      );
    
      add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
       if (wp_mail(carbon_get_theme_option( 'as_email_send' ), 'Заказ звонка', '<strong>Имя:</strong> '.$_REQUEST["name"]. ' <br/> <strong>Телефон:</strong> '.$_REQUEST["tel"], $headers))
        wp_die("<span style = 'color:green;'>Мы свяжемся с Вами в ближайшее время.</span>");
      else wp_die("<span style = 'color:red;'>Сервис недоступен попробуйте позднее.</span>"); 
      
    } else {
      wp_die( 'НО-НО-НО!', '', 403 );
    }
  }