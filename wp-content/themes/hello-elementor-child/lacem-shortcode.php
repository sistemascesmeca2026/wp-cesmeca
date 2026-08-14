<?php
function lacem_page_shortcode() {
    $eventos = [];
    $joomla_ids = [456, 455, 443];
    $portadas_lacem = [456=>'/wp-content/uploads/cesmeca-legacy/LACEM/2.png',455=>'/wp-content/uploads/cesmeca-legacy/LACEM/3.png',443=>'/wp-content/uploads/cesmeca-legacy/LACEM/peten.png'];
    foreach ($joomla_ids as $jid) {
        $posts = get_posts(['post_type'=>'post','meta_key'=>'_fgj2wp_old_id','meta_value'=>$jid,'numberposts'=>1]);
        if (!empty($posts)) $eventos[] = ['post' => $posts[0], 'thumb' => $portadas_lacem[$jid] ?? ''];
    }

    $actividades_2023 = cesmeca_get_galeria_imagenes('lacem', 'actividades-2023');
    $actividades_2021 = cesmeca_get_galeria_imagenes('lacem', 'actividades-2021');

    $todos_videos = cesmeca_get_youtube_videos('lacem');
    $videos_2023 = array_values(array_filter($todos_videos, function($v) {
        $year = $v['published'] ? (int) substr($v['published'], 0, 4) : 0;
        return $year >= 2022 && $year <= 2023;
    }));
    $videos_2021 = array_values(array_filter($todos_videos, function($v) {
        $year = $v['published'] ? (int) substr($v['published'], 0, 4) : 0;
        return $year >= 2015 && $year <= 2021;
    }));

    return cesmeca_render_gallery_tabs([
        'prefix' => 'lacem',
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
