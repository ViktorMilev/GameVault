import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap/dist/js/bootstrap.bundle.min.js';

document.querySelectorAll('.dropdown-submenu > a').forEach(el => {
  el.addEventListener('click', function (e) {
    e.preventDefault();
    const next = el.nextElementSibling;
    if (next && next.classList.contains('dropdown-menu')) {
      next.classList.toggle('show');
    }
  });
});