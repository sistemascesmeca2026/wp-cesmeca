<?php
function catedra_marti_shortcode() {
    $agenda = [
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2014/00/CAtMart20141.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2017/00/CAtMart20171.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2018/00/CAtMart20181.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2018/00/CAtMart20183.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Balam_Rodrigo.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Eckart_Boege.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Enrique_Saforcada.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Fabiola_Escarzaga.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Leticia_Salomn.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Reviviendo_los_sonidos_mayas.png'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2019/00/memorias-no-antropocentricas-guerra-en-colombia.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Javier_Vidal_y_Roque_Moreno.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2020/08/21/SergioRam-CatedraMart.png'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2020/10/08/Capitalismo_gore_y_transfeminismos-2020.png'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Hector_Brignoli.jpg'],
        ['src'=>'/wp-content/uploads/cesmeca-legacy/2020/12/06/Pablo_pachakuti.png'],
    ];
    $videos = [
        ['id'=>'lL4eo4I6bx0','title'=>'Horizontes comunitario-populares en tension. Estado Plurinacional en Bolivia'],
        ['id'=>'93rtxwLz9f4','title'=>'El espacio centroamericano, del siglo XVI al XXI. Transformaciones y utopias'],
        ['id'=>'Ghtpy8fO3As','title'=>'Pueblos originarios y patrimonio biocultural: claves para entender el contexto ambiental actual'],
        ['id'=>'iegAIbA-3H0','title'=>'(In)Gobernabilidad democratica y crisis social en Honduras y Centroamerica'],
        ['id'=>'txTbuh_kj3c','title'=>'El paradigma multidisciplinar de la salud comunitaria en America Latina'],
        ['id'=>'RdtuzpmAuAo','title'=>'La comunidad indigena insurgente. Peru, Bolivia y Mexico (1980-2000)'],
        ['id'=>'62dDU2IjejA','title'=>'Conversatorio con Jaime Preciado Coronado'],
        ['id'=>'yPYCz93IykA','title'=>'El legado politico e intelectual de Frantz Fanon'],
        ['id'=>'x2KkSYReHL4','title'=>'El Acontecimiento del 1 de julio: Mexico hacia una Cuarta Transformacion?'],
        ['id'=>'8814fak8eVo','title'=>'Territorialidades indigenas. Experiencias de resistencia en America Latina/Abya Yala'],
        ['id'=>'QBH5pzwDbeU','title'=>'Configuraciones culturales y teoria de la hegemonia en America Latina'],
        ['id'=>'8NptIcNtETg','title'=>'El quiebre del horizonte de la integracion autonoma en America Latina y el Caribe'],
        ['id'=>'waZJlzJygxM','title'=>'Conversatorio Bolivia en la coyuntura politica contemporanea'],
        ['id'=>'xjU0Jw7thsU','title'=>'Conversatorio con Sergio Ramirez: El acto de la escritura en Centroamerica'],
    ];
    $uid = 'marti_' . uniqid();
    ob_start();
    ?>
<style>
.marti-intro{display:flex;gap:40px;margin-bottom:36px;align-items:flex-start}
.marti-intro-text{flex:2}.marti-intro-img{flex:1;text-align:center}
.marti-intro-img img{max-width:100%;border-radius:6px}
.marti-intro-text h2{font-size:1.5rem;margin-bottom:16px;color:#1a1a2e}
.marti-intro-text h3{font-size:1.1rem;margin:16px 0 6px;color:#1a1a2e}
.marti-intro-text p{font-size:.97rem;line-height:1.7;text-align:justify;color:#333;margin-bottom:10px}
.marti-tabs-nav{display:flex;flex-wrap:wrap;border-bottom:2px solid #ddd;margin-bottom:24px;gap:4px}
.marti-tab-btn{padding:8px 16px;background:#5dade2;border:1px solid #ddd;border-bottom:none;cursor:pointer;font-size:.9rem;color:#fff;border-radius:4px 4px 0 0}
.marti-tab-btn:hover,.marti-tab-btn:focus{background:#5dade2!important;color:#fff!important;text-decoration:none}
.marti-tab-btn.active{background:#3498db!important;color:#fff!important;font-weight:600;border-bottom:2px solid #3498db;margin-bottom:-2px}
.marti-tab-btn.active:hover,.marti-tab-btn.active:focus{background:#3498db!important;color:#fff!important}
.marti-tab-panel{display:none}.marti-tab-panel.active{display:block}
.marti-tabs-wrapper{border:1px solid #e0e0e0!important;border-radius:8px!important;padding:24px!important;box-shadow:0 2px 10px rgba(0,0,0,.06)!important}
.marti-gallery{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:16px;margin-top:8px}
.marti-gallery-item{cursor:pointer;border-radius:6px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.marti-gallery-item img{width:100%;height:220px;object-fit:cover;display:block;transition:transform .2s}
.marti-gallery-item:hover img{transform:scale(1.03)}
.marti-videos-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(240px,1fr));gap:20px;margin-top:8px}
.marti-video-item{cursor:pointer;border-radius:8px;overflow:hidden;background:#000;box-shadow:0 2px 8px rgba(0,0,0,.15)}
.marti-video-thumb{position:relative}
.marti-video-thumb img{width:100%;height:160px;object-fit:cover;display:block;opacity:.85}
.marti-video-item:hover .marti-video-thumb img{opacity:1}
.marti-video-play{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:48px;height:48px;background:rgba(255,0,0,.85);border-radius:50%;display:flex;align-items:center;justify-content:center}
.marti-video-play svg{width:20px;height:20px;fill:#fff;margin-left:3px}
.marti-video-title{padding:10px 12px;background:#111;color:#eee;font-size:.8rem;line-height:1.4;min-height:52px}
.marti-modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.88);z-index:99999;align-items:center;justify-content:center}
.marti-modal-overlay.open{display:flex}
.marti-modal-inner{position:relative;max-width:90vw;max-height:90vh}
.marti-modal-inner img{max-width:88vw;max-height:85vh;border-radius:4px;display:block}
.marti-modal-inner iframe{width:80vw;height:45vw;max-height:80vh;border:none;border-radius:4px;display:block}
.marti-modal-close{position:absolute;top:-36px;right:0;background:none;border:none;color:#fff;font-size:2rem;cursor:pointer}
.marti-modal-prev,.marti-modal-next{position:fixed;top:50%;transform:translateY(-50%);background:rgba(255,255,255,.15);border:none;color:#fff;font-size:2rem;padding:12px 18px;cursor:pointer;border-radius:4px;z-index:100000}
.marti-modal-prev{left:16px}.marti-modal-next{right:16px}
@media(max-width:768px){.marti-intro{flex-direction:column}.marti-tab-btn{font-size:.8rem;padding:6px 10px}}
</style>
<div class="marti-intro">
  <div class="marti-intro-text">
    
    <h3>Descripcion</h3>
    <p>En enero de 2014 el CESMECA impulso la creacion de la Catedra de Pensamiento Social Jose Marti, cuyo objetivo responde al compromiso universitario de fortalecer la vinculacion y extension de los conocimientos, saberes y reflexiones que derivan del pensamiento social, politico, cultural y humanistico de Nuestra America-Abya Yala.</p>
    <p>El CESMECA, a traves de esta Catedra de Pensamiento Social y situado desde Centroamerica, el Caribe y el area sur sureste de Mexico, mira, interpela y reflexiona desde una mirada historica la contemporaneidad de los problemas sociales que aquejan a la region, ademas de que reconoce criticamente las virtudes de los pensamientos latinoamericanos y caribenos que han tejido la configuracion cultural de nuestros pueblos.</p>
    <p>Para ello, impulsa conferencias magistrales, seminarios especializados, coloquios y talleres con destacados intelectuales, academicas y academicos de la region.</p>
    <h3>Coordinador e integrantes</h3>
    <p>Consejo Honorifico:<br>
    Gilberto Valdes (Instituto de Filosofia de La Habana y GALFISA, Cuba)<br>
    Jaime Preciado Coronado (Universidad de Guadalajara, Mexico)<br>
    Luciano Concheiro (Universidad Autonoma de Mexico-Xochimilco, Mexico)<br>
    Sergio Ramirez (Narrador, ensayista, periodista, politico y abogado nicaraguense)</p>
  </div>
  <div class="marti-intro-img">
    <img src="/wp-content/uploads/cesmeca-legacy/catedras_laboratorios/Ctedr_Jos_Mart_Negro_Mesa_de_trabajo_1.png" alt="Catedra Jose Marti">
  </div>
</div>
<div class="marti-tabs-wrapper" id="<?php echo esc_attr($uid); ?>">
  <div class="marti-tabs-nav">
    <button class="marti-tab-btn active" data-tab="agenda">Agenda academica</button>
    <button class="marti-tab-btn" data-tab="videos">Videos</button>
  </div>
  <div class="marti-tab-panel active" data-panel="agenda">
    <div class="marti-gallery" id="<?php echo esc_attr($uid); ?>_gal">
      <?php foreach($agenda as $i=>$img): ?>
      <div class="marti-gallery-item" data-gallery="<?php echo esc_attr($uid); ?>_gal" data-index="<?php echo $i; ?>">
        <img src="<?php echo esc_url($img['src']); ?>" alt="" loading="lazy">
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <div class="marti-tab-panel" data-panel="videos">
    <div class="marti-videos-grid">
      <?php foreach($videos as $v): ?>
      <div class="marti-video-item" data-video-id="<?php echo esc_attr($v['id']); ?>">
        <div class="marti-video-thumb">
          <img src="https://i.ytimg.com/vi/<?php echo esc_attr($v['id']); ?>/hqdefault.jpg" alt="<?php echo esc_attr($v['title']); ?>" loading="lazy">
          <div class="marti-video-play"><svg viewBox="0 0 24 24"><polygon points="5,3 19,12 5,21"/></svg></div>
        </div>
        <div class="marti-video-title"><?php echo esc_html($v['title']); ?></div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</div>
<div class="marti-modal-overlay" id="<?php echo esc_attr($uid); ?>_img_modal">
  <button class="marti-modal-prev" id="<?php echo esc_attr($uid); ?>_prev">&#8249;</button>
  <div class="marti-modal-inner">
    <button class="marti-modal-close" id="<?php echo esc_attr($uid); ?>_img_close">&times;</button>
    <img src="" alt="" id="<?php echo esc_attr($uid); ?>_img_display">
  </div>
  <button class="marti-modal-next" id="<?php echo esc_attr($uid); ?>_next">&#8250;</button>
</div>
<div class="marti-modal-overlay" id="<?php echo esc_attr($uid); ?>_vid_modal">
  <div class="marti-modal-inner">
    <button class="marti-modal-close" id="<?php echo esc_attr($uid); ?>_vid_close">&times;</button>
    <iframe id="<?php echo esc_attr($uid); ?>_vid_frame" src="" allowfullscreen allow="autoplay; encrypted-media"></iframe>
  </div>
</div>
<script>
(function(){
  var uid=<?php echo json_encode($uid); ?>;
  document.querySelectorAll('#'+uid+' .marti-tab-btn').forEach(function(btn){
    btn.addEventListener('click',function(){
      document.querySelectorAll('#'+uid+' .marti-tab-btn').forEach(function(b){b.classList.remove('active')});
      document.querySelectorAll('#'+uid+' .marti-tab-panel').forEach(function(p){p.classList.remove('active')});
      btn.classList.add('active');
      document.querySelector('#'+uid+' [data-panel="'+btn.getAttribute('data-tab')+'"]').classList.add('active');
    });
  });
  var imgModal=document.getElementById(uid+'_img_modal');
  var imgDisplay=document.getElementById(uid+'_img_display');
  var cur=[],idx=0;
  document.querySelectorAll('#'+uid+' .marti-gallery-item').forEach(function(item){
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
  document.querySelectorAll('#'+uid+' .marti-video-item').forEach(function(item){
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
add_shortcode('catedra_marti_page','catedra_marti_shortcode');
