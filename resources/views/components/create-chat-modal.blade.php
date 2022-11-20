<div class="createchatmodal">

    <div class="flex items-center justify-between h-[60px]">
        <p class="text-[20px] font-bold">Create chat</p>
        <div class="createchatmodalclose h-10 w-10 flex justify-center items-center cursor-pointer">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.0810547" y="14.701" width="20.676" height="1.83787" transform="rotate(-45 0.0810547 14.701)" fill="#999999"/>
                <rect x="1.2998" width="20.676" height="1.83787" transform="rotate(45 1.2998 0)" fill="#999999"/>
            </svg>
        </div>
    </div>
    <form action="{{route('chats.store')}}" method="POST">
        @method('POST')
        @csrf
        <div class="flex flex-col gap-[16px]">
            <input type="text" name="name" placeholder="Chat name" class="border-[1px] border-[#999999] rounded-[8px] h-[40px]" required>
            <input type="text" name="users" placeholder="Users" class="border-[1px] border-[#999999] rounded-[8px] h-[40px]">
            <div class="suggestions"></div>
            <div class="flex justify-end">
                <button type="submit" class="bg-[#0066ff] text-white rounded-[8px] p-[8px]">Create</button>
            </div>
        </div>
    </form>

</div>

<div class="createchatmodaloverlay"></div>

<script>
    // use ajax to create suggestions for users when text is entered in the input field
</script>
