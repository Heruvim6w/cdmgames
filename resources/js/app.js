require('./bootstrap');

import { createApp } from 'vue'
import ChatMessages from './components/ChatMessages.vue';
import AdminChatList from "./components/AdminChatList";
import UpdateLinkLayout from "./components/UpdateLinkLayout.vue";
import VueEasyLightbox from 'vue-easy-lightbox';
import DiscordPicker from 'vue3-discordpicker';

const app = createApp({
    components: {
        ChatMessages,
        AdminChatList,
        UpdateLinkLayout,
        VueEasyLightbox,
        DiscordPicker
    }
});

app.use(VueEasyLightbox, DiscordPicker);
// mount the app to the DOM
app.mount('#app');
