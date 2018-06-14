<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div>
        <show-map></show-map>
        <hr>
        <h5 style="color: #FF6633;">모집내용</h5>
        <div class="row">
            <div class="col-md-12">
                <Card>
                    <i class="nc-icon nc-quote" style="float: left;"></i>&nbsp;&nbsp;
                    <p class="card-category" style="display: inline; color: #000;">{{ content }}</p>
                </Card>
            </div>
        </div>
    </div>
</template>


<script>
    import showMap from './showMap'
    import Card from '../../Cards/Card'

    export default {
        name: "event-modal",
        data() {
            return {
                content: ''
            }
        },
        components: {
            showMap,
            Card
        },
        created() {
            // 모달에 띄워 줄 이벤트 전달 받기
            this.$EventBus.$on('sendContent', (event) => {
                this.content = event.desc;
            })
        }
    }
</script>

<style scoped>
    .sweet-modal.is-visible {
        max-width: 100%;
    }
</style>