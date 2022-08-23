<?php

if( function_exists('acf_add_options_page') ) {

	acf_add_options_page();

}

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

echo '<style>
:root {
--color-dark: '.v4_retrieve_color('color_map_dark').';
--color-light: '.v4_retrieve_color('color_map_light').';
--color-primary: '.v4_retrieve_color('color_map_primary').';
--color-secondary: '.v4_retrieve_color('color_map_secondary').';
--width-boxed: '.get_field('site_width', 'option').'px;
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
  font-size: '.$h6['font_size'].'px;
  font-family: '.$h6['font_family'].';
  font-style: '.$h6['font_style'].';
  font-weight: '.$h6['font_weight'].';
  letter-spacing: '.$h6['letter_spacing'].'px;
  line-height: '.$h6['line_height'].'px;
  text-transform: '.$h6['text_transform'].';
}
</style>';
}


function v4_button_generator($buttons)
{
	if ($buttons) {
		$ret = '';
		foreach ($buttons as $button) {
			$ret .= '<a class="btn btn-v4-'.$button['button_design'].' btn__position--'.$button['button_position'].'" href="'.$button['button_link']['url'].'" target="'.$button['button_link']['target'].'">'.$button['button_link']['title'].'</a>';
		}
		return $ret;
	}
	return false;
}

function v4_heading_generator($headings)
{
	$title_override = true;
	if ($headings) {

		$ret = '';
		foreach ($headings as $heading) {
			$title_override = $heading['heading_text'] !== '' ? $heading['heading_text'] : get_the_title();
			$ret .= '<'.$heading['element_options'].' class="p-0 v4-heading text-'.$heading['position_options'].' text-'.$heading['color_names'].'">'.$title_override.'</'.$heading['element_options'].'>';
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
