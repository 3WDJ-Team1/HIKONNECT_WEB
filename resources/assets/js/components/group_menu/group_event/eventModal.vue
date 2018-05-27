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
            this.$EventBus.$on('sendContent', (content) => {
                this.content = content;
            })
        }
    }
</script>

<style scoped>

</style>