<?php
//

if( class_exists('ACF') ) :

class Unity3_Slides extends Unity3_Post_Group {

    const ID = 'unity3_slide';

	public function __construct( ) {
		parent::__construct(Unity3_Slides::ID, 'Slide', 'Slides');

		$this->mergeSettings( array(
			'post' => array(
				'menu_position' => 9,
				'menu_icon'     => 'dashicons-images-alt2'
			),
			'group_rewrite' => array( 'base' => 'slides'),
			'admin_columns' => array(
				'cb'    => array('header' => '<input type="checkbox" />'),
				'slide-image' => array('header' => '', 'acf' => 'image', 'image_size' => 'unity3_slide_xsmall', 'link' => 'POST_EDIT' ),
				'title' => array('header' => 'Title'),
				'caption' => array('header'=> 'Caption', 'post' => 'post_excerpt'),
				'custom_date'  => array('header' => 'Date', 'callback' => array(&$this, 'render_date_column')),
			),
		));
	}

	/**
	 * Return the email classes - used in admin to load settings.
	 *
	 * @return Unity3_Slides|null
	 */
	public static function instance() {
		return unity3_modules()->Get(self::ID);
	}

	public function Init( ) {
		parent::Init();

		add_image_size('unity3_slide', 1140,460, true);
		add_image_size('unity3_slide_med', 768,310, true);
		add_image_size('unity3_slide_small', 512,206, true);
		add_image_size('unity3_slide_xsmall', 200,80, true);

		if ( is_admin() ) {
			//set the width of the admin slide image column
			if (!isset($this->settings['admin_inline_styles']['.column-slide-image']) ) {
				$this->settings['admin_inline_styles']['.column-slide-image'] = "width: 200px;";
			}

			unity3_dragsort( $this->GetPostType() );
            add_filter( 'unity3/hide_metaboxes/include', array(&$this, 'hide_metaboxes_include'), 10, 2 );
			add_action( 'current_screen', array(&$this, 'current_screen') );
		}

        add_action('acf/save_post', array($this, 'override_post_defaults'), 50);
	}

	function hide_metaboxes_include($includes, $screen_id) {
	    if ($this->GetPostType() == $screen_id) {
	        return array(
	                $this->GetPostType() => array( 'acf' => 'startsWith' )
            );
        }
	    return $includes;
    }

	function override_post_defaults() {

		$current_screen         = get_current_screen();
		if ( $this->GetPostType() != $current_screen->post_type) {
		    return;
        }

		global $post;
		//***************************************************
		//Sync the caption field to the post excerpt field...
        remove_action('acf/save_post', array($this, 'override_post_defaults'), 50); // Unhook this function so it doesn't loop infinitely

        wp_update_post( array(
	        'ID'            => $post->ID,
	        'post_excerpt'	=> get_field('caption', $post->ID )
        ));

        add_action( 'acf/save_post', array($this, 'override_post_defaults'), 50); // Re-hook this function
        //****************************************

        //Sync the slide image field to the post featured image
        update_post_meta( $post->ID, '_thumbnail_id', get_field('image') );
	}

	function render_date_column() {
		global $post;
		$start_date = get_field('slide_start_date', $post->ID);
		$end_date = get_field('slide_end_date', $post->ID);

		return '<div class="start-date">' . esc_html('Start: ' . $start_date) . '</div>' .
		       '<div class="end-date">' . esc_html('End: '. $end_date) . '</div>';
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

	function current_screen( $screen ) {

		if ( $screen->post_type != $this->GetPostType())
			return;

		$post_id = isset($_REQUEST['post']) ? (int)$_REQUEST['post'] : null;
		//Custom Publish Box

        //build delete/trash html
		$trash_html = '';
        if ( current_user_can( 'delete_post', $post_id ) ) {
			if ( EMPTY_TRASH_DAYS && MEDIA_TRASH ) {
				$trash_html = "<a class='submitdelete deletion' href='" . get_delete_post_link( $post_id ) . "'>" . __( 'Move to Trash' ) . '</a>';
			} else {
				$delete_ays = ! MEDIA_TRASH ? " onclick='return showNotice.warn();'" : '';
				$trash_html =  "<a class='submitdelete deletion'{$delete_ays} href='" . get_delete_post_link( $post_id, null, true ) . "'>" . __( 'Delete Permanently' ) . '</a>';
			}
		}


		$publish_box_html =
        '<div class="submitbox" id="submitpost">
		    <div id="major-publishing-actions">
                <div id="delete-action">'. $trash_html .'</div>
            
                <div id="publishing-action">
                    <span class="spinner"></span>
                    <input name="original_publish" type="hidden" id="original_publish" value="Publish">
                    <input type="submit" name="publish" id="publish" class="button button-primary button-large" value="Publish">		</div>
                <div class="clear"></div>
            </div>
        </div>';

		$publish_box_id = $this->ID() . '_custom_publishbox';
		acf_add_local_field_group(array(
			'key' => $publish_box_id,
			'title' => 'Publish',
			'fields' => array(
				array(
					'key' => "{$publish_box_id}_date_start",
					'label' => 'Date',
					'type' => 'accordion',
					'open' => 0,
					'multi_expand' => 0,
					'endpoint' => 0,
				),
				array(
					'key' => "{$publish_box_id}_slide_start_date",
					'label' => 'Start Date',
					'name' => 'slide_start_date',
					'type' => 'date_time_picker',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'display_format' => 'F j, Y g:i a',
					'return_format' => 'F j, Y g:i a',
					'first_day' => 1,
					'default_value' => '__now',
				),
				array(
					'key' => "{$publish_box_id}_slide_end_date",
					'label' => 'End Date',
					'name' => 'slide_end_date',
					'type' => 'date_time_picker',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'display_format' => 'F j, Y g:i a',
					'return_format' => 'F j, Y g:i a',
					'first_day' => 1,
					'default_value' => '__+10 years',
				),
				array(
					'key' => "{$publish_box_id}_date_end",
					'label' => 'Date',
					'type' => 'accordion',
					'open' => 0,
					'multi_expand' => 0,
					'endpoint' => 1,
				),
				array(
					'key' => "{$publish_box_id}_actions",
					'name' => '',
					'type' => 'message',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array(
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'message' => $publish_box_html,
					'new_lines' => '',
					'esc_html' => 0,
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'unity3_slide',
					),
				),
			),
			'menu_order' => 0,
			'position' => 'side',
			'style' => 'default',
			'label_placement' => 'top',
			'instruction_placement' => 'label',
			'description' => '',
		));


        //***************************************************
        //          SLIDE NAVIGATION METABOX
        if ( 'add' != $screen->action ) {
	        $terms  = wp_get_post_terms( $post_id, $this->GetTaxonomy() );
	        $slides = count( $terms ) ? $this->GetGroupPosts( $terms[0]->term_id, 'term_id' ) : array();
	        //
	        $current_slide_num = 0;
	        $slide_count       = count( $slides );

	        $prevLink = false;
	        $nextLink = false;
	        foreach ( $slides as $index => $slide ) {
		        if ( $slide->ID == $post_id ) {
			        $current_slide_num = ( $index + 1 );
			        $prevLink          = $index ? get_edit_post_link( $slides[ $index - 1 ], 'raw' ) : false;
			        $nextLink          = ( $index + 1 ) < $slide_count ? get_edit_post_link( $slides[ $index + 1 ], 'raw' ) : false;
			        break;
		        }
	        }

	        acf_add_local_field_group( array(
		        'key'                   => $this->ID() . '_slide_navigation',
		        'title'                 => 'Slide Navigation',
		        'fields'                => array(
			        array(
				        'key'               => 'field_5e3b447540e80',
				        'label'             => "Slide: {$current_slide_num} of {$slide_count}",
				        'name'              => '',
				        'type'              => 'message',
				        'instructions'      => '',
				        'required'          => 0,
				        'conditional_logic' => 0,
				        'wrapper'           => array(
					        'width' => '',
					        'class' => '',
					        'id'    => '',
				        ),
				        'message'           =>
					        '<a href="' . ( $prevLink ? $prevLink : '#' ) . '" class="button' . ( $prevLink ? '' : ' disabled' ) . ' prev-slide">Prev Slide</a>'
					        .
					        '<a href="' . ( $nextLink ? $nextLink : '#' ) . '" class="button' . ( $nextLink ? '' : ' disabled' ) . ' next-slide">Next Slide</a>',
				        'new_lines'         => '',
				        'esc_html'          => 0,
			        ),
		        ),
		        'location'              => array(
			        array(
				        array(
					        'param'    => 'post_type',
					        'operator' => '==',
					        'value'    => 'unity3_slide',
				        ),
			        ),
		        ),
		        'menu_order'            => 99,
		        'position'              => 'side',
		        'style'                 => 'default',
		        'label_placement'       => 'top',
		        'instruction_placement' => 'label',
		        'description'           => '',
	        ) );
        }
	}

	static function Get($group_slug) {
		return unity3_modules()->Get(Unity3_Slides::ID)->GetGroupPosts( $group_slug );
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

//	public function override_default_image( $image_id, $post_id, $meta_key, $single ) {
//
//		if ('_thumbnail_id' == $meta_key && get_post_type($post_id) === $this->GetPostType()) {
//			return get_field('image', $post_id);
//		}
//		return $image_id;
//	}
//
//	public function override_excerpt($post_excerpt, $post) {
//		if (get_post_type($post) === $this->GetPostType()) {
//			return get_field('caption', $post);
//		}
//
//		return $post_excerpt;
//	}
}

////*************************
////       Register
////*************************
unity3_modules()->Register(Unity3_Slides::instance());

endif;



