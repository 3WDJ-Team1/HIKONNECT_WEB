<!-- 
    @file   GroupPlanMap.vue
    @brief  A component of map
    @author Sungeun Kang <kasueu0814@gmail.com>
    @todo   write plz
 -->
<template>
    <!-- here's a map -->
    <div id="map" class="google_map">
    </div>
</template>

<script>
    export default {
        data: () => ({
            /**
             * httpAddr                 (String)    The http address of server
             * options                  (Object)    The options used for creating a map
             *      - center            (Object)    The location of center of map
             *              - lat       (Number)    The latitude of the location
             *              - lng       (Number)    The longitude of the loation
             *      - zoom              (Number)    The degree of Zoom in
             * map                      (Object)    Created map object
             * hikingPathCoordinates    (Array)     The coordination of hiking path location object
             * polyLineOptions          (Object)    The options used for drawing polyline on the map
             *      - path              (Object)    The coordination of hiking path loacation object (hikingPathCoordinates)
             *      - geodesic          (Boolean)   Is the polyline geodesic
             *      - strokeColor       (String)    The color of stroke
             *      - strokeOpacity     (Number)    The opacity of stroke
             *      - strokeWeight      (Number)    The weight of stroke
             * hikingPath               (Object)    Created Polyline object
             */
            httpAddr                : Laravel.host,
            options                 : {
                                        center  : { lat: 36.9579208734, lng: 128.4 },
                                        zoom    : 15
                                      },
                                      
            map                     : {},
            hikingPathCoordinates   : [
                // { lat: n, lng: m }
                                        {lat: 37.772, lng: -122.214},
                                        {lat: 21.291, lng: -157.821},
                                        {lat: -18.142, lng: 178.431},
                                        {lat: -27.467, lng: 153.027}
                                      ],
            polyLineOptions         : {
                                        path            : [],
                                        geodesic        : true,
                                        strokeColor     : "#FF0000",
                                        strokeOpacity   : 1.0,
                                        strokeWeight    : 2
                                      },
            hikingPath              : {},
        }),
        methods: {
            getMountainLocationFromServer () {
                axios.get(this.httpAddr + '/xmltesting')
                .then(response => {
                    this.hikingPathCoordinates = response.data;
                });
            },
            createMap: function() {
                // google maps
                this.map = new window.google.maps.Map(document.getElementById('map'), this.options);
            },
            createPolyLine: function() {
                this.hikingPath = new window.google.maps.Polyline(this.polyLineOptions);
                this.hikingPath.setMap(this.map);
            },
        },
        // 
        created() {
            google.maps.event.addDomListener(window, "load", this.createMap);
            google.maps.event.addDomListener(window, "load", this.createPolyLine);
            // this.getMountainLocationFromServer();
            
            this.hikingPathCoordinates.push({ lat:36.9579208734, lng:128.478755475 });
            this.polyLineOptions.path = this.hikingPathCoordinates;
        },
    }
</script>

<style>
    .google_map {
        height          : 500px;
        width           : 90%;
        margin          : 0 auto;
        background-color: white;
        border          : 1px solid whitesmoke;
    }
</style>