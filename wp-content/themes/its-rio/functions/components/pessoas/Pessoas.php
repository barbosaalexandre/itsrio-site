<?php
class Pessoas extends ET_Builder_Module {

	function init() {
		$this->name = esc_html__( 'ITS - Pessoas', 'et_builder' );
		$this->slug = 'et_pb_pessoas';
		$this->fb_support = true;

		$this->whitelisted_fields = ['title','excerpt'];

		$this->fields_defaults = [];

		$this->main_css_element = '%%order_class%% .et_pb_post';
	}

	function get_fields() {
		$fields = array(
			'title' => array(
				'label'             => esc_html__( 'Título', 'et_builder' ),
				'type'              => 'text',
				),
			'excerpt' => array(
				'label'             => esc_html__( 'Texto (opcional)', 'et_builder' ),
				'type'              => 'text',
				),
			);
		return $fields;
	}

	function shortcode_callback( $atts, $content = null, $function_name ) {
		global $wp_filter;
		global $paged;
		global $post;
		global $title;
		global $data;
		global $components;

		$moduleTitle = $this->shortcode_atts['title'];
		$moduleExcerpt = $this->shortcode_atts['excerpt'];

		$data['its_tabs'][] = $moduleTitle;

		$wp_filter_cache = $wp_filter;
		$meta = get_post_meta(get_the_ID());

		$ids = $meta['its_pessoas'];
		$cats = [];
		$listaCategorizada = false;

		$query_palestrantes = get_posts(['post_type' => 'pessoas', 'post__in' => $ids ]);

		foreach ($query_palestrantes as $postt) {
			$p = (array)$postt;
			$cat = get_the_category($p['ID']);
			if(!$cat)
				$cats[] =  array(
					'ID' => $p['ID'],
					'title' => $p['post_title'],
					'content' => $p['post_content'],
					'thumb' => get_the_post_thumbnail_url($p['ID']),
					);

			foreach($cat as $c){
				$cc = (array)$c;
				$listaCategorizada = true;
				$cats[$cc['name']]['pessoaActive'] = '';

				$cats[$cc['name']][] = array(
					'ID' => $p['ID'],
					'title' => $p['post_title'],
					'content' => $p['post_content'],
					'thumb' => get_the_post_thumbnail_url($p['ID']) 
					);
			}		
		}
		$cats['pessoaActive'] = '';
		$components['pessoas'] = $cats;


		ob_start();

		if($listaCategorizada)
			include(__DIR__.'/view_pessoas_cat.php');
		else
			include(__DIR__.'/view_pessoas.php');

		$output = ob_get_contents();

		ob_end_clean();

		$wp_filter = $wp_filter_cache;
		unset($wp_filter_cache);

		wp_reset_postdata();

		return $output;
	}
}

new Pessoas;