$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


document.querySelectorAll('.dropdown-submenu > a').forEach(el => {
  el.addEventListener('click', function (e) {
    e.preventDefault();
    const next = el.nextElementSibling;
    if (next && next.classList.contains('dropdown-menu')) {
      next.classList.toggle('show');
    }
  });
});

document.addEventListener('DOMContentLoaded', () => {
  const input = document.querySelector('#navbar-searchbar-input');
  if (!input) return;

  const resultsContainer = document.getElementById('navbar-searchbar-results');
  if (!resultsContainer) return;    

  
  input.addEventListener('input', function (e) {  
    const query = e.target.value.trim();

    if (!query) {
      resultsContainer.style.display = 'none';
      resultsContainer.innerHTML = '';
      return;
    }

    $.ajax({
      type: 'POST',
      url: '/ajax-search',
      data: {
        query: query,
      },
      success: function (games) {
        resultsContainer.innerHTML = '';
        
        if (games.length === 0) {
          resultsContainer.innerHTML = '<li class="list-group-item text-muted">Не бяха намерени резултати. Моля, опитайте отново</li>';
        } else {
          games.forEach(game => {
            const li = document.createElement('li');
            li.className = 'list-group-item';
            li.textContent = game.name;

            li.addEventListener('click', function() {
              e.target.value = game.name;
              resultsContainer.style.display = 'none';
              resultsContainer.innerHTML = '';
              e.target.closest('form').submit();
            });

            resultsContainer.appendChild(li);
          });
        }

        resultsContainer.style.display = 'block';
      },
      error: function(err) {
        console.error('AJAX error:', err);
      }
    });
  });
});