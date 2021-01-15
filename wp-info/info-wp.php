
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
