<!-- Wordpress -->


<!-- Подключение логотипа --> 
<?php bloginfo( 'name' ); ?> <!-- Подключение ссылки логотипа. Вставляем вместо Cлова-логотипа в ссылке. 
	Чтобы клиент сам мог его менять из админки -->
	<a href="#"><?php bloginfo( 'name' ); ?></a>
	<!-- =========================================================================================================================================== -->


	<!-- Подпись главной стр. Выводится из настроек админки -->
	<title><?php wp_title(); ?></title> 
	<!-- =========================================================================================================================================== -->


	<!-- Подключения template-parts -->
	<?php get_template_part('template-parts/header-cat');?> 
	<!-- =========================================================================================================================================== -->


	<!-- Подключения страниц, категорий -->
	<a href="<?php echo get_permalink(25);?>">Смотреть квалификацию</a> <!-- Подключение страниц -->

	<a href="<?php echo get_category_link(31);?>"> <!-- Подключение рубрик -->
		<!-- =========================================================================================================================================== -->


		<!-- Подключение картинок --> 
		<img src="<?php echo get_template_directory_uri();?>/images/bus-card.jpg" class="spacer" alt="">

		<section class="booking-title-wrapper" style="background-image: url(<?php echo get_template_directory_uri();?>/images/mir/contact.png);">
			<!-- =========================================================================================================================================== -->


<!-- Вывод картинки в переменной
	Пишем php-код на странице где выводим картинку --> 
	<?php 
	$banner = wp_get_attachment_image_src( carbon_get_the_post_meta('resort_banner'), 'full')[0];
	if(empty($banner)) {
		$banner = get_template_directory_uri() . '/img/header-01.jpg';
	} ?>

	<!-- Выводим картинку в img -->
	<img src="<?php echo $banner?>" alt="">

	<!-- Выводим картинку фоном в блоке -->
	<div class="header-services__img" style="background-image: url(<?php echo $banner?>);"></div>
	<!-- ============================================================================================================================================ -->


	<!-- Добавляем разные фишки к выводу изображений. Превьюшки и т.д.-->
	<!-- Ссылка - https://wp-kama.ru/function/add_theme_support -->
	add_theme_support()
	<!-- =========================================================================================================================================== -->


	<!-- Установим картинку Шапки по умолчанию и дадим возможность изменять её пользователям в настройках темы -->
	<img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
	add_theme_support( 'custom-header', array(
	'width'         => 1070,
	'height'        => 758,
	'default-image' => get_template_directory_uri() . '/img/header-02.jpg',
	'uploads'       => true,
	) );
	<!-- =========================================================================================================================================== -->


	<!-- Позволяет регистрировать свои миниатюры изображений -->
	add_image_size()
	<!-- =========================================================================================================================================== -->


	<!-- Вывод картинки из админки страницы в шапку или в любое место -->
	<!-- Создаем поле в carbon -->
	Container::make('post_meta', 'resort_city', 'Доп. поля')
	// ->show_on_template('page-services.php')
	->add_fields(array(
	Field::make('image', 'resort_banner', 'Фото баннера')
	->help_text( 'Изображение не менее 1070 х 758px'),
	));
	<!-- ============================================================================================================================================ -->


	<!-- ТЕКСТОВЫЕ ===================================================================================================================================-->

	<!-- Вывод Заголовка страницы из админки -->
	<h1 class="header-services__title">
		<?php the_title();?>
	</h1>

	<!-- Вывод Заголовка категорий из админки -->
	<h1 class="header-services__title">
		<?php echo get_queried_object()->name;?>
	</h1>
	<!-- =========================================================================================================================================== -->


	<!-- Вывод текста страницы из админки -->
	<?php the_content(); ?>

	<!-- Вывод части текста записи из админки -->
	<?php the_excerpt(); ?>
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
	<!-- ТЕКСТОВЫЕ END ===================================================================================================================================-->


	<!-- Вывод e-mail из поля карбон -->
	<a href="mailto:<? echo $mail = carbon_get_theme_option("as_email"); ?>" class="mobile-mail contact-mail"><? echo $mail; ?></a>


	<!-- Вывод телефона из поля карбон -->
	<a href="tel:<? echo preg_replace('/[^0-9]/', '', $tel); ?>" class="contact-tel"><? echo $tel = carbon_get_theme_option("as_phones_1"); ?></a>

	<!-- Вывод из Настроек темы -->
	<?php echo carbon_get_theme_option('about_home_title'); ?>

	<!-- Вывод из текстового поля -->
	<p><?echo carbon_get_post_meta(get_the_ID(),"offer_smile_descr"); ?></p>

	<!-- Если описание не заполненно, блок не выводится -->
	<? $abouttc = carbon_get_post_meta(get_the_ID(), "about_text_center");
	if (!empty($abouttc)) { ?>
		<p class="company__tagline"><? echo $abouttc; ?></p>
	<? } ?>
	<!-- ============================================================================================================================================ -->


	<!-- Соц Сети -->
	<a href="<?php echo carbon_get_theme_option('as_insta'); ?>" class="soc-block-icon-link soc-icon-1"></a>
	<a href="<?php echo carbon_get_theme_option('as_vk'); ?>" class="soc-block-icon-link soc-icon-2"></a>
	<a href="<?php echo carbon_get_theme_option('as_telegr'); ?>" class="soc-block-icon-link soc-icon-3"></a>
	<a href="<?php echo carbon_get_theme_option('as_whatsapp'); ?>" class="soc-block-icon-link soc-icon-4"></a>
	<!-- Соц Сети END -->


	<!-- КОМПЛЕКСНЫЕ ПОЛЯ -->
	<? $team = carbon_get_theme_option('complex_team');
	if ($team) {
		$teamIndex = 0;
		foreach ($team as $item) {
			?>
			<div class="team-card__body d-flex">
				<div class="team-card__img">
					<div class="nuar_blk"></div>
					<img src="<?php echo wp_get_attachment_image_src($item['img_team'], 'large')[0]; ?>" alt="">
				</div>
				<div class="team-card__text">
					<h3><? echo $item['surname_team']; ?> <br> <? echo $item['name_team']; ?></h3>
					<p class="team-card__descp"><? echo $item['special_team']; ?></p>
				</div>
			</div>
			<?
			$teamIndex++; 
		}
	}
	?>
	<!-- КОМПЛЕКСНЫЕ ПОЛЯ END -->


	<!-- Вывод инфоблока на определенной страничке, где 7 — id нужной страницы: -->
	<?php if (is_page('7')) { ?>
		<div class="name"> текст </div>
	<?php } ?>
	<!-- https://mihalica.ru/kak-dobavit-informatsionnyiy-blok-na-opredelyonnuyu-id-stranitsu/ -->
	<!-- ================================================================================= -->


	<!-- Форматы даты и времени в WordPress -->
	<?php the_time('j F Y в H:i'); ?>

	<!-- Ссылка на разные варианты - https://wp-kama.ru/id_7433/formaty-daty-i-vremeni-v-wordpress.html -->
	<!-- =========================================================================================================================================== -->

	<!-- МЕНЮ ИЗ АДМИНКИ ==============================================================================================================================-->

	<!-- В html файле вставляем вместо сверстанного меню код. Три разных меню. Создаются в файле functions.php -->
	<?php wp_nav_menu( array('theme_location' => 'menu-1','menu_class' => 'ul-clean',
	'container_class' => 'ul-clean','container' => false )); ?> 

	<?php wp_nav_menu( array('theme_location' => 'menu-2','menu_class' => 'ul-clean',
	'container_class' => 'ul-clean','container' => false )); ?>

	<?php wp_nav_menu( array('theme_location' => 'menu-3','menu_class' => 'ul-clean',
	'container_class' => 'ul-clean','container' => false )); ?>

	<!-- Создание меню в файле functions.php -->
	add_action('after_setup_theme', function () {
		register_nav_menus([
		// 'menu_hot' => 'Меню актуальных предложений (рядом с каталогом)',
		'menu_main' => 'Меню основное',
		'menu_cat' => 'Меню каталог (в подвале)',
		'menu_company' => 'Меню о компании (в подвале)',
		// 'menu_corp' => 'Общекорпоративное меню (верхняя шапка)', 
		]);
	});


	<!-- // Добавление стилей к пунктам меню li -->
	add_filter('nav_menu_css_class', 'change_menu_item_css_classes', 10, 4);

	function change_menu_item_css_classes($classes, $item, $args, $depth)
	{
		if ($item->ID  && 'menu_cat' === $args->theme_location) {
			$classes[] = 'footer-top-wrap-list-item-sublist-item';
		}

		if ($item->ID  && 'menu_company' === $args->theme_location) {
			$classes[] = 'footer-top-wrap-list-item-sublist-item';
		}

		if ($item->ID  && 'menu_main' === $args->theme_location) {
			$classes[] = 'header-bottom-wrap-menu-item';
		}

		return $classes;
	}


	<!-- // Добавляет атрибут class к ссылке в пунктах меню menu_main -->
	add_filter('nav_menu_link_attributes', 'filter_nav_menu_link_attributes', 10, 4);
	function filter_nav_menu_link_attributes($atts, $item, $args, $depth)
	{
		if (in_array($args->theme_location, ['menu_main'])) {
			$atts['class'] = 'header-bottom-wrap-menu-item__link';

			if ($item->current) {
				$atts['class'] .= ' menu-link--active'; //активный пункт меню
			}
		}
		return $atts;
	}


	<!-- // Добавляет иконку к ссылкам меню, прикрепленное к области меню menu_main -->
	function change_menu_item_args($args)
	{
		if ($args->theme_location == 'menu_main') {
			$args->link_after = '<img src="' . get_template_directory_uri() . '/img/home/header-menu-arrow-down.svg" alt="" class="header-bottom-wrap-menu-item-down__img">';
		}

		return $args;
	}
	add_filter('nav_menu_item_args', 'change_menu_item_args');


	<!-- // Добавляем класс к submenu, прикрепленное к области меню menu_main -->
	// add_filter('nav_menu_submenu_css_class', 'change_wp_nav_menu', 10, 3);

	// function change_wp_nav_menu($classes, $args, $depth)
	// {
		// 	if ($args->theme_location == 'menu_main') {
			// 		$classes[] = 'header-bottom-wrap-menu-item-submenu';
			// 		// $classes[] = 'my-css-2';
			// 	}

			// 	return $classes;
			// }

			<!-- // Изменить css класс submenu  -->
			add_filter('nav_menu_submenu_css_class', 'change_wp_nav_menu', 10, 3);

			function change_wp_nav_menu($classes, $args, $depth)
			{
				foreach ($classes as $key => $class) {
					if ($class == 'sub-menu') {
						$classes[$key] = 'header-bottom-wrap-menu-item-submenu';
					}
				}

				return $classes;
			}
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

	<!-- ТАКСОНОМИИ =================================================================================================================================-->

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

	<!-- И еще пример -->
	<?
	$args = array(
		'posts_per_page' => 8,
		'post_type' => 'ultra',
		'tax_query' => array(
			array(
				'taxonomy' => 'ultracat',
				'field' => 'id',
				'terms' => array(3)
			)
		)
	);
	$query = new WP_Query($args);

	foreach( $query->posts as $post ){
		$query->the_post();
		get_template_part('template-parts/product-elem');
	}  
	wp_reset_postdata();
	?>

	<!-- Все посты из таксономии ultracat -->
	<div class="prod-card d-flex">
		<?
		$args = array(
			'posts_per_page' => 8,
			'post_type' => 'ultra',
			'tax_query' => array(
				array(
					'taxonomy' => 'ultracat',
					'field' => 'id',
					'terms' => 'ultracat',
				)
			)
		);
		$query = new WP_Query($args);
		foreach( $query->posts as $post ){
			$query->the_post();
			get_template_part('template-parts/product-elem');
		}  
		wp_reset_postdata();
		?>
	</div>

	<!-- Вывод дочерних таксономий конкретной таксономии -->
	<?
$termID = 10; // get_queried_object()->term_id; - динамическое получение ID текущей рубрики
$taxonomyName = "products";
$termchildren = get_term_children( $termID, $taxonomyName );

echo '<ul>';
foreach ($termchildren as $child) {
	$term = get_term_by( 'id', $child, $taxonomyName );
	echo '<li><a href="' . get_term_link( $term->term_id, $term->taxonomy ) . '">' . $term->name . '</a></li>';
}

echo '</ul>';
?>
<!-- Ссылка -  https://wp-kama.ru/function/get_term_children -->


<!-- Вывод дочерних таксономий находясь в основной таксономии. Так же выводим картинку таксономии и описание -->
<?php
$terms = get_terms('ultracat');

if ($terms && !is_wp_error($terms)) {

	foreach ($terms as $term) {

		$term_id = $term->term_taxonomy_id;
			// получим ID картинки из метаполя термина
		$image_id = get_term_meta($term_id, '_thumbnail_id', 1);
			// ссылка на полный размер картинки по ID вложения
		$image_url = wp_get_attachment_image_url($image_id, 'full');
			// Описание такосномии из админки
		$description = term_description($term_id);

		echo '<a href="' . get_term_link($term->term_id, $term->taxonomy) . '" class="catalog-list-item">
		<img src="' . $image_url . '" alt="" class="catalog-list-item__img">
		<div class="catalog-list-item-link">
		<h3 class="catalog-list-item-link__title">' . $term->name . '</h3>
		</div>
		<p class="catalog-list-item__desc">' . $description . '</p>
		<div class="catalog-list-item-link">
		<p class="catalog-list-item-link__desc">Подробнее</p>
		<img src="' . get_template_directory_uri() . '/img/home/header-arrow-right.svg" alt="" class="catalog-list-item-link__img">
		</div>
		</a>';
	}
}
?>
<!-- Вывод описания категории из админки - https://wp-kama.ru/function/category_description/comment-page-1#comments-section -->
<!-- Вывод описания таксономии из админки - https://wp-kama.ru/function/term_description -->
<!-- =========================================================================================================================================== -->
<!-- ТАКСОНОМИИ END =================================================================================================================================-->


<!-- КАТЕГОРИИ ======================================================================================================================================-->

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
	<?php } //конец while
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
	</a>	
	<?php 
} 
?>

<?php the_excerpt(); ?> - настраиваемая функция


<!-- Выводим в Основной рубрике ее дочерние рубрики с их записями и картинками -->
<?php
$parent_id = 8;
$sub_cats = get_categories(array(
	'child_of' => $parent_id,
	'order'    => 'DESC',
	'hide_empty' => 0
));
if ($sub_cats) {
	foreach ($sub_cats as $cat) {

		echo '<h2 class="points-wrap-partners__title">' . $cat->name . '</h2>
		<div class="points-wrap-partners-cards">';

		$myposts = get_posts(array(
			'numberposts' => -1,
			'category'    => $cat->cat_ID,
			'orderby'     => 'post_date',
			'order'       => 'ASC',
		));
		global $post;
		foreach ($myposts as $post) {
			setup_postdata($post);
			echo '
			<a href="' . get_permalink() . '" class="points-wrap-partners-cards-card">
			<img src=" ' . get_the_post_thumbnail_url(get_the_ID(), "tominiatyre") . ' " alt="" class="points-wrap-partners-cards-card__img">
			<p class="points-wrap-partners-cards-card__name">' . get_the_title() . '</p>
			<div class="points-wrap-partners-cards-card-link">
			<p class="points-wrap-partners-cards-card-link__desc">Подробнее</p>
			<img src="' . get_template_directory_uri() . '/img/home/header-arrow-right.svg" alt="" class="points-wrap-partners-cards-card-link__img">
			</div>
			</a>';
		}
		echo '</div>';
	}
	wp_reset_postdata();
} 
?>
<!-- Ссылка - https://wp-kama.ru/question/pomogite-s-vyivodom-kategoriy -->
<!-- =========================================================================================================================================== -->

<!-- Выводим дочерние страницы конкретной страницы по ID -->
<?php
$page_children = new WP_Query(
	array(
		'post_type' => 'page',
		'post_parent' => '162',
		'order'       => 'ASC',
	)
);
if ($page_children->have_posts()) :
	while ($page_children->have_posts()) : $page_children->the_post();
		?>
		<li class="production-wrap-cards-hidden-list-item">
			<a href="<?php the_permalink(); ?>" class="production-wrap-cards-hidden-list-item__link"><?php the_title(); ?></a>
		</li>
		<?php
	endwhile;
endif;
wp_reset_query();
?>
<!-- КАТЕГОРИИ END======================================================================================================================================-->


<!-- Скачать страницу в PDF  -->
<a href="#" class="card-wrap-properties-links-link" onclick="generatePDF();">Скачать страницу в PDF</p></a>
<!-- Скачать страницу в PDF END======================================================================================================================================-->


<!-- ВЫВОД ИЗ ПОЛЕЙ И Т.Д. ====================================================================================================================== -->

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
Field::make("checkbox", "checkbox_pay_exc", "Текст слева, Картинка справа")
->help_text('Меняет местами картинку и текст"'),
<!-- Чекбокс распологаем в комплексном поле Castom-fields -->
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


	<!-- Выводим картинку с описанием и ссылкой из админки. Если чекбокс выбран, выводим один блок, если не выбран другой -->
	<div class="promo__row d-flex">
		<?
		$prom = carbon_get_the_post_meta('promo__complex');
		if($prom) {
			$promIndex = 0;
			foreach($prom as $itemPr) {
				?>

				<?php	if (!empty($itemPr['promo_checkbox'])) {
					echo 
					"<a href='" . $itemPr['promo_link'] . "' class='promo__item'>
					<img src='" . wp_get_attachment_image_src($itemPr['promo_img'], 'full')[0] . "' class='promo__img'>
					</a>";
				}
				else {
					echo 
					"<a href='" . $itemPr['promo_link'] . "' class='promo__item'>
					<img src='" . wp_get_attachment_image_src($itemPr['promo_img'], 'full')[0] . "' class='promo__img'>
					<p class='promo__subtitle'>" . $itemPr['promo_subtitle'] . "</p>
					<div class='nuar_blk'></div>
					</a>";
				}

				?> 

				<?
				$promIndex++;
			}
		}
		?>

	</div>
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


	<!-- Выводим описание рубрики -->
	<?php echo category_description(); ?> Любой
	<?php echo category_description(3); ?> Конкретной по id
	<!-- ============================================================================================================================================ -->



	<!-- Создаем переменную. Если она пуста то выводим что то или ничего не выводим. -->
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


	<!-- !EMPTY -->
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
		<!-- ВЫВОД ИЗ ПОЛЕЙ END===========================================================================================================================-->


		<!-- КАРТА ==============================================================================================================================================-->
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

<!-- Правильное подключение карты на сайт -->
<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
<!-- КАРТА END ============================================================================================================================================ -->





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
							<!-- ============================================================================================================================================ -->

							<!-- Разные скрипты Slick слайдера -->
							// $(window).on('resize orientationchange', function () {
								// 	$('.galary-sl-big').slick('resize');
								// 	$('.galary-sl-small').slick('resize');
								// 	$('.galary-sl-big').slick('setPosition');
								// 	$('.galary-sl-small').slick('setPosition');
								// });

								// $('.galary-sl-small').slick('setPosition');

								// $(document).ready(function () {
									// 	var slider = $('.galary-sl-big').slick({
										// 		// todo
										// 	});
										// 	slider.slick('reinit');
										// });

										// $(window).on('resize orientationchange', function () {
											// 	$('.galary-sl-big').slick('resize');
											// 	$('.galary-sl-small').slick('resize');
											// });



											// $(window).on('resize', function () {
												// 	$('.galary-sl-big').slick('resize');
												// 	$('.galary-sl-small').slick('resize');
												// 	// alert('window was resized!');
												// });

												// $(".slider.slick-initialized").slick('reinit');
												// $(".slider:not(.slick-initialized)").slick(config);
												<!-- ============================================================================================================================================ -->


												<!-- Подключение галерии Lihtbox -->
												$('figure img').parent('a').attr("data-lightbox", 'gallery');
												<!-- ============================================================================================================================================ -->



<!-- На основной странице выводим дочерние страницы с Заголовками, ссылками и картинками. Указываем ID Основной страницы 
	и выводим колиичество дочерних страниц -->
	<?php $stati_children = new WP_Query(array(
		'post_type' => 'page',
		'order'       => 'ASC',
		'post_parent' => get_the_ID()
	)
);

	if($stati_children->have_posts()) :
		while($stati_children->have_posts()): $stati_children->the_post();
			echo '
			<div class="news-item">
			<a href="'.get_the_permalink().'" class="news-item__img news-item__img-work" style="background-image: url( '.get_the_post_thumbnail_url( get_the_id(), 'full' ).' )"></a>
			<div class="news-item__title">'.get_the_title().'</div>
			<div class="news-item__text"><?php echo the_excerpt();?></div>
			<div class="btn-wrap">
			<a href="'.get_the_permalink().'" class="button">Подробнее</a>
			<a href="#" class="button heating-card__btn" data-title="<?php the_title();?>">Узнать цену</a>
			</div>
			</div>';
		endwhile;
	endif; wp_reset_query();
	?>
	<!-- ============================================================================================================================================ -->


	<!-- В категории выводим посты прикремленные к ней в конкретном html коде. Картинки и нумерацию выводим из карбон полей постов из комплексного поля, через переменную. -->
	<div class="galery-block__galery-row">
		<?php global $post; 
		$args = array( 'posts_per_page' => -1, 'order' => 'ASC', 'category' => 21 );
		$myposts = get_posts( $args );
		foreach( $myposts as $post ){ setup_postdata($post);
			$galw = carbon_get_the_post_meta('galery_works');
			foreach($galw as $galw_item);
			?>
			<a href="<?php the_permalink(); ?>" class="galery-block__galery-img">
				<img src = "<?php echo wp_get_attachment_image_src($galw_item['galery_works_img'], 'full')[0];?>" />
				<div class="galery-color-block color-t-left">
					<p><?php the_title(); ?> (<?php echo carbon_get_post_meta(get_the_ID(),"number_img"); ?> фото)</p>
				</div>
			</a>
			<?php
		}
		wp_reset_postdata();
		?>
	</div>
	<!-- ============================================================================================================================================ -->



	<!-- У ссылок у которых в href только # без id их не окрашиваем, то есть не выделяем -->
	a[href^="#"]:not(a[href="#"]) {
		bacground: red;
	}
	<!-- ============================================================================================================================================ -->


	<!-- Выводим в главной таксномии Продукты все остальные таксномии -->
	<div class="archive-prod-card galery-block__galery-row prod-card">
		<?php
		$terms = get_terms( 'ultracat' );

		if( $terms && ! is_wp_error($terms) ){

			foreach( $terms as $term ) {

				$term_id = $term->term_taxonomy_id; - Выводим картинку прикрепленную в дочернюю таксономию
						// получим ID картинки из метаполя термина
				$image_id = get_term_meta( $term_id, '_thumbnail_id', 1 ); - Выводим картинку прикрепленную в дочернюю таксономию
						// ссылка на полный размер картинки по ID вложения
				$image_url = wp_get_attachment_image_url( $image_id, 'full' ); - Выводим картинку прикрепленную в дочернюю таксономию

				echo "<a href='". get_term_link( $term->term_id, $term->taxonomy ) ."' class='galery-block__galery-img'>
				<img src = '" . $image_url . "' /> - Выводим картинку прикрепленную в дочернюю таксономию
				<div class='galery-color-block color-t-left'>
				<p class = 'title'>". $term->name ."</p>
				</div>
				</a>";

			}

		}
		?>
	</div>

	<!-- Чтобы в категориях и таксономиях появилась возможность добавления картинки, в файле function.php пишем след код. -->
	/**
	* Возможность загружать изображения для элементов указанных таксономий: категории, метки.
	*
	* Пример получения ID и URL картинки термина:
	* $image_id = get_term_meta( $term_id, '_thumbnail_id', 1 );
	* $image_url = wp_get_attachment_image_url( $image_id, 'thumbnail' );
	*
	* @author: Kama (http://wp-kama.ru)
	*
	* @ver: 2.8
	*/
	if( is_admin() && ! class_exists('Term_Meta_Image') ) {
		// init
		//add_action('current_screen', 'Term_Meta_Image_init');
		add_action('admin_init', 'Term_Meta_Image_init');
		function Term_Meta_Image_init() {
			$GLOBALS['Term_Meta_Image'] = new Term_Meta_Image();
		}

		class Term_Meta_Image {

			// для каких таксономий включить код. По умолчанию для всех публичных
			static $taxes = Array(); // пример: array('category', 'post_tag');

			// название мета ключа
			static $meta_key = '_thumbnail_id';

			// URL пустой картинки
			static $add_img_url = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkAQMAAABKLAcXAAAABlBMVEUAAAC7u7s37rVJAAAAAXRSTlMAQObYZgAAACJJREFUOMtjGAV0BvL/G0YMr/4/CDwY0rzBFJ704o0CWgMAvyaRh+c6m54AAAAASUVORK5CYII=';

			public function __construct() {
				if ( isset($GLOBALS['Term_Meta_Image']) ) 
				return $GLOBALS['Term_Meta_Image']; // once

				$taxes = self::$taxes ? self::$taxes : get_taxonomies( Array( 'public'=>true ), 'names' );

				foreach ( $taxes as $taxname ) {
					add_action("{$taxname}_add_form_fields",   Array( & $this, 'add_term_image' ),     10, 2 );
					add_action("{$taxname}_edit_form_fields",  Array( & $this, 'update_term_image' ),  10, 2 );
					add_action("created_{$taxname}",           Array( & $this, 'save_term_image' ),    10, 2 );
					add_action("edited_{$taxname}",            Array( & $this, 'updated_term_image' ), 10, 2 );

					add_filter("manage_edit-{$taxname}_columns",  Array( & $this, 'add_image_column' ) );
					add_filter("manage_{$taxname}_custom_column", Array( & $this, 'fill_image_column' ), 10, 3 );
				}
			}

			## поля при создании термина
			public function add_term_image( $taxonomy ) {
				wp_enqueue_media(); // подключим стили медиа, если их нет

				add_action('admin_print_footer_scripts', array( & $this, 'add_script' ), 99 );
				$this->css(); ?>
				<div class="form-field term-group">
					<label><?php _e('Image', 'default'); ?></label>
					<div class="term__image__wrapper">
						<a class="termeta_img_button" href="#">
							<img src="<?php echo self::$add_img_url ?>" alt="">
						</a>
						<input type="button" class="button button-secondary termeta_img_remove" value="<?php _e( 'Remove', 'default' ); ?>" />
					</div>

					<input type="hidden" id="term_imgid" name="term_imgid" value="">
				</div>
				<?php
			}

			## поля при редактировании термина
			public function update_term_image( $term, $taxonomy ) {
					wp_enqueue_media(); // подключим стили медиа, если их нет

					add_action('admin_print_footer_scripts', array( & $this, 'add_script' ), 99 );

					$image_id = get_term_meta( $term->term_id, self::$meta_key, true );
					$image_url = $image_id ? wp_get_attachment_image_url( $image_id, 'thumbnail' ) : self::$add_img_url;
					$this->css();
					?>
					<tr class="form-field term-group-wrap">
						<th scope="row"><?php 
						_e( 'Image', 'default' ); 
					?></th>
					<td>
						<div class="term__image__wrapper">
							<a class="termeta_img_button" href="#">
								<?php echo '<img src="'. $image_url .'" alt="">'; ?>
							</a>
							<input type="button" class="button button-secondary termeta_img_remove" value="<?php _e( 'Remove', 'default' ); ?>" />
						</div>
						<input type="hidden" id="term_imgid" name="term_imgid" value="<?php echo $image_id; ?>">
					</td>
				</tr>
				<?php
			}

			public function css() {
				?>
				<style>
					.termeta_img_button{ display:inline-block; margin-right:1em; }
					.termeta_img_button img{ display:block; float:left; margin:0; padding:0; min-width:100px; max-width:150px; height:auto; background:rgba(0,0,0,.07); }
					.termeta_img_button:hover img{ opacity:.8; }
					.termeta_img_button:after{ content:''; display:table; clear:both; }
				</style>
				<?php
			}

			## Add script
			public function add_script() {
					// выходим если не на нужной странице таксономии
					//$cs = get_current_screen();
					//if( ! in_array($cs->base, array('edit-tags','term')) || ! in_array($cs->taxonomy, (array) $this->for_taxes) )
					//  return;

				$title = __('Featured Image', 'default');
				$button_txt = __('Set featured image', 'default');
				?>
				<script>
					jQuery(document).ready(function($) {
						var frame,
						$imgwrap = $('.term__image__wrapper'),
						$imgid   = $('#term_imgid');

									// добавление
									$('.termeta_img_button').click(function(ev) {
										ev.preventDefault();

										if ( frame ) { 
											frame.open(); 
											return; 
										}

											// задаем media frame
											frame = wp.media.frames.questImgAdd = wp.media({
												states: [
												new wp.media.controller.Library({
													title:    '<?php echo $title ?>',
													library:   wp.media.query({ type: 'image' }),
													multiple: false,
																	//date:   false
																})
												],
												button: {
													text: '<?php echo $button_txt ?>', // Set the text of the button.
												}
											});

									// выбор
									frame.on('select', function() {
										var selected = frame.state().get('selection').first().toJSON();
										if ( selected ) {
											$imgid.val( selected.id );
											$imgwrap.find('img').attr('src', selected.sizes.thumbnail.url );
										}
									});

									// открываем
									frame.on('open', function() {
										if ( $imgid.val() ) 
											frame.state().get('selection').add( wp.media.attachment( $imgid.val() ) );
									});

									frame.open();
								});

							// удаление
							$('.termeta_img_remove').click(function() {
								$imgid.val('');
								$imgwrap.find('img').attr('src','<?php echo self::$add_img_url ?>');
							});
						});
					</script>

					<?php
				}

			## Добавляет колонку картинки в таблицу терминов
				public function add_image_column($columns) {
					// подправим ширину колонки через css
					add_action('admin_notices', function() {
						echo '<style>.column-image{ width:50px; text-align:center; }</style>';
					});

					$num = 1; // после какой по счету колонки вставлять

					$new_columns = Array( 'image' => '' ); // колонка без названия...

					return array_slice( $columns, 0, $num ) + $new_columns + array_slice( $columns, $num );
				}

				public function fill_image_column( $string, $column_name, $term_id ) {
					// если есть картинка
					if ( $image_id = get_term_meta( $term_id, self::$meta_key, 1 ) )
						$string = '<img src="' . wp_get_attachment_image_url( $image_id, 'thumbnail' ) .'" width="50" height="50" alt="" style="border-radius:4px;" />';

					return $string;
				}

			## Save the form field
				public function save_term_image( $term_id, $tt_id ) {
					if ( isset($_POST['term_imgid']) && $image = (int) $_POST['term_imgid'] )
						add_term_meta( $term_id, self::$meta_key, $image, true );
				}

			## Update the form field value
				public function updated_term_image($term_id, $tt_id) {
					if ( !isset($_POST['term_imgid']) )
						return;

					if ( $image = (int) $_POST['term_imgid'] )
						update_term_meta($term_id, self::$meta_key, $image);
					else
						delete_term_meta($term_id, self::$meta_key);
				}

			}
		}
// ============================================================================================================================================

// Выводим дочерние категории кастомной таксономии
		<?php
		$terms = get_terms(
			array(
				'taxonomy'   => 'ultracat',
				'hide_empty' => true,
				'pad_counts'  => true,
				'orderby' => 'count',
				'order' => 'DESC',
			)
		);

		if ( ! empty( $terms ) && is_array( $terms ) ) {
			echo '<ul class="list-my_taxonomy">';
			foreach ( $terms as $term ) { ?>
				<li>
					<a href="<?php echo esc_url( get_term_link( $term ) ) ?>">
						<?php echo $term->name; ?> (<?php echo $term->count; ?>)
					</a>
				</li>
				<?php
			}
			echo '</ul>';
		}
		?>

		<!-- Тоже самое только с подсветкой выбранного пункта -->
		<?php
		$terms = get_terms(
			array(
				'taxonomy'   => 'my_taxonomy',
				'hide_empty' => true,
				'pad_counts'  => true,
				'orderby' => 'count',
				'order' => 'DESC',
			)
		);

		if ( ! empty( $terms ) && is_array( $terms ) ) {
			echo '<ul class="sidebar-offer_cat">';
			foreach ( $terms as $term ) {
				$curTerm = $wp_query->queried_object;
				$class = ( $term->name == $curTerm->name ) ? 'active' : '';
				?>

				<li class="<?php echo $class; ?>">
					<a href="<?php echo esc_url( get_term_link( $term ) ) ?>">
						<?php echo $term->name; ?>
					</a>
				</li>

				<?php
			}
			echo '</ul>';
		}
		?>

		<!-- Выводим дочерние категории конкретной кастомной таксономии -->
		<?php
		$terms = get_terms(
			array(
				'taxonomy'   => 'ultracat',
				'child_of' => 13,
				'hide_empty' => true,
				'pad_counts'  => true, 
				'orderby' => 'count',
				'order' => 'ASC',
			)
		);

		if ( ! empty( $terms ) && is_array( $terms ) ) {
			foreach ( $terms as $term ) { ?>
				<li>
					<a href="<?php echo esc_url( get_term_link( $term ) ) ?>">
						<?php echo $term->name; ?>
					</a>
				</li>
				<?php
			}
		}
		?>
		<!-- ============================================================================================================================================ -->

		<!-- Находясь в конкретной таксономии, выводим ее дочернии таксономии -->
		<div class="main-page__filter d-flex">
<?php $termID =  get_queried_object()->term_id;// - динамическое получение ID текущей рубрики
$taxonomyName = "ultracat";
$termchildren = get_term_children( $termID, $taxonomyName );

foreach ($termchildren as $child) { 
	$term = get_term_by( 'id', $child, $taxonomyName );
	echo '<a href="' . get_term_link( $term->term_id, $term->taxonomy ) . '" class="main-page__btn btn <?php echo $class; ?>">' . $term->name . '</a>';
}

?>
</div>
<!-- ============================================================================================================================================ -->

<!-- Выводим дочернии категории, основной категории 6 -->
<?php wp_list_categories( array('child_of' => 6, 'hide_empty'=> 0, 'title_li' => '') ); ?>
// ============================================================================================================================================


<!-- Для управления интерфейсами, телефонами, текстовыми блоками и прочими блоками из админки, -->
<!-- ставим плагин Redux framework -->
===========================================================================================================================================


<!-- Отправка страницы на печать -->
<main onload="printit()" class="main">
	Содержимое для печати
</main>

<a href="#" class="card-wrap-properties-links-link" onclick="printit()">Распечатать страницу</p></a>

function printit() {
	if (window.print) {
		window.print();
	} else {
		var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
		document.body.insertAdjacentHTML('beforeEnd', WebBrowser);
		WebBrowser1.ExecWB(6, 2);//Use a 1 vs. a 2 for a prompting dialog box WebBrowser1.outerHTML = ""; 
	}
}
<!-- =========================================================================================================================================== -->

// Выводим страницу по ключу https://bestatmosfera.ru/?show=1
<? if (empty($_REQUEST["show"])) {?>
	<main class="page">	
		<section id="about-full" class="about-full">
			<div class="container">
				<div class="about-full__img">
					<img src="<?php echo get_template_directory_uri();?>/img/logo.svg" alt="">
					<h1>Сайт в разработке!</h1>
				</div>
			</div>
		</section>  
	</main>

<? } else { ?>
	<!-- =========================================================================================================================================== -->


	<!-- Отправка файла на почту -->
	<!-- Обязательно создаем папку uploads !!!-->
	<!-- HTML -->
	<div class="popup__form-input input">
		<input type="file" name="file" onchange = 'fileloadname(this)' data-lbame = "file-path-name1" multiple="multiple" accept=".txt,image/*" id="input__file" class="popup__input-file popup__input-file_hiden"> 
		<label for="input__file" class="popup__input-file-button">
			<span class="popup__input-file-text" id = "file-path-name1">Загрузите файл</span>
		</label>
	</div>
	<input name = "filleserv" type="hidden" id="file-path-serv" value = "">
	<button class="popup__form-btn projectBtn btn">Отправить заявку</button> 

	<!-- JS -->
<script>
// Вытаскиваем название файла
function fileloadname(elem) {
  let fn = jQuery(elem).prop('files')[0].name;
  console.log(fn);
  let name = jQuery(elem).data("lbame");
  jQuery("#"+name).html(fn);
}

// Валидация + отправщик файла Проект
$('.projectBtn').click(function(e){  
  e.preventDefault();
  
  var nameProject = $("#form-project-name").val(); 
  var telProject = $("#form-project-tel").val();  
  let prfile = jQuery('#input__file').prop('files');
  console.log(prfile);
  var designFile = (prfile != undefined)?prfile[0]:"";

  if (jQuery("#form-project-tel").val() == ""){
    jQuery("#form-project-tel").css("border","1px solid red"); 
    return;
  }

  else {
    var params = new FormData();
      params.append('action', 'sendproject');
      params.append('nonce', allAjax.nonce);
      params.append('name', nameProject);
      params.append('tel', telProject);
      params.append('design', designFile);

      var  jqXHR = jQuery.ajax({      
        url: allAjax.ajaxurl,
        dataType: 'text',
        cache: false,
        contentType: false,
        processData: false,
        data: params, 
        type: 'post'    
      });

        jqXHR.done(function (responce) {
          jQuery(".popup-project .headen_form_blk").hide();
          jQuery('.popup-project .SendetMsg').show();
        });

            jqXHR.fail(function (response) {
              alert("Произошла ошибка. Попробуйте позднее."); 
        }); 

     }
});
</script>

<!-- Отправщик function -->
<?

add_action( 'wp_ajax_sendproject', 'sendproject' );
add_action( 'wp_ajax_nopriv_sendproject', 'sendproject' );

  function sendproject() {
    if ( empty( $_REQUEST['nonce'] ) ) {
      wp_die( '0' );
    }
    
    if ( check_ajax_referer( 'NEHERTUTLAZIT', 'nonce', false ) ) {
      
      $headers = array(
        'From: Сайт '.COMPANY_NAME.' <'.MAIL_RESEND.'>', 
        'content-type: text/html',
      );
    
	  $uploaddir = __DIR__.'/uploads/';
	  $uploadfile = $uploaddir . basename($_FILES['design']['name']);
	  $attach = "";	

	  if (move_uploaded_file($_FILES['design']['tmp_name'], $uploadfile)) 
			$attach = $uploadfile;

      add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));
       if (wp_mail(carbon_get_theme_option( 'mail_to_send' ), 'Заявка с формы: «Проект на расчет»', '<strong>Имя:</strong> '.$_REQUEST["name"]. ' <br/> <strong>Телефон:</strong> '.$_REQUEST["tel"], $headers,$attach));
      else 
	  	wp_die(json_encode(array("send" => false)));

    } else {
      wp_die( 'НО-НО-НО!', '', 403 );
    }
  }

  ?>
	<!-- =========================================================================================================================================== -->
