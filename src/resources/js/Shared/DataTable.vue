<template>
    <div>
        <b-table
            id="books-table"
            :items="items"
            :fields="fields"
            :primary-key="items.id"
            :current-page="pagination.currentPage"
            :per-page="pagination.perPage"
            :sort-desc.sync="sorting.sortDesc"
            striped
            hover
            show-empty
            responsive
        >
            <template #cell(actions)="row">
                <b-button variant="secondary" squared @click="showEditModal(row.item)">
                    <b-icon icon="pencil"></b-icon>
                </b-button>
                <b-button variant="danger" squared @click="showDeleteModal(row.item.id)">
                    <b-icon icon="trash"></b-icon>
                </b-button>
            </template>
        </b-table>
        <b-pagination
            v-model="pagination.currentPage"
            :total-rows="rows"
            :per-page="pagination.perPage"
            aria-controls="books-table"
        ></b-pagination>
        <add-edit-modal ref="editModalComponent"></add-edit-modal>
        <delete-modal ref="deleteModalComponent"></delete-modal>
    </div>
</template>
<script>
import AddEditModal from '@/Shared/AddEditModal'
import DeleteModal from '@/Shared/DeleteModal'
export default {
    components: {
        AddEditModal,
        DeleteModal
    },
    props: {
        items: Array
    },
    data(){
        return {
            fields: [
                {key: 'title', label: 'Title', sortable: true},
                {key: 'author', label: 'Author', sortable: true},
                {key: 'actions', label: 'Actions', sortable: false},
            ],
            sorting : {
                sortDesc: false,
            },
            pagination: {
                currentPage: 1,
                perPage: 10,
            }
        }
    },
    computed: {
        rows()
        {
            return this.items.length
        }
    },
    methods:{
        showEditModal(data)
        {
            this.$refs.editModalComponent.showModal(data)
        },
        showDeleteModal(id)
        {
            this.$refs.deleteModalComponent.showModal(id)
        },
    }
}
</script>
