<template>
    <div
        v-for="message in post"
        :key="post.ts"
        class="row justify-content-center m-2"
    >
        <p v-if="message && message.user"><b>{{ message.user }}</b> - <span><i>{{ convertUnixToDate(message.ts) }}</i></span></p>
        <p>{{ message ? message.text : 'Loading...'}}</p>
        <hr>
    </div>
</template>

<script setup>
import { ref } from 'vue';


let post = ref('Loading...');

setTimeout(async () => {
    const res = await fetch(`/messages`).then((r) => r.json());
    // filter by user
    // post.value = res.messages.filter(function (m) {
    //     return m.user == 'U050N0EG6CT';
    // });

    post.value = res.messages;

}, 2000);

function convertUnixToDate(ts) {
    return new Date(ts * 1000).toLocaleString();
}
</script>

<style scoped>

</style>
