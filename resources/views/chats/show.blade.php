<x-chats-layout>

    <x-chat-sidebar :user="$user" :activechat="$chat->id"/>


    <div class="pl-[400px] pb-[60px] relative w-full showview">
        <div class="break-words w-full">
            <div class="break-words">
                <div
                    class="sticky top-0 w-full border-b-[1px] border-b-[#dddddd] h-[60px] bg-white flex items-center px-[16px] justify-between gap-[16px]">
                    <div class="flex items-center gap-[16px]">
                        <a href="{{route('chats.index')}}" class="back hidden">
                            <div class="flex items-center justify-center w-[40px] h-[40px] back hidden">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M20 11H7.83L13.42 5.41L12 4L4 12L12 20L13.41 18.59L7.83 13H20V11Z"
                                          fill="#999999"/>
                                </svg>
                            </div>
                        </a>
                        <x-chat-image :chat="$chat" :size="40"/>
                        <div class="">
                            <p class="font-bold text-[#{{substr(hash('ripemd160', $chat->id),0,6)}}]">{{$chat->name}}</p>
                            <p class="text-[13px] text-[#999999]">{{$chat->users->count()}} participants</p>
                        </div>
                    </div>
                    <div class="flex items-center justify-center w-[40px] h-[40px] chat cursor-pointer">
                        <svg width="5" height="23" viewBox="0 0 5 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="2.5" cy="2.5" r="2.5" fill="#999"/>
                            <circle cx="2.5" cy="11.25" r="2.5" fill="#999"/>
                            <circle cx="2.5" cy="20" r="2.5" fill="#999"/>
                        </svg>
                    </div>
                </div>
                <div id="livemessages">
                    <livewire:messages :chat="$chat"/>
                </div>

                <div class="sentmessages"></div>
                <form method="post" action="{{url('/message/save')}} " id="sendmessage" enctype="multipart/form-data">
                    @csrf
                    @method('post')
                    <div
                        class="fixed bottom-0 w-[100%] border-t-[1px] border-t-[#dddddd] h-[60px] bg-white bottom-message-form z-[51] flex gap-[16px] px-[16px] items-center justify-between">
                        <label
                            class="w-[40px] h-[40px] min-w-[40px] flex items-center justify-center cursor-pointer sendimage"
                            for="attachment">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20.6799 15.96L17.5499 8.65C16.4899 6.17 14.5399 6.07 13.2299 8.43L11.3399 11.84C10.3799 13.57 8.58993 13.72 7.34993 12.17L7.12993 11.89C5.83993 10.27 4.01993 10.47 3.08993 12.32L1.36993 15.77C0.159926 18.17 1.90993 21 4.58993 21H17.3499C19.9499 21 21.6999 18.35 20.6799 15.96ZM5.96993 7C6.76558 7 7.52864 6.68393 8.09125 6.12132C8.65386 5.55871 8.96993 4.79565 8.96993 4C8.96993 3.20435 8.65386 2.44129 8.09125 1.87868C7.52864 1.31607 6.76558 1 5.96993 1C5.17428 1 4.41121 1.31607 3.84861 1.87868C3.286 2.44129 2.96993 3.20435 2.96993 4C2.96993 4.79565 3.286 5.55871 3.84861 6.12132C4.41121 6.68393 5.17428 7 5.96993 7V7Z"
                                    stroke="#666666" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </label>
                        <input type="file" name="attachment" id="attachment" class="hidden sendimage" accept="image/*">
                        <input autocomplete="off" type="text" name="body" class="w-full h-[60px] !outline-0 "
                               placeholder="Send Message..." autofocus required maxlength="1024">
                        <input type="hidden" name="chat_id" value="{{$chat->id}}">
                        <button
                            class=" rounded-full bg-[#0066ff] w-[40px] min-w-[40px] h-[40px] text-white flex items-center justify-center"
                            type="submit">
                            <svg width="11" height="18" viewBox="0 0 11 18" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 17L9 9L1 1" stroke="white" stroke-width="2"/>
                            </svg>
                        </button>
                    </div>
                    <div class="modal sendimagemodal">
                        <div class="flex items-center justify-between h-[60px]">
                            <p class="text-[20px] font-bold">Send image</p>
                            <div class="sendimageclose h-10 w-10 flex justify-center items-center cursor-pointer">
                                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="0.0810547" y="14.701" width="20.676" height="1.83787" transform="rotate(-45 0.0810547 14.701)" fill="#999999"/>
                                    <rect x="1.2998" width="20.676" height="1.83787" transform="rotate(45 1.2998 0)" fill="#999999"/>
                                </svg>
                            </div>
                        </div>
                        <img src="#" class="sendimagepreview">
                        <input type="text" name="caption" class="w-full h-[40px] outline-0 border-b-[#dddddd] border-b-2"
                               placeholder="Add a caption..." autocomplete="off" maxlength="1024">
                        <div class="flex justify-end mt-3">
                            <button
                                class=" rounded-[8px] bg-[white] px-6 h-[40px] text-[#0066ff] border-[1px] border-[#0066ff] sendimagebtn"
                                type="submit">
                                Send image
                            </button>
                        </div>

                    </div>
                    <div class="sendimagemodaloverlay modaloverlay">

                    </div>
                </form>
            </div>

            </div>
        </div>
        <x-chat-modal :chat="$chat" :user="$user"/>


</x-chats-layout>

<script>
    $(document).on('change', '.sendimage', function () {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.sendimagepreview').attr('src', e.target.result);
            $('.sendimagemodal').addClass('active');
            $('.sendimagemodaloverlay').addClass('active');
            $('input[name="caption"]').val($('input[name="body"]').val());
            $('input[name="body"]').removeAttr('required');
        }
        reader.readAsDataURL(file);
    });

    $(document).on('click', '.sendimageclose', function () {
        $('.sendimage').val('');
        $('.sendimagemodal').removeClass('active');
        $('.sendimagemodaloverlay').removeClass('active');
        $('input[name="body"]').attr('required', 'required');
    });

    $(document).on('click', '.sendimagemodaloverlay', function () {
        $('.sendimage').val('');
        $('.sendimagemodal').removeClass('active');
        $('.sendimagemodaloverlay').removeClass('active');
        $('input[name="body"]').attr('required', 'required');
    });

    $(document).on('paste', 'input[name="body"]', function (e) {
        var items = (e.clipboardData || e.originalEvent.clipboardData).items;
        for (index in items) {
            var item = items[index];
            if (item.kind === 'file') {
                var blob = item.getAsFile();
                var reader = new FileReader();
                reader.onload = function (event) {
                    var file = new File([blob], 'image.png', {type: 'image/png', lastModified: Date.now()});
                    var data = new DataTransfer();
                    data.items.add(file);
                    $('.sendimage').prop('files', data.files);
                    $('.sendimage').trigger('change');
                };
                reader.readAsDataURL(blob);
            }
        }
    });


    // stop the page from reloading on submit
$(document).on('submit', '#sendmessage', function (e) {
        e.preventDefault();
        var form = $(this);
        var formData = new FormData(form[0]);
        $('.sendimage').val('');
        $('.sendimagemodal').removeClass('active');
        $('.sendimagemodaloverlay').removeClass('active');
        $('input[name="body"]').attr('required', 'required');
        $('input[name="body"]').val('');
        $('input[name="caption"]').val('');
        $('.sendimagepreview').attr('src', '');
        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            enctype: form.attr('enctype'),
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                // console.log(response);
            },
            error: function (response) {
                // console.log(response);
            }
        });
    });



</script>

<script>
    // scroll to bottom of window on load
    $(window).on('load', function () {
        window.scrollTo(0, document.body.scrollHeight);
    });
</script>


<style>
    @media (max-width: 950px) {
        .sidebar {
            display: none;
        }

        .showview {
            padding-left: 0;
        }

        .bottom-message-form {
            max-width: 100%;
            left: 0;
        }

        .back {
            display: flex;
        }
    }
</style>
