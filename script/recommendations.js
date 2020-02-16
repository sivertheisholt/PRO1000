window.onload = startup;

function startup(){
    write_rec2();
    currentDate();
}

function currentDate() {
    var d = new Date();
    date.innerHTML = "Date: " + d.getDate() +"."+d.getMonth()+"."+d.getFullYear();
}

var locations = [
    {
        name: 'Basilica of the Sagrada Familia',
        image: './storage/Basilica of the Sagrada Familia.jpg',
        website: ''
    },
    {
        name: 'Casa Batllo',
        image: './storage/Casa Batllo.jpg',
        website: ''
    },
    {
        name: 'Gothic Quarter (Barri Gotic)',
        image: './storage/othic Quarter (Barri Gotic).jpg',
        website: ''
    },
    {
        name: 'Palace of Catalan Music',
        image: './storage/Palace of Catalan Music.jpg',
        website: ''
    },
    {
        name: 'Casa Mila - La Pedrera',
        image: './storage/Casa Mila - La Pedrera.jpg',
        website: ''
    },
    {
        name: 'Mercat de la Boqueria',
        image: './storage/Mercat de la Boqueria.jpg',
        website: ''
    },
    {
        name: 'Camp Nou',
        image: './storage/Camp Nou.jpg',
        website: ''
    },
    {
        name: 'Basilica de Santa Maria del Mar',
        image: './storage/Basilica de Santa Maria del Mar.jpg',
        website: ''
    },
    {
        name: 'The Magic Fountain',
        image: './storage/The Magic Fountain.jpg',
        website: ''
    },
    {
        name: 'Recinte Modernista de Sant Pau',
        image: './storage/Recinte Modernista de Sant Pau.jpg',
        website: ''
    },
    {
        name: "Museu Nacional d'Art de Catalunya - MNAC",
        image: "./storage/Museu Nacional d'Art de Catalunya - MNAC.jpg",
        website: ''
    },
    {
        name: 'Barcelona Cathedral',
        image: './storage/Barcelona Cathedral.jpg',
        website: ''
    },
    {
        name: 'Palau Guell',
        image: './storage/Palau Guell.jpg',
        website: ''
    },
    {
        name: 'Parc de Montjuic',
        image: './storage/Parc de Montjuic.jpg',
        website: ''
    },
    {
        name: 'Casa Vicens',
        image: './storage/Casa Vicens.jpg',
        website: ''
    }
]

function write_rec() {
    for (let i = 0; i < 6; i++) {
     rec_container.innerHTML += '<div class="rec_box"><img src=\"storage/Barcelona Cathedral.jpg\" class="img"><h1> test </h1></div>';
    }

   /* rec_1.innerHTML = "<img src=\"storage/Barcelona Cathedral.jpg\" class='img'><h1> test </h1>"; */


}
var image;
var name;
var number;

var numberArray = [];
while(numberArray.length < 6){
    var r = Math.floor(Math.random() * 14) + 0;
    if(numberArray.indexOf(r) === -1) numberArray.push(r);
}
console.log(numberArray);

function write_rec2() {
    for (let i = 0; i < 6; i++) {
     number = numberArray[i];
     image = locations[number]["image"];
     name = locations[number]["name"];
     rec_container.innerHTML += '<div class="rec_box"><img src=\"'+image+'\" class="img"><h1>'+name+'</h1></div>';
    }


}
