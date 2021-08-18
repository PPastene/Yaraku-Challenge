<template>
    <div>
        <b-table striped hover :items="items" :fields="fields">
            <template #cell(actions)="row">
                <b-button variant="secondary" squared @click="showEditModal(row.item)">
                    <b-icon icon="pencil"></b-icon>
                </b-button>
                <b-button variant="danger" squared @click="showDeleteModal(row.item.id)">
                    <b-icon icon="trash"></b-icon>
                </b-button>
            </template>
        </b-table>
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
                {key: 'title', label: 'Title'},
                {key: 'author', label: 'Author'},
                {key: 'actions', label: 'Actions'},
            ]
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
