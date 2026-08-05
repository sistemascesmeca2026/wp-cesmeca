<?php
function lacem_page_shortcode() {
    $eventos = [];
    $joomla_ids = [456, 455, 443];
    foreach ($joomla_ids as $jid) {
        $posts = get_posts(['post_type'=>'post','meta_key'=>'_fgj2wp_old_id','meta_value'=>$jid,'numberposts'=>1]);
        if (!empty($posts)) $eventos[] = $posts[0];
    }
    $portadas_lacem = [456=>'/wp-content/uploads/cesmeca-legacy/LACEM/2.png',455=>'/wp-content/uploads/cesmeca-legacy/LACEM/3.png',443=>'/wp-content/uploads/cesmeca-legacy/LACEM/peten.png'];
    $actividades_2023 = [
        ['src'=>'/wp-content/uploads/cesmeca-legacy/LACEM/memoria.jpg','alt'=>'Memoria y resistencia cartel'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/LACEM/cartografia.jpg','alt'=>'Exposicion fotografica cartel'],
    ];
    $videos_2023 = [
        ['id'=>'jAuaEr7w1c0','title'=>'Exposicion fotografica: Cartografia, Memoria e Historia'],
    ];
    $videos_2021 = [
        ['id'=>'UrCuJnzToNY','title'=>'Laboratorio de Cartografias y Elaboracion de Mapas (LACEM)'],
        ['id'=>'X0GieF9QBDw','title'=>'Los enigmas de los codices adivinatorios: manuscritos Borgia y Vaticano B'],
        ['id'=>'zZpdr6MhsJ8','title'=>'Conejo, ombligo y sueno: el espectaculo y la risa entre los nahuas prehispanicos'],
        ['id'=>'fKOR_7zaOZY','title'=>'Foro Mapas para armar: de cartillas, manuales y guias de cartografia participativa'],
        ['id'=>'_O0nWJGQvt4','title'=>'El Salvador en datos: uso y disponibilidad de fuentes geograficas y estadisticas (1)'],
        ['id'=>'kE8vWPmQapo','title'=>'El Salvador en datos: uso y disponibilidad de fuentes geograficas y estadisticas (2)'],
        ['id'=>'l8XxyJSpoQA','title'=>'El Salvador en datos: uso y disponibilidad de fuentes geograficas y estadisticas (3)'],
        ['id'=>'ri12Kv5OU90','title'=>'Foro: Sistemas de informacion geografica historicos: reinterpretar el pasado con mapas del presente'],
    ];
    $actividades_2021 = [
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Aztecas_en_la_nube_de_puntos_.jpg','alt'=>'Aztecas en la nube de puntos'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2019/10/07/ciudad-de-vacaciones.png','alt'=>'Ciudad de Vacaciones'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Hector_Brignoli.jpg','alt'=>'Conferencia Hector Brignoli'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2021/01/22/Sesion_Ceieg_cartel.png','alt'=>'Sesion CEIEG'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2020/01/17/Transformaciones_territoriales_en_Chiapas.png','alt'=>'Transformaciones territoriales en Chiapas'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2021/04/27/Foro_Atlas_de_Genero.png','alt'=>'Foro Atlas de Genero'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2020/09/11/Cartel_interpretaciones_cartograficas_.png','alt'=>'Curso Interpretaciones cartograficas'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2020/00/Curso_SIG_CienciasS.png','alt'=>'Curso SIG para Ciencias Sociales'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2020/11/10/Foro_Mapas_para_armar_final.png','alt'=>'Foro Mapas para armar'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2021/03/10/Cartel_Guatemala_en_Datos.png','alt'=>'Guatemala en datos'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2021/09/10/Sesiones-INEGI-LACEM21.png','alt'=>'Miercoles con el INEGI'],
    ];
    $uid = 'lacem_' . uniqid();
    ob_start();
    ?>
<style>
.lacem-intro{display:flex;gap:40px;margin-bottom:40px;align-items:flex-start}
.lacem-intro-text{flex:2}.lacem-intro-img{flex:1;text-align:center}
.lacem-intro-img img{max-width:100%;border-radius:6px}
.lacem-intro-text h1{font-size:2.5rem;margin-bottom:16px;color:#1a1a2e}
.lacem-intro-text h3{font-size:1.1rem;margin:20px 0 8px;color:#1a1a2e}
.lacem-intro-text p,.lacem-intro-text li{font-size:.97rem;line-height:1.7;text-align:justify;color:#333}
.lacem-intro-text ul{padding-left:20px}
.lacem-contacto a{color:#2563eb}
.lacem-tabs-nav{display:flex;flex-wrap:wrap;border-bottom:2px solid #ddd;margin-bottom:24px;gap:4px}
.lacem-tab-btn{padding:8px 16px;background:#5dade2;border:1px solid #ddd;border-bottom:none;cursor:pointer;font-size:.9rem;color:#fff;border-radius:4px 4px 0 0}
.lacem-tab-btn.active{background:#3498db;color:#fff;font-weight:600;border-bottom:2px solid #3498db;margin-bottom:-2px}
.lacem-tab-btn:hover,.lacem-tab-btn:focus{background:#5dade2!important;color:#fff!important;text-decoration:none}
.lacem-tab-btn.active:hover,.lacem-tab-btn.active:focus{background:#3498db!important;color:#fff!important}
.lacem-tab-panel{display:none}.lacem-tab-panel.active{display:block}
.lacem-eventos-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:28px}
.lacem-tabs-wrapper{border:1px solid #e0e0e0;border-radius:8px;padding:24px;box-shadow:0 2px 10px rgba(0,0,0,.06)}
.lacem-evento-card{background:#fff;border:1px solid #e5e5e5;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.06);transition:transform .2s,box-shadow .2s}
.lacem-evento-card:hover{transform:translateY(-4px);box-shadow:0 6px 20px rgba(0,0,0,.12)}
.lacem-evento-card img{width:100%;height:200px;object-fit:cover;display:block}
.lacem-evento-card-body{padding:16px}
.lacem-evento-card-body h4{font-size:.95rem;font-weight:700;text-transform:uppercase;margin:0 0 10px;color:#1a1a2e;line-height:1.4}
.lacem-evento-card-body p{font-size:.88rem;color:#555;line-height:1.6;margin-bottom:14px}
.lacem-evento-card-body a.btn-vermas{display:inline-block;padding:7px 16px;background:#1a6fa8;color:#fff;border-radius:4px;font-size:.85rem;text-decoration:none}
.lacem-gallery{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:16px;margin-top:8px}
.lacem-gallery-item{cursor:pointer;border-radius:6px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.lacem-gallery-item img{width:100%;height:220px;object-fit:cover;display:block;border-radius:6px;transition:transform .2s}
.lacem-gallery-item:hover img{transform:scale(1.03)}
.lacem-videos-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:20px;margin-top:8px}
.lacem-video-item{cursor:pointer;border-radius:8px;overflow:hidden;background:#000;box-shadow:0 2px 8px rgba(0,0,0,.15)}
.lacem-video-thumb{position:relative}
.lacem-video-thumb img{width:100%;height:160px;object-fit:cover;display:block;opacity:.85}
.lacem-video-item:hover .lacem-video-thumb img{opacity:1}
.lacem-video-play{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:48px;height:48px;background:rgba(255,0,0,.85);border-radius:50%;display:flex;align-items:center;justify-content:center}
.lacem-video-play svg{width:20px;height:20px;fill:#fff;margin-left:3px}
.lacem-video-title{padding:10px 12px;background:#111;color:#eee;font-size:.8rem;line-height:1.4;min-height:52px}
.lacem-modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.88);z-index:99999;align-items:center;justify-content:center}
.lacem-modal-overlay.open{display:flex}
.lacem-modal-inner{position:relative;max-width:90vw;max-height:90vh}
.lacem-modal-inner img{max-width:88vw;max-height:85vh;border-radius:4px;display:block}
.lacem-modal-inner iframe{width:80vw;height:45vw;max-height:80vh;border:none;border-radius:4px;display:block}
.lacem-modal-close{position:absolute;top:-36px;right:0;background:none;border:none;color:#fff;font-size:2rem;cursor:pointer}
.lacem-modal-prev,.lacem-modal-next{position:fixed;top:50%;transform:translateY(-50%);background:rgba(255,255,255,.15);border:none;color:#fff;font-size:2rem;padding:12px 18px;cursor:pointer;border-radius:4px;z-index:100000}
.lacem-modal-prev{left:16px}.lacem-modal-next{right:16px}
@media(max-width:768px){.lacem-intro{flex-direction:column}.lacem-eventos-grid{grid-template-columns:1fr}.lacem-tab-btn{font-size:.8rem;padding:6px 10px}}
</style>
<div class="lacem-intro">
  <div class="lacem-intro-text">
    <h1>Laboratorio de Cartografia y Elaboracion de Mapas (LACEM)</h1>
    <h3>Presentacion</h3>
    <p>El LACEM se establecio en 2015 con el objetivo principal de dotar a los proyectos de investigacion desarrollados en el CESMECA, del entorno de trabajo y las herramientas que les posibiliten desplegar sus tematicas de manera espacial por medio de representaciones cartograficas de alta calidad. Ademas de ser considerado como un espacio de creacion, edicion, acopio y difusion de mapas digitales, como fisicos, especialmente de tematicas relacionadas con las ciencias sociales y humanidades.</p>
    <p>De este modo, en la linea de investigacion aplicada: <strong>Perspectivas globales en la historia de Chiapas, Centroamerica y el Caribe, epocas moderna y contemporanea</strong>, buscamos reorganizar las actividades y funciones del laboratorio, con el fin de mantener los objetivos de este espacio y potenciar el trabajo colaborativo con estudiantes, investigadores, centros publicos CONACyT e institucionales de la UNICACH.</p>
    <h3>Objetivos</h3>
    <ul>
      <li>Desarrollar el LACEM como un proyecto institucional del CESMECA que atienda la demanda del uso de tecnologias para el manejo y proyeccion de informacion geografica.</li>
      <li>Buscar la interdisciplinariedad del LACEM en especial con la antropologia, la historia, la sociologia y los estudios de genero.</li>
      <li>Gestionar y proponer posibles soluciones a las problematicas sociales de Chiapas y Centroamerica a partir del uso de las herramientas SIG.</li>
      <li>Ofrecer herramientas para mejorar los analisis sociales, economicos, culturales y de genero desde una perspectiva historica y contemporanea.</li>
      <li>Configurar un espacio de formacion y practica para estudiantes, investigadores y el publico en general.</li>
      <li>Contribuir a la difusion de las investigaciones de la linea de investigacion y de los analisis creados por el CESMECA.</li>
    </ul>
    <h3>Coordinadores</h3>
    <p>Dr. Mario Eduardo Valdez Gordillo</p>
    <p>Dr. Armando Mendez Zarate</p>
    <h3>Contacto</h3>
    <p><a href="mailto:lacem@unicach.mx">lacem@unicach.mx</a></p>
  </div>
  <div class="lacem-intro-img">
    <img src="/wp-content/uploads/cesmeca-legacy/2019/08/22/lacem.png" alt="LACEM">
  </div>
</div>
<div class="lacem-tabs-wrapper" id="<?php echo esc_attr($uid); ?>">
  <div class="lacem-tabs-nav">
    <button class="lacem-tab-btn active" data-tab="eventos">Eventos</button>
    <button class="lacem-tab-btn" data-tab="act2023">Actividades 2022-2023</button>
    <button class="lacem-tab-btn" data-tab="vid2023">Videos 2022-2023</button>
    <button class="lacem-tab-btn" data-tab="vid2021">Videos 2015-2021</button>
    <button class="lacem-tab-btn" data-tab="act2021">Actividades LACEM 2015-2021</button>
  </div>
  <div class="lacem-tab-panel active" data-panel="eventos">
    <div class="lacem-eventos-grid">
      <?php foreach($eventos as $post):
        $jid=get_post_meta($post->ID,'_fgj2wp_old_id',true);
        $thumb=get_the_post_thumbnail_url($post->ID,'medium');
        if(!$thumb && isset($portadas_lacem[(int)$jid])) $thumb=$portadas_lacem[(int)$jid];
        $excerpt=wp_trim_words(get_the_excerpt($post),28,'...');
        $url=get_permalink($post->ID);
      ?>
      <div class="lacem-evento-card">
        <?php if($thumb): ?><img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($post->post_title); ?>"><?php endif; ?>
        <div class="lacem-evento-card-body">
          <h4><?php echo esc_html($post->post_title); ?></h4>
          <p><?php echo esc_html($excerpt); ?></p>
          <a class="btn-vermas" href="<?php echo esc_url($url); ?>">Ver mas...</a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="lacem-tab-panel" data-panel="act2023">
    <div class="lacem-gallery" id="<?php echo esc_attr($uid); ?>_gal2023">
      <?php foreach($actividades_2023 as $i=>$img): ?>
      <div class="lacem-gallery-item" data-gallery="<?php echo esc_attr($uid); ?>_gal2023" data-index="<?php echo $i; ?>">
        <img src="<?php echo esc_url($img['src']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" loading="lazy">
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="lacem-tab-panel" data-panel="vid2023">
    <div class="lacem-videos-grid">
      <?php foreach($videos_2023 as $v): ?>
      <div class="lacem-video-item" data-video-id="<?php echo esc_attr($v['id']); ?>">
        <div class="lacem-video-thumb">
          <img src="https://i.ytimg.com/vi/<?php echo esc_attr($v['id']); ?>/hqdefault.jpg" alt="<?php echo esc_attr($v['title']); ?>" loading="lazy">
          <div class="lacem-video-play"><svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21"/></svg></div>
        </div>
        <div class="lacem-video-title"><?php echo esc_html($v['title']); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="lacem-tab-panel" data-panel="vid2021">
    <div class="lacem-videos-grid">
      <?php foreach($videos_2021 as $v): ?>
      <div class="lacem-video-item" data-video-id="<?php echo esc_attr($v['id']); ?>">
        <div class="lacem-video-thumb">
          <img src="https://i.ytimg.com/vi/<?php echo esc_attr($v['id']); ?>/hqdefault.jpg" alt="<?php echo esc_attr($v['title']); ?>" loading="lazy">
          <div class="lacem-video-play"><svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21"/></svg></div>
        </div>
        <div class="lacem-video-title"><?php echo esc_html($v['title']); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="lacem-tab-panel" data-panel="act2021">
    <div class="lacem-gallery" id="<?php echo esc_attr($uid); ?>_gal2021">
      <?php foreach($actividades_2021 as $i=>$img): ?>
      <div class="lacem-gallery-item" data-gallery="<?php echo esc_attr($uid); ?>_gal2021" data-index="<?php echo $i; ?>">
        <img src="<?php echo esc_url($img['src']); ?>" alt="<?php echo esc_attr($img['alt']); ?>" loading="lazy">
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<div class="lacem-modal-overlay" id="<?php echo esc_attr($uid); ?>_img_modal">
  <button class="lacem-modal-prev" id="<?php echo esc_attr($uid); ?>_prev">&#8249;</button>
  <div class="lacem-modal-inner">
    <button class="lacem-modal-close" id="<?php echo esc_attr($uid); ?>_img_close">&times;</button>
    <img src="" alt="" id="<?php echo esc_attr($uid); ?>_img_display">
  </div>
  <button class="lacem-modal-next" id="<?php echo esc_attr($uid); ?>_next">&#8250;</button>
</div>
<div class="lacem-modal-overlay" id="<?php echo esc_attr($uid); ?>_vid_modal">
  <div class="lacem-modal-inner">
    <button class="lacem-modal-close" id="<?php echo esc_attr($uid); ?>_vid_close">&times;</button>
    <iframe id="<?php echo esc_attr($uid); ?>_vid_frame" src="" allowfullscreen allow="autoplay; encrypted-media"></iframe>
  </div>
</div>
<script>
(function(){
  var uid=<?php echo json_encode($uid); ?>;
  document.querySelectorAll('#'+uid+' .lacem-tab-btn').forEach(function(btn){
    btn.addEventListener('click',function(){
      document.querySelectorAll('#'+uid+' .lacem-tab-btn').forEach(function(b){b.classList.remove('active')});
      document.querySelectorAll('#'+uid+' .lacem-tab-panel').forEach(function(p){p.classList.remove('active')});
      btn.classList.add('active');
      document.querySelector('#'+uid+' [data-panel="'+btn.getAttribute('data-tab')+'"]').classList.add('active');
    });
  });
  var imgModal=document.getElementById(uid+'_img_modal');
  var imgDisplay=document.getElementById(uid+'_img_display');
  var currentGallery=[],currentIndex=0;
  document.querySelectorAll('#'+uid+' .lacem-gallery-item').forEach(function(item){
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
  document.querySelectorAll('#'+uid+' .lacem-video-item').forEach(function(item){
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
add_shortcode('lacem_page','lacem_page_shortcode');
