<?php
function catedra_mercedes_shortcode() {
    $agenda = [
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2018/00/CatMercedes20181.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2018/00/CatMercedes20182.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2018/00/CatMercedes20183.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2018/00/CatMercedes20184.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2018/00/CatMercedes20185.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2019/10/21/Propuesta_Conferencia_Aida_Hern%C3%A1ndez.png'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2019/00/Ciclo_de_conferencias_Magistrales.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Raquel_Gutirrez.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2019/00/Foro_el_teatro_popular.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2019/00/mujeres-en-defensa-de-la-tierra.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2020/02/06/JORNADA_Semi%C3%B3ticas_Corporales-02.png'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2020/10/08/Capitalismo_gore_y_transfeminismos-2020.png'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/actualizacion_2025/catedra_mercedes_olivera/Conv_1.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/actualizacion_2025/catedra_mercedes_olivera/Conv_2.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/actualizacion_2025/catedra_mercedes_olivera/ExposicinFotog.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/actualizacion_2025/catedra_mercedes_olivera/Mara_Viveros.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/actualizacion_2025/catedra_mercedes_olivera/Resonando_desde_el_sur.jpg'],
    ];
    $videos = [
        ['id'=>'l6EUPzwXh3U','title'=>'Practicas para cuidar la vida'],
        ['id'=>'1T7LV33AYv8','title'=>'Abriendo brechas, enfrentando muros y avizorando futuros: sentipensar y comunicar los feminismos'],
        ['id'=>'h1Vjo283wV0','title'=>'Flora Tristan, en los inicios del feminismo socialista'],
        ['id'=>'PVi6TOwcWys','title'=>'Bienestar social y genero avances'],
        ['id'=>'7dRa62IAXTo','title'=>'Presentacion del libro Vivir para el Surco'],
        ['id'=>'ksa75OlP4II','title'=>'Presentacion del libro Paxneloliberalia de Jules Falquet'],
        ['id'=>'i-dLFu1LiIw','title'=>'El teatro popular como herramienta y camino'],
        ['id'=>'R05AdaCrRQg','title'=>'Desafios para una economia feminista decolonial: el fundamentalismo neoliberal'],
        ['id'=>'Ls75l4o0sUc','title'=>'Cuba, sus crisis y la resistencia de las mujeres'],
        ['id'=>'8A_eVZockFM','title'=>'Diplomado Repensandonos desde la Economia Feminista Emancipatoria'],
        ['id'=>'rAn7LcZpGrY','title'=>'Los retos de los feminismos descoloniales ante las violencias extremas en Mexico'],
        ['id'=>'bsbNqPCROcc','title'=>'Luchas renovadas de las mujeres en America Latina: Tiempos de rebelion'],
        ['id'=>'XOEucjPl57g','title'=>'Una mirada feminista sobre el imperio global norteamericano'],
    ];
    $uid = 'mercedes_' . uniqid();
    ob_start();
    ?>
<style>
.merc-intro{display:flex;gap:40px;margin-bottom:36px;align-items:flex-start}
.merc-intro-text{flex:2}.merc-intro-img{flex:1;text-align:center}
.merc-intro-img img{max-width:100%;border-radius:6px}
.merc-intro-text h2{font-size:1.5rem;margin-bottom:16px;color:#1a1a2e}
.merc-intro-text h3{font-size:1.1rem;margin:16px 0 6px;color:#1a1a2e}
.merc-intro-text p{font-size:.97rem;line-height:1.7;text-align:justify;color:#333;margin-bottom:10px}
.merc-tabs-nav{display:flex;flex-wrap:wrap;border-bottom:2px solid #ddd;margin-bottom:24px;gap:4px}
.merc-tab-btn{padding:8px 16px;background:#5dade2;border:1px solid #ddd;border-bottom:none;cursor:pointer;font-size:.9rem;color:#fff;border-radius:4px 4px 0 0}
.merc-tab-btn:hover,.merc-tab-btn:focus{background:#5dade2!important;color:#fff!important;text-decoration:none}
.merc-tab-btn.active{background:#3498db!important;color:#fff!important;font-weight:600;border-bottom:2px solid #3498db;margin-bottom:-2px}
.merc-tab-btn.active:hover,.merc-tab-btn.active:focus{background:#3498db!important;color:#fff!important}
.merc-tab-panel{display:none}.merc-tab-panel.active{display:block}
.merc-tabs-wrapper{border:1px solid #e0e0e0!important;border-radius:8px!important;padding:24px!important;box-shadow:0 2px 10px rgba(0,0,0,.06)!important}
.merc-gallery{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:16px;margin-top:8px}
.merc-gallery-item{cursor:pointer;border-radius:6px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.merc-gallery-item img{width:100%;height:220px;object-fit:cover;display:block;transition:transform .2s}
.merc-gallery-item:hover img{transform:scale(1.03)}
.merc-videos-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:20px;margin-top:8px}
.merc-video-item{cursor:pointer;border-radius:8px;overflow:hidden;background:#000;box-shadow:0 2px 8px rgba(0,0,0,.15)}
.merc-video-thumb{position:relative}
.merc-video-thumb img{width:100%;height:160px;object-fit:cover;display:block;opacity:.85}
.merc-video-item:hover .merc-video-thumb img{opacity:1}
.merc-video-play{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:48px;height:48px;background:rgba(255,0,0,.85);border-radius:50%;display:flex;align-items:center;justify-content:center}
.merc-video-play svg{width:20px;height:20px;fill:#fff;margin-left:3px}
.merc-video-title{padding:10px 12px;background:#111;color:#eee;font-size:.8rem;line-height:1.4;min-height:52px}
.merc-modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.88);z-index:99999;align-items:center;justify-content:center}
.merc-modal-overlay.open{display:flex}
.merc-modal-inner{position:relative;max-width:90vw;max-height:90vh}
.merc-modal-inner img{max-width:88vw;max-height:85vh;border-radius:4px;display:block}
.merc-modal-inner iframe{width:80vw;height:45vw;max-height:80vh;border:none;border-radius:4px;display:block}
.merc-modal-close{position:absolute;top:-36px;right:0;background:none;border:none;color:#fff;font-size:2rem;cursor:pointer}
.merc-modal-prev,.merc-modal-next{position:fixed;top:50%;transform:translateY(-50%);background:rgba(255,255,255,.15);border:none;color:#fff;font-size:2rem;padding:12px 18px;cursor:pointer;border-radius:4px;z-index:100000}
.merc-modal-prev{left:16px}.merc-modal-next{right:16px}
@media(max-width:768px){.merc-intro{flex-direction:column}.merc-tab-btn{font-size:.8rem;padding:6px 10px}}
</style>
<div class="merc-intro">
  <div class="merc-intro-text">
    
    <h3>Descripcion</h3>
    <p>La Catedra de Estudios de Genero y Feminismos "Mercedes Olivera" nacio en 2013, en el marco de los Posgrados en Estudios e Intervencion Feministas, con el proposito de articular la vida academica e intelectual universitaria con la sociedad civil y las organizaciones sociales de Chiapas, la region sur-sureste de Mexico, Centroamerica y el Caribe.</p>
    <p>Desde 2022, la Catedra se ha enfocado en generar espacios de dialogo que fortalezcan los vinculos con los feminismos de los Sures Globales. Con el fin de continuar este giro epistemico, hemos invitado a colegas y referentes de estos feminismos para enriquecer la articulacion teorico-politica que impulsa nuestro trabajo.</p>
    <p>En 2025 contamos con la presencia de la Dra. Mara Viveros Vigoya, destacada pensadora feminista colombiana, quien visitara el Centro de Estudios Superiores de Mexico y Centroamerica (CESMECA). Su participacion nos permitira reflexionar colectivamente sobre la comprension del Sur Global y el lugar de la interseccionalidad dentro de los feminismos contemporaneos.</p>
    <p>El programa lleva por nombre "Los Feminismos del Sur con...", un titulo pensado para construir un marco de dialogos epistemicos desde la Catedra.</p>
    <h3>Coordinadora</h3>
    <p>Dra. Delmy Tania Cruz Hernandez</p>
    <h3>Retribucion Social</h3>
    <p>Larissa Fuentes Machorro</p>
  </div>
  <div class="merc-intro-img">
    <img src="/wp-content/uploads/cesmeca-legacy/actualizacion_2025/catedra_mercedes_olivera/LOGO.png" alt="Catedra Mercedes Olivera">
  </div>
</div>
<div class="merc-tabs-wrapper" id="<?php echo esc_attr($uid); ?>">
  <div class="merc-tabs-nav">
    <button class="merc-tab-btn active" data-tab="agenda">Agenda academica</button>
    <button class="merc-tab-btn" data-tab="videos">Videos</button>
  </div>
  <div class="merc-tab-panel active" data-panel="agenda">
    <div class="merc-gallery" id="<?php echo esc_attr($uid); ?>_gal">
      <?php foreach($agenda as $i=>$img): ?>
      <div class="merc-gallery-item" data-gallery="<?php echo esc_attr($uid); ?>_gal" data-index="<?php echo $i; ?>">
        <img src="<?php echo esc_url($img['src']); ?>" alt="" loading="lazy">
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="merc-tab-panel" data-panel="videos">
    <div class="merc-videos-grid">
      <?php foreach($videos as $v): ?>
      <div class="merc-video-item" data-video-id="<?php echo esc_attr($v['id']); ?>">
        <div class="merc-video-thumb">
          <img src="https://i.ytimg.com/vi/<?php echo esc_attr($v['id']); ?>/hqdefault.jpg" alt="<?php echo esc_attr($v['title']); ?>" loading="lazy">
          <div class="merc-video-play"><svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21"/></svg></div>
        </div>
        <div class="merc-video-title"><?php echo esc_html($v['title']); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<div class="merc-modal-overlay" id="<?php echo esc_attr($uid); ?>_img_modal">
  <button class="merc-modal-prev" id="<?php echo esc_attr($uid); ?>_prev">&#8249;</button>
  <div class="merc-modal-inner">
    <button class="merc-modal-close" id="<?php echo esc_attr($uid); ?>_img_close">&times;</button>
    <img src="" alt="" id="<?php echo esc_attr($uid); ?>_img_display">
  </div>
  <button class="merc-modal-next" id="<?php echo esc_attr($uid); ?>_next">&#8250;</button>
</div>
<div class="merc-modal-overlay" id="<?php echo esc_attr($uid); ?>_vid_modal">
  <div class="merc-modal-inner">
    <button class="merc-modal-close" id="<?php echo esc_attr($uid); ?>_vid_close">&times;</button>
    <iframe id="<?php echo esc_attr($uid); ?>_vid_frame" src="" allowfullscreen allow="autoplay; encrypted-media"></iframe>
  </div>
</div>
<script>
(function(){
  var uid=<?php echo json_encode($uid); ?>;
  document.querySelectorAll('#'+uid+' .merc-tab-btn').forEach(function(btn){
    btn.addEventListener('click',function(){
      document.querySelectorAll('#'+uid+' .merc-tab-btn').forEach(function(b){b.classList.remove('active')});
      document.querySelectorAll('#'+uid+' .merc-tab-panel').forEach(function(p){p.classList.remove('active')});
      btn.classList.add('active');
      document.querySelector('#'+uid+' [data-panel="'+btn.getAttribute('data-tab')+'"]').classList.add('active');
    });
  });
  var imgModal=document.getElementById(uid+'_img_modal');
  var imgDisplay=document.getElementById(uid+'_img_display');
  var cur=[],idx=0;
  document.querySelectorAll('#'+uid+' .merc-gallery-item').forEach(function(item){
    item.addEventListener('click',function(){
      idx=parseInt(item.getAttribute('data-index'));
      cur=Array.from(document.querySelectorAll('[data-gallery="'+item.getAttribute('data-gallery')+'"] img')).map(function(i){return i.src});
      imgDisplay.src=cur[idx];imgModal.classList.add('open');
      document.getElementById(uid+'_prev').style.display=cur.length>1?'':'none';
      document.getElementById(uid+'_next').style.display=cur.length>1?'':'none';
    });
  });
  document.getElementById(uid+'_img_close').addEventListener('click',function(){imgModal.classList.remove('open')});
  imgModal.addEventListener('click',function(e){if(e.target===imgModal)imgModal.classList.remove('open')});
  document.getElementById(uid+'_prev').addEventListener('click',function(){idx=(idx-1+cur.length)%cur.length;imgDisplay.src=cur[idx]});
  document.getElementById(uid+'_next').addEventListener('click',function(){idx=(idx+1)%cur.length;imgDisplay.src=cur[idx]});
  var vidModal=document.getElementById(uid+'_vid_modal');
  var vidFrame=document.getElementById(uid+'_vid_frame');
  document.querySelectorAll('#'+uid+' .merc-video-item').forEach(function(item){
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
add_shortcode('catedra_mercedes_page','catedra_mercedes_shortcode');
