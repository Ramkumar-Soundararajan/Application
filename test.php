<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
function showResult(result) {
    document.getElementById('latitude').value = result.geometry.location.lat();
    document.getElementById('longitude').value = result.geometry.location.lng();
}

function getLatitudeLongitude(callback, address) {
    // If adress is not supplied, use default value 'Ferrol, Galicia, Spain'
    address = address || 'Ferrol, Galicia, Spain';
    // Initialize the Geocoder
    geocoder = new google.maps.Geocoder();
	alert(geocoder); return false;
    if (geocoder) {
        geocoder.geocode({
            'address': address
        }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK) {
                callback(results[0]);
            }
        });
    }
}

//var button = document.getElementById('btn');

function myFunction() {
    var address = document.getElementById('address').value;
    getLatitudeLongitude(showResult, address)
}
</script>
<div>
     <h3> Enter an adress and press the button</h3>

    <input id="address" type="text" placeholder="Enter address here" />
    <button id="btn" onclick="myFunction()">Get LatLong</button>
    <div>
        <p>Latitude:
            <input type="text" id="latitude" readonly />
        </p>
        <p>Longitude:
            <input type="text" id="longitude" readonly />
        </p>
    </div>
</div>