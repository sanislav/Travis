<?php get_header(); ?>
<section id="primary">
<div id="content" role="main">
  <?php if ( have_posts() ) { ?>

<header class="page-header">
<h1 class="page-title">
  <?php printf( __( 'Category Archives: %s', 'twentyeleven' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?>
  <?php $category_description = category_description(); ?>
  <?php if ( ! empty( $category_description ) ) { ?>

  <?php echo apply_filters( 'category_archive_meta', '<div class="category-archive-meta">' . $category_description . '</div>' ); ?>
<?php } ?>
</h1></header>  <?php twentyeleven_content_nav( 'nav-above' ); ?>
<?php /* Start the Loop */; ?>
<?php while ( have_posts() ) { ?>

  <?php the_post(); ?>
  <?php get_template_part( 'content', get_post_format() ); ?>
<?php } ?>
  <?php twentyeleven_content_nav( 'nav-below' ); ?>
  <?php } else  { ?>

<article class="post no-results not-found" id="post-0">
<header class="entry-header">
<h1 class="entry-title">
  <?php _e( 'Nothing Found', 'twentyeleven' ); ?>
</h1></header><div class="entry-content">
<p>
  <?php echo - _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?>

</p>  <?php get_search_form(); ?>
</div></article><?php } ?>
</div></section>  

<?php get_sidebar(); ?>
<?php get_footer(); ?>