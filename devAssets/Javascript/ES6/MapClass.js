
// ======================================================================
// map methods

class Map {
  constructor(element, options) {
    this._map = new google.maps.Map(element, options);
  }


  on(event, callback) {
    google.maps.event.addListener(this._map, event, callback);
  }

  zoom(num = null) {
    if(num) {
      this._map.setZoom(num);
    } else {
      return this._map.getZoom();
    }
  }
}
