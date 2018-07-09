<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div>
        <div
                id="map"
                style="height: 800px; border-radius: 5px;">
        </div>
        <v-btn
                fab
                @click="removeMap"
                dark
                class="btn--right btn--floating btn--fixed btn--bottom"
                style="font-size: 20px; font-family: 'Do Hyeon', sans-serif; color: white; bottom: 187px; right: 5px; width: 50px; height: 50px;"
                color="blue">
            지우기
        </v-btn>
        <v-btn
                fab
                @click="mapModalSubmit"
                dark
                class="btn--right btn--floating btn--fixed btn--bottom"
                style="font-size: 20px; font-family: 'Do Hyeon', sans-serif; color: white; bottom: 130px; right: 5px; width: 50px; height: 50px;"
                color="red">
            저장
        </v-btn>
        <span style="
            padding-top: 5px;
            padding-bottom: 2px;
            position: absolute;
            background-color: white;
            left: 90px;
            top: 11px;
            font-size: 14px;
            padding-left: 6px;
            color: gray;
            border: 1px solid gray;
            border-radius: 3px;
            padding-right: 6px;"
              id="exp"
        >
            <i
                    class="nc-icon nc-zoom-split text-warning" style="margin-right: 5px;"></i>설명서
        </span>
        <b-tooltip target="exp" style="max-width: 1000px;" placement="right">
            <mapExplain></mapExplain>
        </b-tooltip>
    </div>
</template>

<script>
    import mapExplain from './mapExplain'

    export default {
        name: "group_map",
        components: {
            mapExplain
        },
        data() {
            return {
                mountainNum : '',
                // 경로 색깔을 위해
                mouseover_out: true,
            }
        },
        created() {
            this.$EventBus.$on('event_make_map', (num) => {
                this.mountainNum = num;
                this.makeMap(this.mountainNum);
            });
        },
        methods: {
            removeMap() {
                this.makeMap(this.mountainNum);
            },
            mapModalSubmit() {
                this.$parent.close();
            },
            makeMap(num) {
                var eventbus = this.$EventBus;
                // 시종점 마커
                var startEndSameMarker = [];
                // 시작마커
                var start = '';
                // 도착마커
                var end = '';
                // 시작 점
                var startSpot = {};
                // 도착 점
                var endSpot = {};
                // 시작마커의 배열
                var startMarkers = [];
                // 도착마커의 배열
                var endMarkers = [];
                // 반환마커의 배열
                var destinationMarker = [];
                // 등산 경로마다 지도에 찍기 위한 속성 적용
                var flightPath = [];
                // node에서 받아온 지도 데이터
                var flightPlanCoordinates = [];
                // 지도의 중간지점
                var mountain_center = '';
                // 데이터이스로 보낼 산 코스 배열
                var path = [];
                // 지도를 띄우기 위해 지도 객체 생성
                var map = new window.google.maps.Map(document.getElementById('map'), {
                    zoom: 14,
                });
                //////////////////////////////////////////////// 위도와 경도 불러오기
                axios.get('http://hikonnect.ga:3000/paths/' + num)
                    .then(response => {
                            // 지도의 중심 지점 변수지정
                            mountain_center = response.data[0].geometry.paths[0][0];
                            // 산마다 배정되는 경로의 개수만큼 지도에 찍는 for문
                            for (let i = 0; i < response.data.length; i++) {
                                console.log(response.data[i].attributes.PMNTN_LT);
                                // 각 경로 배당
                                flightPlanCoordinates[i] = response.data[i].geometry.paths[0];
                                // 각 경로마다 속성 적용
                                flightPath[i] = new window.google.maps.Polyline({
                                    path: flightPlanCoordinates[i], // 경로 배열
                                    mouseover_out: true,                     // 마우스가 이미 지나쳤는지 아닌지
                                    geodesic: true,                     // 경로를 보여줄지 안 보여줄지
                                    strokeColor: '#FFC107',                // 경로의 선 색
                                    strokeWeight: 7                         // 경로 선 굵기
                                });
                                // 지도의 중심 위도, 경도 입력
                                map.setCenter({lat: mountain_center.lat, lng: mountain_center.lng});
                                //////////////////////////////////////////////// 경로에 마우스를 올릴 때 이벤트
                                flightPath[i].addListener('mouseover', function () {
                                    if (this.mouseover_out == true) {
                                        this.setOptions({
                                                strokeColor: '#FFC107',
                                                strokeWeight: 11
                                            }
                                        );
                                    } else {
                                        this.setOptions({
                                                strokeColor: '#FF0000',
                                                strokeWeight: 9,
                                            }
                                        );
                                    }
                                });
                                /////////////////////////////////////////////////// 경로 지우기
                                flightPath[i].addListener('mousedown', function () {
                                    var redRine = false;
                                    var sameSpot = false;
                                    // 우클릭
                                    if (window.event.button == 2) {
                                        // 시종점 없애기
                                        if (flightPlanCoordinates[i][0].lat == startSpot.lat &&
                                            flightPlanCoordinates[i][0].lng == startSpot.lng) {
                                            sameSpot = true;
                                        } else if (flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lat
                                            == startSpot.lat &&
                                            flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lng
                                            == startSpot.lng) {
                                            sameSpot = true;
                                        }
                                        // 시종점이 있을 경우, 경로가 끊어지지 않을 경우
                                        if(startEndSameMarker.length > 0 && path[path.length - 1] == i && path.length > 0)   {
                                            startEndSameMarker[startEndSameMarker.length - 1].setMap(null);
                                            endMarkers.pop();
                                            endMarkers[endMarkers.length - 1].setMap(map);
                                            startEndSameMarker = [];
                                            path.pop();
                                        }
                                        // 경로가 끊어지는지 아닌지 확인하기
                                        // path.length == 2는 path[0]은 하나밖에 없어서 맞는 경로가 없으므로 path[1]까지 허용
                                        // paht[path.length - 1] == i는 현재 fid와 path 배열의 마지막 fid가 같다는 것은 이어져있다는 의미로 경로가 끊이지지 않는다
                                        else if (path[path.length - 1] == i || path.length == 2) {
                                            // path의 경로 중 현재 fid와 동일 한 것이 있다면 중복 됬다는 의미 이므로 path배열 for문을 돌려 비교한다.
                                            // 반환점을 돌아 두번 찍힌 path일 경우 클릭해도 빨간 선이 지워지지 않게
                                            // path.length - 1을 하는 이유는 현재 fid는 재외한 상태에서 비교햐야하는 데 path.pop()이 나중에 나오므로
                                            for (let a = 0; a < path.length - 1; a++) {
                                                if (path[a] == i) {
                                                    // 계속 빨간 선이어야한다.
                                                    redRine = true;
                                                }
                                            }
                                            // 배열에 해당 경로와 일치하는 배열이 없다면 노란선으로 바꾸준다.
                                            if (redRine == false) {
                                                this.setOptions({
                                                    strokeColor: '#FFC107',
                                                    strokeWeight: 9,
                                                });
                                                this.mouseover_out = true;
                                            }
                                            // path가 두개 일 때 따로 처리
                                            if (path.length <= 2) {
                                                // path 배열이 두개 일 때
                                                if (path.length == 2) {
                                                    // 도착마커 없애기
                                                    // 도착마커 배열에서 없애기
                                                    endMarkers[endMarkers.length - 1].setMap(null);
                                                    endMarkers.pop();
                                                }
                                                // path 배열이 한개 일 때
                                                else if (path.length == 1) {
                                                    // 시작마커 없애기
                                                    // 시작마커 배열에서 없애기
                                                    startMarkers[0].setMap(null);
                                                    startMarkers.pop();
                                                }
                                            }
                                            // path 배열이 두개가 넘을 때
                                            else {
                                                // 도착점에서 반환점으로 다시 되돌릴 때 반환점 마커를 없애야한다.
                                                // path의 경우 [1, 3, 4, 4]가 나오므로 path의 마지막 배열과 그 이전의 배열을 비교하면 된다.
                                                if (path[path.length - 1] == path[path.length - 2]) {
                                                    // 반환마커를 지도에서 지운다.
                                                    // 반환마커배열을 비운다.
                                                    destinationMarker[0].setMap(null);
                                                    destinationMarker = [];
                                                }
                                                // 배열이 두개 넘을 때 반환점을 끼지 않은 일반적인 경로 지우기 경우
                                                // 지도에서 도착마커를 지운다.
                                                // 도착마커 배열에서 해당 마커를 지운다.
                                                // 그 이전의 마커를 띄워줘야하므로 지도에 띄워준다.
                                                endMarkers[endMarkers.length - 1].setMap(null);
                                                endMarkers.pop();
                                                endMarkers[endMarkers.length - 1].setMap(map);
                                            }
                                            // path에서 해당 경로를 지운다.
                                            path.pop();
                                        }
                                        // 경로가 끊어졌을 경우
                                        else {
                                            alert('경로가 끊어집니다.')
                                        }
                                    }
                                });
                                ///////////////////////////////////////////////////////////////////////////////////// 경로를 클릭 했을 때 이벤트
                                flightPath[i].addListener('click', function () {
                                    // 갈림길 방지
                                    // 각 경로의 끝점이 동일 할 때마다 변수 1씩 추가해 줄 변수
                                    var sameSpot = false;
                                    var sameSpotN = 0;
                                    // 각 경로의 끝점을 비교해야하므로 for문을 돌린다.
                                    for (let a = 0; a < path.length; a++) {
                                        if (flightPlanCoordinates[i][0].lat == flightPlanCoordinates[path[a]][0].lat &&
                                            flightPlanCoordinates[i][0].lng == flightPlanCoordinates[path[a]][0].lng) {
                                            sameSpotN++;
                                        } else if (flightPlanCoordinates[i][0].lat == flightPlanCoordinates[path[a]][flightPlanCoordinates[path[a]].length - 1].lat &&
                                            flightPlanCoordinates[i][0].lng == flightPlanCoordinates[path[a]][flightPlanCoordinates[path[a]].length - 1].lng) {
                                            sameSpotN++
                                        } else if (flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lat == flightPlanCoordinates[path[a]][0].lat &&
                                            flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lng == flightPlanCoordinates[path[a]][0].lng) {
                                            sameSpotN++
                                        } else if (flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lat
                                            == flightPlanCoordinates[path[a]][flightPlanCoordinates[path[a]].length - 1].lat &&
                                            flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lng
                                            == flightPlanCoordinates[path[a]][flightPlanCoordinates[path[a]].length - 1].lng) {
                                            sameSpotN++
                                        }
                                    }
                                    if (flightPlanCoordinates[i][0].lat == startSpot.lat &&
                                        flightPlanCoordinates[i][0].lng == startSpot.lng) {
                                        sameSpot = true;
                                    } else if (flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lat
                                        == startSpot.lat &&
                                        flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lng
                                        == startSpot.lng) {
                                        sameSpot = true;
                                    }

                                    // smaeSpot == 2 -> 같은 점이 두개 있을 경우 이미 이어진 선이 있다는 것이다.
                                    // this.mouseover_out == true -> 아직 경로 선택이 안된 노란선이어야 한다.
                                    // destinationMarkers.length == 0 -> 반환점이 아직 없다.
                                    if (sameSpot == true && this.mouseover_out == true && path.length > 1) {
                                        path.push(i);
                                        // 도착마커를 지도에서 지운다.
                                        endMarkers[endMarkers.length - 1].setMap(null);
                                        // 도착마커배열에 도착 도착마커를 하나 더 넣는다잇
                                        endMarkers.push(startMarkers[0]);

                                        let startEndSame = new google.maps.Marker({
                                            position: startSpot,
                                            icon: "http://localhost:8000/images/startEnd.png",
                                            map: map
                                        });
                                        startEndSameMarker.push(startEndSame);
                                        this.setOptions({
                                                strokeColor: '#FF0000',
                                                strokeWeight: 9,
                                            });
                                        this.mouseover_out = false;
                                    }
                                    else if (sameSpotN == 2 && this.mouseover_out == true && destinationMarker.length == 0) {
                                        alert('갈림길에서 하나의 경로만 선택 가능합니다.');
                                    }
                                    // 갈림길이 아닌 경우
                                    else {
                                        // 노란색 선 클릭시
                                        if (this.mouseover_out == true) {
                                            // 해당 경로를 path배열에 넣는다.
                                            path.push(i);
                                            // path배열의 마지막 경로와 현재 i 사이의 도착점을 찾으면 true로 바꿀 변수
                                            var putPath = false;
                                            ////////////////////////////////////////////////////////////////// 도착점 마커 찍기
                                            // path가 두개 일 때부터 도착점을 계산 할 수 있다.
                                            if (path.length >= 2) {
                                                // 마지막 점(0배열)
                                                var lastSpot0 = flightPlanCoordinates[path[path.length - 1]][0];
                                                // 마지막 점(끝점)
                                                var lastSpot = flightPlanCoordinates[path[path.length - 1]][flightPlanCoordinates[path[path.length - 1]].length - 1];
                                                // 두번째로 마지막 점(0배열)
                                                var secondSpot0 = flightPlanCoordinates[path[path.length - 2]][0];
                                                // 두번째로 마지막 점(끝점)
                                                var secondSpot = flightPlanCoordinates[path[path.length - 2]][flightPlanCoordinates[path[path.length - 2]].length - 1];
                                                if (lastSpot0.lat == secondSpot0.lat && lastSpot0.lng == secondSpot0.lng) {
                                                    end = new google.maps.LatLng(lastSpot.lat, lastSpot.lng);
                                                    putPath = true;
                                                } else if (lastSpot0.lat == secondSpot.lat && lastSpot0.lng == secondSpot.lng) {
                                                    putPath = true;
                                                    end = new google.maps.LatLng(lastSpot.lat, lastSpot.lng);
                                                } else if (lastSpot.lat == secondSpot0.lat && lastSpot.lng == secondSpot0.lng) {
                                                    putPath = true;
                                                    end = new google.maps.LatLng(lastSpot0.lat, lastSpot0.lng);
                                                } else if (lastSpot.lat == secondSpot.lat && lastSpot.lng == secondSpot.lng) {
                                                    putPath = true;
                                                    end = new google.maps.LatLng(lastSpot0.lat, lastSpot0.lng)
                                                }
                                                // 도착점이 없을 경우 경로 이탈로 간주
                                                else {
                                                    // path배열에서 경로를 지운다.
                                                    path.pop();
                                                    if (this.mouseover_out == true) {
                                                        alert('경로이탈')
                                                    }
                                                }
                                                // 도착점 마커를 찍는다.
                                                let endM = new google.maps.Marker({
                                                    position: end,
                                                    icon: "http://localhost:8000/images/end.png",
                                                    map: map
                                                });
                                                // 마커를 찍을 때마다 이전의 마커는 제거해준다.
                                                for (let c = 0; c < endMarkers.length; c++) {
                                                    endMarkers[c].setMap(null);
                                                }
                                                // 도착마커배열에 도착마커를 넣는다.
                                                endMarkers.push(endM);
                                            }
                                            ////////////////////////////////////////////////////////////////// 시작점 마커 찍기
                                            if (path.length == 2) {
                                                if (flightPlanCoordinates[path[0]][0].lat == flightPlanCoordinates[path[1]][0].lat &&
                                                    flightPlanCoordinates[path[0]][0].lng == flightPlanCoordinates[path[1]][0].lng) {
                                                    startSpot = flightPlanCoordinates[path[0]][flightPlanCoordinates[path[0]].length - 1];
                                                    start = new google.maps.LatLng(flightPlanCoordinates[path[0]][flightPlanCoordinates[path[0]].length - 1].lat,
                                                        flightPlanCoordinates[path[0]][flightPlanCoordinates[path[0]].length - 1].lng);
                                                } else if (flightPlanCoordinates[path[0]][0].lat == flightPlanCoordinates[path[1]][flightPlanCoordinates[path[1]].length - 1].lat &&
                                                    flightPlanCoordinates[path[0]][0].lng == flightPlanCoordinates[path[1]][flightPlanCoordinates[path[1]].length - 1].lng) {
                                                    start = new google.maps.LatLng(flightPlanCoordinates[path[0]][flightPlanCoordinates[path[0]].length - 1].lat,
                                                        flightPlanCoordinates[path[0]][flightPlanCoordinates[path[0]].length - 1].lng);
                                                    startSpot = flightPlanCoordinates[path[0]][flightPlanCoordinates[path[0]].length - 1];
                                                } else if (flightPlanCoordinates[path[0]][flightPlanCoordinates[path[0]].length - 1].lat == flightPlanCoordinates[path[1]][0].lat &&
                                                    flightPlanCoordinates[path[0]][flightPlanCoordinates[path[0]].length - 1].lng == flightPlanCoordinates[path[1]][0].lng) {
                                                    start = new google.maps.LatLng(flightPlanCoordinates[path[0]][0].lat, flightPlanCoordinates[path[0]][0].lng)
                                                    startSpot = flightPlanCoordinates[path[0]][0];
                                                } else if (flightPlanCoordinates[path[0]][flightPlanCoordinates[path[0]].length - 1].lat
                                                    == flightPlanCoordinates[path[1]][flightPlanCoordinates[path[1]].length - 1].lat &&
                                                    flightPlanCoordinates[path[0]][flightPlanCoordinates[path[0]].length - 1].lng
                                                    == flightPlanCoordinates[path[1]][flightPlanCoordinates[path[1]].length - 1].lng) {
                                                    startSpot = flightPlanCoordinates[path[0]][0];
                                                    start = new google.maps.LatLng(flightPlanCoordinates[path[0]][0].lat, flightPlanCoordinates[path[0]][0].lng)
                                                }
                                                // Create markers.
                                                let startM = new google.maps.Marker({
                                                    position: start,
                                                    icon: "http://localhost:8000/images/check.png",
                                                    map: map
                                                });
                                                startMarkers.push(startM);
                                            }
                                            if (path.length == 1 || putPath == true) {
                                                if (this.mouseover_out == true) {
                                                    this.setOptions({
                                                        strokeColor: '#FF0000',
                                                        strokeWeight: 9,
                                                    });
                                                    this.mouseover_out = false
                                                }
                                            }
                                        }
                                        // 빨간 색 선 클릭 시
                                        else {
                                            var redLine = 0;
                                            // 배열에 해당 경로와 일치하는 배열이 1개 까지는 반환일 수 있으므로 처리해 주지만 그 이상은 처리하지 않는다.
                                            for (let a = 0; a < path.length; a++) {
                                                if (path[a] == i) {
                                                    redLine++;
                                                }
                                            }
                                            if (redLine == 1) {
                                                if (destinationMarker.length > 0) {
                                                    if (flightPlanCoordinates[i][0].lat == flightPlanCoordinates[path[path.length - 1]][0].lat &&
                                                        flightPlanCoordinates[i][0].lng == flightPlanCoordinates[path[path.length - 1]][0].lng) {
                                                        endSpot = flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1];
                                                        end = new google.maps.LatLng(flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lat,
                                                            flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lng);
                                                    } else if (flightPlanCoordinates[i][0].lat
                                                        == flightPlanCoordinates[path[path.length - 1]][flightPlanCoordinates[path[path.length - 1]].length - 1].lat &&
                                                        flightPlanCoordinates[i][0].lng
                                                        == flightPlanCoordinates[path[path.length - 1]][flightPlanCoordinates[path[path.length - 1]].length - 1].lng) {
                                                        endSpot = flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1];
                                                        end = new google.maps.LatLng(flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lat,
                                                            flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lng);
                                                    } else if (flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lat == flightPlanCoordinates[path[path.length - 1]][0].lat &&
                                                        flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lng == flightPlanCoordinates[path[path.length - 1]][0].lng) {
                                                        endSpot = flightPlanCoordinates[i][0];
                                                        end = new google.maps.LatLng(flightPlanCoordinates[i][0].lat, flightPlanCoordinates[i][0].lng);
                                                    } else if (flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lat
                                                        == flightPlanCoordinates[path[path.length - 1]][flightPlanCoordinates[path[path.length - 1]].length - 1].lat &&
                                                        flightPlanCoordinates[i][flightPlanCoordinates[i].length - 1].lng
                                                        == flightPlanCoordinates[path[path.length - 1]][flightPlanCoordinates[path[path.length - 1]].length - 1].lng) {
                                                        endSpot = flightPlanCoordinates[i][0];
                                                        end = new google.maps.LatLng(flightPlanCoordinates[i][0].lat, flightPlanCoordinates[i][0].lng);
                                                    }
                                                    // 반환마커 만들기
                                                    let endM = new google.maps.Marker({
                                                        position: end,
                                                        icon: "http://localhost:8000/images/end.png",
                                                        map: map
                                                    });
                                                    // 도착마커를 지도에서 지운다.
                                                    endMarkers[endMarkers.length - 1].setMap(null);
                                                    // 도착마커배열에 도착 도착마커를 하나 더 넣는다잇
                                                    endMarkers.push(endM);
                                                    if (endSpot == startSpot) {
                                                        let startEndSame = new google.maps.Marker({
                                                            position: startSpot,
                                                            icon: "http://localhost:8000/images/startEnd.png",
                                                            map: map
                                                        });
                                                        startEndSameMarker.push(startEndSame);
                                                    }
                                                }
                                                // 반환점이 없을 시
                                                else {
                                                        // 시종점 마커 찍기.
                                                        let destM = new google.maps.Marker({
                                                            position: end,
                                                            icon: "http://localhost:8000/images/start.png",
                                                            map: map
                                                        });
                                                        destinationMarker.push(destM);
                                                        endMarkers.push(endMarkers[endMarkers.length - 2]);
                                                        endMarkers[endMarkers.length - 2].setMap(null);
                                                        endMarkers[endMarkers.length - 1].setMap(map);
                                                }
                                                path.push(i);
                                            }
                                        }
                                    }
                                    eventbus.$emit('mountain_path', path, num);
                                });


                                // 경로에서 마우스가 벗어났을 때 이벤트
                                flightPath[i].addListener('mouseout', function () {
                                    if (this.mouseover_out == true) {
                                        this.setOptions({
                                                strokeColor: '#FFC107',
                                                strokeWeight: 9
                                            }
                                        );
                                    } else {
                                        this.setOptions({
                                                strokeColor: '#FF0000',
                                                strokeWeight: 9
                                            }
                                        );
                                    }
                                });
                                flightPath[i].setMap(map);
                            }

                        }
                    );
            }
        }
    }
</script>

<style>
    #exp:hover {
        color: #b642f4;
    }
    .sweet-modal.is-visible {
        min-width: 90%;
    }
</style>