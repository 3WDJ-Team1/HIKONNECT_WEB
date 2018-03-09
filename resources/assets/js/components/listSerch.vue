<template>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="#">Actdfdfion</a>
                <a class="dropdown-item" href="#">Another adfsdction</a>
                <a class="dropdown-item" href="#">Somethingdfasdfasdf else here</a>
                <div role="separator" class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">Separated link</a>
            </div>
        </div>
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
                this.axios.post('http://localhost:8000/list')
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