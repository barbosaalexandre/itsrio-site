<?php
class Aula extends ET_Builder_Module {

	function init() {
		$this->name = esc_html__( 'ITS - Aula', 'et_builder' );
		$this->slug = 'et_pb_aula';
		$this->fb_support = true;

		$this->whitelisted_fields = ['title', 'subtitle','palestrante','data','content'];

		$this->fields_defaults = array(
			'title' => ['', 'add_default_setting'],
			'subtitle' => ['', 'add_default_setting'],
			'palestrante' => ['', 'add_default_setting'],
			'data' => ['', 'add_default_setting'],
			'content' => ['', 'add_default_setting'],
			);

		$this->main_css_element = '%%order_class%% .et_pb_post';
	}

	function get_fields() {
		$palestrantes = [];
		$query_palestrantes = new WP_Query([
			'post_type' => 'palestrantes'
			]);

		while ($query_palestrantes->have_posts()) {
			$query_palestrantes->the_post();
			$palestrantes[get_the_ID()] = esc_html__( get_the_title(), 'et_builder' );
		}


		$fields = array(
			'title' => array(
				'label'             => esc_html__( 'Título', 'et_builder' ),
				'type'              => 'text',
				),
			'subtitle' => array(
				'label'             => esc_html__( 'Subtítulo', 'et_builder' ),
				'type'              => 'text',
				),
			'data' => array(
				'label'             => esc_html__( 'Data e Hora', 'et_builder' ),
				'type'              => 'text',
				),
			'palestrante' => array(
				'label'             => esc_html__( 'Palestrante', 'et_builder' ),
				'type'              => 'select',
				'options'         => $palestrantes
				),
			'content' => array(
				'label'             => esc_html__( 'Conteúdo', 'et_builder' ),
				'type'              => 'tiny_mce',
				),
			);
		return $fields;
	}

	function shortcode_callback( $atts, $content = null, $function_name ) {
		global $wp_filter;
		global $paged;
		global $post;
		global $aulas;
		global $data;

		$wp_filter_cache = $wp_filter;
		$title = $this->shortcode_atts['title'];
		$subtitle = $this->shortcode_atts['subtitle'];
		$palestrante = $this->shortcode_atts['palestrante'];
		$date = $this->shortcode_atts['data'];
		$content   = wpautop($this->shortcode_atts['content']);

		$aulas[] = compact('title', 'subtitle', 'palestrante', 'date', 'content');

		if(!isset($data['its_tabs'])){
			$data['its_tabs'][] = 'aulas';
			ob_start();
			include(__DIR__.'/view_aula.php');
			$output = ob_get_contents();
			ob_end_clean();
		}
		else
			$data['its_tabs'][] = !in_array('aulas', $data['its_tabs']) ? 'aulas' : '';


		if(!in_array('aulas', $data['its_tabs']))
			$data['its_tabs'][] = 'aulas';

		$palestrante = new WP_Query( ['p' => $palestrante, 'post_type' => 'palestrantes'] );
		$palestrante->have_posts();
		$palestrante->the_post();
		$palestrante = get_the_title();
		
		$wp_filter = $wp_filter_cache;
		unset($wp_filter_cache);

		return $output;
	}
}

new Aula;
