<template>
    <b-modal ref="delete-modal" title="Delete Book" @hidden="reset" @close="reset">
        <p>Are you sure you want to delete this book?</p>
        <template #modal-footer>
            <b-button variant="primary" @click="closeModal">
                Cancel
            </b-button>
            <b-button variant="danger" @click="submit">
                OK
            </b-button>
        </template>
    </b-modal>
</template>
<script>
export default {
    data(){
        return {
            book: {id: null}
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
            this.$inertia.delete('/book/'+ this.book.id, {
                onBefore: () => {

                },
                onSuccess: () => {
                    this.closeModal()
                },
                onFinish: () => {
                    this.reset();
                },
            })
        },
        reset()
        {
            this.book.id = null
        }
    }
}
</script>
