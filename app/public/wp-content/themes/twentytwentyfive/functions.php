<?php
/**
 * Twenty Twenty-Five functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_Five
 * @since Twenty Twenty-Five 1.0
 */

// Adds theme support for post formats.
if ( ! function_exists( 'twentytwentyfive_post_format_setup' ) ) :
	/**
	 * Adds theme support for post formats.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_post_format_setup() {
		add_theme_support( 'post-formats', array( 'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_post_format_setup' );

// Enqueues editor-style.css in the editors.
if ( ! function_exists( 'twentytwentyfive_editor_style' ) ) :
	/**
	 * Enqueues editor-style.css in the editors.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_editor_style() {
		add_editor_style( get_parent_theme_file_uri( 'assets/css/editor-style.css' ) );
	}
endif;
add_action( 'after_setup_theme', 'twentytwentyfive_editor_style' );

// Enqueues style.css on the front.
if ( ! function_exists( 'twentytwentyfive_enqueue_styles' ) ) :
	/**
	 * Enqueues style.css on the front.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_enqueue_styles() {
		wp_enqueue_style(
			'twentytwentyfive-style',
			get_parent_theme_file_uri( 'style.css' ),
			array(),
			wp_get_theme()->get( 'Version' )
		);
	}
endif;
add_action( 'wp_enqueue_scripts', 'twentytwentyfive_enqueue_styles' );

// Registers custom block styles.
if ( ! function_exists( 'twentytwentyfive_block_styles' ) ) :
	/**
	 * Registers custom block styles.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_block_styles() {
		register_block_style(
			'core/list',
			array(
				'name'         => 'checkmark-list',
				'label'        => __( 'Checkmark', 'twentytwentyfive' ),
				'inline_style' => '
				ul.is-style-checkmark-list {
					list-style-type: "\2713";
				}

				ul.is-style-checkmark-list li {
					padding-inline-start: 1ch;
				}',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_block_styles' );

// Registers pattern categories.
if ( ! function_exists( 'twentytwentyfive_pattern_categories' ) ) :
	/**
	 * Registers pattern categories.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_pattern_categories() {

		register_block_pattern_category(
			'twentytwentyfive_page',
			array(
				'label'       => __( 'Pages', 'twentytwentyfive' ),
				'description' => __( 'A collection of full page layouts.', 'twentytwentyfive' ),
			)
		);

		register_block_pattern_category(
			'twentytwentyfive_post-format',
			array(
				'label'       => __( 'Post formats', 'twentytwentyfive' ),
				'description' => __( 'A collection of post format patterns.', 'twentytwentyfive' ),
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_pattern_categories' );

// Registers block binding sources.
if ( ! function_exists( 'twentytwentyfive_register_block_bindings' ) ) :
	/**
	 * Registers the post format block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return void
	 */
	function twentytwentyfive_register_block_bindings() {
		register_block_bindings_source(
			'twentytwentyfive/format',
			array(
				'label'              => _x( 'Post format name', 'Label for the block binding placeholder in the editor', 'twentytwentyfive' ),
				'get_value_callback' => 'twentytwentyfive_format_binding',
			)
		);
	}
endif;
add_action( 'init', 'twentytwentyfive_register_block_bindings' );

// Registers block binding callback function for the post format name.
if ( ! function_exists( 'twentytwentyfive_format_binding' ) ) :
	/**
	 * Callback function for the post format name block binding source.
	 *
	 * @since Twenty Twenty-Five 1.0
	 *
	 * @return string|void Post format name, or nothing if the format is 'standard'.
	 */
	function twentytwentyfive_format_binding() {
		$post_format_slug = get_post_format();

		if ( $post_format_slug && 'standard' !== $post_format_slug ) {
			return get_post_format_string( $post_format_slug );
		}
	}
endif;

// for the advanced search form
function searchfilter($query) {
	if ($query->is_search && !is_admin()) {
		if(!empty($_GET['title'])){
			$query->set('s', $_GET['title']);
		}
		if(!empty($_GET['author'])){
			$query->set('author', $_GET['author']);
		}
		if(!empty($_GET['tag'])){
			$query->set('tag', $_GET['tag']);
		}
	}
	}
	
add_action('pre_get_posts','searchfilter');


// lets the current user update their profile info
function updateUserProfileForms() {
    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();

        $new_data = array('ID' => $current_user->ID);
		if(isset($_POST['first_name']) && !empty($_POST['first_name'])){
			$new_data['first_name'] = sanitize_text_field($_POST['first_name']);
		}
        if(isset($_POST['last_name']) && !empty($_POST['last_name'])){
            $new_data['last_name'] = sanitize_text_field($_POST['last_name']);
        }
        if(isset($_POST['bio']) && !empty($_POST['bio'])) {
            $new_data['description'] = sanitize_textarea_field($_POST['bio']);
        }
        if($new_data){
            wp_update_user($new_data);
        }
        
        if ( isset($_POST['password']) && !empty($_POST['password']) ) {
            wp_set_password(sanitize_text_field($_POST['password']), $current_user->ID);
        }

		// name and bio
        $form = '<form method="POST" class="update-user-info">';
        $form .= '<label for="first_name">First Name:</label>';
        $form .= '<input type="text" id="first_name" name="first_name" value="' . esc_attr($current_user->first_name) . '" />';
        $form .= '<label for="last_name">Last Name:</label>';
        $form .= '<input type="text" id="last_name" name="last_name" value="' . esc_attr($current_user->last_name) . '" />';
        $form .= '<label for="bio">Biography:</label>';
        $form .= '<input type = "text" id="bio" name="bio" value="' . esc_attr($current_user->description) . '" />';
        $form .= '<input type="submit" name="submit_user_info" value="Update Personal Info" />';

        // password
        $form .= '<label for="password">New Password:</label>';
        $form .= '<input type="password" id="password" name="password" />';
        $form .= '<input type="submit" name="submit_password" value="Update Password" />';
        $form .= '</form>';

        return $form;
    } else {
        wp_redirect(home_url('/wp-login.php?redirect_to=http%3A%2F%2Flocalhost%3A10023%2F'));
		return;
    }
}
add_shortcode('update_user_info', 'updateUserProfileForms');

// displays current users article/poster submissions
function userPostsDisplay() {
    if ( is_user_logged_in() ) {
        $current_user = wp_get_current_user();
        $args = array(
            'author'        => $current_user->ID,
            'post_type'     => 'post', 
            'post_status'   => array('publish', 'draft'),
            'posts_per_page'=> -1,
        );
        $user_posts = new WP_Query( $args );

        if ( $user_posts->have_posts() ) {
            $output = '<ul>';
            while ( $user_posts->have_posts() ) {
                $user_posts->the_post();
                $status = get_post_status();
                $status_text = $status == 'publish' ? 'Published' : 'Under Review';

                $output .= '<h6><a href="' . get_permalink() . '">' . get_the_title() . '</a> - Status: ' . $status_text . '</li>';
            }
            $output .= '';
            wp_reset_postdata();
        } else {
            $output = 'You have no submissions.';
        }
        return $output;
    } else {
        wp_redirect(home_url('/wp-login.php?redirect_to=http%3A%2F%2Flocalhost%3A10023%2F'));
		return;
    }
}
add_shortcode( 'userPostsDisplay', 'userPostsDisplay' );

// form styling
function user_profile_form_styles() {
    ?>
    <style>
        .update-user-info {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .update-user-info label {
            display: block;
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }
        .update-user-info input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 12px;
        }
		.update-user-info input[type="password"] {
            width: 100%;
            padding: 10px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 12px;
        }
        .update-user-info input[type="submit"] {
            background-color: #e22318;
            color: white;
            font-size: 16px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .update-user-info input[type="submit"]:hover {
            background-color: #e53f37;
        }
        p {
            font-size: 14px;
            color: #333;
        }
    </style>
    <?php
}
add_action('wp_head', 'user_profile_form_styles');


function shortcode_needLogin() {
    if (!is_user_logged_in()) {
        auth_redirect();
    }
}
add_shortcode('need_login', 'shortcode_needLogin');