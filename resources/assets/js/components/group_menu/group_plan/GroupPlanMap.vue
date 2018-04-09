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
                // axios.get(this.$HttpAddr + '/xmltesting')
                // .then(response => {
                //     this.hikingPathCoordinates = response.data;
                // });
                this.hikingPathCoordinates = JSON.parse(
                    '[{"lng":126.96592798514101,"lat":37.60155863125204},{"lng":126.9659111087703,"lat":37.60155223340871},{"lng":126.96590222389557,"lat":37.60154686904736},{"lng":126.96588889733594,"lat":37.60153965997502},{"lng":126.96587783337624,"lat":37.60153245155533},{"lng":126.96586450630646,"lat":37.60152884824427},{"lng":126.96585344231288,"lat":37.601521722713414},{"lng":126.96584011411375,"lat":37.601518119399266},{"lng":126.96582460796263,"lat":37.60151267112532},{"lng":126.96580901745904,"lat":37.60151090967819},{"lng":126.96579577448476,"lat":37.60150914981044},{"lng":126.96578244661721,"lat":37.60150730612437},{"lng":126.96576685644114,"lat":37.60150730610837},{"lng":126.96575361346845,"lat":37.60150554623583},{"lng":126.96574028560299,"lat":37.60150370164404},{"lng":126.96572913814994,"lat":37.601498336612806},{"lng":126.96571807369016,"lat":37.601494733041214},{"lng":126.96570701003945,"lat":37.60148936893326},{"lng":126.96569586149656,"lat":37.60148392100742},{"lng":126.96568261759703,"lat":37.60147679572786},{"lng":126.96567373359458,"lat":37.601469587922814},{"lng":126.96566484846191,"lat":37.60146237921578},{"lng":126.96565370102006,"lat":37.60145701507839},{"lng":126.96564045664277,"lat":37.60145340996409},{"lng":126.96562712988286,"lat":37.60145165005296},{"lng":126.96561153971834,"lat":37.601451650016394},{"lng":126.96559603335369,"lat":37.60145165000224},{"lng":126.96558270550135,"lat":37.60144980629363},{"lng":126.96556719974086,"lat":37.601453410238115},{"lng":126.96555169337582,"lat":37.601453410218134},{"lng":126.96553610321095,"lat":37.601453410171615},{"lng":126.96552059571347,"lat":37.60145341014719},{"lng":126.96550953240325,"lat":37.60144980565539},{"lng":126.96549838384152,"lat":37.60144444240394},{"lng":126.96548732053367,"lat":37.60144083791001},{"lng":126.96547625577551,"lat":37.60143547287903},{"lng":126.96546292927648,"lat":37.60142826465946},{"lng":126.96544960111294,"lat":37.601424661301174},{"lng":126.96543853667829,"lat":37.60142105590137},{"lng":126.96542738925885,"lat":37.60141569174256},{"lng":126.9654140625495,"lat":37.60141384801526},{"lng":126.96539855619267,"lat":37.601413847975145},{"lng":126.96538304870343,"lat":37.60141384793268},{"lng":126.96536754347905,"lat":37.6014138478888},{"lng":126.96535195219,"lat":37.60141384781763},{"lng":126.96533862485163,"lat":37.60140848301051},{"lng":126.96523089124608,"lat":37.60137914299942}]'
                );
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
            this.getMountainLocationFromServer();
            
            // this.hikingPathCoordinates.push({ lat:36.9579208734, lng:128.478755475 });
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