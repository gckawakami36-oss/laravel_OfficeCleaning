<script setup>
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import { ref, watch } from 'vue';

const title = ref('初期値です');

// 入力のタイミングでコンソールに表示
watch(title, (newValue) => {
  console.log('入力された値:', newValue);
});
</script>

<template>
 <GuestLayout>
   <div class="p-6">
     <InputLabel value="タイトル" />
     <TextInput 
       v-model="title"
       class="mt-1 block w-full" 
     />
   </div>
 </GuestLayout>
</template>