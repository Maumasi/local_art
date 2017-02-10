(function(google) {

'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

// ======================================================================
// map methods

var Map = function () {
  function Map(element, options) {
    _classCallCheck(this, Map);

    this._map = new google.maps.Map(element, options);
    this.markerCollection = [];
  }

  // capture a map even from the user and use it to trigger a callback function


  _createClass(Map, [{
    key: 'on',
    value: function on(event, callback) {
      var _this = this;

      google.maps.event.addListener(this._map, event, function (e) {
        callback.call(_this, e);
      });
    }

    // create a marker on this Map() instance

  }, {
    key: 'marker',
    value: function marker(markerOptions) {

      // configure marker options the way google needs them
      var lat = markerOptions.lat,
          lng = markerOptions.lng,
          trigger = markerOptions.trigger,
          content = markerOptions.content;


      markerOptions.position = { lat: lat, lng: lng };
      markerOptions.map = this._map;

      // create marker and save it to the markers collection
      var marker = new google.maps.Marker(markerOptions);
      this._collectMarker(marker);

      // there is a triggerable event execute it
      if (trigger) {
        var event = trigger.event,
            callback = trigger.callback;

        this._event({
          event: event,
          marker: marker,
          callback: callback
        });
      } // if

      // if content is given for an event, display it acording to the event
      if (content) {
        this._event({
          event: 'click',
          marker: marker,
          callback: function callback() {
            var markerMessage = new google.maps.InfoWindow({
              content: content
            });
            markerMessage.open(this._map, marker);
          }
        });
      } // if

      return marker;
    }

    // collect all markers for this map

  }, {
    key: '_collectMarker',
    value: function _collectMarker(marker) {
      this.markerCollection.push(marker);
    }
  }, {
    key: '_deleteMarker',
    value: function _deleteMarker(marker) {
      var markerIndex = this.markerCollection.indexOf(marker);

      if (markerIndex !== -1) {
        this.markerCollection.splice(markerIndex, 1);
        marker.setMap(null);
      }
    }

    // used for marker events from the user

  }, {
    key: '_event',
    value: function _event(options) {
      var _this2 = this;

      var marker = options.marker,
          event = options.event,
          callback = options.callback;

      google.maps.event.addListener(marker, event, function (e) {
        callback.call(_this2, e);
      });
    }

    // set the map's zoom level or retun the zoom level

  }, {
    key: 'zoom',
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

var point1 = {
  lat: 37,
  lng: -122,
  content: 'point 1'
};

var point2 = {
  lat: 36,
  lng: -122,
  content: 'point 2'
};

var p1 = venueMap.marker(point1);
var p2 = venueMap.marker(point2);

console.log(venueMap.markerCollection);

venueMap._deleteMarker(p2);

console.log(p2);

console.log(venueMap.markerCollection);
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

// passing in global namespaces to all the files
})(google);
