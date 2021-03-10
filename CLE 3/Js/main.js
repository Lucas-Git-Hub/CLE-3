window.addEventListener('load',init);

let codes = [1,2,3,4]
let currentClickedImage;
let playField;

//Initialize after the DOM is ready
function init(){
    playField = document.getElementById('playing-field');
    playField.addEventListener('click',playingFieldClickHandler);

    createPlayField();
}

//Make a list of shows
function createPlayField(){
    for (let i = 0; i < codes.length; i++){
        //Main Element
        let curtain = document.createElement('div');
        curtain.classList.add('curtain');

        //2 Subelements, a title and a picture
        let title = document.createElement('h2');
        title.innerHTML = i.toString();
        curtain.appendChild(title);

        let img = document.createElement('img');
        img.setAttribute('src', '../img/gordijn.jpg');
        img.dataset.index = i.toString();
        curtain.appendChild(img);

        //Add all
        playField.appendChild(curtain);
    }
}

//Make the pictures of shows clickable
function playingFieldClickHandler(e){

}