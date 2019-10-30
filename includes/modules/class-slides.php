<?php
//
class Unity3_Slides extends Unity3_Post_Group {

	public function __construct( ) {
		parent::__construct('unity3_slide', 'Slide', 'Slides');

		$this->mergeSettings( array(
			'post' => array(
				'menu_position' => 9,
				'menu_icon'     => 'dashicons-images-alt2'
			),
			'group_rewrite' => array( 'base' => 'slides'),
			'admin_columns' => array(
				'cb'    => array('header' => '<input type="checkbox" />'),
				'slide-image' => array('header' => '', 'acf' => 'image', 'image_size' => 'unity3_slide_xsmall'),
				'title' => array('header' => 'Title'),
				'date'  => array('header' => 'Date'),
			),
		));

	}

	public function Init( ) {
		parent::Init();

		add_image_size('unity3_slide', 1140,460, true);
		add_image_size('unity3_slide_med', 768,310, true);
		add_image_size('unity3_slide_small', 512,206, true);
		add_image_size('unity3_slide_xsmall', 200,80, true);

		add_filter( "get_post_metadata", array($this, 'override_default_image'), 12, 4);
		add_filter( 'get_the_excerpt', array($this, 'override_excerpt'), 12, 2 );

		if ( is_admin() ) {
			//set the width of the admin slide image column
			if (!isset($this->settings['admin_inline_styles']['.column-slide-image']) ) {
				$this->settings['admin_inline_styles']['.column-slide-image'] = "width: 200px;";
			}

			unity3_dragsort( $this->GetPostType() );
		}

//		$this->register_blocks();
	}

	function register_blocks() {

		// register a testimonial block.
		if (is_admin()) {

			acf_add_local_field_group(array(
				'key' => 'group_5d5ed74607345',
				'title' => 'Slider Block',
				'fields' => array(
					array(
						'key' => 'field_5d5ed754e7bd8',
						'label' => 'Group',
						'name' => 'slide_group',
						'type' => 'taxonomy',
						'instructions' => '',
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
				),
				'location' => array(
					array(
						array(
							'param' => 'block',
							'operator' => '==',
							'value' => 'acf/unity3-slides',
						),
					),
				),
			));

			acf_register_block_type(array(
				'name'              => 'unity3-slides',
				'title'             => __('Slides'),
				'description'       => __('A Unity3 Slides block.'),
				'render_callback'   => array(&$this, 'render_acf_block_admin'),
				'category'          => 'formatting',
				'icon'              => 'admin-comments',
				'keywords'          => array( 'slide', 'slides' ),
			));

		} else {
		    //bypass ACF on the front end to speed things up
			register_block_type('acf/unity3-slides', array(
				'attributes'		=> array(),
				'render_callback'	=> array(&$this, 'render_block_frontend'),
			));
        }
	}

    public function render_block_frontend($args) {
	    $this->render_block($args, is_admin());
    }

	protected function render_block($args, $is_admin) {

	    $term = get_term($args['data']['slide_group'], $this->GetTaxonomy());
	    $title = 'Slides: Group Not Selected';
	    if ( $term instanceof WP_Term ) {
	        $title = 'Slides: ' . $term->name;
        }

		?>
        <div id="<?php echo esc_attr($args['id']); ?>" class="<?php echo esc_attr($args['class']); ?>">
            <h2><?php echo $title; ?></h2>
            <a href="<?php echo 'edit.php?post_type=' . $this->GetPostType() . "&{$this->GetTaxonomy()}=" . $term->slug; ?>">Click here to edit the slides</a>
        </div>
		<?php
    }

	public function render_acf_block_admin( $block, $content, $is_preview, $post_id ) {
		// Create id attribute allowing for custom "anchor" value.
		$id = 'unity3-slides-' . $block['id'];
		if( !empty($block['anchor']) ) {
			$id = $block['anchor'];
		}

		// Create class attribute allowing for custom "className" and "align" values.
		$className = 'unity3-slides';
		if( !empty($block['className']) ) {
			$className .= ' ' . $block['className'];
		}
		if( !empty($block['align']) ) {
			$className .= ' align' . $block['align'];
		}

        $this->render_block(array(
            'id' => $block['id'],
            'class' => $className,
            'data' => $block['data']
        ), is_admin());

	}

	protected function getFields() {
		return array (
			array (
				'key'           => $this->GetPostType() . '_field_image',
				'label'         => '',
				'name'          => 'image',
				'type'          => 'image',
				'return_format' => 'id',
				'required'      => 1,
				'mime_types'    => 'jpg,jpeg,jpe,gif,png',
				'preview_size'  => 'unity3_slide',
				'wrapper' => array (
					'width' => '100%',
					'class' => 'slide-image'
				),
			),
			array(
				'key' => $this->GetPostType() . '_field_caption',
				'label' => 'Caption',
				'name' => 'caption',
				'type' => 'text',
				'instructions' => '',
				'required' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'maxlength' => '',
			)
		);
	}

//  Todo: Toobar code from ACF
//    public function my_toolbars( $toolbars )
//	{
//		// Uncomment to view format of $toolbars
//		/*
//		echo '< pre >';
//			print_r($toolbars);
//		echo '< /pre >';
//		die;
//		*/
//
//		// Add a new toolbar called "Very Simple"
//		// - this toolbar has only 1 row of buttons
//		$toolbars['Very Simple' ] = array();
//		$toolbars['Very Simple' ][1] = array('bold' , 'italic' , 'underline' );
//
//		// Edit the "Full" toolbar and remove 'code'
//		// - delete from array code from http://stackoverflow.com/questions/7225070/php-array-delete-by-value-not-key
//		if( ($key = array_search('code' , $toolbars['Full' ][2])) !== false )
//		{
//			unset( $toolbars['Full'][2][$key] );
//		}
//
//		// remove the 'Basic' toolbar completely
//		unset( $toolbars['Basic' ] );
//
//	// return $toolbars - IMPORTANT!
//		return $toolbars;
//	}

	public function override_default_image( $image_id, $post_id, $meta_key, $single ) {

		if ('_thumbnail_id' == $meta_key && get_post_type($post_id) === $this->GetPostType()) {
			return get_field('image', $post_id);
		}
		return $image_id;
	}

	public function override_excerpt($post_excerpt, $post) {
		if (get_post_type($post) === $this->GetPostType()) {
			return get_field('caption', $post);
		}

		return $post_excerpt;
	}
}

////*************************
////       Register
////*************************
unity3_modules()->Register(new Unity3_Slides());



