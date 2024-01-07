<template>
    <div class="card">
        <div class="card-body">
            <div class="">
                <form action="/notify" method="post">
                    <div class="mb-3 row">
                        <label for="text" class="col-md-4 col-form-label text-md-end text-start">Text</label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="text" name="text" :v-model="textMessage"></textarea>
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Send">
                    </div>
                </form>
            </div>
        </div>
    </div>


</template>

<script setup>
import { ref } from 'vue';
let textMessage = ref('Message #api.');

</script>

<style scoped>

</style>
