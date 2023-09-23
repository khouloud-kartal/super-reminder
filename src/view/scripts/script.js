////////////////////////////////////// SideBar /////////////////////////////////


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

    const classList = `
    <div class="list">
      <p>${list.title}</p>
      <p>${list.description}</p>
      <button class="addTask" value="${list.id}">Add Task</button>
      <form action="workSpace.php" method="GET" id="${list.id}">
        <button class="delete" value="${list.id}">Delete</button>
      </form>
    </div>
    
    `

    tableList.innerHTML += classList;


  });

  const addTaskBtn = document.querySelectorAll('.addTask'); 
  addTaskBtn.forEach(btn => {
    btn.addEventListener("click", ()=>{

    window.location.href = "http://localhost/super-reminder/src/view/tasks.php?listId=" + btn.value;
    })
  });


  const Btns = document.querySelectorAll('.delete');
  Btns.forEach(btns => {
    console.log(btns)
    btns.addEventListener('click', (e)=>{
      e.preventDefault();
      console.log(btns)
      deleteList(btns);
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

  const buttons = document.querySelectorAll('button');
  const btns = Array.from(buttons).filter(button => button.id !== 'addtaskbtn');
  btns.forEach(btn => {
    btn.addEventListener('click', (e)=>{
      e.preventDefault();
      changeState(btn);
    })
  });



}


const displayWorkSpace = async (e) =>{
  const formData = new FormData(form);
  const response = await fetch('workSpace.php?display=true', {method: "POST", body: formData});
  const responseData = await response.json();

  const workspaceDiv = document.getElementById('workSpacesDiv');
  workspaceDiv.innerHTML = '';

  responseData.forEach(workspace => {


    console.log(workspace)
    const workspaceList = `
    <div class="workspaceEach">
      <a href="./workspaceLists.php?workspaceId=${workspace.id}&workspaceTitle=${workspace.title}"><p>${workspace.title}</p></a>
      <p>${workspace.description}</p>
      <form action="workSpace.php" method="GET">
          <button type="submit" name="Delete" id="${workspace.id}">X</button>
      </form>
    </div>
    `
    workspaceDiv.innerHTML += workspaceList;

  });

  const buttons = document.querySelectorAll('button');
  const btns = Array.from(buttons).filter(button => button.id !== 'bworkspaceForm');
  btns.forEach(btn => {
    btn.addEventListener('click', (e)=>{
      e.preventDefault();
      console.log(btn);
      deleteWorkspace(btn);
    })
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


const deleteList = async (btn) =>{
  const formState = btn.parentElement;
  const formData = new FormData(formState);
  const response = await fetch('tables.php?DeleteList=true&listId=' + btn.value, {method: "GET",});
  console.log(btn.value);
  formState.parentElement.innerHTML = '';
}

const deleteWorkspace = async (btn) =>{
  const formState = btn.parentElement;
  console.log(formState.parentElement);
  const formData = new FormData(formState);
  const response = await fetch('workSpace.php?DeleteWorkSpace=true&workspaceId=' + btn.id, {method: "GET",});
  formState.parentElement.style.display = 'none';
  formState.parentElement.innerHTML = '';
  
}




if(document.title === 'tasks'){
  displayTasks();  
}else if(document.title === 'workspace'){
  displayWorkSpace();
}else{
  displayLists();
}

console.log(form.id);

if (form.id) {
  form.addEventListener('submit', async(e) =>{
    e.preventDefault();
    if(form.id === 'tables'){ 
      await displayLists();
    }else if(form.id === 'tasks'){
      await displayTasks();
    }else if(form.id === 'workSpace'){
      await displayWorkSpace();
    }else{
      await displayError(form.id);
    }
    
  });
}






////////////////////////////////// Add A list ////////////////////
