<template>
    <div ref="chat">
        <div v-if="messages.length < 1" class="text-center EmptyDialogStub__description">
            <p>Здравствуйте, дорогой пользователь!</p>
            <p>Рабочие часы чата: с 08:00 по 00:00 по МСК.</p>
            <p>Пожалуйста, кратко опишите аккаунт, который хотели бы продать.</p>
            <p>Просим запастись терпением - администрация ответит Вам в ближайшее время</p>
        </div>
        <div class="chat_bottom" :class="{ 'admin_width' : from.role === 2 }">
            <div ref="files" id="files">
                <div class="d-block">
                    <div v-for="message in messages" class="msg msg-sent"
                         :class="{ 'left interlocutor' : message.user_id != from.id }">
                        <div class="bubble">
                            <div class="bubble-wrapper">
                                <div class="text-theme2 chat_underline">
                                    <span>{{ user.id === message.user_id ? user.name : from.name }}</span>
                                </div>
                                <div class="chat_underline">
                                    <div v-if="message.file">
                                        <div class="">
                                            <div
                                                v-for="(file, index) in message.file"
                                                :key="index"
                                                class="pic chat_img d-inline-block"
                                                @click="() => showImg(index, message.file)"
                                            >
                                                <img v-if="file.split('.').pop() != 'pdf'" :src="'/storage/'+file"
                                                     class="img_btn btn_thumb"/>
                                                <a v-if="file.split('.').pop() == 'pdf'" :href="'/storage/'+file"
                                                   class="pdf_link btn_thumb" target="_blank">PDF</a>
                                            </div>
                                        </div>
                                    </div>
                                    <span v-html="message.text"
                                          style="word-break:break-all; white-space: pre-line;"></span>
                                </div>
                                <p class="text-end">
                                    <a v-if="message.file" :href="'/dialogs/get_zip/' + message.id" class="get_zip"
                                       title="Скачать одним архивом">
                                        <i class="far fa-solid fa-file-zipper"></i>
                                    </a>
                                    <small> {{ moment(message.created_at).format("DD-MM-YYYY, HH:mm") }} </small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <vue-easy-lightbox
                        moveDisabled
                        loop
                        :visible="visible"
                        :imgs="allFiles"
                        :index="index"
                        @hide="handleHide"
                    ></vue-easy-lightbox>
                    <div class="sending_message msg msg-sent"
                         v-if="status.text || status.selectedLink || (status.files && status.files.length)">
                        <div class="bubble">
                            <div class="bubble-wrapper">
                                <div class="text-theme2 chat_underline">
                                    <span>{{ from.name }}</span>
                                </div>
                                <div class="chat_underline">
                                    <div v-if="this.status.files && this.status.files.length">
                                        <img :src="'/assets/img/icon/preloader.gif'" alt="loader">
                                    </div>
                                    <span v-html="this.status.text"
                                          style="word-break:break-all; white-space: pre-line;"></span>
                                </div>
                                <p class="text-end">
                                    <small>Отправка...</small>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div id="add_file">
                        <i class="far fa-solid fa-paperclip add_file"></i>
                        <span class="d-lg-inline-block add_file"> jpg, jpeg, png</span>
                    </div>
                </div>
            </div>
            <div class="conversation-footer container" style="position:relative; bottom:0;">
                <div class="row g-0 w-100 pl-md-4 overflow-visible">
                    <textarea v-model="form.text"
                              required=""
                              id="mess"
                              name="message"
                              minlength="2"
                              maxlength="500"
                              class="chat-input pl-md-5"
                              @input="resize($event)"
                              @keydown.enter.prevent.exact="sendMessage"
                              @keyup.ctrl.enter.prevent="newLine"
                              @keyup.shift.enter.prevent="newLine"
                              :class="{ 'col-5' : to !== 1, 'col-6' : to === 1 }"
                              style="min-height: 70px;
                                resize: none;
                                background-color: #262228;
                                border-radius: 7px;"
                              placeholder="&#10;Введите ваше сообщение">
                    </textarea>

                    <discord-picker
                        gif-format="md"
                        @update:value="form.text = $event"
                        @emoji="setEmoji"
                        @gif="setGif"
                        class="col-1"
                    />

                    <input type="hidden" v-model="this.to">

                    <div v-if="to !== 1" class="d-none d-sm-block col-2 links">
                        <div class="text-muted">Шаблон:</div>
                        <select v-model="selectedLink" @change="onSelectLink" id="layouts_links">
                            <option disabled value="">Выберите один из вариантов</option>
                            <option v-for="link in games_links"
                                    v-bind:value="link.content"
                                    data-bs-toggle="modal"
                                    data-bs-target="#layout">
                                {{ link.title }}
                            </option>
                        </select>
                    </div>

                    <ul class="list-inline d-flex align-items-center m-b-0 pl-md-1 send_btn"
                        :class="{ 'col-3' : to !== 1, 'col-2 col-md-3' : to === 1 }">
                        <li class="list-inline-item" style="position: relative; left: 30%;"
                            :class="{ 'admin_send_button' : from.role === 2 }">
                            <button @click="sendMessage" name="sendmessage" type="submit"
                                    class="d-md-block look vs-btn">
                            <span class="m-r-xl-10">
                                <span class="d-none d-xl-inline">Отправить </span>
                                <i class="far fa-paper-plane"></i>
                            </span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="modal fade text-dark" id="layout" tabindex="-1" role="dialog"
                 aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <textarea v-model="selectedLink" name="layout" id="change_layout" style="width: 100%">
                            </textarea>
                            <div class="row gx-5">
                                <button @click="setTextArea(selectedLink)" data-bs-dismiss="modal"
                                        class="col m-3 d-inline-block look vs-btn">Сохранить
                                </button>
                                <button type="button" class="col m-3 d-inline-block look vs-btn" data-bs-dismiss="modal"
                                        aria-label="Закрыть">
                                    Отмена
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import useChat from "../composables/chat";
import {onMounted, reactive} from "vue";
import moment from 'moment';
import Dropzone from "dropzone";
import DiscordPicker from 'vue3-discordpicker';

export default {
    name: "ChatMessages",
    components: {DiscordPicker},
    props: {
        from: {
            required: true,
            type: Object
        },
        to: {
            required: true
        },
        user: {
            required: true,
            type: Object
        },
        games_links: '',
        dialog_id: {
            required: true,
            type: Number
        }
    },
    data() {
        return {
            dropzone: null,
            selectedLink: '',
            status: [],
            visible: false,
            index: 0, // default: 0
            allFiles: []
        }
    },
    renderTracked() {
        this.$nextTick(() => this.scrollToEnd());
    },
    mounted() {
        this.dropzone = new Dropzone(this.$refs.files, {
            url: 'werewr',
            autoProcessQueue: false,
            clickable: '.add_file',
            acceptedFiles: 'image/png,.jpg,.jpeg,.pdf',
            createImageThumbnails: true,
            addRemoveLinks: true,
            maxFiles: 10,
            dictInvalidFileType: 'Этот тип файла не поддерживается',
            dictRemoveFile: '+',
            dictMaxFilesExceeded: 'Загрузить можно не более 10 файлов'
        })

        addEventListener('paste', (event) => {
            if (event.clipboardData) {
                // получаем все содержимое буфера
                let items = event.clipboardData.items;
                if (items) {
                    for (const element of items) {
                        if (element.type.indexOf("image") !== -1) {
                            // представляем изображение в виде файла
                            let blob = element.getAsFile();
                            // создаем временный урл объекта
                            let URLObj = window.URL || window.webkitURL;
                            let source = URLObj.createObjectURL(blob);
                            this.dropzone.addFile(blob);
                        }
                    }
                }
            }
        })

        moment.tz.setDefault("Europe/Moscow");
    },
    methods: {
        setEmoji(emoji) {
            this.form.text = this.form.text + emoji;
        },

        setGif(gif) {
            this.form.text = this.form.text + gif;
        },

        scrollToEnd: function () {
            let el = document.getElementById("messages");
            el.scrollTop = el.scrollHeight;
        },

        setTextArea() {
            this.form.text = this.selectedLink
        },

        async sendMessage() {
            this.$emit("keyupCtrlEnter");
            const {errors, addMessage} = useChat()
            this.formData.append('to', this.form.to)
            this.formData.append('from', this.form.from)
            this.formData.append('text', this.form.text)
            this.formData.append('selectedLink', this.selectedLink)
            let files = this.dropzone.getAcceptedFiles()
            files.forEach(file => {
                this.formData.append('images[]', file)
                this.dropzone.removeFile(file)
            })
            this.status.text = this.form.text;
            this.status.selectedLink = this.selectedLink;
            this.status.files = files;
            this.form.text = ''
            this.form.games_links = ''
            this.selectedLink = ''
            document.getElementById('mess').style.height = 'auto'

            await addMessage(this.formData)
            this.status = [];

            this.formData.delete('text')
            this.formData.delete('games_links')
            this.formData.delete('images[]')
        },

        resize(e) {
            e.target.style.height = 'auto'
            e.target.style.height = e.target.scrollHeight + 'px'
        },

        newLine(e) {
            let caret = e.target.selectionStart;
            e.target.setRangeText("\n", caret, caret, "end");
            this.text = e.target.value;
        },

        onSelectLink: function () {
            if (this.selectedLink !== '') {
                $('#layout').modal('show');
            }
        },

        showImg(index, files) {
            files.forEach((file, index) => {
                if (file.split('.').pop() != 'pdf') {
                    this.allFiles.push('/storage/' + file)
                }
            })
            this.index = index
            this.visible = true
        },

        handleHide() {
            this.allFiles = []
            this.visible = false
        }
    },
    setup(props) {
        const {messages, getMessages} = useChat()

        onMounted(getMessages(props.to))

        Echo.private(`chat`)
            .listen('Messages.Sent', (e) => {
                let tempMessage = document.getElementsByClassName('sending_message')[0]
                if (tempMessage) {
                    tempMessage.style.display = 'none'
                }
                if (
                    (e.message.user_id === props.from.id || e.message.to_user === props.from.id)
                    && e.message.dialog_id === props.dialog_id
                ) {
                    messages.value.push({
                        id: e.message.id,
                        text: e.message.text,
                        file: JSON.parse(e.message.file),
                        created_at: e.message.created_at,
                        user_id: e.message.user_id,
                        from: e.from
                    });
                }
            });

        const form = reactive({
            to: props.to,
            from: props.from.id,
            text: '',
        })
        const formData = new FormData();

        return {
            form,
            formData,
            messages,
            moment: moment,
        }
    }
}

</script>
<style scoped>
    .admin_width {
        width: 96.6%;
    }

    .admin_send_button {
        left: 25% !important;
    }

    .img_btn .thumb {
        margin: 0;
    }

    .msg.msg-sent.interlocutor .get_zip {
        color: #ededed;
    }

    .get_zip {
        display: inline-block;
        font-size: 150%;
        padding: 0.6rem 3px;
        width: fit-content;
        color: #72849a;
        margin-right: 1rem;
    }

    .get_zip:hover {
        color: var(--theme-color2);
    }

    .img_btn .btn_thumb {
        margin: 0;
    }

    .vue3-emojipicker {
        background-image: url('/assets/img/icon/face-smile-regular.svg');
        background-size: 30px;
        background-position: center;
        background-repeat: no-repeat;
    }

    .vue3-emojipicker header {
        display: none;
    }

    .vue3-discord-emojipicker__tabs {
        display: none !important;
    }

    .vel-fade-enter-from, .vel-fade-leave-to {
        opacity: 1;
    }
</style>
