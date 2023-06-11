<script setup>
import { ref } from 'vue';
import { useSorter } from '../../../js/vue_utils';
import FetchData from '@/views/components/FetchData.vue';

const dataViz = ref(null);
const [sorted, sort] = useSorter('id');


const sortBy = (by) => {
    sort(by);
    if (dataViz.value) {
        dataViz.value.reload();
    }
};

const getUrl = ({page, perPage, search}) => {
    let url =
        CUSTOMERS_API_LINK +
        `?start=${(page - 1) * perPage}&limit=${perPage}`;
    url += `&order_by=${sorted.by}&order=${sorted.order}`;
    if (search) {
        url += `&search=${search}`;
    }
    return url;
}

const ledgerLink = (item) => CUSTOMERS_LEDGER_LINK.replace('::ID::', item.id);
const editLink = (item) => CUSTOMER_EDIT_LINK.replace('::ID::', item.id);

const highlightText = (text, highlight) => {
    if (!highlight) {
        return text;
    }
    return text.replace(new RegExp(highlight, 'i'), (a)=>{
        return `<mark>${a}</mark>`;
    });
}

</script>

<template>
    <FetchData ref="dataViz" :url="getUrl" v-slot="{data, loading, search}">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th
                        scope="col"
                        class="px-6 py-3 sortable"
                        :class="{
                            [sorted.order]: sorted.by === 'id',
                        }"
                        @click="() => sortBy('id')"
                    >
                        Sln
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-3 sortable"
                        :class="{
                            [sorted.order]: sorted.by === 'name',
                        }"
                        @click="() => sortBy('name')"
                    >
                        Name
                    </th>
                    <th
                        scope="col"
                        class="px-6 py-3 sortable"
                        :class="{
                            [sorted.order]: sorted.by === 'address',
                        }"
                        @click="() => sortBy('address')"
                    >
                        Address
                    </th>
                    <th scope="col" class="px-6 py-3">Balance (Due)</th>
                    <th scope="col" class="px-6 py-3">Ledger</th>
                    <th scope="col" class="px-6 py-3">Signal</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody v-if="loading">
                <tr>
                    <td colspan="7">
                        <p class="text-center p-10">Loading...</p>
                    </td>
                </tr>
            </tbody>
            <tbody v-else-if="data.length > 0" class="divide-y">
                <tr
                    v-for="(item, idx) in data"
                    class="bg-white hover:bg-gray-50"
                >
                    <td class="px-6 py-4 font-medium whitespace-nowrap">
                        {{ idx + 1 }}
                    </td>
                    <th
                        scope="row"
                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap"
                        v-html="highlightText(item.name, search)"
                    >
                    </th>
                    <td class="px-6 py-4" v-html="highlightText(item.address, search)"></td>
                    <td class="px-6 py-4">
                        {{
                            parseInt(
                                item.sales_sum_goods_of_issues -
                                    item.sales_sum_received_money
                            ) || 0
                        }}
                    </td>
                    <td class="px-6 py-4">
                        <a
                            :href="ledgerLink(item)"
                            class="font-medium text-yellow-500 hover:underline"
                            >View</a
                        >
                    </td>
                    <td class="px-6 py-4">
                        <div
                            class="h-4 w-8 rounded-md"
                            :class="{
                                'bg-red-600':
                                    parseInt(
                                        item.sales_sum_goods_of_issues -
                                            item.sales_sum_received_money
                                    ) > item.limit,
                                'bg-green-600':
                                    parseInt(
                                        item.sales_sum_goods_of_issues -
                                            item.sales_sum_received_money
                                    ) <= item.limit,
                            }"
                        ></div>
                    </td>
                    <td class="px-6 py-4">
                        <a
                            :href="editLink(item)"
                            class="font-medium text-blue-600 hover:underline"
                            >Edit</a
                        >
                        |
                        <a
                            href="#"
                            class="font-medium text-red-600 hover:underline"
                            >Delete</a
                        >
                    </td>
                </tr>
            </tbody>
            <tbody v-else>
                <tr>
                    <td colspan="7">
                        <p class="p-10 text-center">No items here!</p>
                    </td>
                </tr>
            </tbody>
        </table>
    </FetchData>
</template>
