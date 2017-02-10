"use strict";

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

// ======================================================================
// map methods

var Map = function () {
  function Map(element, options) {
    _classCallCheck(this, Map);

    this._map = new google.maps.Map(element, options);
  }

  _createClass(Map, [{
    key: "on",
    value: function on(event, callback) {
      google.maps.event.addListener(this._map, event, callback);
    }
  }, {
    key: "zoom",
    value: function zoom() {
      var num = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;

      if (num) {
        this._map.setZoom(num);
      } else {
        return this._map.getZoom();
      }
    }
  }]);

  return Map;
}();
'use strict';

// ======================================================================
// generate maps

// map options
var options = options();

var venueMapElement = document.getElementById('venue-map');

// map
var venueMap = new Map(venueMapElement, options);

venueMap.zoom(15);

venueMap.on('click', function () {
  alert('zoom is ' + venueMap.zoom());
});

console.log(venueMap.zoom());
"use strict";

// ======================================================================
// map options

function options() {
  return {
    center: {
      lat: 37,
      lng: -122
    },

    disableDefaultUI: true,
    scrollwheel: false,
    draggable: true,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    zoom: 14,
    minZoom: 10,
    maxZoom: 35,
    zoomControlOptions: {
      position: google.maps.ControlPosition.LEFT_BOTTOM,
      style: google.maps.ZoomControlStyle.SMALL
    },

    panControlOptions: {
      position: google.maps.ControlPosition.LEFT_BOTTOM
    }
  };
}