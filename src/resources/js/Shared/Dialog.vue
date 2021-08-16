<template>
    <v-dialog v-model="dialog" width="500" @keydown.esc="reset()" @click:outside="reset()">
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                color="primary"
                dark
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
                    @click="submit()"
                >
                    Add Book
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
export default {
    data() {
        return {
            dialog: false,
            overlay: false,
            book: {
                id: null,
                title: null,
                author: null
            }
        }
    },
    methods: {
        submit()
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
