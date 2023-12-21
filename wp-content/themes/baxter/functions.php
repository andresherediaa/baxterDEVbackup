<?php
/**
 * baxter functions and definitions
 *
 * @package baxter
 */


function baxter_after_setup_theme() {
  // image sizes
  add_theme_support( 'post-thumbnails' );
  add_theme_support( 'post-formats', array( 'aside', 'gallery', 'video' ) );
  add_theme_support( 'align-wide' );

  add_theme_support( 'infinite-scroll', array(
    'container' => 'content-loop',
    'footer' => false,
    'type' => 'click',
    'footer_widgets' => true,
    'wrapper' => false,
    'render' => false,
    'posts_per_page' => false
  ) );
	
  // opt out of widget block editor
  remove_theme_support( 'widgets-block-editor' );
  
  // menus
  register_nav_menus( array(
    'primary_nav' => 'Primary Nav',
    'global_nav' => 'Global Nav',
  ) );
}
add_action( 'after_setup_theme', 'baxter_after_setup_theme' );

function baxter_enqueue_scripts() {
  wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/css/slick.css');
  wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/js/slick.js', array( 'jquery' ), false, true );
  wp_enqueue_script( 'main', get_stylesheet_directory_uri() . '/js/main.js', array( 'jquery', 'slick' ), false, true );
}
add_action( 'wp_enqueue_scripts', 'baxter_enqueue_scripts' );

function baxter_admin_enqueue_scripts() {
  wp_enqueue_style('thickbox');
  wp_enqueue_script('jquery');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
  wp_enqueue_script( 'admin', get_stylesheet_directory_uri() . '/js/admin.js', array( 'jquery', 'media-upload', 'thickbox' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'baxter_admin_enqueue_scripts' );

function baxter_code_from_video($video) {
  $content = $video->post_content;
  // return $content;

  $start_index = strpos($content, 'https://www.youtube.com/watch?v=');
  if ($start_index) {
    $tail = substr($content, $start_index + 32);
    $end_index = strpos($tail, '"');
    $code = substr($tail, 0, $end_index);
    return $code;
  }
  
  $start_index = strpos($content, 'https://www.youtube.com/embed/');
  if ($start_index) {
    $tail = substr($content, $start_index + 30);
    $end_index = strpos($tail, '"');
    $code = substr($tail, 0, $end_index);
    return $code;
  }

  $start_index = strpos($content, 'https://youtu.be/');
  if ($start_index) {
    $tail = substr($content, $start_index + 17);
    $end_index = strpos($tail, '"');
    $code = substr($tail, 0, $end_index);
    return $code;
  }

  return '';
}

function baxter_thumbnail_from_video($video) {
  $code = baxter_code_from_video($video);
  $image = 'http://i3.ytimg.com/vi/' . $code . '/maxresdefault.jpg';
  return $image;
}

function baxter_eyebrow($post) {
  $eyebrow = '';
  $categories = get_the_category($post->ID);
  if ( ! empty( $categories ) ) {
    $eyebrow = esc_html($categories[0]->name);
  }
  $today = date('Y-m-d');
  $start_date = get_post_meta( $post->ID, 'start_date', true );
  $end_date = get_post_meta( $post->ID, 'end_date', true );
  if ($end_date && $end_date < $today) {
  	$eyebrow = 'PAST ';
  } else if (!$end_date && $start_date && $start_date < $today) {
	$eyebrow = 'PAST ';
  } else if ($start_date && $start_date > $today) {
    $eyebrow = 'UPCOMING ';
  } else {
	$eyebrow = 'CURRENT ';
  }
  $event_type = get_post_meta($post->ID, 'event_type', true);
  switch ($event_type) {
    case 'coffee_talk':
      $eyebrow .= 'COFFEE TALK';
      break;
    case 'fundraiser':
      $eyebrow .= 'FUNDRAISER';
      break;
    case 'book_fair':
      $eyebrow .= 'ZINE AND PHOTO BOOK FAIR';
      break;
    case 'juried_competition':
      $eyebrow .= 'JURIED COMPETITION';
      break;
    case 'critique_group':
      $eyebrow .= 'CRITIQUE GROUP';
      break;
    case 'conversation':
      $eyebrow .= 'CONVERSATION';
      break;
    case 'exhibition':
     $eyebrow .= 'EXHIBITION';
      break;
    default:
      $eyebrow = '';
      break;
  }
  return $eyebrow;
}

function get_alumni_related_program($post) {
  $eyebrow = '';
  $related_program = get_post_meta($post->ID, 'related_program', true);
  switch ($related_program) {
    case 'baxter_residency':
      $eyebrow = 'Baxter St. Residency';
      break;
    case 'guest_curatorial':
      $eyebrow = 'Guest Curatorial Program';
      break;
	case 'nominations_competitions':
      $eyebrow = 'Nominations & Juried Competitions';
      break;
	case 'project_space':
      $eyebrow = 'Project Space';
      break;
	case 'stoneleaf_residency':
      $eyebrow = 'STONELEAF Residency';
      break;
	case 'youngarts_residency':
      $eyebrow = 'YoungArts Residency';
      break;
	case 'zine_photobook':
      $eyebrow = 'Zine and Photobook Fair';
      break;
    default:
      $eyebrow = '';
      break;
  }
  return $eyebrow;
}

function get_alumni_type($post) {
  $eyebrow = '';
  $type = get_post_meta($post->ID, 'alumni_type', true);
  switch ($type) {
    case 'artists':
      $eyebrow = 'ARTISTS';
      break;
    case 'curators':
      $eyebrow = 'CURATORS';
      break;
	case 'writers':
      $eyebrow = 'WRITERS';
      break;
    default:
      $eyebrow = '';
      break;
  }
  return $eyebrow;
}

function baxter_pagination_content() {
    $query_vars = json_decode( stripslashes( $_POST['query_vars'] ), true );
    $paged = $_POST['page'];
    $query_vars['paged'] = $paged;
    $the_query = new WP_Query( $query_vars );
    if ( $the_query->have_posts() ) : 
        while ( $the_query->have_posts() ) : $the_query->the_post(); 
          get_template_part( 'content', get_post_type() );
        endwhile;
    endif;
    die();
}
add_action( 'wp_ajax_nopriv_baxter_pagination_content', 'baxter_pagination_content' );
add_action( 'wp_ajax_baxter_pagination_content', 'baxter_pagination_content' );

function baxter_pagination_wide() {
  $query_vars = json_decode( stripslashes( $_POST['query_vars'] ), true );
  $paged = $_POST['page'];
  $query_vars['paged'] = $paged;
  $the_query = new WP_Query( $query_vars );
  if ( $the_query->have_posts() ) : 
      while ( $the_query->have_posts() ) : $the_query->the_post(); 
        get_template_part( 'wide', get_post_type() );
      endwhile;
  endif;
  die();
}
add_action( 'wp_ajax_nopriv_baxter_pagination_wide', 'baxter_pagination_wide' );
add_action( 'wp_ajax_baxter_pagination_wide', 'baxter_pagination_wide' );

function baxter_pagination_thumb() {
  $query_vars = json_decode( stripslashes( $_POST['query_vars'] ), true );
  $paged = $_POST['page'];
  $query_vars['paged'] = $paged;
  $the_query = new WP_Query( $query_vars );
  if ( $the_query->have_posts() ) : 
      while ( $the_query->have_posts() ) : $the_query->the_post(); 
        get_template_part( 'thumb', get_post_type() );
      endwhile;
  endif;
  die();
}
add_action( 'wp_ajax_nopriv_baxter_pagination_thumb', 'baxter_pagination_thumb' );
add_action( 'wp_ajax_baxter_pagination_thumb', 'baxter_pagination_thumb' );

function wpse18703_posts_where( $where, $query ) {
    global $wpdb;

    $contains_param = esc_sql( $query->get( 'contains_param' ) );

    if ( $contains_param ) {
        $where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( $wpdb->esc_like( $contains_param ) ) . '%\'';
    }

    return $where;
}
add_filter( 'posts_where', 'wpse18703_posts_where', 10, 2);

function filter_posts_by_category() {
  $category = $_POST['category'];
  $paged = (isset($_POST['paged']) && is_numeric($_POST['paged'])) ? $_POST['paged'] : 1;
  $posts_per_page = 12;
  $argsw = array(
    'category_name' => $category,
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => $posts_per_page,
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged
  );
  $category_videos_query = new WP_Query($argsw);
  $max_num_pages = $category_videos_query->max_num_pages;

  $response = array(
    'success' => true,
    'html' => ''
  );
  
  if ($category_videos_query ->have_posts()) {
    ob_start();
    while ($category_videos_query ->have_posts()) {
      $category_videos_query ->the_post();
      get_template_part('content');
    }
    $response['html'] = ob_get_clean();
  }
  wp_reset_postdata();
  $response['max_num_pages'] = $max_num_pages;
  $response['paged'] =  $paged; //($post_count > $posts_per_page) ? true : false;
  wp_send_json_success($response);
}

add_action('wp_ajax_filter_posts_by_category', 'filter_posts_by_category');
add_action('wp_ajax_nopriv_filter_posts_by_category', 'filter_posts_by_category');

function get_server_urls() {
  wp_enqueue_script('get_server_url', 'js/main.js', array('jquery'));
  wp_localize_script('get_server_url', 'url_object', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'get_server_urls');


//add new fiel to [post]
function add_checkbox_metabox() {
    add_meta_box(
        'checkbox-main-program', 
        'Only for All Programs Section',  
        'show_checkbox_metabox', 
        'post',  
        'normal', 
        'default' 
    );
}
add_action('add_meta_boxes', 'add_checkbox_metabox');

function show_checkbox_metabox($post) {
    $valor_checkbox = get_post_meta($post->ID, 'program_checkbox', true);
    $checked = ($valor_checkbox == 'yes') ? 'checked' : '';
    echo '<input type="checkbox" name="program_checkbox" value="yes" ' . $checked . '> Header in all programs page?';
}
function save_checkbox_metabox($post_id) {
    if (isset($_POST['program_checkbox'])) {
        update_post_meta($post_id, 'program_checkbox', 'yes');
    } else {
        delete_post_meta($post_id, 'program_checkbox');
    }
}
add_action('save_post', 'save_checkbox_metabox');


// Load the custom post types.
include ( TEMPLATEPATH . '/lib/event.php' );
include ( TEMPLATEPATH . '/lib/residency.php' );
include ( TEMPLATEPATH . '/lib/alumni.php' );
// Load widgets.
include ( TEMPLATEPATH . '/lib/primary_events_slider.php' );
include ( TEMPLATEPATH . '/lib/secondary_events_slider.php' );
include ( TEMPLATEPATH . '/lib/articles_slider.php' );
include ( TEMPLATEPATH . '/lib/exhibitions_slider.php' );
include ( TEMPLATEPATH . '/lib/alumni_header.php' );

// Load meta boxes.
include ( TEMPLATEPATH . '/lib/featured_image_2.php' );
