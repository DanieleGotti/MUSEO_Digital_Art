let isExpanded = true;

function moveFilters() {
  const box = document.getElementById('filtri');
  const table = document.getElementById('result');

  if (isExpanded) {
      box.style.width = '0rem';
      table.style.marginLeft = '4rem';
  } else {
      box.style.width = '12rem';
      table.style.marginLeft = '14rem';
  }
  isExpanded = !isExpanded;
}
