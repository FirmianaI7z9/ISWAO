function submit_editorial(p, e) {
  var text = document.getElementById('editorial_text').value;
  if (e == 0 || e == 1) {
    submit(text, p, e);
  }
  else {
    location.href = "/401.html";
  }
}

async function submit(text, p, e) {
  let req = await fetch(`/php/subetr.php`, {
    method: "post",
    headers: {"Content-Type": "application/json"},
    body: JSON.stringify({'text': text, 'id': e})
  }).then(response => {
    //console.log(response.text());
    response.json();
  })
  .then(res => {
    location.href = '?pid=' + p + '&eid=' + e.toString() + '&i=0';
  }).catch(error => {
    //console.log(error);
    location.href = '?pid=' + p + '&eid=' + e.toString() + '&i=1';
  });
}