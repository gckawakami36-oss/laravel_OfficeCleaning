<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import FlashMessage from '@/Components/FlashMessage.vue';
import { computed } from 'vue';

defineProps({items: Array});

const page = usePage();
const user = computed(() => page.props.auth.user);
const isAdmin = computed(() => user.value?.role === 'admin');

const navigateToCreate = () => {
    router.visit(route('items.create'));
};

const exportPdf = () => {
    window.location.href = route('items.export.pdf');
};

</script>

<template>
    <Head title="商品一覧" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">商品一覧</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        
                        <section class="text-gray-600 body-font">
  <div class="container px-5 py-8 mx-auto">
   <FlashMessage />
<div class="flex pl-4 my-4 lg:w-2/3 w-full mx-auto">
      
      <button @click="navigateToCreate" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded">商品登録</button>
      <button v-if="isAdmin" @click="exportPdf" class="ml-4 text-white bg-green-500 border-0 py-2 px-6 focus:outline-none hover:bg-green-600 rounded">PDF出力</button>
  </div>

  </div>
    <div class="lg:w-2/3 w-full mx-auto overflow-auto">
      <table class="table-auto w-full text-left whitespace-no-wrap">
        <thead>
          <tr>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">ID</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">商品名</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">価格</th>
            <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">販売ステータス</th>
            
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in items" :key="item.id">
            <td class="border-b-2 border-gray-200 px-4 py-3">
             <Link class ="text-blue-400" :href="route('items.show', { id: item.id })">
              {{ item.id }}</Link>
            </td>
            <td class="border-b-2 border-gray-200 px-4 py-3">{{ item.name }}</td>
            <td class="border-b-2 border-gray-200 px-4 py-3">{{ item.price }}</td>
            <td class="border-b-2 border-gray-200 px-4 py-3 text-lg">
                <span v-if="item.is_selling === 1">販売中</span>
                <span v-if="item.is_selling === 0">停止中</span>
            </td>
            
          </tr>
        </tbody>
      </table>
    </div>
    
</section>
                  </div>
              </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>