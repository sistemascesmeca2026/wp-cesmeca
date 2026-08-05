<?php
if ( ! defined( "ABSPATH" ) ) exit;
get_header();
?>
<main id="content" class="site-main">
    <div style="max-width:1200px; margin:0 auto; padding:30px 20px;">
        <div class="publicaciones-header"><h1>Publicaciones</h1></div>
        <?php if ( have_posts() ) : ?>
        <div class="publicaciones-grid">
            <?php while ( have_posts() ) : the_post(); ?>
            <div class="pub-card">
                <div class="pub-card-image">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( "large" ); ?></a>
                    <?php else : ?>
                        <div class="no-cover"><span>Sin portada</span></div>
                    <?php endif; ?>
                    <span class="pub-card-badge">Publicaciones</span><span class="pub-card-date-hover"><?php echo get_the_date(); ?></span>
                </div>
                <div class="pub-card-body">
                    <h2 class="pub-card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="pub-card-excerpt"><?php the_excerpt(); ?></div>
                </div>
                <div class="pub-card-footer">
                    <span class="pub-card-date"><?php echo get_the_date(); ?></span>
                    <a class="pub-card-link" href="<?php the_permalink(); ?>">Leer más »</a>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div class="publicaciones-pagination">
            <?php echo paginate_links(["prev_text" => "&larr; Anterior", "next_text" => "Siguiente &rarr;"]); ?>
        </div>
        <?php else : ?>
        <p>No se encontraron publicaciones.</p>
        <?php endif; ?>
    </div>
</main>
<?php get_footer(); ?>
