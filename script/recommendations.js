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
        image: './storage/Basilica of the Sagrada Familia.jpg',
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Casa Batllo',
        image: './storage/Casa Batllo.jpg',
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Gothic Quarter (Barri Gotic)',
        image: './storage/othic Quarter (Barri Gotic).jpg',
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Palace of Catalan Music',
        image: './storage/Palace of Catalan Music.jpg',
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Casa Mila - La Pedrera',
        image: './storage/Casa Mila - La Pedrera.jpg',
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Mercat de la Boqueria',
        image: './storage/Mercat de la Boqueria.jpg',
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Camp Nou',
        image: './storage/Camp Nou.jpg',
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Basilica de Santa Maria del Mar',
        image: './storage/Basilica de Santa Maria del Mar.jpg',
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'The Magic Fountain',
        image: './storage/The Magic Fountain.jpg',
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Recinte Modernista de Sant Pau',
        image: './storage/Recinte Modernista de Sant Pau.jpg',
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: "Museu Nacional d'Art de Catalunya - MNAC",
        image: "./storage/Museu Nacional d'Art de Catalunya - MNAC.jpg",
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Barcelona Cathedral',
        image: './storage/Barcelona Cathedral.jpg',
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Palau Guell',
        image: './storage/Palau Guell.jpg',
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Parc de Montjuic',
        image: './storage/Parc de Montjuic.jpg',
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Casa Vicens',
        image: './storage/Casa Vicens.jpg',
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
     image = locations[number]["image"];
     name = locations[number]["name"];
     rec_container.innerHTML += '<div class="rec_box" onclick="overlayOn('+number+')"><img src=\"'+image+'\" class="img"><h1>'+name+'</h1></div>';
    }}

function tredager() {
    write_rec2(3);
}

function femdager() {
    write_rec2(5);
}

function overlayOn(id) {
    image = locations[id]["image"];
    name = locations[id]["name"];
    text = locations[id]["text"];
    document.getElementById("overlay").style.display = "block";
    overlayText.innerHTML = '<h1>'+name+'</h1><img width="700px" src=\"'+image+'\"><p>'+text+'</p>';
}

function overlayOff() {
    document.getElementById("overlay").style.display = "none";
    overlayText.innerHTML = "";
}