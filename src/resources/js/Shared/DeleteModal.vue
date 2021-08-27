<template>
    <b-modal ref="delete-modal" title="Delete Book" @hidden="reset" @close="reset">
        <p>Are you sure you want to delete this book?</p>
        <template #modal-footer>
            <b-button variant="primary" @click="closeModal">
                Cancel
            </b-button>
            <b-button variant="danger" @click="submit">
                <div v-if="spinner">
                    <b-spinner v-if="spinner" small type="grow"></b-spinner>
                    Deleting...
                </div>
                <span v-else>Delete</span>
            </b-button>
        </template>
    </b-modal>
</template>
<script>
export default {
    data(){
        return {
            book: {id: null},
            spinner: false
        }
    },
    methods:{
        showModal(id)
        {
            this.book.id = id
            this.$refs['delete-modal'].show()
        },
        closeModal()
        {
            this.$refs['delete-modal'].hide()
        },
        submit()
        {
            this.spinner = true
            this.$inertia.delete('/book/'+ this.book.id, {
                onBefore: () => {
                    this.spinner = true
                },
                onSuccess: () => {
                    this.spinner = false
                },
                onError: () => {
                    this.spinner = false
                    this.closeModal()
                },
                onFinish: () => {
                    this.closeModal();
                },
            })
        },
        reset()
        {
            this.book.id = null
            this.spinner = false
        }
    }
}
</script>
