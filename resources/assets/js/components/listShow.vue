<template>
    <div class="container">
        <div class="serchOp">
            <div class="listOp">
                <button type="button" class="btn">최신순</button>
                <button type="button" class="btn">참여자가 많은 순</button>
            </div>
            <div class="listSerch">
                <div class="col-xs-8 col-xs-offset-2">
                    <div class="input-group">
                    <span class="input-group-btn search-panel">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <span id="search_concept">선택</span> <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#contains">목적지</a></li>
                            <li><a href="#its_equal">작성자</a></li>
                        </ul>
                    </span>
                        <input type="hidden" name="search_param" value="all" id="search_param">
                        <input type="text" class="form-control" name="x" placeholder="내용을 입력해주세요.">
                        <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="listShow">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>글번호</th>
                    <th>제목</th>
                    <th>목적지</th>
                    <th>작성자</th>
                    <th>산행 예정 일자</th>
                    <th>목표수</th>
                    <th>참여수</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="item in items">
                    <td>{{ item.name }}</td>
                    <td>{{ item.name }}</td>
                    <td>{{ item.id }}</td>
                    <td>{{ item.id }}</td>
                    <td>{{ item.id }}</td>
                    <td>{{ item.id }}</td>
                    <td>{{ item.id }}</td>
                    {{ name }}
                </tr>
                </tbody>
            </table>
        </div>
        <div class="groupWrite">
            <button type="button" class="btn btn-primary active">글작성</button>
        </div>
        <div class="pagination">
            <ul class="pagination pagination-lg">
                <li class="page-item"><a class="page-link" href="#">&#60;&#60;</a></li>
                <li class="page-item"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">>></a></li>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return{
                items: [],
                name: 'dfsdfsdf'
            }
        },
        created: function ()
        {
            this.fetchItems();
        },
        method: {
            fetchItem()
            {
                this.axios.post('http://localhost:8000/list')
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(e => {
                        this.errors.push(e)
                    })
            }
        }
    }
</script>


<style>
    .serchOp    {
        display: inline;
        height: 36px;
    }
    .listOp {
        float: left;
        margin-left: 100px;
    }
    .listSerch {
        float: right;
    }
    .col-xs-offset-2   {
        width: 350px;
        margin-right: 170px;
    }
    .listShow {
        margin-right: 100px;
        margin-left: 100px;
        text-align: center;
        vertical-align: middle;
    }
    .groupWrite {
        width: 68px;
        margin-left: 972px;
    }
    .pagination {
        display: table;
        margin-top: 0px;
        margin-left: auto;
        margin-right: auto;
    }
</style>