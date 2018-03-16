<template>
    <v-container fluid grid-list-md class="member-detail-wrapper">
        <v-layout row wrap style="vertical-align:middle;">
            <v-flex d-flex xs12 sm6 md4 class="vertical-center">
                <v-avatar
                    size="150"
                    slot="activator">
                    <img src="http://localhost:8000/tmp/3f88711059fc7b50ae3ebd9a326fe2c91504071410_watermark.jpg">
                </v-avatar>
            </v-flex>
            <v-flex d-flex xs12 sm6 md8>
                <v-container row  wrap>
                    <v-flex d-flex>
                        <v-card class="detail-wrapper">
                            <v-card-text>
                                <div class="detail-category">
                                GENDER
                                </div>
                                <div class="detail-content">
                                {{ memberData.gender }}
                                </div>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                    <v-flex d-flex>
                            <v-card class="detail-wrapper">
                            <v-card-text>
                                <div class="detail-category">
                                SPEED
                                </div>
                                <div class="detail-content">
                                {{ memberData.speed }}
                                </div>
                            </v-card-text>
                            </v-card>
                    </v-flex>
                    <v-flex d-flex>
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
    background-color: rgb(221, 221, 221);
    padding: 3%;
    width: 90%;
    margin: 0 auto;
    border-radius: 10px;
}
.vertical-center {
    margin-top: 3.5em;
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