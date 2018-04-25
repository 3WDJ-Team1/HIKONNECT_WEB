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
            options                 : {
                                        center  : { lat: 36.9579208734, lng: 128.4 },
                                        zoom    : 11
                                      },
                                      
            map                     : {},
            hikingPathCoordinates   : [
                // { lat: n, lng: m }
                                        // {lat: 37.772, lng: -122.214},
                                        // {lat: 21.291, lng: -157.821},
                                        // {lat: -18.142, lng: 178.431},
                                        // {lat: -27.467, lng: 153.027}
                                      ],
            polyLineOptions         : {
                                        path            : [],
                                        geodesic        : true,
                                        strokeColor     : "#FF0000",
                                        strokeOpacity   : 1.0,
                                        strokeWeight    : 5
                                      },
            hikingPath              : {},
            groupId                 : ""
        }),
        methods: {
            getMountainLocationFromServer () {
                
            },
            createMap() {
                // google maps
                this.map = new window.google.maps.Map(document.getElementById('map'), this.options);
            },
            createPolyLine() {
                this.hikingPath = new window.google.maps.Polyline(this.polyLineOptions);
                this.hikingPath.setMap(this.map);
            },
        },
        // 
        created() {
            google.maps.event.addDomListener(window, "load", this.createMap);
            google.maps.event.addDomListener(window, "load", this.createPolyLine);
            this.groupId = this.$route.params.groupid;
            // this.groupId = "ed9c160c-e1d1-5739-1ebd-ee1dd110a8c8";
            axios.get(this.$HttpAddr + '/hikingPlan/' + this.groupId)
                .then(response => {
                    console.log(response.data[0].starting_point);
                    this.hikingPathCoordinates = JSON.parse(response.data[0].starting_point);
                    console.log(this.hikingPathCoordinates);
                    this.polyLineOptions.path = this.hikingPathCoordinates;
                    // this.options.center = this.hikingPathCoordinates[0];
                    this.createPolyLine();
            });;
            
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