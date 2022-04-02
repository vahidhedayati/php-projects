<?php

class WPBakeryShortCode_bit_tab  extends WPBakeryShortCode {
    public $bit_tabcount =1;
    protected function content($atts, $content = array() ) {
        global $bit_tabcount;
        extract(
            shortcode_atts( array(
                "id"                        =>  "" ,
                "class"                     =>  "" ,
                "tab_title"                 =>  "" ,
                "tab_description"           =>  "" ,
                "tab_icon"                  =>  "" ,
                "google_text_font"          =>  "" ,
            ), $atts)
        );
        //******************//
        // MANAGE FONT DATA //
        //******************//

        
        $enable_googlefonts     = get_option( 'bit14_enable_googlefonts' , '1');
        $text_font_inline_style = '';
        if($enable_googlefonts == "1"){ 
            // Build the data array
            $text_font_data = Wpbakery_bit14_helper::getFontsData( $google_text_font );
         
            // Build the inline style
            $text_font_inline_style = Wpbakery_bit14_helper::googleFontsStyles( $text_font_data );   
                 
            // Enqueue the right font   
            Wpbakery_bit14_helper::enqueueGoogleFonts( $text_font_data );
        }

        $id                 = ( $id != "" )                   ?   esc_attr( $id )                 : "" ;
        $class              = ( $class != "" )                ?   esc_attr( $class )              : "" ;
        $tab_title          = ( $tab_title != "" )            ?   esc_attr( $tab_title )          : "" ;
        $tab_description    = ( $tab_description != "" )      ?   $tab_description                : "" ;
        $tab_icon           = ( $tab_icon != "" )             ?   esc_attr( $tab_icon )           : "" ;

        $html               = null;

        //Title
        if ( $tab_title != "" ) :
            $html .= '<li class="bit-tab-li"><input type="radio" name="tabs" class="bit-tab-head" id="tab'.$id.$bit_tabcount.'" />';
            $html .= '<label for="tab'.$id.$bit_tabcount.'" role="tab" aria-selected="true" aria-controls="panel'.$id.$bit_tabcount.'" tabindex="0" style="'.$text_font_inline_style.'"><i class="tab-head-icon '. $tab_icon .'"></i>'.$tab_title .'</label>';
            $html .= '<div id="tab-content'.$id.$bit_tabcount.'" class="tab-content" role="tabpanel" aria-labelledby="description" aria-hidden="false" style="'.$text_font_inline_style.'">';
            $bit_tabcount++;
        endif;
        //Description
        if ( $tab_description != "" ) :
            $html .= $tab_description;
        endif;
            $html .= '</div></li>';

        $html .= wp_enqueue_style( 'pro-bit14-vc-addons-tabs', assets_url.'css/tabs.css', false );
        $html .= wp_enqueue_script( 'pro-bit14-vc-addons-tabs', assets_url.'js/tabs.js', array('jquery'), false );
        $html .= wp_enqueue_script( 'pro-bit14-vc-addons-jquery-ui', assets_url.'js/jquery-ui.js', array('jquery'), false );
        return $html;
    }

}

$enable_googlefonts     = get_option( 'bit14_enable_googlefonts' , '1');
$google_fonts           = array(
    "type"          => "vc_links",
    "param_name"    => "bit_caption_url",
    "description"   => __( '<span style="Background: #1688b8;padding: 10px; display: block; color: white;font-weight:600;">Enable google fonts form settings for exciting google fonts.</span>', 'bit14' ),
);

if($enable_googlefonts == "1"){
    $google_fonts = array(
        'type' => 'google_fonts',
        'param_name' => 'google_text_font',
        'settings' => array(
            'fields' => array(
                'font_family_description' => __( 'Select Font Family.', 'bit14' ),
                'font_style_description' => __( 'Select Font Style.', 'bit14' ),
            ),
        ), 
        'weight' => 0,
        'group'         => 'Attributes'
    );
}

vc_map(
    array(
        "name"                                      =>  __( 'Tab', 'bit14' ),
        "description"                               =>  __( 'Display detailed content in a compact layout', 'bit14' ),
        "base"                                      =>  "Bit_Tab",
        "class"                                     =>  "Bit_Tab",
        "as_child"                                  =>  array('only' => 'Bit_Tabs'),
        "content_element"                           =>  true,
        "category"                                  =>  'PB Elements Pro',
        'icon'                                      =>  'icon-bit-tab',
        "show_settings_on_create"                   =>  true,
        "params"                                    =>  array(

            array(
                'type'          =>  'textfield',
                'heading'       =>  __( 'Tab ID', 'bit14' ),
                'param_name'    =>  'id',
                'description'   =>  __( 'Tab Specific ID', 'bit14' ),
            ),

            array(
                'type'          =>  'textfield',
                'heading'       =>  __( 'Tab Class Name', 'bit14' ),
                'param_name'    =>  'class',
                'description'   =>  __( 'Extra Class Name', 'bit14' ),
            ),

            array(
                'type'          =>  'textfield',
                'heading'       =>  __( 'Title', 'bit14' ),
                'param_name'    =>  'tab_title',
                'description'   =>  __( 'Title of the tab', 'bit14' ),
            ),

            array(
                'type'          => 'iconpicker',
                'heading'       => __( 'Icon', 'js_composer' ),
                'param_name'    => 'tab_icon',
                'value'         => 'vc_pixel_icon vc_pixel_icon-alert',
                'settings'      => array(
                    'emptyIcon'     => true,
                    'type'          => 'fontawesome',
                ),
                'description'   => __( 'Select icon from library.', 'js_composer' ),
            ),

            array(
                "type"          => "textarea",
                "class"         => "",
                "heading"       => __( "Tab Content", "Bit14" ),
                "param_name"    => "tab_description",
                "value"         => '',
            ),
            $google_fonts,
        )
    )
);
