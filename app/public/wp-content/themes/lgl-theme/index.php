<?php
    get_header();
    // if (have_posts()) :
    //     while (have_posts()) : the_post();

    $tags = get_tags();

    // Display tags as a horizontal bar
    echo '<div class="tags-bar">';
    foreach ($tags as $tag) {
        $tag_link = get_tag_link($tag->term_id);
        echo '<a href="#" class="tag-filter" data-tag="' . esc_attr($tag->slug) . '">' . $tag->name . '</a>';
    }
    echo '</div>';
    ?>
    
    <div id="blog-posts-container">
        <?php
        // The Query for blog posts without tag filter
        $args = array(
            'category_name' => 'blog',
            'post_type' => 'post',
            'posts_per_page' => -1,
        );
    
        $blog_query = new WP_Query($args);
    
        // The Loop
        if ($blog_query->have_posts()) {
            while ($blog_query->have_posts()) {
                $blog_query->the_post();
                ?>
                <div class="blog-post">
                    <h2><?php the_title(); ?></h2>
                    <div class="post-content">
                        <?php the_content(); ?>
                    </div>
                </div>
                <?php
            }
            /* Restore original Post Data */
            wp_reset_postdata();
        } else {
            // No posts found
            echo 'No posts found';
        }
        ?>
    </div>
    
    <script>
    jQuery(document).ready(function ($) {
        $('.tag-filter').on('click', function (e) {
            e.preventDefault();
            var tag = $(this).data('tag');
    
            $.ajax({
                type: 'POST',
                url: '<?php echo admin_url('admin-ajax.php'); ?>',
                data: {
                    action: 'filter_posts',
                    tag: tag,
                },
                success: function (response) {
                    $('#blog-posts-container').html(response);
                },
            });
        });
    });
    </script>
  

 

<?php
    echo '<div class="tags-bar">';
    foreach ($tags as $tag) {
        $tag_link = get_tag_link($tag->term_id);
        echo '<a href="#" class="tag-filter" data-tag="' . esc_attr($tag->slug) . '">' . $tag->name . '</a>';
    }
    echo '</div>';

    get_footer();
 ?>