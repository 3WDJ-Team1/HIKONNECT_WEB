<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div class="container" style="padding: 0px;">
        <div class="row">
            <div class="col-6">
                <autocomplete
                        @keyup.enter.native="initMap"
                        ref             ="autocomplete"
                        placeholder     ="목적지"
                        :source         ="distributionGroupsEndpoint"
                        :results-display="formattedDisplay"
                        @selected       ="addDistributionGroup">
                </autocomplete>
            </div>
            <div class="col-6">
                <b-btn style="margin: 0px; min-height: 50px; height: 30px; width: 120px;" @click="initMap"><p style="font-family: 'Do Hyeon', sans-serif; font-size: 25px;">지도보기</p></b-btn>
            </div>
        </div>
        <sweet-modal blocking="true" ref="map" id="paddingRemove">
            <eventMap></eventMap>
        </sweet-modal>
    </div>
</template>
<script>
    import Autocomplete from 'vuejs-auto-complete'
    import eventMap from './event_map'
    export default {
        data() {
            return {
                // 산 코드
                mountain_num: "",
                destination: ''
            }
        },
        components: {
            Autocomplete,
            eventMap
        },
        methods: {
            ///////////////////////////////////////// 지도 api
            initMap() {
                this.$refs.map.open();
                this.$EventBus.$emit('event_make_map', this.mountain_num);
            },
            // pull autocomplete data
            distributionGroupsEndpoint(n) {
                return this.$HttpAddr + '/searchMount/' + n;
            },
            hideModal() {
                this.open = false;
            },
            // drop down이 보여지도록
            addDistributionGroup(group) {
                // 산 코드
                this.mountain_num = group.selectedObject.mnt_id;
                // input에 썼던 text지우기
                this.$refs.autocomplete.clearValues();
                // 내가 클릭한 text로 채우기
                this.$refs.autocomplete.value = group.selectedObject.mnt_name;
            },
            // drop down에 보여질 text
            formattedDisplay(result) {
                return result.mnt_name;
            }
        }
    }
</script>
<style>
    .autocomplete__box  {
        height: 30px;
        width: 150px;
    }
    .autocomplete__results__item {
        font-size: 20px;
        min-width: 240px;
        min-height: 42px;
    }
    .autocomplete__results {
        min-width: 250px;
    }
    #paddingRemove.is-visible .sweet-buttons, #paddingRemove.is-visible .sweet-content {
        padding: 0px;

    }
    #paddingRemove .sweet-box-actions {
        z-index: 1000;
        top: 45px;
        right: 5px;
    }

</style>