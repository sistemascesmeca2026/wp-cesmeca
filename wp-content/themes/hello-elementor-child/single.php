<?php
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();

while ( have_posts() ) :
    the_post();
    $cats = get_the_category();
    $cat_slug = $cats ? $cats[0]->slug : '';
    $cat_name = $cats ? $cats[0]->name : '';
    $cat_url  = $cats ? get_category_link($cats[0]->term_id) : '#';
    $prev = get_previous_post(true, '', 'category');
    $next = get_next_post(true, '', 'category');
    $ocultar_imagen = in_array($cat_slug, ['agenda-cultural', 'notas-informativas', 'consejo-academico']);
?>
<style>
.single-wrap {
    max-width: 1100px;
    margin: 0 auto;
    padding: 40px 32px;
}
.single-title-wrap {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    margin-bottom: 32px;
    padding-bottom: 20px;
    border-bottom: 2px solid #f0f0f0;
}
.single-pin {
    background: #2563eb;
    color: #fff;
    border-radius: 6px;
    width: 42px;
    height: 42px;
    min-width: 42px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    margin-top: 2px;
    box-shadow: 0 2px 6px rgba(37,99,235,.3);
}
.single-title-wrap h1.entry-title {
    margin: 0;
    font-size: 1.6rem;
    line-height: 1.3;
    color: #1a1a2e;
    font-weight: 700;
}
.single-content { line-height: 1.8; color: #333; }
.single-content img { max-width: 100%; height: auto; border-radius: 6px; }
.single-content iframe { max-width: 100%; }
.single-featured-img { margin-bottom: 24px; }
.single-featured-img img { width: auto; max-width: 280px; max-height: 380px; object-fit: contain; display: block; margin: 0 auto 24px; border-radius: 8px; box-shadow: 0 4px 16px rgba(0,0,0,.15); }
.single-post-nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 48px;
    margin-bottom: 48px;
    padding-top: 24px;
    border-top: 1px solid #eee;
    gap: 12px;
}
.single-post-nav a {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #fff;
    color: #1a1a2e;
    padding: 10px 20px;
    border-radius: 6px;
    border: 1px solid #ddd;
    text-decoration: none;
    font-size: .9rem;
    font-weight: 600;
    transition: all .2s;
    white-space: nowrap;
}
.single-post-nav a:hover { background: #2563eb; border-color: #2563eb; color: #fff; }
@media(max-width:768px) {
    .single-wrap { padding: 24px 20px; }
    .single-title-wrap h1.entry-title { font-size: 1.3rem; }
    .single-pin { width: 36px; height: 36px; min-width: 36px; font-size: 1rem; }
    .single-post-nav a { padding: 8px 14px; font-size: .85rem; }
}
@media(max-width:480px) {
    .single-wrap { padding: 16px 14px; }
    .single-title-wrap h1.entry-title { font-size: 1.1rem; }
    .single-pin { width: 32px; height: 32px; min-width: 32px; font-size: .9rem; }
    .single-post-nav { margin-top: 32px; }
    .single-post-nav a { padding: 8px 12px; font-size: .8rem; }
    .single-content iframe { width: 100% !important; height: auto !important; aspect-ratio: 16/9; }
}
</style>

<main id="content" <?php post_class('site-main'); ?>>
<div class="single-wrap">
    <div class="single-title-wrap">
        <div class="single-pin"><svg width="16" height="16" viewBox="0 0 24 24" fill="currentColor"><path d="M16 12V4h1V2H7v2h1v8l-2 2v2h5.2v6h1.6v-6H18v-2l-2-2z"/></svg></div>
        <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
    </div>

    <?php if (!$ocultar_imagen && has_post_thumbnail()): ?>
    <div class="single-featured-img">
        <?php the_post_thumbnail('large'); ?>
    </div>
    <?php endif; ?>

    <div class="single-content">
        <?php the_content(); ?>
        <?php wp_link_pages(); ?>
    </div>

    <div class="single-post-nav">
        <?php if ($prev): ?>
        <a href="<?php echo get_permalink($prev->ID); ?>">&#8249; Anterior</a>
        <?php else: ?>
        <span></span>
        <?php endif; ?>
        <?php if ($next): ?>
        <a href="<?php echo get_permalink($next->ID); ?>">Siguiente &#8250;</a>
        <?php else: ?>
        <span></span>
        <?php endif; ?>
    </div>
</div>
    <?php comments_template(); ?>
</main>

<?php
endwhile;

get_footer();
?>
