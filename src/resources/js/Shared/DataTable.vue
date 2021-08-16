<template>
    <v-data-table
        :headers="headers"
        :items="items"
    >
        <template v-slot:top>
            <v-toolbar flat>
                <v-toolbar-title>Book Repository</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="500px" @keydown.esc="reset()" @click:outside="reset()">
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn
                            color="primary"
                            dark
                            class="mb-2"
                            v-bind="attrs"
                            v-on="on"
                        >
                            New Book
                        </v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <h2>Add new book</h2>
                        </v-card-title>
                        <v-card-text>
                            <v-form>
                                <v-container>
                                    <v-text-field
                                        v-model="book.title"
                                        label="Title"
                                        required
                                    ></v-text-field>
                                    <v-text-field
                                        v-model="book.author"
                                        label="Author"
                                        required
                                    ></v-text-field>
                                </v-container>
                            </v-form>
                            <v-overlay :value="overlay">
                                <v-progress-circular
                                    indeterminate
                                    size="64"
                                ></v-progress-circular>
                            </v-overlay>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn
                                color="primary"
                                text
                                @click="dialog = false; reset()"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                color="primary"
                                text
                                @click="add()"
                            >
                                Add Book
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-toolbar>
        </template>
    </v-data-table>
</template>
<script>
export default {
    props: {
        items: Array,
    },
    data() {
        return {
            dialog: false,
            overlay: false,
            book: {
                id: null,
                title: null,
                author: null
            },
            headers: [
                { text: 'Title', value: 'title' },
                { text: 'Author', value: 'author' },
            ]
        }
    },
    methods: {
        add()
        {
            this.$inertia.post('/book', this.book, {
                onBefore: () => {
                    this.overlay = true
                },
                onSuccess: () => {
                    this.dialog = false
                    this.overlay = false
                },
                onFinish: () => {
                    this.reset();
                },
            })
        },
        reset()
        {
            this.book = {
                id: null,
                title: null,
                author: null
            }
        }
    }
}
</script>
