<?php get_header(); ?>

<div class="container">
  <?php
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $posts_per_page = ($paged == 1) ? 1 : -1;
    $offset = ($paged == 1) ? 0 : 1;

    $args = array(
    'posts_per_page' => $posts_per_page,
    'paged' => $paged,
    'offset' => $offset,
    );

    $custom_query = new WP_Query($args);

  $latest_post = new WP_Query($args);

  if ($custom_query->have_posts()) {
    while ($custom_query->have_posts()) {
      $custom_query->the_post();  
  ?>
      <div class="post">
        <h2 class="post-title"><?php the_title(); ?></h2>
        <p class="post-date"><?php the_time(get_option('date_format')); ?></p>
        <div class="post-content">
  <?php the_content(); ?>
</div>

      </div>
  <?php
    }
  } else {
  ?>
    <p>No posts found.</p>
  <?php
  }
  if ($paged == 1) {
    $next_page_link = get_pagenum_link($paged + 1);
    echo "<a href='" . esc_url($next_page_link) . "'>All Posts</a>";
  }  
  
  wp_reset_query();
  ?>
</div>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var postContents = document.querySelectorAll('.post-content');
    postContents.forEach(function(postContent) {
      var paragraphs = postContent.querySelectorAll('p');
      var lastParagraph = paragraphs[paragraphs.length - 1];
      var text = lastParagraph.textContent.trim();
      lastParagraph.innerHTML = '<span class="post-text">' + text + '</span><span class="cursor"></span>';
    });
  });
</script>

<?php get_footer(); ?>
