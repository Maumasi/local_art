(function(google) {

'use strict';

// constants

// Google Maps event triggers
var CLICK = 'click';
var DOUBLE_CLICK = 'double_click';
"use strict";

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

// )(hcaErof.setMapOnAll
var ArrayCollection = function () {
  function ArrayCollection() {
    _classCallCheck(this, ArrayCollection);

    this.collection = [];
  } // constructor


  _createClass(ArrayCollection, [{
    key: "add",
    value: function add(object) {
      this.collection.push(object);
    } // add


  }, {
    key: "remove",
    value: function remove(object) {
      var isRemoved = false;
      var index = this.collection.indexOf(object);
      if (index !== -1) {
        this.collection.splice(index, 1);
        isRemoved = true;
      }
      return isRemoved;
    } // remove


  }, {
    key: "removeAll",
    value: function removeAll() {
      // this.collection.forEach()

      var object = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
    }
  }]);

  return ArrayCollection;
}(); // class
"use strict";

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

var Geocode = function (_ArrayCollection) {
  _inherits(Geocode, _ArrayCollection);

  function Geocode() {
    _classCallCheck(this, Geocode);

    var _this = _possibleConstructorReturn(this, (Geocode.__proto__ || Object.getPrototypeOf(Geocode)).call(this));

    _this._geo = new google.maps.Geocoder();
    return _this;
  }

  return Geocode;
}(ArrayCollection);
"use strict";

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _possibleConstructorReturn(self, call) { if (!self) { throw new ReferenceError("this hasn't been initialised - super() hasn't been called"); } return call && (typeof call === "object" || typeof call === "function") ? call : self; }

function _inherits(subClass, superClass) { if (typeof superClass !== "function" && superClass !== null) { throw new TypeError("Super expression must either be null or a function, not " + typeof superClass); } subClass.prototype = Object.create(superClass && superClass.prototype, { constructor: { value: subClass, enumerable: false, writable: true, configurable: true } }); if (superClass) Object.setPrototypeOf ? Object.setPrototypeOf(subClass, superClass) : subClass.__proto__ = superClass; }

// ======================================================================
// map methods

var Map = function (_ArrayCollection) {
  _inherits(Map, _ArrayCollection);

  function Map(element, options) {
    _classCallCheck(this, Map);

    var _this = _possibleConstructorReturn(this, (Map.__proto__ || Object.getPrototypeOf(Map)).call(this));

    _this._map = new google.maps.Map(element, options);
    return _this;
  } // constructor


  // capture a map even from the user and use it to trigger a callback function


  _createClass(Map, [{
    key: "on",
    value: function on(event, callback) {
      var _this2 = this;

      google.maps.event.addListener(this._map, event, function (e) {
        callback.call(_this2, e);
      });
    } // on


    // create a marker on this Map() instance

  }, {
    key: "marker",
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
      this.add(marker);
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
          event: CLICK,
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
    } // marker


  }, {
    key: "deleteMarker",
    value: function deleteMarker(marker) {
      if (this.remove(marker)) {
        marker.setMap(null);
      } // if
    } // _deleteMarker


    // set the map's zoom level or retun the zoom level

  }, {
    key: "zoom",
    value: function zoom() {
      var num = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;

      if (num) {
        this._map.setZoom(num);
      } else {
        return this._map.getZoom();
      }
    } // zoom


    // set or get map center

  }, {
    key: "mapCenter",
    value: function mapCenter() {
      var lat = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : null;
      var lng = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;

      if (lat && lng) {
        this._map.setCenter({ lat: lat, lng: lng });
      } else {
        return this._map.getCenter();
      }
    }

    // used for marker events from the user

  }, {
    key: "_event",
    value: function _event(options) {
      var _this3 = this;

      var marker = options.marker,
          event = options.event,
          callback = options.callback;

      google.maps.event.addListener(marker, event, function (e) {
        callback.call(_this3, e);
      });
    } // _event

  }]);

  return Map;
}(ArrayCollection); // class
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
    zoom: 6,
    minZoom: 1,
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
'use strict';

// ======================================================================
// generate maps

var venueStreetAddress = document.getElementById('geo-streetAddress').textContent;
var venueCity = document.getElementById('geo-city').textContent;
var venueState = document.getElementById('geo-state').textContent;
var venueZipCode = document.getElementById('geo-zip-code').textContent;

// map options
var options = options();

var venueMapElement = document.getElementById('venue-map');
var GEO = new google.maps.Geocoder();

// remove any markers if there are any
setMapOnAll(null);

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

// markers
var p1 = venueMap.marker(point1);
var p2 = venueMap.marker(point2);

function markByAddress(options) {
  var _this = this;

  var address = options.address,
      cityState = options.cityState,
      zipCode = options.zipCode,
      state = options.state,
      success = options.success,
      error = options.error;
  var OK = google.maps.GeocoderStatus.OK;

  GEO.geocode({ address: address }, function (responce, status) {
    if (status === OK) {
      console.log(responce);
      console.log('fullAddress');
      success.call(_this, responce, status);
    } else {
      GEO.geocode({ address: cityState }, function (responce, status) {
        if (status === OK) {
          console.log(responce);
          console.log('cityState');
          success.call(_this, responce, status);
        } else {
          GEO.geocode({ address: zipCode }, function (responce, status) {
            if (status === OK) {
              console.log(responce);
              console.log('zipCode');
              success.call(_this, responce, status);
            } else {
              GEO.geocode({ address: state }, function (responce, status) {
                if (status === OK) {
                  console.log(responce);
                  console.log('state');
                  success.call(_this, responce, status);
                } else {
                  console.log(status);
                  error.call(_this, status);
                }
              }); // look for state
            }
          }); // look for zip code
        }
      }); // look for city and state
    }
  }); // look for full address
} // markByAddress

function addressSuccess(responce) {
  var geometry = responce[0].geometry;

  var lat = geometry.location.lat();
  var lng = geometry.location.lng();
  venueMap.marker({
    lat: lat,
    lng: lng
  });
  venueMap.mapCenter(lat, lng);
}

markByAddress({
  address: '#{venueStreetAddress}',
  cityState: '#{venueCity}, #{venueState}',
  zipCode: '#{venueZipCode}',
  state: '#{venueState}',
  success: addressSuccess,
  error: function error(responceStatus) {
    console.log(responceStatus);
  }
});

// passing in global namespaces to all the files
})(google);
