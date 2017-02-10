"use strict";

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

(function (global, google) {
  var MapMethods = function () {
    function MapMethods(element, options) {
      _classCallCheck(this, MapMethods);

      this.map = new google.maps.Map(element, options);
    }

    // getter and setter for map zoom distance


    _createClass(MapMethods, [{
      key: "zoom",
      value: function zoom(distance) {
        if (distance) {
          this.map.setZoom(distance);
        } else {
          this.map.getZoom();
        }
      }
    }]);

    return MapMethods;
  }();

  MapMethods.create = function (element, options) {
    return new MapMethods(element, options);
  };

  global.MapMethods = MapMethods;
})(window, google);