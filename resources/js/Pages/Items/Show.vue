<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import { computed } from 'vue';

const props = defineProps({
    item: Object
});

const page = usePage();
const user = computed(() => page.props.auth.user);
const isAdmin = computed(() => user.value?.role === 'admin');

const exportSinglePdf = () => {
    window.location.href = route('items.export.single.pdf', { item: props.item.id });
};
</script>

<template>
    <Head title="商品詳細" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">商品詳細</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <section class="text-gray-600 body-font">
                            <div class="container px-5 py-8 mx-auto">
                                <div class="lg:w-2/3 w-full mx-auto">
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm mb-2">商品名</label>
                                        <div class="w-full rounded border border-gray-300 px-4 py-2 text-gray-900">
                                            {{ item.name }}
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm mb-2">メモ</label>
                                        <div class="w-full rounded border border-gray-300 px-4 py-2 text-gray-900 h-32" style="white-space: pre-wrap;">{{ item.memo }}</div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm mb-2">商品価格</label>
                                        <div class="w-full  rounded border border-gray-300 px-4 py-2 text-gray-900">
                                            {{ item.price }}
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <label class="block text-gray-700 text-sm mb-2">販売ステータス</label>
                                        <div class="w-full  rounded border border-gray-300 px-4 py-2 text-gray-900">
                                            <span v-if="item.is_selling === 1">販売中</span>
                                            <span v-if="item.is_selling === 0">停止中</span>
                                        </div>
                                    </div>
                                    <div class="flex gap-4">
                                        <Link :href="route('items.index')" class="text-white bg-gray-500 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg">
                                            戻る
                                        </Link>
                                        <Link as="button" :href="route('items.edit', { id: item.id })" class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                                            編集する
                                        </Link>
                                        <button v-if="isAdmin" @click="exportSinglePdf" class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">
                                            PDF出力
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
