<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
global $post_id;
?>


    <!-- Blog Layout Section -->
    <section class="blog_layout_section">
        <div class="section_inner">
            <div class="blog_layout_grid">
                
                <!-- Main Blog Post Column -->
                <main class="blog_main_col">
                    <article class="blog_post_single">
                        
                        <!-- Post Meta Info -->
                        <div class="post_meta_bar">
                            <span class="meta_item"><i class="fa-regular fa-user"></i> By <?php the_author(); ?></span>
                            <span class="meta_item"><i class="fa-regular fa-folder"></i> <?php 
                                $categories = get_the_category();
                                if ( ! empty( $categories ) ) {
                                    echo esc_html( implode( ', ', wp_list_pluck( $categories, 'name' ) ) );
                                }
                            ?></span>
                            <span class="meta_item"><i class="fa-regular fa-clock"></i> <?php echo get_the_date('F j, Y'); ?></span>
                            <span class="meta_item"><i class="fa-regular fa-comment"></i> <?php comments_number('0 Comments', '1 Comment', '% Comments'); ?></span>
                        </div>

                        <h2><?php the_title(); ?></h2>

                        <div class="post_featured_image">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'full', array(
                                    'class' => 'img-fluid',
                                    'alt'   => get_the_title()
                                ) ); ?>
                            <?php endif; ?>
                        </div>

                        <!-- Post Body Text Content -->
                        <div class="post_content">
                            <?php the_content(); ?>
                        </div>

                        <?php
                            $tags = get_the_tag_list('', ' ', '');
                            if ($tags) :
                        ?>
                            <div class="post_tags_block">
                                <strong>Tags:</strong>
                                <?php echo $tags; ?>
                            </div>
                        <?php endif; ?>

                    </article>

                    <!-- Comments Section -->
                    <section class="comments_area" aria-label="Article Comments">
                        <h3><?php comments_number('Article Comments (0)', 'Article Comments (1)', 'Article Comments (%)'); ?></h3>
                        <div class="widget_divider"></div>
                        
                        <div class="comments_list">
                            <?php 
                            $post_comments = get_comments(array(
                                'post_id' => get_the_ID(),
                                'status' => 'approve'
                            ));
                            if ( $post_comments ) :
                                foreach($post_comments as $comment) : 
                            ?>
                            
                            <div class="comment_card">
                                <?php 
                                $avatar_url = get_avatar_url($comment, array('size' => 60));
                                if (!$avatar_url) $avatar_url = get_template_directory_uri() . '/assets/image/avatar1.png';
                                ?>
                                <img src="<?php echo esc_url($avatar_url); ?>" alt="User Avatar" class="comment_avatar">
                                <div class="comment_body">
                                    <div class="comment_meta">
                                        <strong><?php comment_author(); ?></strong>
                                        <span><?php comment_date('F j, Y'); ?> at <?php comment_time('g:i A'); ?></span>
                                    </div>
                                    <?php comment_text(); ?>
                                </div>
                            </div>

                            <?php 
                                endforeach; 
                            endif;
                            ?>
                        </div>

                        <!-- Leave a Reply Form -->
                        <div class="leave_reply_block">
                            <?php 
                            $comments_args = array(
                                'class_form'           => 'comment_form',
                                'title_reply_before'   => '<h3>',
                                'title_reply'          => 'Leave a Comment',
                                'title_reply_after'    => '</h3><div class="widget_divider"></div>',
                                'cancel_reply_before'  => ' <span class="cancel-reply-wrap" style="font-size: 14px; font-weight: normal; margin-left: 15px;">',
                                'cancel_reply_after'   => '</span>',
                                'comment_notes_before' => '<p>Your email address will not be published. Required fields are marked *</p>',
                                'logged_in_as'         => '<p class="logged-in-as">Logged in as <a href="' . admin_url( 'profile.php' ) . '">' . $user_identity . '</a>. <a href="' . wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) . '" style="text-decoration: underline;">Log out?</a></p>',
                                'fields'               => array(
                                    'author' => '<div class="form_row">' .
                                                '<div class="form_group">' .
                                                '<label for="com-name">Name *</label>' .
                                                '<input type="text" id="com-name" name="author" required>' .
                                                '</div>',
                                    'email'  => '<div class="form_group">' .
                                                '<label for="com-email">Email *</label>' .
                                                '<input type="email" id="com-email" name="email" required>' .
                                                '</div>' .
                                                '</div>',
                                ),
                                'comment_field'        => '<div class="form_group">' .
                                                          '<label for="com-comment">Comment *</label>' .
                                                          '<textarea id="com-comment" name="comment" rows="6" required></textarea>' .
                                                          '</div>',
                                'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="send_request_btn %3$s">%4$s</button>',
                                'label_submit'         => 'Post Comment',
                                'submit_field'         => '%1$s %2$s',
                            );
                            comment_form( $comments_args ); 
                            ?>
                        </div>
                    </section>

                </main>

                <!-- Blog Sidebar -->
                <aside class="blog_sidebar">
                    <!-- Services Widget -->
                    <div class="sidebar_widget categories_widget">
                        <h3>Our Services</h3>
                        <div class="widget_divider"></div>
                        <?php
                            $services_query = new WP_Query( array(
                                'post_type'      => 'service',
                                'posts_per_page' => -1,
                                'post_status'    => 'publish',
                                'orderby'        => 'menu_order',
                                'order'          => 'ASC',
                            ) );

                            if ( $services_query->have_posts() ) :
                                echo '<ul>';
                                while ( $services_query->have_posts() ) : $services_query->the_post();
                                    ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_title(); ?> <i class="fa-solid fa-chevron-right"></i>
                                        </a>
                                    </li>
                                    <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                        ?>
                    </div>

                    <!-- Recent Posts Widget -->
                    <div class="sidebar_widget recent_posts_widget">
                        <h3>Recent Articles</h3>
                        <div class="widget_divider"></div>
                        <?php
                            $recent_posts_args = array(
                                'post_type'           => 'post',
                                'posts_per_page'      => 5,
                                'post_status'         => 'publish',
                                'orderby'             => 'date',
                                'order'               => 'DESC',
                                'ignore_sticky_posts' => 1,
                            );

                            $recent_posts = new WP_Query( $recent_posts_args );

                            if ( $recent_posts->have_posts() ) : ?>
                                <div class="recent_posts_list">
                                    <?php
                                    while ( $recent_posts->have_posts() ) : $recent_posts->the_post();
                                    ?>
                                        <a href="<?php the_permalink(); ?>" class="recent_post_item">
                                            <?php if ( has_post_thumbnail() ) : ?>
                                                <img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'thumbnail' ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                                            <?php else : ?>
                                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/image/placeholder.jpg' ); ?>" alt="No Thumbnail">
                                            <?php endif; ?>
                                            <div class="recent_info">
                                                <h4><?php the_title(); ?></h4>
                                                <span><?php echo esc_html( get_the_date() ); ?></span>
                                            </div>
                                        </a>
                                    <?php
                                    endwhile;
                                    ?>
                                </div>
                            <?php
                            endif;
                            wp_reset_postdata();
                        ?>
                    </div>

                    <!-- Sidebar CTA -->
                    <div class="sidebar_widget sidebar_cta_widget">
                        <h3>Need Professional Excavation Work?</h3>
                        <p>We provide site prep, drainage grading, septic setups, and concrete paving in Metro Atlanta.</p>
                        <?php 
                        $phone = get_theme_mod( 'jacob_phone', '678-823-9501' );
                        $phone_url = preg_replace('/[^0-9+]/', '', $phone); 
                        ?>
                        <a href="tel:<?php echo esc_attr( $phone_url ); ?>" class="sidebar_cta_btn"><i class="fa-solid fa-phone"></i> Call <?php echo esc_html( $phone ); ?></a>
                    </div>

                </aside>

            </div>
        </div>
    </section>