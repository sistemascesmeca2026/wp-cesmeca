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

    $videos_raw = [
        ['lL4eo4I6bx0','Horizontes comunitario-populares en tension. Estado Plurinacional en Bolivia'],
        ['93rtxwLz9f4','El espacio centroamericano, del siglo XVI al XXI. Transformaciones y utopias'],
        ['Ghtpy8fO3As','Pueblos originarios y patrimonio biocultural: claves para entender el contexto ambiental actual'],
        ['iegAIbA-3H0','(In)Gobernabilidad democratica y crisis social en Honduras y Centroamerica'],
        ['txTbuh_kj3c','El paradigma multidisciplinar de la salud comunitaria en America Latina'],
        ['RdtuzpmAuAo','La comunidad indigena insurgente. Peru, Bolivia y Mexico (1980-2000)'],
        ['62dDU2IjejA','Conversatorio con Jaime Preciado Coronado'],
        ['yPYCz93IykA','El legado politico e intelectual de Frantz Fanon'],
        ['x2KkSYReHL4','El Acontecimiento del 1 de julio: Mexico hacia una Cuarta Transformacion?'],
        ['8814fak8eVo','Territorialidades indigenas. Experiencias de resistencia en America Latina/Abya Yala'],
        ['QBH5pzwDbeU','Configuraciones culturales y teoria de la hegemonia en America Latina'],
        ['8NptIcNtETg','El quiebre del horizonte de la integracion autonoma en America Latina y el Caribe'],
        ['waZJlzJygxM','Conversatorio Bolivia en la coyuntura politica contemporanea'],
        ['xjU0Jw7thsU','Conversatorio con Sergio Ramirez: El acto de la escritura en Centroamerica'],
    ];
    $videos = array_map(function($v) { return ['id' => $v[0], 'title' => $v[1]]; }, $videos_raw);

    ob_start();
    ?>
    <div class="marti-intro-text">
      <h3>Descripcion</h3>
      <p>En enero de 2014 el CESMECA impulso la creacion de la Catedra de Pensamiento Social Jose Marti, cuyo objetivo responde al compromiso universitario de fortalecer la vinculacion y extension de los conocimientos, saberes y reflexiones que derivan del pensamiento social, politico, cultural y humanistico de Nuestra America-Abya Yala.</p>
      <p>El CESMECA, a traves de esta Catedra de Pensamiento Social y situado desde Centroamerica, el Caribe y el area sur sureste de Mexico, mira, interpela y reflexiona desde una mirada historica la contemporaneidad de los problemas sociales que aquejan a la region, ademas de que reconoce criticamente las virtudes de los pensamientos latinoamericanos y caribenos que han tejido la configuracion cultural de nuestros pueblos.</p>
      <p>Para ello, impulsa conferencias magistrales, seminarios especializados, coloquios y talleres con destacados intelectuales, academicas y academicos de la region.</p>
      <h3>Coordinador e integrantes</h3>
      <p>Consejo Honorifico:<br>
      Gilberto Valdes (Instituto de Filosofia de La Habana y GALFISA, Cuba)<br>
      Jaime Preciado Coronado (Universidad de Guadalajara, Mexico)<br>
      Luciano Concheiro (Universidad Autonoma de Mexico-Xochimilco, Mexico)<br>
      Sergio Ramirez (Narrador, ensayista, periodista, politico y abogado nicaraguense)</p>
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
