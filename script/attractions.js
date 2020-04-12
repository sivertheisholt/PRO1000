    window.onload = startup;

    var locations = [];

    function create_array(headline, image, text) {
        for (let i = 1; i < headline.length; i++) {
            var temp = {
                "name": headline[i],
                "text": text[i],
                "image": image[i],
                "roadDesc": roadDesc[i],
                "fee": fee[i],
                "visitors": visitors[i],
                "notices": notices[i]
            }
            locations.push(temp);
        }
    }

    function startup() {
        //  random();
        write_rec(locations.length);
        currentDate();
        document.getElementById("recommended").onclick = recommended;
        document.getElementById("all").onclick = all;
        //document.getElementById("overlay").onclick = overlayOff;
    }

    function currentDate() {
        var d = new Date();
        var dato = d.getDate();
        var month = d.getMonth() + 1;
        var year = d.getFullYear();
        date.innerHTML = "Date: " + dato + "." + month + "." + year;
    }

    var slider_img = []; //spaghetti
    function create_image_array(image, imgs) {
        console.log(imgs);
        for (let i = 0; i < image.length - 1; i++) { //setter inn alle image filstiene, 
            slider_img[i] = [image[i + 1]]; //hopper over den første som er overview bilde til storymap
        }
        for (let i = 0; i < image.length + 1; i++) {
            if (imgs[i] != undefined) { //hvis arrayet er definert
                var complete = slider_img[i - 2].concat(imgs[i]); //'merger' arrayet sammen med det fra forrige loop (images[8] hører til posisjon 6 pga databasen starter på 1 og arrayet starter 0 så det må bli -2)
                slider_img[i - 2] = complete; //setter det som nåvæerende array i riktig posisjon
            }
        }
        console.log(slider_img);
    }
    //deklarasjoner
    var image;
    var name;
    var number;
    var text;
    var numberArray = [];

    function random() { //trekker 15 tilfeldige tall uten duplikasjoner //burde være antall objekter/locations ikke 15 idk :shrug:
        numberArray = [];
        while (numberArray.length < locations.length) {
            var r = Math.floor(Math.random() * locations.length) + 0;
            if (numberArray.indexOf(r) === -1) numberArray.push(r);
        }
        console.log(numberArray);
    }

    function write_rec(antall) { //skriver inn alle til html
        rec_container.innerHTML = ""; //blir tømt pga three_days() og five_days()
        random();
        for (let i = 0; i < antall; i++) {
            number = numberArray[i];
            image = locations[number]["image"]; //img_0 er den som skal vises i recommendation boksene
            name = locations[number]["name"];
            //skriver inn alle boksene, onclick funksjonen med 'number' er viktig for å vite hvilken attraksjon den tilhører
            rec_container.innerHTML += '<div class="rec_box" onclick="overlayOn(' + number + ')"><img src=\"' + image + '\" class="img"><h1>' + name + '</h1></div>';
        }
    }

    function write_rec2(antall) { //skriver inn recommendations til html
        rec_container.innerHTML = ""; //blir tømt pga three_days() og five_days()
        random();
        for (let i = 0; i < antall; i++) {
            numberArray.sort(function(a, b) { return a - b });
            console.log(numberArray);
            number = numberArray[i];
            image = locations[number]["image"]; //img_0 er den som skal vises i recommendation boksene
            name = locations[number]["name"];
            //skriver inn alle boksene, onclick funksjonen med 'number' er viktig for å vite hvilken attraksjon den tilhører
            rec_container.innerHTML += '<div class="rec_box" onclick="overlayOn(' + number + ')"><img src=\"' + image + '\" class="img"><h1>' + name + '</h1></div>';
        }
    }

    function all() {
        write_rec(locations.length);
    }

    function recommended() {
        write_rec2(15)
    }


    var img_nr = 0;
    var size = 0;
    var identity = 0;
    var images = new Array();
    var roadDesc;
    var fee;
    var visitors;
    var notices;

    function overlayOn(id) { //id tilsvarer posisjonen i locations arrayet elementet som ble trykket på tilhører
        identity = id;
        img_nr = 0; //resetter bilde nr som blir vist når man trykker på en atraksjon igjen
        images = slider_img[id]; //
        size = slider_img[id].length; //finner lengden av antall objekter i images array
        console.log(size + "" + images);
        name = locations[id]["name"]; //navnet som skrives inn i overlayet
        text = locations[id]["text"]; //tekst som skrives inn i overlayet
        roadDesc = locations[id]["roadDesc"];
        fee = locations[id]["fee"];
        visitors = locations[id]["visitors"];
        notices = locations[id]["notices"];
        document.getElementById("overlay").style.display = "block"; //gjøre overlay elementet synlig
        //skriver inn all html koden inn i overlayetText elementet
        overlayText.innerHTML = '<h1 class="img_btn" id="exit" onclick="overlayOff()">X</h1><h1 id="textH1">' + name + '</h1><div id="slider_content"><h1 id="back_btn" class="img_btn" onclick="back()">🠄</h1><h1 id="next_btn" class="img_btn" onclick="next()">🠆</h1><div id="slider"></div></div><p>' + text + '</p><p id="info_text"> Address: ' + roadDesc + '</p><p id="info_text">Entrance fee: ' + fee + '</p><p id="info_text">Yearly visitors: ' + visitors + '</p><p id="info_text">Notices: ' + notices + '</p>';
        write_image(); //tilkaller write_image() funksjonen
        //disable_scroll();
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
        if (img_nr == size - 1) {
            img_nr = 0;
        } else {
            img_nr++;
        }
        write_image();
    }

    function back() {
        if (img_nr == 0) {
            img_nr = size - 1;
        } else {
            img_nr--;
        }
        write_image();
    }

    function write_image() { //skriver inn bilde til slideren
        slider.innerHTML = '<img src= \"' + slider_img[identity][+img_nr] + '\"  id="img_slider">';
    }