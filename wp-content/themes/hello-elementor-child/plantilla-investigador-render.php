<?php
get_header();
while (have_posts()): the_post();
    $post_id = get_the_ID();
    $campos = [
        'perfil' => ['label' => 'Perfil', 'class' => 'accent'],
        'lineas_investigacion' => ['label' => 'Líneas de investigación', 'class' => 'success'],
        'proyectos_investigacion' => ['label' => 'Proyectos de investigación', 'class' => 'warning'],
        'publicaciones' => ['label' => 'Algunas publicaciones', 'class' => 'pro'],
        'correo' => ['label' => 'Correo electrónico', 'class' => 'coral'],
        'cooperacion_interinstitucional' => ['label' => 'Cooperación interinstitucional', 'class' => 'teal'],
    ];
    ?>
    <style>
    .inv-wrap{max-width:960px;margin:0 auto;padding:20px 24px}
    .inv-header{display:flex;gap:28px;align-items:center;margin-bottom:28px;padding-bottom:24px;border-bottom:1px solid #e5e5e5}
    .inv-photo{width:180px;height:180px;border-radius:50%;object-fit:cover;flex-shrink:0}
    .inv-photo-placeholder{width:180px;height:180px;border-radius:50%;background:#e5e5e5;flex-shrink:0}
    .inv-name{font-size:1.7rem;font-weight:600;color:#1a1a2e;margin:0;line-height:1.3}
    .inv-badge{display:inline-block;font-size:.75rem;font-weight:600;letter-spacing:.03em;padding:5px 14px;border-radius:20px;margin-bottom:10px;text-transform:uppercase}
    .inv-badge-accent{background:#e6f1fb;color:#0c447c}
    .inv-badge-success{background:#eaf3de;color:#27500a}
    .inv-badge-warning{background:#faeeda;color:#633806}
    .inv-badge-pro{background:#eeedfe;color:#3c3489}
    .inv-badge-coral{background:#faece7;color:#712b13}
    .inv-badge-teal{background:#e1f5ee;color:#085041}
    .inv-field{margin-bottom:26px}
    .inv-field p{font-size:.97rem;line-height:1.65;color:#333;margin:0 0 10px;text-align:justify}
.inv-field p:last-child{margin-bottom:0}
    .inv-field a{color:#2563eb}
    @media(max-width:768px){.inv-wrap{padding:16px 20px}}
    @media(max-width:640px){.inv-header{flex-direction:column;align-items:center;text-align:center}.inv-wrap{padding:14px 16px}}
    </style>
    <div class="inv-wrap">
        <div class="inv-header">
            <?php if (has_post_thumbnail()): ?>
                <img class="inv-photo" src="<?php echo esc_url(get_the_post_thumbnail_url($post_id, 'medium')); ?>" alt="<?php the_title_attribute(); ?>">
            <?php else: ?>
                <div class="inv-photo-placeholder"></div>
            <?php endif; ?>
            <h1 class="inv-name"><?php the_title(); ?></h1>
        </div>
        <?php foreach ($campos as $key => $c):
            $valor = get_post_meta($post_id, '_inv_' . $key, true);
            if (empty(trim($valor))) continue;
            ?>
            <div class="inv-field">
                <span class="inv-badge inv-badge-<?php echo esc_attr($c['class']); ?>"><?php echo esc_html($c['label']); ?></span>
                <?php if ($key === 'correo'): ?>
                    <p><a href="mailto:<?php echo esc_attr($valor); ?>"><?php echo esc_html($valor); ?></a></p>
                <?php else:
                    $lineas = preg_split('/\n+/', trim($valor));
                    foreach ($lineas as $linea):
                        $linea = trim($linea);
                        if ($linea === '') continue;
                ?>
                    <p><?php echo wp_kses_post($linea); ?></p>
                <?php endforeach;
                endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
endwhile;
get_footer();
