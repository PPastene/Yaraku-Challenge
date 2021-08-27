<template>
    <div>
        <b-modal ref="add-edit-modal" :title='formTitle' @hidden="reset" hide-footer>
            <ValidationObserver v-slot="{ handleSubmit }">
                <b-form ref="add-edit-form" @submit.prevent="handleSubmit(submit)">
                    <ValidationProvider rules="required" name="Title" v-slot="{ errors }">
                        <b-form-group
                            id="title-input-group"
                            label="Title:"
                            label-for="title-input">
                            <b-form-input
                                id="title-input"
                                v-model="book.title"
                                type="text"
                                placeholder="Enter book title">
                            </b-form-input>
                            <span>{{ errors[0] }}</span>
                        </b-form-group>
                    </ValidationProvider>

                    <ValidationProvider rules="required" name="Author" v-slot="{ errors }">
                        <b-form-group
                            id="author-input-group"
                            label="Author:"
                            label-for="author-input">
                            <b-form-input
                                id="author-input"
                                v-model="book.author"
                                type="text"
                                placeholder="Enter book author">
                            </b-form-input>
                            <span>{{ errors[0] }}</span>
                        </b-form-group>
                    </ValidationProvider>
                    <b-button variant="danger" @click="closeModal">
                        Cancel
                    </b-button>
                    <b-button variant="success" type="submit">
                        Save
                    </b-button>
                </b-form>
            </ValidationObserver>
        </b-modal>
    </div>
</template>
<script>
import { ValidationObserver, ValidationProvider } from 'vee-validate';
export default {
    components: {
        ValidationObserver,
        ValidationProvider
    },
    data(){
        return {
            book: this.$inertia.form({
                id: null,
                title: null,
                author: null,
            }),
            spinner: false,
            modal: false
        }
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
        handleOk(bvModalEvt) {
            bvModalEvt.preventDefault()
            this.submit()
        },
        submit()
        {
            var config = {
                onBefore: () => {
                    this.spinner = true
                },
                onSuccess: () => {
                    this.spinner = false
                },
                onError: () => {
                    this.closeModal()
                },
                onFinish: () => {
                    this.closeModal()
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
