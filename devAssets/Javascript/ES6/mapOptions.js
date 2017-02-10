

((global, google) => {

  const {
    Map,
    MapTypeId,
    ControlPosition,
    ZoomControlStyle,

  } = google.maps;

  // map options
  global.mapOptions = {
    center: {
      lat: 37.1111,
      lng: -122.11111,
    },

    disableDefaultUI: false,
    scrollwheel: true,
    draggable: true,
    mapTypeId: MapTypeId.ROADMAP,

    zoomControlOptions: {
      position: ControlPosition.BOTTOM_LEFT,
      style: ZoomControlStyle.DEFAULT,
    },

    panControlOptions: {
      position: ControlPosition.LEFT_BOTTOM,
    },

    zoom: 8,
    maxZoom: 100,
    minZoom: 1,

  }


})(window, google);
