import {ref} from 'vue';
import axios from "axios";

export default function useChat() {
    const messages = ref([])
    const errors = ref([])
    let status = ref()

    const getMessages = async (to) => {
        await axios.get('/dialogs/user/'+to).then((response) => {
            messages.value = response.data
        })
    }

    const addMessage = async (form) => {
        errors.value = [];
        status.value = 'Отправка...'
        try {
            await axios.post('/dialogs/messages',
                form,
                {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                }).then((response) => {
                    status.value = ''
                    messages.value.push(response.data)
                })
        } catch (e) {
            if (e.response.status === 422) {
                errors.value = e.response.data.errors
            }
        }
    }

    return {
        messages,
        errors,
        status,
        getMessages,
        addMessage
    }
}
