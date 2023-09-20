
function myAccFunc() {
    var x = document.getElementById("demoAcc");
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
      x.previousElementSibling.className += " w3-green";
    } else { 
      x.className = x.className.replace(" w3-show", "");
      x.previousElementSibling.className = 
      x.previousElementSibling.className.replace(" w3-green", "");
    }
  }
  
  function myDropFunc() {
    var x = document.getElementById("demoDrop");
    if (x.className.indexOf("w3-show") == -1) {
      x.className += " w3-show";
      x.previousElementSibling.className += " w3-green";
    } else { 
      x.className = x.className.replace(" w3-show", "");
      x.previousElementSibling.className = 
      x.previousElementSibling.className.replace(" w3-green", "");
    }
  }
////////////////////////////////////// Display Error /////////////////////////////////

const form = document.querySelector('form');

const displayError = async ($id) =>{ 
    const formData = new FormData(form);
    const response = await fetch($id + '.php?inscription=true', {method: "POST", body: formData});
    const responseData = await response.text();
    console.log(responseData);

    if(responseData === 'Vous êtes connecté(e), vous allez être rédiger dans la page d\'acceuil dans 2 secondes.'){
        setTimeout(() => {
            // window.location.href = "http://localhost/github/moduleconnexion-b2/view/index.php";
        }, 2000);
    }

    const message = document.getElementById('message');

    message.innerHTML = responseData;
}

if (form) {
  form.addEventListener('submit', async(e) =>{
    e.preventDefault();
    await displayError(form.id);
  });
}



////////////////////////////////// Add A list ////////////////////

const formList = document.getElementById('')