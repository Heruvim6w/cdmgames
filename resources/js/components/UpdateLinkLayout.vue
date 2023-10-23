<template>
    <div class="modal fade text-dark" id="new_layout" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <label for="layout_title">
                        Загаловок:
                        <input type="text" v-model="title" name="layout_title" id="new_layout_title" style="width: 100%">
                    </label>
                    <label for="change_layout">
                        Текст:
                        <textarea v-model="content" name="layout" id="new_layout_content" style="width: 100%">
                        </textarea>
                    </label>
                    <div class="row gx-5">
                        <button @click="createLayout(layout)" data-bs-dismiss="modal" class="col m-3 d-inline-block look vs-btn">Сохранить</button>
                        <button @click="cancelCreateLayout(layout)" type="button" class="col m-3 d-inline-block look vs-btn" data-bs-dismiss="modal" aria-label="Закрыть">
                            Отмена
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div v-for="layout in layouts" class="modal fade text-dark" :id="'layout_'+layout.id" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <label for="layout_title">
                        Загаловок:
                        <input type="text" v-model="layout.title" @click="setOldLayout(layout)" name="layout_title" id="layout_title" style="width: 100%">
                    </label>
                    <label for="change_layout">
                        Текст:
                        <textarea v-model="layout.content" @click="setOldLayout(layout)" name="layout" id="change_layout" style="width: 100%">
                        </textarea>
                    </label>
                    <div class="row gx-5">
                        <button @click="updateLayout(layout)" data-bs-dismiss="modal" class="col m-3 d-inline-block look vs-btn">Сохранить</button>
                        <button @click="cancelUpdateLayout(layout)" type="button" class="col m-3 d-inline-block look vs-btn" data-bs-dismiss="modal" aria-label="Закрыть">
                            Отмена
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {ref} from "vue";
import axios from "axios";

export default {
name: "UpdateLinkLayout",
    props: {
        layouts: Object
    },
    setup() {
        const errors = ref([]);

        return {
            errors
        }
    },
    data() {
        return {
            oldLayoutContent: '',
            oldLayoutTitle: '',
            title: '',
            content: ''
        }
    },
    methods: {
        setOldLayout(layout) {
            this.oldLayoutContent = layout.content
            this.oldLayoutTitle = layout.title
        },

        cancelUpdateLayout(layout) {
            layout.content = this.oldLayoutContent
            layout.title = this.oldLayoutTitle
        },

        cancelCreateLayout(layout) {
            this.content = ''
            this.title = ''
        },

        async updateLayout(layout) {
            this.errors.value = [];

            try {
                await axios.post('/layouts',
                    layout
                    ).then((response) => {
                    location.reload();
                })
            } catch (e) {
                this.errors.value = e.response.data.errors
            }
        },

        async createLayout(layout) {
            this.errors.value = [];

            try {
                await axios.post('/new_layout',
                    {title: this.title, content: this.content}
                    ).then((response) => {
                    location.reload();
                })
            } catch (e) {
                this.errors.value = e.response.data.errors
            }
        }
    }
}
</script>

<style scoped>

</style>
