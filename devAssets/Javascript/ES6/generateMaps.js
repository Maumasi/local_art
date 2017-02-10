

((global) => {

  let options = global.mapOptions;
  // map canvas
  const mapElement = document.getElementById('map');
  const map = global.MapMethods.create(mapElement, options);

  console.log(map);
  map.zoom(10);

})(window);
