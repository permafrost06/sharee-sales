<script setup>
import axios from 'axios';
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { gsapTL } from '@/js/utils';

const perPageEntris = [10, 20, 50, 100];

const popover = ref(null);
const perPage = ref(perPageEntris[0]);
const itemCount = ref(0);
const search = ref('');
const page = ref(1);
const data = ref([]);
const loading = ref(false);

const props = defineProps({
    url: String | Function,
});

defineExpose({
    reload: loadData
});

const reset = () => {
    page.value = 1;
    loading.value = false;
};

const onPerPageChange = (newPerPage) => {
    reset();
    perPage.value = newPerPage;
    loadData();
};

onMounted(() => {
    document.addEventListener('click', hidePopOver);
    loadData();
});

onUnmounted(() => {
    document.removeEventListener('click', hidePopOver);
});

function showPopOver() {
    if (!popover.value || !popover.value.classList.contains('hidden')) {
        return;
    }

    popover.value.classList.remove('hidden');

    gsapTL().fromTo(
        popover.value,
        {
            height: 0,
        },
        {
            height: 'auto',
            duration: 0.3,
        }
    );
}

function hidePopOver() {
    if (!popover.value || popover.value.classList.contains('hidden')) {
        return;
    }
    gsapTL()
        .to(popover.value, {
            height: 0,
            duration: 0.2,
        })
        .then(() => {
            popover.value.classList.add('hidden');
        });
}

function loadData() {
    if (loading.value) {
        return;
    }
    loading.value = true;
    let url = props.url;

    if (typeof url === 'function') {
        url = url({
            page: page.value,
            perPage: perPage.value,
            search: search.value
        });
    }

    axios
        .get(url, {
            withCredentials: true,
        })
        .then((res) => {
            loading.value = false;
            data.value = res.data.data;
            itemCount.value = res.data.count;
        })
        .catch((e) => {
            loading.value = false;
        });
}


const maxPage = computed(() => {
    return Math.ceil(itemCount.value / perPage.value);
});

const pages = computed(() => {
    const current = page.value;
    const onEachSide = 3;
    const max = maxPage.value;

    const pages = [];
    const start = Math.max(1, current - onEachSide);
    const end = Math.min(max, current + onEachSide);

    if (start > 1) {
        pages.push(1);
    }
    if (start > 2) {
        pages.push(0);
    }

    for (let i = start; i <= end; i++) {
        pages.push(i);
    }

    if (max - end > 1) {
        pages.push(0);
    }

    if (max > end) {
        pages.push(max);
    }

    return pages;
});

const setPage = (newPage) => {
    if (newPage < 1 || newPage > maxPage.value || newPage == page.value) {
        return;
    }
    page.value = newPage;
    loadData();
};

</script>

<template>
    <div class="relative sm:rounded-lg">
        <div class="flex flex-wrap gap-2 items-center justify-between pb-4">
            <div class="relative">
                <button
                    class="inline-flex items-center text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-3 py-1.5"
                    type="button"
                    @click.stop="showPopOver"
                >
                    Show {{ perPage }} entries
                    <svg
                        class="w-3 h-3 ml-2"
                        aria-hidden="true"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 9l-7 7-7-7"
                        ></path>
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div
                    ref="popover"
                    class="hidden overflow-hidden absolute left-0 top-full mt-2 z-10 w-48 bg-white divide-y divide-gray-100 rounded-lg shadow-full shadow"
                >
                    <ul class="p-3 space-y-1 text-sm text-gray-700">
                        <li
                            v-for="entry in perPageEntris"
                            @click="() => onPerPageChange(entry)"
                        >
                            <div
                                class="flex items-center p-2 rounded hover:bg-gray-100"
                            >
                                <input
                                    type="radio"
                                    :checked="perPage === entry"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 focus:ring-2"
                                />
                                <label
                                    class="w-full ml-2 text-sm font-medium text-gray-900 rounded"
                                    >{{ entry }}</label
                                >
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <label for="table-search" class="sr-only">Search</label>
            <div class="relative">
                <div
                    class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none"
                >
                    <svg
                        class="w-5 h-5 text-gray-500"
                        aria-hidden="true"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </div>
                <input
                    type="text"
                    id="table-search"
                    class="block p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Search anything..."
                    v-model="search"
                    @keyup="loadData"
                />
            </div>
        </div>
        <div class="overflow-x-auto">
            <slot :data="data" :loading="loading" :search="search"></slot>
        </div>
        <div class="flex justify-between items-center gap-4 border-t pt-4">
            <p class="text-sm font-medium">
                Showing {{ (page - 1) * perPage + 1 }}-{{
                    (page - 1) * perPage + data.length
                }}
                items out of {{ itemCount }}
            </p>
            <nav aria-label="Page navigation example">
                <ul class="inline-flex items-center -space-x-px">
                    <li
                        key="prev"
                        class="block px-3 py-2 ml-0 leading-tight text-gray-500 bg-white border border-gray-300 rounded-l-lg"
                        :class="{
                            'cursor-pointer hover:bg-gray-100 hover:text-gray-700':
                                page > 1,
                        }"
                        @click="() => setPage(page - 1)"
                    >
                        <span class="sr-only">Previous</span>
                        <svg
                            aria-hidden="true"
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </li>
                    <li
                        v-for="(pageI, idx) in pages"
                        :key="'page-' + idx"
                        class="px-3 py-2 leading-tight bg-white border"
                        :class="{
                            'z-10 text-blue-600 border-blue-300 bg-blue-50':
                                pageI == page,
                            'text-gray-500 border-gray-300 hover:bg-gray-100 hover:text-gray-700 cursor-pointer':
                                pageI != page,
                        }"
                        @click="() => setPage(pageI)"
                    >
                        {{ !pageI ? '...' : pageI }}
                    </li>

                    <li
                        key="next"
                        class="block px-3 py-2 leading-tight text-gray-500 bg-white border border-gray-300 rounded-r-lg"
                        :class="{
                            'cursor-pointer hover:bg-gray-100 hover:text-gray-700':
                                page < maxPage,
                        }"
                        @click="() => setPage(page + 1)"
                    >
                        <span class="sr-only">Next</span>
                        <svg
                            aria-hidden="true"
                            class="w-5 h-5"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</template>

<style scoped>
.shadow-full {
    box-shadow: 0 0 3px var(--tw-shadow-color);
}
</style>
