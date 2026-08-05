<?php
function lacem_page_shortcode() {
    $eventos = [];
    $joomla_ids = [456, 455, 443];
    $portadas_lacem = [456=>'/wp-content/uploads/cesmeca-legacy/LACEM/2.png',455=>'/wp-content/uploads/cesmeca-legacy/LACEM/3.png',443=>'/wp-content/uploads/cesmeca-legacy/LACEM/peten.png'];
    foreach ($joomla_ids as $jid) {
        $posts = get_posts(['post_type'=>'post','meta_key'=>'_fgj2wp_old_id','meta_value'=>$jid,'numberposts'=>1]);
        if (!empty($posts)) $eventos[] = ['post' => $posts[0], 'thumb' => $portadas_lacem[$jid] ?? ''];
    }

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

    ob_start();
    ?>
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
    <?php
    $intro_html = ob_get_clean();

    return cesmeca_render_gallery_tabs([
        'prefix' => 'lacem',
        'intro_html' => $intro_html,
        'tabs' => [
            ['label' => 'Eventos', 'type' => 'posts', 'items' => $eventos],
            ['label' => 'Actividades 2022-2023', 'type' => 'images', 'items' => $actividades_2023],
            ['label' => 'Videos 2022-2023', 'type' => 'videos', 'items' => $videos_2023],
            ['label' => 'Videos 2015-2021', 'type' => 'videos', 'items' => $videos_2021],
            ['label' => 'Actividades LACEM 2015-2021', 'type' => 'images', 'items' => $actividades_2021],
        ],
    ]);
}
add_shortcode('lacem_page','lacem_page_shortcode');
