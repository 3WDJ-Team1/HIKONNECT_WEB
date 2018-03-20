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

                    <!--autocomplete featured example-->
                    <autocomplete
                            ref="autocomplete"
                            placeholder="Search Distribution Groups(name)"
                            :source="distributionGroupsEndpoint"
                            input-class="form-control"
                            results-property="data"
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
        props: ['list'],
        data()   {
            return  {
                mountain_para : ''
            }
        },
        components: {
            Autocomplete,
        },
        methods: {
            input_para(n) {
                this.mountain_para = n;
                console.log(n)
            },
            distributionGroupsEndpoint (n) {
                //return process.env.API + '/distribution/search?query='
                return 'http://localhost:8000/testing/' + n;
            },
            addDistributionGroup (group) {
                this.group = group
                // access the autocomplete component methods from the parent
                this.$refs.autocomplete.clearValues()
            },
            formattedDisplay (result) {
                return result.name;
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