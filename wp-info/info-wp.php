
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
<?php 
$posts = get_posts( array(
	'numberposts' => 3,
	'category'    => 5,
	'orderby'     => '612,616,626',
	'order'       => 'DESC',
	'include'     => '612,608,606',
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
							<p><?php the_content(); ?></p>
							<a href="<?php echo get_permalink();?>" class="materials__btn btn">Подробнее</a>
						</div>
					</div>
				</a>	<?php 
} 
?>
<!-- =========================================================================================================================================== -->