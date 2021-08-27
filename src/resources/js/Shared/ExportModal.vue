<template>
    <b-modal ref="export-modal" title="Export Data" @hidden="reset" @close="reset" hide-footer>
        <b-form @submit.prevent="submit">
                <b-form-group label="Select the data to export" v-slot="{ ariaDescribedby }">
                    <b-form-radio-group
                        id="type-radio-group"
                        v-model="selected.type"
                        :options="options.type"
                        :aria-describedby="ariaDescribedby"
                        name="radio-type"
                    ></b-form-radio-group>
                </b-form-group>
                <b-form-group label="Select the file format" v-slot="{ ariaDescribedby }">
                    <b-form-radio-group
                        id="format-radio-group"
                        v-model="selected.format"
                        :options="options.formats"
                        :aria-describedby="ariaDescribedby"
                        name="radio-format"
                    ></b-form-radio-group>
                </b-form-group>
            <b-button variant="danger" @click="closeModal">Cancel</b-button>
            <b-button variant="success" type="submit">Export</b-button>
        </b-form>
    </b-modal>
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
            selected: {
                type: null,
                format: null
            },
            options: {
                type: [
                    { text: 'Books only', value: 'books' },
                    { text: 'Authors only', value: 'authors' },
                    { text: 'Books and Authors', value: 'books-authors' },
                ],
                formats: [
                    { text: 'CSV', value: 'csv' },
                    { text: 'XML', value: 'xml' },
                ]
            }
        }
    },
    methods: {
        showModal()
        {
            this.$refs['export-modal'].show()
        },
        closeModal()
        {
            this.$refs['export-modal'].hide()
        },
        submit()
        {
            this.$inertia.get(`/book/export/${this.selected.type}/${this.selected.format}`, {
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
            this.selected = {
                type: null,
                format: null
            }
        }
    }
}
</script>
