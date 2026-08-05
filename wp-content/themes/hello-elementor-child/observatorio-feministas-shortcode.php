<?php
function observatorio_feministas_shortcode() {
    $uid = 'obsfem_' . uniqid();
    ob_start();
    ?>
<style>
.obsfem-intro{display:flex;gap:40px;margin-bottom:36px;align-items:flex-start}
.obsfem-intro-text{flex:2}.obsfem-intro-img{flex:1;text-align:center}
.obsfem-intro-img img{max-width:100%;border-radius:6px}
.obsfem-intro-text h2{font-size:1.5rem;margin-bottom:16px;color:#1a1a2e}
.obsfem-intro-text h3{font-size:1.1rem;margin:16px 0 6px;color:#1a1a2e}
.obsfem-intro-text p{font-size:.97rem;line-height:1.7;text-align:justify;color:#333;margin-bottom:10px}
.obsfem-intro-text ul{padding-left:20px;font-size:.97rem;line-height:1.7;color:#333}
.obsfem-intro-text li{margin-bottom:8px}
.obsfem-tab-panel{padding:20px;border:1px solid #e5e5e5;border-radius:8px}
.obsfem-tab-panel img{max-width:50%;display:block;margin:0 auto 20px;border-radius:6px}
.obsfem-tab-panel p{font-size:.97rem;line-height:1.7;text-align:justify;color:#333}
@media(max-width:768px){.obsfem-intro{flex-direction:column}.obsfem-tab-panel img{max-width:80%}}
</style>
<div class="obsfem-intro">
  <div class="obsfem-intro-text">
    
    <p>El Observatorio Feminista contra la Violencia a las mujeres de Chiapas (ObsFeministaCh) fundado el 1 de enero del ano 2016, contribuye actualmente con el Cesmeca-Unicach, a partir del 16 de febrero de 2024. El ObsFeministaCh es un espacio en donde se concentran los esfuerzos feministas, academicos y ciudadanos para la investigacion, conteo estadistico y mapeo de la violencia feminicida en el estado de Chiapas.</p>
    <h3>Objetivos</h3>
    <ul>
      <li>Generar informacion y conocimiento a profundidad sobre situaciones especificas de la violencia contra las mujeres, generalmente tendientes a alimentar politicas publicas.</li>
      <li>Coadyuvar a la generacion de espacios de reflexion y discusion en torno a los temas de interes publico para el estado de Chiapas, un estado de la frontera sur de Mexico, colindante con centroamerica, donde el flujo de migracion y crimen transnacional agrava la violencia feminicida de manera coyuntural y estructural.</li>
    </ul>
    <h3>Responsable</h3>
    <p>Dra. Karla Lizbeth Somosa Ibarra</p>
    <h3>Retribucion social</h3>
    <p>Dulce Viviana Flecha Gutierrez<br>Laura Patricia Perez Flores<br>Wendy Susana Castro Santiago</p>
  </div>
  <div class="obsfem-intro-img">
    <img src="/wp-content/uploads/cesmeca-legacy/actualizacion_2025/observatorio_feministas/logo_ofch_2025.png" alt="Observatorio Feministas de Chiapas">
  </div>
</div>
<div class="obsfem-tab-panel">
  <img src="/wp-content/uploads/cesmeca-legacy/actualizacion_2025/observatorio_feministas/obs_feministas.jpg" alt="Informe Observatorio Feministas">
  <p>El ultimo informe del ObsFeministaCh del 2024, registro 197 muertes violentas de mujeres, en donde al menos 63 parecen ser feminicidios consumados; en cuanto al ano 2023, la sumatoria fue de 182 muertes violentas de mujeres y 44 feminicidios consumados y en el ano 2022, 174 muertes violentas de mujeres y 41 feminicidios consumados. Estos datos revelan una alza de casos en los ultimos tres anos. Las cifras y la informacion recabada y sistematizada se ha obtenido de la revision de periodicos que se encuentran online. La informacion no comprende cifras oficiales de autoridades estatales; sino que son parte de la labor feminista que realiza el Observatorio Feminista de Chiapas del Cesmeca-Unicach, de manera autonoma y gratuita como contribucion a la lucha ciudadana contra la violencia a las mujeres en el estado de Chiapas.</p>
</div>
<?php
    return ob_get_clean();
}
add_shortcode('observatorio_feministas_page','observatorio_feministas_shortcode');
