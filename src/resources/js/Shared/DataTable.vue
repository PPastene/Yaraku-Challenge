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
                <v-dialog v-model="dialog.state" max-width="500px" @keydown.esc="reset()" @click:outside="reset()">
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
                            <h2>{{formTitle}}</h2>
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
                            <v-overlay :value="dialog.overlay">
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
                                @click="dialog.state = false; reset()"
                            >
                                Cancel
                            </v-btn>
                            <v-btn
                                color="primary"
                                text
                                @click="save()"
                            >
                                Save
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
                <v-dialog v-model="dialogDelete.state" max-width="500px" @keydown.esc="reset()" @click:outside="reset()">
                    <v-card>
                        <v-card-title class="text-h5">Are you sure you want to delete this book?</v-card-title>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="dialogDelete.state = false; reset()">Cancel</v-btn>
                            <v-btn color="blue darken-1" text @click="deleteBookConfirm">OK</v-btn>
                            <v-spacer></v-spacer>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-toolbar>
        </template>
        <template v-slot:item.actions="{ item }">
            <v-icon
                small
                class="mr-2"
                @click="editBook(item)"
            >
                mdi-pencil
            </v-icon>
            <v-icon
                small
                @click="deleteBook(item)"
            >
                mdi-delete
            </v-icon>
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
            dialog: {
                state: false,
                overlay: false
            },
            dialogDelete: {
                state: false,
                overlay: false
            },
            book: {
                id: null,
                title: null,
                author: null
            },
            headers: [
                { text: 'Title', value: 'title' },
                { text: 'Author', value: 'author' },
                { text: 'Actions', value: 'actions' },
            ]
        }
    },
    computed:{
        formTitle()
        {
            return this.book.id === null ? 'Add New Book' : 'Edit Book'
        }
    },
    methods: {
        editBook(item)
        {
            this.book = {
                id: item.id,
                title: item.title,
                author: item.author
            }
            this.dialog.state = true
        },
        deleteBook(item)
        {
            this.book = {
                id: item.id,
                title: item.title,
                author: item.author
            }
            this.dialogDelete.state = true
        },
        save()
        {
            var config = {
                onBefore: () => {
                    this.dialog.overlay = true
                },
                onSuccess: () => {
                    this.dialog.state = false
                    this.dialog.overlay = false
                },
                onFinish: () => {
                    this.reset();
                },
            }

            this.book.id ? this.$inertia.put('/book', this.book, config) : this.$inertia.post('/book', this.book, config)
        },
        deleteBookConfirm()
        {
            this.$inertia.delete('/book/'+ this.book.id, {
                onBefore: () => {
                    this.dialogDelete.overlay = true
                },
                onSuccess: () => {
                    this.dialogDelete.state = false
                    this.dialogDelete.overlay = false
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
