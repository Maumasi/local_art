
// ======================================================================
// map methods

class Map extends ArrayCollection {
  constructor(element, options) {
    super();
    this._map = new google.maps.Map(element, options);
  }// constructor


  // capture a map even from the user and use it to trigger a callback function
  on(event, callback) {
    google.maps.event.addListener(this._map, event, (e) => {
      callback.call(this, e);
    });
  }// on


  // create a marker on this Map() instance
  marker(markerOptions){
    // configure marker options the way google needs them
    const { lat, lng, trigger, content } = markerOptions;
    markerOptions.position = { lat, lng, }
    markerOptions.map = this._map;
    // create marker and save it to the markers collection
    const marker = new google.maps.Marker(markerOptions);
    this.add(marker);
    // there is a triggerable event execute it
    if(trigger) {
      const { event, callback } = trigger;
      this._event({
        event,
        marker,
        callback,
      });
    }// if
    // if content is given for an event, display it acording to the event
    if(content) {
      this._event({
        event: CLICK,
        marker,
        callback() {
          const markerMessage = new google.maps.InfoWindow({
            content,
          });
          markerMessage.open(this._map, marker);
        },
      });
    }// if
    return marker;
  }// marker


  deleteMarker(marker) {
    if(this.remove(marker)) {
      marker.setMap(null);
    }// if
  }// _deleteMarker


  // set the map's zoom level or retun the zoom level
  zoom(num = null) {
    if(num) {
      this._map.setZoom(num);
    } else {
      return this._map.getZoom();
    }
  }// zoom


  // set or get map center
  mapCenter(lat = null, lng = null) {
    if(lat && lng) {
      this._map.setCenter({ lat, lng });
    } else {
      return this._map.getCenter();
    }
  }


  // used for marker events from the user
   _event(options) {
     const { marker, event, callback } = options;
     google.maps.event.addListener(marker, event, (e) => {
       callback.call(this, e);
     });
   }// _event
}// class
