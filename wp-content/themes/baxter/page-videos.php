<?php get_header(); ?>

<?php
$categoryU = '';
if (isset($_GET['category'])) $categoryU = $_GET['category'];
$filtered = ($categoryU != '');
$current_video_args = array(
	'post_type' => 'post',
	'tax_query' => array(
		array(
			'taxonomy' => 'post_format',
			'field' => 'slug',
			'terms' => 'post-format-video'
		)
	),
	'orderby' => 'date',
	'order' => 'DESC',
	'numberposts' => 1
);
$current_videos = get_posts($current_video_args);
if (!empty($current_videos)) {
	$current_video = $current_videos[0];
	$code = baxter_code_from_video($current_video);
	// $image = baxter_thumbnail_from_video($current_video); 
	$image = wp_get_attachment_url(get_post_thumbnail_id($video->ID));
?>
	<?php // echo '<p>code: ' . $code . '</p>'; 
	?>
	<section class="hero hero-home hero--video">
		<div class="video-wrapper">
			<iframe width="100%" height="100%" src="https://www.youtube.com/embed/<?php echo $code; ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
		</div>
	</section>
<?php
} ?>

<div class="container">
	<p class="title-video-page">Featured Videos</p>
	<section class="center slider">
		<?php
		$categories_filter = array("Lectures", "Interviews", "Auctions", "Conversations");
		$carrousel_videos = "";
		foreach ($categories_filter as &$value) {
			$args = array(
				'category_name' => $value,
				'post_type' => 'post',
				'post_status' => 'publish',
				'posts_per_page' => -1,
				'orderby' => 'date',
				'order' => 'DESC',
			);
			$query = new WP_Query($args);
			if ($query->have_posts()) {
				$recent_post = $query->posts[0]->post_content;
				preg_match('/https:\/\/www\.youtube\.com\/(embed\/|watch\?v=)([\w-]+)/', $recent_post, $matches);
				if (!empty($matches)) {
					$youtube_link = $matches[0];
		?>
					<div class="container-frame">
						<iframe src="<?php echo $youtube_link; ?>" frameborder="0" height="275" width="88%" allowfullscreen></iframe>
					</div>
		<?php
				}
			}
		}
		wp_reset_postdata();
		?>
	</section>
</div>

<div class="video-form">
	<div class="video-form-inner">
		<p class="title-video-page">Newest Videos</p>
		<select id="category">
			<option value="">All Videos</option>
			<option value="Conversations" <?php if ($categoryU == 'Conversations') echo 'selected'; ?>>Conversations</option>
			<option value="Interviews" <?php if ($categoryU == 'Interviews') echo 'selected'; ?>>Interviews</option>
			<option value="Lectures" <?php if ($categoryU == 'Lectures') echo 'selected'; ?>>Lectures</option>
			<option value="Auctions" <?php if ($categoryU == 'Auctions') echo 'selected'; ?>>Auctions</option>
		</select>
	</div><!-- .gallery-form-inner -->
</div><!-- .gallery-form -->
<?php
$categoryTerm = get_term_by('name', strval($categoryU), 'category');

if (!$filtered) {
	$categoryConversations = get_term_by('name', 'Conversations', 'category');
	$termConversations = $categoryConversations->term_id;
	$categoryInterviews = get_term_by('name', 'Interviews', 'category');
	$termInterviews = $categoryInterviews->term_id;
	$categoryLectures = get_term_by('name', 'Lectures', 'category');
	$termLectures = $categoryLectures->term_id;
	$categoryAuctions = get_term_by('name', 'Auctions', 'category');
	$termAuctions = $categoryAuctions->term_id;
	$allCategories = [$termConversations, $termInterviews, $termLectures, $termAuctions];
	if (count($allCategories) > 0) { ?>
		<div class="thumbs thumbs--exhibitions">
			<div class="thumbs-inner">
				<ul id="content-loop">
				</ul>

			</div><!-- .thumbs-inner -->
			<div class="loader">
				<div class="loader-inner"></div>
			</div>
			<div class="load-more-video" data-content="content">
				<?php
				next_posts_link('Load More Videos', 2);
				?>
			</div>
		</div><!-- .thumbs -->
<?php
	}
}
?>

<?php get_footer(); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-migrate-3.4.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
	$(document).on('ready', function() {
		$(".center").slick({
			dots: true,
			infinite: true,
			centerMode: true,
			slidesToShow: 2,
			slidesToScroll: 2,
			adaptiveHeight: true,
			centerPadding: '26px',
			responsive: [{
					breakpoint: 1024,
					settings: {
						slidesToShow: 2,
						infinite: true,
						centerPadding: '24px',
					}
				}, {
					breakpoint: 890,
					settings: {
						slidesToShow: 1,
						dots: true,
						infinite: true,
						speed: 500,
						fade: true,
						cssEase: 'linear',
					}

				},
				{
					breakpoint: 400,
					settings: {
						slidesToShow: 1,
						dots: true,
						infinite: true,
						speed: 500,
						fade: true,
						cssEase: 'linear',
						appendArrows: false
					}

				},
				{
					breakpoint: 300,
					settings: "unslick"

				}
			]
		});

	});
</script>