<!--
    @author Jiyoon Lee <jiyoon3421@gmail.com>
 -->
<template>
    <div>
        <table class="table" style="text-align:center;">
            <tbody>
            <tr style="border-bottom: solid 1.4px; border-right: solid 1.4px; border-left: solid 1.4px; color: #ececec;">
                <td style="color: #000; font-size: 30px;">{{ noticeItem.title }}</td>
            </tr>
            <tr style="border-bottom: solid 1.4px; border-right: solid 1.4px; border-left: solid 1.4px; color: #ececec;" v-show="noticeItem.picture == 'true'">
                <img width="558" height="400" :src="'http://hikonnect.ga:3000/images/Announce/' + noticeItem.no + '.jpg'"/>
            </tr>
            <tr style="border-bottom: solid 1.4px; border-right: solid 1.4px; border-left: solid 1.4px; color: #ececec;">
                <td style="color: #000; font-size: 15px;">{{ noticeItem.content }}</td>
            </tr>
            </tbody>
        </table>
        <button type="submit" v-if="noticeItem.writer == userid" class="btn btn-warning btn-fill float-right" @click="deleteNotice">
            삭제하기
        </button>
        <button type="submit" v-if="noticeItem.writer == userid" class="btn btn-info btn-fill float-right" @click="updateNotice">
            수정하기
    </button>
    </div>
</template>

<script>
    export default {
        props:  {
            noticeItem: {
                type: Object
            }
        },
        name: "notice-modal",
        data: () => ({
            /**
             * title        (String)       공지사항 제목
             * text         (String)       공지사항 내용
             * noticeInfo   (Object)       공지사항 정보
             * imageSrc     (String)       공지사항 사진 요청 url
             */
            title: '',
            text: '',
            userid: sessionStorage.getItem('userid'),
        }),
        methods:  {
            // 수정하기 버튼 클릭시 수정하기 모달로 체인지 될 수 있도록 event를 보낸다.
            updateNotice()  {
                this.$EventBus.$emit('updateNoticeSign', this.noticeItem);
            },
            // 삭제하기 버튼 클릭 시 삭제를 하고 삭제 사인을 보내어 공지사항 리스트를 재배열 event를 보낸 후 모달을 닫는다.
            deleteNotice()  {
                this.axios.delete(this.$HttpAddr + '/notice/' + this.noticeItem.no)
                    .then((response) => {
                        if(response.data == 'true') {
                            this.$EventBus.$emit('deleteNoticeSign', 'true');
                            this.$parent.close();
                        }
                    });
            }
        },
    }
</script>

<style scoped>

</style>