<?php
function reveldia_page_shortcode() {
    $base = '/wp-content/uploads/cesmeca-legacy/';
    $to_items = function($arr) use ($base) {
        return array_map(function($p) use ($base) { return ['src' => $base . $p, 'alt' => '']; }, $arr);
    };

    $gal2021 = $to_items([
        'actualizacion_2025/seminario_reveldia/actividades_2021/Ana_Mara_Castro.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/Astrid_Cuero_Modulo1.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/Delmy_Tania_Cruz.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/DiplomadSembrarR1.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/DiplomadSembrarR21.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/Julia_Antivilo.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/Mara_Jos_Perez.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/Marcela.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/Natalia_Cabanillas.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/Ochy_Curiel.png',
        'actualizacion_2025/seminario_reveldia/actividades_2021/Odette_Fajardo.png',
    ]);
    $gal2022 = $to_items([
        'actualizacion_2025/seminario_reveldia/actividades_2022/2_Ochy_Curiel.png',
        'actualizacion_2025/seminario_reveldia/actividades_2022/3_Msicas_y_bailarinas_de_tango.png',
        'actualizacion_2025/seminario_reveldia/actividades_2022/4_Montserrat_Aguilar.png',
        'actualizacion_2025/seminario_reveldia/actividades_2022/5_Marlene_Vizuet.png',
        'actualizacion_2025/seminario_reveldia/actividades_2022/6_Tania_Prez_Bustos.png',
        'actualizacion_2025/seminario_reveldia/actividades_2022/Eli_Bartraig.png',
        'actualizacion_2025/seminario_reveldia/actividades_2022/Sembrar_Revelda_IG.png',
        'actualizacion_2025/seminario_reveldia/actividades_2022/Seminario-SembrarR2022.png',
    ]);
    $gal2024 = $to_items([
        'actualizacion_2025/seminario_reveldia/actividades_2024/General.jpg',
        'actualizacion_2025/seminario_reveldia/actividades_2024/Ali_Aguilera.png',
        'actualizacion_2025/seminario_reveldia/actividades_2024/Annaliesse_Hurtado.png',
        'actualizacion_2025/seminario_reveldia/actividades_2024/Daniela_Castillo.png',
        'actualizacion_2025/seminario_reveldia/actividades_2024/Marisol_Anzo.png',
        'actualizacion_2025/seminario_reveldia/actividades_2024/Mary_Nelsy_Valero.png',
    ]);
    $gal2025 = $to_items([
        'actualizacion_2025/seminario_reveldia/actividades_2025/Cartel_general.jpg',
        'actualizacion_2025/seminario_reveldia/actividades_2025/Diana_Gmez_Correal.png',
        'actualizacion_2025/seminario_reveldia/actividades_2025/General_2.jpg',
        'actualizacion_2025/seminario_reveldia/actividades_2025/Teresa_Fernndez.png',
    ]);

    ob_start();
    ?>
    <div class="rev-intro-text">
      <p>Seminario Permanente de Investigación Feminista "Sembrar ReVeldía" busca dar a conocer a la comunidad académica y militante del sureste mexicano diversas trayectorias investigativas, así como investigaciones concluidas o en curso, que aporten lineamientos para nutrir las discusiones que sentipensamos como necesarias en nuestro contexto actual.</p>
      <p>Este seminario convoca al diálogo entre académicas de alto nivel, estudiantes del Posgrado en Estudios e Intervención Feministas, así como otras personas interesadas en adquirir herramientas para la investigación-acción feminista desde una perspectiva del Sur.</p>
      <h3>Objetivos</h3>
      <p>1. Construir una plataforma de difusion y divulgacion para la comunidad de feministas del Sur, para dar cuenta del estado actual del arte de la investigacion feminista de Chiapas, Centroamerica y Latinoamerica.<br>
      2. Aportar a la construccion de redes de conocimiento, accion politica y acuerpamiento que incluya estudiantes, investigadoras y activistas de Chiapas, Centroamerica y Latinoamerica.</p>
      <h3>Sesiones</h3>
      <p><strong>Diplomado: Del 11 de marzo al 13 de mayo 2021</strong><br>Coordinacion: Dra. Maria Teresa Garzon Martinez</p>
      <p><strong>Segunda emision: Del 11 de marzo al 13 de mayo de 2022</strong><br>Coordinacion: Dra. Maria Teresa Garzon Martinez</p>
      <p><strong>Tercera emision: Del 23 de septiembre al 21 de octubre de 2024</strong><br>Coordinacion: Dra. Marcela Fernandez Camacho</p>
      <p><strong>Cuarta emision: Del 4 al 25 de noviembre de 2025</strong><br>Coordinadores: Dra. Tesa Garzon, Dra. Karla Somosa, Dr. Armando Mendez</p>
    </div>
    <div class="rev-intro-img">
      <img src="/wp-content/uploads/cesmeca-legacy/actualizacion_2025/seminario_reveldia/LogoSembrarRV25.png" alt="Sembrar ReVeldia">
    </div>
    <?php
    $intro_html = ob_get_clean();

    return cesmeca_render_gallery_tabs([
        'prefix' => 'rev',
        'intro_html' => $intro_html,
        'tabs' => [
            ['label' => 'Actividad 2021', 'type' => 'images', 'items' => $gal2021],
            ['label' => 'Actividad 2022', 'type' => 'images', 'items' => $gal2022],
            ['label' => 'Actividad 2024', 'type' => 'images', 'items' => $gal2024],
            ['label' => 'Actividad 2025', 'type' => 'images', 'items' => $gal2025],
        ],
    ]);
}
add_shortcode('reveldia_page','reveldia_page_shortcode');
