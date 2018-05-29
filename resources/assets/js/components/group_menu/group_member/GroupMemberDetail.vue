<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
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
                            v-if="gendersc == 'true'"
                            md6>
                        <v-card class="detail-wrapper">
                            <v-card-text>
                                <div class="detail-category">
                                성별
                                </div>
                                <div class="detail-content">
                                {{ userData.gender == 0 ? 'male' : 'female' }}
                                </div>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                    <v-flex
                            v-if="phonesc == 'true'"
                            md6>
                            <v-card class="detail-wrapper">
                            <v-card-text>
                                <div class="detail-category">
                                핸드폰
                                </div>
                                <div class="detail-content">
                                {{ userData.phone }}
                                </div>
                            </v-card-text>
                            </v-card>
                    </v-flex>
                    <v-flex
                            v-if="agesc == 'true'"
                            md6>
                        <v-card class="detail-wrapper">
                            <v-card-text>
                                <div class="detail-category">
                                    나이
                                </div>
                                <div class="detail-content">
                                    {{ userData.age_group }}대
                                </div>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                    <v-flex
                            md6>
                        <v-card class="detail-wrapper">
                            <v-card-text>
                                <div class="detail-category">
                                    아이디
                                </div>
                                <div class="detail-content">
                                    {{ userData.userid }}
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
        props:  {
            userData: {
                type: Object,
                required: true
            }
        },
        data: () => ({
            scv: '',
            phonesc: '',
            gendersc: '',
            agesc: ''

        }),
        methods:    {
            publicMode()    {
                if(this.userData.scope / 10000 >= 1 ) {
                    this.scv     = 'all';
                    this.userData.scope   = this.userData.scope - 10000;
                }
                else {
                    this.scv     = 'group';
                    this.userData.scope   = this.userData.scope - 1000;
                }
                if(this.userData.scope / 100 >= 1 ) {
                    this.phonesc = 'true';
                    this.userData.scope   = this.userData.scope - 100;
                }
                else {
                    this.phonesc = 'false';
                }
                if(this.userData.scope / 10 >= 1 ) {
                    this.gendersc    = 'true';
                    this.userData.scope       = this.userData.scope - 10;
                }
                else {
                    this.gendersc = 'false';
                }
                if(this.userData.scope == 1 ) {
                    this.agesc = 'true';
                }
                else {
                    this.agesc = 'false';
                }
            }
        },
        created() {
            this.$EventBus.$on('memberData', (event) => {
                this.memberData = event;
            });
            this.publicMode();
        }
    }
</script>

<style>
.member-detail-wrapper {
    background-color: rgb(240, 240, 240);
    width: 100%;
    border-radius: 10px;
}
.detail-wrapper {
    background-color: white;
    color: black;
    box-shadow: none;
    border-radius: 5px;
    font-size: 1rem;
    margin: 0px;
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