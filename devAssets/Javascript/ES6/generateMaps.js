// ======================================================================
// generate maps

  // map options
  const options = options();

  const venueMapElement = document.getElementById('venue-map')

  // map
  const venueMap = new Map(venueMapElement, options);

  venueMap.zoom(15);

  venueMap.on('click', () => {
    alert('zoom is ' + venueMap.zoom());
  });

  console.log(venueMap.zoom());
