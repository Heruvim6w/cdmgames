@include('layouts.header')
@if($user->role === 2)
    <script>
        function load_chat_list() {
            $.ajax({
                type: "GET",
                url:  "{{ route('dialogs.chat_list') }}",

                success: function(html) {
                    encodeURIComponent($("#chat_list").empty());
                    encodeURIComponent($("#chat_list").append(html));
                }
            });
        }
    </script>

    <style>
        .breadcumb-wrapper {
            display: none;
        }

        #iframeMessages {
            min-height: 500px;
        }

        .users {
            min-height: 500px;
            overflow: auto;
            background-color: #2a2a2a;
        }

        .chat-card {
            border-bottom: 1px solid var(--body-color);
        }

        .header-top {
         display: none !important;
        }

        .input_search {
            width: 100%;
            margin-bottom: .3rem;
        }

        #chat_list {
            height: 80vh;
            overflow-y: scroll;
        }

        /*------------------- 1.5. Typography -------------------*/
        #chat_list::-webkit-scrollbar-track {
            box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
            background-color: #2A2A2A;
        }

        #chat_list::-webkit-scrollbar {
            width: 7px;
            background-color: #F5F5F5;
        }

        #chat_list::-webkit-scrollbar-thumb {
            background-color: var(--theme-color);
            background-image: -webkit-linear-gradient(45deg, rgba(255, 255, 255, 0.2) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.2) 75%, transparent 75%, transparent);
        }
    </style>

    <section id="close" class="bg-title d-none d-md-none">
        <div class="container d-flex justify-content-end">
            <button class="close" onclick="closeChat()">
                <i class="fal fa-times"></i>
            </button>
        </div>
    </section>
    <script>
        function closeChat() {
            $('#iframeMessages').addClass('d-none');
            $('#close').addClass('d-none');
            $('.footer-newsletter').removeClass('margin_top_18');
        }
    </script>
    <section class="vs-team-wrapper bg-title space pt-0">
        <div class="container-fluid p-0">
            <div class="row z-index-common chat_list">
                <div class="col-sm-12 col-md-3 users p-3">
                    <div>
                        <h4 class="text-white text-center">Выбери чат</h4>
                        <div class="col text-end">
                            @livewire('usearch')
                        </div>
                        <div id="chat_list"></div>
                        <script>
                            load_chat_list();
                            setInterval(load_chat_list, 5000);
                        </script>
                    </div>
                </div>

                <iframe src="" frameborder="0" id="iframeMessages" name="messages" class="d-none d-md-block col-sm-12 col-md-9">
                </iframe>
            </div>
        </div>
    </section>
@endif

@include('layouts.footer')
@livewireScripts
</body>

</html>
