<?php
//Each rock contains the potential of many smaller rocks
//Form Handling Occurs Here


$path = preg_replace('/wp-content.*$/','',__DIR__);
require_once($path."wp-load.php");


/*Poster Form Handling*/
if(isset($_POST['poster_submit_button'])){

    //line below renders information in the form-handle pathing of the website
    //echo '<pre>';print_r($_POST); echo "</pre>";

    /*Get Information From Forms*/ 
    $author_name = sanitize_text_field($_POST['name']);
    $title = sanitize_text_field($_POST['title']);
    $abstract = sanitize_text_field($_POST['abstract']);
    $file = $_POST['poster_upload'];
    $term = 'poster';
    $user = sanitize_key($_POST['user']);
    $status = 'publish';

    $wordpress_post = array(
        'post_title' => $title,
        'post_content' => $author_name."</br></br>".$abstract,
        'post_status' => 'publish',
        'post_author' => $user,
        'post_type' => 'post'
        );

    wp_insert_post( $wordpress_post );

}

/*Article Form Handling*/
if(isset($_POST['article_form'])){

    /*Get Information From Forms*/ 
    $author_name = sanitize_text_field($_POST['name']);
    $title = sanitize_text_field($_POST['title']);
    $abstract = sanitize_text_field($_POST['abstract']);
    $data_file = $_POST['data upload'];
    $manuscript_with_details = $_POST[''];
    $manuscript_without_details = $_POST[''];
    $term = 'journal-entries';
    $status = 'draft';

}


//term for article submissions
//$term = 'journal-entries'

/* method for programatically creating a post
    ** note: post_content in a string of html content for the page. **

$wordpress_post = array(
'post_title' => 'Post title',
'post_content' => 'Post Content',
'post_status' => 'publish',
'post_author' => 1,
'post_type' => 'page'
);

wp_insert_post( $wordpress_post );

Sample Data Table Section for a Poster Link
INSERT INTO `wp_posts` (`ID`, `post_author`, `post_date`, `post_date_gmt`, `post_content`, `post_title`, `post_excerpt`, `post_status`, `comment_status`, `ping_status`, `post_password`, `post_name`, `to_ping`, `pinged`, `post_modified`, `post_modified_gmt`, `post_content_filtered`, `post_parent`, `guid`, `menu_order`, `post_type`, `post_mime_type`, `comment_count`) VALUES
(405,	1,	'2025-04-22 07:00:28',	'2025-04-22 07:00:28',	'<!-- wp:paragraph -->\n<p>Vlinaosdincasoindva. Link to File</p>\n<!-- /wp:paragraph -->\n\n<!-- wp:file {\"id\":107,\"href\":\"http://benchmark3.local/wp-content/uploads/2025/03/LoremIpsum_Article.docx.pdf\",\"displayPreview\":true} -->\n<div class=\"wp-block-file\"><object class=\"wp-block-file__embed\" data=\"http://benchmark3.local/wp-content/uploads/2025/03/LoremIpsum_Article.docx.pdf\" type=\"application/pdf\" style=\"width:100%;height:600px\" aria-label=\"LoremIpsum_Article.docx\"></object><a id=\"wp-block-file--media-364f0dbf-937f-4cdd-9f83-967bc50565bb\" href=\"http://benchmark3.local/wp-content/uploads/2025/03/LoremIpsum_Article.docx.pdf\">LoremIpsum_Article.docx</a><a href=\"http://benchmark3.local/wp-content/uploads/2025/03/LoremIpsum_Article.docx.pdf\" class=\"wp-block-file__button wp-element-button\" download aria-describedby=\"wp-block-file--media-364f0dbf-937f-4cdd-9f83-967bc50565bb\">Download</a></div>\n<!-- /wp:file -->',	'Sample Poster Link View',	'',	'publish',	'open',	'open',	'',	'sample-poster-link-view',	'',	'',	'2025-04-22 07:00:28',	'2025-04-22 07:00:28',	'',	0,	'http://benchmark3.local/?p=405',	0,	'post',	'',	0),


*/
wp_redirect(home_url());
exit;

?>