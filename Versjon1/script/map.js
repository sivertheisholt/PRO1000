//Storymap data path, contains slides info and storymap configurations
var storymap_data = 'script/map.json';

//Storymap extra options
var storymap_options = {};

var storymap = new VCO.StoryMap('map', storymap_data, storymap_options);
window.onresize = function (event) {
    storymap.updateDisplay(); // this isn't automatic
}