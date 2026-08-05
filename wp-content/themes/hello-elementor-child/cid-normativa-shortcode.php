<?php
function cid_normativa_page_shortcode() {
    ob_start();
    ?>
<style>
.cidn-wrap{max-width:900px;margin:0 auto;padding:10px 0}
.cidn-wrap h1{font-size:1.5rem;color:#1a1a2e;margin-bottom:8px}
.cidn-wrap p{font-size:.97rem;color:#555;margin-bottom:16px}
.cidn-reglamento-img{width:100%;max-width:800px;display:block;margin:24px auto;border-radius:6px;box-shadow:0 2px 12px rgba(0,0,0,.1)}
</style>
<div class="cidn-wrap">
  <h1>Centro de Información y Documentación "Andrés Fábregas Puig"</h1>
  <p>Reglamento de servicios CID CESMECA</p>
  <img src="/wp-content/uploads/cid/reglamento-cid.png"
       alt="Reglamento de servicios CID CESMECA"
       class="cidn-reglamento-img">
</div>
    <?php
    return ob_get_clean();
}
add_shortcode('cid_normativa_page', 'cid_normativa_page_shortcode');
