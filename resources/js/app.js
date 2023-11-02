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

//отключает Vue warn в консоли
app.config.warnHandler = (msg, instance, trace) =>
  ![
    'built-in or reserved HTML elements as component id: component',
    '"class" is a reserved attribute and cannot be used as component prop',
    'Cannot find element: #__nuxt'
  ].some((warning) => msg.includes(warning)) &&
  console.warn('[Vue warn]: '.concat(msg).concat(trace))

app.use(VueEasyLightbox, DiscordPicker);
// mount the app to the DOM
app.mount('#app');
