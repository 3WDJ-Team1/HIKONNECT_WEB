<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div id="map" style="height: 400px;"></div>
</template>

<script>
    export default {
        data() {
            return {
            }
        },
        name: "show-map",
        created() {
            // 지도의 코드번호와 경로를 전달 받는다.
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
                            flightPlanCoordinates[i] = response.data.geometry.paths[0];
                            flightPath[i] = new window.google.maps.Polyline({
                                path: flightPlanCoordinates[i],
                                geodesic: true,
                                strokeColor: '#FFC107',
                                strokeWeight: 5
                            });
                            flightPath[i].setMap(map);
                            map.setCenter(flightPlanCoordinates[0][0]);
                        });
                }
            }
        }

    }
</script>

<style scoped>

</style>