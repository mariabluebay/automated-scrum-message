<template>
    <textarea
        v-text="modelValue"
        @keydown.enter.prevent="sendMessage"
        class="form-control" id="textMessage"
        name="textMessage" ></textarea>
</template>

<script setup>

    const props = defineProps({
        modelValue: String
    });
    let emitUpdate = defineEmits(['update:modelValue']);


     function sendMessage(e) {
       emitUpdate('update:modelValue', e.target.value);

       setTimeout(async () => {
           // POST request using fetch with async/await
           const token = window.document.body.querySelector('meta[name="csrf-token"]').content;
           const requestOptions = {
               method: "POST",
               headers: {
                   "Content-Type": "application/json",
                   "X-CSRF-ToKEN": token
               },
               body: JSON.stringify({text: props.modelValue})
           };

           await fetch('/notify', requestOptions).then(response => response.json())
               .then(data => {
                   console.log(data)
               })
               .catch(err => console.log(err, requestOptions.headers));

       }, 2000);
    }
</script>

<style scoped>

</style>
