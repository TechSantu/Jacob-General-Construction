<?php
/**
 * The template for displaying 404 pages (not found)
 */

get_header();
?>

<section class="blog_layout_section 404-error">
    <div class="section_inner" style="padding: 150px 20px; text-align: center; max-width: 800px; margin: 0 auto;">
        <h1 style="font-size: 8rem; margin-bottom: 20px; color: #333;">404</h1>
        <h2 style="font-size: 2.5rem; margin-bottom: 30px;">Oops! That page can't be found.</h2>
        <p style="font-size: 1.2rem; margin-bottom: 40px; color: #666;">
            It looks like nothing was found at this location. Maybe try one of the links in the menu or a search?
        </p>
        
        <div style="margin-top: 50px;">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="sidebar_cta_btn" style="display: inline-block; padding: 15px 30px; background-color: var(--primary-color, #e05c26); color: #fff; text-decoration: none; font-weight: bold; border-radius: 4px; transition: background-color 0.3s ease;">
                <i class="fa-solid fa-house" style="margin-right: 8px;"></i> Return to Homepage
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
