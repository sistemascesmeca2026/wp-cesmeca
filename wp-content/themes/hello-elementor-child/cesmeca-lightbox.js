document.addEventListener('DOMContentLoaded', function () {
  var overlay = document.createElement('div');
  overlay.className = 'cesmeca-lightbox-overlay';
  overlay.innerHTML = '<button class="cesmeca-lightbox-close" aria-label="Cerrar">&times;</button>' +
    '<button class="cesmeca-lightbox-prev" aria-label="Anterior">&#8249;</button>' +
    '<img src="" alt="">' +
    '<button class="cesmeca-lightbox-next" aria-label="Siguiente">&#8250;</button>';
  document.body.appendChild(overlay);
  var img = overlay.querySelector('img');
  var lista = [];
  var indice = 0;

  function mostrar(i) {
    indice = (i + lista.length) % lista.length;
    img.src = lista[indice].src;
    img.alt = lista[indice].alt || '';
  }
  function abrir(imagenClic) {
    lista = Array.prototype.slice.call(document.querySelectorAll('img.cesmeca-zoom'));
    indice = lista.indexOf(imagenClic);
    mostrar(indice);
    overlay.classList.add('open');
  }
  function cerrar() {
    overlay.classList.remove('open');
    img.src = '';
  }

  document.addEventListener('click', function (e) {
    if (e.target.matches('img.cesmeca-zoom')) {
      abrir(e.target);
    }
  });
  overlay.addEventListener('click', function (e) {
    if (e.target === overlay || e.target.classList.contains('cesmeca-lightbox-close')) {
      cerrar();
    } else if (e.target.classList.contains('cesmeca-lightbox-prev')) {
      mostrar(indice - 1);
    } else if (e.target.classList.contains('cesmeca-lightbox-next')) {
      mostrar(indice + 1);
    }
  });
  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') cerrar();
    if (e.key === 'ArrowLeft') mostrar(indice - 1);
    if (e.key === 'ArrowRight') mostrar(indice + 1);
  });
});
