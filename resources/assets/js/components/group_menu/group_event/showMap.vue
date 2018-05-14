<template>
    <div id="map" style="height: 500px;"></div>
</template>

<script>
    export default {
        data() {
            return {
                flightPlanCoordinates: [],
                flightPath: []
            }
        },
        name: "show-map",
        created() {
            this.$EventBus.$on('eventShowMap', (code, route) => {
                this.initMap(code, route);
            });
        },
        methods: {
            initMap(code, route) {
                var flightPlanCoordinates = [];
                var flightPath = [];
                var map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 11,
                    mapTypeId: 'terrain'
                });

                for (let i = 0; i < route.length; i++) {
                    this.axios.get('http://hikonnect.ga:3000/paths/' + code + '/' + route[i])
                        .then(response => {
                            this.flightPlanCoordinates[i] = response.data.geometry.paths[0];
                            this.flightPath[i] = new window.google.maps.Polyline({
                                path: this.flightPlanCoordinates[i],
                                geodesic: true,
                                strokeColor: '#FFC107',
                                strokeWeight: 5
                            });
                            this.flightPath[i].setMap(map);
                            map.setCenter(this.flightPlanCoordinates[0][0]);
                        });
                    this.flightPlanCoordinates;
                }
            }
        }
    }
</script>

<style scoped>

</style>