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
                
                <!-- Main Blog Grid Listing -->
                <div class="blog_main_col">
                    <div class="blog_listing_grid">
                        <?php if ( have_posts() ) : ?>
                            <?php while ( have_posts() ) : the_post(); ?>
                                <article class="blog_card">
                                    <div class="blog_image">
                                        <?php if ( has_post_thumbnail() ) : ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php echo esc_url( get_the_post_thumbnail_url( get_the_ID(), 'medium_large' ) ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                                            </a>
                                        <?php else : ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <img src="<?php echo esc_url( get_template_directory_uri() . '/assets/image/placeholder.jpg' ); ?>" alt="No Thumbnail">
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <div class="blog_content">
                                        <div class="blog_meta">
                                            <span class="blog_tag"><?php 
                                                $categories = get_the_category();
                                                if ( ! empty( $categories ) ) {
                                                    echo esc_html( $categories[0]->name );
                                                }
                                            ?></span>
                                            <span class="blog_date"><?php echo get_the_date('F j, Y'); ?></span>
                                        </div>
                                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                        <p><?php echo wp_trim_words( get_the_excerpt(), 15, '...' ); ?></p>
                                        <a class="blog_read_more" href="<?php the_permalink(); ?>">Read Article <span>➔</span></a>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        <?php else : ?>
                            <div class="no_results" style="grid-column: 1 / -1; text-align: center; padding: 40px; color: var(--text-muted); font-size: 16px;">
                                <i class="fa-solid fa-circle-info" style="font-size: 24px; color: var(--primary-color); display: block; margin-bottom: 12px;"></i>
                                No articles found matching your search.
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Pagination -->
                    <?php
                    $pagination = paginate_links( array(
                        'prev_text' => '← Prev',
                        'next_text' => 'Next ➔',
                        'type'      => 'array',
                    ) );

                    if ( $pagination ) {
                        echo '<div class="blog_pagination">';
                        foreach ( $pagination as $page_link ) {
                            // Replace standard WP classes with theme's classes
                            $page_link = str_replace( "page-numbers", "page_btn", $page_link );
                            $page_link = str_replace( "current", "active", $page_link );
                            $page_link = str_replace( "next", "next_btn", $page_link );
                            $page_link = str_replace( "prev", "next_btn", $page_link );
                            echo $page_link;
                        }
                        echo '</div>';
                    }
                    ?>
                </div>

                <!-- Blog Sidebar -->
                <aside class="blog_sidebar">
                    
                    <!-- Search Widget -->
                    <div class="sidebar_widget search_widget">
                        <h3>Search Blog</h3>
                        <div class="widget_divider"></div>
                        <form class="sidebar_search_form" id="blogAjaxSearch" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="GET">
                            <input type="hidden" name="post_type" value="post">
                            <input type="text" name="s" placeholder="Type keywords..." value="<?php echo get_search_query(); ?>" required>
                            <button type="submit" aria-label="Submit search">
                                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                                <i class="fa-solid fa-spinner fa-spin search-spinner" style="display: none;"></i>
                            </button>
                        </form>
                    </div>

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
                                echo '</ul>';
                            endif;
                            wp_reset_postdata();
                        ?>
                    </div>

                    <!-- Recent Posts Widget -->
                    <div class="sidebar_widget recent_posts_widget">
                        <h3>Recent Articles</h3>
                        <div class="widget_divider"></div>
                        <?php
                            $recent_posts_args = array(
                                'post_type'      => 'post',
                                'posts_per_page' => 3,
                                'post_status'    => 'publish',
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

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var searchForm = document.getElementById('blogAjaxSearch');
        
        function updateBlogContent(urlStr, updateHistory) {
            var icon = searchForm ? searchForm.querySelector('.search-icon') : null;
            var spinner = searchForm ? searchForm.querySelector('.search-spinner') : null;
            
            if(icon) icon.style.display = 'none';
            if(spinner) spinner.style.display = 'inline-block';
            
            fetch(urlStr)
            .then(function(response) { return response.text(); })
            .then(function(html) {
                var parser = new DOMParser();
                var doc = parser.parseFromString(html, 'text/html');
                
                // Update grid
                var newGrid = doc.querySelector('.blog_listing_grid');
                if(newGrid) {
                    document.querySelector('.blog_listing_grid').innerHTML = newGrid.innerHTML;
                }
                
                // Update pagination
                var newPagination = doc.querySelector('.blog_pagination');
                var oldPagination = document.querySelector('.blog_pagination');
                if(newPagination && oldPagination) {
                    oldPagination.innerHTML = newPagination.innerHTML;
                } else if(newPagination && !oldPagination) {
                    document.querySelector('.blog_main_col').appendChild(newPagination);
                } else if(!newPagination && oldPagination) {
                    oldPagination.remove();
                }

                // Update Hero Title if present
                var newHero = doc.querySelector('.inner_hero_content');
                var oldHero = document.querySelector('.inner_hero_content');
                if(newHero && oldHero) {
                    oldHero.innerHTML = newHero.innerHTML;
                }
                
                if(updateHistory) {
                    window.history.pushState({ path: urlStr }, '', urlStr);
                }
                
                if(icon) icon.style.display = 'inline-block';
                if(spinner) spinner.style.display = 'none';
                
                // Smooth scroll to top of grid
                document.querySelector('.blog_layout_section').scrollIntoView({ behavior: 'smooth' });
            })
            .catch(function(err) {
                console.error('Fetch failed', err);
                if(icon) icon.style.display = 'inline-block';
                if(spinner) spinner.style.display = 'none';
            });
        }

        // Handle Search Submit
        if(searchForm) {
            searchForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var url = new URL(searchForm.action);
                url.searchParams.append('s', searchForm.querySelector('[name="s"]').value);
                url.searchParams.append('post_type', 'post');
                updateBlogContent(url.toString(), true);
            });
        }

        // Handle Pagination Clicks
        document.addEventListener('click', function(e) {
            var pageLink = e.target.closest('.blog_pagination a');
            if(pageLink) {
                e.preventDefault();
                updateBlogContent(pageLink.href, true);
            }
        });

        // Handle Back/Forward Buttons
        window.addEventListener('popstate', function(e) {
            if(e.state && e.state.path) {
                updateBlogContent(e.state.path, false);
            } else {
                window.location.reload();
            }
        });
    });
    </script>
