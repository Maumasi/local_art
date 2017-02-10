
// ======================================================================
// map methods

class Map {
  constructor(element, options) {
    this._map = new google.maps.Map(element, options);
    this.markerCollection = [];
  }


  // capture a map even from the user and use it to trigger a callback function
  on(event, callback) {
    google.maps.event.addListener(this._map, event, (e) => {
      callback.call(this, e);
    });
  }


  // create a marker on this Map() instance
  marker(markerOptions){

    // configure marker options the way google needs them
    const { lat, lng, trigger, content } = markerOptions;

    markerOptions.position = { lat, lng, }
    markerOptions.map = this._map;

    // create marker and save it to the markers collection
    const marker = new google.maps.Marker(markerOptions);
    this._collectMarker(marker);

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
        event: 'click',
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
  }


  // collect all markers for this map
  _collectMarker(marker) {
    this.markerCollection.push(marker);
  }

  _deleteMarker(marker) {
    const markerIndex = this.markerCollection.indexOf(marker);

    if(markerIndex !== -1) {
      this.markerCollection.splice(markerIndex, 1);
      marker.setMap(null);
    }
  }


  // used for marker events from the user
   _event(options) {
     const { marker, event, callback } = options;
     google.maps.event.addListener(marker, event, (e) => {
       callback.call(this, e);
     });
   }


  // set the map's zoom level or retun the zoom level
  zoom(num = null) {
    if(num) {
      this._map.setZoom(num);
    } else {
      return this._map.getZoom();
    }
  }
}
