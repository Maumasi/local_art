// ======================================================================
// generate maps

  // map options
  const options = options();

  const venueMapElement = document.getElementById('venue-map')

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

  const p1 = venueMap.marker(point1);
  const p2 = venueMap.marker(point2);

  console.log(venueMap.markerCollection);

  venueMap._deleteMarker(p2);

  console.log(p2);

  console.log(venueMap.markerCollection);
