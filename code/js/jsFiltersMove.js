let isExpanded = false;

function moveFilters() {
  const box = document.getElementById('filtri');

  if (isExpanded) {
      box.style.width = '0rem';
  } else {
      box.style.width = '14rem';
  }
  isExpanded = !isExpanded;
}
