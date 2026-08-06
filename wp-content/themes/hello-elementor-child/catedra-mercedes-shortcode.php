<?php
function catedra_mercedes_shortcode() {
    $agenda_raw = [
        '/wp-content/uploads/cesmeca-legacy/2018/00/CatMercedes20181.jpg',
        '/wp-content/uploads/cesmeca-legacy/2018/00/CatMercedes20182.jpg',
        '/wp-content/uploads/cesmeca-legacy/2018/00/CatMercedes20183.jpg',
        '/wp-content/uploads/cesmeca-legacy/2018/00/CatMercedes20184.jpg',
        '/wp-content/uploads/cesmeca-legacy/2018/00/CatMercedes20185.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/10/21/Propuesta_Conferencia_Aida_Hern%C3%A1ndez.png',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Ciclo_de_conferencias_Magistrales.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Raquel_Gutirrez.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Foro_el_teatro_popular.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/mujeres-en-defensa-de-la-tierra.jpg',
        '/wp-content/uploads/cesmeca-legacy/2020/02/06/JORNADA_Semi%C3%B3ticas_Corporales-02.png',
        '/wp-content/uploads/cesmeca-legacy/2020/10/08/Capitalismo_gore_y_transfeminismos-2020.png',
        '/wp-content/uploads/cesmeca-legacy/actualizacion_2025/catedra_mercedes_olivera/Conv_1.jpg',
        '/wp-content/uploads/cesmeca-legacy/actualizacion_2025/catedra_mercedes_olivera/Conv_2.jpg',
        '/wp-content/uploads/cesmeca-legacy/actualizacion_2025/catedra_mercedes_olivera/ExposicinFotog.jpg',
        '/wp-content/uploads/cesmeca-legacy/actualizacion_2025/catedra_mercedes_olivera/Mara_Viveros.jpg',
        '/wp-content/uploads/cesmeca-legacy/actualizacion_2025/catedra_mercedes_olivera/Resonando_desde_el_sur.jpg',
    ];
    $agenda = array_map(function($src) { return ['src' => $src, 'alt' => '']; }, $agenda_raw);

    $videos_raw = [
        ['l6EUPzwXh3U','Practicas para cuidar la vida'],
        ['1T7LV33AYv8','Abriendo brechas, enfrentando muros y avizorando futuros: sentipensar y comunicar los feminismos'],
        ['h1Vjo283wV0','Flora Tristan, en los inicios del feminismo socialista'],
        ['PVi6TOwcWys','Bienestar social y genero avances'],
        ['7dRa62IAXTo','Presentacion del libro Vivir para el Surco'],
        ['ksa75OlP4II','Presentacion del libro Paxneloliberalia de Jules Falquet'],
        ['i-dLFu1LiIw','El teatro popular como herramienta y camino'],
        ['R05AdaCrRQg','Desafios para una economia feminista decolonial: el fundamentalismo neoliberal'],
        ['Ls75l4o0sUc','Cuba, sus crisis y la resistencia de las mujeres'],
        ['8A_eVZockFM','Diplomado Repensandonos desde la Economia Feminista Emancipatoria'],
        ['rAn7LcZpGrY','Los retos de los feminismos descoloniales ante las violencias extremas en Mexico'],
        ['bsbNqPCROcc','Luchas renovadas de las mujeres en America Latina: Tiempos de rebelion'],
        ['XOEucjPl57g','Una mirada feminista sobre el imperio global norteamericano'],
    ];
    $videos = array_map(function($v) { return ['id' => $v[0], 'title' => $v[1]]; }, $videos_raw);

    ob_start();
    ?>
    <div class="merc-intro-text">
      <h3>Descripción</h3>
      <p>La Cátedra de Estudios de Género y Feminismos "Mercedes Olivera" nació en 2013, en el marco de los Posgrados en Estudios e Intervención Feministas, con el propósito de articular la vida académica e intelectual universitaria con la sociedad civil y las organizaciones sociales de Chiapas, la región sur-sureste de México, Centroamérica y el Caribe.</p>
      <p>Desde 2022, la Cátedra se ha enfocado en generar espacios de diálogo que fortalezcan los vínculos con los feminismos de los Sures Globales. Con el fin de continuar este giro epistémico, hemos invitado a colegas y referentes de estos feminismos para enriquecer la articulación teórico-política que impulsa nuestro trabajo.</p>
      <p>En 2025 contamos con la presencia de la Dra. Mara Viveros Vigoya, destacada pensadora feminista colombiana, quien visitará el Centro de Estudios Superiores de México y Centroamérica (CESMECA). Su participación nos permitirá reflexionar colectivamente —corazonar— sobre la comprensión del Sur Global y el lugar de la interseccionalidad dentro de los feminismos contemporáneos.</p>
      <p>El programa lleva por nombre "Los Feminismos del Sur con…", un título pensado para construir un marco de diálogos epistémicos desde la Cátedra. Cada invitada forma parte del margen epistémico del Sur, y consideramos que estos espacios de formación, basados en dichas epistemologías, fortalecen y distinguen la propuesta académica del posgrado.</p>
      <p>La Dra. Mara Viveros Vigoya es profesora del Departamento de Antropología y de la Escuela de Estudios de Género de la Universidad Nacional de Colombia. Su trabajo se ha centrado en los estudios de género, la perspectiva interseccional, la raza y la sexualidad, así como en el análisis de las clases medias negras en Colombia, entre otros temas relevantes.</p>
      <h3>Coordinadora</h3>
      <p>Dra. Delmy Tania Cruz Hernández</p>
      <h3>Retribución Social</h3>
      <p>Larissa Fuentes Machorro</p>
      <h3>Comité</h3>
      <p>En conformación</p>
    </div>
    <div class="merc-intro-img">
      <img src="/wp-content/uploads/cesmeca-legacy/actualizacion_2025/catedra_mercedes_olivera/LOGO.png" alt="Catedra Mercedes Olivera">
    </div>
    <?php
    $intro_html = ob_get_clean();

    return cesmeca_render_gallery_tabs([
        'prefix' => 'merc',
        'intro_html' => $intro_html,
        'tabs' => [
            ['label' => 'Agenda academica', 'type' => 'images', 'items' => $agenda],
            ['label' => 'Videos', 'type' => 'videos', 'items' => $videos],
        ],
    ]);
}
add_shortcode('catedra_mercedes_page','catedra_mercedes_shortcode');
