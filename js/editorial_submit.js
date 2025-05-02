function submit_editorial(p, e, x) {
  var text = document.getElementById('editorial_text').value;
  //console.log(e);
  if (e == 0 || e == 1) {
    submit(text, p, e, x);
  }
}

async function submit(text, p, e, x) {
  let req = await fetch(`/php/subetr.php`, {
    method: "post",
    headers: {"Content-Type": "application/json"},
    body: JSON.stringify({'text': text, 'id': e, 'eid': x})
  }).then(response => {
    //console.log(response.text());
    response.json();
  })
  .then(res => {
    location.href = '?pid=' + p + '&eid=' + x.toString() + '&i=0';
  }).catch(error => {
    //console.log(error);
    location.href = '?pid=' + p + '&eid=' + x.toString() + '&i=1';
  });
}