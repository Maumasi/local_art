"use strict";!function(){console.log("demo file")}();

"use strict";function _classCallCheck(e,n){if(!(e instanceof n))throw new TypeError("Cannot call a class as a function")}var _createClass=function(){function e(e,n){for(var t=0;t<n.length;t++){var a=n[t];a.enumerable=a.enumerable||!1,a.configurable=!0,"value"in a&&(a.writable=!0),Object.defineProperty(e,a.key,a)}}return function(n,t,a){return t&&e(n.prototype,t),a&&e(n,a),n}}();!function(e,n){var t=function(){function e(t,a){_classCallCheck(this,e),this.map=new n.maps.Map(t,a)}return _createClass(e,[{key:"zoom",value:function(e){e?this.map.setZoom(e):this.map.getZoom()}}]),e}();t.create=function(e,n){return new t(e,n)},e.MapMethods=t}(window,google);