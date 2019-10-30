<?php
//
class Unity3_Audio extends Unity3_Post_Group {

	protected $field_audio = 'audio';

	public function __construct( ) {
		parent::__construct('unity3_audio', 'Audio File', 'Audio Files');

		$this->mergeSettings( array(
			'post' => array(
				'menu_icon'     => 'dashicons-controls-volumeon',
				'menu_title'    => 'Audio',
			),
			'group_rewrite' => array(
				'base' => 'audio'
			),
			'audio' => array( 'sync_meta' => true ),
			'block' => array(
				'description' => 'Displays audio from a particular group',
				'icon'        => 'controls-volumeon',
				'keywords'    => array('audio', 'audio group')
			)
		));
	}

	public function Name() {
		return 'Audio';
	}

	public function Init() {
		parent::Init();

		//The client should be a be paying for the audio add-on package
		add_filter( 'upload_mimes',  array( &$this, 'unity3_aws_storage_mime'), 12, 1 );
		add_shortcode('unity3_audio', array(&$this, 'shortcode') );

		if ( $this->settings['audio']['sync_meta'] )
			add_filter( 'acf/update_value/key=field_5d3b597197c47', array(&$this, 'sync_acf_audio_field'), 10, 3 );

		//Genesis integration
		add_action( 'genesis_entry_content',  'unity3_audio_do_genesis_attachment' );
	}

	function sync_acf_audio_field($value, $post_id, $field) {
		//update the attachment with the details from it's parent post
		if ($attachment = get_post( $value )) {
			$post = get_post($post_id);
			wp_update_post(array(
				'ID'         => $attachment->ID,
				'post_title' => $post->post_title,
				'post_excerpt' => $post->post_excerpt,
				'post_content' => $post->post_content
			));

			$meta = wp_get_attachment_metadata( $attachment->ID );

			if ( empty($meta['artist']) && isset($this->settings['audio']['artist']) )
				$meta['artist'] = $this->settings['audio']['artist'];
			if ( empty($meta['album']) && isset($this->settings['audio']['album']) )
				$meta['album'] = $this->settings['audio']['album'];

			wp_update_attachment_metadata( $attachment->ID, $meta );
		}

		return $value;
	}

	function renderBlock( $block ) {
		return $this->shortcode( array(
			'group' => $block['data']['group'],
			'group_field' => 'term_id',
			'max' => $block['data']['max'],
			'is_admin_block' => false,
		));
	}

	function renderAdminBlock( $block, $content, $is_preview, $post_id ) {

		$term = get_term( get_field( 'group' ), $this->GetTaxonomy());
		
		if ($term instanceof WP_Term) {
			echo $this->shortcode( array(
				'group' => $term->slug,
				'group_field' => 'slug',
				'max' => get_field('max'),
				'is_admin_block' => true,
				'artists' => false
			));
		}
	}

	public function shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'post' => '',
			'max'  => '1',
			'group' => '',
			'group_field' => 'slug',
			'show_title' => 'true',
			'more_link' => 'true',
			'playlist' => '',
			'artists' => false,
			'images' => false,
			'is_admin_block' => true,
		), $atts );


		$post = null;
		$args = array(
			'post_type'      => $this->GetPostType(),
			'numberposts' => $atts['max'],
			'orderby'        => 'date',
			'order'          => 'DESC',
		);


		//Get the latest post in the specified group...
		if ( isset($atts['group']) && !empty($atts['group']) ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => $this->GetTaxonomy(),
					'field' => $atts['group_field'],
					'terms' => $atts['group']
				)
			);
		}

		if ( isset($atts['post']) && !empty($atts['post']) ) {
			$args['post__in'] = $atts['post'];
		}

		//get the post...
		$posts = get_posts( $args );

		if (isset($posts) && count($posts) ) {

			if (1 == $atts['max']) {
				return $this->do_single_audio($posts[0], $atts);
			} else if ( isset($atts['is_admin_block']) && true == $atts['is_admin_block'] ) {
				return $this->do_playlist_block_admin( $posts, $atts );
			} else {
				return $this->do_playlist_audio( $posts, $atts );
			}
		}

		return '';
	}

	private function do_single_audio( $post,  $atts ) {
		$post = get_post( $post );
		$post_id = $post->ID;
		//$field = get_field('audio', $post_id);
		$attachment_id = get_post_meta($post_id, 'audio', true);

		$attr = array(
			'src'      => wp_get_attachment_url( $attachment_id ),
			'loop'     => '',
			'autoplay' => '',
			'preload'  => 'none',
			'style'    => 'light'
		);

		$title = '';
		if ( isset($atts['show_title']) && 'true' == $atts['show_title'] ) {
			$title = '<h2>' . get_the_title( $post_id ) . '</h2>';
		}

		return '<div class="unity3_audio">' . $title . wp_audio_shortcode( $attr ) . '</div>';
	}

	private function do_playlist_audio( $posts,  $atts ) {

		$ids = array();
		foreach ( $posts as $post ) {
			$ids[] = get_post_meta( $post->ID, 'audio',true );
		}

		$output = wp_playlist_shortcode( array(
			'ids' => $ids,
			'artists' => $atts['artists'],
			'images' => $atts['images']
		));



		if ( !empty($atts['more_link']) && !empty($atts['group']) ) {

			$term = get_term_by('slug', $atts['group'],$this->GetTaxonomy() );
			if ($term instanceof WP_Term) {
				$args = apply_filters('unity3/audio/playlist/more_link', array(
					'class' => '',
					'text'  => "More {$term->name}",
					'link'  => get_term_link($term, $this->GetTaxonomy())
				));

				$output .= ('<a class="'. $args['class'] . '" href="' . $args['link'] . '">'. $args['text'] . '</a>');
			}
		}
		return $output;
	}

	private function do_playlist_block_admin( $posts,  $atts ) {
		echo '<ul class="playlist-preview">';
		foreach ( $posts as $post ) {
			echo ( '<li><span class="dashicons dashicons-controls-play"></span>' . $post->post_title . '</li>' );
		}
		echo '</ul>';

		echo $this->renderAdminBlockOverlay(
			$this->EditLink( array( 'slug' => $atts['group'] ) )
		);
	}

	public function do_genesis_attachment() {
		if (is_singular($this->GetPostType())) {
			echo $this->do_single_audio(get_the_ID(), array('show_title' => 'false') );
		}
	}

	public function unity3_aws_storage_mime( $types ) {
	   return array_merge($types, array(
	     // Audio formats.
	     'mp3|m4a|m4b' => 'audio/mpeg',
	     'ogg|oga' => 'audio/ogg',
	     'wma' => 'audio/x-ms-wma',
	   ));
	 }

	protected function fetFields() {
		return array (
			array(
				'key' => 'field_5d3b597197c47',
				'label' => 'File',
				'name' => 'audio',
				'type' => 'file',
				'instructions' => '',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'return_format' => 'array',
				'library' => 'all',
				'min_size' => '',
				'max_size' => '',
				'mime_types' => 'mp3,ogg',
			),
		);
	}

	protected function getBlockFields() {
		return array(
			array(
				'key' => $this->id . '_field_audio_group',
				'label' => 'Group',
				'name' => 'group',
				'type' => 'taxonomy',
				'instructions' => 'Selects the audio group',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'taxonomy' => $this->GetTaxonomy(),
				'field_type' => 'select',
				'allow_null' => 0,
				'add_term' => 0,
				'save_terms' => 0,
				'load_terms' => 0,
				'return_format' => 'id',
				'multiple' => 0,
			),
			array(
				'key' => 'field_5d6405832a21b',
				'label' => 'Max',
				'name' => 'max',
				'type' => 'number',
				'instructions' => 'The maximum amount of audio files that will be retrieved',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => 5,
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'min' => 1,
				'max' => '',
				'step' => '',
			),
		);
	}

}

function unity3_audio_do_genesis_attachment() {
	$module = unity3_modules()->Get('unity3_audio');
	$module->do_genesis_attachment();
}

////*************************
////       Register
////*************************
unity3_modules()->Register(new Unity3_Audio());



