<?php
function laboratoria_page_shortcode() {
    ob_start();
    ?>
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
    <?php
    $intro_html = ob_get_clean();

    ob_start();
    ?>
      <p>Taller <em>Metodologias feministas en contexto</em><br>
        Fecha: 19, 20 y 21 de marzo de 2025<br>
        Duracion: 9 horas<br>
        Proposito: considerando la necesidad del fortalecimiento continuo a los procesos de ensenanza-aprendizaje de las estudiantes, este taller se propone generar un espacio de confianza y construccion horizontal de conocimiento en el que se puedan retroalimentar colectivamente las propuestas metodologicas de las investigaciones que estan desarrollando y ofrecer orientacion para construir algunas herramientas necesarias para el trabajo de campo.</p>
      <img src="/wp-content/uploads/cesmeca-legacy/actualizacion_2025/laboratoria/Cartel-Taller_MF.png" alt="Cartel Taller Metodologias Feministas">
    <?php
    $act1 = ob_get_clean();

    ob_start();
    ?>
      <p>Editatona <em>Feministas del Sur Global</em> en colaboracion con Wikimedia Mexico<br>
      Fecha: 29 de abril de 2025<br>
      Duracion: 6 horas<br>
      Proposito: visibilizar los aportes y las trayectorias de mujeres feministas de distintas latitudes de las coordenadas geopoliticas que conforman el Sur Global, contribuyendo asi a la divulgacion de nuestra genealogia politica y a disminuir la brecha de genero en Wikipedia.</p>
      <img src="/wp-content/uploads/cesmeca-legacy/actualizacion_2025/laboratoria/Editatona.png" alt="Editatona Feministas del Sur Global">
      <img src="/wp-content/uploads/cesmeca-legacy/actualizacion_2025/laboratoria/editona2.jpg" alt="Editatona foto">
    <?php
    $act2 = ob_get_clean();

    ob_start();
    ?>
      <p>Taller <em>Uso de QualCoder en la investigacion feminista</em><br>
      Fecha: 18 de septiembre de 2025<br>
      Duracion: 3 horas<br>
      Proposito: brindar, a traves de una capacitacion introductoria al software QualCoder, herramientas practicas para la codificacion de materiales textuales y el analisis de datos cualitativos a partir de categorias, subcategorias y codigos deductivos e inductivos.</p>
    <?php
    $act3 = ob_get_clean();

    ob_start();
    ?>
      <p>Con la incorporacion de la Dra. Agnes del Rosario Jimenez Romo como investigadora posdoctoral en el PEIF, todavia durante este 2025, se llevara a cabo una actividad como parte del eje de accion comunicacion de la Laboratoria que sera liderada por ella:</p>
      <p>Taller <em>Herramientas de comunicacion digital feminista</em></p>
      <ul>
        <li>Fecha: 03 al 06 de noviembre de 2025<br>
        Duracion: 12 horas<br>
        Proposito: Construir de manera participativa, una estrategia de comunicacion digital feminista que refleje los principios del posgrado: pensamiento critico, la etica del cuidado y el trabajo colectivo. El taller esta organizado para que las estudiantes del PEIF exploren herramientas practicas con bases teoricas, reconociendo que las redes sociodigitales no solo son espacios de difusion, sino tambien, territorios de encuentro, reflexion e intervencion.</li>
      </ul>
    <?php
    $act4 = ob_get_clean();

    return cesmeca_render_gallery_tabs([
        'prefix' => 'lab',
        'intro_html' => $intro_html,
        'tabs' => [
            ['label' => 'Actividad 1', 'type' => 'content', 'html' => $act1],
            ['label' => 'Actividad 2', 'type' => 'content', 'html' => $act2],
            ['label' => 'Actividad 3', 'type' => 'content', 'html' => $act3],
            ['label' => 'Actividad 4', 'type' => 'content', 'html' => $act4],
        ],
    ]);
}
add_shortcode('laboratoria_page','laboratoria_page_shortcode');
