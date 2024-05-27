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

document.addEventListener('DOMContentLoaded', function () {
  const inputs = document.querySelectorAll('.input');

  inputs.forEach(function (input) {
    input.addEventListener('input', function () {
      if (input.value !== '') {
        input.classList.add('notEmpty');
      } else {
        input.classList.remove('notEmpty');
      }
    });
  });
});

document.addEventListener('DOMContentLoaded', function () {
  const inputs = document.querySelectorAll('.inputPop');

  inputs.forEach(function (input) {
    input.addEventListener('input', function () {
      if (input.value !== '') {
        input.classList.add('notEmpty');
      } else {
        input.classList.remove('notEmpty');
      }
    });
  });
});
