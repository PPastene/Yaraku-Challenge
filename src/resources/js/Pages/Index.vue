<template>
    <layout>
        <b-container>
            <b-button variant="success" @click="showAddModal">New Book</b-button>
            <b-button variant="primary">Search</b-button>
            <b-button variant="dark">Export</b-button>
            <data-table :items="books"></data-table>
        <add-edit-modal ref="addModalComponent"></add-edit-modal>
        </b-container>
    </layout>
</template>
<script>
import Layout from '@/Shared/Layout'
import AddEditModal from '@/Shared/AddEditModal'
import DataTable from '@/Shared/DataTable'
export default {
    components: {
        Layout,
        AddEditModal,
        DataTable
    },
    props: {
        books: Array
    },
    data() {
        return {

        }
    },
    methods:{
        showAddModal()
        {
            this.$refs.addModalComponent.showModal()
        }
    }
}
</script>
