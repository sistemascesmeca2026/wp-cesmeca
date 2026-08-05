<?php
function laboratoria_page_shortcode() {
    $uid = 'laboratoria_' . uniqid();
    ob_start();
    ?>
<style>
.lab-intro{display:flex;gap:40px;margin-bottom:36px;align-items:flex-start}
.lab-intro-text{flex:2}
.lab-intro-img{flex:1;text-align:center}
.lab-intro-img img{max-width:100%;border-radius:6px}
.lab-intro-text h2{font-size:1.5rem;margin-bottom:16px;color:#1a1a2e}
.lab-intro-text h3{font-size:1.1rem;margin:16px 0 6px;color:#1a1a2e}
.lab-intro-text p{font-size:.97rem;line-height:1.7;text-align:justify;color:#333}
.lab-tabs-nav{display:flex;flex-wrap:wrap;border-bottom:2px solid #ddd;margin-bottom:24px;gap:4px}
.lab-tab-btn{padding:8px 16px;background:#5dade2;border:1px solid #ddd;border-bottom:none;cursor:pointer;font-size:.9rem;color:#fff;border-radius:4px 4px 0 0}
.lab-tab-btn:hover,.lab-tab-btn:focus{background:#5dade2!important;color:#fff!important;text-decoration:none}
.lab-tab-btn.active{background:#3498db!important;color:#fff!important;font-weight:600;border-bottom:2px solid #3498db;margin-bottom:-2px}
.lab-tab-btn.active:hover,.lab-tab-btn.active:focus{background:#3498db!important;color:#fff!important}
.lab-tab-panel{display:none}.lab-tab-panel.active{display:block}
.lab-tabs-wrapper{border:1px solid #e0e0e0!important;border-radius:8px!important;padding:24px!important;box-shadow:0 2px 10px rgba(0,0,0,.06)!important}
.lab-actividad{font-size:.97rem;line-height:1.7;color:#333;border:1px solid #e5e5e5;border-radius:8px;padding:24px}
.lab-actividad p{margin-bottom:12px;text-align:justify}
.lab-actividad ul{padding-left:20px;margin-bottom:12px}
.lab-actividad li{margin-bottom:8px}
.lab-actividad img{max-width:320px;border-radius:6px;margin:12px 0;display:block}
@media(max-width:768px){.lab-intro{flex-direction:column}.lab-tab-btn{font-size:.8rem;padding:6px 10px}.lab-actividad img{max-width:100%}}
</style>

<div class="lab-intro">
  <div class="lab-intro-text">
    
    <p>El proyecto surgio en agosto de 2024, con la intencion de construir un espacio de experimentacion, divulgacion e incidencia que posibilitara la creacion de escenarios vinculantes entre la academia y otros sectores de la sociedad, para poner a disposicion de otras personas los conocimientos generados en el Posgrado en Estudios e Intervencion Feministas.</p>
    <p>Siguiendo el objetivo de crear una estrategia de incidencia feminista, para iniciar el trabajo de la Laboratoria se plantearon tres ejes de accion: 1) comunicacion; 2) experimentacion; y 3) vinculacion. Conformados a su vez por iniciativas especificas orientadas a su operacion en el corto y mediano plazo.</p>
    <p>A partir de estas directrices, la Laboratoria comenzo a operar en 2025, no bajo principios rigidos sino, haciendo honor a su proposito, bajo principios de experimentacion como la apertura, la flexibilidad y la integracion de iniciativas especificas que surgieron en el camino y como resultado del ejercicio de escucha activa sobre diferentes necesidades no previstas inicialmente.</p>
    <h3>Coordinadora</h3>
    <p>Dra. Marisol Anzo Escobar</p>
    <h3>Colaboradora</h3>
    <p>Dra. Agnes del Rosario Jimenez Romo</p>
  </div>
  <div class="lab-intro-img">
    <img src="/wp-content/uploads/cesmeca-legacy/actualizacion_2025/laboratoria/laboratoria.png" alt="Laboratoria Creacion e Incidencia Feminista">
  </div>
</div>

<div class="lab-tabs-wrapper" id="<?php echo esc_attr($uid); ?>">
  <div class="lab-tabs-nav">
    <button class="lab-tab-btn active" data-tab="act1">Actividad 1</button>
    <button class="lab-tab-btn" data-tab="act2">Actividad 2</button>
    <button class="lab-tab-btn" data-tab="act3">Actividad 3</button>
    <button class="lab-tab-btn" data-tab="act4">Actividad 4</button>
  </div>

  <div class="lab-tab-panel active" data-panel="act1">
    <div class="lab-actividad">
      <p>Taller <em>Metodologias feministas en contexto</em><br>
        Fecha: 19, 20 y 21 de marzo de 2025<br>
        Duracion: 9 horas<br>
        Proposito: considerando la necesidad del fortalecimiento continuo a los procesos de ensenanza-aprendizaje de las estudiantes, este taller se propone generar un espacio de confianza y construccion horizontal de conocimiento en el que se puedan retroalimentar colectivamente las propuestas metodologicas de las investigaciones que estan desarrollando y ofrecer orientacion para construir algunas herramientas necesarias para el trabajo de campo.</p>
      <img src="/wp-content/uploads/cesmeca-legacy/actualizacion_2025/laboratoria/Cartel-Taller_MF.png" alt="Cartel Taller Metodologias Feministas">
    </div>
  </div>

  <div class="lab-tab-panel" data-panel="act2">
    <div class="lab-actividad">
      <p>Editatona <em>Feministas del Sur Global</em> en colaboracion con Wikimedia Mexico<br>
      Fecha: 29 de abril de 2025<br>
      Duracion: 6 horas<br>
      Proposito: visibilizar los aportes y las trayectorias de mujeres feministas de distintas latitudes de las coordenadas geopoliticas que conforman el Sur Global, contribuyendo asi a la divulgacion de nuestra genealogia politica y a disminuir la brecha de genero en Wikipedia.</p>
      <img src="/wp-content/uploads/cesmeca-legacy/actualizacion_2025/laboratoria/Editatona.png" alt="Editatona Feministas del Sur Global">
      <img src="/wp-content/uploads/cesmeca-legacy/actualizacion_2025/laboratoria/editona2.jpg" alt="Editatona foto">
    </div>
  </div>

  <div class="lab-tab-panel" data-panel="act3">
    <div class="lab-actividad">
      <p>Taller <em>Uso de QualCoder en la investigacion feminista</em><br>
      Fecha: 18 de septiembre de 2025<br>
      Duracion: 3 horas<br>
      Proposito: brindar, a traves de una capacitacion introductoria al software QualCoder, herramientas practicas para la codificacion de materiales textuales y el analisis de datos cualitativos a partir de categorias, subcategorias y codigos deductivos e inductivos.</p>
    </div>
  </div>

  <div class="lab-tab-panel" data-panel="act4">
    <div class="lab-actividad">
      <p>Con la incorporacion de la Dra. Agnes del Rosario Jimenez Romo como investigadora posdoctoral en el PEIF, todavia durante este 2025, se llevara a cabo una actividad como parte del eje de accion comunicacion de la Laboratoria que sera liderada por ella:</p>
      <p>Taller <em>Herramientas de comunicacion digital feminista</em></p>
      <ul>
        <li>Fecha: 03 al 06 de noviembre de 2025<br>
        Duracion: 12 horas<br>
        Proposito: Construir de manera participativa, una estrategia de comunicacion digital feminista que refleje los principios del posgrado: pensamiento critico, la etica del cuidado y el trabajo colectivo. El taller esta organizado para que las estudiantes del PEIF exploren herramientas practicas con bases teoricas, reconociendo que las redes sociodigitales no solo son espacios de difusion, sino tambien, territorios de encuentro, reflexion e intervencion.</li>
      </ul>
    </div>
  </div>
</div>

<script>
(function(){
  var uid=<?php echo json_encode($uid); ?>;
  document.querySelectorAll('#'+uid+' .lab-tab-btn').forEach(function(btn){
    btn.addEventListener('click',function(){
      document.querySelectorAll('#'+uid+' .lab-tab-btn').forEach(function(b){b.classList.remove('active')});
      document.querySelectorAll('#'+uid+' .lab-tab-panel').forEach(function(p){p.classList.remove('active')});
      btn.classList.add('active');
      document.querySelector('#'+uid+' [data-panel="'+btn.getAttribute('data-tab')+'"]').classList.add('active');
    });
  });
})();
</script>
<?php
    return ob_get_clean();
}
add_shortcode('laboratoria_page','laboratoria_page_shortcode');
