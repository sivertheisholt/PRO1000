window.onload = startup;

function startup(){
  //  random();
    write_rec2(15);
    currentDate();
    document.getElementById("tredager").onclick = tredager;
    document.getElementById("femdager").onclick = femdager;
    document.getElementById("overlay").onclick = overlayOff;
   // document.getElementById("rec_1").onclick = overlayOn;


}

function currentDate() {
    var d = new Date();
    var dato = d.getDate();
    var month = d.getMonth()+1;
    var year = d.getFullYear();
    date.innerHTML = "Date: " + dato +"."+month+"."+year;
}

var locations = [
    {
        name: 'Basilica of the Sagrada Familia',
        image: {img_1:'./storage/Basilica of the Sagrada Familia.jpg', img_2:'./storage/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Casa Batllo',
        image: {img_1:'./storage/Casa Batllo.jpg', img_2:'./storage/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Gothic Quarter (Barri Gotic)',
        image: {img_1:'./storage/othic Quarter (Barri Gotic).jpg', img_2:'./storage/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Palace of Catalan Music',
        image: {img_1:'./storage/Palace of Catalan Music.jpg', img_2:'./storage/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Casa Mila - La Pedrera',
        image: {img_1:'./storage/Casa Mila - La Pedrera.jpg', img_2:'./storage/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Mercat de la Boqueria',
        image: {img_1:'./storage/Mercat de la Boqueria.jpg', img_2:'./storage/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Camp Nou',
        image: {img_1:'./storage/Camp Nou.jpg', img_2:'./storage/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Basilica de Santa Maria del Mar',
        image: {img_1:'./storage/Basilica de Santa Maria del Mar.jpg', img_2:'./storage/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'The Magic Fountain',
        image: {img_1:'./storage/The Magic Fountain.jpg', img_2:'./storage/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Recinte Modernista de Sant Pau',
        image: {img_1:'./storage/Recinte Modernista de Sant Pau.jpg', img_2:'./storage/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: "Museu Nacional d'Art de Catalunya - MNAC",
        image: {img_1:"./storage/Museu Nacional d'Art de Catalunya - MNAC.jpg", img_2:'./storage/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Barcelona Cathedral',
        image: {img_1:'./storage/Barcelona Cathedral.jpg', img_2:'./storage/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Palau Guell',
        image: {img_1:'./storage/Palau Guell.jpg', img_2:'./storage/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Parc de Montjuic',
        image: {img_1:'./storage/Parc de Montjuic.jpg', img_2:'./storage/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Casa Vicens',
        image: {img_1:'./storage/Casa Vicens.jpg', img_2:'./storage/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    }
]

/*
function write_rec() {
    for (let i = 0; i < 6; i++) {
     rec_container.innerHTML += '<div class="rec_box" id="rec_'+i+'"><img src=\"storage/Barcelona Cathedral.jpg\" class="img"><h1> test </h1></div>';
    }

   //rec_1.innerHTML = "<img src=\"storage/Barcelona Cathedral.jpg\" class='img'><h1> test </h1>"; 
}*/

var image;
var name;
var number;
var text;
var numberArray = [];

function random() {
    numberArray = [];
while(numberArray.length < 15){
    var r = Math.floor(Math.random() * 15) + 0;
    if(numberArray.indexOf(r) === -1) numberArray.push(r);
}
console.log(numberArray);
}

function write_rec2(antall) {
    rec_container.innerHTML = "";
    random();
    for (let i = 0; i < antall; i++) {
     number = numberArray[i];
     image = locations[number]["image"]["img_1"];
     name = locations[number]["name"];
     rec_container.innerHTML += '<div class="rec_box" onclick="overlayOn('+number+')"><img src=\"'+image+'\" class="img"><h1>'+name+'</h1></div>';
    }}

function tredager() {
    write_rec2(3);
}

function femdager() {
    write_rec2(5);
}



var bilde_nr = 0;
var bilder = new Array();

function overlayOn(id) {
    bilder = locations[id]["image"];
    console.log(bilder);
    image = locations[id]["image"];
    name = locations[id]["name"];
    text = locations[id]["text"];
    document.getElementById("overlay").style.display = "block";
    //overlayText.innerHTML = '<h1>'+name+'</h1><img width="700px" src=\"'+image+'\"><p>'+text+'</p>';
    overlayText.innerHTML = '<h1>'+name+'</h1><div id="slider_innhold"><h1 id="tilbake_knapp" class="bilde_knapp" onclick="tilbake()">🠄</h1><h1 id="neste_knapp" class="bilde_knapp" onclick="neste()">🠆</h1><div id="bilde_slider"></div></div><p>'+text+'</p>';
   skriv_bilde();
}

function overlayOff() {
    document.getElementById("overlay").style.display = "none";
    overlayText.innerHTML = "";
}



function neste() {
    if (bilde_nr == bilder.length-1) {
        bilde_nr = 0;
    } else {
        bilde_nr++;
    }
    skriv_bilde();
}

function tilbake() {
      if (bilde_nr == 0) {
        bilde_nr = bilder.length-1;
    } else {
        bilde_nr--;
    }
    skriv_bilde();
}

function skriv_bilde() {
    bilde_slider.innerHTML = '<img src= \"'+bilder[bilde_nr]+'\"  id="img_slider">';
}