const
    // UI  elements
    flashMessage = document.querySelector('#flash-message'),
    clearFile = document.querySelector("#clear-file"),
    file = document.querySelector("#file");

// --------- EVENTS ---------
clearFile.addEventListener('click' ,()=>file.value='');

// --------- INVOCATIONS ---------
if(flashMessage) setTimeout(()=>flashMessage.style.display="none" , 3000)
