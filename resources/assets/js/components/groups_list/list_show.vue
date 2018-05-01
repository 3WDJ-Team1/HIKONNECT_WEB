<template>
    <v-container>
        <div class="card" v-for="item in list" :key="item.owner">
            <div class="card-header">
                <h4 class="title inlineBlocks">{{ item.title }} </h4>
                <h5>{{ item.nickname }}</h5>
                <v-btn
                        @click="joinAlert()"
                        v-if="joinVisible(item.nickname)"
                        style   ="margin-right: 5%;"
                        color   ="red"
                        dark
                        midiuem
                        fab>
                    <v-icon>person_add</v-icon>
                </v-btn>
            </div>
            <div class="card-body">
                <div class="member-count-wrapper">
                    <div class="min_members inlineBlocks">최소인원수: {{ item.min_members }}</div>
                    <div class="max_members inlineBlocks">최대인원수: {{ item.max_members }}</div>
                </div>
                <div class="end_point inlineBlocks">목적지: {{ item.end_point }}</div>
                <div class="startdate inlineBlocks">산행일자: {{ item.start_date }}</div>
            </div>
            <v-btn flat color="teal" :to="toGroupDetail + '/' + item.uuid">
                <span>to group home</span>
                <v-icon>description</v-icon>
            </v-btn>
            <v-btn flat color="teal" :to="toUpdate + '/' + item.uuid"
                   v-if="updateVisible(item.nickname)">
                <span>update group page content</span>
                <v-icon>update</v-icon>
            </v-btn>
        </div>
        <infinite-loading @infinite="infiniteHandler"></infinite-loading>
    </v-container>
</template>

<script>
    import InfiniteLoading from 'vue-infinite-loading';
    export default {
        data() {
            return {
                toGroupDetail   : '/group',
                toUpdate        : '/group_update'
            };
        },
    }
</script>
<style>
    .card {
        margin-bottom: 20px;
    }
    .inlineBlocks {
        display: inline-block; 
    }
    .max_members {
        align-self: flex-end;
        margin-left: 3%;
    }
    .member-count-wrapper {
        text-align: end;
    }
</style>
