<template>
    <router-link :to="{ name: 'jungyu' }">준규 집 ㄱㄱ</router-link>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        I'm an example component!<br>
                        routes/web.php -> resources/views/app.blade.php<br>
                        app.blade.php 의 id="app" 부분에 ExampleComponent를 mount 했습니다
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
