const
    // UI  elements
    flashMessage = document.querySelector('#flash-message'),
    clearFile = document.querySelector("#clear-file"),
    file = document.querySelector("#file"),
    deleteFileButton = document.querySelector("#delete-file-btn"),
    deleteFileValue= document.querySelector("#delete-file-value"),
    fileAttachedBox = document.querySelector("#file-attached-box");

// --------- EVENTS ---------
clearFile.addEventListener('click' ,()=>file.value='');
deleteFileButton.addEventListener('click', handleChangeFile);
file.addEventListener('change', handleChangeFile);


// --------- EVENTS HANDLER ---------
function handleChangeFile() {
    if (fileAttachedBox) {
        fileAttachedBox.style.display = 'none';
        deleteFileValue.value = 'true';
    }
}

// --------- INVOCATIONS ---------
if(flashMessage) setTimeout(()=>flashMessage.style.display="none" , 3000)



