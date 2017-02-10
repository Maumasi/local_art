// ======================================================================
// map options

function options() {
  return {
    center: {
      lat: 37,
      lng: -122,
    },

    disableDefaultUI: true,
    scrollwheel: false,
    draggable: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    zoom: 15,
    minZoom: 1,
    maxZoom: 35,
    zoomControlOptions: {
      position: google.maps.ControlPosition.LEFT_BOTTOM,
      style: google.maps.ZoomControlStyle.SMALL,
    },

    panControlOptions: {
      position: google.maps.ControlPosition.LEFT_BOTTOM
    }
  }
}
