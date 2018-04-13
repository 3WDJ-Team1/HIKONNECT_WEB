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
        <div id="map" style="height: 500px"></div>
    </div>
</template>

<script>
    import Autocomplete from 'vuejs-auto-complete'

    export default {
        data() {
            return {
                // 산 코드
                mountain_num: "",

                // 등산 경로마다 지도에 찍기 위한 속성 적용
                flightPath: [],

                mountain_path: [],

                mouseover_out: true,

                mountain_path_string: null

            }
        },
        components: {
            Autocomplete
        },
        methods: {
            // 지도 api
            initMap() {
                // 산마다 배정되는 등산 경로의 배열
                let mountain_center = '';
                let flightPlanCoordinates = [];
                let alert_mes = true;
                let mountain_num = this.mountain_num;
                let path = new Array;
                let send_data = [];
                let map = new window.google.maps.Map(document.getElementById('map'), {
                    zoom: 11,
                    mapTypeId: 'terrain'
                });
                // 위도와 경도 불러오기
                axios.get('http://hikonnect.ga:3000/paths/' + this.mountain_num)
                    .then(response => {
                            // 지도의 중심 지점 변수지정
                            mountain_center = response.data[0].geometry.paths[0][0];

                            // 산마다 배정되는 경로의 개수만큼 지도에 찍는 for문
                            for (let i = 0; i < response.data.length; i++) {
                                // 각 경로 배당
                                flightPlanCoordinates[i] = response.data[i].geometry.paths[0];

                                // 각 경로마다 속성 적용
                                this.flightPath[i] = new window.google.maps.Polyline({
                                    // 적용될 경로의 배열
                                    path: flightPlanCoordinates[i],
                                    // 마우스가 이미 지나쳤는지 아닌지
                                    mouseover_out: true,
                                    // 경로를 보여줄지 안 보여줄지
                                    geodesic: true,
                                    // 경로의 선 색깔
                                    strokeColor: '#FF0000',
                                    // 경로 선 굵기
                                    strokeWeight: 5
                                });

                                // 경로에 마우스를 올릴 때 이벤트
                                this.flightPath[i].addListener('mouseover', function () {
                                    if (this.mouseover_out == true)
                                        this.setOptions({
                                                strokeColor: '#FF0000',
                                                strokeWeight: 7
                                            }
                                        );
                                    else
                                        this.setOptions({
                                                strokeColor: '#000000',
                                                strokeWeight: 5,
                                            }
                                        );
                                });
                                // 경로를 클릭 했을 때 이벤트
                                this.flightPath[i].addListener('click', function () {
                                    let fir_lat = flightPlanCoordinates[i][0].lat;
                                    let fir_lng = flightPlanCoordinates[i][0].lng;
                                    let end_lat = flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lat;
                                    let end_lng = flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lng;
                                    alert_mes = true;
                                    if (send_data.length == 0) {
                                        send_data.push({course: [{fir_lat, fir_lng}, {end_lat, end_lng}]});
                                        console.log(send_data[0].course[0].fir_lat);
                                        console.log(send_data[0].course[0].fir_lng);
                                        console.log(send_data[0].course[1].end_lat);
                                        console.log(send_data[0].course[1].end_lng);
                                        alert('처음');
                                    }
                                    else {
                                        for (let r = 0; r < send_data.length; i++) {
                                            if(send_data[r].course[0].fir_lat == fir_lat && send_data[0].course[0].fir_lng == fir_lng) {
                                                alert_mes = false;
                                                console.log('ok')
                                            }
                                            else if(send_data[r].course[0].fir_lat == end_lat && send_data[0].course[0].fir_lng == end_lng) {
                                                alert_mes = false;
                                                console.log('ok')
                                            }
                                            else if(send_data[r].course[1].end_lat == fir_lat && send_data[0].course[1].end_lng == fir_lng) {
                                                alert_mes = false;
                                                console.log('ok')
                                            }
                                            else if(send_data[r].course[1].end_lat == end_lat && send_data[0].course[1].end_lng == end_lng) {
                                                alert_mes = false;
                                                console.log('ok')
                                            }
                                        }
                                        if(alert_mes == true)   {
                                            alert('No');
                                        }
                                    }
                                    this.$EventBus.$emit('mountain_path', path);
                                });


                                // 경로에서 마우스가 벗어났을 때 이벤트
                                this.flightPath[i].addListener('mouseout', function () {
                                    if (this.mouseover_out == true) {
                                        this.setOptions({
                                                strokeColor: '#FF0000',
                                                strokeWeight: 5
                                            }
                                        );
                                    }
                                    else {
                                        this.setOptions({
                                                strokeColor: '#000000',
                                                strokeWeight: 5
                                            }
                                        );
                                    }
                                });
                                this.flightPath[i].setMap(map);
                            }
                            // 지도의 중심 위도, 경도 입력
                            map.setCenter({lat: mountain_center.lat, lng: mountain_center.lng});
                        }
                    );
            },
            // pull autocomplete data
            distributionGroupsEndpoint(n) {
                //return process.env.API + '/distribution/search?query='
                return 'http://localhost:8000/testing/' + n;
            },
            // drop down이 보여지도록
            addDistributionGroup(group) {
                // 산 코드
                this.mountain_num = group.selectedObject.code;
                // input에 썼던 text지우기
                this.$refs.autocomplete.clearValues();
                // 내가 클릭한 text로 채우기
                this.$refs.autocomplete.value = group.display;
            },

            // drop down에 보여질 text
            formattedDisplay(result) {
                return result.name;
            }
        }
    }
</script>