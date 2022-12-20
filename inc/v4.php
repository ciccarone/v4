<?php

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();

}

add_filter( 'excerpt_length', function($length) {
    return get_field('global_excerpt_length', 'option');
}, PHP_INT_MAX );

function new_excerpt_more( $more ) {
	return get_field('global_excerpt_ellipsis', 'option');
}
add_filter('excerpt_more', 'new_excerpt_more');

function acf_load_color_field_choices( $field ) {

    // reset choices
    $field['choices'] = array();


    // get the textarea value from options page without any formatting
    $choices = get_field('v4_theme_colors', 'option', false);


    // explode the value so that each line is a new array piece
    $choices = explode("\n", $choices);


    // remove any unwanted white space
    $choices = array_map('trim', $choices);


    // loop through array and add to field 'choices'
    if( is_array($choices) ) {

        foreach( $choices as $choice ) {

            $field['choices'][ $choice ] = $choice;

        }

    }


    // return the field
    return $field;

}

add_filter('acf/load_field/name=color_selector', 'acf_load_color_field_choices');

function v4_page_content( $atts, $content = null )
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

add_shortcode('v4_page_content', 'v4_page_content');

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
    'bucket_type' => true,
    'center_card_content' => true,
  ), $atts );
  global $post;
	$ret = '';

  if ($page_content = get_field('service', 'option')) {

		$card_center_class = $a['center_card_content'] ? 'text-center' : '';

    $ret .= '<div class="container g-0">';
    $ret .= '<div class="row">';
    foreach ($page_content as $pc) {
      if (($pc['service_type'] == $a['service_type']) && ($pc['featured_service'])) {
				$padding_class = ($a['bucket_type'] == 'image') ? 'p-0' : '';
        $ret .= '<div class="col-md">';

				$ret .= '<div class="card '.$card_center_class.'">';
					$ret .= '<a href="/'.str_replace('_', '-', $a['service_type']).'/'.$pc['service_reference'][$a['service_type']]['value'].'" class="card-header ' . $padding_class . '">';
						if ($a['bucket_type'] == 'icon') {
							$ret .= $pc['service_icon'];
						}
						if ($a['bucket_type'] == 'image') {
							$ret .= '<div class="frame " style="background-image: url('.$pc['service_image']['sizes']['large'].')"></div>';
						}
					$ret .= '</a>';


				  $ret .= '<div class="card-body">';
				    $ret .= '<h5 class="card-title"><a href="/'.str_replace('_', '-', $a['service_type']).'/'.$pc['service_reference'][$a['service_type']]['value'].'">'.$pc['service_reference'][$a['service_type']]['label'].'</a></h5>';
						if (get_field('show_excerpts', 'option')) {
							$ret .= '<p class="card-text">'.$pc['service_excerpt'].'</p>';
						}
				  $ret .= '</div>';
				  $ret .= '<div class="card-footer">';
						$ret .= '<a href="/'.str_replace('_', '-', $a['service_type']).'/'.$pc['service_reference'][$a['service_type']]['value'].'" class="btn btn-primary d-block">Learn More</a>';
				  $ret .= '</div>';
				$ret .= '</div>';
				$ret .= '</div>';
      }
    }
    $ret .= '</div>';
    $ret .= '</div>';
    // $ret .= '<a href="/financial-service" class="btn btn--center">See All Services</a>';

    return $ret;
  }

}

add_shortcode('featured_services_rows', 'featured_services_rows');





function featured_services_slider( $atts, $content = null )
{
  $a = shortcode_atts( array(
    'service_type' => true,
    'bucket_type' => true,
    'center_card_content' => true,
    'slide_count' => true,
  ), $atts );
  global $post;
	$ret = '';

  if ($page_content = get_field('service', 'option')) {

		$card_center_class = $a['center_card_content'] ? 'text-center' : '';


    // $ret .= '<div class="container g-0">';
    // $ret .= '<div class="row">';
    $ret .= '<div class="slide has-slick-slider" data-slick=\'{"slidesToShow": '.$a['slide_count'].', "dots": true, "arrows": false}\'>';
    foreach ($page_content as $pc) {
      if (($pc['service_type'] == $a['service_type']) && ($pc['featured_service'])) {
				$padding_class = ($a['bucket_type'] == 'image') ? 'p-0' : '';

				$ret .= '<a class="slide__item" href="/'.str_replace('_', '-', $a['service_type']).'/'.$pc['service_reference'][$a['service_type']]['value'].'">';
				if ($a['bucket_type'] == 'icon') {
					$ret .= $pc['service_icon'];
				}
				if ($a['bucket_type'] == 'image') {
					$ret .= '<div class="frame " style="background-image: url('.$pc['service_image']['sizes']['large'].')"></div>';
				}
				$ret .= '<div class="slide__content">';
				$ret .= '<h5>'.$pc['service_reference'][$a['service_type']]['label'].'</h5>';
				if (get_field('show_excerpts', 'option')) {
					$ret .= '<p class="slide__text">'.$pc['service_excerpt'].'</p>';
				}
				$ret .= '</div>';
				$ret .= '</a>';

      }
    }
    $ret .= '</div>';
    // $ret .= '</div>';
    // $ret .= '</div>';
    // $ret .= '<a href="/financial-service" class="btn btn--center">See All Services</a>';

    return $ret;
  }

}

add_shortcode('featured_services_slider', 'featured_services_slider');


function featured_services_ping_pong( $atts, $content = null )
{
  $a = shortcode_atts( array(
    'service_type' => true,
    'bucket_type' => true,
  ), $atts );
  global $post;
	$ret = '';

  if ($page_content = get_field('service', 'option')) {



    foreach ($page_content as $pc) {
			$ret .= '<div class="ping-pong">';
			$ret .= '<div class="container g-0">';
			if (($pc['service_type'] == $a['service_type']) && ($pc['featured_service'])) {
				$ret .= '<div class="row">';
					$ret .= '<div class="col-md">';
						$ret .= '<a href="/'.str_replace('_', '-', $a['service_type']).'/'.$pc['service_reference'][$a['service_type']]['value'].'">';
							if ($a['bucket_type'] == 'icon') {
								$ret .= $pc['service_icon'];
							}
							if ($a['bucket_type'] == 'image') {
								$ret .= '<div class="frame " style="background-image: url('.$pc['service_image']['sizes']['large'].')"></div>';
							}
						$ret .= '</a>';
					$ret .= '</div>';
					$ret .= '<div class="col-md">';
						$ret .= '<h3 class="ping-pong-title"><a href="/'.str_replace('_', '-', $a['service_type']).'/'.$pc['service_reference'][$a['service_type']]['value'].'">'.$pc['service_reference'][$a['service_type']]['label'].'</a></h3>';
						if (get_field('show_excerpts', 'option')) {
							$ret .= '<p class="ping-pong-text">'.$pc['service_excerpt'].'</p>';
						}
						$ret .= '<a href="/'.str_replace('_', '-', $a['service_type']).'/'.$pc['service_reference'][$a['service_type']]['value'].'" class="btn btn-primary">Learn More</a>';
					$ret .= '</div>';
				$ret .= '</div>';
			}
			$ret .= '</div>';
			$ret .= '</div>';
    }

    // $ret .= '<a href="/financial-service" class="btn btn--center">See All Services</a>';

    return $ret;
  }

}

add_shortcode('featured_services_ping_pong', 'featured_services_ping_pong');

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


function v4_form_section( $atts, $content = null )
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

add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
    .hidden-acf {
    	display: none;
    }
    }
  </style>';
}

function v4_retrieve_color($field)
{
  if ($color = get_field($field, 'option')) {
    return $color['color_selector'];
  }
}

function v4_retrieve_color_name($field)
{
  if ($color = get_field($field, 'option')) {
    return $color['color_names'];
  }
}

add_action('wp_head', 'my_custom_css');

function my_custom_css() {

$h1 = get_field('h1_settings', 'option');
$h2 = get_field('h2_settings', 'option');
$h3 = get_field('h3_settings', 'option');
$h4 = get_field('h4_settings', 'option');
$h5 = get_field('h5_settings', 'option');
$h6 = get_field('h6_settings', 'option');
$p = get_field('p_settings', 'option');
$logo_max_width = get_field('logo_max_width', 'option');
$global_border_radius = get_field('global_border_radius', 'option');




$button_bg_color = get_field('button_background_color', 'option');
$button_bg_color_hover = get_field('button_background_color_hover', 'option');
$button_text_color = get_field('button_text_color', 'option');
$button_text_color_hover = get_field('button_text_color_hover', 'option');


echo '<style>
:root {
--color-dark: '.v4_retrieve_color('color_map_dark').';
--color-light: '.v4_retrieve_color('color_map_light').';
--color-primary: '.v4_retrieve_color('color_map_primary').';
--color-secondary: '.v4_retrieve_color('color_map_secondary').';
--width-boxed: '.get_field('site_width', 'option').'px;
--global-border-radius: '.get_field('global_border_radius', 'option').'px;
--global-grid-gap: '.get_field('global_grid_gap', 'option').'px;
--global-mobile-breakpoint: '.get_field('global_mobile_breakpoint', 'option').'px;
--global-tablet-breakpoint: '.get_field('global_tablet_breakpoint', 'option').'px;
}

@media  (min-width: '.get_field('global_mobile_breakpoint', 'option').'px) {
	.alignwide {
		max-width: var(--width-boxed) !important;
	}
  }

.boxed {
  max-width: var(--width-boxed);
  margin: 0 auto;
}

@media (max-width: '.get_field('global_mobile_breakpoint', 'option').'px) {
	.grid {
		grid-template-columns: 1fr;
  }
}

.text-primary {
	color: var(--color-primary) !important;
}

.global_border_radius {
	border-radius: var(--global-border-radius);
}


h1 {
  font-size: '.$h1['font_size'].'px;
  font-family: '.$h1['font_family'].';
  font-style: '.$h1['font_style'].';
  font-weight: '.$h1['font_weight'].';
  letter-spacing: '.$h1['letter_spacing'].'px;
  line-height: '.$h1['line_height'].'px;
  text-transform: '.$h1['text_transform'].';
}

h2 {
  font-size: '.$h2['font_size'].'px;
  font-family: '.$h2['font_family'].';
  font-style: '.$h2['font_style'].';
  font-weight: '.$h2['font_weight'].';
  letter-spacing: '.$h2['letter_spacing'].'px;
  line-height: '.$h2['line_height'].'px;
  text-transform: '.$h2['text_transform'].';
}

h3 {
  font-size: '.$h3['font_size'].'px;
  font-family: '.$h3['font_family'].';
  font-style: '.$h3['font_style'].';
  font-weight: '.$h3['font_weight'].';
  letter-spacing: '.$h3['letter_spacing'].'px;
  line-height: '.$h3['line_height'].'px;
  text-transform: '.$h3['text_transform'].';
}

h4 {
  font-size: '.$h4['font_size'].'px;
  font-family: '.$h4['font_family'].';
  font-style: '.$h4['font_style'].';
  font-weight: '.$h4['font_weight'].';
  letter-spacing: '.$h4['letter_spacing'].'px;
  line-height: '.$h4['line_height'].'px;
  text-transform: '.$h4['text_transform'].';
}

h5 {
  font-size: '.$h5['font_size'].'px;
  font-family: '.$h5['font_family'].';
  font-style: '.$h5['font_style'].';
  font-weight: '.$h5['font_weight'].';
  letter-spacing: '.$h5['letter_spacing'].'px;
  line-height: '.$h5['line_height'].'px;
  text-transform: '.$h5['text_transform'].';
}

h6 {
  font-size: '.$h6['font_size'].'px;
  font-family: '.$h6['font_family'].';
  font-style: '.$h6['font_style'].';
  font-weight: '.$h6['font_weight'].';
  letter-spacing: '.$h6['letter_spacing'].'px;
  line-height: '.$h6['line_height'].'px;
  text-transform: '.$h6['text_transform'].';
}

p {
  font-size: '.$p['font_size'].'px;
  font-family: '.$p['font_family'].';
  font-style: '.$p['font_style'].';
  font-weight: '.$p['font_weight'].';
  letter-spacing: '.$p['letter_spacing'].'px;
  line-height: '.$p['line_height'].'px;
  text-transform: '.$p['text_transform'].';
}


.btn {

	background-color: '.v4_retrieve_color('color_map_'.$button_bg_color['color_names']).';
	border-color: '.v4_retrieve_color('color_map_'.$button_bg_color['color_names']).';
	color: '.v4_retrieve_color('color_map_'.$button_text_color['color_names']).';
}

.btn:hover {
	background-color: '.v4_retrieve_color('color_map_'.$button_bg_color_hover['color_names']).';
	border-color: '.v4_retrieve_color('color_map_'.$button_bg_color_hover['color_names']).';
	color: '.v4_retrieve_color('color_map_'.$button_text_color_hover['color_names']).';
}
.site-branding img {
	max-width: '.$logo_max_width.'px;
}
</style>';
}

function v4_dynamic_cards($cards)
{
	$query = $cards['query'];
	$count = $cards['count'];
	$category = $cards['category'];
	$category_condition = $cards['category_condition'];
	$border_radius = $cards['border_radius'];

	// WP_Query arguments
	$args = array(
	    'post_type'              => array('post'),
	    'post_status'            => array('publish'),
	    'posts_per_page'         => $count,
	    'order'                  => 'DESC',
	    'orderby'                => 'date',
			'ignore_sticky_posts' => 1,
	);

	if ($query == 'category') {
	$args['tax_query'] = array(
			'relation' => $category_condition,
			array(
					'taxonomy'         => 'category', // taxonomy slug
					'terms'            => $category, // term ids
					'field'            => 'term_id', // Also support: slug, name, term_taxonomy_id
					'operator'         => 'IN', // Also support: AND, NOT IN, EXISTS, NOT EXISTS
					'include_children' => true,
			)
	);
	}

	// The Query
	$query = new WP_Query($args);

	$image['image_option'] = 'featured';

	// The Loop
	if ($query->have_posts()) {
	    while ($query->have_posts()) {
	        $query->the_post();

          $card_bg_color = get_field('card_background_color', 'option')['color_names'];

          $card_title = v4_heading_generator_default(get_the_ID());

          $card_excerpt = v4_card_excerpt_generator_default(get_the_ID());

          $card_button = v4_button_generator_default(get_the_ID());

          echo '<div class="v4-card bg-color__'.$card_bg_color.' '.$border_radius.'">';
            echo v4_card_image_generator($image, get_the_ID());
            echo '<div class="v4-card__content">';
              echo $card_title;
              echo $card_excerpt;
              echo $card_button;
            echo '</div>';
          echo '</div>';

	        // do something
	    }
	} else {
	    // no posts found
	}

	// Restore original Post Data
	wp_reset_postdata();

}

function v4_button_generator_default($post_id)
{

	if (get_field('card_button_show', 'option')) {

		$b = [
			[
			'button_design' => '',
			'button_position' => 'center',
			'button_link' => [
				'url' => get_the_permalink($post_id),
				'target' => '_self',
				'title' => get_field('card_button_default_text', 'option')
			]
		]
		];

		return v4_button_generator($b);
	} else {
		return;
	}
}

function v4_button_generator($buttons)
{
	if ($buttons) {
		$ret = '';
		$ret .= count($buttons) > 1 ? '<div class="btn__container">' : '';
		foreach ($buttons as $button) {
			$padding_options_top_bottom = get_field('padding_options_top_bottom', 'option');
			$padding_options_left_right = get_field('padding_options_left_right', 'option');
			$ret .= '<a class="btn btn-v4-'.$button['button_design'].' '.$padding_options_top_bottom.' '.$padding_options_left_right.' global_border_radius btn__position--'.$button['button_position'].'" href="'.$button['button_link']['url'].'" target="'.$button['button_link']['target'].'">'.$button['button_link']['title'].'</a>';
		}
		$ret .= count($buttons) > 1 ? '</div>' : '';

		return $ret;
	}
	return false;
}

// for default options:
function v4_heading_generator_default($post_id = false)
{
	$padding_options_top_bottom = get_field('card_title_padding_padding_options_top_bottom', 'option');
	$padding_options_left_right = get_field('card_title_padding_padding_options_left_right', 'option');
		$ret = '<'.get_field('card_title_element_element_options', 'option').' class="'.$padding_options_top_bottom.' '.$padding_options_left_right.' v4-heading text-'.get_field('card_title_position', 'option')['position_options'].' text-'.get_field('card_title_color', 'option')['color_names'].'">'.get_the_title($post_id).'</'.get_field('card_title_element_element_options', 'option').'>';
		return $ret;
}

function v4_heading_generator($headings, $post_id = false)
{
	$title_override = true;
	if ($headings) {

		$ret = '';
		foreach ($headings as $heading) {

			$title_override = $heading['heading_text'] !== '' ? $heading['heading_text'] : get_the_title($post_id);
			$ret .= '<'.$heading['element_options'].' class="v4-heading text-'.$heading['position_options'].' text-'.$heading['color_names'].' '.$heading['heading_padding']['padding_options_left_right'].' '.$heading['heading_padding']['padding_options_top_bottom'].'">'.$title_override.'</'.$heading['element_options'].'>';
		}
		return $ret;
	}
	return false;
}

function v4_card_image_generator($image, $passed_post_id = false)
{
	if ($image) {

		$image_url = false;

		switch ($image['image_option']) {
			case 'featured':

				$post_id = $passed_post_id ? $passed_post_id : $image['card_relationship'][0]->ID;
				$image_url = get_the_post_thumbnail_url($post_id, 'large');
				if ($image_url == '') {
					$image_url = get_field('site_fallback_image','option');
				}
				break;

			case 'upload':
				$image = $image['image_upload'];
				$image_url = $image['sizes']['medium_large'];
				break;

			case 'icon':
				$image = v4_icon_generator($image);
				// $image_url = $image['sizes']['medium_large'];
				break;

			default:
				// code...
				break;
		}



		$ret = '<div class="v4-card__image" style="background-image: url('.$image_url.')"></div>';

		return $ret;
	}
	return false;
}

function v4_text($text)
{
	$padding_options_top_bottom = !empty($text['padding-y']) ? $text['padding-y'] : 'py-0';
	$padding_options_left_right = !empty($text['padding-x']) ? $text['padding-x'] : 'px-0';
	return '<div class="'.$padding_options_top_bottom.' '.$padding_options_left_right.' v4-text text-'.$text['position'].' text-'.$text['color'].'">'.$text['content'].'</div>';
}

function v4_card_excerpt_generator_default($post_id = false)
{
	if (!get_field('card_excerpt_show', 'option')) {
		return;
	}
	$padding_options_top_bottom = get_field('card_excerpt_padding_padding_options_top_bottom', 'option');
	$padding_options_left_right = get_field('card_excerpt_padding_padding_options_left_right', 'option');
	$position = get_field('card_excerpt_position', 'option')['position_options'];
	$color = get_field('card_excerpt_color', 'option')['color_names'];
	return '<div class="'.$padding_options_top_bottom.' '.$padding_options_left_right.' v4-text text-'.$position.' text-'.$color.'">'.get_the_excerpt($post_id).'</div>';
}

function v4_card_excerpt_generator($card)
{
	if ($card['excerpt_options']) {
		$excerpt = '';

		switch ($card['excerpt_options']) {
			case 'show':
				$excerpt = get_the_excerpt($card);
				$text['position'] = $card['excerpt_style']['position_options'];
				$text['color'] = $card['excerpt_style']['color_names'];
				$text['padding-y'] = $card['excerpt_style']['padding_options_top_bottom'];
				$text['padding-x'] = $card['excerpt_style']['padding_options_left_right'];
				$text['content'] = $excerpt;
				$excerpt = v4_text($text);
				break;

			case 'custom':
				$excerpt = $card['custom_excerpt']['text_repeater'][0]['text'];
				$text['position'] = $card['excerpt_style']['position_options'];
				$text['color'] = $card['excerpt_style']['color_names'];
				$text['padding-y'] = $card['excerpt_style']['padding_options_top_bottom'];
				$text['padding-x'] = $card['excerpt_style']['padding_options_left_right'];
				$text['content'] = $excerpt;
				$excerpt = v4_text($text);
				break;

			case 'none':
				$excerpt = '';
				break;

			default:
				$excerpt = false;
				break;
		}
		return $excerpt;
	}
	return false;
}

function v4_card_button_generator($card)
{
	// var_dump($card);
	if ($card['button_options']) {
		$button = '';

		switch ($card['button_options']) {
			case 'show':
				$button_text = $card['card_button_text'];
				break;

			case 'none':
				$button = '';
				break;

			default:
				$button = false;
				break;
		}
		return $button;
	}
	return false;
}

function v4_icon_generator($icon)
{
	// TODO: get working
	var_dump($icon);
}

function v4_text_generator($texts)
{
	$title_override = true;
	if ($texts) {

		$ret = '';
		foreach ($texts as $text) {
			$title_override = $text['text'] !== '' ? $text['text'] : get_the_title();
			$text['position'] = $text['position_options'];
			$text['color'] = $text['color_names'];
			$text['content'] = $title_override;
			$ret .= v4_text($text);
		}
		return $ret;
	}
	return false;
}


function v4_retrieve_overlay_header_boolean()
{
	if (is_front_page()) {
		return get_field('header_overlay_on_homepage', 'option') ? 'header-overlay--true' : '';
	}
}


function v4_retrieve_page_header( $title_override )
{
	return $title_override ? $title_override : get_the_title();

}

add_filter('the_content','do_shortcode');


function v4_author_box() {
  if (!get_field('show_author_boxes_on_posts', 'option')) {
	return false;
  }
	$user_image = false;
	$user_social = false;
	$user_label = false;
	if ($author_repeater = get_field('author_repeater')) {
		$i = 0;
	  foreach ($author_repeater as $author) {


		if ($user_association = $author['author_user_association']) {



			$u[$i]['user_url'] = $user_association->data->user_url;
			$userdata = get_user_meta( $user_association->data->ID );
			$u[$i]['user_bio'] = wpautop($userdata['description'][0]);
			$u[$i]['user_name'] = $user_association->data->display_name;

			if ($user_social_field = get_field('author_social', 'user_'.$user_association->data->ID)['social_links']) {
				$u[$i]['user_social'] = social_unwrapper($user_social_field);
			}

			if ($user_label_field = get_field('author_label', 'user_'.$user_association->data->ID)) {
				$u[$i]['user_label'] = $user_label_field;
			}
			if ($user_image_field = get_field('author_image', 'user_'.$user_association->data->ID)) {
				$u[$i]['user_image'] = $user_image_field['sizes']['thumbnail'];
			}

			global $post;
			$authors_posts = get_posts( array( 'author' => $user_association->data->ID, 'post__not_in' => array( $post->ID ), 'posts_per_page' => 5 ) );

			if ($authors_posts) {
				$post_li = '<ul>';
				foreach ($authors_posts as $authors_post) {
					$post_li .= '<li><a href="'.$authors_post->guid.'">'.$authors_post->post_title.'</a></li>';
				}
				$post_li .= '</ul>';
				$u[$i]['post_li'] = $post_li;
			}

		}

			$i++;
	  }
	} else {
		$u[0]['user_bio'] = get_the_author_meta('description');
		$u[0]['user_name'] = get_the_author_meta('display_name');
		$u[0]['user_url'] = get_the_author_meta('user_url');
		if ($user_social_field = get_field('author_social', 'user_'.get_the_author_meta('ID'))) {
			$u[0]['user_social'] = social_unwrapper($user_social_field['social_links']);
		}

		if ($user_label_field = get_field('author_label', 'user_'.get_the_author_meta('ID'))) {
			$u[0]['user_label'] = $user_label_field;
		}
		if ($user_image_field = get_field('author_image', 'user_'.get_the_author_meta('ID'))) {
			$u[0]['user_image'] = $user_image_field['sizes']['thumbnail'];
		}
		global $post;
		$authors_posts = get_posts( array( 'author' => get_the_author_meta('ID'), 'post__not_in' => array( $post->ID ), 'posts_per_page' => 5 ) );

		if ($authors_posts) {
			$post_li = '<ul>';
			foreach ($authors_posts as $authors_post) {
				$post_li .= '<li><a href="'.$authors_post->guid.'">'.$authors_post->post_title.'</a></li>';
			}
			$post_li .= '</ul>';
			$u[0]['post_li'] = $post_li;
		}
	}
	echo display_author_box($u);
}

function display_author_box($u)
{

	$ret = false;
	foreach ($u as $key => $value) {
		$ret .= '<div class="v4-author__box">';
		$ret .= '<h4>'.$value['user_name'].'</h4>';
		if (isset($value['user_label'])) {
			$ret .= '<h5>'.$value['user_label'].'</h5>';
		}

		if (isset($value['user_social'])) {
			$ret .= $value['user_social'];
		}

		$ret .= '</div>';
	}

	return $ret;
}

function social_unwrapper($socials)
{
	$ret = '<div class="v4-socials">';
	foreach ($socials as $s) {
		// foreach ($social as $s) { dafuq?
			$ret .= '<a href="'.$s['social_network_url'].'" target="_blank">';
				$ret .= '<i class="fa '.$s['social_network'].'"></i>';
			$ret .= '</a>';
		// }
	}
	$ret .= '</div>';
	return $ret;
}

function v4_image_generator($images, $size)
{

	return '<img src="'.$images['sizes'][$size].'" />';
}

function generate_star_rating($rating)
{
	$ret_extra = false;
	$ret = '<div class="v4-star-rating">';
	$ret .= '<div class="v4-star-rating__inner">';
	$ret .= '<div class="v4-star-rating__title">Editor\'s Rating</div>';
	for ($i=0; $i < $rating; $i++) {
		$ret .= '<i class="fas fa-star"></i>';

	}
	if ($rating !== 5) {
		for ($i=0; $i < (5 - $rating); $i++) {
			$ret_extra .= '<i class="fal fa-star"></i>';
		}
	}
	$ret_extra .= '<span>'.$rating.'</span>';
	$ret .= $ret_extra . '</div></div>';
	return $ret;
}
