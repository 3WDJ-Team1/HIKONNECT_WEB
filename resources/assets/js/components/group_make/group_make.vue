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
    import {EventBus} from './event_bus.js';
    import Autocomplete from 'vuejs-auto-complete'

    export default {
        data() {
            return {
                // 산 코드
                mountain_num: "",

                // 지도에 표시될 중심 지점
                mountain_center: "",

                // 산마다 배정되는 등산 경로의 배열
                flightPlanCoordinates: [],

                // 등산 경로마다 지도에 찍기 위한 속성 적용
                flightPath: [],

                mountain_path: [],

                mouseover_out: true,

            }
        },
        components: {
            Autocomplete
        },
        methods: {
            // 지도 api
            initMap() {
                let mountain_num = this.mountain_num;
                let path = new Array;
                let map = new window.google.maps.Map(document.getElementById('map'), {
                    zoom: 11,
                    mapTypeId: 'terrain'
                });

                // 위도와 경도 불러오기
                //axios.get('http://hikonnect.ga:3000/paths/' + this.mountain_num)
                axios.get('http://hikonnect.ga:3000/paths/281100601')
                    .then(response => {
                            // 지도의 중심 지점 변수지정
                            this.mountain_center = response.data[0].geometry.paths[0][0];

                            // 산마다 배정되는 경로의 개수만큼 지도에 찍는 for문
                            for (let i = 0; i < response.data.length; i++) {
                                // 각 경로 배당
                                this.flightPlanCoordinates[i] = response.data[i].geometry.paths[0];

                                // 각 경로마다 속성 적용
                                this.flightPath[i] = new window.google.maps.Polyline({
                                    // 적용될 경로의 배열
                                    path: this.flightPlanCoordinates[i],
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
                                    if (this.mouseover_out == true) {
                                        this.setOptions({
                                                strokeColor: '#000000',
                                                strokeWeight: 5,
                                                mouseover_out: false
                                            }
                                        );
                                        // group_make_main에 보내줄 최종 경로에 추가
                                        path.push(i);
                                    }
                                    else {
                                        this.setOptions({
                                                strokeColor: '#FF0000',
                                                strokeWeight: 5,
                                                mouseover_out: true
                                            }
                                        );
                                        // group_make_main에 보내줄 최종 경로에서 삭제
                                        for (let n = 0; n < path.length; n++) {
                                            if (path[n] == i) {
                                                path.splice(n, 1)
                                            }
                                        }
                                    }
                                    EventBus.$emit('mountain_path', path);
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
                            map.setCenter({lat: this.mountain_center.lat, lng: this.mountain_center.lng});
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