 //Get array from php
 var lat = <?php echo $lat ?>;
 var lon = <?php echo $lon ?>;
 var text = <?php echo $text ?>;
 var headline = <?php echo $headline ?>;
 var url = <?php echo $url ?>;
 var caption = <?php echo $caption ?>;
 var credit = <?php echo $credit ?>;

 var type;
 var slides = [];
 for (let i = 0; i < lat.length; i++) {
     if (i == 0) {
         type = 'overview';
     } else {
         type = 'slide';
     }
     slides.push({
         type: type,
         location: {
             lat: lat[i],
             lon: lon[i]
         },
         text: {
             headline: headline[i],
             text: text[i]
         },
         media: {
             url: '../storage/attractions/' + url[i],
             caption: caption[i],
             credit: credit[i]
         }
     });
 }
 console.log(slides);
 //Storymap data path, contains slides info and storymap configurations
 var storymap_data = {
     "calculate_zoom": true,
     "storymap": {
         "language": "en",
         "calculate_zoom": true,
         "map_type": "osm:standard",
         "map_background_color": "white",
         "map_as_image": false,
         "font_css": "'PT Sans', sans-serif",
         slides
     }
 };

 //Storymap extra options
 var storymap_options = {};

 //Load storymap
 var storymap = new VCO.StoryMap('map', storymap_data, storymap_options);
 window.onresize = function(event) {
     storymap.updateDisplay(); // this isn't automatic
 }