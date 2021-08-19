<template>
    <layout>
        <b-container>
            <b-row>
                <b-col md>
                    <b-button variant="success" @click="showAddModal">New Book</b-button>
                    <b-button variant="dark" @click="showExportModal">Export</b-button>
                </b-col>
                <b-col md>
                    <b-form inline>
                        <label class="sr-only" for="inline-form-input-name">Title</label>
                        <b-form-input
                            id="inline-form-input-name"
                            v-model="search.title"
                            class="mb-2 mr-sm-2 mb-sm-0"
                            placeholder="Harry Potter"
                            @keyup="submit"
                        ></b-form-input>

                        <label class="sr-only" for="inline-form-input-username">Author</label>
                        <b-form-input
                            id="inline-form-input-username"
                            v-model="search.author"
                            placeholder="J.K. Rowling"
                            @keyup="submit"
                        ></b-form-input>

                        <b-button variant="primary" @click="reset">Clear</b-button>
                    </b-form>
                </b-col>
            </b-row>
            <b-row>
                <data-table :items="books"></data-table>
            </b-row>
            <add-edit-modal ref="addModalComponent"></add-edit-modal>
            <export-modal ref="exportModalComponent"></export-modal>
        </b-container>
    </layout>
</template>
<script>
import Layout from '@/Shared/Layout'
import AddEditModal from '@/Shared/AddEditModal'
import DataTable from '@/Shared/DataTable'
import ExportModal from '@/Shared/ExportModal'
export default {
    components: {
        Layout,
        AddEditModal,
        DataTable,
        ExportModal
    },
    props: {
        books: Array
    },
    data() {
        return {
            search: {
                title: null,
                author: null
            }
        }
    },
    methods:{
        showAddModal()
        {
            this.$refs.addModalComponent.showModal()
        },
        showExportModal()
        {
            this.$refs.exportModalComponent.showModal()
        },
        submit()
        {
            this.$inertia.replace(route('index', this.search))
        },
        reset()
        {
            this.search = {
                title: null,
                author: null
            }
            this.submit()
        }
    }
}
</script>
