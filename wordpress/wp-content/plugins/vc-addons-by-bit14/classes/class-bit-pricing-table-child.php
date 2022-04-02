<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
class WPBakeryShortCode_bit_pricing_table extends WPBakeryShortCode {

    protected function content($atts, $content = null){
        
        extract(
            shortcode_atts( array(
                "id"                        =>  "" ,
                "class"                     =>  "" ,
                "table_title"               =>  "" ,
                "is_featured"               =>  "" ,
                "currency"                  =>  "" ,
                "price"                     =>  "" ,
                "duration"                  =>  "" ,
                "description"               =>  "" ,
                "button_text"               =>  "" ,
                "button_link"               =>  "" ,
                "features"                  =>  "",
                "google_text_font"          =>  ""
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
        $table_title        = ( $table_title != "" )          ?   esc_attr( $table_title )        : "" ;
        $is_featured        = ( $is_featured )                ?   "is_featured"                   : "" ;
        $currency           = ( $currency != "" )             ?   esc_attr( $currency )           : "" ;
        $price              = ( $price != "" )                ?   esc_attr( $price )              : "" ;
        $duration           = ( $duration != "" )             ?   esc_attr( $duration )     : "" ;
        $description        = ( $description != "" )          ?   esc_attr( $description )        : "" ;
        $button_text        = ( $button_text != "" )          ?   esc_attr( $button_text )        : "" ;
        $button_link        = ( $button_link != "" )          ?   esc_attr( $button_link )        : "" ;
        $features           = ( $features != "" )             ?   esc_attr( $features )           : "" ;

        $features = ($features != "") ? vc_param_group_parse_atts( $atts['features'] ) : "";


        $html = '<div class="bit_table" style="'.$text_font_inline_style.'">';

            $html .=  '<div class="bit_table_table '. $is_featured . '" >';

                $html .=  '<div id="'. $id .'" width="100%" class="bit_table_row ' . $class .'" >';

                    //Title
                    if ( $table_title != "" ) :
                        $html .= '<h2 style="'.$text_font_inline_style.'">'. $table_title .'</h2>';
                    endif;


                    $html .= '<div class="bit-price-description">';
                        //Price
                        if ( $price != "" ) :
                            $html .= '<span class="price" style="'.$text_font_inline_style.'">'. $currency . ' ' . $price .'<span class="duration" style="'.$text_font_inline_style.'"> '. $duration .'</span></span>';
                        endif;
                        //Description
                        if ( $description != "" ) :
                            $html .= '<p class="description" style="'.$text_font_inline_style.'">'. $description . '</p>';
                        endif;
                    $html .= '</div>';


                    //List
                    if ( !empty($features) ) :
                        $html .= '<ul class="bit_pricing_table_list">';
                            //loop starts here

                            foreach ($features as $feature) {

                                $pricing_table_list_title =
                                isset($feature['pricing_table_list_title']) ?
                                esc_attr($feature['pricing_table_list_title']) :
                                "";

                                $pricing_table_list_content =
                                isset($feature['pricing_table_list_content']) ?
                                esc_attr($feature['pricing_table_list_content']) :
                                "";

                                $pricing_table_list_icon =
                                isset($feature['pricing_table_list_icon']) ?
                                '<i class="'. esc_attr($feature['pricing_table_list_icon']) .'" ></i>' :
                                "";

                                $pricing_table_list_content =
                                isset($feature['pricing_table_list_content']) ?
                                esc_attr($feature['pricing_table_list_content']) :
                                "";

                                if( !empty($pricing_table_list_title) ) {
                                    $html .= '<li style="'.$text_font_inline_style.'">';
                                        $html .= '<span class="pricing_table_list_title" style="'.$text_font_inline_style.'">'. $pricing_table_list_title .'</span>';
                                        $html .= '<span class="pricing_table_list_content" style="'.$text_font_inline_style.'">'. $pricing_table_list_content .'</span>';
                                        $html .= $pricing_table_list_icon;
                                    $html .= '</li>';
                                }

                            };

                            //loop ends here
                        $html .= '</ul>';
                    endif;


                    //Button
                    if ( $button_link != "" && $button_link != "" ) :
                        $html .= '<span class="pricing_table_list_button"><a href="'. $button_link .'" class="btn btn-default" target="_blank" style="'.$text_font_inline_style.'">'. $button_text .'</a><span>';
                    endif;

                $html .= '</div>';

            $html .= '</div>';

        $html .= '</div>';//Col-sm- div which was opened in previous function

        $html .= wp_enqueue_style( 'pro-bit14-vc-addons-pricing-table', assets_url.'css/pricing-table.css', false );
        $html .=wp_enqueue_script( 'pro-bit14-vc-addons-pricing-table', assets_url.'js/pricing-table-script.js', array('jquery'), false, true );
        return $html;
        apply_filters('the_content', $content);
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
// Map the block with vc_map()
vc_map(
    array(
        "name"                      =>  __( 'Pricing Table', 'bit14' ),
        "description"               =>  __( 'Present your pricing plans in a comprehensive layout', 'bit14' ),
        "base"                      =>  "Bit_Pricing_Table",
        "class"                     =>  "Bit_Pricing_Table",
        "as_child"                  =>  array('only' => 'Bit14_Pricing_Tables'),
        "content_element"           =>  true,
        'category'                  => __('PB Addons', 'bit14'),
        'icon'                      =>  'icon-bit-table',
        "show_settings_on_create"   =>  true,
        "params"                    =>  array(
            array(
                'type'          => 'vc_links',
                'param_name'    => 'notice',
                'description'   => __( "For more themes and advance options, check <a href='https://pagebuilderaddons.com/pricing-table-advance/'> Pricing Table (Advance)</a>", 'bit14' ),
            ),
            array(
                'type'          =>  'textfield',
                'heading'       =>  __( 'Table ID', 'bit14' ),
                'param_name'    =>  'id',
                'description'   =>  __( 'Table Specific ID', 'bit14' ),
            ),

            array(
                'type'          =>  'textfield',
                'heading'       =>  __( 'Table Class Name', 'bit14' ),
                'param_name'    =>  'class',
                'description'   =>  __( 'Extra Class Name', 'bit14' ),
            ),

            array(
                'type'          =>  'textfield',
                'heading'       =>  __( 'Title', 'bit14' ),
                'param_name'    =>  'table_title',
                'description'   =>  __( 'Title of the table', 'bit14' ),
            ),

            array(
                'type'          =>  'checkbox',
                'heading'       =>  __( 'Featured', 'bit14' ),
                'param_name'    =>  'is_featured',
                'description'   =>  __( 'Is this table featured?', 'bit14' ),
            ),

            array(
                'type'          =>  'textfield',
                'heading'       =>  __( 'Currency', 'bit14' ),
                'param_name'    =>  'currency',
                'description'   =>  __( 'Please enter your currency sign here. Example: "$"', 'bit14' )
            ),

            array(
                'type'          =>  'textfield',
                'heading'       =>  __( 'Price', 'bit14' ),
                'param_name'    =>  'price',
                'description'   =>  __( 'Please enter your amount here. e.g(Free ,  Premium , $14.00)', 'bit14' )
            ),

            array(
                'type'          =>  'textfield',
                'heading'       =>  __( 'Duration', 'bit14' ),
                'param_name'    =>  'duration',
                'description'   =>  __( 'Duration of expiry. Example: "Month"', 'bit14' )
            ),

            array(
                'type'          =>  'textfield',
                'heading'       =>  __( 'Description', 'bit14' ),
                'param_name'    =>  'description'
            ),

            array(
                'type'          =>  'textfield',
                'heading'       =>  __( 'Button Text', 'bit14' ),
                'param_name'    =>  'button_text',
                'description'   =>  __( 'Please enter text of button if you want a button at the end of your table.', 'bit14' )
            ),


            array(
                'type'          =>  'textfield',
                'heading'       =>  __( 'Button Link', 'bit14' ),
                'param_name'    =>  'button_link',
                'description'   =>  __( 'Link where button redirects the user.', 'bit14' )
            ),

          $google_fonts,   

            array(
                'type'          =>  'param_group',
                'heading'       =>  'List of Items',
                'param_name'    =>  'features',
                'params'        =>  array(
                    array(
                        'type'          =>  'textfield',
                        'heading'       =>  __( 'Title', 'bit14' ),
                        'description'   =>  'Title of your item',
                        'param_name'    =>  'pricing_table_list_title',
                    ),
                    array(
                        'type'          =>  'iconpicker',
                        'heading'       =>  __( 'Icon', 'bit14' ),
                        'description'   =>  'Icon of the list',
                        'param_name'    =>  'pricing_table_list_icon',
                    ),
                    array(
                        'type'          =>  'textfield',
                        'heading'       =>  __( 'Content', 'bit14' ),
                        'description'   =>  'Content of item if any',
                        'param_name'    =>  'pricing_table_list_content',
                    ),
                )
            ),
            array(
                'type'          => 'vc_links',
                'param_name'    => 'notice_two',
                'description'   => __( "For more themes and advance options, check <a href='https://pagebuilderaddons.com/pricing-table-advance/'> Pricing Table (Advance)</a>", 'bit14' ),
            ),
            array(
                "type"          => "vc_links",
                "param_name"    => "bit_caption_url",
                "description"   => __( '<span style="Background: #1688b8;padding: 10px; display: block; color: white;font-weight:600;"><a href="https://pagebuilderaddons.com/plan-and-pricing/" target="_blank" style="color:white;text-decoration: none;">Get the Pro version for more elements and customization options.</a></span>', 'ihover' ),
            ),
        )
    )
);
