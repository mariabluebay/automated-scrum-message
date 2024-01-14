<template>
    <div class="card">
        <div class="card-header">Messages</div>
        <div
            v-if="history"
            class="card-body"
        >
            <div
                v-for="message in history"
                :key="history.ts"
                class="row justify-content-center m-2"
            >
                <p
                    v-if="message && message.user"
                    class="card-title"
                    :id="message.ts"
                >
                    <b>{{ message.user }}</b> - <span><i>{{ convertUnixToDate(message.ts) }}</i></span>
                </p>
                <p
                    v-else
                    class="card-title"
                    :id="message.ts"
                >
                    <span data-ts="{{ message.ts }}"><i>{{ convertUnixToDate(message.ts) }}</i></span>
                </p>
                <p class="card-text">{{ message ? message.text : 'Loading...'}}</p>
                <div class="d-flex flex-row-reverse">
                    <button
                        @click="action(message, 'delete')"
                        type="button"
                        class="btn btn-danger btn-sm m-1"
                    >Delete</button>
                    <button
                        @click="action(message, 'edit')"
                        type="button"
                        class="btn btn-primary btn-sm m-1"
                    >Edit</button>
                </div>

                <hr>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
let history = ref('Loading...');

defineProps({
    modelValue: Object
});

let emitUpdate = defineEmits(['update:modelValue']);

setTimeout(async () => {
    const res = await fetch(`/messages`).then((r) => r.json());
    // filter by user
    history.value = res.messages.filter(function (m) {
        //console.log(m);
        if(m.hasOwnProperty('username')) {
            return m.username === 'SCRUM_API';
        }

        return false;

    });

    history.value = res.messages;

}, 2000);

function convertUnixToDate(ts) {
    return new Date(ts * 1000).toLocaleString();
}

function action(message, action) {
    emitUpdate(
        'update:modelValue',
        {
            'action': action,
            'text' : message.text,
            'ts': message.ts
        });
}
</script>

<style scoped>

</style>
