    window.onload = startup;

function startup(){
  //  random();
    write_rec(15);
    currentDate();
    document.getElementById("threedays").onclick = three_days;
    document.getElementById("fivedays").onclick = five_days;
    document.getElementById("all").onclick = all;
    //document.getElementById("overlay").onclick = overlayOff;
}

function currentDate() {
    var d = new Date();
    var dato = d.getDate();
    var month = d.getMonth()+1;
    var year = d.getFullYear();
    date.innerHTML = "Date: " + dato +"."+month+"."+year;
}

var locations = [];
function create_array(headline, image, text) {
        for (let i = 1; i < headline.length; i++) {
            var temp = {
                "name": headline[i],
                "text": text[i],
                "image": image[i]
        }
      locations.push(temp);
    }
}

var slider_img = []; //spaghetti
function create_image_array(image, imgs) {
    console.log(imgs);
    for (let i = 0; i < image.length-1; i++) { //setter inn alle image filstiene, 
        slider_img[i] = [image[i+1]]; //hopper over den første som er overview bilde til storymap
    }
    for (let i = 0; i < image.length+1; i++) {
        if (imgs[i] != undefined) { //hvis arrayet er definert
            var complete = slider_img[i-2].concat(imgs[i]); //'merger' arrayet sammen med det fra forrige loop (images[8] hører til posisjon 6 pga databasen starter på 1 og arrayet starter 0 så det må bli -2)
            slider_img[i-2] = complete; //setter det som nåvæerende array i riktig posisjon
        }
    }
    console.log(slider_img);
}


  


var locations_test = [
    {
        name: 'Basilica of the Sagrada Familia',
        image: {img_0:'../storage/attractions/Basilica of the Sagrada Familia.jpg', img_1:'../storage/attractions/test.jpg', img_2:'../storage/test2.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Casa Batllo',
        image: {img_0:'../storage/attractions/Casa Batllo.jpg', img_1:'../storage/attractions/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Gothic Quarter (Barri Gotic)',
        image: {img_0:'../storage/attractions/othic Quarter (Barri Gotic).jpg', img_1:'../storage/attractions/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Palace of Catalan Music',
        image: {img_0:'../storage/attractions/Palace of Catalan Music.jpg', img_1:'../storage/attractions/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Casa Mila - La Pedrera',
        image: {img_0:'../storage/attractions/Casa Mila - La Pedrera.jpg', img_1:'../storage/attractions/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Mercat de la Boqueria',
        image: {img_0:'../storage/attractions/Mercat de la Boqueria.jpg', img_1:'../storage/attractions/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Camp Nou',
        image: {img_0:'../storage/attractions/Camp Nou.jpg', img_1:'../storage/attractions/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Basilica de Santa Maria del Mar',
        image: {img_0:'../storage/attractions/Basilica de Santa Maria del Mar.jpg', img_1:'../storage/attractions/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'The Magic Fountain',
        image: {img_0:'../storage/attractions/The Magic Fountain.jpg', img_1:'../storage/attractions/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Recinte Modernista de Sant Pau',
        image: {img_0:'../storage/attractions/Recinte Modernista de Sant Pau.jpg', img_1:'../storage/attractions/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: "Museu Nacional d'Art de Catalunya - MNAC",
        image: {img_0:"../storage/attractions/Museu Nacional d'Art de Catalunya - MNAC.jpg", img_1:'../storage/attractions/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Barcelona Cathedral',
        image: {img_0:'../storage/attractions/Barcelona Cathedral.jpg', img_1:'../storage/attractions/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Palau Guell',
        image: {img_0:'../storage/attractions/Palau Guell.jpg', img_1:'../storage/attractions/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Parc de Montjuic',
        image: {img_0:'../storage/attractions/Parc de Montjuic.jpg', img_1:'../storage/attractions/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    },
    {
        name: 'Casa Vicens',
        image: {img_0:'../storage/attractions/Casa Vicens.jpg', img_1:'../storage/attractions/test.jpg'},
        website: '',
        text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla a nunc eu leo aliquet cursus non nec nibh. Quisque ultrices quam eu augue euismod, eu mollis augue tempus. Nam ac enim volutpat, semper leo quis, varius elit. Phasellus imperdiet tristique blandit. In at quam eleifend, rhoncus tellus id, ornare ante.'
    }
]

//deklarasjoner
var image;
var name;
var number;
var text;
var numberArray = [];

function random() { //trekker 15 tilfeldige tall uten duplikasjoner //burde være antall objekter/locations ikke 15 idk :shrug:
    numberArray = [];
while(numberArray.length < 15){
    var r = Math.floor(Math.random() * 15) + 0;
    if(numberArray.indexOf(r) === -1) numberArray.push(r);
}
console.log(numberArray);
}

function write_rec(antall) {    //skriver inn recommendations til html
    rec_container.innerHTML = "";   //blir tømt pga three_days() og five_days()
    random();
    for (let i = 0; i < antall; i++) {
     number = numberArray[i]; 
     image = locations[number]["image"]; //img_0 er den som skal vises i recommendation boksene
     name = locations[number]["name"];
     //skriver inn alle boksene, onclick funksjonen med 'number' er viktig for å vite hvilken attraksjon den tilhører
     rec_container.innerHTML += '<div class="rec_box" onclick="overlayOn('+number+')"><img src=\"'+image+'\" class="img"><h1>'+name+'</h1></div>';  
    }}

function all() {
    write_rec(15);
}

function three_days() {
    write_rec(3); //skriver inn bare 3 attraksjon, kan evt lage et valgt set, og ha flere atraksjoner, samme med five_days()
}

function five_days() {
    write_rec(5);
}



var img_nr = 0;
var size = 0;
var identity = 0;
var images = new Array();

function overlayOn(id) { //id tilsvarer posisjonen i locations arrayet elementet som ble trykket på tilhører
    identity = id;
    img_nr = 0;   //resetter bilde nr som blir vist når man trykker på en atraksjon igjen
    images = slider_img[id];    //
    size = slider_img[id].length; //finner lengden av antall objekter i images array
    console.log(size + "" + images);

    name = locations[id]["name"]; //navnet som skrives inn i overlayet
    text = locations[id]["text"]; //tekst som skrives inn i overlayet
    document.getElementById("overlay").style.display = "block"; //gjøre overlay elementet synlig
    //skriver inn all html koden inn i overlayetText elementet
    overlayText.innerHTML = '<h1 class="img_btn" id="exit" onclick="overlayOff()">X</h1><h1>'+name+'</h1><div id="slider_content"><h1 id="back_btn" class="img_btn" onclick="back()">🠄</h1><h1 id="next_btn" class="img_btn" onclick="next()">🠆</h1><div id="slider"></div></div><p>'+text+'</p>';
   write_image(); //tilkaller write_image() funksjonen
   disable_scroll();
}

function disable_scroll() {
    document.body.style.overflow = "hidden";
}
function enable_scroll() {
    document.body.style.overflow = "visible";
}

function overlayOff() {
    document.getElementById("overlay").style.display = "none"; //gjemmer overlayet
    overlayText.innerHTML = "";
    enable_scroll();
}


function next() {
    if (img_nr == size-1) {
        img_nr = 0;
    } else {
        img_nr++;
    }
    write_image();
}

function back() {
      if (img_nr == 0) {
        img_nr = size-1;
    } else {
        img_nr--;
    }
    write_image();
}

function write_image() { //skriver inn bilde til slideren
    slider.innerHTML = '<img src= \"'+slider_img[identity][+img_nr]+'\"  id="img_slider">';
}


