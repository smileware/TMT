<?php
/**
 * seed functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package seed
 */

/* LAYOUT */
if (!isset($GLOBALS['s_blog_layout']))          {$GLOBALS['s_blog_layout']          = 'full-width';}    // full-width, leftbar, rightbar
if (!isset($GLOBALS['s_blog_layout_single']))   {$GLOBALS['s_blog_layout_single']   = 'full-width';}    // full-width, leftbar, rightbar
if (!isset($GLOBALS['s_blog_columns_m']))       {$GLOBALS['s_blog_columns_m']       = '1';}             // 1,2,3
if (!isset($GLOBALS['s_blog_columns_d']))       {$GLOBALS['s_blog_columns_d']       = '3';}             // 1,2,3,4,5,6
if (!isset($GLOBALS['s_blog_columns_d_style'])) {$GLOBALS['s_blog_columns_d_style'] = 'card';}          // list, card, caption
if (!isset($GLOBALS['s_blog_profile']))         {$GLOBALS['s_blog_profile']         = 'enable';}        // disable, enable
if (!isset($GLOBALS['s_shop_layout']))          {$GLOBALS['s_shop_layout']          = 'full-width';}    // full-width, leftbar, rightbar
if (!isset($GLOBALS['s_shop_pagebuilder']))     {$GLOBALS['s_shop_pagebuilder']     = 'disable';}       // disable, enable
if (!isset($GLOBALS['s_logo_path']))            {$GLOBALS['s_logo_path']            = 'none';}          // theme folder relative path, such as img/logo.svg .
if (!isset($GLOBALS['s_logo_width']))           {$GLOBALS['s_logo_width']           = '200';}           // any number, use in Custom Logo
if (!isset($GLOBALS['s_logo_height']))          {$GLOBALS['s_logo_height']          = '100';}           // any number, use in Custom Logo
if (!isset($GLOBALS['s_thumb_width']))          {$GLOBALS['s_thumb_width']          = '360';}           // any number
if (!isset($GLOBALS['s_thumb_height']))         {$GLOBALS['s_thumb_height']         = '189';}           // any number
if (!isset($GLOBALS['s_thumb_crop']))           {$GLOBALS['s_thumb_crop']           = true;}            // true, false
if (!isset($GLOBALS['s_title_style']))          {$GLOBALS['s_title_style']          = 'breadcrumb';}        // minimal, banner

/* ADD-ON */
if (!isset($GLOBALS['s_member_url']))           {$GLOBALS['s_member_url']           = 'none';}          // none, url path such as: /my-account/
if (!isset($GLOBALS['s_member_label']))         {$GLOBALS['s_member_label']         = 'Member';}        // ex: Member, สมาชิก
if (!isset($GLOBALS['s_keen_slider']))          {$GLOBALS['s_keen_slider']          = 'enable';}        // disable, enable
if (!isset($GLOBALS['s_style_css']))            {$GLOBALS['s_style_css']            = 'disable';}       // disable, enable
if (!isset($GLOBALS['s_jquery']))               {$GLOBALS['s_jquery']               = 'disable';}       // disable, enable
if (!isset($GLOBALS['s_fontawesome']))          {$GLOBALS['s_fontawesome']          = 'disable';}       // disable, enable
if (!isset($GLOBALS['s_wp_comments']))          {$GLOBALS['s_wp_comments']          = 'disable';}       // disable, enable
if (!isset($GLOBALS['s_admin_bar']))            {$GLOBALS['s_admin_bar']            = 'hide';}          // hide, show

/* CHECK WOOCOMMERCE */
include_once ABSPATH . 'wp-admin/includes/plugin.php';
if (is_plugin_active('woocommerce/woocommerce.php')) {
    $GLOBALS['s_is_woo']       = true;
    $GLOBALS['s_member_url']   = '/my-account/';
} else {
    $GLOBALS['s_is_woo']       = false;
}

/* Admin Bar */
if ($GLOBALS['s_admin_bar'] == 'hide') {
    add_filter('show_admin_bar', '__return_false');
}

/**
 * Setup Theme
 */
if (!function_exists('seed_setup')) {
    function seed_setup()
    {
        load_theme_textdomain('seed', get_template_directory() . '/languages');
        add_theme_support('automatic-feed-links');
        add_theme_support('title-tag');
        add_theme_support('custom-logo', array(
            'width'       => $GLOBALS['s_logo_width'],
            'height'      => $GLOBALS['s_logo_height'],
            'flex-width'  => true,
            'flex-height' => true,
        ));
        add_theme_support('post-thumbnails');
        set_post_thumbnail_size($GLOBALS['s_thumb_width'], $GLOBALS['s_thumb_height'], $GLOBALS['s_thumb_crop']);
        register_nav_menus(array(
            'primary' => esc_html__('Main Menu', 'seed'),
            'mobile'  => esc_html__('Mobile Menu', 'seed'),
        ));
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));
        add_theme_support('custom-background');
        add_theme_support('customize-selective-refresh-widgets');
        add_theme_support('align-wide');
    }
}
add_action('after_setup_theme', 'seed_setup');

function seed_content_width()
{
    $GLOBALS['content_width'] = apply_filters('seed_content_width', 750);
}
add_action('after_setup_theme', 'seed_content_width', 0);

/**
 * Register widget area.
 */
function seed_widgets_init()
{
    register_sidebar(array(
        'name'          => esc_html__('Footbar', 'seed'),
        'id'            => 'footbar',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));

}
add_action('widgets_init', 'seed_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function seed_scripts()
{

    wp_enqueue_style('s-mobile', get_theme_file_uri('/css/mobile.css'), array(), false);
    wp_enqueue_style('s-desktop', get_theme_file_uri('/css/desktop.css'), array(), false , '(min-width: 1025px)');

    if ($GLOBALS['s_style_css'] == 'enable') {
        wp_enqueue_style('s-style', get_stylesheet_uri());
    }

    if ($GLOBALS['s_is_woo']) {
        wp_enqueue_style('s-woo', get_theme_file_uri('/css/woo.css'));
    }

    if ($GLOBALS['s_fontawesome'] == 'enable') {
        wp_enqueue_style('s-fa', get_theme_file_uri('/fonts/fontawesome/css/all.min.css'), array(),'5.10.1');
    }

    wp_enqueue_script('s-scripts', get_theme_file_uri('/js/scripts.js'), array(), false, true);
    
    if ($GLOBALS['s_keen_slider'] == 'enable') {
        wp_enqueue_script('s-slider', get_theme_file_uri('/js/keen-slider.js'), array(), false, true);
    }
    
    wp_enqueue_script('s-vanilla', get_theme_file_uri('/js/main-vanilla.js'), array(), false, true);

    if ($GLOBALS['s_jquery'] == 'enable') {
        wp_enqueue_script('s-jquery', get_theme_file_uri('/js/main-jquery.js'), array('jquery'), false, true);
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'seed_scripts');

/**
 * Add backend styles for Gutenberg.
 */
add_action('enqueue_block_editor_assets', 'seed_add_gutenberg_assets');
function seed_add_gutenberg_assets()
{
    wp_enqueue_style('seed-gutenberg', get_theme_file_uri('/css/wp-gutenberg.css'), false);
}

/**
 * Admin CSS
 */
function seed_admin_style()
{
    wp_enqueue_style('seed-admin-style', get_template_directory_uri() . '/css/wp-admin.css');
}
add_action('admin_enqueue_scripts', 'seed_admin_style');


/**
 * Remove "Category: ", "Tag: ", "Taxonomy: " from archive title
 */
add_filter('get_the_archive_title', 'seed_get_the_archive_title');
function seed_get_the_archive_title($title)
{
    if (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = single_tag_title('', false);
    } elseif (is_post_type_archive()) {
        $title = post_type_archive_title('', false);
    } elseif (is_author()) {
        $title = '<span class="vcard">' . get_the_author() . '</span>';
    } elseif (is_tax()) {
        $title = single_term_title('', false);
    }
    return $title;
}

/**
 * Custom WooCommerce Settings
 */
if ($GLOBALS['s_is_woo']) {
    require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Custom Shortcode
 */
require get_template_directory() . '/inc/shortcode.php';

/**
 * Redirect after login -  to current page
 */
function seed_redirect_to_request( $redirect_to, $request, $user ){
    return $request;
}
if($GLOBALS['s_member_url'] != 'none') {  
    add_filter('login_redirect', 'seed_redirect_to_request', 10, 3);
}


/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {require get_template_directory() . '/inc/jetpack.php';}


// [FACET]:: Remove count on label
add_filter( 'facetwp_facet_dropdown_show_counts', '__return_false' );


if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
}

/* === Social Media Block === */
if (function_exists('acf_register_block_type')) {
    add_action( 'acf/init', 'acf_register_social_media' );
}
function acf_register_social_media() { 
    acf_register_block_type(
        array(
            'name' => 'social-media',
            'title' => 'Social Media',
            'description' => __('Display Social Media'),
            'render_template' => 'template-parts/blocks/social-media.php',
            'icon' => array(
                'foreground' => '#ffffff',
                'background' => '#0093F9',
                'src' => 'share',
            ),
            'keywords' => array('social', 'media')
        )
    );
}

/* === Menu ID Block === */
if (function_exists('acf_register_block_type')) {
    add_action( 'acf/init', 'acf_menu_id' );
}
function acf_menu_id() { 
    acf_register_block_type(
        array(
            'name' => 'Menu ID',
            'title' => 'Menu ID',
            'description' => __('Display MENU BY ID'),
            'render_template' => 'template-parts/blocks/menu-id.php',
            'icon' => array(
                'foreground' => '#ffffff',
                'background' => '#0981C4',
                'src' => 'menu-alt3',
            ),
            'keywords' => array('news')
        )
    );
}

/* === Menu Links Block === */
if (function_exists('acf_register_block_type')) {
    add_action( 'acf/init', 'acf_menu_links' );
}
function acf_menu_links() { 
    acf_register_block_type(
        array(
            'name' => 'Menu Links',
            'title' => 'Menu Links',
            'description' => __('Display alll menu repeater'),
            'render_template' => 'template-parts/blocks/menu-links.php',
            'icon' => array(
                'foreground' => '#ffffff',
                'background' => '#0981C4',
                'src' => 'menu-alt3',
            ),
            'keywords' => array('menu')
        )
    );
}




/* === Menu Links Block === */
if (function_exists('acf_register_block_type')) {
    add_action( 'acf/init', 'acf_service_and_solution' );
}
function acf_service_and_solution() { 
    acf_register_block_type(
        array(
            'name' => 'Service & Solution',
            'title' => 'Service & Solution',
            'description' => __('Display selected service & solution'),
            'render_template' => 'template-parts/blocks/service-and-solution.php',
            'icon' => array(
                'foreground' => '#ffffff',
                'background' => '#0981C4',
                'src' => 'hammer',
            ),
            'keywords' => array('menu')
        )
    );
}

/* === Menu Links Block === */
if (function_exists('acf_register_block_type')) {
    add_action( 'acf/init', 'acf_stock' );
}
function acf_stock() { 
    acf_register_block_type(
        array(
            'name' => 'Stock',
            'title' => 'Stock',
            'description' => __('Display stock infomation'),
            'render_template' => 'template-parts/blocks/stock.php',
            'icon' => array(
                'foreground' => '#ffffff',
                'background' => '#0981C4',
                'src' => 'chart-area',
            ),
            'keywords' => array('menu')
        )
    );
}

/* === Quick Menu Block === */
if (function_exists('acf_register_block_type')) {
    add_action( 'acf/init', 'acf_quick_menu' );
}
function acf_quick_menu() { 
    acf_register_block_type(
        array(
            'name' => 'Quick Menu',
            'title' => 'Quick Menu',
            'description' => __('Display Quick Menu'),
            'render_template' => 'template-parts/blocks/quick-menu.php',
            'icon' => array(
                'foreground' => '#ffffff',
                'background' => '#0981C4',
                'src' => 'grid-view',
            ),
            'keywords' => array('menu')
        )
    );
}


/* === Quick Menu Block === */
if (function_exists('acf_register_block_type')) {
    add_action( 'acf/init', 'acf_file_download' );
}
function acf_file_download() { 
    acf_register_block_type(
        array(
            'name' => 'File Download',
            'title' => 'File Download',
            'description' => __('Display File Download'),
            'render_template' => 'template-parts/blocks/file-download.php',
            'icon' => array(
                'foreground' => '#ffffff',
                'background' => '#0981C4',
                'src' => 'download',
            ),
            'keywords' => array('download')
        )
    );
}

/* === Lastest News === */
if (function_exists('acf_register_block_type')) {
    add_action( 'acf/init', 'acf_latest_news' );
}
function acf_latest_news() { 
    acf_register_block_type(
        array(
            'name' => 'Lastest News',
            'title' => 'Lastest News',
            'description' => __('Display Lastest News'),
            'render_template' => 'template-parts/blocks/lastest-news.php',
            'icon' => array(
                'foreground' => '#ffffff',
                'background' => '#0981C4',
                'src' => 'admin-site-alt2',
            ),
            'keywords' => array('download')
        )
    );
}

/* === Lastest Featured Single Product === */
if (function_exists('acf_register_block_type')) {
    add_action( 'acf/init', 'acf_featured_single_product' );
}
function acf_featured_single_product() { 
    acf_register_block_type(
        array(
            'name' => 'Feature Single Product',
            'title' => 'Feature Single Product',
            'description' => __('Display Feature Single Product'),
            'render_template' => 'template-parts/blocks/featured-product.php',
            'icon' => array(
                'foreground' => '#ffffff',
                'background' => '#0981C4',
                'src' => 'star-filled',
            ),
            'keywords' => array('download')
        )
    );
}

/* === History === */
if (function_exists('acf_register_block_type')) {
    add_action( 'acf/init', 'acf_history' );
}
function acf_history() { 
    acf_register_block_type(
        array(
            'name' => 'History',
            'title' => 'History',
            'description' => __('Display History'),
            'render_template' => 'template-parts/blocks/history.php',
            'icon' => array(
                'foreground' => '#ffffff',
                'background' => '#0981C4',
                'src' => 'store',
            ),
            'keywords' => array('download')
        )
    );
}

/* === Sustainability Documents === */
if (function_exists('acf_register_block_type')) {
    add_action( 'acf/init', 'acf_sustainability_documents' );
}
function acf_sustainability_documents() { 
    acf_register_block_type(
        array(
            'name' => 'Sustainability Document',
            'title' => 'Sustainability Document',
            'description' => __('Display Sustainability Document'),
            'render_template' => 'template-parts/blocks/sustainability-documents.php',
            'icon' => array(
                'foreground' => '#ffffff',
                'background' => '#0981C4',
                'src' => 'media-document',
            ),
            'keywords' => array('download')
        )
    );
}


/* === Sustainability Documents === */
if (function_exists('acf_register_block_type')) {
    add_action( 'acf/init', 'acf_sustainability_documents_with_cover' );
}
function acf_sustainability_documents_with_cover() { 
    acf_register_block_type(
        array(
            'name' => 'Sustainability Document with Cover',
            'title' => 'Sustainability Document with Cover',
            'description' => __('Display Sustainability Document with Cover'),
            'render_template' => 'template-parts/blocks/sustainability-documents-cover.php',
            'icon' => array(
                'foreground' => '#ffffff',
                'background' => '#0981C4',
                'src' => 'media-document',
            ),
            'keywords' => array('download')
        )
    );
}

/* === Sustainability Projects and Activities === */
if (function_exists('acf_register_block_type')) {
    add_action( 'acf/init', 'acf_sustainability_news' );
}
function acf_sustainability_news() { 
    acf_register_block_type(
        array(
            'name' => 'Sustainability News',
            'title' => 'Sustainability News',
            'description' => __('Display Sustainability News'),
            'render_template' => 'template-parts/blocks/sustainability-news.php',
            'icon' => array(
                'foreground' => '#ffffff',
                'background' => '#0981C4',
                'src' => 'admin-post',
            ),
            'keywords' => array('download')
        )
    );
}


/* === Single Download File === */
if (function_exists('acf_register_block_type')) {
    add_action( 'acf/init', 'acf_single_download_file' );
}
function acf_single_download_file() { 
    acf_register_block_type(
        array(
            'name' => 'Single Download File',
            'title' => 'Single Download File',
            'description' => __('Display Single Download File'),
            'render_template' => 'template-parts/blocks/single-download.php',
            'icon' => array(
                'foreground' => '#ffffff',
                'background' => '#0981C4',
                'src' => 'media-document',
            ),
            'keywords' => array('download')
        )
    );
}


/* === Posts === */
if (function_exists('acf_register_block_type')) {
    add_action( 'acf/init', 'acf_post_news' );
}
function acf_post_news() { 
    acf_register_block_type(
        array(
            'name' => 'Post News',
            'title' => 'Post News',
            'description' => __('Display Post News'),
            'render_template' => 'template-parts/blocks/post-news.php',
            'icon' => array(
                'foreground' => '#ffffff',
                'background' => '#0981C4',
                'src' => 'admin-post',
            ),
            'keywords' => array('download')
        )
    );
}

/* === Slider Text with Image === */
if (function_exists('acf_register_block_type')) {
    add_action( 'acf/init', 'acf_slider_testimonial' );
}
function acf_slider_testimonial() { 
    acf_register_block_type(
        array(
            'name' => 'Slider Testimonial',
            'title' => 'Slider Testimonial',
            'description' => __('Display Slider Testimonial'),
            'render_template' => 'template-parts/blocks/slider-testimonial.php',
            'icon' => array(
                'foreground' => '#ffffff',
                'background' => '#0981C4',
                'src' => 'format-quote',
            ),
            'keywords' => array('download')
        )
    );
}

/* === Slider Internship Opportunity === */
if (function_exists('acf_register_block_type')) {
    add_action( 'acf/init', 'acf_slider_internship_opportunity' );
}
function acf_slider_internship_opportunity() { 
    acf_register_block_type(
        array(
            'name' => 'Slider Internship Opportunity',
            'title' => 'Slider Internship Opportunity',
            'description' => __('Display Slider Internship Opportunity'),
            'render_template' => 'template-parts/blocks/slider-internship-opportunity.php',
            'icon' => array(
                'foreground' => '#ffffff',
                'background' => '#0981C4',
                'src' => 'format-quote',
            ),
            'keywords' => array('download')
        )
    );
}



/* === Slider Internship Opportunity === */
if (function_exists('acf_register_block_type')) {
    add_action( 'acf/init', 'acf_contact_card' );
}
function acf_contact_card() { 
    acf_register_block_type(
        array(
            'name' => 'Contact Card',
            'title' => 'Contact Card',
            'description' => __('Display Contact Card'),
            'render_template' => 'template-parts/blocks/contact-card.php',
            'icon' => array(
                'foreground' => '#ffffff',
                'background' => '#0981C4',
                'src' => 'format-quote',
            ),
            'keywords' => array('download')
        )
    );
}

/* === Flie Link === */
if (function_exists('acf_register_block_type')) {
    add_action( 'acf/init', 'acf_file_link' );
}
function acf_file_link() { 
    acf_register_block_type(
        array(
            'name' => 'File Link',
            'title' => 'File Link',
            'description' => __('Display File Link'),
            'render_template' => 'template-parts/blocks/file-link.php',
            'icon' => array(
                'foreground' => '#ffffff',
                'background' => '#0981C4',
                'src' => 'format-quote',
            ),
            'keywords' => array('download')
        )
    );
}


if(is_front_page()) { 
    function fetch_stock_information() {
        $transient_key = 'stock_information_cache';
        $cached_data = get_transient($transient_key);
        try { 
            $url = 'https://www.set.or.th/en/market/product/stock/quote/tmt/price';
            $section = file_get_contents($url);
            $dom = new DOMDocument();
            libxml_use_internal_errors(true);
            $dom->loadHTML($section);
            $finder = new DomXPath($dom);
    
            $classname = "quote-market-lastInfo";
            $spaner = $finder->query("//*[contains(@class, '$classname')]");
            $date = $spaner->item(1)->nodeValue;
            $date = str_replace('Last Update :', '', $date);
            $timestamp = strtotime($date);
            $localized_date = date_i18n('d M Y H:i:s', $timestamp);
            // ราคาเปิด
            $classopen = "item-list-details d-flex flex-column price-info-stock-detail col-5";
            $open = $finder->query("//*[contains(@class, '$classopen')]");
            $openvalue = $open->item(5)->nodeValue;
            $openvalue = str_replace('Open', '', $openvalue);
            // ราคาปิด
            $classclosing = "value text-white mb-0 me-2 lh-1";
            $closing = $finder->query("//*[contains(@class, '$classclosing')]");
            $closingvalue = $closing->item(0)->nodeValue;
            // ราคาก่อนหน้า
            $classprior = "item-list-details d-flex flex-column price-info-stock-detail col-5";
            $prior = $finder->query("//*[contains(@class, '$classprior')]");
            $priorvalue = $prior->item(4)->nodeValue;
            $priorvalue = str_replace('Prior', '', $priorvalue);
            // เปลี่ยนแปลง
            $classpercent = "d-flex mb-0 pb-2";
            $percent = $finder->query("//*[contains(@class, '$classpercent')]");
            $percentvalue = $percent->item(0)->nodeValue;
    
            $value = array(
                'stock_date' => trim($localized_date) , 
                'stock_date_en' => trim($date), 
                'stock_price' => trim($closingvalue),
                'stock_change' => trim($percentvalue),
                'stock_open' =>  $openvalue,
                'stock_prior' =>  $priorvalue
            );
    
            set_transient($transient_key, $value, HOUR_IN_SECONDS);
            foreach ($value as $field_key => $field_value) {
                if (!empty(trim($field_value))) {
                    update_field($field_key, $field_value, 'option');
                }
            }   
    
        }catch (Exception $e) {
            echo $e;
        }
    }
    fetch_stock_information();
}



/**
 * Filter to change breadcrumb html.
 *
 * @param  html  $html Breadcrumb html.
 * @param  array $crumbs items
 * @param  class $class Breadcrumb class
 * @return html  $html.
 */
add_filter( 'rank_math/frontend/breadcrumb/items', function( $crumbs, $class ) {
    if ( ICL_LANGUAGE_CODE == 'en' && isset($crumbs[0][0]) ) { 
        $crumbs[0][0] = "Home";
    }
    return $crumbs;
}, 10, 3);

/**
 * Filter to change breadcrumb html.
 *
 * @param  html  $html Breadcrumb html.
 * @param  array $crumbs items
 * @param  class $class Breadcrumb class
 * @return html  $html.
 */
add_filter( 'rank_math/frontend/breadcrumb/html', function( $html, $crumbs, $class ) {
    $home_svg = '<svg class="_mobile" xmlns="http://www.w3.org/2000/svg" width="10" height="12" viewBox="0 0 10 12" fill="none" style="margin-top: -4px;">
    <path d="M4.42749 0.806163C4.74874 0.502438 5.25126 0.502438 5.57251 0.806163L9.60875 4.62228C9.8585 4.8584 10 5.18691 10 5.53059V10.1716C10 10.862 9.44033 11.4216 8.75 11.4216H7.08333C6.39297 11.4216 5.83333 10.862 5.83333 10.1716V8.08829C5.83333 7.8582 5.64678 7.67165 5.41667 7.67165H4.58333C4.35322 7.67165 4.16667 7.8582 4.16667 8.08829V10.1716C4.16667 10.862 3.60702 11.4216 2.91667 11.4216H1.25C0.559642 11.4216 0 10.862 0 10.1716V5.53059C0 5.18691 0.1415 4.8584 0.391233 4.62228L4.42749 0.806163ZM5 1.4117L0.963742 5.22782C0.8805 5.30652 0.833333 5.41603 0.833333 5.53059V10.1716C0.833333 10.4017 1.01988 10.5883 1.25 10.5883H2.91667C3.14678 10.5883 3.33333 10.4017 3.33333 10.1716V8.08829C3.33333 7.39796 3.89297 6.83831 4.58333 6.83831H5.41667C6.10702 6.83831 6.66667 7.39796 6.66667 8.08829V10.1716C6.66667 10.4017 6.85325 10.5883 7.08333 10.5883H8.75C8.98008 10.5883 9.16667 10.4017 9.16667 10.1716V5.53059C9.16667 5.41603 9.1195 5.30652 9.03625 5.22782L5 1.4117Z" fill="currentColor"/></svg><span class="_desktop">'. __("หน้าหลัก","wpml_theme") .'</span>';
    $new_html = str_replace( 'หน้าหลัก', $home_svg, $html );
	return $new_html;
}, 10, 3);

// // FACETWP set default dropdown. [PHP Version by no longer use it]
// add_filter( 'facetwp_preload_url_vars', function( $url_vars ) {
//     /*
//         TODO:: Change slug Depending on Language. 
//     */
//     if ( 'sustainability-management' == FWP()->helper->get_uri() ) {
//         if ( empty( $url_vars['year'] ) ) {
//             $first_year_option = get_first_facet_option('year');
//             if ($first_year_option) {
//                 $url_vars['year'] = [ $first_year_option ];
//             }
//         }
//     }
// 	if ( 'en/sustainability-management' == FWP()->helper->get_uri() ) {
//         if ( empty( $url_vars['year'] ) ) {
//             $first_year_option = get_first_facet_option('year');
//             if ($first_year_option) {
//                 $url_vars['year'] = [ $first_year_option ];
//             }
//         }
//     }
	
//     return $url_vars;
// } );

// function get_first_facet_option($facet_name) {
//     $facets = FWP()->helper->get_facets();
//     foreach ($facets as $facet) {
//         if ($facet['name'] === $facet_name) {
//                $taxonomy_name = str_replace('tax/', '', $facet['source']);
//                if (taxonomy_exists($taxonomy_name)) {
//                    $terms = get_terms(['taxonomy' => $taxonomy_name, 'number' => 1, 'hide_empty' => true]);
//                    if (!is_wp_error($terms) && !empty($terms)) {
//                        return $terms[0]->slug;
//                    }
//                }
//                break;
//         }
//     }
//     return null; 
// }

function get_permalink_by_title($title) {
    $args = array(
        'post_type' => 'page',
        'title' => $title,
        'posts_per_page' => 1
    );

    $query = new WP_Query($args);
    $permalink = '';

    if ($query->have_posts()) {
        $query->the_post();
        $permalink = get_permalink();
    }

    wp_reset_postdata();
    return $permalink;
}

// Change the Excerpt Length
function mytheme_custom_excerpt_length( $length ) {
    return 2000;
}
add_filter( 'excerpt_length', 'mytheme_custom_excerpt_length', 999 );
    