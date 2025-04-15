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
