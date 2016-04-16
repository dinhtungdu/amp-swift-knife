<?php $post_author = $this->get( 'post_author' ); ?>
<li class="amp-wp-byline">
	<?php if ( function_exists( 'get_avatar_url' ) ) : ?>
		<amp-img src="<?php echo esc_url( get_avatar_url( $post_author->user_email, array(
			'size' => 32,
		) ) ); ?>" width="32" height="32" layout="fixed"></amp-img>
	<?php endif; ?>
	<span class="amp-wp-author"><?php echo esc_html( $post_author->display_name ); ?></span>
</li>
