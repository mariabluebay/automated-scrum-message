<template>
    <div class="container">
        <div class="row">
            <div class="col-sm">

                <History v-model="message"/>
            </div>
            <div class="col-sm">

                <div class="card">
                    <div class="card-header">New message</div>
                    <div class="card-body">
                        <div class="">
                            <Message
                                v-model="message"
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

    let message = ref({
        'action': 'new',
        'text': 'Message #api.',
        'ts': null
    });

</script>

<style scoped>

</style>
