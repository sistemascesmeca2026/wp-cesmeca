<?php
function eac_page_shortcode() {
    $base = '/wp-content/uploads/cesmeca-legacy/';
    $gal2025_raw = [
        'actualizacion_2025/desarrollo_comunitario/493728989_1233002238831367_8338653192214803408_n.jpg',
        'actualizacion_2025/desarrollo_comunitario/FEb.jpg',
        'actualizacion_2025/desarrollo_comunitario/Marzo2025.jpg',
        'actualizacion_2025/desarrollo_comunitario/Abril.jpg',
        'actualizacion_2025/desarrollo_comunitario/Mayo2025.jpg',
        'actualizacion_2025/desarrollo_comunitario/Junio_20205.jpg',
        'actualizacion_2025/desarrollo_comunitario/Julio2025.jpg',
        'actualizacion_2025/desarrollo_comunitario/Agosto25.jpg',
        'actualizacion_2025/desarrollo_comunitario/Septiembre2025.jpg',
    ];
    $gal2026_raw = [
        'actualizacion_2025/desarrollo_comunitario/2026/Cartel_General_2026.png',
        'actualizacion_2025/desarrollo_comunitario/2026/Feb2026.png',
    ];
    $to_items = function($arr) use ($base) {
        return array_map(function($p) use ($base) {
            return ['src' => $base . $p, 'alt' => ''];
        }, $arr);
    };

    ob_start();
    ?>
    <div class="eac-intro-text">
      <p>El seminario interinstitucional de enfoques alternativos y críticos para el desarrollo comunitario es un proyecto permanente que busca integrar aprendizajes hacia un enfoque interdisciplinario y territorial entre los participantes. Se propone para su operación a la modalidad mixta y con una frecuencia mensual en el que participan actualmente siete instituciones de la región sur-sureste: Centro de Investigación para el Desarrollo Sustentable (CIDES), Benemérita Universidad Autónoma de Chiapas (Unach), Instituto Tecnológico de Acapulco (ITA), Universidad Autónoma de Ciencias y Artes de Chiapas (Unicach), Universidad Intercultural de Chiapas (Unich), Universidad de la Sierra Juárez (Unsij) y Universidad Politécnica de Chiapas (Upch).</p>
      <p>Estas instituciones se encuentran interesadas en la conformación de una red académica de apoyo e intercambio de experiencias y aprendizajes para la transformación regional de las comunidades locales desde la promoción del acceso universal al conocimiento y la promoción de los principios de interculturalidad, justicia social, equidad, igualdad, solidaridad, sustentabilidad, paz e inclusión.</p>
      <h3>Propósito</h3>
      <p>Propiciar el diálogo comunitario, académico e investigativo para la comprensión de enfoques críticos y alternativos para el desarrollo comunitario.</p>
      <h3>Registro validado</h3>
      <p>AEC-001/2025, por el Departamento de Educación Continua de la Secretaría Académica de la Universidad Autónoma de Ciencias y Artes de Chiapas, con fecha de 9 de enero de 2025.</p>
      <h3>Coordinación general</h3>
      <p>Dra. Nelly Eblin Barrientos Gutierrez<br>Investigadora por Mexico comisionada<br><a href="mailto:negutierrezgu@secihti.mx">negutierrezgu@secihti.mx</a></p>
      <h3>Comité organizador</h3>
      <p>Dr. Amin Andres Miceli Ruiz (Unicach)<br>Dr. Domingo Gomez Lopez (Unich)<br>Dra. Elisa Cruz Rueda (Unach)<br>Dr. Juan Jose Bedolla Solano (ITA)<br>Dra. Maria Jane Rivas Damian (Cides)<br>Dr. Mario Enrique Fuente Carrasco (Unsij)<br>Dra. Nelly Eblin Barrientos Gutierrez (Secihti-Cesmeca)<br>Dr. Roberto Berrones Hernandez (Upch)</p>
      <h3>Correo de informes</h3>
      <p><a href="mailto:proyectocir0352024@gmail.com">proyectocir0352024@gmail.com</a></p>
      <h3>Canal YouTube</h3>
      <p><a href="https://www.youtube.com/@SeminarioInterinstituciona-EAC" target="_blank">youtube.com/@SeminarioInterinstituciona-EAC</a></p>
    </div>
    <div class="eac-intro-img">
      <img src="/wp-content/uploads/cesmeca-legacy/actualizacion_2025/desarrollo_comunitario/493728989_1233002238831367_8338653192214803408_n.jpg" alt="Seminario EAC">
    </div>
    <?php
    $intro_html = ob_get_clean();

    return cesmeca_render_gallery_tabs([
        'prefix' => 'eac',
        'intro_html' => $intro_html,
        'tabs' => [
            ['label' => 'Actividades 2025', 'type' => 'images', 'items' => $to_items($gal2025_raw)],
            ['label' => 'Actividades 2026', 'type' => 'images', 'items' => $to_items($gal2026_raw)],
        ],
    ]);
}
add_shortcode('eac_page','eac_page_shortcode');
