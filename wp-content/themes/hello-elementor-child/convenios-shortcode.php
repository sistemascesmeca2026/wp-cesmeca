<?php
function convenios_page_shortcode() {
    $convenios = [
        ['joomla_id'=>567,'title'=>'El Colegio de la Frontera Norte','img'=>'/wp-content/uploads/cesmeca-legacy/2025/20/El_Colegio_Frontera_Norte.jpg','desc'=>'Convenio marco de colaboracion indefinido firmado en febrero de 2013. Gestionado por el CESMECA (Dr. Daniel Villafuerte).'],
        ['joomla_id'=>566,'title'=>'Universidad San Carlos de Guatemala','img'=>'/wp-content/uploads/cesmeca-legacy/2025/20/Univ-San_Carlos_Guatemala.jpg','desc'=>'Carta de entendimiento de cooperacion academica. Deriva del Convenio General de Cooperacion Academico-Cultural de fecha 7 de mayo del 2010 con vigencia indefinida.'],
        ['joomla_id'=>565,'title'=>'Universidad Paulista (Brasil)','img'=>'/wp-content/uploads/cesmeca-legacy/2025/20/U-Paulista.jpg','desc'=>'Acuerdo general de cooperacion internacional. Gestionado por CESMECA (Dr. Martin Lopez). Firmado en 2018 con clausula de renovacion tacita.'],
        ['joomla_id'=>564,'title'=>'Universidad de Varsovia','img'=>'/wp-content/uploads/cesmeca-legacy/2025/20/U-Varsovia.jpg','desc'=>'Convenio marco de colaboracion. Firmado en 2018 con clausula de renovacion tacita por periodos de 5 anos.'],
        ['joomla_id'=>563,'title'=>'Universidad de Alicante','img'=>'/wp-content/uploads/cesmeca-legacy/2025/20/Alicante.jpg','desc'=>'Convenio marco con clausula de renovacion tacita por periodos de 3 anos hasta solicitar por escrito la terminacion.'],
        ['joomla_id'=>562,'title'=>'Universidad Autonoma de Madrid','img'=>'/wp-content/uploads/cesmeca-legacy/2025/20/Aut-Madrid.jpg','desc'=>'Convenio de colaboracion academica y de intercambio para estudiantes y profesores. Vigente 2023-2027.'],
        ['joomla_id'=>561,'title'=>'Secretaria de Seguridad y Proteccion Ciudadana','img'=>'/wp-content/uploads/cesmeca-legacy/2025/20/SSPC.jpg','desc'=>'Convenio marco de colaboracion. Firmado en 2017 con vigencia indefinida.'],
        ['joomla_id'=>560,'title'=>'El Colegio de la Frontera Sur (ECOSUR)','img'=>'/wp-content/uploads/cesmeca-legacy/2025/20/Ecosur.jpg','desc'=>'Carta de intencion para el desarrollo de actividades de colaboracion en docencia y divulgacion academica. Gestionado por el CESMECA. Vigencia indeterminada.'],
    ];
    ob_start();
    ?>
<style>
.conv-grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(260px,1fr));gap:24px;margin-top:8px}
.conv-card{background:#fff;border:1px solid #e5e5e5;border-radius:8px;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.06);transition:transform .2s,box-shadow .2s;display:flex;flex-direction:column}
.conv-card:hover{transform:translateY(-4px);box-shadow:0 6px 20px rgba(0,0,0,.12)}
.conv-card img{width:100%;height:180px;object-fit:cover;display:block}
.conv-card-body{padding:16px;flex:1;display:flex;flex-direction:column}
.conv-card-body h3{font-size:.95rem;font-weight:700;color:#1a1a2e;margin:0 0 10px;line-height:1.4}
.conv-card-body p{font-size:.85rem;color:#555;line-height:1.6;flex:1;margin-bottom:14px}
.conv-card-body a{display:inline-block;padding:7px 16px;background:#1a6fa8;color:#fff;border-radius:4px;font-size:.85rem;text-decoration:none;transition:background .2s}
.conv-card-body a:hover{background:#145a88}
@media(max-width:600px){.conv-grid{grid-template-columns:1fr}}
</style>
<div class="conv-grid">
<?php foreach($convenios as $c):
    $posts = get_posts(['post_type'=>'post','meta_key'=>'_fgj2wp_old_id','meta_value'=>$c['joomla_id'],'numberposts'=>1]);
    $url = !empty($posts) ? get_permalink($posts[0]->ID) : '#';
?>
<div class="conv-card">
    <img src="<?php echo esc_url($c['img']); ?>" alt="<?php echo esc_attr($c['title']); ?>">
    <div class="conv-card-body">
        <h3><?php echo esc_html($c['title']); ?></h3>
        <p><?php echo esc_html($c['desc']); ?></p>
        <a href="<?php echo esc_url($url); ?>">Ver detalles</a>
    </div>
</div>
<?php endforeach; ?>
</div>
<?php
    return ob_get_clean();
}
add_shortcode('convenios_page','convenios_page_shortcode');
