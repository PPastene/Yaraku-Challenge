<template>
    <v-data-table
        :headers="headers"
        :items="items"
    ></v-data-table>
</template>
<script>
export default {
    props: {
        items: Object,
    },
    data() {
        return {
            headers: [
                { text: 'Title', value: 'title' },
                { text: 'Author', value: 'author' },
            ]
        }
    }
}
</script>
