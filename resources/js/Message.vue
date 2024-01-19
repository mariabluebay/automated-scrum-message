<template>
    <textarea
        v-text="modelValue.text"
        @keydown.enter.prevent="sendMessage"
        class="form-control" id="textMessage"
        name="textMessage" ></textarea>
</template>

<script setup>
    const props = defineProps({
        modelValue: Object
    });
    let emitUpdate = defineEmits(['update:modelValue']);

     function sendMessage(e) {
       emitUpdate(
           'update:modelValue',
           {
               "action": props.modelValue.action,
               "text": e.target.value,
               "ts":  props.modelValue.ts,
           }
       );

       setTimeout(async () => {
           const token = window.document.body.querySelector('meta[name="csrf-token"]').content;

           let data = {
               "text": props.modelValue.text,
               "ts": props.modelValue.ts,
               "action": props.modelValue.action
           }

           let uri = data.action !== "new" ? 'modify' : 'notify'

           const requestOptions = {
               method: "POST",
               headers: {
                   "Content-Type": "application/json",
                   "X-CSRF-ToKEN": token
               },
               body: JSON.stringify(data)
           };


           await fetch(uri, requestOptions).then(response => response.json())
               .then(data => {
                   console.log(data)
               })
               .catch(err => console.log(err, requestOptions.headers));

       }, 2000);
    }
</script>

<style scoped>

</style>
