<?php
	$titan = TitanFramework::getInstance( 'ampsk' );
	$logoId = $titan->getOption( 'amp_sk_logo' );
	// The value may be a URL to the image (for the default parameter)
	// or an attachment ID to the selected image.
	$logoSrc = $logoId; // For the default value
	$logoHeight = $titan->getOption( 'amp_sk_logo_height' );
	if ( is_numeric( $logoId ) ) {
		$logoAttachment = wp_get_attachment_image_src( $logoId, 'full' );
		$logoMeta = wp_get_attachment_metadata( $logoId );
		$logoSrc = $logoAttachment[0];
		$logoWidth = ( $logoHeight * $logoMeta['width'] )/$logoMeta['height'];
	}
	$site_icon_url = $this->get( 'site_icon_url' );
?>
<!doctype html>
<html amp>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no">
	<?php do_action( 'amp_post_template_head', $this ); ?>

	<style amp-custom>
		<?php $this->load_parts( array( 'style' ) ); ?>
		<?php do_action( 'amp_post_template_css', $this ); ?>
		<?php echo $titan->getOption('amp_sk_layout_css'); ?>
	</style>
</head>
<body>
<nav class="amp-wp-title-bar header">
	<div>
		<a href="<?php echo esc_url( $this->get( 'home_url' ) ); ?>" class="clearfix">
			<?php if( $logoId ) : ?>
				<?php
				printf(
					'<amp-img src="%1$s" width="%2$s" height="%3$s" class="amp-wp-site-icon"></amp-img>',
					esc_url( $logoSrc ),
					$logoWidth,
					$logoHeight
				);
				?>
			<?php else: ?>
				<?php if ( $site_icon_url ) : ?>
					<amp-img src="<?php echo esc_url( $site_icon_url ); ?>" width="32" height="32" class="amp-wp-site-icon"></amp-img>
				<?php endif; ?>
			<?php endif; ?>
			<?php if( $titan->getOption('amp_sk_site_name') == 1 ): ?>
			<span>
				<?php echo esc_html( $this->get( 'blog_name' ) ); ?>
			</span>
			<?php endif; ?>
		</a>
		<div class="mwrap">
			<div class="button-wrap">
				<label class="menu-icon" for="menu-btn"><span class="navicon"></span></label>
			</div>
			<?php wp_nav_menu( array( 'container' => '', 'menu' => $titan->getOption('amp_sk_menu') )); ?>
		</div>
	</div>
</nav>

<div class="amp-wp-content">
	<h1 class="amp-wp-title"><?php echo wp_kses_data( $this->get( 'post_title' ) ); ?></h1>
	<?php $elements = $titan->getOption('amp_sk_layout_elements');
	foreach($elements as $element) :
	if($element == 'post_meta') : ?>
		<ul class="amp-wp-meta">
			<?php $this->load_parts( apply_filters( 'amp_post_template_meta_parts', array( 'meta-author', 'meta-time', 'meta-taxonomy' ) ) ); ?>
		</ul>
	<?php endif;
		if($element == 'content'): ?>
			<?php echo $this->get( 'post_amp_content' ); // amphtml content; no kses ?>
		<?php endif;
		if($element == 'comments' && $titan->getOption('amp_sk_post_comment') == 1 ): ?>
			<?php if( $this->get( 'post' )->comment_count > 0 ) : ?>
			<div id="comment">
			<h3>Comments (<?php echo $this->get( 'post' )->comment_count; ?>)</h3>
			<ol class="comment-list">
				<?php
				//Gather comments for a specific page/post
				$comments = get_comments(array(
					'post_id' => $this->get('post_id'),
					'status' => 'approve' //Change this to the type of comments to be displayed
				));

				//Display the list of comments
				wp_list_comments(array(
					'style'       => 'ol',
					'avatar_size' => 42,
					'reverse_top_level' => false //Show the latest comments at the top of the list
				), $comments);
				?>
			</ol>
			</div>
			<?php endif; ?>
		<?php endif;
		if($element == 'related_posts'): ?>
			<div class="related-posts">
				<h3>Related Post</h3>
				<?php
				$cats = get_the_category( $this->get('post_id') );
				$catIDs = array();
				foreach( $cats as $cat ) {
					$catIDs[] = $cat->term_id;
				}
				$args = array(
					'post_type'=> 'post',
					'order'    => 'DESC',
					'posts_per_page' => 6,
					'category__in' => $catIDs
				);
				$the_query = new WP_Query( $args );
				if($the_query->have_posts() ) : ?>
					<ul>
					<?php while ( $the_query->have_posts() ) : ?>
						<?php $the_query->the_post(); ?>
						<?php printf(
							'<li><a href="%1$s" title="%2$s">%2$s</a></li>',
							esc_url(get_the_permalink()),
							esc_html(get_the_title())
						); ?>
					<?php endwhile; ?>
					</ul>
				<?php endif; ?>
				<?php wp_reset_query(); ?>
			</div>
		<?php endif;
	endforeach;
	?>

</div>
<?php do_action( 'amp_post_template_footer', $this ); ?>
<div id="livepreview"></div>
</body>
</html>
