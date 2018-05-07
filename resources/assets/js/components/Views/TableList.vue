<template>
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-6">
          <card>
            <template slot="header">
              <h4 class="card-title">내가 소속된 등산 계획</h4>
            </template>
            <div class="table-responsive">
              <l-table class="table-hover"
                       :columns="table1.columns"
                       :data="table1.data">
              </l-table>
            </div>
          </card>
        </div>
        <div class="col-6">
          <card>
            <template slot="header">
              <h4 class="card-title">내가 생성한 등산 계획</h4>
            </template>
            <div class="table-responsive">
              <l-table class="table-hover"
                       :columns="table1.columns"
                       :data="table1.data">
              </l-table>
            </div>
          </card>
        </div>
      </div>
      <div class="row">
        <div class="col-6">
          <card>
            <template slot="header">
              <h4 class="card-title">내가 소속된 그룹</h4>
            </template>
            <div class="table-responsive">
              <l-table class="table-hover"
                       :columns="table1.columns"
                       :data="table1.data">
              </l-table>
            </div>
          </card>
        </div>
        <div class="col-6">
          <card>
            <template slot="header">
              <h4 class="card-title">내가 생성한 그룹</h4>
            </template>
            <div class="table-responsive">
              <l-table class="table-hover"
                       :columns="table1.columns"
                       :data="table1.data">
              </l-table>
            </div>
          </card>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import LTable from '../Table.vue'
  import Card from '../Cards/Card.vue'
  const tableColumns = ['그룹 이름', '작성자'];
  const tableData = [{
    '그룹 이름': 1,
    '작성자': '뀨'
  }];
  export default {
    components: {
      LTable,
      Card
    },
    data () {
      return {
        table1: {
          columns: [...tableColumns],
          data: [...tableData]
        },
        table2: {
          columns: [...tableColumns],
          data: [...tableData]
        }
      }
    }
  }
</script>
<style>
</style>
