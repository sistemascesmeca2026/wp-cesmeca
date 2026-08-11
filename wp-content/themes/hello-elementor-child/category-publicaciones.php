<?php
if ( ! defined( "ABSPATH" ) ) exit;
get_header();

global $wp_query;
$anios_disponibles = array();
if ( have_posts() ) {
    foreach ( $wp_query->posts as $p ) {
        $anios_disponibles[ get_the_date( 'Y', $p ) ] = true;
    }
    krsort( $anios_disponibles );
}
?>
<main id="content" class="site-main">
    <div style="max-width:1200px; margin:0 auto; padding:30px 20px;">
        <div class="publicaciones-header"><h1>Publicaciones</h1></div>
        <div class="pub-filtros-wrap">
            <input type="text" id="pub-buscador" placeholder="Buscar por título...">
            <select id="pub-filtro-anio">
                <option value="">Todos los años</option>
                <?php foreach ( array_keys( $anios_disponibles ) as $anio ) : ?>
                    <option value="<?php echo esc_attr( $anio ); ?>"><?php echo esc_html( $anio ); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php if ( have_posts() ) : $pub_i = 0; ?>
        <div class="publicaciones-grid" id="pub-grid">
            <?php while ( have_posts() ) : the_post(); $pub_i++; ?>
            <div class="pub-card<?php echo $pub_i > 12 ? ' pub-card-lote-oculto' : ''; ?>" data-titulo="<?php echo esc_attr( mb_strtolower( get_the_title() ) ); ?>" data-anio="<?php echo esc_attr( get_the_date( 'Y' ) ); ?>">
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
        <div id="pub-cargando" style="text-align:center; padding:20px; display:none;">Cargando más publicaciones…</div>
        <p id="pub-fin-lista" style="text-align:center; padding:20px; color:#777; display:none;"></p>
        <p id="pub-sin-resultados" style="display:none;">No se encontraron publicaciones con esos filtros.</p>
        <?php else : ?>
        <p>No se encontraron publicaciones.</p>
        <?php endif; ?>
    </div>
</main>
<style>
.pub-filtros-wrap { margin: 0 0 24px; display:flex; gap:12px; flex-wrap:wrap; }
.pub-filtros-wrap input, .pub-filtros-wrap select {
    padding: 10px 14px; border: 1px solid #ccc; border-radius: 6px; font-size: 15px; box-sizing: border-box;
}
.pub-filtros-wrap input { flex: 1 1 260px; max-width: 400px; }
.pub-filtros-wrap select { flex: 0 0 160px; }
.pub-card-oculta { display: none !important; }
.pub-card-lote-oculto { display: none !important; }
</style>
<script>
(function() {
    var LOTE = 12;
    var buscador = document.getElementById('pub-buscador');
    var filtroAnio = document.getElementById('pub-filtro-anio');
    var grid = document.getElementById('pub-grid');
    var cargando = document.getElementById('pub-cargando');
    var finLista = document.getElementById('pub-fin-lista');
    var sinResultados = document.getElementById('pub-sin-resultados');
    if (!grid) return;

    var tarjetas = Array.prototype.slice.call(grid.querySelectorAll('.pub-card'));
    var TOTAL = tarjetas.length;

    function filtrosActivos() {
        return (buscador.value.trim() !== '') || (filtroAnio.value !== '');
    }

    function aplicarFiltros() {
        var q = buscador.value.trim().toLowerCase();
        var anio = filtroAnio.value;
        var activos = filtrosActivos();
        var visibles = 0;

        tarjetas.forEach(function(t) {
            if (activos) {
                var coincideTexto = q === '' || t.dataset.titulo.indexOf(q) !== -1;
                var coincideAnio = anio === '' || t.dataset.anio === anio;
                var coincide = coincideTexto && coincideAnio;
                t.classList.remove('pub-card-lote-oculto');
                t.classList.toggle('pub-card-oculta', !coincide);
                if (coincide) visibles++;
            } else {
                t.classList.remove('pub-card-oculta');
            }
        });

        if (!activos) {
            tarjetas.forEach(function(t, i) { t.classList.toggle('pub-card-lote-oculto', i >= LOTE); });
        }

        sinResultados.style.display = (activos && visibles === 0) ? 'block' : 'none';
        actualizarFinDeLista();
    }

    function actualizarFinDeLista() {
        if (filtrosActivos()) { finLista.style.display = 'none'; return; }
        var ocultasPorLote = tarjetas.filter(function(t) { return t.classList.contains('pub-card-lote-oculto'); });
        if (ocultasPorLote.length === 0) {
            finLista.textContent = 'Has visto todas las publicaciones (' + TOTAL + ').';
            finLista.style.display = 'block';
        } else {
            finLista.style.display = 'none';
        }
    }

    function revelarSiguienteLote() {
        if (filtrosActivos()) return;
        var ocultasPorLote = tarjetas.filter(function(t) { return t.classList.contains('pub-card-lote-oculto'); });
        if (ocultasPorLote.length === 0) return;
        ocultasPorLote.slice(0, LOTE).forEach(function(t) { t.classList.remove('pub-card-lote-oculto'); });
        actualizarFinDeLista();
    }

    var sentinel = document.createElement('div');
    grid.after(sentinel);
    var observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting && !filtrosActivos()) {
                cargando.style.display = 'block';
                setTimeout(function() {
                    revelarSiguienteLote();
                    cargando.style.display = 'none';
                }, 200);
            }
        });
    }, { rootMargin: '400px' });
    observer.observe(sentinel);

    buscador.addEventListener('input', aplicarFiltros);
    filtroAnio.addEventListener('change', aplicarFiltros);

    actualizarFinDeLista();
})();
</script>
<?php get_footer(); ?>
