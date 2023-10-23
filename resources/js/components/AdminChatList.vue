<template>
    <div v-for="dialog in dialogs" v-if="dialog.messages" class="col-12 chat-card pt-1 pb-1"
         :class="{'unread' : !dialog.read_by_admin}">
        <a v-for="user in dialog.user" v-if="user.role !== 2" href="#" target="messages"
           class="d-flex justify-content-between">
            <div class="d-flex flex-row">
                <div class="chat_avatar rounded-circle overflow-hidden me-3 col-4 col-md-2">
                    <img :src="user.avatar ? 'storage/avatars/'+user.avatar : 'assets/img/logo.png'"
                         alt="{{ user.name }}"
                         class="d-flex align-self-center shadow-1-strong"
                         style="height: inherit">
                </div>
                <div class="pt-1 d-sm-none d-md-block col-10">
                    <p class="fw-bold mb-0">{{ user.name }}</p>
                    <p class="small text-muted">{{ dialog.messages[0].text }}</p>
                </div>
            </div>
            <div class="pt-1 d-sm-none d-lg-block">
                <p class="small text-muted mb-1">{{ dialog.messages[0].created_at }}</p>
            </div>
        </a>
    </div>
</template>

<script>
export default {
    name: "AdminChatList"
}
</script>

<style scoped>

</style>
