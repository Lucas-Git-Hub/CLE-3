window.addEventListener('load',init);

let shows = ["Pink Elephants on Parade","Walhalla’s Grote Preview Revue","Sultan in de maan","Ali & Nino 8+","Peter Blanker en Izak Boom","Kaspar H. 8+"];
let codes = ['5231','213','12313','1232','2332','2555'];
let showPictures = ['../img/Pink-Elephants.jpg','../img/Walhalla-Revue.jpg','../img/sultan-in-de-maan.jpg','../img/Ali-Nino.jpg','../img/Peter-Izak.jpg','../img/KasparH.jpg'];
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
        img.src = '../img/gordijn.jpg';
        img.dataset.id = i.toString();
        curtain.appendChild(img);

        let showCode = document.createElement('h2');
        showCode.innerHTML = codes[i];
        showCode.classList.add('container');
        curtain.appendChild(showCode);

        let title = document.createElement('h1');
        title.innerHTML = shows[i]
        title.classList.add('container');
        curtain.appendChild(title);

        //Add all
        playField.appendChild(curtain);
    }
}

//Shows picture of show when clicked on curtain and hides show when a different one is clicked
function clickEventHandler(e){

    let currentTarget = e.target;

    //checks if IMG else stop function
    if (currentTarget.tagName !== "IMG"){
        return;
    }

    //Picture returns to being curtain picture
    if (lastTarget){
        lastTarget.src = '../img/gordijn.jpg'
    }

    //Shows picture of show that is on that index
    currentTarget.src = showPictures[currentTarget.dataset.id];
    lastTarget = currentTarget;

}