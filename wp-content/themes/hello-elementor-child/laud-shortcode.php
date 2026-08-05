<?php
add_shortcode('laud_page', function() {
    $base = '/wp-content/uploads/2026/06';
    $imgs_raw = [
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
    $imgs = array_map(function($img) use ($base) {
        return ['src' => $base . '/' . $img, 'alt' => ''];
    }, $imgs_raw);

    $videos_raw = [
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
    $videos = array_map(function($v) {
        return ['id' => $v[0], 'title' => $v[1]];
    }, $videos_raw);

    return cesmeca_render_gallery_tabs([
        'prefix' => 'laud',
        'tabs' => [
            ['label' => 'Agenda académica', 'type' => 'images', 'items' => $imgs],
            ['label' => 'Videos', 'type' => 'videos', 'items' => $videos],
        ],
    ]);
});
