<template>
    <div class="input-group mb-3">
        <b-form-select v-model="selected" class="mb-3">
            <option value="group">그룹명</option>
            <option value="b" disabled>작성자명</option>
        </b-form-select>
        <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
        </div>
    </div>
</template>
<script>
    export default {
        data()  {
            return {
                selected: null
            }
        },
        method: {
            input: function()   {
                this.axios.post(Laravel.host + '/list')
                    .then(response => {
                        console.log(response.data);
                    })
                    .catch(e => {
                        this.errors.push(e)
                    })
            }
        }
    }
</script>