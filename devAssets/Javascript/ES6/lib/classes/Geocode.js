

class Geocode extends ArrayCollection {
  constructor() {
    super();
    this._geo = new google.maps.Geocoder();
  }
}
