CREATE TABLE IF NOT EXISTS attractions (
    `storymap_slides_location_lat` NUMERIC(8, 6),
    `storymap_slides_location_lon` NUMERIC(7, 6),
    `storymap_slides_text_headline` VARCHAR(40) CHARACTER SET utf8,
    `storymap_slides_text_text` VARCHAR(890) CHARACTER SET utf8,
    `storymap_slides_media_url` VARCHAR(55) CHARACTER SET utf8,
    `storymap_slides_media_caption` INT,
    `storymap_slides_media_credit` INT
);


CREATE TABLE IF NOT EXISTS attractions (
    storymap_slides_ID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    storymap_slides_location_lat NUMERIC(8, 7) NOT NULL,
    storymap_slides_location_lon NUMERIC (8, 7) NOT NULL,
    storymap_slides_text_headline VARCHAR(100) NOT NULL,
    storymap_slides_text_text VARCHAR(100) NOT NULL,
    storymap_slides_media_url VARCHAR(100),
    storymap_slides_media_caption VARCHAR(100),
    storymap_slides_media_credit VARCHAR(100)
);