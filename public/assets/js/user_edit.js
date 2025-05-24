const
    //UI Element
    flashMessage = document.querySelector('#flash-message'),
    profileImage = document.querySelector('#profile-image'),
    newImageButton = document.querySelector('#new-image-button'),
    imageFile = document.querySelector('#image-file'),
    currentImageUrl = profileImage.src;
let
    lastImageValue='';

// ##### EVENTS #####
newImageButton.addEventListener('click', handleNewImageButtonClick );
imageFile.addEventListener('change', handleImageFileClick );

// ##### EVENTS HANDLERS #####
function handleNewImageButtonClick() {
    imageFile.click();
}

function handleImageFileClick (){
    image = imageFile.files[0];
    if(image && (image.type == 'image/jpeg' || image.type == 'image/png')){
        profileImage.src= URL.createObjectURL(image);
        lastImageValue= imageFile.value;
    }else {
        alert('Please select a valid image file (JPEG or PNG).');
        profileImage.src= currentImageUrl;
        imageFile.files= null;
        imageFile.value='';
    }
}

// ##### INVOCATION #####
if(flashMessage) setTimeout(()=>flashMessage.style.display="none" , 3000)
