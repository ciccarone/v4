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

  if ($page_content = get_field('service', 'option')) {

		$card_center_class = $a['center_card_content'] ? 'text-center' : '';

    $ret .= '<div class="container g-0">';
    $ret .= '<div class="row">';
    foreach ($page_content as $pc) {
      if (($pc['service_type'] == $a['service_type']) && ($pc['featured_service'])) {
        $ret .= '<div class="col-md">';

				$ret .= '<div class="card '.$card_center_class.'">';
					$ret .= '<a href="/'.str_replace('_', '-', $a['service_type']).'/'.$pc['service_reference'][$a['service_type']]['value'].'" class="card-header">';
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



function featured_services_ping_pong( $atts, $content = null )
{
  $a = shortcode_atts( array(
    'service_type' => true,
    'bucket_type' => true,
  ), $atts );
  global $post;

  if ($page_content = get_field('service', 'option')) {

    $ret = '<div class="container g-0">';

    foreach ($page_content as $pc) {
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

    }
    $ret .= '</div>';
    $ret .= '</div>';
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
