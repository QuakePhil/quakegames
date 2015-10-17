// re: http://www.w3schools.com/html/html5_geolocation.asp

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        alert("Geolocation is not supported by your browser");
    }
}

function showPosition(position) {
    getServers(position);
}