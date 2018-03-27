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
                @selected="addDistributionGroup">
        </autocomplete>


        <!--map modal-->
        <div>
            <b-btn v-b-modal.modal1>지도보기</b-btn>

            <!-- Modal Component -->
            <b-modal id="modal1" v-bind:title=mountain_para>
                <p class="my-4">
                    <group_map></group_map>
                </p>
            </b-modal>
        </div>
    </div>
</template>

<script>
    import { EventBus } from './event_bus.js';
    import Autocomplete from 'vuejs-auto-complete'

    export default {
        data()   {
            return  {
                mountain_para: ""
            }
        },
        components: {
            Autocomplete,
            "group_map": group_map
        },
        methods: {
            // 이벤트 보내기
            send_serch() {
                // '이벤트명', 데이터
                EventBus.$emit('mountain_code', this.mountain_para);
            },
            distributionGroupsEndpoint (n) {
                //return process.env.API + '/distribution/search?query='
                return 'http://localhost:8000/testing/' + n;
            },
            addDistributionGroup (group) {
                //this.mountain_para = group.selectedObject.display;
                this.mountain_para = group.display;
                this.$refs.autocomplete.clearValues();
                this.$refs.autocomplete.value = group.display;
            },
            formattedDisplay (result) {
                return result.name;
            }
        }
    }
</script>