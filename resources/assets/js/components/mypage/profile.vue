<template>
    <div id="d">
        <router-link  :to="{ name: 'modify' }" class = "btn btn-primary"> 수정</router-link>
        <router-link  :to="{ name: 'graph' }" class = "btn btn-primary"> 그래프</router-link>
        <router-link  :to="{ name: 'main' }" class = "btn btn-primary"> 확인</router-link>
        <!--<router-view name="a"></router-view>-->
    </div>
</template>
<script>

    /*import Vue from 'vue';
    import graph from './graph.vue'
    import VueRouter from 'vue-router';
    Vue.use(VueRouter);

    export default {

        methods: {
            profile() {
                    let uri= 'http://localhost:8000/user';
                    this.axios.post(uri).then((response) => {

                    })
                }
            }
    }
    const router = new VueRouter({
        mode: 'history',
        routes: [
            { path: '/',
                // a single route can define multiple named components
                // which will be rendered into <router-view>s with corresponding names.
                components: {
                    a: graph

                }
            },
            {
                path: '/other',
                components: {
                    a: graph
                }
            }
        ]
    });

    new Vue(Vue.util.extend({ router }, this)).$mount('#d');*/
</script>