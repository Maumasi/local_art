// ======================================================================
// generate maps

const venueStreetAddress = document.getElementById('geo-streetAddress').textContent;
const venueCity = document.getElementById('geo-city').textContent;
const venueState = document.getElementById('geo-state').textContent;
const venueZipCode = document.getElementById('geo-zip-code').textContent;

// map options
const options = options();

const venueMapElement = document.getElementById('venue-map');
const GEO = new google.maps.Geocoder();

// remove any markers if there are any
setMapOnAll(null);

// map
const venueMap = new Map(venueMapElement, options);

const point1 = {
  lat: 37,
  lng: -122,
  content: 'point 1',
};

const point2 = {
  lat: 36,
  lng: -122,
  content: 'point 2',
};

// markers
const p1 = venueMap.marker(point1);
const p2 = venueMap.marker(point2);


function markByAddress(options) {
  const { address, cityState, zipCode, state, success, error } = options;
  const { OK } = google.maps.GeocoderStatus;
  GEO.geocode({ address }, (responce, status) => {
    if(status === OK) {
      console.log(responce);
      console.log('fullAddress');
      success.call(this, responce, status);
    } else {
      GEO.geocode({ address: cityState }, (responce, status) => {
        if(status === OK) {
          console.log(responce);
          console.log('cityState');
          success.call(this, responce, status);
        } else {
          GEO.geocode({ address: zipCode }, (responce, status) => {
            if(status === OK) {
              console.log(responce);
              console.log('zipCode');
              success.call(this, responce, status);
            } else {
              GEO.geocode({ address: state }, (responce, status) => {
                if(status === OK) {
                  console.log(responce);
                  console.log('state');
                  success.call(this, responce, status);
                } else {
                  console.log(status);
                  error.call(this, status);
                }
              });// look for state
            }
          });// look for zip code
        }
      });// look for city and state
    }
  });// look for full address
}// markByAddress

function addressSuccess(responce) {
  const { geometry } = responce[0];
  const lat = geometry.location.lat();
  const lng = geometry.location.lng();
  venueMap.marker({
    lat,
    lng,
  });
  venueMap.mapCenter(lat, lng);
}


markByAddress({
  address: `#{venueStreetAddress}`,
  cityState: `#{venueCity}, #{venueState}`,
  zipCode: `#{venueZipCode}`,
  state: `#{venueState}`,
  success: addressSuccess,
  error: (responceStatus) => {
    console.log(responceStatus);
  }
});
