<template>
    <b-modal ref="export-modal" title="Export Data" @hidden="reset" @close="reset">
        <b-form @submit="submit">
            <b-form-group label="Select the data to export" v-slot="{ ariaDescribedby }">
                <b-form-radio-group
                    id="radio-group-1"
                    v-model="selected.data"
                    :options="options.data"
                    :aria-describedby="ariaDescribedby"
                    name="radio-data"
                ></b-form-radio-group>
            </b-form-group>
            <b-form-group label="Select the file format" v-slot="{ ariaDescribedby }">
                <b-form-radio-group
                    id="radio-group-2"
                    v-model="selected.format"
                    :options="options.formats"
                    :aria-describedby="ariaDescribedby"
                    name="radio-formats"
                ></b-form-radio-group>
            </b-form-group>
            {{selected}}
        </b-form>
        <template #modal-footer>
            <b-button variant="danger" @click="closeModal">Cancel</b-button>
            <b-button variant="success" @click="submit">Export</b-button>
        </template>
    </b-modal>
</template>
<script>
export default {
    data(){
        return {
            selected: {
                data: null,
                format: null
            },
            options: {
                data: [
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
            this.$inertia.get('/book/export', this.selected, {
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
                data: null,
                format: null
            }
        }
    }
}
</script>
