<?php
/**
 * Plugin Name: Custom Submissions
 * Author: Tony Lane
 * Version: 1.0.0
 * Text Domain: Custom Submissions
 * 
 */


function poster_form_include()
{
    if (is_user_logged_in()){
        $current_user = wp_get_current_user();
    }
    /* create variable to hold html information of form */
    $content = ''; /*string variable that send info to site*/
    $content .= '<form method="post" id="poster_form" 
    style="display:flex; flex-direction:column" action="'.plugin_dir_url(__FILE__).'form-handler/">';
    /*Author Name Input*/
    $content .='<label for="name"/>Author(s) Name(s):</label>';
    $content .='<input type="text" name="name" placeholder="Author(s) name(s)" />';
    /*Title Input*/
    $content .='<label for="title"/>Title:</label>';
    $content .='<input type="text" name="title" placeholder="Title" />';
    /*Abstract Input*/
    $content .='<label for="abstract"/>Abstract:</label>';
    $content .='<textarea name="abstract"> </textarea>';
    /*PDF Input*/
    $content .='<label for="poster upload"/>Upload PDF Scan of Poster:</label>';
    $content .='<input type="file" name="poster_upload"/>';

    /*Collected Information From User, inputs are hidden*/ 
    $content .= '<input name="user" value="'.$current_user->ID.'" type="hidden" />';

    /*Submit Button */
    $content .='<input type="submit" name="poster_submit_button" value="Submit Poster"/>';
    $content .= '</form>'; /*closes form tag */

    return $content;
}
add_shortcode('poster_form','poster_form_include');


function article_form_include()
{
    if (is_user_logged_in()){
        $current_user = wp_get_current_user();
    }
    /* create variable to hold html information of form */
    $content = ''; /*string variable that send info to site*/
    $content .= '<form method="post" id="poster_form" 
    style="display:flex; flex-direction:column" action="'.plugin_dir_url(__FILE__).'">';
    /*Author Name Input*/
    $content .='<label for="name"/>Author(s) Name(s):</label>';
    $content .='<input type="text" name="name" placeholder="Author(s) name(s)" />';
    /*Title Input*/
    $content .='<label for="title"/>Title:</label>';
    $content .='<input type="text" name="title" placeholder="Title" />';
    /*Abstract Input*/
    $content .='<label for="abstract"/>Abstract:</label>';
    $content .='<textarea name="abstract"> </textarea>';
    /*Data/Table File Input*/
    $content .='<label for="data upload"/>Upload Data/Tables:</label>';
    $content .='<input type="file" name="data upload"/>';
    /*Manuscript w/ Author details upload */
    $content .='<label for="manuscript upload"/>Upload Manuscript with Author Information:</label>';
    $content .='<input type="file" name="manuscript upload"/>';
    /*Manuscript w/out Author details upload */
    $content .='<label for="manuscript w/out upload"/>Upload Manuscript without Author Information:</label>';
    $content .='<input type="file" name="manuscript w/out upload"/>';
    /*Collected Information From User, inputs are hidden*/ 
    $content .= '<input name="user" value="'.$current_user->ID.'" type="hidden" />';
    /*Submit Button */
    $content.='<input type="submit" name="article_submit_button" value="Submit Article"';
    $content.= '</form>'; /*closes form tag */

    return $content;
}
add_shortcode('article_form','article_form_include');

?>