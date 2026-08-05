<?php
function contacto_page_shortcode() {
    ob_start();
    ?>
<style>
.ctc-wrap{max-width:960px;margin:0 auto;padding:10px 0}
.ctc-wrap h1{font-size:1.6rem;color:#1a1a2e;margin-bottom:8px}
.ctc-wrap h2{font-size:1.1rem;color:#555;font-weight:400;margin-bottom:24px;padding-bottom:8px;border-bottom:2px solid #2563eb;display:inline-block}
.ctc-map{width:100%;height:420px;border:0;border-radius:6px;margin-bottom:36px;display:block}
.ctc-cards{display:grid;grid-template-columns:repeat(3,1fr);gap:16px;margin-bottom:16px}
.ctc-card{background:#f5f6f7;border-radius:8px;padding:28px 20px;text-align:center}
.ctc-card-icon{font-size:2rem;margin-bottom:12px;color:#2563eb}
.ctc-card h3{font-size:1rem;color:#1a1a2e;margin-bottom:8px;font-weight:600}
.ctc-card p,.ctc-card a{font-size:.9rem;color:#555;line-height:1.6;text-decoration:none}
.ctc-card a:hover{color:#2563eb}
.ctc-card-qr img{width:130px;height:130px;object-fit:contain}
.ctc-social-icon{font-size:2rem;margin-bottom:12px}
.ctc-fb{color:#1877f2}.ctc-yt{color:#ff0000}.ctc-tw{color:#1da1f2}.ctc-ig{color:#c13584}
@media(max-width:768px){.ctc-cards{grid-template-columns:1fr}.ctc-map{height:300px}}
</style>

<div class="ctc-wrap">
  
  <h2>Nuestra ubicación</h2>

  <iframe class="ctc-map"
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7641.208695832634!2d-92.6564818231082!3d16.74658192094562!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85ed450418ea0ff5%3A0x185d96899dd62b57!2sUNICACH%20-%20CESMECA%20Centro%20de%20Estudios%20Superiores%20de%20M%C3%A9xico%20y%20Centroam%C3%A9rica!5e0!3m2!1ses-419!2smx!4v1785273244642!5m2!1ses-419!2smx"
    allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin">
  </iframe>

  <div class="ctc-cards">
    <div class="ctc-card">
      <div class="ctc-card-icon">📞</div>
      <h3>Llámanos</h3>
      <p>Tel: (+52) 967-6786921<br>967-1120483<br>967-1120484<br>967-1120485</p>
    </div>
    <div class="ctc-card">
      <div class="ctc-card-icon">📍</div>
      <h3>Dirección</h3>
      <p>Calle Bugambilia #30, Fracc. La Buena Esperanza, manzana 17,<br>San Cristóbal de Las Casas, Chiapas.<br>C.P. 29243</p>
    </div>
    <div class="ctc-card">
      <div class="ctc-card-icon">✉️</div>
      <h3>E-mail</h3>
      <p><a href="mailto:cesmeca@unicach.mx">cesmeca@unicach.mx</a></p>
    </div>
  </div>

  <div class="ctc-cards">
    <div class="ctc-card">
      
      <div class="ctc-card-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="#1877f2"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
      </div>
      <h3>Síguenos</h3>
      <p><a href="https://www.facebook.com/Cesmeca/" target="_blank">Cesmeca</a></p>
    </div>
    <div class="ctc-card ctc-card-qr">
      <img src="https://api.qrserver.com/v1/create-qr-code/?size=130x130&data=https://cesmeca.mx" alt="QR CESMECA">
    </div>
    <div class="ctc-card">
      <div class="ctc-card-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="#ff0000"><path d="M23.495 6.205a3.007 3.007 0 0 0-2.088-2.088c-1.87-.501-9.396-.501-9.396-.501s-7.507-.01-9.396.501A3.007 3.007 0 0 0 .527 6.205a31.247 31.247 0 0 0-.522 5.805 31.247 31.247 0 0 0 .522 5.783 3.007 3.007 0 0 0 2.088 2.088c1.868.502 9.396.502 9.396.502s7.506 0 9.396-.502a3.007 3.007 0 0 0 2.088-2.088 31.247 31.247 0 0 0 .5-5.783 31.247 31.247 0 0 0-.5-5.805zM9.609 15.601V8.408l6.264 3.602z"/></svg>
      </div>
      <h3>Suscríbete</h3>
      <p><a href="https://www.youtube.com/@cesmeca-unicachoficial1445" target="_blank">Cesmeca</a></p>
    </div>
  </div>

  <div class="ctc-cards">
    <div class="ctc-card">
      <div class="ctc-card-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="#1da1f2"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
      </div>
      <h3>Síguenos</h3>
      <p><a href="https://twitter.com/cesmeca" target="_blank">Cesmeca</a></p>
    </div>
    <div class="ctc-card"></div>
    <div class="ctc-card">
      <div class="ctc-card-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="#c13584"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
      </div>
      <h3>Síguenos</h3>
      <p><a href="https://www.instagram.com/cesmeca/" target="_blank">Cesmeca</a></p>
    </div>
  </div>
</div>
    <?php
    return ob_get_clean();
}
add_shortcode('contacto_page', 'contacto_page_shortcode');
