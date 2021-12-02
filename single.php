<?php

/**
 * Author:          Andrei Baicus <andrei@themeisle.com>
 * Created on:      28/08/2018
 *
 * @package Neve
 */

$container_class = apply_filters('neve_container_class_filter', 'container', 'single-post');

get_header();

?>
<div class="<?php echo esc_attr($container_class); ?> single-post-container">
	<div class="row">
		<?php do_action('neve_do_sidebar', 'single-post', 'left'); ?>
		<article id="post-<?php echo esc_attr(get_the_ID()); ?>" class="<?php echo esc_attr(join(' ', get_post_class('nv-single-post-wrap col'))); ?>">
			<?php
			/**
			 *  Executes actions before the post content.
			 *
			 * @since 2.3.8
			 */
			do_action('neve_before_post_content');

			if (have_posts()) {
				while (have_posts()) {
					the_post();
					if (in_category('private')) { //Specifying category whom we don't want to see by no logged in users
						if (is_user_logged_in()) {      //Checking if user logged in or not	
							get_template_part('template-parts/content', 'single');
						} else {
							global $post;
							$post = get_post(323);
							setup_postdata($post);
							get_template_part('template-parts/content', 'single');
						}
					} else {
						get_template_part('template-parts/content', 'single');
					}
				}
			} else {
				the_post();
				get_template_part('template-parts/content', 'none');
			}

			/**
			 *  Executes actions after the post content.
			 *
			 * @since 2.3.8
			 */
			do_action('neve_after_post_content');
			?>
		</article>
		<?php do_action('neve_do_sidebar', 'single-post', 'right'); ?>
	</div>
</div>
<?php
get_footer();
