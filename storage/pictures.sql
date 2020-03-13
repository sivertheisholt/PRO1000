CREATE TABLE
IF NOT EXISTS attractionsPicture
(
    storymap_slides_ID INT NOT NULL,
    storymap_slides_media_url VARCHAR
(100) DEFAULT ''
);

INSERT INTO attractionsPicture (storymap_slides_ID, storymap_slides_media_url)
VALUES (8, "../storage/attractions/download.jpg");


INSERT INTO attractionsPicture (storymap_slides_ID, storymap_slides_media_url)
VALUES (16, "../storage/attractions/download(1).jpg");

INSERT INTO attractionsPicture (storymap_slides_ID, storymap_slides_media_url)
VALUES (16, "../storage/attractions/download(2).jpg");


