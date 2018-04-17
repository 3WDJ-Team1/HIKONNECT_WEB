<template>
    <div class="input-group mb-3">
        <select class="selectpicker">
            <option>Mustard</option>
            <option>Ketchup</option>
            <option>Relish</option>
        </select>
        <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
        <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
        </div>
    </div>
</template>
<script>
    export default {
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