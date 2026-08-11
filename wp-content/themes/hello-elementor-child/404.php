<?php
get_header();
?>
<main id="content" class="site-main">
    <div style="max-width:700px; margin:0 auto; padding:80px 20px; text-align:center;">
        <h1 style="font-size:5rem; margin:0; color:#3d8fb5; font-family:'Lora',serif;">404</h1>
        <h2 style="margin:10px 0 20px;">Página no encontrada</h2>
        <p style="color:#555; font-size:1.05rem; line-height:1.6;">
            Lo sentimos, la página que buscas no existe o fue movida.
            Puedes regresar al inicio o explorar alguna de estas secciones:
        </p>
        <div style="margin-top:30px; display:flex; flex-wrap:wrap; gap:12px; justify-content:center;">
            <a href="<?php echo esc_url(home_url('/')); ?>" style="background:#6998b6;color:#fff;padding:10px 20px;border-radius:6px;text-decoration:none;font-weight:600;">Inicio</a>
            <a href="<?php echo esc_url(home_url('/quienes-somos/')); ?>" style="background:#6998b6;color:#fff;padding:10px 20px;border-radius:6px;text-decoration:none;font-weight:600;">Quiénes somos</a>
            <a href="<?php echo esc_url(home_url('/investigacion/')); ?>" style="background:#6998b6;color:#fff;padding:10px 20px;border-radius:6px;text-decoration:none;font-weight:600;">Investigación</a>
            <a href="<?php echo esc_url(home_url('/editorial/publicaciones/')); ?>" style="background:#6998b6;color:#fff;padding:10px 20px;border-radius:6px;text-decoration:none;font-weight:600;">Publicaciones</a>
            <a href="<?php echo esc_url(home_url('/contacto/')); ?>" style="background:#6998b6;color:#fff;padding:10px 20px;border-radius:6px;text-decoration:none;font-weight:600;">Contacto</a>
        </div>
    </div>
</main>
<?php get_footer(); ?>
