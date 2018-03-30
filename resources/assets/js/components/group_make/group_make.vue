<template>
    <div class="container">
        <!-- https://github.com/charliekassel/vuejs-autocomplete -->
        <autocomplete
                ref="autocomplete"
                placeholder="Search Distribution Groups(name)"
                :source="distributionGroupsEndpoint"
                input-class="form-control"
                results-property="data"
                :results-display="formattedDisplay"
                @selected="addDistributionGroup"
                style="width: 200px">
        </autocomplete>
        <b-btn v-b-modal.modal1 v-on:click="initMap">지도보기</b-btn>
        <div id="map" style="height: 200px"></div>
    </div>
</template>

<script>
    import { EventBus } from './event_bus.js';
    import Autocomplete from 'vuejs-auto-complete'

    export default {
        data()   {
            return  {
                path: {},
                mountain_para: ''
            }
        },
        components: {
            Autocomplete
        },
        methods: {
            send_serch() {
                EventBus.$emit('mountain_name', this.mountain_para,);
            },
            initMap()   {
                let map = new window.google.maps.Map(document.getElementById('map'), {
                    zoom: 20,
                    center: {lat: this.path[0][0].lat, lng: this.path[0][0].lng},
                    mapTypeId: 'terrain'
                });

                let flightPlanCoordinates = this.path[0];
                let flightPath = new window.google.maps.Polyline({
                    path: flightPlanCoordinates,
                    geodesic: true,
                    strokeColor: '#FF0000',
                    strokeOpacity: 1.0,
                    strokeWeight: 2
                });

                flightPath.setMap(map);
            },
            distributionGroupsEndpoint (n) {
                return 'http://127.0.0.1:8000/testing/' + n;
            },
            addDistributionGroup (group) {
                //this.mountain_para = group.selectedObject.display;
                this.mountain_para = group.display;
                this.getData(group.selectedObject.code);
                this.$refs.autocomplete.clearValues();
                this.$refs.autocomplete.value = group.display;
            },
            formattedDisplay (result) {
                return result.name;
            },
            getData (n)  {
                axios.get('http://hikonnect.ga:3000/paths/'+ n + '/0')
                    .then(response => {
                        this.path = response.data.geometry.paths;
                        console.log(this.path[0]);
                    }

                )
            }
        }
    }
</script>