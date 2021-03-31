window.addEventListener('load',init);

let shows = ["Pink Elephants on Parade","Walhalla’s Grote Preview Revue","Sultan in de maan","Ali & Nino 8+"];
let codes = ['5231','213','12313','1232'];
let showPictures = ["../img/Pink-Elephants.jpg","../img/Walhalla-Revue.jpg","../img/sultan-in-de-maan.jpg","../img/Ali-Nino.jpg"]
let playField;
let lastTarget;

//Initialize after the DOM is ready
function init(){
    playField = document.getElementById('playing-field');
    playField.addEventListener('click',clickEventHandler);

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

        let title = document.createElement('h1');
        title.innerHTML = shows[i]
        title.classList.add('container');
        curtain.appendChild(title);

        //Add all
        playField.appendChild(curtain);
    }
}

function clickEventHandler(e){

    let currentTarget = e.target;

    if (currentTarget.nodeName !== "IMG"){
        return;
    }
    console.log(currentTarget);

    if (lastTarget){
        lastTarget.src = '../img/gordijn.jpg'
    }

    currentTarget.src = showPictures[currentTarget.dataset.id];
    lastTarget = currentTarget;
}