window.addEventListener('load',init);

let shows = ["Testshow1","Testshow2","Testshow3","Testshow4"];
let codes = ['5231','213','12313','1232'];
let playField;

//Initialize after the DOM is ready
function init(){
    playField = document.getElementById('playing-field');

    createPlayField();
}

//Make a list of shows
function createPlayField(){
    for (let i = 0; i < shows.length; i++){
        //Main Element
        let curtain = document.createElement('div');
        curtain.classList.add('polaroid');

        //3 Subelements, a title, a picture of the show and the code
        let img = document.createElement('img');
        img.setAttribute('src', '../img/gordijn.jpg');
        img.dataset.index = i.toString();
        curtain.appendChild(img);

        let showCode = document.createElement('h2');
        showCode.innerHTML = codes[i];
        showCode.classList.add('container')
        curtain.appendChild(showCode);

        let title = document.createElement('h1');
        title.innerHTML = shows[i]
        title.classList.add('container');
        curtain.appendChild(title);

        //Add all
        playField.appendChild(curtain);
    }
}

