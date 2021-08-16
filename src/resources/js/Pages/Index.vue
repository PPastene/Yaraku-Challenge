<template>
    <layout>
        <v-container>
            <h1>Here goes the beauty of this website</h1>
            <Dialog />
            <data-table
                :items="books"
            ></data-table>
        </v-container>
    </layout>
</template>
<script>
import Layout from '@/Shared/Layout'
import DataTable from '@/Shared/DataTable'
import Dialog from '@/Shared/Dialog'
export default {
    components: {
        Layout,
        DataTable,
        Dialog
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
