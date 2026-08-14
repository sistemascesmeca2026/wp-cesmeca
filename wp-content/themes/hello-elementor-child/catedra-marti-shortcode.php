<?php
function catedra_marti_shortcode() {
    $agenda_raw = [
        '/wp-content/uploads/cesmeca-legacy/2014/00/CAtMart20141.jpg',
        '/wp-content/uploads/cesmeca-legacy/2017/00/CAtMart20171.jpg',
        '/wp-content/uploads/cesmeca-legacy/2018/00/CAtMart20181.jpg',
        '/wp-content/uploads/cesmeca-legacy/2018/00/CAtMart20183.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Balam_Rodrigo.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Eckart_Boege.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Enrique_Saforcada.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Fabiola_Escarzaga.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Leticia_Salomn.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Reviviendo_los_sonidos_mayas.png',
        '/wp-content/uploads/cesmeca-legacy/2019/00/memorias-no-antropocentricas-guerra-en-colombia.jpg',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Javier_Vidal_y_Roque_Moreno.jpg',
        '/wp-content/uploads/cesmeca-legacy/2020/08/21/SergioRam-CatedraMart.png',
        '/wp-content/uploads/cesmeca-legacy/2020/10/08/Capitalismo_gore_y_transfeminismos-2020.png',
        '/wp-content/uploads/cesmeca-legacy/2019/00/Conferencia_Hector_Brignoli.jpg',
        '/wp-content/uploads/cesmeca-legacy/2020/12/06/Pablo_pachakuti.png',
    ];
    $agenda = array_map(function($src) { return ['src' => $src, 'alt' => '']; }, $agenda_raw);

    $videos = cesmeca_get_youtube_videos('marti');

    ob_start();
    ?>
    <div class="marti-intro-text">
      <h3>Descripción</h3>
      <p>En enero de 2014 el CESMECA impulsó la creación de la Cátedra de Pensamiento Social José Martí, cuyo objetivo responde al compromiso universitario de fortalecer la vinculación y extensión de los conocimientos, saberes y reflexiones que derivan del pensamiento social, político, cultural y humanístico de Nuestra América-Abya Yala.</p>
      <p>El CESMECA, a través de esta Cátedra de Pensamiento Social y situado desde Centroamérica, el Caribe y el área sur sureste de México, mira, interpela y reflexiona desde una mirada histórica la contemporaneidad de los problemas sociales que aquejan a la región, además de que reconoce críticamente las virtudes de los pensamientos latinoamericanos y caribeños que han tejido la configuración cultural de nuestros pueblos.</p>
      <p>Para ello, impulsa conferencias magistrales, seminarios especializados, coloquios y talleres con destacados intelectuales, académicas y académicos de la región.</p>
      <h3>Coordinador e integrantes</h3>
      <p>Consejo Honorífico:<br>
      Gilberto Valdes (Instituto de Filosofía de La Habana y GALFISA, Cuba)<br>
      Jaime Preciado Coronado (Universidad de Guadalajara, México)<br>
      Luciano Concheiro (Universidad Autónoma de México-Xochimilco, México)<br>
      Sergio Ramírez (Narrador, ensayista, periodista, político y abogado nicaragüense)</p>
    </div>
    <div class="marti-intro-img">
      <img src="/wp-content/uploads/cesmeca-legacy/catedras_laboratorios/Ctedr_Jos_Mart_Negro_Mesa_de_trabajo_1.png" alt="Catedra Jose Marti">
    </div>
    <?php
    $intro_html = ob_get_clean();

    return cesmeca_render_gallery_tabs([
        'prefix' => 'marti',
        'intro_html' => $intro_html,
        'tabs' => [
            ['label' => 'Agenda academica', 'type' => 'images', 'items' => $agenda],
            ['label' => 'Videos', 'type' => 'videos', 'items' => $videos],
        ],
    ]);
}
add_shortcode('catedra_marti_page','catedra_marti_shortcode');
