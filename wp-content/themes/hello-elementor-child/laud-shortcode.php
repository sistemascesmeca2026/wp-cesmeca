<?php
add_shortcode('laud_page', function() {
    $base = '/wp-content/uploads/2026/06';
    $imgs = [
        'laud_LAUD20171.jpg',
        'laud_LAUD20181.jpg','laud_LAUD20182.jpg','laud_LAUD20183.jpg','laud_LAUD20184.jpg',
        'laud_61356512_2486795461331641_8716390721390641152_o.jpg',
        'laud_61376768_2487216434622877_6121429231277703168_o.jpg',
        'laud_6tas_Jornadas_de_Afromexicanidad.jpg',
        'laud_Conferencia_PabloChavarra_PECDA.jpg',
        'laud_Converstario_6tas_Jornadas_de_Afromexicanidad.jpg',
        'laud_muestra-de-cine-feminista-2019.jpg',
        'laud_LAUD20191.jpg','laud_LAUD20192.jpg','laud_LAUD20193.jpg',
        'laud_7Jornadas_Afrodecendencia2020.png',
        'laud_Presentacin_de_proyectos_Aquelarre_LAUD.jpg',
        'laud_taller-de-baile_6tas-jornadas-de-afromexicanidad.jpg',
        'laud_Charlas_Videofnicas_1.jpg','laud_Charlas_videofnicas_2.jpg',
        'laud_FotObservatorio.jpg',
        'laud_Resiliencia-Resistencia_Mujeres-Negras_21.png',
        'laud_7118b23a-4ebd-4dd6-9713-8b57634e8c72.jpg',
        'laud_IMG-20180626-WA0002.jpg',
        'laud_IMG_1144.jpg',
        'laud_La_Caravana_Migrante-Expo_de_Jacob_Garcia_y_Rodrigo_Pardo.jpg',
        'laud_8JornadasAfro3.png',
        'laud_Banner-Conferencia_Sagrario_Cruz.png',
        'laud_Banner-Conferencia_Sara_Islas.png',
        'laud_Banner_Sagrario_Cruz.png',
        'laud_Banner_Sara_Islas.png',
        'laud_Laboratorio_de_Sonoridades.png',
        'laud_Taller_de_Cine_Documental2021.png',
        'laud_1-Arte_factor_social_Arte_factor_social_Arte_factor_social.png',
        'laud_3_No-Mente_dibujo_de_rostro_No-Mente_dibujo_de_rostro.png',
    ];
    $videos = [
        ['6N3NtRcmzL0','MUESTRA DE CINE FEMINISTA. PARENTAL ADVISORY: feminismo explícito'],
        ['gVVmhtLroNg','Conversatorio: Resiliencia y Resistencia en las mujeres negras'],
        ['Y3byZrAN2Zg','Efraín Ascencio Cedillo, a un año de su partida'],
        ['oeljpIA4oBU','Octavas Jornadas de Afromexicanidad y Afrodescendencia'],
        ['o_56Hf9V6Zk','Octavas Jornadas de Afromexicanidad y Afrodescendencia'],
        ['op5vK0YURm0','Séptimas Jornadas de Afromexicanidad y Afrodescendencia México'],
        ['ysxs19nhVcQ','Séptimas Jornadas de Afromexicanidad y Afrodescendencia México'],
        ['ZCeDd0wgFbA','Séptimas Jornadas de Afromexicanidad y Afrodescendencia México'],
        ['psO-ELJdEZM','NO-MENTE, DIBUJO DE ROSTRO. Una fuga del canon pictórico.'],
        ['yqzZ9Phls3M','El arte, factor social de cambio'],
        ['hvNOCrpzmOw','Experiencias Creativas y Artísticas entre Juventudes del Sureste Mexicano'],
        ['7zPsHUtPNwI','Juventudes Música y Diversidad Cultural'],
    ];
    $imgs_json = json_encode(array_map(function($img) use ($base){ return $base.'/'.$img; }, $imgs));
    ob_start();
    echo '<style>
.laud-tabs{display:flex;gap:4px;margin:20px 0 0}
.laud-tabs-wrapper{border:1px solid #e0e0e0;border-radius:8px;padding:24px;box-shadow:0 2px 10px rgba(0,0,0,.06)}
.laud-tab{padding:8px 20px;border:1px solid #ccc;border-bottom:none;border-radius:4px 4px 0 0;cursor:pointer;font-size:14px;background:#5dade2;color:#fff}
.laud-tab.active{background:#3498db;color:#fff;font-weight:600}
.laud-panel{display:none;border:1px solid #ccc;padding:20px;border-radius:0 4px 4px 4px}
.laud-panel.active{display:block}
.agenda-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:8px}
.agenda-item{cursor:pointer;overflow:hidden;border-radius:4px;aspect-ratio:3/4}
.agenda-item img{width:100%;height:100%;object-fit:cover;transition:transform .3s}
.agenda-item:hover img{transform:scale(1.05)}
.video-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}
.video-item{cursor:pointer}
.video-thumb{width:100%;aspect-ratio:16/9;overflow:hidden;border-radius:4px;background:#000}
.video-thumb img{width:100%;height:100%;object-fit:cover}
.video-item p{font-size:12px;color:#555;margin:6px 0 0;line-height:1.3}
.lb-modal{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.9);z-index:9999;align-items:center;justify-content:center}
.lb-modal.open{display:flex}
.lb-inner{position:relative;max-width:90%;max-height:90vh}
.lb-inner img{max-width:100%;max-height:90vh;border-radius:4px;display:block}
.lb-close{position:absolute;top:-35px;right:0;color:#fff;font-size:28px;cursor:pointer}
.lb-prev,.lb-next{position:absolute;top:50%;transform:translateY(-50%);color:#fff;font-size:40px;cursor:pointer;padding:10px;background:rgba(0,0,0,.3);border-radius:4px}
.lb-prev{left:-60px}.lb-next{right:-60px}
.vm-modal{display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,.85);z-index:9999;align-items:center;justify-content:center}
.vm-modal.open{display:flex}
.vm-inner{position:relative;width:80%;max-width:900px;aspect-ratio:16/9}
.vm-inner iframe{width:100%;height:100%;border:none;border-radius:6px}
.vm-close{position:absolute;top:-35px;right:0;color:#fff;font-size:28px;cursor:pointer}
@media(max-width:640px){.agenda-grid{grid-template-columns:repeat(2,1fr)}.video-grid{grid-template-columns:1fr}}
</style>';
    echo '<div class="laud-tabs-wrapper"><div class="laud-tabs">
<div class="laud-tab active" onclick="laudTab(this,\'agenda\')">Agenda académica</div>
<div class="laud-tab" onclick="laudTab(this,\'videos\')">Videos</div>
</div>';
    echo '<div id="laud-agenda" class="laud-panel active"><div class="agenda-grid">';
    foreach($imgs as $i => $img) {
        echo '<div class="agenda-item" onclick="abrirLB('.$i.')"><img src="'.$base.'/'.$img.'" loading="lazy" alt=""></div>';
    }
    echo '</div></div>';
    echo '<div id="laud-videos" class="laud-panel"><div class="video-grid">';
    foreach($videos as $v) {
        echo '<div class="video-item" onclick="abrirVideo(\''.$v[0].'\')"><div class="video-thumb"><img src="https://img.youtube.com/vi/'.$v[0].'/hqdefault.jpg" loading="lazy"></div><p>'.$v[1].'</p></div>';
    }
    echo '</div></div></div>';
    echo '<div class="lb-modal" id="lbModal" onclick="if(event.target===this)cerrarLB()">
<div class="lb-inner">
<span class="lb-close" onclick="cerrarLB()">&#10005;</span>
<span class="lb-prev" onclick="cambiarLB(-1);event.stopPropagation()">&#8249;</span>
<img id="lbImg" src="">
<span class="lb-next" onclick="cambiarLB(1);event.stopPropagation()">&#8250;</span>
</div></div>';
    echo '<div class="vm-modal" id="vmModal" onclick="if(event.target===this)cerrarVideo()">
<div class="vm-inner">
<span class="vm-close" onclick="cerrarVideo()">&#10005;</span>
<iframe id="vmFrame" src="" allowfullscreen></iframe>
</div></div>';
    echo '<script>
var lbI='.$imgs_json.';
var lbIdx=0;
function abrirLB(i){lbIdx=i;document.getElementById("lbImg").src=lbI[i];document.getElementById("lbModal").classList.add("open")}
function cerrarLB(){document.getElementById("lbModal").classList.remove("open")}
function cambiarLB(d){lbIdx=(lbIdx+d+lbI.length)%lbI.length;document.getElementById("lbImg").src=lbI[lbIdx]}
function laudTab(btn,panel){document.querySelectorAll(".laud-tab").forEach(function(t){t.classList.remove("active")});document.querySelectorAll(".laud-panel").forEach(function(p){p.classList.remove("active")});btn.classList.add("active");document.getElementById("laud-"+panel).classList.add("active")}
function abrirVideo(id){document.getElementById("vmFrame").src="https://www.youtube.com/embed/"+id+"?autoplay=1";document.getElementById("vmModal").classList.add("open")}
function cerrarVideo(){document.getElementById("vmFrame").src="";document.getElementById("vmModal").classList.remove("open")}
document.addEventListener("keydown",function(e){if(document.getElementById("lbModal").classList.contains("open")){if(e.key==="ArrowLeft")cambiarLB(-1);if(e.key==="ArrowRight")cambiarLB(1);if(e.key==="Escape")cerrarLB()}});
</script>';
    return ob_get_clean();
});
