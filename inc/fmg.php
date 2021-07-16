<?php

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();

}

function fmg_page_content( $atts, $content = null )
{
  $a = shortcode_atts( array(
    'return' => true,
  ), $atts );
  global $post;


  if ($page_content = get_field('service', 'option')) {
    foreach ($page_content as $pc) {

      foreach ($pc['service_reference'] as $p) {
        if ($p['value'] == $post->post_name) {
          // var_dump($pc);
          if ($a['return'] == 'featured_image') {
            return $pc['service_image']['url'];
          } elseif ($a['return'] == 'content') {

            $ret = '';

            $ret .= '<div class="page-title-container"><div class="service_title_holder"><h2>'.$pc['service_title'].'</h2></div>';
            $ret .= '<div class="frame" style="background-image: url('.$pc['service_image']['url'].')"></div></div>';

            $ret .= $pc['service_content'];
            return $ret;
          }

        }
      }
    }
  }


}

add_shortcode('fmg_page_content', 'fmg_page_content');

if(!function_exists('nv_page_title_breadcrumb')) {
    function nv_page_title_breadcrumb() {
        global $data, $post;

        if( is_page() && !is_front_page() && !is_singular('creativo_portfolio') && get_post_meta($post->ID, 'pyre_page_title', true)!='hide' && $data['tb_pages_ds'] != '1'): ?>
        <?php if (($thumb = do_shortcode('[fmg_page_content return="featured_image"]')) && (get_field('show_images', 'option'))): ?>
          <div id="page-title" class="page-title--image" class="frame" style="background-image:url(<?php echo $thumb ?>)">
        <?php else: ?>
          <div id="page-title" class="page-title--color">
        <?php endif; ?>

                <div class="page_title_inner">

                    <div class="container clearfix">

                        <h2><?php the_title(); ?></h2>

                        <?php
                        if($data['en_breadcrumb']){
                            nimva_breadcrumb();
                        }
                        ?>

                        <?php if ($data['title_breadcrumb_right_side'] != 'Leave Empty'): ?>
                            <div class="searchtop-meta">
                                <?php
                                if($data['title_breadcrumb_right_side'] == 'Social Links') get_template_part('functions/template/social-links');
                                elseif($data['title_breadcrumb_right_side'] == 'Search Box') get_search_form();
                                else get_template_part('functions/template/contact-info');
                                ?>
                            </div>
                        <?php endif; ?>

                    </div>

                </div>

            </div>

        <?php endif;

        $spb = false;
        if(class_exists('Woocommerce') && is_product() ) $spb = true;

        if ( is_singular('post') && get_post_meta($post->ID, 'pyre_page_title', true)!='hide' && $data['tb_posts_ds'] != '1') :
            ?>
            <div id="page-title">
                <div class="page_title_inner ">
                    <div class="container clearfix">
                        <h2><?php the_title(); ?></h2>
                        <?php
                        if($data['en_breadcrumb']){
                            nimva_breadcrumb();
                        }
                        ?>
                        <?php if($data['blog_pn_nav']) { ?>
                            <div id="portfolio-navigation" class="clearfix">
                                <div class="port-nav-next">
                                    <?php next_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?>
                                </div>
                                <div class="port-nav-prev">
                                    <?php previous_post_link('%link', '<i class="fa fa-angle-right"></i>'); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php
        endif;

        if ( (is_single() || is_singular('creativo_portfolio') ) && !is_singular('post') && get_post_meta($post->ID, 'pyre_page_title', true)!='hide' && !$spb ) :
            ?>
            <div id="page-title">
                <div class="page_title_inner">
                    <div class="container clearfix">
                        <h2><?php the_title(); ?></h2>
                        <?php
                        if($data['en_breadcrumb']){
                            nimva_breadcrumb();
                        }
                        ?>
                        <?php if($data['blog_pn_nav']) { ?>
                            <div id="portfolio-navigation" class="clearfix">
                                <div class="port-nav-next">
                                    <?php next_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?>
                                </div>
                                <div class="port-nav-prev">
                                    <?php previous_post_link('%link', '<i class="fa fa-angle-right"></i>'); ?>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php
        endif;

        if( ( class_exists( 'Woocommerce' ) && is_woocommerce()  ) || ( is_tax( 'product_cat' ) ||  is_tax( 'product_tag' ) ) ) {
        ?>
            <div id="page-title">

                <div class="page_title_inner">

                    <div class="container clearfix">

                        <h2>
                            <?php
                            if(!is_product()) woocommerce_page_title(true);
                            //else the_title();
                            ?>
                        </h2>
                        <?php
                        woocommerce_breadcrumb(array(
                            'wrap_before' => '<ul class="breadcrumbs">',
                            'wrap_after' => '</ul>',
                            'before' => '<li>',
                            'after' => '</li>',
                            'delimiter' => '',
                            'home'        => _x( '<i class="fa fa-home"></i>', 'breadcrumb', 'woocommerce' ),
                        ));
                        ?>

                        <?php if ($data['title_breadcrumb_right_side'] != 'Leave Empty'): ?>
                            <?php if( !is_product() ): ?>
                                <div class="searchtop-meta">
                                    <?php
                                    if($data['title_breadcrumb_right_side'] == 'Social Links') get_template_part('functions/template/social-links');
                                    elseif($data['title_breadcrumb_right_side'] == 'Search Box') get_product_search_form();
                                    else get_template_part('functions/template/contact-info');
                                    ?>
                                </div>
                             <?php else: ?>
                                <div id="portfolio-navigation" class="clearfix">
                                    <div class="port-nav-next">
                                        <?php next_post_link('%link', '<i class="fa fa-angle-left"></i>'); ?>
                                    </div>
                                    <div class="port-nav-prev">
                                        <?php previous_post_link('%link', '<i class="fa fa-angle-right"></i>'); ?>
                                    </div>
                                </div>
                             <?php endif; ?>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        <?php
        }

        if(is_archive() && ( class_exists( 'Woocommerce' ) && !is_woocommerce() ) &&  !get_query_var('portfolio_category') && !get_query_var('faq_category')) {

        ?>
            <div id="page-title">
                <div class="page_title_inner">
                    <div class="container clearfix">
                        <h2>
                            <?php if ( is_day() ) : ?>
                                <?php printf( __( 'Daily Archives: %s', 'twentyeleven' ), '<span>' . get_the_date() . '</span>' ); ?>
                            <?php elseif ( is_month() ) : ?>
                                <?php printf( __( 'Monthly Archives: %s', 'twentyeleven' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'twentyeleven' ) ) . '</span>' ); ?>
                            <?php elseif ( is_year() ) : ?>
                                <?php printf( __( 'Yearly Archives: %s', 'twentyeleven' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'twentyeleven' ) ) . '</span>' ); ?>
                            <?php elseif ( is_author() ) : ?>
                                <?php
                                if(have_posts() ) {
                                    the_post();
                                    ?>
                                    <?php _e('Posts by: ','Nimva'); echo get_the_author(); ?>
                                    <?php
                                    rewind_posts();
                                }
                                ?>
                            <?php elseif ( is_tag() ) : ?>
                                    <?php _e('Tags: ', 'Nimva'); single_cat_title(); ?>
                            <?php else : ?>
                                <?php _e('Category: ', 'Nimva'); single_cat_title(); ?>
                            <?php endif; ?>
                        </h2>
                        <?php
                        if($data['en_breadcrumb']){
                            nimva_breadcrumb();
                        }
                        ?>

                        <?php if ($data['title_breadcrumb_right_side'] != 'Leave Empty'): ?>
                            <div class="searchtop-meta">
                                <?php
                                if($data['title_breadcrumb_right_side'] == 'Social Links') get_template_part('functions/template/social-links');
                                elseif($data['title_breadcrumb_right_side'] == 'Search Box') get_search_form();
                                else get_template_part('functions/template/contact-info');
                                ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        <?php
        }

        if ( is_search() && ( class_exists( 'Woocommerce' ) && !is_woocommerce() ) ) {
        ?>
            <div id="page-title">
                <div class="page_title_inner">
                    <div class="container clearfix">
                        <h2><?php echo _e('Search results for:', 'Nimva'); ?> <?php echo get_search_query(); ?></h2>
                        <?php
                        if($data['en_breadcrumb']){
                            nimva_breadcrumb();
                        }
                        ?>

                        <?php if ($data['title_breadcrumb_right_side'] != 'Leave Empty'): ?>
                            <div class="searchtop-meta">
                                <?php
                                if($data['title_breadcrumb_right_side'] == 'Social Links') get_template_part('functions/template/social-links');
                                elseif($data['title_breadcrumb_right_side'] == 'Search Box') get_search_form();
                                else get_template_part('functions/template/contact-info');
                                ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

        <?php
        }

        if(get_query_var('portfolio_category') || get_query_var('faq_category')){
        ?>
            <div id="page-title">
                <div class="page_title_inner">
                    <div class="container clearfix">
                        <h2><?php single_cat_title(); ?></h2>
                        <?php
                        if($data['en_breadcrumb']){
                            nimva_breadcrumb();
                        }
                        ?>
                        <?php if ($data['title_breadcrumb_right_side'] != 'Leave Empty'): ?>
                            <div class="searchtop-meta">
                                <?php
                                if($data['title_breadcrumb_right_side'] == 'Social Links') get_template_part('functions/template/social-links');
                                elseif($data['title_breadcrumb_right_side'] == 'Search Box') get_search_form();
                                else get_template_part('functions/template/contact-info');
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php
        }

    }
}

add_post_type_support( 'page', 'excerpt' );


function featured_services( $atts, $content = null )
{
  $a = shortcode_atts( array(
    'service_type' => true,
  ), $atts );
  global $post;

  if ($page_content = get_field('service', 'option')) {
    $ret = '<div class="featured">';
    foreach ($page_content as $pc) {
      if (($pc['service_type'] == $a['service_type']) && ($pc['featured_service'])) {
        $ret .= '<div class="featured__item">';
          $ret .= '<a href="/'.str_replace('_', '-', $a['service_type']).'/'.$pc['service_reference'][$a['service_type']]['value'].'"><div class="featured__frame" style="background-image: url('.$pc['service_image']['sizes']['medium'].')">';

          $ret .= '</div></a>';
          // $ret .= '<h4>'.$pc['service_reference'][$a['service_type']]['label'].'</h4>';
          $ret .= '<a href="/'.str_replace('_', '-', $a['service_type']).'/'.$pc['service_reference'][$a['service_type']]['value'].'" class="btn">'.$pc['service_reference'][$a['service_type']]['label'].'</a>';
          if (get_field('show_excerpts', 'option')) {
            $ret .= '<p>'.$pc['service_excerpt'].'</p>';
          }


        $ret .= '</div>';
      }
    }
    $ret .= '</div>';
    $ret .= '<a href="/financial-service" class="btn btn--center">See All Services</a>';

    return $ret;
  }

}

add_shortcode('featured_services', 'featured_services');





function featured_services_rows( $atts, $content = null )
{
  $a = shortcode_atts( array(
    'service_type' => true,
  ), $atts );
  global $post;

  if ($page_content = get_field('service', 'option')) {
    $ret = '<div class="featured-rows">';
    foreach ($page_content as $pc) {
      if (($pc['service_type'] == $a['service_type']) && ($pc['featured_service'])) {
        $ret .= '<div class="featured-rows__container">';
        $ret .= '<div class="featured-rows__item">';
        $ret .= '<div class="featured-rows__image">';
          $ret .= '<a href="/'.str_replace('_', '-', $a['service_type']).'/'.$pc['service_reference'][$a['service_type']]['value'].'"><div class="featured-rows__frame" style="background-image: url('.$pc['service_image']['sizes']['large'].')">';

          $ret .= '</div></a>';
        $ret .= '</div>';
        $ret .= '<div class="featured-rows__content">';
        $ret .= '<h4>'.$pc['service_reference'][$a['service_type']]['label'].'</h4>';

        if (get_field('show_excerpts', 'option')) {
          $ret .= '<p>'.$pc['service_excerpt'].'</p>';
        }
                $ret .= '<a href="/'.str_replace('_', '-', $a['service_type']).'/'.$pc['service_reference'][$a['service_type']]['value'].'" class="btn">Learn More</a>';
        $ret .= '</div>';




        $ret .= '</div>';
        $ret .= '</div>';
      }
    }
    $ret .= '</div>';
    // $ret .= '<a href="/financial-service" class="btn btn--center">See All Services</a>';

    return $ret;
  }

}

add_shortcode('featured_services_rows', 'featured_services_rows');

function all_services( $atts, $content = null )
{
  $a = shortcode_atts( array(
    'service_type' => true,
  ), $atts );
  global $post;


  if ($page_content = get_field('service', 'option')) {
    $ret = '<div class="featured">';
    foreach ($page_content as $pc) {
      if ($pc['service_type'] == $a['service_type']) {
        $ret .= '<div class="featured__item">';
          if (get_field('show_images', 'option')) {
            $ret .= '<a href="/'.str_replace('_', '-', $a['service_type']).'/'.$pc['service_reference'][$a['service_type']]['value'].'"><div class="featured__frame" style="background-image: url('.$pc['service_image']['sizes']['medium'].')">';

            $ret .= '</div></a>';
          }

          // $ret .= '<h4>'.$pc['service_reference'][$a['service_type']]['label'].'</h4>';
          // $ret .= '<p>'.get_the_excerpt().'</p>';
          $ret .= '<a href="/'.str_replace('_', '-', $a['service_type']).'/'.$pc['service_reference'][$a['service_type']]['value'].'" class="btn">'.$pc['service_reference'][$a['service_type']]['label'].'</a>';
        $ret .= '</div>';
      }
    }
    $ret .= '</div>';

    return $ret;
  }

}

add_shortcode('all_services', 'all_services');



function service_list( $atts, $content = null )
{
  $a = shortcode_atts( array(
    'service_type' => true,
  ), $atts );
  global $post;


  if ($page_content = get_field('service', 'option')) {
    foreach ($page_content as $pc) {
      if ($pc['service_type'] == $a['service_type']) {
        $ret .= '<li class="col-lg-12 col-md-6 col-sm-6"><a href="/'.str_replace('_', '-', $a['service_type']).'/'.$pc['service_reference'][$a['service_type']]['value'].'">'.$pc['service_reference'][$a['service_type']]['label'].'</a></li>';
      }
    }

    return $ret;
  }

}

add_shortcode('service_list', 'service_list');


function company_name()
{
  if ($data = get_field('company_name', 'option')) {
    return $data;
  } else {
    return 'Company Name Not Set';
  }
}
add_shortcode('company_name', 'company_name');

function company_phone()
{
  if ($data = get_field('company_phone', 'option')) {
    return $data;
  } else {
    return 'Company Phone Not Set';
  }
}
add_shortcode('company_phone', 'company_phone');

function company_address()
{
  if ($data = get_field('company_address', 'option')) {
    return $data;
  } else {
    return 'Company Address Not Set';
  }
}
add_shortcode('company_address', 'company_address');

function company_email()
{
  if ($data = get_field('company_email_address', 'option')) {
    return $data;
  } else {
    return 'Company Email Not Set';
  }
}
add_shortcode('company_email', 'company_email');



function fmg_retrieve_color($field)
{
  if ($color = get_field($field, 'option')) {
    return $color['color_selector'];
  }
}

function fmg_retrieve_color_name($field)
{
  if ($color = get_field($field, 'option')) {
    return $color['color_names'];
  }
}

add_action('wp_head', 'my_custom_css');

function my_custom_css() {
echo '<style>
:root {
--color-dark: '.fmg_retrieve_color('color_map_dark').';
--color-light: '.fmg_retrieve_color('color_map_light').';
--color-primary: '.fmg_retrieve_color('color_map_primary').';
--color-secondary: '.fmg_retrieve_color('color_map_secondary').';
}
</style>';
}

// bootstrap 5 wp_nav_menu walker
class bootstrap_5_wp_nav_menu_walker extends Walker_Nav_menu
{
  private $current_item;
  private $dropdown_menu_alignment_values = [
    'dropdown-menu-start',
    'dropdown-menu-end',
    'dropdown-menu-sm-start',
    'dropdown-menu-sm-end',
    'dropdown-menu-md-start',
    'dropdown-menu-md-end',
    'dropdown-menu-lg-start',
    'dropdown-menu-lg-end',
    'dropdown-menu-xl-start',
    'dropdown-menu-xl-end',
    'dropdown-menu-xxl-start',
    'dropdown-menu-xxl-end'
  ];

  function start_lvl(&$output, $depth = 0, $args = null)
  {
    $dropdown_menu_class[] = '';
    foreach($this->current_item->classes as $class) {
      if(in_array($class, $this->dropdown_menu_alignment_values)) {
        $dropdown_menu_class[] = $class;
      }
    }
    $indent = str_repeat("\t", $depth);
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu " . esc_attr(implode(" ",$dropdown_menu_class)) . " depth_$depth\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    $this->current_item = $item;

    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
    $classes[] = 'nav-item';
    $classes[] = 'nav-item-' . $item->ID;
    if ($depth && $args->walker->has_children) {
      $classes[] = 'dropdown-menu dropdown-menu-end';
    }

    $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $active_class = ($item->current || $item->current_item_ancestor) ? 'active' : '';
    $nav_link_class = ( $depth > 0 ) ? 'dropdown-item ' : 'nav-link ';
    $attributes .= ( $args->walker->has_children ) ? ' class="'. $nav_link_class . $active_class . ' dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="'. $nav_link_class . $active_class . '"';

    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}
// register a new menu
register_nav_menu('main-menu', 'Main menu');
