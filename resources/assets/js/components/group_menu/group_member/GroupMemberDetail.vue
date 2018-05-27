<template>
    <v-container
        fluid
        grid-list-md
        align-center
        align-content-center
        justify-center
        class="member-detail-wrapper">
        <v-layout
            row
            wrap
            align-center
            align-content-center
            justify-center>
            <v-flex
                d-flex
                xs12
                sm6
                md3
                align-center
                align-content-center
                justify-center>
                <v-avatar
                    size="140"
                    slot="activator">
                    <img :src='memberData.image_path'>
                </v-avatar>

            </v-flex>
            <v-flex
                d-flex
                xs12
                sm6
                md9
                align-center
                align-content-center
                justify-center>
                <v-container
                    row
                    wrap
                    align-center
                    align-content-center
                    justify-center>
                    <v-flex
                        d-flex
                        xs12
                        sm12
                        md12
                        align-center
                        align-content-center
                        justify-center>
                        <v-card class="detail-wrapper">
                            <v-card-text>
                                <div class="detail-category">
                                GENDER
                                </div>
                                <div class="detail-content">
                                {{ memberData.gender == 0 ? 'male' : 'female' }}
                                </div>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                    <!-- <v-flex d-flex>
                            <v-card class="detail-wrapper">
                            <v-card-text> -->
                                <!-- <div class="detail-category">
                                SPEED
                                </div>
                                <div class="detail-content">
                                {{ memberData.speed }}
                                </div> -->
                            <!-- </v-card-text>
                            </v-card>
                    </v-flex> -->
                    <v-flex
                        d-flex
                        xs12
                        sm12
                        md12
                        align-center
                        align-content-center
                        justify-center>
                            <v-card class="detail-wrapper">
                            <v-card-text>
                                <div class="detail-category">
                                PHONE
                                </div>
                                <div class="detail-content">
                                {{ memberData.phone }}
                                </div>
                            </v-card-text>
                            </v-card>
                    </v-flex>
                </v-container>
            </v-flex>
        </v-layout>     
    </v-container>
</template>

<script>
    export default {
        data: () => ({
            memberData: {},
        }),
        created() {
            this.$EventBus.$on('memberData', (event) => {
                this.memberData = event;
            });
        }
    }
</script>

<style>
.member-detail-wrapper {
    background-color: rgb(240, 240, 240);
    width: 90%;
    border-radius: 10px;
}
.detail-wrapper {
    background-color: white;
    color: black;
    box-shadow: none;
    border-radius: 5px;
    font-size: 1.5rem;
}
.detail-category {
    display: inline-block;
    width: 6em;
    text-align: center;
    border-right: 1px solid gray;
}
.detail-content {
    display: inline-block;
    text-align: center;
    padding-left: 1em;
}
</style>