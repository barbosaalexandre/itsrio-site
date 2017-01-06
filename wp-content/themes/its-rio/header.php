<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?php wp_head(); ?>

	<script src="https://use.fontawesome.com/cb38949964.js"></script>
	<link rel="stylesheet" href="<?= esc_url_raw('/wp-content/themes/its-rio/assets/css/its.css') ?>">
	<link rel="stylesheet" href="<?= esc_url_raw('/wp-content/themes/its-rio/assets/css/flickity.css') ?>">

</head>
<body <?php body_class(); ?>>
	<div id="content_all">
		<?php
		global $postType;
		global $titles; 
		global $lang; 

		$postType = get_post_type() ? get_post_type() : $wp_query->query['post_type'];

		$titles = [
		'cursos_ctp' => 	['gender' => 'o', 'plural' => 'cursos', 'singular' => 'curso'],
		'varandas_ctp' => 	['gender' => 'a', 'plural' => 'varandas', 'singular' => 'varanda'],
		'projetos_ctp' => 	['gender' => 'o', 'plural' => 'projetos', 'singular' => 'projeto'],
		'publicacoes_ctp' =>['gender' => 'a', 'plural' => 'publicações', 'singular' => 'publicação'],
		'comunicados_ctp' =>['gender' => 'a', 'plural' => 'acontece', 'singular' => 'acontece'],
		'page' =>['gender' => 'o', 'plural' => 'institucionais', 'singular' => 'institucional']
		];

		global $title;
		$title = $titles[$postType];


	/*if(is_front_page()){
		?>
		<div class="home-cover" v-html="home_cover"></div>
		<?php
	}*/
	?>

	<div class="row row-menu fixed">
		<div class="column large-12 menu-container">
			<i class="fa fa-bars hide-for-large"></i>
			<?php if(is_front_page()){ ?>
			<h1><a href="/"><img src="<?= get_template_directory_uri() ?>/assets/images/logo-home.svg" alt="ITS - Instituto de Tecnologia e Sociedade do Rio" class="logo"></a></h1>
			<?php } else { ?>
			<h1><a href="/"><img src="<?= get_template_directory_uri() ?>/assets/images/logo.svg" alt="ITS - Instituto de Tecnologia e Sociedade do Rio" class="logo"></a></h1>
			<?php } ?>
			<div class="menu-social show-for-large" >
				<ul>
					<li>
						<a href="#"><i class="fa fa-youtube-play"></i></a>
					</li>
					<li>
						<a href="#"><i class="fa fa-twitter"></i></a>
					</li>
					<li>
						<a href="#"><i class="fa fa-facebook"></i></a>
					</li>
					<li>
						<a href="#"><i class="fa fa-instagram"></i></a>
					</li>
					<li>
						<a href="#"><i class="fa fa-medium"></i></a>
					</li>
					<li class="text">
						<a href="/pt/home" <?= $lang == 'pt_br' ? 'class="selected"' : '' ?>>português</a> 
						| 
						<a href="/en/en-home" <?= $lang == 'en_us' ? 'class="selected"' : '' ?>> inglês</a>
					</li>
				</ul>
			</div>
			<nav class="menu-nav show-for-large">
				<ul>
					<?php wp_nav_menu('main') ?>
					<!-- <li class="<?= $postType == 'cursos_ctp' ? 'selected' : '' ?>">
						<a href="/cursos_ctp">cursos</a>
					</li>
					<li class="<?= $postType == 'varandas_ctp' ? 'selected' : '' ?>">
						<a href="/varandas_ctp">varandas</a>
					</li>
					<li>
						<a href="#">projetos</a>
					</li>
					<li>
						<a href="#">publicações</a>
					</li>
					<li>
						<a href="#">institucional</a>
					</li> -->
				</ul>
			</nav>
			<i class="search-button fa fa-search" onclick="jQuery('.search-box').removeClass('hide');"></i>
		</div>
	</div>

	<div class="search-box hide"> <!-- v-bind:class="{ 'hide' : search.query == false }" -->
		<div class="row">
			<div class="column large-12">
				<button class="close-button" onclick="jQuery('.search-box').addClass('hide');">fechar <span class="icon">&times;</span></button>
				<label class="search-label" for="search">
					<h2>buscar por:</h2>
					<input type="text" id="search" placeholder="digite sua palavra-chave">
					<button class="search-button"><i class="fa fa-search" aria-hidden="true"></i></button>
				</label>

				<div class="filter-options">
					<h2>filtragem de conteúdo:</h2>

					<div class="filter">
						<h3 class="list-title" style="display: block; width: 100%;">
							área
							<div class="line"></div>
						</h3>
						<input type="checkbox" id="search_title_area" class="ocultar">
						<label class="label-tab" for="search_title_area"></label>
						<div style="overflow: hidden; width: 100%;"> 
							<input type="checkbox" id="search_cursos" name="search_area">
							<label for="search_cursos" class="box">cursos</label>

							<input type="checkbox" id="search_varandas" name="search_area">
							<label for="search_varandas" class="box">varandas</label>

							<input type="checkbox" id="search_projetos" name="search_area">
							<label for="search_projetos" class="box">projetos</label>

							<input type="checkbox" id="search_publicações" name="search_area">
							<label for="search_publicações" class="box">publicações</label>
						</div>
						
					</div>
					<div class="filter">
						<h3 class="list-title" style="display: block; width: 100%;">
							linhas de pesquisa
							<div class="line"></div>
						</h3>
						<input type="checkbox" id="search_title_area" class="ocultar">
						<label class="label-tab" for="search_title_area"></label>
						<div style="overflow: hidden; width: 100%;"> 
							<input type="checkbox" id="direito-tecnologia">
							<label for="direito-tecnologia" class="box">direito e tecnologia</label>

							<input type="checkbox" id="repensando-inovacao">
							<label for="repensando-inovacao" class="box">repensando inovação</label>

							<input type="checkbox" id="educacao">
							<label for="educacao" class="box">educação</label>
						</div>
					</div>
					<div class="filter">
						<h3 class="list-title" style="display: block; width: 100%;">
							categorias de assunto
							<div class="line"></div>
						</h3>
						<input type="checkbox" id="search_title_area" class="ocultar">
						<label class="label-tab" for="search_title_area"></label>
						<div style="overflow: hidden; width: 100%;"> 
							<input type="checkbox" id="lorem-ipsum">
							<label for="lorem-ipsum" class="box">lorem ipsum</label>
						</div>
					</div>
				</div>

				<button class="button large advanced-search">busca avançada 
					<i class="fa fa-angle-up" aria-hidden="true"></i>
					<!--<i class="fa fa-angle-down" aria-hidden="true"></i>-->
				</button>
			</div>
		</div>
	</div>

	<div id="content">
