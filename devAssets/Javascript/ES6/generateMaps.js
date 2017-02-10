// ======================================================================
// generate maps

const url = /details\/venue/;
const venueDetailsPage = window.location.href.match(url);
const options = options();
const GEO = new google.maps.Geocoder();

if(venueDetailsPage !== null) {
  const venueStreetAddress = document.getElementById('geo-streetAddress').textContent;
  const venueCity = document.getElementById('geo-city').textContent;
  const venueState = document.getElementById('geo-state').textContent;
  const venueZipCode = document.getElementById('geo-zip-code').textContent;
  const venueMapElement = document.getElementById('venue-map');

  // map
  const venueMap = new Map(venueMapElement, options);

  function markByAddress(options) {
    const { address, cityState, zipCode, state, success, error } = options;
    const { OK } = google.maps.GeocoderStatus;
    GEO.geocode({ address }, (responce, status) => {
      if(status === OK) {
        console.log('fullAddress');
        success.call(this, responce, status);
      } else {
        GEO.geocode({ address: cityState }, (responce, status) => {
          if(status === OK) {
            console.log('cityState');
            success.call(this, responce, status);
          } else {
            GEO.geocode({ address: zipCode }, (responce, status) => {
              if(status === OK) {
                console.log('zipCode');
                success.call(this, responce, status);
              } else {
                GEO.geocode({ address: state }, (responce, status) => {
                  if(status === OK) {
                    console.log('state');
                    success.call(this, responce, status);
                  } else {
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
    address: venueStreetAddress,
    cityState: `${venueCity}, ${venueState}`,
    zipCode: venueZipCode,
    state: venueState,
    success: addressSuccess,
    error: (responceStatus) => {
      console.log(responceStatus);
    }
  });

}
