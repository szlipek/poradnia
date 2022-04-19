<?php

@ini_set( 'upload_max_size' , '64M' );
@ini_set( 'post_max_size', '64M');
@ini_set( 'max_execution_time', '300' );

function load_parent_stylesheet() {
  wp_enqueue_style( 'spmedia_style', get_template_directory_uri() . '/style.css' );
}

function js_scripts() {
    wp_enqueue_script('spmedia_script', '/wp-content/themes/poradnia/assets/js/script-min.js');

}

add_action( 'wp_enqueue_scripts', 'load_parent_stylesheet' );
add_action('wp_footer', 'js_scripts');
add_theme_support( 'post-thumbnails' );



function cc_mime_types($mimes) {
$mimes['svg'] = 'image/svg+xml';
return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');




function pagination($pages = '', $range = 4)
    {
        $showitems = ($range * 2)+1;

        $paged = 1;

        $req_uri = array_reverse(explode('/', $_SERVER['REQUEST_URI']));
        foreach ($req_uri as $value) {
           if(is_numeric($value)) {
                $paged = $value;
        	break;
           }
        }
        if(empty($paged)) $paged = 1;

        if($pages == '')  {
            global $wp_query;
            $pages = $wp_query->max_num_pages;
            if(!$pages) {
                $pages = 1;
            }
        }

        if(1 != $pages) {
            echo "<div class=\"pagination\">";
                if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo; First</a>";
                if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo; Previous</a>";

                for ($i=1; $i <= $pages; $i++) {
                    if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
                        echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href='".get_pagenum_link($i)."' class=\"inactive\">".$i."</a>";
                    }
                }

                if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\"> &rsaquo;</a>";
                if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'> &raquo;</a>";
                echo "</div>\n";
        }
    }


function wpb_custom_new_menu() {
register_nav_menus( array(
'my-menu' => __( 'my menu', 'text_domain' ),
'footer-menu'  => __( 'Footer Menu', 'text_domain' ),
) );
}
add_action( 'init', 'wpb_custom_new_menu' );


if( function_exists('acf_add_options_page') ) {

	acf_add_options_page(array(
		'page_title' 	=> 'Ustawienia globalne',
		'menu_title'	=> 'Ustawienia globalne',
		'menu_slug' 	=> 'global',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

}

// Blocks ACF

add_action('acf/init', 'my_acf_init_block_types');
function my_acf_init_block_types() {

    if( function_exists('acf_register_block_type') ) {

        // register a header block.
        acf_register_block_type(array(
            'name'              => 'header',
            'title'             => __('Slider - poradnia'),
            'description'       => __('Slider na stronę główną.'),
            'render_template'   => 'modules/blocks/header.php',
            'category'          => 'formatting',
            'icon'              => 'slides',
            'keywords'          => array( 'header'),
        ));

        // register a text with icons block.
        acf_register_block_type(array(
            'name'              => 'text',
            'title'             => __('Sekcja tekstowa z ikonkami - poradnia'),
            'description'       => __('Sekcja z nagłówkiem, tekstem, ikonkami oraz linkiem.'),
            'render_template'   => 'modules/blocks/text-with-icons.php',
            'category'          => 'formatting',
            'icon'              => 'text-page',
            'keywords'          => array( 'text'),
        ));

        // register a separator block.
        acf_register_block_type(array(
            'name'              => 'separator',
            'title'             => __('Separator - poradnia'),
            'description'       => __('łukowata kreska przerywana oddzielająca sekcje.'),
            'render_template'   => 'modules/blocks/separator.php',
            'category'          => 'formatting',
            'icon'              => 'minus',
            'keywords'          => array( 'separator'),
        ));

        // register a services block.
        acf_register_block_type(array(
            'name'              => 'services',
            'title'             => __('Usługi - poradnia'),
            'description'       => __('Sekcja z usługami.'),
            'render_template'   => 'modules/blocks/services.php',
            'category'          => 'formatting',
            'icon'              => 'money-alt',
            'keywords'          => array( 'separator'),
        ));

        // register a opinions block.
        acf_register_block_type(array(
            'name'              => 'opinions',
            'title'             => __('Opinie - poradnia'),
            'description'       => __('Sekcja z opiniami.'),
            'render_template'   => 'modules/blocks/opinions.php',
            'category'          => 'formatting',
            'icon'              => 'thumbs-up',
            'keywords'          => array( 'separator'),
        ));

        // register a products block.
        acf_register_block_type(array(
            'name'              => 'products',
            'title'             => __('Produkty - poradnia'),
            'description'       => __('Sekcja z produktami.'),
            'render_template'   => 'modules/blocks/products.php',
            'category'          => 'formatting',
            'icon'              => 'megaphone',
            'keywords'          => array( 'separator'),
        ));

        // register a products block.
        acf_register_block_type(array(
            'name'              => 'products1',
            'title'             => __('Produkty duże - poradnia'),
            'description'       => __('Sekcja z produktami.'),
            'render_template'   => 'modules/blocks/products1.php',
            'category'          => 'formatting',
            'icon'              => 'megaphone',
            'keywords'          => array( 'separator'),
        ));

        // register a ebook block.
        acf_register_block_type(array(
            'name'              => 'ebook',
            'title'             => __('Ebook - poradnia'),
            'description'       => __('Sekcja z ebookiem.'),
            'render_template'   => 'modules/blocks/ebook.php',
            'category'          => 'formatting',
            'icon'              => 'book',
            'keywords'          => array( 'separator'),
        ));

        // register a ebook block.
        acf_register_block_type(array(
            'name'              => 'ebook1',
            'title'             => __('Ebook z ceną - poradnia'),
            'description'       => __('Sekcja z ebookiem z ceną.'),
            'render_template'   => 'modules/blocks/ebook1.php',
            'category'          => 'formatting',
            'icon'              => 'book',
            'keywords'          => array( 'separator'),
        ));

        // register a text block.
        acf_register_block_type(array(
            'name'              => 'full-text',
            'title'             => __('Tekst - poradnia'),
            'description'       => __('Sekcja tekstowa.'),
            'render_template'   => 'modules/blocks/text.php',
            'category'          => 'formatting',
            'icon'              => 'editor-textcolor',
            'keywords'          => array( 'separator'),
        ));

        // register a faq block.
        acf_register_block_type(array(
            'name'              => 'faq',
            'title'             => __('FAQ - poradnia'),
            'description'       => __('Sekcja z FAQ.'),
            'render_template'   => 'modules/blocks/faq.php',
            'category'          => 'formatting',
            'icon'              => 'sos',
            'keywords'          => array( 'separator'),
        ));

        // register a title block.
        acf_register_block_type(array(
            'name'              => 'title',
            'title'             => __('Tytuł - poradnia'),
            'description'       => __('Sekcja z tytulem.'),
            'render_template'   => 'modules/blocks/title.php',
            'category'          => 'formatting',
            'icon'              => 'heading',
            'keywords'          => array( 'separator'),
        ));

        // register a blocks.
        acf_register_block_type(array(
            'name'              => 'blocks',
            'title'             => __('Bloki - poradnia'),
            'description'       => __('Sekcja z blokami.'),
            'render_template'   => 'modules/blocks/blocks.php',
            'category'          => 'formatting',
            'icon'              => 'block-default',
            'keywords'          => array( 'separator'),
        ));

        // register a breadcrumbs.
        acf_register_block_type(array(
            'name'              => 'breadcrumbs',
            'title'             => __('Breadcrumbs - poradnia'),
            'description'       => __('Sekcja z breadcrumbs.'),
            'render_template'   => 'modules/blocks/breadcrumbs.php',
            'category'          => 'formatting',
            'icon'              => 'ellipsis',
            'keywords'          => array( 'separator'),
        ));

        // register a three columns.
        acf_register_block_type(array(
            'name'              => 'three-columns',
            'title'             => __('3 kolumny - poradnia'),
            'description'       => __('Sekcja z 3 kolumnami.'),
            'render_template'   => 'modules/blocks/three-columns.php',
            'category'          => 'formatting',
            'icon'              => 'editor-textcolor',
            'keywords'          => array( 'separator'),
        ));

        // register a two columns.
        acf_register_block_type(array(
            'name'              => 'two-columns',
            'title'             => __('2 kolumny - poradnia'),
            'description'       => __('Sekcja z 2 kolumnami w prawej kolumnie zdjęcie .'),
            'render_template'   => 'modules/blocks/two-columns.php',
            'category'          => 'formatting',
            'icon'              => 'editor-textcolor',
            'keywords'          => array( 'separator'),
        ));

         // register a three columns.
         acf_register_block_type(array(
             'name'              => 'info',
             'title'             => __('Blok informacyjny  - poradnia'),
             'description'       => __('Sekcja z informacjami.'),
             'render_template'   => 'modules/blocks/info.php',
             'category'          => 'formatting',
             'icon'              => 'editor-textcolor',
             'keywords'          => array( 'separator'),
         ));

         // register a three columns.
         acf_register_block_type(array(
             'name'              => 'forms',
             'title'             => __('Blok z formami porady  - poradnia'),
             'description'       => __('Sekcja z formami porady.'),
             'render_template'   => 'modules/blocks/forms.php',
             'category'          => 'formatting',
             'icon'              => 'editor-textcolor',
             'keywords'          => array( 'separator'),
         ));



         // register a offert list.
         acf_register_block_type(array(
             'name'              => 'offer',
             'title'             => __('Blok z ofertą  - poradnia'),
             'description'       => __('Sekcja z ofertą.'),
             'render_template'   => 'modules/blocks/offer.php',
             'category'          => 'formatting',
             'icon'              => 'editor-textcolor',
             'keywords'          => array( 'separator'),
         ));

         // register a offert list with price.
         acf_register_block_type(array(
             'name'              => 'offer1',
             'title'             => __('Blok z ofertą i ceną  - poradnia'),
             'description'       => __('Sekcja z ofertą i ceną.'),
             'render_template'   => 'modules/blocks/offer-price.php',
             'category'          => 'formatting',
             'icon'              => 'editor-textcolor',
             'keywords'          => array( 'separator'),
         ));

         // register a about me
         acf_register_block_type(array(
             'name'              => 'about',
             'title'             => __('Blok o mnie  - poradnia'),
             'description'       => __('Sekcja z informacjami o mnie.'),
             'render_template'   => 'modules/blocks/about.php',
             'category'          => 'formatting',
             'icon'              => 'editor-textcolor',
             'keywords'          => array( 'separator'),
         ));


         // register a packages
         acf_register_block_type(array(
             'name'              => 'packages',
             'title'             => __('Pakiety  - poradnia'),
             'description'       => __('Sekcja pakietami.'),
             'render_template'   => 'modules/blocks/packages.php',
             'category'          => 'formatting',
             'icon'              => 'megaphone',
             'keywords'          => array( 'separator'),
         ));
         // register a training
         acf_register_block_type(array(
             'name'              => 'training',
             'title'             => __('Szkolenia  - poradnia'),
             'description'       => __('Sekcja szkolenia.'),
             'render_template'   => 'modules/blocks/training.php',
             'category'          => 'formatting',
             'icon'              => 'megaphone',
             'keywords'          => array( 'separator'),
         ));

        // register a product title
         acf_register_block_type(array(
             'name'              => 'product-title',
             'title'             => __('Blok z tytułem  - poradnia'),
             'description'       => __('Sekcja tytułowa.'),
             'render_template'   => 'modules/blocks/product-title.php',
             'category'          => 'formatting',
             'icon'              => 'editor-textcolor',
             'keywords'          => array( 'separator'),
         ));

         // register a product block
         acf_register_block_type(array(
             'name'              => 'product-block',
             'title'             => __('Blok z produktem  - poradnia'),
             'description'       => __('Sekcja z produktem.'),
             'render_template'   => 'modules/blocks/product-block.php',
             'category'          => 'formatting',
             'icon'              => 'editor-textcolor',
             'keywords'          => array( 'separator'),
         ));
         // register a download section
         acf_register_block_type(array(
             'name'              => 'download',
             'title'             => __('Blok plikami do pobrania  - poradnia'),
             'description'       => __('Sekcja z plikami do pobrania.'),
             'render_template'   => 'modules/blocks/download.php',
             'category'          => 'formatting',
             'icon'              => 'editor-textcolor',
             'keywords'          => array( 'separator'),
         ));


    }
}

// Add Custom WooCommerce Loop start

function woocommerce_product_loop_start( $echo = true ) {
    ob_start();
    echo '<div class="related__box">';
    if ( $echo )
        echo ob_get_clean();
    else
        return ob_get_clean();
}


// excerpt length

function spmedia_excerpt_length( $length ) {
    return 20;
}
add_filter( 'excerpt_length', 'spmedia_excerpt_length', 999 );

// cart to menu

add_shortcode ('woo_cart_but', 'woo_cart_but' );
function woo_cart_but() {
	ob_start();

        $cart_count = WC()->cart->cart_contents_count; // Set variable for cart item count
        $cart_url = wc_get_cart_url();  // Set Cart URL

        ?>
        <a class="menu-item cart-contents" href="<?php echo $cart_url; ?>" title="My Basket">
	    <?php
        if ( $cart_count > 0 ) {
       ?>
            <span class="cart-contents-count"><?php echo $cart_count; ?></span>
        <?php
        }
        ?>
        <img src="/wp-content/themes/poradnia/img/cart.svg" alt="Koszyk" width="30" height="33" />
        </a>
        <?php

    return ob_get_clean();

}

add_filter( 'woocommerce_add_to_cart_fragments', 'woo_cart_but_count' );

function woo_cart_but_count( $fragments ) {

    ob_start();

    $cart_count = WC()->cart->cart_contents_count;
    $cart_url = wc_get_cart_url();

    ?>
    <a class="cart-contents menu-item" href="<?php echo $cart_url; ?>" title="<?php _e( 'View your shopping cart' ); ?>">
	<?php
    if ( $cart_count > 0 ) {
        ?>
        <span class="cart-contents-count"><?php echo $cart_count; ?></span>
        <?php
    }
        ?>
        <img src="/wp-content/themes/poradnia/img/cart.svg" alt="Koszyk" width="30" height="33" />
        </a>
    <?php

    $fragments['a.cart-contents'] = ob_get_clean();

    return $fragments;
}

// change woocommerc add to cart button text

// Change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_add_to_cart_button_text_single' );
function woocommerce_add_to_cart_button_text_single() {
    return __( 'Zarezerwuj', 'woocommerce' );
}

// Change add to cart text on product archives page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_add_to_cart_button_text_archives' );
function woocommerce_add_to_cart_button_text_archives() {
    return __( 'Zarezerwuj', 'woocommerce' );
}


remove_action('wp_head', 'wp_generator');

function my_secure_generator( $generator, $type ) {
	return '';
}
add_filter( 'the_generator', 'my_secure_generator', 10, 2 );

function my_remove_src_version( $src ) {
	global $wp_version;

	$version_str = '?ver='.$wp_version;
	$offset = strlen( $src ) - strlen( $version_str );

	if ( $offset >= 0 && strpos($src, $version_str, $offset) !== FALSE )
		return substr( $src, 0, $offset );

	return $src;
}
add_filter( 'script_loader_src', 'my_remove_src_version' );
add_filter( 'style_loader_src', 'my_remove_src_version' );

add_filter('xmlrpc_enabled', '__return_false');

// add woocommerce suport to theme

function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );


// remove styles from wooocmmerce

add_filter( 'woocommerce_enqueue_styles', '__return_false' );


// remove page title from sites

add_filter('woocommerce_show_page_title', 'bbloomer_hide_shop_page_title');

function bbloomer_hide_shop_page_title($title) {
   if (is_shop()) $title = false;
   return $title;
}

// remove products from shop page

add_action( 'pre_get_posts', 'njengah_remove_products_from_shop_page' );

function njengah_remove_products_from_shop_page( $q ) {
   if ( ! $q->is_main_query() ) return;
   if ( ! $q->is_post_type_archive() ) return;
   if ( ! is_admin() && is_shop() ) {
      $q->set( 'post__in', array(0) );
   }
   remove_action( 'pre_get_posts', 'njengah_remove_products_from_shop_page' );

}

remove_action( 'woocommerce_no_products_found', 'wc_no_products_found' );



// Enable Gutenberg in WooCommerce
function activate_gutenberg_product( $can_edit, $post_type ) {

    if ( $post_type == 'product' ) {
        $can_edit = true;
    }
    return $can_edit;
}
add_filter( 'use_block_editor_for_post_type', 'activate_gutenberg_product', 10, 2 );



// Remove gallery from single product
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );


// Remove product title
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );

// Remove product price

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

// Remove product description

remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );

// Remove add to cart
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );

// Remove product tabs

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );

function woocommerce_template_product_description() {
  woocommerce_get_template( 'single-product/tabs/description.php' );
}
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_product_description', 20 );

add_filter('woocommerce_product_description_heading', '__return_null');


// remove sale badge

add_filter('woocommerce_sale_flash', 'lw_hide_sale_flash');
function lw_hide_sale_flash()
{
return false;
}


// Remove related products
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

// Remove upsell

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );

?>
