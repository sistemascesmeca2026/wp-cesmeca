<?php
function odemca_page_shortcode() {
    $uid = 'odemca_' . uniqid();
    ob_start();
    ?>
<style>
.odemca-wrap{max-width:100%}
.odemca-wrap h2{font-size:1.5rem;margin-bottom:16px;color:#1a1a2e;text-align:center}
.odemca-tabs-nav{display:flex;flex-wrap:wrap;border-bottom:2px solid #ddd;margin-bottom:24px;gap:4px}
.odemca-tab-btn{padding:8px 16px;background:#f5f5f5;border:1px solid #ddd;border-bottom:none;cursor:pointer;font-size:.9rem;color:#555;border-radius:4px 4px 0 0}
.odemca-tab-btn.active{background:#fff;color:#1a1a2e;font-weight:600;border-bottom:2px solid #fff;margin-bottom:-2px}
.odemca-tab-panel{display:none}.odemca-tab-panel.active{display:block}
.odemca-desc{font-size:.97rem;line-height:1.7;color:#333;text-align:justify;margin-bottom:16px}
.odemca-integrantes{text-align:center;font-size:.97rem;line-height:1.8;color:#333}
.odemca-cintillo{text-align:center;margin-top:24px}
.odemca-cintillo img{max-width:100%;border-radius:6px}
@media(max-width:768px){.odemca-tab-btn{font-size:.8rem;padding:6px 10px}}
</style>
<div class="odemca-wrap">
  <h2>Observatorio de las Democracias: Sur de México y Centroamérica (ODEMCA)</h2>
  <div class="odemca-tabs-wrapper" id="<?php echo esc_attr($uid); ?>">
    <div class="odemca-tabs-nav">
      <button class="odemca-tab-btn active" data-tab="desc">Descripcion</button>
      <button class="odemca-tab-btn" data-tab="int">Coordinador e integrantes</button>
    </div>
    <div class="odemca-tab-panel active" data-panel="desc">
      <p class="odemca-desc">El Observatorio de las Democracias: Sur de México y Centroamérica (ODEMCA) es un grupo de investigación con sede en el CESMECA-UNICACH que surgió en el año 2014. Su propósito es el desarrollo de investigaciones académicas, análisis de coyuntura y monitoreo geopolítico de los procesos políticos y sociales en los que se desenvuelven las democracias en el sur de México y Centroamérica. Las democracias son interpretadas como una expresión de los gobiernos, poderes e instituciones de los Estados, así como de las prácticas que emergen desde la sociedad civil y los movimientos sociales para el ordenamiento popular, el autogobierno y la autodeterminación (democracias otras).</p>
      <p class="odemca-desc">Anualmente el ODEMCA convoca el Foro Social sobre Democracias Otras al que acuden organizaciones y movimientos sociales del sur de México y Centroamérica para compartir su agenda política y sus interpretaciones en torno a las democracias alternativas.</p>
      <div class="odemca-cintillo">
        <a href="http://observatoriodemocracia.cesmeca.mx/" target="_blank">
          <img src="/wp-content/uploads/cesmeca-legacy/cintillo.png" alt="Observatorio de las Democracias ODEMCA">
        </a>
      </div>
    </div>
    <div class="odemca-tab-panel" data-panel="int">
      <div class="odemca-integrantes">
        <strong>Integrantes:</strong><br><br>
        Maria del Carmen Garcia Aguilar<br>
        Jesus Solis Cruz<br>
        Pablo Uc<br>
        Manuel Martinez Espinoza<br>
        Daniel Villafuerte Solis<br>
        Carlos de Jesus Gomez Abarca<br>
        Delmar Mendez Gomez
      </div>
    </div>
  </div>
</div>
<script>
(function(){
  var uid=<?php echo json_encode($uid); ?>;
  document.querySelectorAll('#'+uid+' .odemca-tab-btn').forEach(function(btn){
    btn.addEventListener('click',function(){
      document.querySelectorAll('#'+uid+' .odemca-tab-btn').forEach(function(b){b.classList.remove('active')});
      document.querySelectorAll('#'+uid+' .odemca-tab-panel').forEach(function(p){p.classList.remove('active')});
      btn.classList.add('active');
      document.querySelector('#'+uid+' [data-panel="'+btn.getAttribute('data-tab')+'"]').classList.add('active');
    });
  });
})();
</script>
<?php
    return ob_get_clean();
}
add_shortcode('odemca_page','odemca_page_shortcode');
