
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


document.addEventListener('click', async (e)=>{
    const target = e.target;
  if(target.tagName === 'BUTTON'){
    e.preventDefault();
    // console.log(target);
    if(target.id === 'addtaskbtn'){
      displayTasks();
    }else{
      // console.log(target)
      await changeState(target);
      // displayTasks();
    };
  }
  
})
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
  const response = await fetch('tasksCrudAsync.php?AddTask=true', {method: "POST", body: formData});

  const responseData = await response.json();

  const taskToDoDiv = document.getElementById('todo');
  const taskProgressDiv = document.getElementById('progress');
  const taskDoneDiv = document.getElementById('done');

  taskToDoDiv.innerHTML = '';
  taskProgressDiv.innerHTML = '';
  taskDoneDiv.innerHTML = '';

  // console.log(responseData);

  responseData.forEach(task => {

    // console.log(task)

    if(task.state === 'todo'){ 

      const taskDiv = `
      <div class="task" style="background-color:${task.color};">
        <p>${task.title}</p>
        <p>${task.description}</p>
        <form action="tasksCrudAsync" method="POST" id="${task.id}">
            <button class="done" value="${task.id}">Done</button>
            <button class="progress" value="${task.id}">In progress</button>
            <button class="delete" value="${task.id}">delete</button>
        </form>
      </div>
      `

      taskToDoDiv.innerHTML += taskDiv
    }

    if(task.state === 'progress'){

      const taskDiv = `
      <div class="task" style="background-color:${task.color};">
        <p>${task.title}</p>
        <p>${task.description}</p>
        <form action="tasksCrudAsync" method="POST" id="${task.id}">
            <button class="done" value="${task.id}">Done</button>
            <button class="todo" value="${task.id}">To Do</button>
            <button class="delete" value="${task.id}">delete</button>
        </form>
      </div>
      `

      taskProgressDiv.innerHTML +=taskDiv
    }

    if(task.state === 'done'){

      const taskDiv = `
      <div class="task" style="background-color:${task.color};">
        <p>${task.title}</p>
        <p>${task.description}</p>
        <form action="tasksCrudAsync" method="POST" id="${task.id}">
            <button class="progress" value="${task.id}">In progress</button>
            <button class="todo" value="${task.id}">To Do</button>
            <button class="delete" value="${task.id}">delete</button>
        </form>
      </div>
      `

      taskDoneDiv.innerHTML +=taskDiv
    }

  });

}

const changeState = async (btn) =>{
    const formState = btn.parentElement;
    const formData = new FormData(formState);
    if (btn.className === 'delete') {
      const response = await fetch('tasksCrudAsync.php?DeleteTask=true&taskId=' + btn.value, {method: "GET",});
      console.log(btn.value);
      formState.parentElement.innerHTML = '';
  } else {
    console.log(btn.value);
      const response = await fetch('tasksCrudAsync.php?ChangeState=true&taskId=' + btn.value + '&state=' + btn.className, {method: "POST", body: formData});
      const responseData = await response.text();

      await displayTasks();
    }
}


if(document.title === 'tasks'){
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
      await displayTasks();
    }else{
      await displayError(form.id);
    }
    
  });
}






////////////////////////////////// Add A list ////////////////////
