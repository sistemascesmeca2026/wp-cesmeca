<?php
function seminario_historia_shortcode() {
    $agenda = [
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2026/02/12/633259523_26439353935670993_5625947691991344746_n.jpg','alt'=>'Agenda seminario'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2026/02/12/631744838_26439353942337659_4064999045065488171_n.jpg','alt'=>'Agenda seminario'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2026/02/12/490469037_1217855590346032_1991189855996174867_n.jpg','alt'=>'Agenda seminario'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2026/02/12/492069699_1053389130253056_4900088558451583392_n.jpg','alt'=>'Agenda seminario'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2026/02/12/515439637_1338390048292585_3145956085056992701_n_1.jpg','alt'=>'Agenda seminario'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2026/02/12/569035112_1394469272684662_7779209741331473144_n_1.jpg','alt'=>'Agenda seminario'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2021/00/seminario-de-historia-2021-agosto-noviembre.png','alt'=>'Seminario agosto-noviembre 2021'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2026/02/12/enero-mayo.2020CARTEL_s.jpg','alt'=>'Enero-mayo 2020'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/seminario_permanente/cartel-1ersemestre2018.jpg','alt'=>'Primer semestre 2018'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/seminario_permanente/2019.1er.semestre.jpg','alt'=>'Primer semestre 2019'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/seminario_permanente/cartel-segundo-semestre-2018.jpg','alt'=>'Segundo semestre 2018'],
    ];
    $videos = [
        ['id'=>'9tbQ_-U76NY','title'=>'Seminario Permanente de Historia de Chiapas y Centroamerica'],
    ];
    $uid = 'semhist_' . uniqid();
    ob_start();
    ?>
<style>
.semhist-wrap{max-width:100%}
.semhist-intro{margin-bottom:36px}
.semhist-intro h2{font-size:1.5rem;margin-bottom:16px;color:#1a1a2e}
.semhist-intro h3{font-size:1.1rem;margin:20px 0 8px;color:#1a1a2e}
.semhist-intro p{font-size:.97rem;line-height:1.7;text-align:justify;color:#333}
.semhist-tabs-nav{display:flex;flex-wrap:wrap;border-bottom:2px solid #ddd;margin-bottom:24px;gap:4px}
.semhist-tab-btn{padding:8px 16px;background:#5dade2;border:1px solid #ddd;border-bottom:none;cursor:pointer;font-size:.9rem;color:#fff;border-radius:4px 4px 0 0}
.semhist-tab-btn.active{background:#3498db!important;color:#fff!important;font-weight:600;border-bottom:2px solid #3498db;margin-bottom:-2px}
.semhist-tab-btn:hover,.semhist-tab-btn:focus{background:#5dade2!important;color:#fff!important;text-decoration:none}
.semhist-tab-btn.active:hover,.semhist-tab-btn.active:focus{background:#3498db!important;color:#fff!important}
.semhist-tab-panel{display:none}.semhist-tab-panel.active{display:block}
.semhist-tabs-wrapper{border:1px solid #e0e0e0!important;border-radius:8px!important;padding:24px!important;box-shadow:0 2px 10px rgba(0,0,0,.06)!important}
.semhist-gallery{display:grid;grid-template-columns:repeat(6,1fr);gap:8px;margin-top:8px}
.semhist-gallery-item{cursor:pointer;border-radius:4px;overflow:hidden;aspect-ratio:3/4;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.semhist-gallery-item img{width:100%;height:100%;object-fit:cover;display:block;transition:transform .2s}
.semhist-gallery-item:hover img{transform:scale(1.03)}
.semhist-videos-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:20px;margin-top:8px}
.semhist-video-item{cursor:pointer;border-radius:8px;overflow:hidden;background:#000;box-shadow:0 2px 8px rgba(0,0,0,.15)}
.semhist-video-thumb{position:relative}
.semhist-video-thumb img{width:100%;height:160px;object-fit:cover;display:block;opacity:.85}
.semhist-video-item:hover .semhist-video-thumb img{opacity:1}
.semhist-video-play{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:48px;height:48px;background:rgba(255,0,0,.85);border-radius:50%;display:flex;align-items:center;justify-content:center}
.semhist-video-play svg{width:20px;height:20px;fill:#fff;margin-left:3px}
.semhist-video-title{padding:10px 12px;background:#111;color:#eee;font-size:.8rem;line-height:1.4;min-height:52px}
.semhist-modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.88);z-index:99999;align-items:center;justify-content:center}
.semhist-modal-overlay.open{display:flex}
.semhist-modal-inner{position:relative;max-width:90vw;max-height:90vh}
.semhist-modal-inner img{max-width:88vw;max-height:85vh;border-radius:4px;display:block}
.semhist-modal-inner iframe{width:80vw;height:45vw;max-height:80vh;border:none;border-radius:4px;display:block}
.semhist-modal-close{position:absolute;top:-36px;right:0;background:none;border:none;color:#fff;font-size:2rem;cursor:pointer}
.semhist-modal-prev,.semhist-modal-next{position:fixed;top:50%;transform:translateY(-50%);background:rgba(255,255,255,.15);border:none;color:#fff;font-size:2rem;padding:12px 18px;cursor:pointer;border-radius:4px;z-index:100000}
.semhist-modal-prev{left:16px}.semhist-modal-next{right:16px}
@media(max-width:768px){.semhist-tab-btn{font-size:.8rem;padding:6px 10px}.semhist-modal-inner iframe{width:95vw;height:54vw}.semhist-gallery{grid-template-columns:repeat(3,1fr)}}
</style>

<div class="semhist-wrap">
  <div class="semhist-intro">
    <h3>Descripcion</h3>
    <p>El Seminario Permanente de Historia de Chiapas y Centroamerica se trata de un esfuerzo interinstitucional en el que participan estudiosos de la historia (profesores y estudiantes de posgrado) adscritos a las siguientes instancias academicas de San Cristobal de Las Casas, Chiapas:</p>
    <p>- El Centro de Estudios Superiores de Mexico y Centroamerica de la Universidad de Ciencias y Artes de Chiapas (CESMECA-UNICACH).<br>
    - El Centro de investigaciones Multidisciplinarias sobre Chiapas y Centroamerica de la Universidad Nacional Autonoma de Mexico (CIMSUR-UNAM).<br>
    - El Centro de Investigaciones y Estudios Superiores en Antropologia Social (CIESAS) Unidad Sureste.</p>
    <p>Quienes participan en el seminario se reunen una vez al mes desde su creacion, en abril de 2016.</p>
    <p>El objetivo principal del seminario es conocer los campos de investigacion de cada integrante, compartir el analisis de la historia que se estudia en la region, y, a partir del analisis colectivo por pares de los trabajos, incrementar la calidad y el alcance de los aportes de investigacion que redunde en beneficio de la historia regional. Asimismo, se coordinan eventos academicos vinculados con investigaciones sobre historia de Chiapas y de America Central.</p>
    <h3>Coordinadores</h3>
    <p>- Dr. Aaron Pollack (CIESAS Unidad Sureste)<br>
    - Dr. Mario E. Valdez Gordillo (CESMECA)<br>
    - Dr. Gerardo Monterrosa Cubias (CIMSUR)</p>
  </div>

  <div class="semhist-tabs-wrapper" id="<?php echo esc_attr($uid); ?>">
    <div class="semhist-tabs-nav">
      <button class="semhist-tab-btn active" data-tab="agenda">Agenda academica</button>
      <button class="semhist-tab-btn" data-tab="videos">Videos</button>
    </div>

    <div class="semhist-tab-panel active" data-panel="agenda">
      <div class="semhist-gallery" id="<?php echo esc_attr($uid); ?>_gal">
        <?php foreach($agenda as $i=>$img): ?>
        <div class="semhist-gallery-item" data-gallery="<?php echo esc_attr($uid); ?>_gal" data-index="<?php echo $i; ?>">
          <img src="<?php echo esc_url($img['src']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" loading="lazy">
        </div>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="semhist-tab-panel" data-panel="videos">
      <div class="semhist-videos-grid">
        <?php foreach($videos as $v): ?>
        <div class="semhist-video-item" data-video-id="<?php echo esc_attr($v['id']); ?>">
          <div class="semhist-video-thumb">
            <img src="https://i.ytimg.com/vi/<?php echo esc_attr($v['id']); ?>/hqdefault.jpg" alt="<?php echo esc_attr($v['title']); ?>" loading="lazy">
            <div class="semhist-video-play"><svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21"/></svg></div>
          </div>
          <div class="semhist-video-title"><?php echo esc_html($v['title']); ?></div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<div class="semhist-modal-overlay" id="<?php echo esc_attr($uid); ?>_img_modal">
  <button class="semhist-modal-prev" id="<?php echo esc_attr($uid); ?>_prev">&#8249;</button>
  <div class="semhist-modal-inner">
    <button class="semhist-modal-close" id="<?php echo esc_attr($uid); ?>_img_close">&times;</button>
    <img src="" alt="" id="<?php echo esc_attr($uid); ?>_img_display">
  </div>
  <button class="semhist-modal-next" id="<?php echo esc_attr($uid); ?>_next">&#8250;</button>
</div>

<div class="semhist-modal-overlay" id="<?php echo esc_attr($uid); ?>_vid_modal">
  <div class="semhist-modal-inner">
    <button class="semhist-modal-close" id="<?php echo esc_attr($uid); ?>_vid_close">&times;</button>
    <iframe id="<?php echo esc_attr($uid); ?>_vid_frame" src="" allowfullscreen allow="autoplay; encrypted-media"></iframe>
  </div>
</div>

<script>
(function(){
  var uid=<?php echo json_encode($uid); ?>;
  document.querySelectorAll('#'+uid+' .semhist-tab-btn').forEach(function(btn){
    btn.addEventListener('click',function(){
      document.querySelectorAll('#'+uid+' .semhist-tab-btn').forEach(function(b){b.classList.remove('active')});
      document.querySelectorAll('#'+uid+' .semhist-tab-panel').forEach(function(p){p.classList.remove('active')});
      btn.classList.add('active');
      document.querySelector('#'+uid+' [data-panel="'+btn.getAttribute('data-tab')+'"]').classList.add('active');
    });
  });
  var imgModal=document.getElementById(uid+'_img_modal');
  var imgDisplay=document.getElementById(uid+'_img_display');
  var currentGallery=[],currentIndex=0;
  document.querySelectorAll('#'+uid+' .semhist-gallery-item').forEach(function(item){
    item.addEventListener('click',function(){
      var galId=item.getAttribute('data-gallery');
      currentIndex=parseInt(item.getAttribute('data-index'));
      currentGallery=Array.from(document.querySelectorAll('[data-gallery="'+galId+'"] img')).map(function(i){return{src:i.src,alt:i.alt}});
      imgDisplay.src=currentGallery[currentIndex].src;
      imgDisplay.alt=currentGallery[currentIndex].alt;
      imgModal.classList.add('open');
      document.getElementById(uid+'_prev').style.display=currentGallery.length>1?'':'none';
      document.getElementById(uid+'_next').style.display=currentGallery.length>1?'':'none';
    });
  });
  document.getElementById(uid+'_img_close').addEventListener('click',function(){imgModal.classList.remove('open')});
  imgModal.addEventListener('click',function(e){if(e.target===imgModal)imgModal.classList.remove('open')});
  document.getElementById(uid+'_prev').addEventListener('click',function(){currentIndex=(currentIndex-1+currentGallery.length)%currentGallery.length;imgDisplay.src=currentGallery[currentIndex].src;imgDisplay.alt=currentGallery[currentIndex].alt});
  document.getElementById(uid+'_next').addEventListener('click',function(){currentIndex=(currentIndex+1)%currentGallery.length;imgDisplay.src=currentGallery[currentIndex].src;imgDisplay.alt=currentGallery[currentIndex].alt});
  var vidModal=document.getElementById(uid+'_vid_modal');
  var vidFrame=document.getElementById(uid+'_vid_frame');
  document.querySelectorAll('#'+uid+' .semhist-video-item').forEach(function(item){
    item.addEventListener('click',function(){
      vidFrame.src='https://www.youtube-nocookie.com/embed/'+item.getAttribute('data-video-id')+'?autoplay=1&rel=0';
      vidModal.classList.add('open');
    });
  });
  document.getElementById(uid+'_vid_close').addEventListener('click',function(){vidModal.classList.remove('open');vidFrame.src=''});
  vidModal.addEventListener('click',function(e){if(e.target===vidModal){vidModal.classList.remove('open');vidFrame.src=''}});
  document.addEventListener('keydown',function(e){if(e.key==='Escape'){imgModal.classList.remove('open');vidModal.classList.remove('open');vidFrame.src=''}});
})();
</script>
<?php
    return ob_get_clean();
}
add_shortcode('seminario_historia_page','seminario_historia_shortcode');
