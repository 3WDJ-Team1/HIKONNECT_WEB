<template>
    <div id="map" style="height: 600px; width: 90%; margin: 0 auto; background-color: white; border: 1px solid whitesmoke;">

    </div>
</template>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBAxuXFnvSopsfKoJjoXKXnm-BnjNdzAYk"
    async defer></script>
<script>
    // var flightPlanCoordinates = [
    //     {lat: 34.41393967569032, lng: 130.81275514951554},
    //     {lat: 37.5530885707, lng: 127.099901279},
    //     {lat: -18.142, lng: 178.431},
    //     {lat: -27.467, lng: 153.027}
    // ];
    // var flightPath = new VueGoogleMaps.maps.Polyline({
    //     path: flightPlanCoordinates,
    //     geodesic: true,
    //     strokeColor: '#FF0000',
    //     strokeOpacity: 1.0,
    //     strokeWeight: 2
    // });

    // flightPath.setMap(map);
    // google maps
    export default {
        data: () => ({
            httpAddr        : Laravel.host,
            options         : {
                                center  : { lat: 36, lng: 129 },
                                zoom    : 15
                              },
            mountainLocation: [
                // { lat: n, lng: m }
            ]
        }),
        methods: {
            getMountainLocationFromServer () {
                axios.get(this.httpAddr + '/xmltesting')
                .then(response => {
                    mountainLocation = response.data;
                });
            },
            createMap: function() {
                var map = new google.maps.Map(document.getElementById('map'), this.options);
            }
        },
        // 
        created() {
            google.maps.event.addDomListener(window, "load", this.createMap);
            this.getMountainLocationFromServer();
        }
    }
</script>

<style>
    
</style>