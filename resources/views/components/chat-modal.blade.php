@props(['chat', 'user'])



<div class="chatmodal modal !p-0 max-h-[90%] overflow-auto" >
    <div class="flex items-center justify-between h-[60px] bg-[#f4f6f6] sticky top-0 rounded-t-[20px] px-[20px] z-[4]">
        <p class="text-[20px] font-bold">Chat info</p>
        <div class="chatmodalclose h-10 w-10 flex justify-center items-center cursor-pointer">
            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="0.0810547" y="14.701" width="20.676" height="1.83787" transform="rotate(-45 0.0810547 14.701)" fill="#999999"/>
                <rect x="1.2998" width="20.676" height="1.83787" transform="rotate(45 1.2998 0)" fill="#999999"/>
            </svg>
        </div>
    </div>
    <form class="sticky top-[60px] z-50" action="{{route('chats.update', $chat)}}" method="POST" enctype="multipart/form-data">
        <div class="bg-[#F4F6F6] p-5 ">
            <div class="flex gap-[20px]">
                <div class="">
                    <div class="relative w-[80px] h-[80px]">
                        <div class="absolute top-0 left-0 w-full h-full rounded-full z-[100] overflow-hidden">
                            <img  id="uploadedImageChat" class="w-full h-full" />
                        </div>
                        <x-chat-image :chat="$chat" :size="80"/>
                        <label for="avatarchat" class="absolute w-[80px] h-[80px] top-0 left-0 rounded-full z-[101]">
                            <div class="absolute w-[80px] h-[80px] top-0 left-0 rounded-full bg-[rgba(0,0,0,0.4)] overflow-hidden flex items-end opacity-0 hover:opacity-100 transition-[0.4s] cursor-pointer">
                                <div class="bg-black h-[26px] w-full bottom-0 flex items-center justify-center">
                                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.77041 5.8H10.23M4.70412 17H13.2963C15.5591 17 16.4609 15.648 16.5675 14L16.9939 7.392C17.0204 6.98227 16.9606 6.57157 16.8181 6.18529C16.6755 5.79901 16.4533 5.44536 16.1652 5.1462C15.877 4.84704 15.5291 4.60872 15.1428 4.44597C14.7565 4.28322 14.3401 4.19951 13.9194 4.2C13.4193 4.2 12.9601 3.92 12.7306 3.488L12.1403 2.328C11.7631 1.6 10.7793 1 9.94304 1H8.06556C7.2211 1 6.23726 1.6 5.86013 2.328L5.26983 3.488C5.04026 3.92 4.58114 4.2 4.08103 4.2C2.30192 4.2 0.891762 5.664 1.00654 7.392L1.43287 14C1.53125 15.648 2.4413 17 4.70412 17ZM9.0002 13.8C10.4678 13.8 11.6648 12.632 11.6648 11.2C11.6648 9.768 10.4678 8.6 9.0002 8.6C7.53265 8.6 6.33565 9.768 6.33565 11.2C6.33565 12.632 7.53265 13.8 9.0002 13.8Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </div>
                            </div>
                        </label>
                        <input type="file" id="avatarchat" name="avatarchat" placeholder="Image" class="hidden">
                    </div>
                </div>
                @method('PUT')
                @csrf
                <div class="h-[80] items-center flex">
                    <input type="text" name="name" placeholder="Name" maxlength="80" class="bg-transparent w-full h-[40px] rounded-l-[8px] min-w-0 text-[18px] pl-[16px] border-[1px] border-[#dddddd]" value="{{$chat->name}}" required>
                    <button type="submit" class="saveuserinfo border-[#0066ff] border-[1px] text-[#0066ff] rounded-r-[8px] w-[50%] w-full h-[40px]">Save</button>
                </div>
            </div>
        </div>
    </form>
   <div>
       <div class="h-[50px] flex items-center justify-between px-5 shadow-sm sticky top-[180px] bg-white">
           <form class="absolute flex hidden addusersform w-full right-0 pl-[100px] mr-[80px] " action="{{route('chats.update', $chat)}}" method="POST" enctype="multipart/form-data">
               @method('PUT')
               @csrf
               <input type="text" name="users" placeholder="usernames" maxlength="300" class="w-full h-[40px] min-w-0 text-[18px] rounded-l-[8px] bg-white pl-[16px] border-[1px] border-[#dddddd]" value="" required>
               <input type="hidden" name="name" value="{{$chat->name}}">
               <button type="submit" class="saveuserinfo border-[#0066ff] border-[1px] text-[#0066ff] rounded-r-[8px] bg-white w-[50%] w-full h-[40px]">Add</button>
           </form>
           <span class="font-bold nummem">{{$chat->users->count()}} Members</span>
           <div class="flex items-center gap-[16px]">
               <form action="{{url('chat/leave/'.$chat->id)}}" method="POST">
                     @csrf
                   @method('POST')
                   <button class="w-[40px] h-[40px] flex items-center justify-center cursor-pointer">
                       <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path d="M11.68 14.62L14.24 12.06L11.68 9.5M4 12.06H14.17" stroke="#F14646" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                           <path d="M12 4C16.42 4 20 7 20 12C20 17 16.42 20 12 20" stroke="#F14646" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                       </svg>
                   </button>


               </form>
               <div class="w-[40px] h-[40px] flex items-center justify-center cursor-pointer addusers">
                   <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                       <path d="M3.40991 22C3.40991 18.13 7.25991 15 11.9999 15C12.9599 15 13.8899 15.13 14.7599 15.37M11.9999 12C13.326 12 14.5978 11.4732 15.5354 10.5355C16.4731 9.59785 16.9999 8.32608 16.9999 7C16.9999 5.67392 16.4731 4.40215 15.5354 3.46447C14.5978 2.52678 13.326 2 11.9999 2C10.6738 2 9.40206 2.52678 8.46438 3.46447C7.5267 4.40215 6.99991 5.67392 6.99991 7C6.99991 8.32608 7.5267 9.59785 8.46438 10.5355C9.40206 11.4732 10.6738 12 11.9999 12V12Z" stroke="#888888" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                       <path d="M19.49 17.98H16.51M18 16.52V19.51M22 18C22 18.32 21.96 18.63 21.88 18.93C21.79 19.33 21.63 19.72 21.42 20.06C21.0675 20.6525 20.5667 21.143 19.967 21.4831C19.3674 21.8233 18.6894 22.0014 18 22C17.0155 22.0029 16.0659 21.6352 15.34 20.97C15.04 20.71 14.78 20.4 14.58 20.06C14.1993 19.4404 13.9985 18.7272 14 18C13.9994 17.4745 14.1024 16.9541 14.3031 16.4685C14.5039 15.9829 14.7985 15.5417 15.1701 15.1701C15.5417 14.7985 15.9829 14.5039 16.4685 14.3031C16.9541 14.1024 17.4745 13.9993 18 14C19.18 14 20.25 14.51 20.97 15.33C21.61 16.04 22 16.98 22 18Z" stroke="#888888" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/>
                   </svg>
               </div>
           </div>

       </div>
       <div class="chatusers">
           @foreach($chat->users as $user)
               <div class="flex items-center gap-[16px] px-5 py-3">
                   <x-user-image :user="$user" :size="40"/>
                   <div>
                       <p class="font-bold text-[16px] text-[#{{substr(hash('ripemd160', $user->email),0,6)}}]">{{$user->name}}</p>
                       <p class="text-[13px] text-[#888888]">{{'@'}}{{$user->username}}</p>
                   </div>
               </div>
           @endforeach
       </div>

   </div>

</div>



<div class="chatmodaloverlay modaloverlay"></div>

<script>
    const chat = document.querySelector('.chat');
    const chatmodal = document.querySelector('.chatmodal');
    const chatmodalclose = document.querySelector('.chatmodalclose');
    const chatmodaloverlay = document.querySelector('.chatmodaloverlay');

    chat.addEventListener('click', () => {
        chatmodal.classList.add('active');
        chatmodaloverlay.classList.add('active');
    });

    chatmodalclose.addEventListener('click', () => {
        chatmodal.classList.remove('active');
        chatmodaloverlay.classList.remove('active');

    });
    chatmodaloverlay.addEventListener('click', () => {
        chatmodal.classList.remove('active');
        chatmodaloverlay.classList.remove('active');
    });


    const addusers = document.querySelector('.addusers');
    const addusersform = document.querySelector('.addusersform');
    const nummem = document.querySelector('.nummem');
    addusers.addEventListener('click', () => {
        addusersform.classList.toggle('hidden');
        nummem.classList.toggle('z-[-3]');
    });

</script>

<script type="text/javascript">

    function PreviewImageChat() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("avatarchat").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadedImageChat").src = oFREvent.target.result;
        };
    };

    document.getElementById("avatarchat").addEventListener('change', PreviewImageChat);
</script>

