function flexTextarea(el) {
  const dummy = el.querySelector('.edit-textarea-dummy');
  el.querySelector('.edit-textarea').addEventListener('input', e => {
    dummy.textContent = e.target.value + '\u200b';
  });
}

document.addEventListener("DOMContentLoaded", () => {
  var items = document.getElementsByClassName("edit-textarea-container");
  for (let i = 0; i < items.length; i++) {
    flexTextarea(items[i]);
  }
});
