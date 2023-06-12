<?php get_header(); ?>

<?php 
$alumni_type = '';
$related_program = '';
$order_by = '';
$search_param = '';

if (isset($_GET['alumni_type'])) $alumni_type = $_GET['alumni_type']; 
if (isset($_GET['related_program'])) $related_program = $_GET['related_program'];
if (isset($_GET['order_by'])) $order_by = $_GET['order_by'];
if (isset($_GET['search_param'])) $search_param = $_GET['search_param']; 
$filtered = ($alumni_type != '' || $related_program != '' || $order_by || $search_param != '');
?>
<?php if ( is_active_sidebar( 'baxter_alumni_header' ) ) : ?>
	<?php dynamic_sidebar( 'baxter_alumni_header' ); ?>
<?php endif; ?>
<div class="all-alumni-content">	
  <?php if (!$filtered) { ?>
	  <div class="thumbs thumbs--alumni">
		<div class="thumbs-inner alumni-thumbs-inner">
		  <ul id="content-loop">

			<?php
			  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			  $all_alumni_args = array(
				'post_type' => 'baxter_alumni',
				'post_status' => 'publish',
				'post__not_in'  => array( 21837 ),
				'numberposts' => -1,
				'posts_per_page' => 9,
				'paged' => $paged,
				'meta_query' => array(
				  'last_name__order_by' => array(
				  'key' => 'last_name',
				  'compare' => 'exists',
			  	  )
				),
				'orderby' => array( 'last_name__order_by' => 'ASC' )
			  );
			  $all_alumni_query = new WP_Query( $all_alumni_args ); 
			  if ( $all_alumni_query->have_posts() ) : 
				while ( $all_alumni_query->have_posts() ) : $all_alumni_query->the_post(); 
				  get_template_part( 'content', get_post_type() );
				endwhile;
			  endif;
			?>
		  </ul>
		</div><!-- .thumbs-inner -->

		<?php
	  echo $paged;
	  wp_localize_script(
		'main',
		'baxter_pagination',
		array(
		  'paged' => $paged + 1,
		  'max_num_pages' => $all_alumni_query->max_num_pages,
		  'query' => json_encode( $all_alumni_query->query )
		)
	  );
	  ?>
	  <div class="load-more load-alumni" data-content="content">
		<?php 
		next_posts_link('Load More Alumni', $all_alumni_query->max_num_pages); 
		?>
	  </div>

	  </div><!-- .thumbs -->

	  <?php 
		wp_reset_postdata(); 
	  ?>
	
	<?php } else { // filtered ?>
	  <div class="thumbs thumbs--alumni">
		<div class="thumbs-inner alumni-thumbs-inner">
		  <ul id="content-loop">

		  <?php

		  $meta_query = array();
	
		  //Begin Filter Type of Alumni
		  if ($alumni_type == 'artists') {
			array_push($meta_query, array(
			  'key' => 'alumni_type',
			  'value' => 'artists',
			  'compare' => '='
			));
		  } else if ($alumni_type == 'curators') {
			array_push($meta_query, array(
			  'key' => 'alumni_type',
			  'value' => 'curators',
			  'compare' => '='
			));
		  } else if ($alumni_type == 'writers') {
			array_push($meta_query, array(
			  'key' => 'alumni_type',
			  'value' => 'writers',
			  'compare' => '='
			));
		  }
		  //End Filter Type of Alumni
		
		  //Begin Filter Related Program
		  if ($related_program == 'baxter_residency') {
			array_push($meta_query, array(
			  'key' => 'related_program',
			  'value' => 'baxter_residency',
			  'compare' => '='
			));
		  } else if ($related_program == 'guest_curatorial') {
			array_push($meta_query, array(
			  'key' => 'related_program',
			  'value' => 'guest_curatorial',
			  'compare' => '='
			));
		  } else if ($related_program == 'nominations_competitions') {
			array_push($meta_query, array(
			  'key' => 'related_program',
			  'value' => 'nominations_competitions',
			  'compare' => '='
			));
		  } else if ($related_program == 'project_space') {
			array_push($meta_query, array(
			  'key' => 'related_program',
			  'value' => 'project_space',
			  'compare' => '='
			));
		  } else if ($related_program == 'stoneleaf_residency') {
			array_push($meta_query, array(
			  'key' => 'related_program',
			  'value' => 'stoneleaf_residency',
			  'compare' => '='
			));
		  } else if ($related_program == 'youngarts_residency') {
			array_push($meta_query, array(
			  'key' => 'related_program',
			  'value' => 'youngarts_residency',
			  'compare' => '='
			));
		  } else if ($related_program == 'zine_photobook') {
			array_push($meta_query, array(
			  'key' => 'related_program',
			  'value' => 'zine_photobook',
			  'compare' => '='
			));
		  }
		  //End Filter Related Program
		
		  //Begin Order by Filter
		  if($order_by == 'z_a') {
			  $filter_args = array(
				  'post_type' => 'baxter_alumni',
				  'post_status' => 'publish',
				  'meta_query' => array(
				    'last_name__order_by' => array(
				      'key' => 'last_name',
				      'compare' => 'exists',
			  	    )
				  ),
				  'post__not_in'  => array( 21837 ),
				  'posts_per_page' => -1,
				  'contains_param' => $search_param,
				  'orderby' => array( 'last_name__order_by' => 'DESC' )
			  );
		  } else if($order_by == 'a_z') {
			  $filter_args = array(
				  'post_type' => 'baxter_alumni',
				  'post_status' => 'publish',
				  'meta_query' => array(
				    'last_name__order_by' => array(
				      'key' => 'last_name',
				      'compare' => 'exists',
			  	    )
				  ),
				  'post__not_in'  => array( 21837 ),
				  'posts_per_page' => -1,
				  'contains_param' => $search_param,
				  'orderby' => array( 'last_name__order_by' => 'ASC' )
			  );
		  } else if($order_by == 'old_new') {
			  array_push($meta_query, array(
				  'key' => 'year',
				  'type' => 'numeric'
				));
			  $filter_args = array(
				  'post_type' => 'baxter_alumni',
				  'post_status' => 'publish',
				  'meta_query' => $meta_query,
				  'post__not_in'  => array( 21837 ),
				  'orderby' => 'year',
				  'order' => 'ASC',
				  'posts_per_page' => -1,
				  'contains_param' => $search_param,
			  );
		  }
		  else {
			  array_push($meta_query, array(
				  'key' => 'year',
				  'type' => 'numeric'
				));
			  $filter_args = array(
				  'post_type' => 'baxter_alumni',
				  'post_status' => 'publish',
				  'meta_query' => $meta_query,
				  'post__not_in'  => array( 21837 ),
				  'orderby' => 'year',
				  'order' => 'DESC',
				  'posts_per_page' => -1,
				  'contains_param' => $search_param,
			  );
		  }
		  //End Order By Filter
		  $the_query = new WP_Query( $filter_args ); 
		  if ( $the_query->have_posts() ) : 
			while ( $the_query->have_posts() ) : $the_query->the_post(); 
			  get_template_part( 'content', get_post_type() );
			endwhile;
	      else :
		  ?>
			<div class="no-results-alumni" data-content="content">
			  No results found.
	  		</div>
		  <?php endif; ?>
	      </ul>
	    </div>
	  </div>
	  
	<?php wp_reset_postdata(); ?>


	<?php } // filtered ?>

</div><!-- . -->

<?php get_footer(); ?>