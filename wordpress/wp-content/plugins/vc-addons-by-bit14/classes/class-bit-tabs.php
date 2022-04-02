<?php

class WPBakeryShortCode_bit_tabs  extends WPBakeryShortCodesContainer {


    protected function content($atts,$content = null) {

        extract(
            shortcode_atts( array(
                "id"                        =>  "",
                "class"                     =>  "",
                "tab_theme"                 =>  "",
                "tabs_bg_color"             =>  "",
                "tabs_secondary_color"      =>  "",
                "tabs_font_color"           =>  "",
                "tabs_hori_padding"         =>  "",
                "tabs_ver_padding"          =>  "",
            ), $atts)
        );
        
        $this->tabs_group_id            =   ( $id != "" )                   ?   esc_attr($id)                       :   "" ;
        $this->tabs_group_class         =   ( $class != "" )                ?   esc_attr($class)                    :   "" ;
        $this->tabs_group_theme         =   ( $tab_theme != "" )            ?   esc_attr($tab_theme)                :   "tab-style-one" ;
        $this->tabs_bg_color            =   ( $tabs_bg_color != "" )        ?   esc_attr($tabs_bg_color)            :   "#ffffff" ;
        $this->tabs_secondary_color     =   ( $tabs_secondary_color != "" ) ?   esc_attr($tabs_secondary_color)     :   "#e4e4e4" ;
        $this->tabs_font_color          =   ( $tabs_font_color != "" )      ?   esc_attr($tabs_font_color)          :   "#9a9a9a" ;
        $this->tabs_hori_padding        =   ( $tabs_hori_padding != "" )    ?   esc_attr($tabs_hori_padding)        :   "25" ;
        $this->tabs_ver_padding         =   ( $tabs_ver_padding != "" )     ?   esc_attr($tabs_ver_padding)         :   "15" ;

        $contentHtml = "<div class='bit-tab-container ".$this->tabs_group_theme."' set-name='".$this->tabs_group_theme."'>
                        <ul class='tabs bit14-tabs' role='tablist'  data-primary-color='".$this->tabs_bg_color."' data-secondary-color='".$this->tabs_secondary_color."'  data-font-color='".$this->tabs_font_color."' data-vertical-padding='".$this->tabs_ver_padding."' data-horizontal-padding='".$this->tabs_hori_padding."'>" . do_shortcode($content). "</ul>
                                <br style='clear: both; ' />
                            </div>";
        $contentHtml .= wp_enqueue_style( 'pro-bit14-vc-addons-tabs', assets_url.'css/tabs.css', false );
        // $contentHtml .= wp_enqueue_script( 'pro-bit14-vc-addons-test', assets_url.'js/test.js', array('jquery'), false );
        return $contentHtml;
    }
}
vc_map(
    array(
        "name"                                      =>  __( 'Tabs', 'bit14' ),
        "description"                               =>  __( 'Display detailed content in a compact layout', 'bit14' ),
        "base"                                      => "Bit_Tabs",
        "class"                                     => "Bit_Tabs",
        "as_parent"                                 => array('only' => 'Bit_Tab'),
        "content_element"                           => true,
        "is_container"                              => true,
        'category'      => __('PB Addons', 'bit14'),
        'icon'                                      => 'icon-bit-tab',
        "show_settings_on_create"                   => true,
        "js_view"                                   => 'VcColumnView',
        'params'                                    =>  array(

            array(
                'type'          =>  'textfield',
                'heading'       =>  __( 'Element ID', 'bit14' ),
                'param_name'    =>  'id',
                'description'   =>  __( 'Element ID', 'bit14' ),
            ),

            array(
                'type'          =>  'textfield',
                'heading'       =>  __( 'Extra Class Name', 'bit14' ),
                'param_name'    =>  'class',
                'description'   =>  __( 'Extra Class Name', 'bit14' ),
            ),

            array(
                'type'          => 'dropdown',
                'heading'       => __( 'Theme', 'bit14' ),
                'param_name'    => 'tab_theme',
                'description'   => __( 'Select a theme', 'bit14' ),
                'value'         => array(
                    'Theme Style 1' => 'tab-style-one',
                    'Theme Style 2' => 'tab-style-two',
                    'Theme Style 3' => 'tab-style-three',
                ),
            ),

            array(
                'type'          =>  'colorpicker',
                'heading'       =>  __( 'Active Tab Color', 'bit14' ),
                'description'       =>  __( 'Selected color will be applied on the active tab', 'bit14' ),
                'param_name'    =>  'tabs_bg_color',
                'value'         =>  '#ffffff'
            ),

            array(
                'type'          =>  'colorpicker',
                'heading'       =>  __( 'Inactive Tab Color', 'bit14' ),
                'description'       =>  __( 'Selected color will be applied on the inactive tab(s)', 'bit14' ),
                'param_name'    =>  'tabs_secondary_color',
                'value'         =>  '#e4e4e4'
            ),


            array(
                'type'          => 'colorpicker',
                'heading'       =>  __( 'Font Color', 'bit14' ),
                'param_name'    =>  'tabs_font_color',
                'value'         =>  '#9a9a9a'
            ),

            array(
                'type'          => 'textfield',
                'heading'       =>  __( 'Vertical Padding', 'bit14' ),
                'param_name'    =>  'tabs_ver_padding',
                'description'   =>  'Only Numbers'
            ),

            array(
                'type'          => 'textfield',
                'heading'       =>  __( 'Horizontal Padding', 'bit14' ),
                'param_name'    =>  'tabs_hori_padding',
                'description'   =>  'Only Numbers'
            ),
        ),
    )
);

