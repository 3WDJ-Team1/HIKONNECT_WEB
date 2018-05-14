<template>
    <v-btn
            style="margin-bottom: 0%; margin-right: 1%"
            color="red"
            dark
            midiuem
            fixed
            right
            bottom
            fab
            @click="enterGroup()"
            v-if="isGuest">
        <v-icon>person_add</v-icon>
    </v-btn>
</template>

<script>
    export default {
        data: () => ({
            isGuest: false,
            groupId: '',
        }),
        created() {
            this.groupId = this.$route.params.groupid;
            this.$EventBus.$on('position', (position) => {
                if (position == 'guest') {
                    this.isGuest = true;
                }
            });
        }
        ,
        methods: {
            enterGroup() {
                // 로그인 되어 있을 경우
                axios.post(this.$HttpAddr + '/member', {
                    userid: sessionStorage.getItem('userid'),
                    uuid: this.groupId
                }).then(response => {
                    alert('그룹에 참가되었습니다.');
                    this.isGuest = false;
                });
            }
        }
    }
</script>

<style scoped>

</style>