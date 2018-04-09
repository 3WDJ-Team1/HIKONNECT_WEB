<template>
    <div class="container">
        <div id="map" class="google_map"></div>
    </div>
</template>

<script>
    import Vue from 'vue'
    import { EventBus } from './event_bus.js';
    export default {
        beforeCreate: function ()
        {
            // 이벤트 받기
            // '이벤트 명', function(받을 데이터)
            EventBus.$on('mountain_code', function (para) {
                this.mountain_para =  para;
                console.log(para);
            });
        },
        data: () => ({
            mountain_para: "",
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
                axios.get(this.$HttpAddr + '/xmltesting')
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

<style scoped>

</style>








<template>
    <div class="container">
        <div class="card" v-for="group_information in groups_list_imformation.groupInformations">
            <div class="card-header">
                {{ group_information.title }}
            </div>
            <div class="card-body">
                <p>{{ group_information.owner }} = 작성자</p>
                <p>{{ group_information.end_point }} = 목적지</p>
                <p>{{ group_information.startdate }} = 산행일자 </p>
                <p>{{ group_information.min_members }} = 최소인원수</p>
                <p>{{ group_information.max_members }} = 최대인원수</p>
            </div>
        </div>
        <infinite-loading @infinite="infiniteHandler"></infinite-loading>
    </div>
</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading';
    import {EventBus} from './event_bus'

    export default {
        data() {
            return {
                pageIndex: 0,
                loading: true,
                search_imformations: {
                    mountain_name: '',
                    writer: '',
                    date: ''
                },
                groups_list_imformation: {}
            }
        },
        created: function () {
            this.fetchItem();
            EventBus.$on('input_serch', function (mountain_name, writer, date) {
                this.mountain_name = mountain_name;
                this.writer = writer;
                this.date = date;
            });
        },
        methods: {
            fetchItem() {
                axios.get('http://localhost:8000/group/0/10')
                    .then(response => {
                        this.groups_list_imformation = response.data;
                    })
            },
            infiniteHandler($state) {
                // setTimeout(() => {
                //     const temp = [];
                //     for (let i = this.list.length + 1; i <= this.list.length + 20; i++) {
                //         temp.push(i);
                //     }
                //     this.list = this.list.concat(temp);
                //     $state.loaded();
                // }, 1000);
            },
        },
        components: {
            InfiniteLoading,
        }
    }
</script>
