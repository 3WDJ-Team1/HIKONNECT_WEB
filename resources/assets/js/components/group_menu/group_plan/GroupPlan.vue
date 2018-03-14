<!-- 
    @file   GroupPlan.vue
    @brief  A component to show latest plan in group
    @author Sungeun Kang
    @todo   write plz
 -->
<template>
    <div class="text-center">
        <div class="plan_title">
            <h1 style="fontWeight: bold;">Destination</h1>
        </div>
        <router-view name="map"></router-view>
        <div class="plan_title">
            <h1 style="fontWeight: bold;">Schedule</h1>
        </div>
        <router-view name="calendar"></router-view>
    </div>
</template>

<script>
    export default {

    }
</script>

<style>
.plan_title {
    padding: 1%
}
</style>
