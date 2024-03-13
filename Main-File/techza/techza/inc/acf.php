<?php
if (!defined('ABSPATH')) {
    exit;
}
if (function_exists('acf_add_local_field_group')) :

    acf_add_local_field_group(array(
        'key' => 'group_5b5ab6357a14d',
        'title' => esc_html__('Page Options', 'techza'),
        'fields' => array(
           
            array(
                'key' => 'field_5c721ec24addf',
                'label' => esc_html__('Body Background Color', 'techza'),
                'name' => 'body_background_color',
                'type' => 'color_picker',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'page',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'side',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_5b82b1e19608e',
        'title' => esc_html__('Post Page Layout', 'techza'),
        'fields' => array(
            array(
                'key' => 'field_5b82b1e86dd24',
                'label' => esc_html__('Use Custom Page Layout?', 'techza'),
                'name' => 'use_custom_page_layout',
                'type' => 'true_false',
                'instructions' => 'Check this to override theme default single page layout function to any custom layout for this page only.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'Yes',
                'default_value' => 0,
                'ui' => 0,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ),
            array(
                'key' => 'field_5b82b1fd6dd25',
                'label' => esc_html__('Select Custom Layout', 'techza'),
                'name' => 'select_custom_layout',
                'type' => 'select',
                'instructions' => 'Select custom page layout for this posts page.',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_5b82b1e86dd24',
                            'operator' => '==',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'fullpage' => 'Full Page',
                    'left-sidebar' => 'Left Sidebar',
                    'right-sidebar' => 'Right Sidebar',
                ),
                'default_value' => false,
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'return_format' => 'value',
                'ajax' => 0,
                'placeholder' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'post',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'side',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'modified' => false,
    ));


    //Header Footer Include/Eclude Options
    acf_add_local_field_group(array(
        'key' => 'group_600e8b288c563',
        'title' => esc_html__('Header Footer Include/Exclude Permission', 'techza') ,
        'fields' => array(
            array(
                'key' => 'field_600e8b3a91509',
                'label' => esc_html__('Include Rules', 'techza'),
                'name' => 'include_rules',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => 'Add Include Rule',
                'sub_fields' => array(
                    array(
                        'key' => 'field_600e8bd99150a',
                        'label' => esc_html__('Include On', 'techza'),
                        'name' => 'include_on',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'all' => 'Entire Website',
                            'specific' => 'Specific Pages',
                            'archive' => 'Archive Pages',
                            '404'   => '404 Page'
                        ),
                        'default_value' => false,
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'return_format' => 'value',
                        'ajax' => 0,
                        'placeholder' => '',
                    ),
                    array(
                        'key' => 'field_600e8cc79150b',
                        'label' => esc_html__('Pages', 'techza'),
                        'name' => 'pages',
                        'type' => 'post_object',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_600e8bd99150a',
                                    'operator' => '==',
                                    'value' => 'specific',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'post_type' => array(
                            0 => 'page',
                            1 => 'post',
                            2 => 'portfolio'
                        ),
                        'taxonomy' => '',
                        'allow_null' => 0,
                        'multiple' => 1,
                        'return_format' => 'id',
                        'ui' => 1,
                    ),
                ),
            ),
            array(
                'key' => 'field_600e8d139150c',
                'label' => esc_html__('Exclude Rules', 'techza'),
                'name' => 'exclude_rules',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'collapsed' => '',
                'min' => 0,
                'max' => 0,
                'layout' => 'table',
                'button_label' => 'Add Exclude Rule',
                'sub_fields' => array(
                    array(
                        'key' => 'field_600e8d139150d',
                        'label' => esc_html__('Exclude On', 'techza'),
                        'name' => 'exclude_on',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array(
                            'all' => 'Entire Website',
                            'specific' => 'Specific Pages',
                            'archive' => 'Archive Pages',
                            '404'   => '404 Page'
                        ),
                        'default_value' => false,
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'return_format' => 'value',
                        'ajax' => 0,
                        'placeholder' => '',
                    ),
                    array(
                        'key' => 'field_600e8d139150e',
                        'label' => esc_html__('Pages', 'techza'),
                        'name' => 'pages',
                        'type' => 'post_object',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => array(
                            array(
                                array(
                                    'field' => 'field_600e8d139150d',
                                    'operator' => '==',
                                    'value' => 'specific',
                                ),
                            ),
                        ),
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'post_type' => array(
                            0 => 'page',
                            1 => 'post',
                            2 => 'portfolio'
                        ),
                        'taxonomy' => '',
                        'allow_null' => 0,
                        'multiple' => 1,
                        'return_format' => 'id',
                        'ui' => 1,
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'techza_header',
                ),
            ),
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'techza_footer',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));
endif;
