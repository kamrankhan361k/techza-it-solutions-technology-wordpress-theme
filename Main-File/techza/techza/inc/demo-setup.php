<?php

function techza_import_files() {
	return array(
		array(
			'import_file_name'             => 'Demo Input',
			'import_file_url'              => get_theme_file_uri() . '/inc/demo-contents/initial-setup.xml',
            'local_import_widget_file' => trailingslashit(get_template_directory()) . 'inc/demo-contents/widget.wie',
            'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'inc/demo-contents/customizer.dat',
            'local_import_redux' => array(
                array(
                    'file_path' => trailingslashit(get_template_directory()) . 'inc/demo-contents/theme-options.json',
                    'option_name' => 'techza',
                ),
            ),
            'import_notice'                => __( 'After you import this demo, you need to setup home page & blog page from setting > 
			 Reading Settings > Homepage & Posts page. With Change the menu from the menu options', '' ),
		),
	);
}
add_filter( 'pt-ocdi/import_files', 'techza_import_files' );


function ocdi_after_import() {

	$front_page_id = get_page_by_title( 'Home 01' );

    // This menu name deshbord 
    $main_menu = get_term_by('name', 'Header Menu', 'nav_menu');

    set_theme_mod('nav_menu_locations', array(
        'main-menu' => $main_menu->term_id,
    ));

    $blog_page_id  = get_page_by_title('Blog');
    update_option('show_on_front', 'page');
    update_option('page_on_front', $front_page_id->ID);
    update_option('page_for_posts', $blog_page_id->ID);

}
add_action('pt-ocdi/after_import', 'ocdi_after_import');



