let weatherApikey = drupalSettings.weatherKey;
let basePoint =
  "https://api.openweathermap.org/data/2.5/weather?appid=" +
  weatherApikey +
  "&units=metric";

let geocodingBaseEndPoint =
  "https://api.openweathermap.org/geo/1.0/direct?&limit=5&appid=" +
  weatherApikey +
  "&q=";

let getCityName = document.querySelector("#search");
let city = document.querySelector(".weather_city");
let day = document.querySelector(".weather_day");
let humidity = document.querySelector(".weather_indicator--humidity > .value");
let wind = document.querySelector(".weather_indicator--wind > .value");
let pressure = document.querySelector(".weather_indicator--pressure > .value");
let temperature = document.querySelector(".weather_temperature > .value");
let image = document.querySelector(".weather_image");
let dataList = document.querySelector("#suggestions");
let weatherImages = [
  {
    url: "https://myblog.ddev.site/modules/custom/weather_app/images/broken-clouds.png",
    ids: [803, 804],
  },
  {
    url: "https://myblog.ddev.site/modules/custom/weather_app/images/clear-sky.png",
    ids: [800],
  },
  {
    url: "https://myblog.ddev.site/modules/custom/weather_app/images/few-clouds.png",
    ids: [801],
  },
  {
    url: "https://myblog.ddev.site/modules/custom/weather_app/images/mist.png",
    ids: [701, 711, 721, 731, 741, 751, 761, 762, 771, 781],
  },
  {
    url: "https://myblog.ddev.site/modules/custom/weather_app/images/rain.png",
    ids: [500, 501, 502, 503, 504],
  },
  {
    url: "https://myblog.ddev.site/modules/custom/weather_app/images/scattered-clouds.png",
    ids: [802],
  },
  {
    url: "https://myblog.ddev.site/modules/custom/weather_app/images/shower-rain.png",
    ids: [520, 521, 522, 531, 300, 301, 302, 310, 311, 312, 313, 314, 315],
  },
  {
    url: "https://myblog.ddev.site/modules/custom/weather_app/images/snow.png",
    ids: [511, 600, 601, 602, 611, 612, 613, 615, 616, 620, 621, 622],
  },
  {
    url: "https://myblog.ddev.site/modules/custom/weather_app/images/thunderstorm.png",
    ids: [200, 201, 202, 210, 211, 212, 221, 230, 231, 232],
  },
];

let getWeatherBycityName = async (city) => {
  let endpoint = basePoint + "&q=" + city;
  let response = await fetch(endpoint);
  let weather = await response.json();
  return weather;
};

let updateCurrentWeather = async (data) => {
  console.log(data);
  city.innerText = data.name;
  day.innerText = new Date().toLocaleDateString("en-En", { weekday: "long" });
  humidity.innerText = data.main.humidity;
  pressure.innerText = data.main.pressure;
  let windDirection;
  let deg = data.wind.deg;
  if (deg > 45 && deg <= 135) {
    windDirection = "East";
  } else if (deg > 135 && deg <= 225) {
    windDirection = "South";
  } else if (deg > 225 && deg <= 315) {
    windDirection = "West";
  } else {
    windDirection = "North";
  }
  wind.innerText = windDirection;
  temperature.innerText =
    data.main.temp > 0
      ? "+" + Math.round(data.main.temp)
      : Math.round(data.main.temp);
  let imgID = data.weather[0].id;
  weatherImages.forEach((obj) => {
    if (obj.ids.indexOf(imgID) != -1) {
      image.src = obj.url;
    }
  });
};

let weatherForCity = async (city) => {
  let weather = await getWeatherBycityName(city);
  if (weather.cod === "404") {
    alert(weather.message);
    return;
  }
  updateCurrentWeather(weather);
};

getCityName.addEventListener("keydown", (e) => {
  if (e.keyCode === 13) {
    weatherForCity(getCityName.value);
  }
});

getCityName.addEventListener("input", async (e) => {
  if (getCityName.value.lenght <= 2) {
    return;
  }
  let endpoint = geocodingBaseEndPoint + getCityName.value;
  let result = await fetch(endpoint);
  result = await result.json();
  dataList.innerHTML = "";
  result.forEach((city) => {
    let option = document.createElement("option");
    option.value = `${city.name},${city.state},${city.country}`;
    dataList.appendChild(option);
  });
});
