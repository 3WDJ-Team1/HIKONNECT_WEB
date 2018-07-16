<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div>
        <h3>ハイキング経路を決めてください。</h3>
        <div
                id="map"
                style="height: 420px;">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-info btn-fill float-right"
                    @click="resetMap">
                消す
            </button>
            <button type="submit" class="btn btn-info btn-fill float-right"
                    @click="mapModalSubmit">
                登録
            </button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            updateItem: {
                type: Object
            }
        },
        data() {
            return {
                // 산 코드
                mountain_num: '',
                // 등산 경로마다 지도에 찍기 위한 속성 적용
                flightPath: [],
                // 경로 색깔을 위해
                mouseover_out: true,
                route: []
            }
        },
        created() {
            this.$EventBus.$on('event_make_map', (num) => {
                this.mountain_num = num;
                this.makeMap();
            });
            this.$EventBus.$on('event_make_map_update', (num, route) => {
                this.mountain_num = num;
                this.route = route;
                this.makeMap();
            });

        },
        methods: {
            mapModalSubmit() {
                this.$parent.close();
            },
            resetMap()  {
                this.route = [];
                this.makeMap();
            },
            makeMap() {
                var event = this.$EventBus;
                // 지도의 중간지점
                var mountain_center = '';
                // 산 코스를 담을 배열
                var send_data = [];
                // 산 코스를 지우기 위해 지정한 배열
                var send_data_r = [];
                // 각 경로 배열
                var flightPlanCoordinates = [];
                // 산 코드번호
                var mountain_num = this.mountain_num;
                // 데이터이스로 보낼 산 코스 배열
                var path = [];
                var map = new window.google.maps.Map(document.getElementById('map'), {
                    zoom: 11,
                });
                ////////////////////////////////시종점 마커
                axios.get('http://hikonnect.ga:3000/spots/' + mountain_num).then(response => {
                    for (let p = 0; p < response.data.length; p++) {
                        if (response.data[p].attributes.DETAIL_SPO == "시종점") {
                            let pos_lat_a = response.data[p].geometry.lat.toString().split(".");
                            let pos_lat = pos_lat_a[1].substring(0, 10);
                            pos_lat_a = pos_lat_a[0] + "." + pos_lat;

                            let pos_lng_a = response.data[p].geometry.lng.toString().split(".");
                            let pos_lng = pos_lng_a[1].substring(0, 10);
                            pos_lng_a = pos_lng_a[0] + "." + pos_lng;

                            let marker = new google.maps.Marker({
                                map: map,
                                draggable: true,
                                animation: google.maps.Animation.DROP,
                                position: {lat: Number(pos_lat_a), lng: Number(pos_lng_a)}
                            });
                        }
                    }
                });
                //////////////////////////////////////////////// 위도와 경도 불러오기
                axios.get('http://hikonnect.ga:3000/paths/' + this.mountain_num)
                    .then(response => {
                            // 지도의 중심 지점 변수지정
                            mountain_center = response.data[0].geometry.paths[0][0];
                            // 산마다 배정되는 경로의 개수만큼 지도에 찍는 for문
                            for (let i = 0; i < response.data.length; i++) {
                                // 각 경로 배당
                                flightPlanCoordinates[i] = response.data[i].geometry.paths[0];
                                // 경로의 가장 앞 지점의 lat, lng
                                let fir_lat = flightPlanCoordinates[i][0].lat;
                                let fir_lng = flightPlanCoordinates[i][0].lng;

                                // 현재 경로의 가장 뒤 지점의 lat, lng
                                let end_lat = flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lat;
                                let end_lng = flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lng;

                                // 각 경로마다 속성 적용
                                this.flightPath[i] = new window.google.maps.Polyline({
                                    path: flightPlanCoordinates[i], // 경로 배열
                                    mouseover_out: true,                     // 마우스가 이미 지나쳤는지 아닌지
                                    geodesic: true,                     // 경로를 보여줄지 안 보여줄지
                                    strokeColor: '#FFC107',                // 경로의 선 색
                                    strokeWeight: 5                         // 경로 선 굵기
                                });

                                if(this.route.length != 0)  {
                                    for (let a = 0; a < this.route.length; a++) {
                                        if (this.route[a] == i) {
                                            this.flightPath[i] = new window.google.maps.Polyline({
                                                path: flightPlanCoordinates[i], // 경로 배열// 마우스가 이미 지나쳤는지 아닌지
                                                geodesic: true,                     // 경로를 보여줄지 안 보여줄지// 경로 선 굵기
                                                strokeColor: '#FF0000',
                                                strokeWeight: 5,
                                                mouseover_out: false,
                                            });
                                            // group_make_main에 보내줄 최종 경로에 추가
                                            path.push(i);
                                            event.$emit('mountain_path', path, mountain_num);
                                            send_data.push({course: [{fir_lat, fir_lng}, {end_lat, end_lng}]});
                                        }
                                    }
                                }


                                //////////////////////////////////////////////// 경로에 마우스를 올릴 때 이벤트
                                this.flightPath[i].addListener('mouseover', function () {
                                    if (this.mouseover_out == true) {
                                        this.setOptions({
                                                strokeColor: '#FFC107',
                                                strokeWeight: 9
                                            }
                                        );
                                    } else {
                                        this.setOptions({
                                                strokeColor: '#FF0000',
                                                strokeWeight: 5,
                                            }
                                        );
                                    }
                                });
                                ////////////////////////////////////////////////// 경로를 클릭 했을 때 이벤트
                                this.flightPath[i].addListener('click', function () {
                                    // 경로 선택 시 이어지지 않으면 에러 발생
                                    let alert_mes = true;
                                    let alert_mes_r = true;
                                    let destination = '';

                                    // 경로 지울 때 이어지지 않으면 에러 발생
                                    let remove_path = 0;

                                    let fir_lat_c_a = fir_lat.toString().split(".");
                                    let fir_lat_c = fir_lat_c_a[1].substring(0, 10);
                                    fir_lat_c_a = Number(fir_lat_c_a[0] + "." + fir_lat_c);

                                    let fir_lng_c_a = fir_lng.toString().split(".");
                                    let fir_lng_c = fir_lng_c_a[1].substring(0, 10);
                                    fir_lng_c_a = Number(fir_lng_c_a[0] + "." + fir_lng_c);

                                    let end_lat_c_a = end_lat.toString().split(".");
                                    let end_lat_c = end_lat_c_a[1].substring(0, 10);
                                    end_lat_c_a = Number(end_lat_c_a[0] + "." + end_lat_c);

                                    let end_lng_c_a = end_lng.toString().split(".");
                                    let end_lng_c = end_lng_c_a[1].substring(0, 10);
                                    end_lng_c_a = Number(end_lng_c_a[0] + "." + end_lng_c);

                                    //////////////////////////////////////////////////////////// 시작점일 시
                                    if (send_data.length == 0) {
                                        let fir_end_B = true;
                                        axios.get('http://hikonnect.ga:3000/spots/' + mountain_num).then(response => {
                                            if (response) {
                                                for (let p = 0; p < response.data.length; p++) {
                                                    if (response.data[p].attributes.DETAIL_SPO == "시종점") {
                                                        let pos_lat_a = response.data[p].geometry.lat.toString().split(".");
                                                        let pos_lat = pos_lat_a[1].substring(0, 10);
                                                        pos_lat_a = Number(pos_lat_a[0] + "." + pos_lat);

                                                        let pos_lng_a = response.data[p].geometry.lng.toString().split(".");
                                                        let pos_lng = pos_lng_a[1].substring(0, 10);
                                                        pos_lng_a = Number(pos_lng_a[0] + "." + pos_lng);

                                                        // 시종점과 경로가 일치 한다면 배열에 넣어주기
                                                        if (pos_lat_a == fir_lat_c_a && pos_lng_a == fir_lng_c_a) {
                                                            fir_end_B = false;
                                                        } else if (pos_lat_a == end_lat_c_a && pos_lng_a == end_lng_c_a) {
                                                            fir_end_B = false;
                                                        }
                                                    }
                                                }
                                                // 시종점과 경로가 일치하므로 배열에 넣어준다.
                                                if (fir_end_B == false) {
                                                    this.setOptions({
                                                            strokeColor: '#FF0000',
                                                            strokeWeight: 5,
                                                            mouseover_out: false
                                                        }
                                                    );

                                                    // group_make_main에 보내줄 최종 경로에 추가
                                                    path.push(i);
                                                    event.$emit('mountain_path', path, mountain_num);
                                                    send_data.push({course: [{fir_lat, fir_lng}, {end_lat, end_lng}]});
                                                } else {
                                                    alert('시종점이 아닙니다.')
                                                }
                                            }
                                        });
                                    }
                                    // 시작점이 아닐 시
                                    else {
                                        // 이전의 경로와 일치하는 지점이 있다면 이어지므로 경로 추가를 승낙한다.
                                        for (let r = 0; r < send_data.length; r++) {
                                            if (send_data[r].course[0].fir_lat == fir_lat
                                                && send_data[r].course[0].fir_lng == fir_lng) {
                                                if (send_data[r].course[1].end_lat == end_lat
                                                    && send_data[r].course[1].end_lng == end_lng) {
                                                    alert_mes_r = false;
                                                    // 경로가 완전히 일치한다면 클릭시 다시 빨간색 선으로 고친다.
                                                    send_data_r = send_data;
                                                    send_data_r.splice(r, 1);

                                                    // 이어지는게 두개밖에 없다면 끊어지므로
                                                    for (let a = 0; a < send_data_r.length; a++) {
                                                        if (send_data_r[a].course[0].fir_lat == fir_lat
                                                            && send_data_r[a].course[0].fir_lng == fir_lng) {
                                                            remove_path++;
                                                        } else if (send_data_r[a].course[0].fir_lat == end_lat
                                                            && send_data_r[a].course[0].fir_lng == end_lng) {
                                                            remove_path++;
                                                        } else if (send_data_r[a].course[1].end_lat == fir_lat
                                                            && send_data_r[a].course[1].end_lng == fir_lng) {
                                                            remove_path++;
                                                        } else if (send_data_r[a].course[1].end_lat == end_lat
                                                            && send_data_r[a].course[1].end_lng == end_lng) {
                                                            remove_path++;
                                                        }
                                                    }
                                                    // 경로가 일치 하지 않으므로 경로 추가 승낙
                                                } else alert_mes = false;
                                            }
                                            // 경로가 일치 하지 않으므로 경로 추가 승낙
                                            else if (send_data[r].course[0].fir_lat == end_lat
                                                && send_data[r].course[0].fir_lng == end_lng) {
                                                alert_mes = false;
                                            }
                                            // 경로가 일치 하지 않으므로 경로 추가 승낙
                                            else if (send_data[r].course[1].end_lat == fir_lat
                                                && send_data[r].course[1].end_lng == fir_lng) {
                                                alert_mes = false;
                                            }
                                            // 경로가 일치 하지 않으므로 경로 추가 승낙
                                            else if (send_data[r].course[1].end_lat == end_lat
                                                && send_data[r].course[1].end_lng == end_lng) {
                                                alert_mes = false;
                                            }
                                        }
                                        if (remove_path >= 2) alert('경로가 끊어집니다.');
                                        else {
                                            if (this.mouseover_out == false) {
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
                                            event.$emit('mountain_path', path, mountain_num);
                                        }
                                        // 잘못된 경로라는 에러메시지 출력
                                        if (alert_mes == true && alert_mes_r == true) {
                                            alert('잘못된 경로입니다.');
                                        } else if (alert_mes == false && alert_mes_r == true) {
                                            // 종착지도 시종점 중 하나여야 겠죵?
                                            axios.get('http://hikonnect.ga:3000/spots/' + mountain_num).then(response => {
                                                if (response) {
                                                    for (let p = 0; p < response.data.length; p++) {
                                                        if (response.data[p].attributes.DETAIL_SPO == "시종점") {
                                                            let pos_lat_a = response.data[p].geometry.lat.toString().split(".");
                                                            let pos_lat = pos_lat_a[1].substring(0, 10);
                                                            pos_lat_a = Number(pos_lat_a[0] + "." + pos_lat);

                                                            let pos_lng_a = response.data[p].geometry.lng.toString().split(".");
                                                            let pos_lng = pos_lng_a[1].substring(0, 10);
                                                            pos_lng_a = Number(pos_lng_a[0] + "." + pos_lng);
                                                        }
                                                    }
                                                }
                                            });
                                            let double_path = 0;
                                            // 갈림길 방지: 하나의 지점을 1번 넘게 참조하면 안된다.
                                            for (let a = 0; a < send_data.length; a++) {
                                                if (send_data[a].course[0].fir_lat == fir_lat
                                                    && send_data[a].course[0].fir_lng == fir_lng) {
                                                    double_path++;
                                                } else if (send_data[a].course[0].fir_lat == end_lat
                                                    && send_data[a].course[0].fir_lng == end_lng) {
                                                    double_path++;
                                                } else if (send_data[a].course[1].end_lat == fir_lat
                                                    && send_data[a].course[1].end_lng == fir_lng) {
                                                    double_path++;
                                                } else if (send_data[a].course[1].end_lat == end_lat
                                                    && send_data[a].course[1].end_lng == end_lng) {
                                                    double_path++;
                                                }
                                            }
                                            if (double_path >= 2) {
                                                alert('갈릿길에서 하나의 길만 선택하시오.');
                                            } else {
                                                if (this.mouseover_out == true) {
                                                    this.setOptions({
                                                            strokeColor: '#FFC107',
                                                            strokeWeight: 5,
                                                            mouseover_out: false
                                                        }
                                                    );
                                                    path.push(i);
                                                    send_data.push({course: [{fir_lat, fir_lng}, {end_lat, end_lng}]});
                                                }
                                                event.$emit('mountain_path', path, mountain_num);
                                            }
                                        }
                                    }
                                });
                                // 경로에서 마우스가 벗어났을 때 이벤트
                                this.flightPath[i].addListener('mouseout', function () {
                                    if (this.mouseover_out == true) {
                                        this.setOptions({
                                                strokeColor: '#FFC107',
                                                strokeWeight: 5
                                            }
                                        );
                                    } else {
                                        this.setOptions({
                                                strokeColor: '#FF0000',
                                                strokeWeight: 5
                                            }
                                        );
                                    }
                                });
                                this.flightPath[i].setMap(map);
                            }
                            // 지도의 중심 위도, 경도 입력
                            map.setCenter({lat: mountain_center.lat, lng: mountain_center.lng});
                            this.axios.post('http://172.26.2.88:8000/api/tour'), {
                                latitude: mountain_center.lat,
                                longitude: mountain_center.lng
                            }
                        }
                    );
            }
        }
    }
</script>

<style scoped>

</style>