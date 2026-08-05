<?php
function reveldia_page_shortcode() {
    $base = '/wp-content/uploads/cesmeca-legacy/';
    $gal2021 = [
        'actualizacion_2025/seminario_reveldia/actividades_2021/Ana_Mara_Castro.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/Astrid_Cuero_Modulo1.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/Delmy_Tania_Cruz.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/DiplomadSembrarR1.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/DiplomadSembrarR21.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/Julia_Antivilo.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/Mara_Jos_Perez.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/Marcela.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/Natalia_Cabanillas.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/Ochy_Curiel.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/Odette_Fajardo.png',
    ];
    $gal2022 = [
        'actualizacion_2025/seminario_reveldia/actividades_2022/2_Ochy_Curiel.png',
        'actualizacion_2025/seminario_reveldia/actividades_2022/3_Msicas_y_bailarinas_de_tango.png',
        'actualizacion_2025/seminario_reveldia/actividades_2022/4_Montserrat_Aguilar.png',
        'actualizacion_2025/seminario_reveldia/actividades_2022/5_Marlene_Vizuet.png',
        'actualizacion_2025/seminario_reveldia/actividades_2022/6_Tania_Prez_Bustos.png',
        'actualizacion_2025/seminario_reveldia/actividades_2022/Eli_Bartraig.png',
        'actualizacion_2025/seminario_reveldia/actividades_2022/Sembrar_Revelda_IG.png',
        'actualizacion_2025/seminario_reveldia/actividades_2022/Seminario-SembrarR2022.png',
    ];
    $gal2024 = [
        'actualizacion_2025/seminario_reveldia/actividades_2024/General.jpg',
        'actualizacion_2025/seminario_reveldia/actividades_2024/Ali_Aguilera.png',
        'actualizacion_2025/seminario_reveldia/actividades_2024/Annaliesse_Hurtado.png',
        'actualizacion_2025/seminario_reveldia/actividades_2024/Daniela_Castillo.png',
        'actualizacion_2025/seminario_reveldia/actividades_2024/Marisol_Anzo.png',
        'actualizacion_2025/seminario_reveldia/actividades_2024/Mary_Nelsy_Valero.png',
    ];
    $gal2025 = [
        'actualizacion_2025/seminario_reveldia/actividades_2025/Cartel_general.jpg',
        'actualizacion_2025/seminario_reveldia/actividades_2025/Diana_Gmez_Correal.png',
        'actualizacion_2025/seminario_reveldia/actividades_2025/General_2.jpg',
        'actualizacion_2025/seminario_reveldia/actividades_2025/Teresa_Fernndez.png',
    ];
    $uid = 'reveldia_' . uniqid();
    ob_start();
    ?>
<style>
.rev-intro{display:flex;gap:40px;margin-bottom:36px;align-items:flex-start}
.rev-intro-text{flex:2}.rev-intro-img{flex:1;text-align:center}
.rev-intro-img img{max-width:100%;border-radius:6px}
.rev-intro-text h2{font-size:1.5rem;margin-bottom:16px;color:#1a1a2e}
.rev-intro-text h3{font-size:1.1rem;margin:16px 0 6px;color:#1a1a2e}
.rev-intro-text p{font-size:.97rem;line-height:1.7;text-align:justify;color:#333}
.rev-tabs-nav{display:flex;flex-wrap:wrap;border-bottom:2px solid #ddd;margin-bottom:24px;gap:4px}
.rev-tab-btn{padding:8px 16px;background:#5dade2;border:1px solid #ddd;border-bottom:none;cursor:pointer;font-size:.9rem;color:#fff;border-radius:4px 4px 0 0}
.rev-tab-btn:hover,.rev-tab-btn:focus{background:#5dade2!important;color:#fff!important;text-decoration:none}
.rev-tab-btn.active{background:#3498db!important;color:#fff!important;font-weight:600;border-bottom:2px solid #3498db;margin-bottom:-2px}
.rev-tab-btn.active:hover,.rev-tab-btn.active:focus{background:#3498db!important;color:#fff!important}
.rev-tab-panel{display:none}.rev-tab-panel.active{display:block}
.rev-tabs-wrapper{border:1px solid #e0e0e0!important;border-radius:8px!important;padding:24px!important;box-shadow:0 2px 10px rgba(0,0,0,.06)!important}
.rev-gallery{display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:16px;margin-top:8px}
.rev-gallery-item{cursor:pointer;border-radius:6px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.1)}
.rev-gallery-item img{width:100%;height:220px;object-fit:cover;display:block;transition:transform .2s}
.rev-gallery-item:hover img{transform:scale(1.03)}
.rev-modal-overlay{display:none;position:fixed;inset:0;background:rgba(0,0,0,.88);z-index:99999;align-items:center;justify-content:center}
.rev-modal-overlay.open{display:flex}
.rev-modal-inner{position:relative;max-width:90vw;max-height:90vh}
.rev-modal-inner img{max-width:88vw;max-height:85vh;border-radius:4px;display:block}
.rev-modal-close{position:absolute;top:-36px;right:0;background:none;border:none;color:#fff;font-size:2rem;cursor:pointer}
.rev-modal-prev,.rev-modal-next{position:fixed;top:50%;transform:translateY(-50%);background:rgba(255,255,255,.15);border:none;color:#fff;font-size:2rem;padding:12px 18px;cursor:pointer;border-radius:4px;z-index:100000}
.rev-modal-prev{left:16px}.rev-modal-next{right:16px}
@media(max-width:768px){.rev-intro{flex-direction:column}.rev-tab-btn{font-size:.8rem;padding:6px 10px}}
</style>
<div class="rev-intro">
  <div class="rev-intro-text">
    
    <p>Seminario Permanente de Investigacion Feminista "Sembrar ReVeldia" busca dar a conocer a la comunidad academica y militante del sureste mexicano diversas trayectorias investigativas, asi como investigaciones concluidas o en curso, que aporten lineamientos para nutrir las discusiones que sentipensamos como necesarias en nuestro contexto actual.</p>
    <p>Este seminario convoca al dialogo entre academicas de alto nivel, estudiantes del Posgrado en Estudios e Intervencion Feministas, asi como otras personas interesadas en adquirir herramientas para la investigacion-accion feminista desde una perspectiva del Sur.</p>
    <h3>Objetivos</h3>
    <p>1. Construir una plataforma de difusion y divulgacion para la comunidad de feministas del Sur, para dar cuenta del estado actual del arte de la investigacion feminista de Chiapas, Centroamerica y Latinoamerica.<br>
    2. Aportar a la construccion de redes de conocimiento, accion politica y acuerpamiento que incluya estudiantes, investigadoras y activistas de Chiapas, Centroamerica y Latinoamerica.</p>
    <h3>Sesiones</h3>
    <p><strong>Diplomado: Del 11 de marzo al 13 de mayo 2021</strong><br>Coordinacion: Dra. Maria Teresa Garzon Martinez</p>
    <p><strong>Segunda emision: Del 11 de marzo al 13 de mayo de 2022</strong><br>Coordinacion: Dra. Maria Teresa Garzon Martinez</p>
    <p><strong>Tercera emision: Del 23 de septiembre al 21 de octubre de 2024</strong><br>Coordinacion: Dra. Marcela Fernandez Camacho</p>
    <p><strong>Cuarta emision: Del 4 al 25 de noviembre de 2025</strong><br>Coordinadores: Dra. Tesa Garzon, Dra. Karla Somosa, Dr. Armando Mendez</p>
  </div>
  <div class="rev-intro-img">
    <img src="/wp-content/uploads/cesmeca-legacy/actualizacion_2025/seminario_reveldia/LogoSembrarRV25.png" alt="Sembrar ReVeldia">
  </div>
</div>
<div class="rev-tabs-wrapper" id="<?php echo esc_attr($uid); ?>">
  <div class="rev-tabs-nav">
    <button class="rev-tab-btn active" data-tab="g2021">Actividad 2021</button>
    <button class="rev-tab-btn" data-tab="g2022">Actividad 2022</button>
    <button class="rev-tab-btn" data-tab="g2024">Actividad 2024</button>
    <button class="rev-tab-btn" data-tab="g2025">Actividad 2025</button>
  </div>
  <?php
  $galerias = ['g2021'=>$gal2021,'g2022'=>$gal2022,'g2024'=>$gal2024,'g2025'=>$gal2025];
  foreach($galerias as $key=>$imgs):
  ?>
  <div class="rev-tab-panel <?php echo $key==='g2021'?'active':''; ?>" data-panel="<?php echo $key; ?>">
    <div class="rev-gallery" id="<?php echo esc_attr($uid.'_'.$key); ?>">
      <?php foreach($imgs as $i=>$img): ?>
      <div class="rev-gallery-item" data-gallery="<?php echo esc_attr($uid.'_'.$key); ?>" data-index="<?php echo $i; ?>">
        <img src="<?php echo esc_url($base.$img); ?>" alt="" loading="lazy">
      </div>
      <?php endforeach; ?>
    </div>
  </div>
  <?php endforeach; ?>
</div>
<div class="rev-modal-overlay" id="<?php echo esc_attr($uid); ?>_modal">
  <button class="rev-modal-prev" id="<?php echo esc_attr($uid); ?>_prev">&#8249;</button>
  <div class="rev-modal-inner">
    <button class="rev-modal-close" id="<?php echo esc_attr($uid); ?>_close">&times;</button>
    <img src="" alt="" id="<?php echo esc_attr($uid); ?>_display">
  </div>
  <button class="rev-modal-next" id="<?php echo esc_attr($uid); ?>_next">&#8250;</button>
</div>
<script>
(function(){
  var uid=<?php echo json_encode($uid); ?>;
  document.querySelectorAll('#'+uid+' .rev-tab-btn').forEach(function(btn){
    btn.addEventListener('click',function(){
      document.querySelectorAll('#'+uid+' .rev-tab-btn').forEach(function(b){b.classList.remove('active')});
      document.querySelectorAll('#'+uid+' .rev-tab-panel').forEach(function(p){p.classList.remove('active')});
      btn.classList.add('active');
      document.querySelector('#'+uid+' [data-panel="'+btn.getAttribute('data-tab')+'"]').classList.add('active');
    });
  });
  var modal=document.getElementById(uid+'_modal');
  var display=document.getElementById(uid+'_display');
  var cur=[],idx=0;
  document.querySelectorAll('#'+uid+' .rev-gallery-item').forEach(function(item){
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
add_shortcode('reveldia_page','reveldia_page_shortcode');
