<script setup>
import { router } from '@inertiajs/vue3';
defineProps({ 
  id: String,
  blog: Object
  });

const deleteConfirm = id => {
  router.delete(`/inertia/${id}`, {
     onBefore: () => confirm('本当に削除しますか？')
    }
  );
}

</script>

<template>
  <h1>Inertia Show Page</h1>
  <p>ID: {{ id }}</p>
  <p>件名：{{ blog.title }}</p>
  <button @click="deleteConfirm(blog.id)">削除</button>
</template>