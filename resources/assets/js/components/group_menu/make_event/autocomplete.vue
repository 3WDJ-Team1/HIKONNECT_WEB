<template>
    <div class="container" style="padding: 0px;">
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
            <eventMap></eventMap>
        </sweet-modal>
        <b-btn @click="initMap">지도보기</b-btn>
    </div>
</template>
<script>
    import Autocomplete from 'vuejs-auto-complete'
    import eventMap from './event_map'
    export default {
        data() {
            return {
                // 산 코드
                mountain_num: ""
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
                return this.$HttpAddr + '/testing/' + n;
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