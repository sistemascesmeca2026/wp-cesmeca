<?php
add_shortcode('laud_page', function() {
    $imgs = cesmeca_get_galeria_imagenes('laud');
    $videos = cesmeca_get_youtube_videos('laud');
    return cesmeca_render_gallery_tabs([
        'prefix' => 'laud',
        'tabs' => [
            ['label' => 'Agenda académica', 'type' => 'images', 'items' => $imgs],
            ['label' => 'Videos', 'type' => 'videos', 'items' => $videos],
        ],
    ]);
});
