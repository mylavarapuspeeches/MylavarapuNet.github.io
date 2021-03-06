<?php
/* * *************************************************************************************************** */
// Define Paths
/* * *************************************************************************************************** */

$get_wp_version = get_bloginfo('version');
$theme_data = wp_get_theme();
define('OPTIONS_PATH', get_template_directory_uri() . '/nimbus/');
define('THEME_NAME', $theme_data['Name']);
define('THEME_SLUG', 'opulus');
define('THEME_OPTIONS', 'wp_opulus_options');
define('SALESPAGEURL', 'http://www.nimbusthemes.com/wordpress-themes/opulus/');
define('SUPPORTINFOURL', 'http://www.nimbusthemes.com/support/');
define('THEME_NAME_CLEAN', str_replace(" ", "_", strtolower(THEME_NAME)));
define('ALLTHEMES', 'http://www.nimbusthemes.com/join/');
define('DEMOURL', 'http://preview.nimbusthemes.com/?theme=opulus');
define('GUIDEURL', 'http://www.nimbusthemes.com/user-guides/');
define('ISFREE', TRUE);


/* * *************************************************************************************************** */
// Load Admin Panel
/* * *************************************************************************************************** */

require_once(get_template_directory() . '/nimbus/options.php');
require_once(get_template_directory() . '/nimbus/options_arr.php');

/* * *************************************************************************************************** */

// Flush Rewrite on Activation
/* * *************************************************************************************************** */

function nimbus_rewrite_flush() {
    flush_rewrite_rules();
}

add_action('after_switch_theme', 'nimbus_rewrite_flush');


/* * *************************************************************************************************** */
// Setup Theme
/* * *************************************************************************************************** */

add_action('after_setup_theme', 'nimbus_setup');

if (!function_exists('nimbus_setup')) {
    function nimbus_setup() {
       
        // Localization
        
        $lang_local = get_template_directory() . '/lang';
        load_theme_textdomain('nimbus', $lang_local);

        // Register Thumbnail Sizes

        add_theme_support('post-thumbnails');
        set_post_thumbnail_size(1160, 9999, true);
        add_image_size('nimbus-small', 140, 90, true);
        add_image_size('nimbus-feature', 370, 191, true);
        add_image_size('nimbus-post', 760, 227, true);
        add_image_size('nimbus-post-full', 1160, 221, true);
        add_image_size('full-banner', 1160, 360, true);
        add_image_size('half-banner', 660, 360, true);
        add_image_size('half-image', 670, 424, true);
        add_image_size('full-image', 1170, 424, true);

        // Load feed links	

        add_theme_support('automatic-feed-links');
        
        // Support Custom Background
        
        $nimbus_custom_background_defaults = array(
            'default-color' => 'ffffff'
        );
        add_theme_support( 'custom-background', $nimbus_custom_background_defaults );
        
        // Set Content Width

        global $content_width;
        if ( !isset( $content_width ) ) {
            $content_width = 770;
        }

        // Register Menus

        register_nav_menu('primary', __( 'Primary Menu', 'nimbus'));
        register_nav_menu('mobile', __( 'Mobile Menu', 'nimbus'));
        
    }
}


/* **************************************************************************************************** */
// Clear Helper/s
/* **************************************************************************************************** */

if (!function_exists('n_clear')) {
    function n_clear($ht = "0") {
    echo "<div class='clear' style='height:" . $ht . "px;'></div>";
    }
}

/* **************************************************************************************************** */
// Do Title 
/* **************************************************************************************************** */

add_action('wp_title', 'nimbus_title');
  
function nimbus_title() {
    global $wp_query;
    $title = get_bloginfo('name');
    $seporate = ' | ';
    if (is_front_page()) {
        $title = get_bloginfo('name');
    } else if (is_feed()) {
        $title = '';
    } else if (is_page() || is_single()) {
        $postid = $wp_query->post->ID;
        $title = the_title('','',false) . $seporate . get_bloginfo('name');
    }
    wp_reset_query();
    return $title;
}


/* * *************************************************************************************************** */
// Override gallery style
/* * *************************************************************************************************** */

add_filter( 'use_default_gallery_style', '__return_false' );


/* **************************************************************************************************** */
// Set Content Width On full_width.php Template
/* **************************************************************************************************** */

function nimbus_adjust_content_width() {
    global $content_width;
    if ( is_page_template( 'full_width.php' ) ) {
        $content_width = 1170;
    }    
}
add_action( 'template_redirect', 'nimbus_adjust_content_width' );


/* * *************************************************************************************************** */
// Register Sidebars
/* * *************************************************************************************************** */

add_action('widgets_init', 'nimbus_register_sidebars');

if (!function_exists('nimbus_register_sidebars')) {
    function nimbus_register_sidebars() {

        register_sidebar(array(
            'name' => __('Default Page Sidebar', 'nimbus'),
            'id' => 'sidebar_pages',
            'description' => __('Widgets in this area will be displayed in the sidebar on the pages.', 'nimbus'),
            'before_widget' => '<div class="sidebar_widget sidebar sidebar_editable widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));

        register_sidebar(array(
            'name' => __('Default Blog Sidebar', 'nimbus'),
            'id' => 'sidebar_blog',
            'description' => __('Widgets in this area will be displayed in the sidebar in the blog.', 'nimbus'),
            'before_widget' => '<div class="sidebar_widget sidebar sidebar_editable widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));

        register_sidebar(array(
            'name' => __('Footer Left', 'nimbus'),
            'id' => 'footer-left',
            'description' => __('Widgets in this area will be shown in the left footer column.', 'nimbus'),
            'before_widget' => '<div class="footer_widget sidebar sidebar_editable widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));

        register_sidebar(array(
            'name' => __('Footer Center', 'nimbus'),
            'id' => 'footer-center',
            'description' => __('Widgets in this area will be shown in the center footer column.', 'nimbus'),
            'before_widget' => '<div class="footer_widget sidebar sidebar_editable widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));

        register_sidebar(array(
            'name' => __('Footer Right', 'nimbus'),
            'id' => 'footer-right',
            'description' => __('Widgets in this area will be shown in the right footer column.', 'nimbus'),
            'before_widget' => '<div class="footer_widget sidebar sidebar_editable widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));

        register_sidebar(array(
            'name' => __('Frontpage Right', 'nimbus'),
            'id' => 'frontpage-right',
            'description' => __('Widgets in this area will be shown on the right side of the frontpage.', 'nimbus'),
            'before_widget' => '<div class="front_right_widget sidebar sidebar_editable widget %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>'
        ));

        

        $i = 1;
        while ($i <= 20) {
            register_sidebar(array(
                'name' => __('Alternative Sidebar', 'nimbus') . $i,
                'id' => 'sidebar_' . $i,
                'description' => __('Widgets in this area will be displayed in the sidebar for any posts, pages items that are taged with sidebar', 'nimbus') . $i . '.',
                'before_widget' => '<div class="sidebar_widget sidebar sidebar_editable widget %2$s">',
                'after_widget' => '</div>',
                'before_title' => '<h3 class="widgettitle">',
                'after_title' => '</h3>'
            ));
            $i++;
        }
    }
}    

/* * *************************************************************************************************** */
// Excerpt Modifications
/* * *************************************************************************************************** */

// Excerpt Length

add_filter('excerpt_length', 'nimbus_excerpt_length');

if (!function_exists('nimbus_excerpt_length')) {
    function nimbus_excerpt_length($length) {
        return 40;
    }
}

// Excerpt More

add_filter('excerpt_more', 'nimbus_excerpt_more');

if (!function_exists('nimbus_excerpt_more')) {
    function nimbus_excerpt_more($more) {
        return '';
    }
}

// Add to pages

add_action('init', 'nimbus_add_excerpts_to_pages');

if (!function_exists('nimbus_add_excerpts_to_pages')) {
    function nimbus_add_excerpts_to_pages() {
        add_post_type_support('page', 'excerpt');
    }
}

/* * *************************************************************************************************** */
// Enable Threaded Comments
/* * *************************************************************************************************** */

add_action('wp_enqueue_scripts', 'nimbus_threaded_comments');

function nimbus_threaded_comments() {
    if (is_singular() && comments_open() && (get_option('thread_comments') == 1)) {
        wp_enqueue_script('comment-reply');
    }
}

/* * *************************************************************************************************** */

// Modify Comments Output
/* * *************************************************************************************************** */

if (!function_exists('nimbus_comment')) {
function nimbus_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    ?>
    <li <?php comment_class(); ?> id="li_comment_<?php comment_ID() ?>">
        <div id="comment_<?php comment_ID(); ?>" class="comment_wrap clearfix">
    <?php echo get_avatar($comment, $size = '75'); ?>
            <div class="comment_content">
                <p class="left"><strong><?php comment_author_link(); ?></strong><br />
                <?php echo(get_comment_date()) ?> <?php edit_comment_link(__('(Edit)', 'nimbus'), '  ', '') ?></p>
                <p class="right"><?php comment_reply_link(array_merge($args, array('reply_text' => __('Leave a Reply', 'nimbus'), 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></p>
                <div class="clear"></div>
    <?php if ($comment->comment_approved == '0') : ?>
                    <em><?php _e('Your comment is awaiting moderation.', 'nimbus') ?></em>
    <?php endif; ?>
        <?php comment_text() ?>
            </div>
            <div class="clear"></div>
        </div> 

        <?php
    }
}


/***************************************************************************************************** */
// Modify Ping Output
/***************************************************************************************************** */

if (!function_exists('nimbus_ping')) {
    function nimbus_ping($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        ?>
        <li id="comment_<?php comment_ID(); ?>"><?php comment_author_link(); ?> - <?php comment_excerpt(); ?> 
    <?php
    }
}    

/***************************************************************************************************** */
// Modify Comment Text Fields
/***************************************************************************************************** */

    add_filter('comment_form_default_fields', 'nimbus_comment_fields');

if (!function_exists('nimbus_comment_fields')) {    
    function nimbus_comment_fields($fields) {

        $commenter = wp_get_current_commenter();
        $req = get_option('require_name_email');
        $aria_req = ( $req ? " aria-required='true'" : '' );

        $fields['author'] = '<div class="row"><div class="span3 comment_fields"><p class="comment-form-author">' . '<label for="author">' . __('Name', 'nimbus') . '</label> ' . ( $req ? '<span class="required">*</span><br />' : '' ) . '<input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>';
        $fields['email'] = '<p class="comment-form-email"><label for="email">' . __('Email', 'nimbus') . '</label> ' . ( $req ? '<span class="required">*</span><br />' : '' ) . '<input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>';
        $fields['url'] = '<p class="comment-form-url"><label for="url">' . __('Website', 'nimbus') . '</label><br />' . '<input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p></div> ';

        return $fields;
    }
}
     

/*     * *************************************************************************************************** */
// Create SEO Box
/*     * *************************************************************************************************** */

    add_action("admin_init", "nimbus_seo_meta_box");

    function nimbus_seo_meta_box() {

        add_meta_box("seo_meta_box", __('Nimbus SEO Panel', 'nimbus'), "nimbus_call_seo_meta_box", "page", "normal", "high");
        add_meta_box("seo_meta_box", __('Nimbus SEO Panel', 'nimbus'), "nimbus_call_seo_meta_box", "post", "normal", "high");
        
    }    

    function nimbus_call_seo_meta_box() {
    ?>  

        <p><span style="color:#fc7e2a;">This feature is availible to Nimbus Themes members.</span> <a href="<?php echo SALESPAGEURL; ?>?utm_source=opulus&utm_medium=theme&utm_content=seo_meta_link&utm_campaign=opulus">Join today!!</a></p>

    <?php
    }


/* * *************************************************************************************************** */
// Register Featured Image Options Box
/* * *************************************************************************************************** */

add_action("admin_init", "nimbus_featured_image_options_meta_box");

function nimbus_featured_image_options_meta_box() {

    add_meta_box("featured_image_options_meta_box", __('Nimbus Featured Image Options', 'nimbus'), "nimbus_call_featured_image_options_meta_box", "page", "side", "high");
    add_meta_box("featured_image_options_meta_box", __('Nimbus Featured Image Options', 'nimbus'), "nimbus_call_featured_image_options_meta_box", "post", "side", "high");
}

function nimbus_call_featured_image_options_meta_box() {

    global $post, $wp_query;


    $custom = get_post_custom($post->ID);
    if (isset($custom["on_page_checked"])) {
        $on_page_checked = $custom["on_page_checked"][0];
    }
 

    echo '<input type="hidden" name="meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    if ( get_option('page_on_front') ==  $post->ID ) { 
    ?>
        <p><?php _e('There are no image options because this page is set as the Front Page', 'nimbus') ?></p>
    <?php 
    } else {
    ?>         
        <p><?php _e('Remember you need to attach a Featured Image for these setting to take effect.', 'nimbus') ?></p>
        <table>
                <tr><td><label><input type="checkbox" id="on_page_checked" name="on_page_checked" value="true" <?php if (get_post_meta($post->ID, 'include_image_on_page', true) == "true") { ?> checked="checked" <?php } ?> /></label></td><td>Include Image at the Top of the Page</td></tr>   
        </table>                
    <?php } ?>





    <?php

}

/* * *************************************************************************************************** */
// Save Featured Image Options Box
/* * *************************************************************************************************** */


add_action('save_post', 'nimbus_save_featured_image_options_meta_box');

function nimbus_save_featured_image_options_meta_box($post_id) {

    global $post;

    // verify nonce

    if (isset($_POST['meta_box_nonce'])) {
        if (!wp_verify_nonce($_POST['meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
    }

    // check autosave

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if (isset($_POST['post_type'])) {

        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }


    }

    if (isset($_POST['on_page_checked'])) {
        update_post_meta($post_id, 'include_image_on_page', $_POST['on_page_checked']);   
    } else {
        delete_post_meta($post_id, 'include_image_on_page');
    }
}

/* * *************************************************************************************************** */
// Register Banner Content Metabox
/* * *************************************************************************************************** */

add_action('add_meta_boxes', 'nimbus_banner_meta_box');

function nimbus_banner_meta_box() {
    global $post;
    if (( get_option('page_on_front') ==  $post->ID )) {
        add_meta_box("banner_meta_box", __('Nimbus Frontpage Banner Panel', 'nimbus'), "nimbus_call_banner_meta_box", "page", "normal", "high");
    }
}

function nimbus_call_banner_meta_box($post) {

    wp_nonce_field(plugin_basename(__FILE__), 'banner_meta_box');

    if (get_post_meta($post->ID, 'frontpage_banner_content', true)) {
        $value = get_post_meta($post->ID, 'frontpage_banner_content', false);
    } else {
        $value[0] = '';
    }

    wp_editor($value[0], 'frontpage_banner_content');
}

/* * *************************************************************************************************** */
// Save Banner Content Metabox
/* * *************************************************************************************************** */

add_action('save_post', 'nimbus_banner_save_postdata');

function nimbus_banner_save_postdata($post_id) {

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;

    if (( isset($_POST['banner_meta_box']) ) && (!wp_verify_nonce($_POST['banner_meta_box'], plugin_basename(__FILE__)) ))
        return;

    if (( isset($_POST['post_type']) ) && ( 'page' == $_POST['post_type'] )) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }

    if (isset($_POST['frontpage_banner_content'])) {
        update_post_meta($post_id, 'frontpage_banner_content', $_POST['frontpage_banner_content']);
    }
}

/* * *************************************************************************************************** */
// Register Sidebar Select Box
/* * *************************************************************************************************** */

add_action("admin_init", "nimbus_sidebar_meta_box");

function nimbus_sidebar_meta_box() {

    add_meta_box("sidebar_meta_box", __('Nimbus Sidebar Options', 'nimbus'), "nimbus_call_sidebar_meta_box", "page", "side", "high");
    add_meta_box("sidebar_meta_box", __('Nimbus Sidebar Options', 'nimbus'), "nimbus_call_sidebar_meta_box", "post", "side", "high");
}

function nimbus_call_sidebar_meta_box() {

    global $post;

    $custom = get_post_custom($post->ID);
    if (isset($custom["alt_sidebar_select"])) {
        $alt_sidebar_select = $custom["alt_sidebar_select"][0];
    } else {
        $alt_sidebar_select = "";
    }
    echo '<input type="hidden" name="meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
    ?>  

    <p><?php __('Enter the number of the alternate sidebar you would like to apply. Leave blank to use default.', 'nimbus') ?></p>
    <table>
        <tr><td><label><?php _e('Sidebar #', 'nimbus') ?></label></td><td><input type="text" name="alt_sidebar_select" style="width:35px;" value="<?php echo $alt_sidebar_select; ?>" size="20" maxlength="2" /></td></tr> 
    </table>
    <?php
}

/* * *************************************************************************************************** */
// Save Sidebar Select Box
/* * *************************************************************************************************** */

add_action('save_post', 'nimbus_save_sidebar_meta_box');

function nimbus_save_sidebar_meta_box($post_id) {

    global $post;

    // verify nonce

    if (isset($_POST['meta_box_nonce'])) {
        if (!wp_verify_nonce($_POST['meta_box_nonce'], basename(__FILE__))) {
            return $post_id;
        }
    }

    // check autosave

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return $post_id;
    }

    // check permissions
    if (isset($_POST['post_type'])) {
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
    }

    if (isset($_POST['alt_sidebar_select'])) {
        update_post_meta($post_id, 'alt_sidebar_select', $_POST['alt_sidebar_select']);
    }
}



/* * *************************************************************************************************** */
// Load Admin Scripts
/* * *************************************************************************************************** */

add_action('admin_print_scripts', 'nimbus_admin_scripts');

if (!function_exists('nimbus_admin_scripts')) {
    function nimbus_admin_scripts() {

        if (is_admin()) {

            wp_enqueue_script('jquery');
            wp_enqueue_script('media-upload');
            wp_enqueue_script('thickbox');
            wp_register_script('charcount', get_template_directory_uri() . '/js/charCount.js', array('jquery'), '1.0');
            wp_enqueue_script('charcount');
            wp_register_script('nimbus_admin', get_template_directory_uri() . '/js/admin.js', array('jquery'), '1.0');
            wp_enqueue_script('nimbus_admin');
        }
    }
}

/* * *************************************************************************************************** */
// Load Admin CSS
/* * *************************************************************************************************** */

add_action('admin_print_styles', 'nimbus_admin_styles');

if (!function_exists('nimbus_admin_styles')) {
    function nimbus_admin_styles() {

        if (is_admin()) {

            wp_enqueue_style('thickbox');

            wp_register_style("admin_css", get_template_directory_uri() . "/css/admin.css", array(), "1.0", "all");
            wp_enqueue_style('admin_css');
        }
    }
}

/* * *************************************************************************************************** */
// Load Public Scripts
/* * *************************************************************************************************** */

add_action('wp_enqueue_scripts', 'nimbus_public_scripts');

if (!function_exists('nimbus_public_scripts')) {
    function nimbus_public_scripts() {

        if (!is_admin()) {

            wp_enqueue_script('jquery');

            wp_register_script('nibus_public', get_template_directory_uri() . '/js/nimbus_public.js', array('jquery'), '1.0' );
            wp_enqueue_script('nibus_public'); 

            wp_register_script('bootstrap', get_template_directory_uri() . '/js/jquery.bootstrap.min.js', array('jquery'), '2.2.2');
            wp_enqueue_script('bootstrap');

            wp_register_script('scrollpane', get_template_directory_uri() . '/js/jquery.jscrollpane.min.js', array('jquery'), '2.0');
            wp_enqueue_script('scrollpane');
        }
    }
}

/* * *************************************************************************************************** */
// Load Public CSS
/* * *************************************************************************************************** */


add_action('wp_print_styles', 'nimbus_public_styles');

if (!function_exists('nimbus_public_styles')) {
    function nimbus_public_styles() {

        if (!is_admin()) {

            wp_register_style("bootstrap", get_template_directory_uri() . "/css/bootstrap.min.css", array(), "1.0", "all");
            wp_enqueue_style('bootstrap');

            wp_register_style("bootstrap_responsive", get_template_directory_uri() . "/css/bootstrap-responsive.min.css", array(), "1.0", "all");
            wp_enqueue_style('bootstrap_responsive');

            wp_register_style("bootstrap_fix", get_template_directory_uri() . "/css/bootstrap-fix.css", array(), "1.0", "all");
            wp_enqueue_style('bootstrap_fix');
            
            wp_register_style( 'font-awesome', get_template_directory_uri() . "/css/font-awesome.min.css", array(), "1.0", "all");
            wp_enqueue_style( 'font-awesome' );

            wp_register_style("scrollpane", get_template_directory_uri() . "/css/jquery.jscrollpane.css", array(), "2.0", "all");
            wp_enqueue_style('scrollpane');
        }
    }
}

/* * *************************************************************************************************** */
// Register Gravatar
/* * *************************************************************************************************** */

add_filter('avatar_defaults', 'nimbus_gravatar');

if (!function_exists('nimbus_gravatar')) {
    function nimbus_gravatar($avatar_defaults) {
        $myavatar = nimbus_get_option('gravatar');
        $avatar_defaults[$myavatar] = "Custom Gravatar";
        return $avatar_defaults;
    }
}



