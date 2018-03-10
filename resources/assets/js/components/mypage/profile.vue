<template>
    <div>
        <router-link  :to="{ name: 'modify' }" class = "btn btn-primary"> 수정</router-link>
        <router-link  :to="{ name: 'graph' }" class = "btn btn-primary"> 그래프</router-link>
        <router-link  :to="{ name: 'main' }" class = "btn btn-primary"> 확인</router-link>
    </div>
</template>
<script>
    export default {

    }
</script>