// Weather widget using free Open-Meteo (no API key needed)
(function(){
  const box=document.getElementById('weather-box'); if(!box) return;
  function load(lat,lon){
    fetch(`https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current=temperature_2m,relative_humidity_2m,apparent_temperature,wind_speed_10m,weather_code`)
    .then(r=>r.json()).then(d=>{const c=d.current; box.textContent=`${c.temperature_2m}°, Your Location, Code ${c.weather_code}, ${c.wind_speed_10m} km/h, ${c.relative_humidity_2m}%, Feels ${c.apparent_temperature}°`;})
    .catch(()=>{box.textContent='Weather unavailable right now.';});
  }
  if(navigator.geolocation){ navigator.geolocation.getCurrentPosition(p=>load(p.coords.latitude,p.coords.longitude),()=>load(23.81,90.41)); }
  else load(23.81,90.41);
})();
