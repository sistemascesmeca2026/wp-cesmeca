<?php
function eac_page_shortcode() {
    $base = '/wp-content/uploads/cesmeca-legacy/';
    $gal2025 = [
        'actualizacion_2025/desarrollo_comunitario/493728989_1233002238831367_8338653192214803408_n.jpg',
        'actualizacion_2025/desarrollo_comunitario/FEb.jpg',
        'actualizacion_2025/desarrollo_comunitario/Marzo2025.jpg',
        'actualizacion_2025/desarrollo_comunitario/Abril.jpg',
        'actualizacion_2025/desarrollo_comunitario/Mayo2025.jpg',
        'actualizacion_2025/desarrollo_comunitario/Junio_20205.jpg',
        'actualizacion_2025/desarrollo_comunitario/Julio2025.jpg',
        'actualizacion_2025/desarrollo_comunitario/Agosto25.jpg',
        'actualizacion_2025/desarrollo_comunitario/Septiembre2025.jpg',
    ];
    $gal2026 = [
        'actualizacion_2025/desarrollo_comunitario/2026/Cartel_General_2026.png',
        'actualizacion_2025/desarrollo_comunitario/2026/Feb2026.png',
    ];
    $uid = 'eac_' . uniqid();
    ob_start();
    ?>
<style>
.eac-intro{display:flex;gap:40px;margin-bottom:36px;align-items:flex-start}
.eac-intro-text{flex:2}.eac-intro-img{flex:1;text-align:center}
.eac-intro-img img{max-width:100%;border-radius:6px}
.eac-intro-text h2{font-size:1.5rem;margin-bottom:16px;color:#1a1a2e}
.eac-intro-text h3{font-size:1.1rem;margin:16px 0 6px;color:#1a1a2e}
.eac-intro-text p{font-size:.97rem;line-height:1.7;text-align:justify;color:#333;margin-bottom:10px}
.eac-intro-text a{color:#2563eb}
.eac-tabs-nav{display:flex;flex-wrap:wrap;border-bottom:2px solid #ddd;margin-bottom:24px;gap:4px}
.eac-tab-btn{padding:8px 16px;background:#5dade2;border:1px solid #ddd;border-bottom:none;cursor:pointer;font-size:.9rem;color:#fff;border-radius:4px 4px 0 0}
.eac-tab-btn:hover,.eac-tab-btn:focus{background:#5dade2!important;color:#fff!important;text-decoration:none}
.eac-tab-btn.active{background:#3498db!important;color:#fff!important;font-weight:600;border-bottom:2px solid #3498db;margin-bottom:-2px}
.eac-tab-btn.active:hover,.eac-tab-btn.active:focus{background:#3498db!important;color:#fff!important}
.eac-tab-panel{display:none}.eac-tab-panel.active{display:block}
.eac-tabs-wrapper{border:1px solid #e0e0e0!important;border-radius:8px!important;padding:24px!important;box-shadow:0 2px 10px rgba(0,0,0,.06)!important}
.eac-gallery{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:16px;margin-top:8px}
.eac-gallery-item{cursor:pointer;border-radius:6px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.eac-gallery-item img{width:100%;height:220px;object-fit:cover;display:block;transition:transform .2s}
.eac-gallery-item:hover img{transform:scale(1.03)}
.eac-modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.88);z-index:99999;align-items:center;justify-content:center}
.eac-modal-overlay.open{display:flex}
.eac-modal-inner{position:relative;max-width:90vw;max-height:90vh}
.eac-modal-inner img{max-width:88vw;max-height:85vh;border-radius:4px;display:block}
.eac-modal-close{position:absolute;top:-36px;right:0;background:none;border:none;color:#fff;font-size:2rem;cursor:pointer}
.eac-modal-prev,.eac-modal-next{position:fixed;top:50%;transform:translateY(-50%);background:rgba(255,255,255,.15);border:none;color:#fff;font-size:2rem;padding:12px 18px;cursor:pointer;border-radius:4px;z-index:100000}
.eac-modal-prev{left:16px}.eac-modal-next{right:16px}
@media(max-width:768px){.eac-intro{flex-direction:column}.eac-tab-btn{font-size:.8rem;padding:6px 10px}}
</style>
<div class="eac-intro">
  <div class="eac-intro-text">
    
    <p>El seminario interinstitucional de enfoques alternativos y criticos para el desarrollo comunitario es un proyecto permanente que busca integrar aprendizajes hacia un enfoque interdisciplinario y territorial entre los participantes. Se propone para su operacion a la modalidad mixta y con una frecuencia mensual en el que participan actualmente siete instituciones de la region sur-sureste: Centro de Investigacion para el Desarrollo Sustentable (CIDES), Benemerita Universidad Autonoma de Chiapas (Unach), Instituto Tecnologico de Acapulco (ITA), Universidad Autonoma de Ciencias y Artes de Chiapas (Unicach), Universidad Intercultural de Chiapas (Unich), Universidad de la Sierra Juarez (Unsij) y Universidad Politecnica de Chiapas (Upch).</p>
    <p>Estas instituciones se encuentran interesadas en la conformacion de una red academica de apoyo e intercambio de experiencias y aprendizajes para la transformacion regional de las comunidades locales desde la promocion del acceso universal al conocimiento y la promocion de los principios de interculturalidad, justicia social, equidad, igualdad, solidaridad, sustentabilidad, paz e inclusion.</p>
    <h3>Proposito</h3>
    <p>Propiciar el dialogo comunitario, academico e investigativo para la comprension de enfoques criticos y alternativos para el desarrollo comunitario.</p>
    <h3>Registro validado</h3>
    <p>AEC-001/2025, por el Departamento de Educacion Continua de la Secretaria Academica de la Universidad Autonoma de Ciencias y Artes de Chiapas, con fecha de 9 de enero de 2025.</p>
    <h3>Coordinacion general</h3>
    <p>Dra. Nelly Eblin Barrientos Gutierrez<br>Investigadora por Mexico comisionada<br><a href="mailto:negutierrezgu@secihti.mx">negutierrezgu@secihti.mx</a></p>
    <h3>Comite organizador</h3>
    <p>Dr. Amin Andres Miceli Ruiz (Unicach)<br>Dr. Domingo Gomez Lopez (Unich)<br>Dra. Elisa Cruz Rueda (Unach)<br>Dr. Juan Jose Bedolla Solano (ITA)<br>Dra. Maria Jane Rivas Damian (Cides)<br>Dr. Mario Enrique Fuente Carrasco (Unsij)<br>Dra. Nelly Eblin Barrientos Gutierrez (Secihti-Cesmeca)<br>Dr. Roberto Berrones Hernandez (Upch)</p>
    <h3>Correo de informes</h3>
    <p><a href="mailto:proyectocir0352024@gmail.com">proyectocir0352024@gmail.com</a></p>
    <h3>Canal YouTube</h3>
    <p><a href="https://www.youtube.com/@SeminarioInterinstituciona-EAC" target="_blank">youtube.com/@SeminarioInterinstituciona-EAC</a></p>
  </div>
  <div class="eac-intro-img">
    <img src="/wp-content/uploads/cesmeca-legacy/actualizacion_2025/desarrollo_comunitario/493728989_1233002238831367_8338653192214803408_n.jpg" alt="Seminario EAC">
  </div>
</div>
<div class="eac-tabs-wrapper" id="<?php echo esc_attr($uid); ?>">
  <div class="eac-tabs-nav">
    <button class="eac-tab-btn active" data-tab="g2025">Actividades 2025</button>
    <button class="eac-tab-btn" data-tab="g2026">Actividades 2026</button>
  </div>
  <?php foreach(['g2025'=>$gal2025,'g2026'=>$gal2026] as $key=>$imgs): ?>
  <div class="eac-tab-panel <?php echo $key==='g2025'?'active':''; ?>" data-panel="<?php echo $key; ?>">
    <div class="eac-gallery" id="<?php echo esc_attr($uid.'_'.$key); ?>">
      <?php foreach($imgs as $i=>$img): ?>
      <div class="eac-gallery-item" data-gallery="<?php echo esc_attr($uid.'_'.$key); ?>" data-index="<?php echo $i; ?>">
        <img src="<?php echo esc_url($base.$img); ?>" alt="" loading="lazy">
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<div class="eac-modal-overlay" id="<?php echo esc_attr($uid); ?>_modal">
  <button class="eac-modal-prev" id="<?php echo esc_attr($uid); ?>_prev">&#8249;</button>
  <div class="eac-modal-inner">
    <button class="eac-modal-close" id="<?php echo esc_attr($uid); ?>_close">&times;</button>
    <img src="" alt="" id="<?php echo esc_attr($uid); ?>_display">
  </div>
  <button class="eac-modal-next" id="<?php echo esc_attr($uid); ?>_next">&#8250;</button>
</div>
<script>
(function(){
  var uid=<?php echo json_encode($uid); ?>;
  document.querySelectorAll('#'+uid+' .eac-tab-btn').forEach(function(btn){
    btn.addEventListener('click',function(){
      document.querySelectorAll('#'+uid+' .eac-tab-btn').forEach(function(b){b.classList.remove('active')});
      document.querySelectorAll('#'+uid+' .eac-tab-panel').forEach(function(p){p.classList.remove('active')});
      btn.classList.add('active');
      document.querySelector('#'+uid+' [data-panel="'+btn.getAttribute('data-tab')+'"]').classList.add('active');
    });
  });
  var modal=document.getElementById(uid+'_modal');
  var display=document.getElementById(uid+'_display');
  var cur=[],idx=0;
  document.querySelectorAll('#'+uid+' .eac-gallery-item').forEach(function(item){
    item.addEventListener('click',function(){
      var gid=item.getAttribute('data-gallery');
      idx=parseInt(item.getAttribute('data-index'));
      cur=Array.from(document.querySelectorAll('[data-gallery="'+gid+'"] img')).map(function(i){return i.src});
      display.src=cur[idx];modal.classList.add('open');
    });
  });
  document.getElementById(uid+'_close').addEventListener('click',function(){modal.classList.remove('open')});
  modal.addEventListener('click',function(e){if(e.target===modal)modal.classList.remove('open')});
  document.getElementById(uid+'_prev').addEventListener('click',function(){idx=(idx-1+cur.length)%cur.length;display.src=cur[idx]});
  document.getElementById(uid+'_next').addEventListener('click',function(){idx=(idx+1)%cur.length;display.src=cur[idx]});
  document.addEventListener('keydown',function(e){if(e.key==='Escape')modal.classList.remove('open')});
})();
</script>
<?php
    return ob_get_clean();
}
add_shortcode('eac_page','eac_page_shortcode');
