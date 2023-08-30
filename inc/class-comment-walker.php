<?php
class Genz_Walker_Comment extends Walker_Comment
{


    /**
     * Outputs a comment in the HTML5 format.
     *
     * @since 3.6.0
     *
     * @see wp_list_comments()
     *
     * @param WP_Comment $comment Comment to display.
     * @param int        $depth   Depth of the current comment.
     * @param array      $args    An array of arguments.
     */
    protected function html5_comment($comment, $depth, $args)
    {
        $tag = ('div' === $args['style']) ? 'div' : 'li';

        $commenter          = wp_get_current_commenter();
        $show_pending_links = !empty($commenter['comment_author']);

        if ($commenter['comment_author_email']) {
            $moderation_note = esc_attr__('Your comment is awaiting moderation.', 'genz');
        } else {
            $moderation_note = esc_attr__('Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.', 'genz');
        }
?>
        <<?php echo esc_attr($tag); ?> id="comment-<?php comment_ID(); ?>" <?php comment_class($this->has_children ? 'item-comment-sub' : '', $comment); ?>>
            <div id="div-comment-<?php comment_ID(); ?>" class="item-comment comment-body">
                <div class="comment-left">
                    <div class="box-author align-items-start mb-20">
                        <?php
                        if (0 != $args['avatar_size']) {
                            $author_avatar_id = !empty($comment->user_id) ? $comment->user_id : $comment->comment_author_email;
                            echo get_avatar($author_avatar_id, $args['avatar_size']);
                        }
                        ?>
                        <div class="author-info lh-1">
                            <?php
                            $comment_author = get_comment_author_link($comment);

                            if ('0' == $comment->comment_approved && !$show_pending_links) {
                                $comment_author = get_comment_author($comment);
                            }

                            printf('<h6 class="fn lh-1 color-gray-500">%s</h6>', $comment_author);
                            printf(
                                /* translators: 1: Comment date, 2: Comment time. */
                                __('<span class="color-gray-700 text-sm mr-30">%1$s </span>', 'genz'),
                                get_comment_date('', $comment)

                            )

                            ?>

                            <?php
                            if ('1' == $comment->comment_approved || $show_pending_links) {
                                comment_reply_link(
                                    array_merge(
                                        $args,
                                        array(
                                            'add_below' => 'div-comment',
                                            'depth'     => $depth,
                                            'max_depth' => $args['max_depth'],
                                            'before'    => '<div class="reply">',
                                            'after'     => '</div>',
                                        )
                                    )
                                );
                            }
                            ?>

                        </div>
                    </div>
                </div>
                <div class="comment-right">
                    <div class="comment-content text-comment text-lg color-gray-500 bg-gray-850 border-gray-800">
                        <?php if ('0' == $comment->comment_approved) : ?>
                            <em class="comment-awaiting-moderation"><?php echo esc_attr($moderation_note); ?></em>
                        <?php endif; ?>
                        <?php comment_text(); ?>
                    </div>
                </div>
            </div>

    <?php
    }
}
