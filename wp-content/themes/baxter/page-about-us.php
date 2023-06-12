<?php get_header(); ?>


<?php
  if (have_posts()) :
    while (have_posts()) : the_post(); ?>


    <?php
      $custom = get_post_custom( $post->ID );
      if ( isset( $custom['baxter_featured_image_2'] ) && $custom['baxter_featured_image_2'][0] ) {
        $background_image = $custom['baxter_featured_image_2'][0];
      } else {
        $background_image = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
      }
      if ( ! $background_image) {
        $background_image = get_template_directory_uri() . '/images/camera-club.png';
      }
    ?>
    <section class="hero hero-home" style="background-image: url('<?php echo $background_image; ?>')">
  		<!-- <div class="hero-overlay"></div> -->
  	</section><!-- .hero .hero-home -->


  	<div class="left-right">
      <div class="left-right-inner">
        <div class="left-right-left">
          <h1><b>History</b></h1>
          <p>Baxter St at the Camera Club of New York, founded originally as The Camera Club of New York in 1884, is one of New York's oldest arts organizations, providing lens-based artists with both working facilities and platforms for discussions as they develop their practice. In
          2014 , the organization reinvigorated a new wave of influence and impact through which the organization's profile aligns with the mission to support, foster, and innovate contemporary dialogues around the medium and practice of photography and other lens-based arts. Baxter St
          continues to provide a workspace for both darkroom and digital lab access, as well as a range of programming from exhibitions to conversations series toa workspace residency program.</p>
  				<h4><b>Join Our Newsletter</b></h4>
          <p>Sign up to stay in touch on upcoming events!</p>
          <p class="black-button"><a href="#/">SUBSCRIBE</a></p>
        </div>
        <div class="left-right-right">
          <h1></h1>
          <p>In 2018 the organization opened a second location at 128 Baxter St in partnership with East One Coffee Roasters. Just two doors down, the multi-purpose space provides an extension to its current space for exhibitions, events and hosting talks along with other programming.</p>
          <p>The complete historical archives of the Camara Club of New York are housed at the New York Public Library. Related collections are housed in the New York Historical Society and Goarge Eastman House Library in Rochester, New York. This detailed record of the organization's history reveals a dynamic
          organization with a strong commitment to education and a heritage of showcasing the works of photographers known and respected worldwide. It's the organization's mission to continue these traditions and maintain the vitality of
          The Camera Club of New York to those who seek out photography's expressive artistic potential.</p>
        </div>
      </div><!-- .left-right-inner -->
    </div><!-- .left-right -->


    <?php endwhile;
  endif;
?>


<?php get_footer(); ?>
