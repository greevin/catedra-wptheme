<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

	<?php if (have_comments()) : ?>
		<h2>
			<?php
                printf(_nx('1 comentário', '%1$s comentários', get_comments_number(), 'twentyfifteen-child'),
                    number_format_i18n(get_comments_number()));
            ?>
		</h2>

		<?php twentyfifteen_comment_nav(); ?>

		<ol class="comment-list">
			<?php
                wp_list_comments(array(
                    'style'       => 'ol',
                    'short_ping'  => true,
                    'avatar_size' => 56,
                    'reverse_top_level' => true
                ));
            ?>
		</ol><!-- .comment-list -->

		<?php twentyfifteen_comment_nav(); ?>

	<?php endif; // have_comments()?>

	<?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if (! comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) :
    ?>
		<p class="no-comments"><?php _e('Comments are closed.', 'twentyfifteen'); ?></p>
	<?php endif; ?>

	<?php $args = array(
        'comment_notes_after' => '<button type="submit" class="new-form-submit" id="submit-new"><span class="dashicons dashicons-arrow-right-alt"></span> '.__('Post Comment').'</button>',
         'logged_in_as' => '<p class="logged-in-as">' . sprintf(__('Comentando como <a href="%1$s">%2$s</a>.', 'twentyfifteen-child'), admin_url('profile.php'), $user_identity) . '</p>',
        );

    comment_form($args); ?>

</div><!-- .comments-area -->
