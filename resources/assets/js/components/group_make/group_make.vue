<template>
    <div class="container">
        <table class="table">
            <tbody>
            <tr>
                <td>제목</td>
                <td><input type="text" place class="form-control" id="usr"></td>
            </tr>
            <tr>
                <td>모집 내용</td>
                <td><textarea class="form-control" rows="5" id="comment"></textarea></td>
            </tr>
            <tr>
                <td>등산 경로</td>
                <td>
                    <autocomplete
                            ref="autocomplete"
                            placeholder="Search Distribution Groups"
                            source="https://api.github.com/search/repositories?q="
                            results-property="items"
                            results-display="full_name"
                            input-class="form-control"
                            :results-display="formattedDisplay"
                            @selected="addDistributionGroup">
                    </autocomplete>
                </td>
            </tr>
            <tr>
                <td>등산 일정</td>
                <td>Dooley</td>
            </tr>
            <tr>
                <td>모집 인원</td>
                <td>Dooley</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    import Autocomplete from 'vuejs-auto-complete'
    export default {
        data()   {
            return  {
                show:   [{id:1,name:'설악산'},{id:2,name:'팔공산'},{id:3,name:'화장실'},{id:4,name:'청소기'},{id:5,name:'고구마'}]
            }
        },
        components: {
            Autocomplete
        },
        methods: {
            distributionGroupsEndpoint () {
                return process.env.API + '/distribution/search?query='
            },
            addDistributionGroup (group) {
                this.group = group
                // access the autocomplete component methods from the parent
                this.$refs.autocomplete.clearValues()
            },
            authHeaders () {
                return {
                    'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1Ni....'
                }
            },
            formattedDisplay (result) {
                return result.name
            }
        }
    }
</script>
<style>
    th  {
        width: 80px;
        text-align: center;
    }
    td  {
        width: 450px;
    }
    .content    {
        display: table;
        margin-left: auto;
        margin-right: auto;
    }
</style>