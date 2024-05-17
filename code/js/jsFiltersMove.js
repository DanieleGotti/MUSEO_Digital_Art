function moveFilters() {
  let isExpanded = false;
  const box = document.getElementById('filtri');

  if (isExpanded) {
      box.style.width = '1rem';
  } else {
      box.style.width = '14rem';
  }
  isExpanded = !isExpanded;
}
