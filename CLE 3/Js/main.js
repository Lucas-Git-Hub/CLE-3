window.addEventListener('load',init);

let shows = ["Testshow1","Testshow2","Testshow3","Testshow4"];
let codes = ['5231','213','12313','1232'];
let currentClickedImage;
let playField;

//Initialize after the DOM is ready
function init(){
    playField = document.getElementById('playing-field');
    playField.addEventListener('click', playingFieldClickHandler);

    createPlayField();
}

//Make a list of shows
function createPlayField(){
    for (let i = 0; i < shows.length; i++){
        //Main Element
        let curtain = document.createElement('div');
        curtain.classList.add('polaroid');

        //2 Subelements, a title and a picture
        let img = document.createElement('img');
        img.setAttribute('src', '../img/gordijn.jpg');
        img.dataset.index = i.toString();
        curtain.appendChild(img);

        let title = document.createElement('div');
        title.innerHTML = shows[i]
        title.classList.add('container');
        curtain.appendChild(title);

        //Add all
        playField.appendChild(curtain);
    }
}

//Make the pictures of shows clickable and shows code
function playingFieldClickHandler(e){
    //Check if its and image otherwise stop function
    if (e.target.nodeName !== "IMG"){
        return;
    }

    //If something already was clicked, set it back to the curtain
    if (currentClickedImage) {
        currentClickedImage.setAttribute('src','../img/gordijn.jpg');
    }

    //Show code if clicked on the image
    let code = e.target;
    let codeIndex = code.dataset.index;
    code.setAttribute('code',codes[codeIndex])

    //Save code
    currentClickedImage = code;
    console.log(currentClickedImage);
}