
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

      if(responseData === 'Vous êtes connecté(e), vous allez être rédiger dans la page d\'acceuil dans 2 secondes.'){
          setTimeout(() => {
              window.location.href = "http://localhost/super-reminder/src/view/index.php";
          }, 2000);
      }
      
      const message = document.getElementById('message');

      message.innerHTML = responseData;        
    
}

const displayLists = async () =>{
  const formData = new FormData(form);
  const response = await fetch('tables.php?inscription=true', {method: "POST", body: formData});

  const responseData = await response.json();

  const tableList = document.getElementById('tableList');

  tableList.innerHTML= '';

  responseData.forEach(list => {

    const lists = document.createElement('div');
    lists.setAttribute('class', 'list');
    
    const title = document.createElement('p');
    title.innerHTML = list.title;
    
    const description = document.createElement('p');
    description.innerHTML = list.description;

    const addTaskbutton = document.createElement('button');
    addTaskbutton.setAttribute('id', 'addTask');
    addTaskbutton.setAttribute('value', list.id);
    addTaskbutton.innerText = 'Add Task';
    addTaskbutton.setAttribute = ('name', 'showTaskForm');

    lists.appendChild(title);
    lists.appendChild(description);
    lists.appendChild(addTaskbutton);
  
    tableList.appendChild(lists);

    addTaskbutton.addEventListener("click", ()=>{
  
      window.location.href = "http://localhost/super-reminder/src/view/tasks.php?listId=" + list.id;
    })
  });

}


const displayTasks = async () =>{
  const formData = new FormData(form);
  const response = await fetch('tasks.php?AddTask=true', {method: "POST", body: formData});

  const responseData = await response.json();

  const taskToDoDiv = document.getElementById('todo');

  taskToDoDiv.innerHTML = '';

  responseData.forEach(task => {

    console.log(task)

    const taskTitle = document.createElement('p');
    taskTitle.innerHTML = task.title;

    const taskDescription = document.createElement('p');
    taskDescription.innerHTML = task.description;

    const btnDiv = document.createElement('div');

    const progressBtn = document.createElement('button');
    progressBtn.setAttribute('class', 'progress');
    progressBtn.setAttribute('value', task.id);
    progressBtn.innerText = 'In progress';

    const doneBtn = document.createElement('button');
    doneBtn.setAttribute('class', 'done');
    doneBtn.setAttribute('value', task.id);
    doneBtn.innerText = 'Done';

    const deleteBtn = document.createElement('button');
    deleteBtn.setAttribute('class', 'delete');
    deleteBtn.setAttribute('value', task.id);
    deleteBtn.innerText = 'Delete';

    btnDiv.appendChild(progressBtn);
    btnDiv.appendChild(doneBtn);
    btnDiv.appendChild(deleteBtn);

    taskToDoDiv.appendChild(taskTitle);
    taskToDoDiv.appendChild(taskDescription);
    taskToDoDiv.appendChild(btnDiv);


  });

}             

if(document.URL === 'http://localhost/super-reminder/src/view/tasks.php?listId=45'){
  displayTasks();
}else{
  displayLists();
}



if (form.id) {
  form.addEventListener('submit', async(e) =>{
    e.preventDefault();
    if(form.id === 'tables'){ 
      await displayLists();
    }else if(form.id === 'tasks'){
      e.preventDefault();
      await displayTasks();
    }else{
      await displayError(form.id);
    }
    
  });
}






////////////////////////////////// Add A list ////////////////////
