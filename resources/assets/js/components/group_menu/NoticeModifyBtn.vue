<!-- NoticeModifyBtn.vue -->
<!-- editButton of every notices -->
<template>
    <div class='edit_button'>
        <!-- if you click this button, -->
        <v-btn style="height: 100%;" flat v-on:click="openModifyModal();">
             <v-icon dark>edit</v-icon>&nbsp;edit
        </v-btn>
        <!-- this will be shown -->
        <sweet-modal ref="modify" blocking>
            <router-view name="form"></router-view>
        </sweet-modal>
    </div>
</template>

<script>
    export default {
        props: ['propsNotice'],
        methods : {
            // the function for open modal
            openModifyModal : function() {
                this.$refs.modify.open();
                this.$EventBus.$emit('noticeData', this.propsNotice);
                this.$EventBus.$emit('modalMode', 'edit');
            },
        },
    }
</script>

<style>
    .edit_button {
        float: right;
    }
</style>