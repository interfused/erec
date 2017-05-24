<?php
/**
 *
 */

if ( ! is_active_sidebar( 'sidebar-blog' ) )
	return;
?>

<div class="col-md-4 col-xs-12">
	<div class="blog_sidebar">
		<?php dynamic_sidebar( 'sidebar-blog' ); ?>

	</div>
</div>