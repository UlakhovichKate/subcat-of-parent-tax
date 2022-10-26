<?php

/*
 * Get the list subcategories of added taxonomy
 * */

function getSubcategories( $atts) {

    $default = array(
        'category' => 'category',
    );

    $a = shortcode_atts($default, $atts);

    $taxonomies = get_terms( array(
        'taxonomy' => $a['category'], //'education_cat', // custom taxonomy
        'hide_empty' => false,
        'order_by' => 'name'
    ) );

    if ( !empty($taxonomies) ) :
        $output = '<div class="plugin">';

        foreach( $taxonomies as $category ) {

            if( $category->parent == 0 ) {

                $output .= '<ul class="list" data-parent="'. esc_attr( $category->name ) . '">';

                foreach( $taxonomies as $subcategory ) {

                    if( $subcategory->parent == $category->term_id ) {

                        $image = get_field('img', $subcategory);
                        $order = get_field('order', $subcategory);

                        $output.= '<li class="item order-'. $order .'" data-id="'. esc_attr( $subcategory->term_id ) .'"><div class="image-wrapper"><img class="image" src="'. $image .'" alt="'. $subcategory->name .'"></div><span class="name">'. esc_html($subcategory->name) .'</span></li>';
                    }

                }

                $output .= '</ul>';

            }
        }
        $output .= '</div>';

        return $output;

    endif;
}

add_action( 'init', 'getSubcategories' );
add_shortcode( 'subcatoftax', 'getSubcategories' );
