<template>
    <div class="container">
        <autocomplete
                ref             ="autocomplete"
                placeholder     ="Search Distribution Groups(name)"
                :source         ="distributionGroupsEndpoint"
                input-class     ="form-control"
                results-property="data"
                :results-display="formattedDisplay"
                @selected       ="addDistributionGroup"
                style           ="width: 200px">
        </autocomplete>
        <sweet-modal ref="map" blocking>
            <router-view name="map"></router-view>
        </sweet-modal>
        <b-btn @click="initMap">지도보기</b-btn>
    </div>
</template>
<script>
    // import {EventBus}   from './event-bus.js';
    import Autocomplete from 'vuejs-auto-complete'
    export default {
        data() {
            return {
                // 산 코드
                mountain_num: ""
            }
        },
        components: {
            Autocomplete
        },
        methods: {
            ///////////////////////////////////////// 지도 api
            initMap() {
                this.$refs.map.open();
                this.$EventBus.$emit('group_map', this.mountain_num);
            },
            // pull autocomplete data
            distributionGroupsEndpoint(n) {
                return Laravel.host + '/api/testing/' + n;
            },
            hideModal() {
                this.open = false;
            },
            // drop down이 보여지도록
            addDistributionGroup(group) {
                // 산 코드
                this.mountain_num = group.selectedObject.mnt_code;
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