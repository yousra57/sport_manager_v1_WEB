const domicile = document.getElementById('equipe_domicile');
const exterieure = document.getElementById('equipe_exterieure');

function mettreAJourOptions() {
  const idDomicile = domicile.value;
  const idExterieure = exterieure.value;

  for (const option of exterieure.options) {
    option.disabled = option.value !== '' && option.value === idDomicile;
  }

  for (const option of domicile.options) {
    option.disabled = option.value !== '' && option.value === idExterieure;
  }
}

domicile.addEventListener('change', mettreAJourOptions);
exterieure.addEventListener('change', mettreAJourOptions);
mettreAJourOptions();