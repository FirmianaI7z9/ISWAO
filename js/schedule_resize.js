window.addEventListener('DOMContentLoaded', function() {
  resizewidth();
})

window.addEventListener('resize', function() {
  resizewidth();
});

function resizewidth() {
  var items = document.getElementsByClassName('schedule-right-text');
  items[0].style = "";
  var size = window.getComputedStyle(items[0]);
  var basewidth = Number(size.width.substring(0, size.width.length - 2));
  var canvas = document.createElement('canvas');
  var context = canvas.getContext('2d');
  context.font = '18px \'Noto Sans JP\', sans-serif';
  for (let i = 0; i < items.length; i++) {
    var metrics = context.measureText(items[i].innerText);
    var width = metrics.width;
    items[i].style = "width: " + (Math.max(100, width * 1.0 / basewidth * 100) + 1).toFixed(2) + "%; transform: scaleX(" + (Math.min(1.0000, basewidth * 0.99 / width)).toFixed(4) + ");";
  }
}