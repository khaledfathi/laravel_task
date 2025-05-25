const
    // UI  elements
    flashMessage = document.querySelector('#flash-message'),
    clearFile = document.querySelector("#clear-file"),
    file = document.querySelector("#file"),
    orderByDateSelect = document.querySelector("#order-by-date-select"),
    orderFormSubmitButton = document.querySelector("#order-form-submit");

// --------- EVENTS ---------
clearFile.addEventListener('click' ,()=>file.value='');

orderByDateSelect.addEventListener('change', (e) => {
    orderFormSubmitButton.click();
});

// --------- INVOCATIONS ---------
if(flashMessage) setTimeout(()=>flashMessage.style.display="none" , 3000)
