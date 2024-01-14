<template>
    <div class="container">
        <div class="row">
            <div class="col-sm">

                <History v-model="textMessage"/>
            </div>
            <div class="col-sm">

                <div class="card">
                    <div class="card-header">New message</div>
                    <div class="card-body">
                        <div class="">
                            <Message
                                v-model="textMessage"
                                style="width: 100%; min-height: 300px"
                            />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import History from "./History.vue"
    import Message from "./Message.vue";

    let post = ref('Loading...');
    let textMessage = ref('Message #api.');

</script>

<style scoped>

</style>
