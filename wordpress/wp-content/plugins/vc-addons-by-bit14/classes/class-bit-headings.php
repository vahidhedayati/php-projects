<?php
/**
 * Created by Bit14.
 * User: Abdul Qadir
 * Date: 08/28/2019
 */



class WPBakeryShortCode_Bit14_Headings extends WPBakeryShortCode {
    function __construct(){
        // add_action( 'admin_init', array( $this, 'mapping' ) );
        add_action( 'wp_loaded', array( $this, 'mapping' ) );
        add_shortcode('bit_headings',array($this,'shortcode_html'));
    }

    function mapping(){

        // Stop all if VC is not enabled
        if ( !defined( 'WPB_VC_VERSION' ) ) {
            return;
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
        // Map the block with vc_map()
        vc_map(
            array(
                'name'          => __('Headings', 'bit14'),
                'base'          => 'bit_headings',
                'description'   => __('Enhance the Headings of different sections on the webpage', 'bit14'),
                'category'      => __('PB Addons', 'bit14'),
                'icon'          => plugin_dir_url(__DIR__) . 'assets/images/Heading.png',
                'params'        => array(

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
                        'type'          =>  'textfield',
                        'heading'       =>  __( 'Heading Text', 'bit14' ),
                        'param_name'    =>  'heading',
                    ),
                    
                    array(
                        'type'          =>  'dropdown',
                        'heading'       =>  __( 'Heading Position', 'bit14' ),
                        'param_name'    =>  'heading_position',
                        'value'         => array(
                            'Left'            =>  'left',
                            'Right'           =>  'right',
                            'Center'          =>  'center',
                        ),
                    ),

                    array(
                        'type'          =>  'colorpicker',
                        'heading'       =>  __( 'Heading Color', 'bit14' ),
                        'param_name'    =>  'heading_color',
                        'value'         => '#000',
                    ),

                    array(
                        'type'          =>  'dropdown',
                        'heading'       =>  __( 'Select Heading Style', 'bit14' ),
                        'param_name'    =>  'heading_styles',
                        'value'         => array(
                            'Border Top'              =>  'bdr_top',
                            'Border Bottom'           =>  'bdr_bottom',
                            'Border Top With Icon'    =>  'bdr_top_with_icon',
                            'Border Bottom With Icon' =>  'bdr_bottom_with_icon',
                            'Full Border'             =>  'full_border',
                            'Background Color'        =>  'bg_color',
                        )
                    ),
                    array(
                        'type'          =>  'dropdown',
                        'heading'       =>  __( 'Select Heading Style', 'bit14' ),
                        'param_name'    =>  'heading_tags',
                        'value'         => array(
                            'H1'    =>  'h1',
                            'H2'    =>  'h2',
                            'H3'    =>  'h3',
                            'H4'    =>  'h4',
                            'H5'    =>  'h5',
                            'H6'    =>  'h6',
                        )
                    ),

                    array(
                        'type'          =>  'colorpicker',
                        'heading'       =>  __( 'Border Color', 'bit14' ),
                        'param_name'    =>  'border_color',
                        'value'         => '#000',
                        'dependency'    => array(
                            'element'         => 'heading_styles',
                            'value'           => array('bdr_top', 'bdr_bottom', 'full_border','bdr_top_with_icon','bdr_bottom_with_icon'),
                        ),
                    ),

                    array(
                        'type'          =>  'colorpicker',
                        'heading'       =>  __( 'Background Color', 'bit14' ),
                        'param_name'    =>  'background_color',
                        'value'         => '#000',
                        'dependency'    => array(
                            'element'         => 'heading_styles',
                            'value'           => array('bg_color'),
                        ),
                    ),

                    array(
                        'type'          =>  'iconpicker',
                        'heading'       =>  __( 'Icon', 'bit14' ),
                        'param_name'    =>  'icon_pick',
                        'value'         => 'fa fa-heart',
                        'dependency'    => array(
                            'element'         => 'heading_styles',
                            'value'           => array('bdr_top_with_icon','bdr_bottom_with_icon'),
                        ),
                    ),

                    array(
                        'type'          =>  'colorpicker',
                        'heading'       =>  __( 'Icon Color', 'bit14' ),
                        'param_name'    =>  'icon_color',
                        'value'         => '#000',
                        'dependency'    => array(
                            'element'         => 'heading_styles',
                            'value'           => array('bdr_top_with_icon','bdr_bottom_with_icon'),
                        ),
                    ),

                    array(
                        'type'          =>  'dropdown',
                        'heading'       =>  __( 'Icon Position', 'bit14' ),
                        'param_name'    =>  'icon_position',
                        'value'         => array(
                            'Left'            =>  'left',
                            'Right'           =>  'right',
                            'Center'          =>  'center',
                        ),
                        'dependency'    => array(
                            'element'         => 'heading_styles',
                            'value'           => array('bdr_top_with_icon','bdr_bottom_with_icon'),
                        ),
                    ),

                    $google_fonts,     
                    array(
                        "type"          => "vc_links",
                        "param_name"    => "bit_caption_url",
                        "description"   => __( '<span style="Background: #1688b8;padding: 10px; display: block; color: white;font-weight:600;"><a href="https://pagebuilderaddons.com/plan-and-pricing/" target="_blank" style="color:white;">Get the Pro version for more elements and customization options.</a></span>', 'bit14' ),
                    ), 
                ),
            )
        );
    }

    function shortcode_html($atts, $content = null){
        extract(
            shortcode_atts( array(
                "id"                    =>  "",
                "class"                 =>  "",
                "heading"               =>  "",
                "heading_color"         =>  "",
                "heading_styles"        =>  "",
                "heading_tags"          =>  "",
                "border_color"          =>  "",
                "background_color"      =>  "",
                "icon_pick"             =>  "",
                "icon_color"            =>  "",
                "icon_position"         =>  "",
                "heading_position"      =>  "",
                "google_text_font"      =>  "",
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
        
        $id               = ( $id != "" )               ?   esc_attr($id)                           :   "" ;
        $class            = ( $class != "" )            ?   esc_attr($class)                        :   "" ;
        $heading          = ( $heading != "" )          ?   esc_attr($heading)                      :   "" ;
        $heading_color    = ( $heading_color != "" )    ?   esc_attr($heading_color)                :   "#000" ;
        $heading_styles   = ( $heading_styles != "" )   ?   esc_attr($heading_styles)               :   "bdr_top" ;
        $heading_tags     = ( $heading_tags != "" )     ?   esc_attr($heading_tags)                 :   "h1" ;
        $border_color     = ( $border_color != "" )     ?   esc_attr($border_color)                 :   "" ;
        $background_color = ( $background_color != "" ) ?   esc_attr($background_color)             :   "" ;
        $icon_pick        = ( $icon_pick != "" )        ?   esc_attr($icon_pick)                    :   "fa fa-heart" ;
        $icon_color       = ( $icon_color != "" )       ?   esc_attr($icon_color)                   :   "#000" ;
        $icon_position    = ( $icon_position != "" )    ?   esc_attr($icon_position)                :   "left" ;
        $heading_position = ( $heading_position != "" ) ?   esc_attr($heading_position)             :   "left" ;
        $rand = rand();
        if($heading_styles == 'bdr_top'){
            $class .= " top-bordered";
        } else if($heading_styles == 'bdr_bottom'){
            $class .= " bottom-bordered";
        } else if($heading_styles == 'full_border'){
            $class .= " full-bordered";
            if($heading_position == 'left'){
                $class .= " left-align";
            } else if($heading_position == 'right'){
                $class .= " right-align";
            }
        } else if($heading_styles == 'bdr_bottom_with_icon'){
            $class .= ' border_bottom_icon';
        } else if($heading_styles == 'bdr_top_with_icon'){
            $class .= ' border_top_icon';
        }

        if($heading_styles == 'bdr_bottom_with_icon' || $heading_styles == 'bdr_top_with_icon'){
            if($icon_position == 'left'){
                $class .= ' left-icon';
            } else if($icon_position == 'right'){
                $class .= ' right-icon';
            } 
        }


        $output = "<div data-id='".$rand."' data-background-color='".$background_color."' data-icon-color='".$icon_color."' data-heading-color='".$heading_color."' data-border-color='".$border_color."' data-icon-position='".$icon_position."' data-heading-position='".$heading_position."' data-heading-tags='".$heading_tags."' class='bit-pb-heading'>";
            $output .= "<".$heading_tags."  class='".$class." bit14-heading' style='".$text_font_inline_style."'>";
            if($heading_styles == 'bdr_top_with_icon'){
                $output .= "<span><i class='".$icon_pick." border-icon'></i></span>";
            }        
            $output .= $heading;
            if($heading_styles == 'bdr_bottom_with_icon'){
                $output .= "<span><i class='".$icon_pick." border-icon'></i></span>";
            }
            $output .= "</".$heading_tags.">";
        $output .= "</div>";
        
        if($heading_styles == 'bdr_top_with_icon' || $heading_styles == 'bdr_bottom_with_icon'){
            $output .= '<style>
                            .bit-pb-heading[data-id="'.$rand.'"] span:before{
                                border-color: '.$border_color.';
                            }
                        </style>';
        }
        if($heading_styles == 'full_border'){
             $output .= '<style>
                            .bit-pb-heading[data-id="'.$rand.'"] '.$heading_tags.'.full-bordered:before,
                            .bit-pb-heading[data-id="'.$rand.'"] '.$heading_tags.'.full-bordered:after{
                                border-color: '.$border_color.';
                            }
                        </style>';   
        }
        if($heading_styles == 'bdr_bottom_with_icon' || $heading_styles == 'bdr_top_with_icon'){
            $output .= '<style>
                            .bit-pb-heading[data-id="'.$rand.'"] '.$heading_tags.'.border_bottom_icon span:before, .bit-pb-heading[data-id="'.$rand.'"] '.$heading_tags.'.border_bottom_icon span:after,
                            .bit-pb-heading[data-id="'.$rand.'"] '.$heading_tags.'.border_top_icon span:before, .bit-pb-heading[data-id="'.$rand.'"] '.$heading_tags.'.border_top_icon span:after {
                                border-color: '.$border_color.';
                            }
                        </style>';
        }


        $output .= wp_enqueue_style( 'pro-bit14-vc-addons-heading', assets_url.'css/heading.css', false );
        $output .= wp_enqueue_script( 'pro-bit14-vc-addons-heading', assets_url.'js/heading-script.js', array('jquery'), false, true );
        
        return $output;
    }

}

new WPBakeryShortCode_Bit14_Headings;