// the intex of the currently displayed page
var current_page = 0;
// the index of the final page
var max_page = 0;
// the number of information
var max_count = 0;
// the number of information per a page
var page_num = 20;

window.addEventListener("DOMContentLoaded", function (){
  getmaxpage();
});

// move page
// d : the number of move pages, integer between -2 and 2
function movepage(d) {
  if (current_page + d < 0) {
    current_page = 0;
  }
  else if (current_page + d > max_page) {
    current_page = max_page;
  }
  else {
    current_page += d;
  }
  setbuttons();
  getinfo();
}

// update buttons' texts
function setbuttons() {
  var buttons = document.getElementsByClassName('pagebutton');
  for (let i = 0; i < buttons.length; i++) {
    if (current_page + i - 2 < 0 || current_page + i - 2 > max_page) {
      buttons[i].disabled = true;
      buttons[i].innerText = '';
    }
    else {
      buttons[i].disabled = false;
      // displayed page indexes begin from 1
      buttons[i].innerText = current_page + i - 1;
    } 
  }
}

// get number of information from database and calculate max_page
async function getmaxpage() {
  let req = await fetch(`php/gmp.php`, {
    method: "get",
    headers: {"Content-Type": "application/json"}
  }).then(response => response.json())
  .then(res => {
    max_count = res['count'];
    // page indexes begin from 0
    max_page = Math.ceil((Math.max(res['count'], 1) - 1) / page_num);
    setbuttons();
  }).catch(error => {
    console.log(error);
  });
}

// get 20 sets of information
async function getinfo() {
  let req = await fetch(`php/gi.php`, {
    method: "post",
    headers: {"Content-Type": "application/json"},
    body: JSON.stringify({'page': current_page, 'max': max_count, 'genre': 'all'})
  }).then(response => response.json())
  .then(res => {
    // information container
    var container = document.getElementsByClassName('basic-container')[0];
    container.innerHTML = res;
  }).catch(error => {
    console.log(error);
  });
}