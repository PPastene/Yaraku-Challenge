<template>
    <layout>
        <v-container>
            <h1>Here goes the beauty of this website</h1>
            <data-table
                :items="books"
            ></data-table>
        </v-container>
    </layout>
</template>
<script>
import Layout from '@/Shared/Layout'
import DataTable from '@/Shared/DataTable'
export default {
    components: {
        Layout,
        DataTable
    },
    props: {
        books: Object
    },
    data() {
        return {

        }
    }
}
</script>
