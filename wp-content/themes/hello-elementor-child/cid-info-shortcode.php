<?php
function cid_info_page_shortcode() {
    $base = '/wp-content/uploads/cid/';
    ob_start();
    ?>
<style>
.cid-wrap{max-width:900px;margin:0 auto;padding:10px 0}
.cid-hero{display:flex;gap:32px;align-items:flex-start;margin-bottom:32px}
.cid-hero-text{flex:2}
.cid-hero-img{flex:1;text-align:center}
.cid-hero-img img{max-width:180px;border-radius:6px}
.cid-wrap h1{font-size:1.5rem;color:#1a1a2e;margin-bottom:16px}
.cid-wrap h2{font-size:1.1rem;color:#1a1a2e;margin:24px 0 8px;border-left:4px solid #2563eb;padding-left:10px}
.cid-wrap p,.cid-wrap li{font-size:.97rem;line-height:1.75;color:#333;text-align:justify}
.cid-wrap ul{padding-left:20px;margin-bottom:12px}
.cid-wrap li{margin-bottom:4px}
.cid-contact{background:#f8f9fa;border-radius:6px;padding:16px 20px;margin:20px 0}
.cid-contact p{margin:4px 0}
.cid-gallery{display:grid;grid-template-columns:repeat(4,1fr);gap:10px;margin-top:32px}
.cid-gallery a{display:block;overflow:hidden;border-radius:4px}
.cid-gallery img{width:100%;height:140px;object-fit:cover;transition:transform .3s}
.cid-gallery a:hover img{transform:scale(1.05)}
.cid-lightbox{display:none;position:fixed;inset:0;background:rgba(0,0,0,.85);z-index:9999;align-items:center;justify-content:center}
.cid-lightbox.open{display:flex}
.cid-lightbox img{max-width:90vw;max-height:85vh;border-radius:6px}
.cid-lightbox-close{position:absolute;top:20px;right:30px;color:#fff;font-size:2rem;cursor:pointer;line-height:1}
@media(max-width:768px){.cid-hero{flex-direction:column}.cid-gallery{grid-template-columns:repeat(2,1fr)}}
</style>
<div class="cid-wrap">
  <div class="cid-hero">
    <div class="cid-hero-text">
      <h1>Centro de Información y Documentación "Andrés Fábregas Puig"</h1>
      <h2>Antecedentes</h2>
      <p>El acervo del Centro de Información y Documentación (CID) del CESMECA tiene sus orígenes en la biblioteca del Instituto Chiapaneco de Cultura, la cual comenzó a formarse en 1994. Posteriormente, a partir de la incorporación de algunos servicios de este Instituto a la UNICACH en 1996, su acervo bibliohemerográfico pasó a integrar la bilioteca del CESMECA. Este incipiente acervo constituido por donaciones fue creciendo con el tiempo de tal manera que en la actualidad el CID cuenta con un número aproximado de 11,203 títulos.</p>
      <p>La biblioteca de CESMECA inició una nueva fase en el año 2012 al constituirse el CID. El objetivo fundamental de esta nueva etapa consiste en brindar un servicio profesional y efectivo para los usuarios. Es posible acceder a la base de datos y al catálogo en línea a través de Internet, en la página del CUID <a href="https://siia.unicach.mx/scuid/" target="_blank">https://siia.unicach.mx/scuid/</a>. En las instalaciones se ofrecen los servicios que se relacionan a continuación.</p>
    </div>
    <div class="cid-hero-img">
      <img src="<?php echo $base; ?>cid-3.jpg" alt="CID CESMECA">
    </div>
  </div>
  <h2>Servicios</h2>
  <ul>
    <li>Información y consulta del acervo.</li>
    <li>Referencista</li>
    <li>Fotocopias</li>
    <li>Impresiones</li>
    <li>Escáner</li>
    <li>Boletín de novedades</li>
    <li>Acceso a la base de datos y al catálogo en línea.</li>
    <li>Préstamos en sala.</li>
    <li>Préstamos a domicilio (reservado únicamente para el personal del Instituto y alumnos con identificación oficial vigente).</li>
    <li>Préstamos interbibliotecarios, con bibliotecas locales: CIESAS-Sureste, CIMSUR, ECOSUR, IEI-UNACH, Facultad de Ciencias Sociales-UNACH, CELALI, NA-BOLOM, Universidad de Chapingo, UNICH, Centro de Derechos Fray Bartolomé de Las Casas; además El Colegio de México AC, CIESAS Golfo, DF, Centro de Estudios Migratorios.</li>
  </ul>
  <h2>Colecciones</h2>
  <ul>
    <li>Acervo general</li>
    <li>Colección Chiapas</li>
    <li>Colección Género</li>
    <li>Colección Tesis</li>
    <li>Colección CLACSO</li>
    <li>Material audiovisual</li>
    <li>Hemeroteca</li>
  </ul>
  <h2>Horario de atención y servicio</h2>
  <div class="cid-contact">
    <p><strong>Horario de atención:</strong> De lunes a viernes, de 8:00 a 16:00 h.</p>
    <p><strong>Contacto:</strong></p>
    <p>Correo electrónico: <a href="mailto:cid.cesmeca@unicach.mx">cid.cesmeca@unicach.mx</a></p>
    <p>Teléfono y fax: 9676786921, ext. 107</p>
    <p><strong>Directorio:</strong></p>
    <p><em>Jefa de biblioteca:</em> Lic. Idolina Guzmán Coronado.</p>
  </div>
  <div class="cid-gallery">
    <a href="<?php echo $base; ?>DSC_0417.jpg" class="cid-lb-trigger">
      <img src="<?php echo $base; ?>DSC_0417_mini.jpg" alt="CID foto 1">
    </a>
    <a href="<?php echo $base; ?>DSC_0420.jpg" class="cid-lb-trigger">
      <img src="<?php echo $base; ?>DSC_0420_mini.jpg" alt="CID foto 2">
    </a>
    <a href="<?php echo $base; ?>DSC_0421.jpg" class="cid-lb-trigger">
      <img src="<?php echo $base; ?>DSC_0421_mini.jpg" alt="CID foto 3">
    </a>
    <a href="<?php echo $base; ?>DSC_0423.jpg" class="cid-lb-trigger">
      <img src="<?php echo $base; ?>DSC_0423_mini.jpg" alt="CID foto 4">
    </a>
  </div>
</div>
<div class="cid-lightbox" id="cid-lightbox">
  <span class="cid-lightbox-close" id="cid-lb-close">&times;</span>
  <img src="" id="cid-lb-img" alt="">
</div>
<script>
(function(){
  var lb=document.getElementById('cid-lightbox');
  var lbImg=document.getElementById('cid-lb-img');
  document.querySelectorAll('.cid-lb-trigger').forEach(function(a){
    a.addEventListener('click',function(e){
      e.preventDefault();
      lbImg.src=a.href;
      lb.classList.add('open');
    });
  });
  document.getElementById('cid-lb-close').addEventListener('click',function(){lb.classList.remove('open');});
  lb.addEventListener('click',function(e){if(e.target===lb)lb.classList.remove('open');});
})();
</script>
    <?php
    return ob_get_clean();
}
add_shortcode('cid_info_page', 'cid_info_page_shortcode');
