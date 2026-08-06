<?php
function seminario_historia_shortcode() {
    $agenda_raw = [
        ['/wp-content/uploads/cesmeca-legacy/2026/02/12/633259523_26439353935670993_5625947691991344746_n.jpg','Agenda seminario'],
        ['/wp-content/uploads/cesmeca-legacy/2026/02/12/631744838_26439353942337659_4064999045065488171_n.jpg','Agenda seminario'],
        ['/wp-content/uploads/cesmeca-legacy/2026/02/12/490469037_1217855590346032_1991189855996174867_n.jpg','Agenda seminario'],
        ['/wp-content/uploads/cesmeca-legacy/2026/02/12/492069699_1053389130253056_4900088558451583392_n.jpg','Agenda seminario'],
        ['/wp-content/uploads/cesmeca-legacy/2026/02/12/515439637_1338390048292585_3145956085056992701_n_1.jpg','Agenda seminario'],
        ['/wp-content/uploads/cesmeca-legacy/2026/02/12/569035112_1394469272684662_7779209741331473144_n_1.jpg','Agenda seminario'],
        ['/wp-content/uploads/cesmeca-legacy/2021/00/seminario-de-historia-2021-agosto-noviembre.png','Seminario agosto-noviembre 2021'],
        ['/wp-content/uploads/cesmeca-legacy/2026/02/12/enero-mayo.2020CARTEL_s.jpg','Enero-mayo 2020'],
        ['/wp-content/uploads/cesmeca-legacy/seminario_permanente/cartel-1ersemestre2018.jpg','Primer semestre 2018'],
        ['/wp-content/uploads/cesmeca-legacy/seminario_permanente/2019.1er.semestre.jpg','Primer semestre 2019'],
        ['/wp-content/uploads/cesmeca-legacy/seminario_permanente/cartel-segundo-semestre-2018.jpg','Segundo semestre 2018'],
    ];
    $agenda = array_map(function($p) { return ['src' => $p[0], 'alt' => $p[1]]; }, $agenda_raw);

    $videos = [
        ['id' => '9tbQ_-U76NY', 'title' => 'Seminario Permanente de Historia de Chiapas y Centroamérica'],
    ];

    ob_start();
    ?>
    <div class="semhist-intro-text">
      <h3>Descripcion</h3>
      <p>El Seminario Permanente de Historia de Chiapas y Centroamérica se trata de un esfuerzo interinstitucional en el que participan estudiosos de la historia (profesores y estudiantes de posgrado) adscritos a las siguientes instancias académicas de San Cristóbal de Las Casas, Chiapas:</p>
      <p>- El Centro de Estudios Superiores de México y Centroamérica de la Universidad de Ciencias y Artes de Chiapas (CESMECA-UNICACH).<br>
      - El Centro de investigaciones Multidisciplinarias sobre Chiapas y Centroamérica de la Universidad Nacional Autónoma de México (CIMSUR-UNAM).<br>
      - El Centro de Investigaciones y Estudios Superiores en Antropologia Social (CIESAS) Unidad Sureste.</p>
      <p>Quienes participan en el seminario se reunen una vez al mes desde su creacion, en abril de 2016.</p>
      <p>El objetivo principal del seminario es conocer los campos de investigación de cada integrante, compartir el análisis de la historia que se estudia en la región, y, a partir del análisis colectivo por pares de los trabajos, incrementar la calidad y el alcance de los aportes de investigación que redunde en beneficio de la historia regional. Asimismo, se coordinan eventos académicos vinculados con investigaciones sobre historia de Chiapas y de América Central.</p>
      <h3>Coordinadores</h3>
      <p>- Dr. Aaron Pollack (CIESAS Unidad Sureste)<br>
      - Dr. Mario E. Valdez Gordillo (CESMECA)<br>
      - Dr. Gerardo Monterrosa Cubias (CIMSUR)</p>
    </div>
    <?php
    $intro_html = ob_get_clean();

    return cesmeca_render_gallery_tabs([
        'prefix' => 'semhist',
        'intro_html' => $intro_html,
        'tabs' => [
            ['label' => 'Agenda académica', 'type' => 'images', 'items' => $agenda],
            ['label' => 'Videos', 'type' => 'videos', 'items' => $videos],
        ],
    ]);
}
add_shortcode('seminario_historia_page','seminario_historia_shortcode');
