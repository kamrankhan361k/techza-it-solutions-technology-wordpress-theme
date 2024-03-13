<?php
/**
 * WooCommerce Compatibility File
 *
 * @link https://woocommerce.com/
 *
 * @package techza
 */
/**
 * WooCommerce setup function.
 *
 * @link https://docs.woocommerce.com/document/third-party-custom-theme-compatibility/
 * @link https://github.com/woocommerce/woocommerce/wiki/Enabling-product-gallery-features-(zoom,-swipe,-lightbox)
 * @link https://github.com/woocommerce/woocommerce/wiki/Declaring-WooCommerce-support-in-themes
 *
 * @return void
 */
function techza_wc_setup()
{
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 255,
			'single_image_width'    => 492,
			'product_grid'          => array(
				'default_rows'    => 3,
				'min_rows'        => 1,
				'default_columns' => 3,
				'min_columns'     => 1,
				'max_columns'     => 6,
			),
		)
	);
	// add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support('wc-product-gallery-lightbox');
	add_theme_support('wc-product-gallery-slider');
}
add_action('after_setup_theme', 'techza_wc_setup');
function techza_default_catalog_orderby($sort_by)
{
	return 'date';
}
add_filter('woocommerce_default_catalog_orderby', 'techza_default_catalog_orderby');
/**
 * Change number of products that are displayed per page (shop page)
 */
function shop_loop_shop_per_page($cols)
{
	// $cols contains the current number of products per page based on the value stored on Options –> Reading
	// Return the number of products you wanna show per page.
	$cols = 9;
	return $cols;
}
add_filter('loop_shop_per_page', 'shop_loop_shop_per_page', 20);
/**
 * WooCommerce specific scripts & stylesheets.
 *
 * @return void
 */
function techza_wc_scripts()
{

	wp_enqueue_style('techza-woocommerce-style', get_theme_file_uri( '/assets/css/techza-woocommerce.css'), array('techza-style'));
	wp_style_add_data( 'techza-woocommerce-style', 'rtl', 'replace' );

}
add_action('wp_enqueue_scripts', 'techza_wc_scripts', 20);
/**
 * Disable the default WooCommerce stylesheet.
 *
 * Removing the default WooCommerce stylesheet and enqueing your own will
 * protect you during WooCommerce core updates.
 *
 * @link https://docs.woocommerce.com/document/disable-the-default-stylesheet/
 */
// add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );
/**
 * Add 'woocommerce-active' class to the body tag.
 *
 * @param  array $classes CSS classes applied to the body tag.
 * @return array $classes modified to include 'woocommerce-active' class.
 */
function techza_wc_active_body_class($classes)
{
	$classes[] = 'woocommerce-active';
	return $classes;
}
add_filter('body_class', 'techza_wc_active_body_class');
/**
 * Related Products Args.
 *
 * @param array $args related products args.
 * @return array $args related products args.
 */
function techza_wc_related_products_args($args)
{
	$defaults = array(
		'posts_per_page' => 4,
		'columns'        => 4,
	);
	$args = wp_parse_args($defaults, $args);
	return $args;
}
add_filter('woocommerce_output_related_products_args', 'techza_wc_related_products_args');
/**
 * Remove the breadcrumbs
 */
function woo_remove_wc_breadcrumbs()
{
	remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
}
add_action('init', 'woo_remove_wc_breadcrumbs');
/**
 * Remove default WooCommerce title.
 */
add_filter('woocommerce_show_page_title', 'techza_hide_shop_page_title');
function techza_hide_shop_page_title($title)
{
	$title = false;
	return $title;
}
/**
 * Remove default WooCommerce wrapper.
 */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10);
remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
if (!function_exists('techza_wc_wrapper_before')) {
	/**
	 * Before Content.
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function techza_wc_wrapper_before()
	{
		if (!is_product()) {
			global $techzaObj;
			printf('%s', $techzaObj->techza_breadcrumb_bridge());
		}
		if (is_active_sidebar('techza_woocommerce_widgets')) {
			$column_class = 'col-xxl-9 col-xl-8 col-lg-8 col-md-8 woo-has-sidebar';
		} else {
			$column_class = 'col-12';
		}
?>
<div class="techza-woocommerce-page">
	<div class="container">
		<div class="row justify-content-center">
			<?php if (is_product()) : ?>
				<div class="col-md-12">
				<?php else :  ?>
					<?php if (is_active_sidebar('techza_woocommerce_widgets')) : ?>
						<div class="col-xxl-3 col-xl-4 col-lg-4 col-md-4 order-2 theme-techza-shop-sidebar">
							<?php dynamic_sidebar('techza_woocommerce_widgets'); ?>
						</div>
					<?php endif; ?>
					<div class="<?php echo esc_attr($column_class); ?> techza-shop-items-wrap">
					<?php endif; ?>
					<main id="primary" class="site-main">
					<?php
				}
			}
add_action('woocommerce_before_main_content', 'techza_wc_wrapper_before');
if (!function_exists('techza_wc_wrapper_after')) {
	/**
	 * After Content.
	 *
	 * Closes the wrapping divs.
	 *
	 * @return void
	 */
	function techza_wc_wrapper_after()
	{
		?>
		</main><!-- #main -->
		</div>
	</div>
</div>
<?php
	}
}
add_action('woocommerce_after_main_content', 'techza_wc_wrapper_after', 10);
/**
 * Removing the woocommerce sidebar.
 *
 */
function disable_woo_commerce_sidebar()
{
	remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);
}
add_action('init', 'disable_woo_commerce_sidebar');
/**
 * Sample implementation of the WooCommerce Mini Cart.
 *
 * You can add the WooCommerce Mini Cart to header.php like so ...
 *
	*/
if (!function_exists('techza_wc_cart_link_fragment')) {
	/**
	 * Cart Fragments.
	 *
	 * Ensure cart contents update when products are added to the cart via AJAX.
	 *
	 * @param array $fragments Fragments to refresh via AJAX.
	 * @return array Fragments to refresh via AJAX.
	 */
	function techza_wc_cart_link_fragment($fragments)
	{
		ob_start();
		techza_wc_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();
		return $fragments;
	}
}
add_filter('woocommerce_add_to_cart_fragments', 'techza_wc_cart_link_fragment');
if (!function_exists('techza_wc_cart_link')) {
	/**
	 * Cart Link.
	 *
	 * Displayed a link to the cart including the number of items present and the cart total.
	 *
	 * @return void
	 */
	function techza_wc_cart_link()
	{
?>
<a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'techza'); ?>">
<?php
		$item_count_text = sprintf(
			/* translators: number of items in the mini cart. */
			_n('%d item', '%d items', WC()->cart->get_cart_contents_count(), 'techza'),
			WC()->cart->get_cart_contents_count()
		);
?>
<span class="amount"><?php echo wp_kses_data(WC()->cart->get_cart_subtotal()); ?></span> <span class="count"><?php echo esc_html($item_count_text); ?></span>
</a>
<?php
	}
}
if (!function_exists('techza_wc_header_cart')) {
	/**
	 * Display Header Cart.
	 *
	 * @return void
	 */
	function techza_wc_header_cart()
	{
		if (is_cart()) {
			$class = 'current-menu-item';
		} else {
			$class = '';
		}
?>
<ul id="site-header-cart" class="site-header-cart">
<li class="<?php echo esc_attr($class); ?>">
	<?php techza_wc_cart_link(); ?>
</li>
<li>
	<?php
		$instance = array(
			'title' => '',
		);
		the_widget('WC_Widget_Cart', $instance);
	?>
</li>
</ul>
<?php
	}
}
/**
 * Remove categoryies.
 */
// remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
/**
 * Adding price prefix.
 */
function techza_rrp_sale_price_html($price, $product)
{
	if ($product->is_on_sale()) :
		$has_sale_text = array(
			'<del aria-hidden="true">' => '<del><span class="price-prefix">' . esc_html__('List Price:', 'techza') . '</span> ',
			'<ins>' => '<br/> <ins> <span class="price-prefix">' . esc_html__('Price:', 'techza') . '</span> '
		);
		$return_string = str_replace(array_keys($has_sale_text), array_values($has_sale_text), $price);
	else :
		$return_string = '<span class="price-prefix">' . esc_html__('Price:', 'techza') . '</span>' . $price;
	endif;
	return $return_string;
}
add_filter('woocommerce_get_price_html', 'techza_rrp_sale_price_html', 100, 2);

function techza_before_qty_add()
{
	echo '<div class="qty-label">' . esc_html__('Quantity:', 'techza') . ' </div>';
}
add_action('woocommerce_before_add_to_cart_quantity', 'techza_before_qty_add');

// Change the product description title
function techza_change_product_description_heading()
{
	return __('', 'woocommerce');
}
add_filter('woocommerce_product_description_heading', 'techza_change_product_description_heading');

// Change the additional information title tab
if (!function_exists('misha_rename_additional_info_tab')) {
	function misha_rename_additional_info_tab($tabs)
	{
		$tabs['additional_information']['title'] = 'Specification';
		return $tabs;
	}
}
add_filter('woocommerce_product_tabs', 'misha_rename_additional_info_tab');
// wrapping up woo related products
function move_related_products_before_tabs()
{
	remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
	// add_action( 'woocommerce_after_main_content', 'woocommerce_output_related_products' );
}
add_action('init', 'move_related_products_before_tabs');
if (!function_exists('techza_wc_related_product_wrapper_before')) {
	/**
	 * related product wrapping
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function techza_wc_related_product_wrapper_before()
	{
		global $product;
		if($product){
			$related_count = count(wc_get_related_products($product->get_id()));
		}else{
			$related_count = 0;
		}
		if (is_product() && 0 != $related_count) {
?>
<div class="techza-woo-related-product-area">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<?php
				woocommerce_output_related_products();
				?>
			</div>
		</div>
	</div>
</div>
<?php
		}
	}
}
add_action('woocommerce_after_main_content', 'techza_wc_related_product_wrapper_before', 40);
if (!function_exists('techza_wc_checkout_order_details_wrapper_start')) {
	/**
	 * related product wrapping
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function techza_wc_checkout_order_details_wrapper_start()
	{
?>
<div class="techza-wc-order-details-wrapp">
<?php
	}
}
add_action('woocommerce_checkout_after_customer_details', 'techza_wc_checkout_order_details_wrapper_start', 40);
if (!function_exists('techza_wc_checkout_order_details_wrapper_end')) {
	/**
	 * related product wrapping
	 *
	 * Wraps all WooCommerce content in wrappers which match the theme markup.
	 *
	 * @return void
	 */
	function techza_wc_checkout_order_details_wrapper_end()
	{
?>
</div>
<?php
	}
}
add_action('woocommerce_review_order_before_payment', 'techza_wc_checkout_order_details_wrapper_end');
/**
 * Woo Paginations..
 * @since 1.0.0
 */
add_filter('woocommerce_pagination_args', 	'techza_woo_pagination');
function techza_woo_pagination($args)
{
	$args['prev_text'] = '<i class="fa fa-angle-left"></i>';
	$args['next_text'] = '<i class="fa fa-angle-right"></i>';
	return $args;
}
add_filter('woocommerce_default_address_fields', 'techza_override_address_fields');
function techza_override_address_fields($address_fields)
{
	$address_fields['first_name']['placeholder'] = 'i.e. John';
	$address_fields['last_name']['placeholder'] = 'i.e. Doe';
	$address_fields['address_1']['placeholder'] = 'i.e. 1336 Ross Street';
	$address_fields['state']['placeholder'] = 'i.e. Virginia';
	$address_fields['postcode']['placeholder'] = 'i.e. 20170';
	$address_fields['city']['placeholder'] = 'i.e. Collinsville';
	$address_fields['phone']['placeholder'] = 'i.e. 818-406-0507';
	$address_fields['email']['placeholder'] = 'i.e. john@email.com';
	return $address_fields;
}
add_filter('techza_page_title', 'woo_title_order_received', 10, 2);
function woo_title_order_received($title)
{
	if (function_exists('is_order_received_page') && is_order_received_page()) {
		$title = '<div class="techza-order-success-icon"><img src="' . get_theme_file_uri( '/assets/img/order-success.png').'" alt="' . esc_attr__('order success', 'techza') . '" /></div>';
		$title .= "Order Successful";
		return  $title;
	}
	return $title;
}
// Add a second password field to the checkout page in WC 3.x.
add_filter('woocommerce_checkout_fields', 'wc_add_confirm_password_checkout', 10, 1);
function wc_add_confirm_password_checkout($checkout_fields)
{
	if (get_option('woocommerce_registration_generate_password') == 'no') {
		$checkout_fields['account']['account_password2'] = array(
			'type'              => 'password',
			'label'             => __('Confirm password', 'woocommerce'),
			'required'          => true,
			'placeholder'       => _x('Confirm Password', 'placeholder', 'woocommerce')
		);
	}
	return $checkout_fields;
}
// Check the password and confirm password fields match before allow checkout to proceed.
add_action('woocommerce_after_checkout_validation', 'wc_check_confirm_password_matches_checkout', 10, 2);
function wc_check_confirm_password_matches_checkout($posted)
{
	$checkout = WC()->checkout;
	if (!is_user_logged_in() && ($checkout->must_create_account || !empty($posted['createaccount']))) {
		if (strcmp($posted['account_password'], $posted['account_password2']) !== 0) {
			wc_add_notice(__('Passwords do not match.', 'woocommerce'), 'error');
		}
	}
}
// Add the code below to your theme's functions.php file to add a confirm password field on the register form under My Accounts.
add_filter('woocommerce_registration_errors', 'registration_errors_validation', 10, 3);
function registration_errors_validation($reg_errors, $sanitized_user_login, $user_email)
{
	global $woocommerce;
	extract($_POST);
	if (strcmp($password, $password2) !== 0) {
		return new WP_Error('registration-error', __('Passwords do not match.', 'woocommerce'));
	}
	if (isset($_POST['terms'])) {
		return new WP_Error('registration-error', __('Terms and condition are not checked!', 'woocommerce'));
	}
	return $reg_errors;
}
add_action('woocommerce_register_form', 'wc_register_form_password_repeat');
function wc_register_form_password_repeat()
{
?>
<p class="form-row form-row-wide">
<label for="reg_password2"><?php _e('Confirm Password', 'woocommerce'); ?> <span class="required">*</span></label>
<input type="password" class="input-text" name="password2" placeholder="<?php echo esc_attr("********") ?>" id="reg_password2" value="<?php if (!empty($_POST['password2'])) echo esc_attr($_POST['password2']); ?>" />
</p>
<?php
	if (function_exists('wc_terms_and_conditions_checkbox_enabled')) {
?>
<p class="form-row terms wc-terms-and-conditions">
<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
	<input type="checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" name="terms" <?php checked(apply_filters('woocommerce_terms_is_checked_default', isset($_POST['terms'])), true); ?> id="terms" /> <span><?php printf(__('I agree to the <a href="%s" target="_blank" class="woocommerce-terms-and-conditions-link">Terms & conditions</a>', 'woocommerce'), esc_url(wc_get_page_permalink('terms'))); ?></span>
</label>
<input type="hidden" name="terms-field" value="1" />
</p>
<?php
	}
}
/**
 * Shop/archives: wrap the product image/thumbnail in a div.
 *
 * The product image itself is hooked in at priority 10 using woocommerce_template_loop_product_thumbnail(),
 * so priority 9 and 11 are used to open and close the div.
 */
add_action('woocommerce_before_shop_loop_item_title', function () {
	echo '<div class="product-thumb-wrapper">';
}, 9);
add_action('woocommerce_before_shop_loop_item_title', function () {
	echo '</div>';
}, 11);
