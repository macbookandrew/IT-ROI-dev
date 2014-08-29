<?php
/*
 * Template for displaying single events, based on page-responsive.php
 */

get_header( 'responsive' ); ?>

<?php get_template_part('responsive/template-part', 'head'); ?>

<?php get_template_part('responsive/template-part', 'topnav-content'); ?>

<!-- start content container -->
<div class="row dmbs-content">
<div class="col-md-12 dmbs-main event-page">
   
    <?php
    // the loop
    if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    
    <div class="col-md-8 main-tt maincon container">
        <h2 class="page-header">Events</h2>
        <p>We are on a mission to make PPM simpler, and we're telling the world.<br>
        Connect and discover relevant, high-impact insight and innovations to help organizations maximize their IT-ROI for their universe</p>
        <div class="clear"></div>
    </div><!-- .main-tt.maincon -->

</div><!-- .dmbs-main.event-page -->
</div><!-- .row.dmbs-content -->

</div><!-- .dmbs-container -->
<div class="dmbs-container">
    <div class="blue-bg"></div>
    <div class="container dmbs-container this-event">
        <div class="col-md-12 main-tt container clearfix">
            <div class="col-sm-6 mainevt">
                <div class="col-md-4 mainevt">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <?php the_post_thumbnail(); ?>
                        <div class="clear"></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6 webinar mainevt">
                    <h1>Webinar</h1>
                </div>
            </div><!-- .col-sm-6.mainevt -->
            <div class="col-sm-6 mainevt clearfix">
                <h2 class="page-headerWebinar">
                    <?php the_title(); ?>
                </h2>
                <?php the_content(); ?>
                <div class="evt-date"><?php the_field('date'); ?> <div class="evt-time"><?php the_field('time'); ?></div></div>
                <div class="register-button"><?php echo get_post_meta( get_the_ID(), 'register_now', true ); ?></div><!-- .register-button -->
            </div><!-- .col-sm-6.mainevt -->
        </div><!-- .col-md-12.main-tt.container -->

    </div><!-- .container.dmbs-container.this-event -->
</div><!-- .dmbs-container -->

<div class="container dmbs-container">
    <div class="col-md-8 col-md-offset-2 main-tt upcoming-events">
        <h3>Upcoming Events</h3>
<!-- TODO: remove current/first post from query -->
        <?php $loop = new WP_Query( array( 'post_type' => 'event', 'posts_per_page' => 4, 'paged' => get_query_var( 'paged' ) ) ); ?>
        <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
        <div class="evt-post" id="post-<?php the_ID(); ?>">
            <div class="col-md-3 evt-thumbnail">
                <?php if ( has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('full'); ?>
                <?php endif; ?>
            </div>
            <div class="col-md-9 evt-content clearfix"><a href="<?php echo get_permalink(); ?>" ><div class="evt-title"><?php the_title(); ?></div></a>
                <div class="evt-date"><?php the_field('date'); ?> <?php the_field('time'); ?></div>
                <div class="register-button"><?php echo get_post_meta( get_the_ID(), 'register_now', true ); ?></div><!-- .register-button -->
                <p><?php the_content(); ?></p>
            </div><!-- .col-md-9.evt-content -->
        </div><!-- .evt-post -->
        <?php endwhile; ?>

        <div class="pagen">
            <div class="navigation clearfix">
            <?php
            // Bring $wp_query into the scope of the function
            global $wp_query;

            // Backup the original property value
            $backup_page_total = $wp_query->max_num_pages;

            // Copy the custom query property to the $wp_query object
            $wp_query->max_num_pages = $loop->max_num_pages;
            ?>
            <?php if (function_exists("pagination")) {
            pagination($custom_query->max_num_pages);
            } ?>

            <?php
            // Finally restore the $wp_query property to it's original value
            $wp_query->max_num_pages = $backup_page_total;
            ?>
            </div><!-- .navigation -->
        </div><!-- .pagen -->

    </div><!-- .col-md-12.main-tt.upcoming-events -->

<?php endwhile; ?>
<?php else: ?>

<?php endif; ?>

<?php get_footer( 'responsive' ); ?>
