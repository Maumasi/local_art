
((global, google) => {

  class MapMethods {
    constructor( element, options ) {
      this.map = new google.maps.Map(element, options);
    }

    // getter and setter for map zoom distance
    zoom(distance) {
      if(distance) {
        this.map.setZoom(distance);
      } else {
        this.map.getZoom();
      }
    }
  }

  MapMethods.create = (element, options) => {
    return new MapMethods(element, options)
  }

  global.MapMethods = MapMethods;

})(window, google);
