<template>
    <div>
        <b-modal ref="add-edit-modal" :title='formTitle' @hidden="reset" @close="reset">
            <b-form @submit="submit">
                <b-form-group
                    id="input-group-1"
                    label="Title:"
                    label-for="input-1"
                >
                    <b-form-input
                        id="input-1"
                        v-model="book.title"
                        type="text"
                        placeholder="Enter book title"
                        required
                    ></b-form-input>
                </b-form-group>
                <b-form-group
                    id="input-group-2"
                    label="Author:"
                    label-for="input-2"
                >
                    <b-form-input
                        id="input-2"
                        v-model="book.author"
                        type="text"
                        placeholder="Enter book author"
                        required
                    ></b-form-input>
                </b-form-group>
            </b-form>
            <template #modal-footer>
                <b-button variant="danger" @click="closeModal">
                    Cancel
                </b-button>
                <b-button variant="success" @click="submit">
                    Save
                </b-button>
            </template>
        </b-modal>
    </div>
</template>
<script>
export default {

    data(){
        return {
            book:{
                id: null,
                title: null,
                author: null,
            },
            overlay: false,
            modal: false
        }
    },
    created(){
        console.log('Modal created!')
    },
    computed: {
        formTitle(){
            return this.book.id === null ? 'Add New Book' : 'Edit Book'
        }
    },
    methods: {
        showModal(data = null){
            if(data)
            {
                this.book = {
                    id:data.id,
                    title:data.title,
                    author:data.author
                }
            }
            this.$refs['add-edit-modal'].show()
        },
        closeModal()
        {
            this.$refs['add-edit-modal'].hide()
        },
        submit()
        {
            var config = {
                onBefore: () => {

                },
                onSuccess: () => {
                    this.closeModal()
                },
                onFinish: () => {
                    this.reset();
                },
            }
            this.book.id ? this.$inertia.put('/book', this.book, config) : this.$inertia.post('/book', this.book, config)
        },
        reset()
        {
            this.book = {
                id: null,
                title: null,
                author: null,
            }
        }
    }
}
</script>
