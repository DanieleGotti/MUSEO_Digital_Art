function animateIcon(element) {
  var img = element.querySelector('img');
  var srcImg = img.src;

  var newGif = srcImg.replace('Statica.png', '.gif');
  var newPng = srcImg.replace('.gif', 'Statica.png');

  if (srcImg.includes('.png')) {
    img.src = newGif;
  }

  if (srcImg.includes('.gif')) {
    img.src = newPng;
  }
}
