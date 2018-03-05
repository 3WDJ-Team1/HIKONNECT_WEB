<template>
    <div>
    <div><h1>안녕</h1></div>
    <button v-on:click='getData'>데이터 가져오기</button>
    </div>
</template>
<script>
    export default {
        methods: {
            getData()
            {
                axios.get('https://raw.githubusercontent.com/joshua1988/doit-vuejs/master/data/demo.json')
                    .then(function (response) {
                        console.log(response);
                    });
            }
        }
    }
</script>