<?php
// File Security Check
if ( !defined( 'ABSPATH' ) ) {
    exit;
}
function techza_theme_options_style() {
    // Globalizing theme options values
    $techza = get_option( 'techza' );
    //
    // Enqueueing StyleSheet file
    //
    wp_enqueue_style( 'techza-theme-options-style', get_theme_file_uri( '/assets/css/theme_options_style.css' ) );
    $page_id    = get_the_ID();
    $css_output = '';
    /*=============================================
    =            CUSTOM BACKGROUND STYLE          =
    =============================================*/

    if ( isset( $techza['logo_max_width_desktop'] ) ) {
        $css_output .= "
			.site-branding,.site-logo{
				max-width: {$techza['logo_max_width_desktop']}px;
			}
		";
    }
    if ( isset( $techza['logo_max_width_mobile'] ) ) {
        $css_output .= "
			@media (max-width: 680px){
				.site-branding, .site-logo{
					max-width: {$techza['logo_max_width_mobile']}px;
				}
			}
		";
    }

    if (isset($techza['scustom_css'])) {
		$css_output .= $techza['scustom_css'];
	}

    // theme color set
    if ( isset( $techza['custom_accent_color'] ) || isset( $techza['heading_color'] ) || isset( $techza['text_color'] ) ) {
        $body_bg_color  = isset($techza['body_bg_color']['rgba'] ) ? $techza['body_bg_color']['rgba'] : '';
        $accent_color   = isset($techza['custom_accent_color']['rgba']) ? $techza['custom_accent_color']['rgba'] : '';
        $accent_color_2 = isset($techza['custom_accent_color_2']['rgba']) ? $techza['custom_accent_color_2']['rgba'] : '';
        $heading_color  = isset($techza['heading_color']['rgba']) ? $techza['heading_color']['rgba'] : '';
        $text_color     = isset($techza['text_color']['rgba']) ? $techza['text_color']['rgba'] : '';

        $css_output .= "
		:root {
			--accent-color: {$accent_color};
			--accent-color-2: {$accent_color_2};
			--heading-color: {$heading_color};
			--text-color: {$text_color};
		}

		body {
			background-color: {$body_bg_color};
		}

		";

    }

    //
    // Header Buttons Color
    //
    $body_background_color = get_post_meta( get_the_ID(), 'body_background_color', true );
    if ( $body_background_color ) {
        $css_output .= "
			body.page-id-{$page_id} {
				background-color: {$body_background_color};
			}
		";
    }

    wp_add_inline_style( 'techza-theme-options-style', $css_output );

}
add_action( 'wp_enqueue_scripts', 'techza_theme_options_style' );
