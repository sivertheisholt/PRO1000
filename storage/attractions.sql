DROP TABLE IF EXISTS attractions;
CREATE TABLE IF NOT EXISTS attractions
(
    storymap_slides_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    storymap_slides_location_lat NUMERIC
(9, 7) NOT NULL,
    storymap_slides_location_lon NUMERIC
(9, 7) NOT NULL,
    storymap_slides_text_headline VARCHAR
(100) NOT NULL ,
    storymap_slides_text_text VARCHAR
(1000) NOT NULL,
    storymap_slides_media_url VARCHAR
(100) DEFAULT '',
    storymap_slides_media_caption VARCHAR
(100) DEFAULT '',
    storymap_slides_media_credit VARCHAR
(100) DEFAULT ''
);

INSERT INTO attractions
    (storymap_slides_location_lat, storymap_slides_location_lon, storymap_slides_text_headline, storymap_slides_text_text, storymap_slides_media_url, storymap_slides_media_caption, storymap_slides_media_credit)
VALUES(41.385063, 2.173404, "Barcelona",
        "Barcelona feels a bit surreal – appropriate, since Salvador Dali spent time here and Spanish Catalan architect Antoni Gaudí designed several of the city’s buildings. Stepping into Gaudí’s Church of the Sacred Family is a bit like falling through the looking glass - a journey that you can continue with a visit to Park Güell. Sip sangria at a sidewalk café in Las Ramblas while watching flamboyant street performers, then create your own moveable feast by floating from tapas bar to tapas bar.",
        "Barcelona-0.jpg",
        "",
        "");

INSERT INTO attractions
    (storymap_slides_location_lat, storymap_slides_location_lon, storymap_slides_text_headline, storymap_slides_text_text, storymap_slides_media_url, storymap_slides_media_caption, storymap_slides_media_credit)
VALUES(41.403706, 2.173504, "Basilica of the Sagrada Familia",
        "The Basilica of the Sagrada Familia is a monumental church devoted to the Holy Family: Jesus, Mary and Joseph. Construction began in 1882, based on plans drawn up by the architect Francisco de Paula del Villar, and Antoni Gaudi was commissioned to continue the project in 1883. The Temple has always been an expiatory church, built only from donations. As Gaudi said: The Expiatory Church of the Sagrada Familia is made by the people and is mirrored in them. It is a work that is in the hands of God and the will of the people. In 2010, Pope Benedict XVI consecrated the site as a minor basilica.",
        "Basilica de Santa Maria del Mar - 1.jpg",
        "",
        "");

INSERT INTO attractions
    (storymap_slides_location_lat, storymap_slides_location_lon, storymap_slides_text_headline, storymap_slides_text_text, storymap_slides_media_url, storymap_slides_media_caption, storymap_slides_media_credit)
VALUES(41.3917, 2.16495, "Casa Batllo",
        "Stunning outside, unimaginable inside!",
        "Casa Batllo - 0.jpg",
        "",
        "");

INSERT INTO attractions
    (storymap_slides_location_lat, storymap_slides_location_lon, storymap_slides_text_headline, storymap_slides_text_text, storymap_slides_media_url, storymap_slides_media_caption, storymap_slides_media_credit)
VALUES(41.381905, 2.178185, "Gothic Quarter (Barri Gotic)",
        "The Central historical part of Barcelona, located between the streets of Rambla and Laetana.",
        "Gothic Quarter - 1.jpg",
        "",
        "");

INSERT INTO attractions
    (storymap_slides_location_lat, storymap_slides_location_lon, storymap_slides_text_headline, storymap_slides_text_text, storymap_slides_media_url, storymap_slides_media_caption, storymap_slides_media_credit)
VALUES(41.387565, 2.175381, "Palace of Catalan Music",
        "The Palau, an icon of modernist architecture in downtown Barcelona The Palau de la Música Catalana is one of the most representative monuments of the city and It is one of the most recommended tourist attractions of Barcelona. Built between 1905 and 1908 by the great architect Lluis Domènech i Montaner, the Palau de la Música Catalana is an architectural jewel of Catalonia and essential part of any visit to the city, as any of the most fascinating Gaudi buildings. This historical building, declared a World Heritage Site by UNESCO in 1997, offers an experience so magical that visitors fall in love with it. From the hand of experienced guides, the wonders of this architectural pearl discovered and visitors into a fantasy world full of details and references to the characteristic nature of modernist architecture. An essential visit in the list of top 10 things to see in Barcelona.",
        "Palace of Catalan Music - 1.jpg",
        "",
        "");

INSERT INTO attractions
    (storymap_slides_location_lat, storymap_slides_location_lon, storymap_slides_text_headline, storymap_slides_text_text, storymap_slides_media_url, storymap_slides_media_caption, storymap_slides_media_credit)
VALUES(41.395335, 2.161696, "Casa Mila - La Pedrera",
        "Casa Mila, popularly known as La Pedrera, is a most unusual building, constructed between 1906 and 1912 by the architect Antoni Gaudí (1852–1926) and declared UNESCO World Heritage in 1984. Today it is the headquarters of Fundacio Catalunya La Pedrera and houses a cultural centre that is a reference point in Barcelona for the range of activities it organises and the different spaces for exhibitions and other public uses it contains. A visit to La Pedrera, landmark building and container, gives us a better understanding and appreciation of architecture and transports us to the period when Antoni Gaudi lived.",
        "Casa Mila - 0.jpg",
        "",
        "");

INSERT INTO attractions
    (storymap_slides_location_lat, storymap_slides_location_lon, storymap_slides_text_headline, storymap_slides_text_text, storymap_slides_media_url, storymap_slides_media_caption, storymap_slides_media_credit)
VALUES(41.381812, 2.171596, "Mercat de la Boqueria",
        "In the heart of the Ramblas sits Barcelona’s iconic produce market. This maze of stalls sells an inspiring selection of fruits and veggies, fish and seafood, meats and mushrooms, and spices and candy.",
        "Mercat de la Boqueria - 1.jpg",
        "",
        "");

INSERT INTO attractions
    (storymap_slides_location_lat, storymap_slides_location_lon, storymap_slides_text_headline, storymap_slides_text_text, storymap_slides_media_url, storymap_slides_media_caption, storymap_slides_media_credit)
VALUES(41.38016, 2.120091, "Camp Nou",
        "This gigantic stadium is the largest soccer stadium in Europe, with a seating capacity of 100,000",
        "Camp Nou - 1.jpg",
        "",
        "");

INSERT INTO attractions
    (storymap_slides_location_lat, storymap_slides_location_lon, storymap_slides_text_headline, storymap_slides_text_text, storymap_slides_media_url, storymap_slides_media_caption, storymap_slides_media_credit)
VALUES(41.383577, 2.181785, "Basilica de Santa Maria del Mar",
        "The Gothic Church, built in the 14th century, is located in the quarter of La Ribera.",
        "Basilica de Santa Maria del Mar - 1.jpg",
        "",
        "");

INSERT INTO attractions
    (storymap_slides_location_lat, storymap_slides_location_lon, storymap_slides_text_headline, storymap_slides_text_text, storymap_slides_media_url, storymap_slides_media_caption, storymap_slides_media_credit)
VALUES(41.370995, 2.152454, "The Magic Fountain",
        "A combination display of water, music and light which was originally built in 1929. It was restored in 1992 and provides a spectacular show every half hour.",
        "The Magic Fountain - 1.jpg",
        "",
        "");

INSERT INTO attractions
    (storymap_slides_location_lat, storymap_slides_location_lon, storymap_slides_text_headline, storymap_slides_text_text, storymap_slides_media_url, storymap_slides_media_caption, storymap_slides_media_credit)
VALUES(41.413867, 2.174335, "Recinte Modernista de Sant Pau",
        "The former Hospital de la Santa Creu i Sant Pau (Catalan pronunciation: [uspiˈtal də lə ˈsantə ˈkɾɛw i ˈsam ˈpaw], English: Hospital of the Holy Cross and Saint Paul) in the neighborhood of El Guinardó, Barcelona, Catalonia, Spain, is a complex built between 1901 and 1930, designed by the Catalan modernisme architect Lluís Domènech i Montaner. Together with Palau de la Música Catalana, it is a UNESCO World Heritage Site.",
        "Recinte Modernista de Sant Pau - 1.jpg",
        "",
        "");

INSERT INTO attractions
    (storymap_slides_location_lat, storymap_slides_location_lon, storymap_slides_text_headline, storymap_slides_text_text, storymap_slides_media_url, storymap_slides_media_caption, storymap_slides_media_credit)
VALUES(41.368553, 2.153574, "Museu Nacional dArt de Catalunya - MNAC",
        "An art museum containing hundreds of pieces from the medieval age to the 19th century.",
        "Museu Nacional dArt de Catalunya - 1.jpg",
        "",
        "");

INSERT INTO attractions
    (storymap_slides_location_lat, storymap_slides_location_lon, storymap_slides_text_headline, storymap_slides_text_text, storymap_slides_media_url, storymap_slides_media_caption, storymap_slides_media_credit)
VALUES(41.384562, 2.175866, "Barcelona Cathedral",
        "A beautiful gothic cathedral with stained glass windows dating back 500 years.",
        "Barcelona Cathedral - 1.jpg",
        "",
        "");

INSERT INTO attractions
    (storymap_slides_location_lat, storymap_slides_location_lon, storymap_slides_text_headline, storymap_slides_text_text, storymap_slides_media_url, storymap_slides_media_caption, storymap_slides_media_credit)
VALUES(41.379225, 2.174451, "Palau Guell",
        "This palace was the home of industrialist Eusebi Guell and was Antonio Gaudi's first major building in the city.",
        "Palau Guell - 1.jpg",
        "",
        "");

INSERT INTO attractions
    (storymap_slides_location_lat, storymap_slides_location_lon, storymap_slides_text_headline, storymap_slides_text_text, storymap_slides_media_url, storymap_slides_media_caption, storymap_slides_media_credit)
VALUES(41.363031, 2.165064, "Parc de Montjuic",
        "Parc de Montjuïc is the upper station of the Funicular de Montjuïc, which is operated by Transports Metropolitans de Barcelona (TMB) as part of the Barcelona Metro. The station serves the hill of Montjuïc and the various sporting and other facilities there.",
        "Parc de Montjuic - 1.jpg",
        "",
        "");

INSERT INTO attractions
    (storymap_slides_location_lat, storymap_slides_location_lon, storymap_slides_text_headline, storymap_slides_text_text, storymap_slides_media_url, storymap_slides_media_caption, storymap_slides_media_credit)
VALUES(41.40352, 2.150704, "Casa Vicens",
        "Casa Vicens is the first masterpiece of Antoni Gaudi and sowed the seeds of later works. Built between 1883 and 1885 as a summer house for the Vicens family, here he showcased his unparalleled talent. Declared Unesco World Heritage in 2005.",
        "Casa Vicens - 1.jpg",
        "",
        "");