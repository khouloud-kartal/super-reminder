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


// // JavaScript to show the pop-up
// document.getElementById("openPopup").addEventListener("click", function() {
//   document.getElementById("popupContainer").style.display = "block";
// });

// // JavaScript to close the pop-up
// document.getElementById("closePopup").addEventListener("click", function() {
//   document.getElementById("popupContainer").style.display = "none";
// });





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

const displayTags = async () =>{

  const formTag = document.getElementById('tags');

  const formData = new FormData(formTag);
  const response = await fetch('tasksCrudAsync.php?display=true', {method: "POST", body: formData});
  const responseData = await response.json();

  console.log(responseData)

  const select = document.getElementById('tagsSelect');

  select.innerHTML = '';

  const message = document.getElementById('message');
  message.innerHTML = '';

  console.log(responseData);

  responseData.forEach(tag => {

    console.log(tag)

    const options = `
    
    <option value="${tag.emoji + tag.name}" class="tag">${tag.emoji + tag.name}</option>
    
    `;

    if(typeof(tag) === 'string'){
      message.innerHTML = tag
    }else{
      select.innerHTML += options;  
    }

  });

}

const displayLists = async () =>{

  const formData = new FormData(form);
  const response = await fetch('tables.php?inscription=true', {method: "POST", body: formData});

  const responseData = await response.json();

  const tableList = document.getElementById('tableList');

  tableList.innerHTML= '';


  const message = document.getElementById('message');
  message.innerHTML = '';

  responseData.forEach(list => {

    const classList = `
    <div class="list">
      <p>${list.title}</p>
      <p>${list.description}</p>
      <button class="addTask" value="${list.id}">+</button>
      <form action="workSpace.php" method="GET" id="${list.id}">
        <button class="delete" value="${list.id}">x</button>
      </form>
    </div>
    
    `
    if(typeof(list) === 'string'){
      message.innerHTML = list
    }else{
      tableList.innerHTML += classList;
    }

    


  });


  displayMembers();

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

  await displayTags();

  const formData = new FormData(form);
  const response = await fetch('tasksCrudAsync.php?AddTask=true', {method: "POST", body: formData});

  const responseData = await response.json();

  const taskToDoDiv = document.getElementById('todo');
  const taskProgressDiv = document.getElementById('progress');
  const taskDoneDiv = document.getElementById('done');

  taskToDoDiv.innerHTML = '';
  taskProgressDiv.innerHTML = '';
  taskDoneDiv.innerHTML = '';

  responseData.forEach(task => {

    const composantes = task.finDate.split("-");

    const annee = composantes[0];
    const mois = composantes[1];
    const jour = composantes[2];

    const dateFormatee = `${jour}/${mois}/${annee}`;

    console.log(task);


    if(task.state === 'todo'){

      const taskDiv = `
      <div class="task" style="border: 3px solid ${task.color};">
        <p>${task.tag}</p>
        <p>${task.title}</p>
        <p>${task.description}</p>
        <p>${dateFormatee}</p>
        <form action="tasksCrudAsync" method="POST" id="${task.id}">
            <button class="done" value="${task.id}">Done</button>
            <button class="progress" value="${task.id}">In progress</button>
            <button class="delete" value="${task.id}">X</button>
        </form>
      </div>
      `

      taskToDoDiv.innerHTML += taskDiv
    }

    if(task.state === 'progress'){

      const taskDiv = `
      <div class="task" style="border: 3px solid ${task.color};">
        <p>${task.tag}</p>
        <p>${task.title}</p>
        <p>${task.description}</p>
        <p>${dateFormatee}</p>
        <form action="tasksCrudAsync" method="POST" id="${task.id}">
            <button class="done" value="${task.id}">Done</button>
            <button class="todo" value="${task.id}">To Do</button>
            <button class="delete" value="${task.id}">X</button>
        </form>
      </div>
      `

      taskProgressDiv.innerHTML +=taskDiv
    }

    if(task.state === 'done'){

      const taskDiv = `
      <div class="task" style="border: 3px solid ${task.color};">
        <p>${task.tag}</p>
        <p>${task.title}</p>
        <p>${task.description}</p>
        <p>${dateFormatee}</p>
        <form action="tasksCrudAsync" method="POST" id="${task.id}">
            <button class="progress" value="${task.id}">In progress</button>
            <button class="todo" value="${task.id}">To Do</button>
            <button class="delete" value="${task.id}">X</button>
        </form>
      </div>
      `

      taskDoneDiv.innerHTML +=taskDiv
    }
  });


  const buttons = document.querySelectorAll('button');

  const button = Array.from(buttons).filter(button => button.id !== 'addtaskbtn');
  const btns = Array.from(button).filter(button => button.id !== 'openPopup');



  console.log(btns)
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

  const message = document.getElementById('message');
  message.innerHTML = '';

  responseData.forEach(workspace => {

    console.log(workspace);

    console.log(typeof(workspace));

    const workspaceList = `
    <div class="workspaceEach">
      <a href="./workspaceLists.php?workspaceId=${workspace.id}&workspaceTitle=${workspace.title}"><p>${workspace.title}</p></a>
      <p>${workspace.description}</p>
      <form action="workSpace.php" method="GET" class="deleteWorkspaceBtn">
          <button type="submit" name="Delete" id="${workspace.id}">X</button>
      </form>
    </div>
    `

    if(typeof(workspace) === 'string'){
      message.innerHTML = workspace
    }else{
      workspaceDiv.innerHTML += workspaceList;
    }
    

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
      formState.parentElement.style.display = 'none';
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
  formState.parentElement.style.display = 'none';
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


const displayMembers = async() =>{
  const formMember = document.getElementById('members');
  const formData = new FormData(formMember);
  const response = await fetch('tables.php?displayMembers=true', {method: "POST", body: formData});

  const responseData = await response.json();
  console.log(responseData);

  const membersUl = document.getElementById('memberList');

  membersUl.innerHTML = '';

  responseData.forEach(member => {
    console.log(member)
    const memberLi = `<li>${member.login}</li>`
    membersUl.innerHTML += memberLi;

  });

  addMember();


}

const addMember = () =>{
  const formMember = document.getElementById('members');
  formMember.addEventListener('submit', async(e) =>{
    e.preventDefault();
    const formData = new FormData(formMember);
    const response = await fetch('tables.php?addMember=true', {method: "POST", body: formData});

    const responseData = await response.text();

    const message = document.getElementById('message1');
    message.innerHTML = '';

    message.innerHTML = responseData

    displayMembers()
  })

}


if(document.title === 'tasks'){
  // JavaScript to show the pop-up
  document.getElementById("openPopup").addEventListener("click", function() {
    document.getElementById("popupContainer").style.display = "block";
  });

  // JavaScript to close the pop-up
  document.getElementById("closePopup").addEventListener("click", function() {
    document.getElementById("popupContainer").style.display = "none";
  });

  displayTasks();

}else if(document.title === 'workspace'){
  displayWorkSpace();
}else if(document.title === 'workspaces'){
  document.getElementById("openPopup").addEventListener("click", function() {
    document.getElementById("popupContainer").style.display = "block";
  });

  // JavaScript to close the pop-up
  document.getElementById("closePopup").addEventListener("click", function() {
    document.getElementById("popupContainer").style.display = "none";
  });

  displayLists();
}

if (form.id) {
  form.addEventListener('submit', async(e) =>{
    e.preventDefault();
    if(form.id === 'tables'){ 
      await displayLists();
    }else if(form.id === 'tasks'){ 
      await displayTasks();
    }else if(form.id === 'workSpace'){
      await displayWorkSpace();
    }else if(form.id === 'workspaces'){
      await displayLists();
    }else{
      await displayError(form.id);
    }
    
  });
}







////////////////////////////////// Add A list ////////////////////
