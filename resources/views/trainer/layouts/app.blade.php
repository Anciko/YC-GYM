<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--iconify-->
    <script src="https://code.iconify.design/iconify-icon/1.0.0/iconify-icon.min.js"></script>

    <!--global css-->
    <link href="{{ asset('css/trainer/globals.css')}}" rel="stylesheet"/>
    <link href="{{asset('css/trainer/trainerTrainingCenter.css')}}" rel="stylesheet" />

    <title>YC-Trainer</title>


  </head>
  <body class="customer-loggedin-bg">
    @include('trainer.layouts.header')
 <!--create gp modal-->
 <div class="modal fade" id="CreateGroupModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header  customer-transaction-modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">Create Group</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clearCreateGroupInputs()"></button>
        </div>
        <div class="modal-body">
         <form class="create-group-form" action="{{route('trainer.group.create')}}" method="POST">
            @method('POST')
            @csrf
            <input type="hidden" name="trainer_id" value="{{auth()->user()->id}}">
            <div class="create-group-name create-group-input">
                <p>Group Name</p>
                <input type="text" name="group_name" required>
            </div>
            <div class="create-group-member-type create-group-input">
                <p>Member Type</p>
                <select name="member_type" class="@error('member_type') is-invalid @enderror">
                    <option value="">Choose Member Type</option>
                    @foreach ($members as $member)
                    <option value="{{$member->member_type}}">{{$member->member_type}}</option>
                    @endforeach
                </select>
            </div>
            <div class="create-group-member-type create-group-input">
                <p>Level</p>
                <select name="member_type_level" class="@error('member_type_level') is-invalid @enderror">
                    <option value="">Choose Level</option>
                    <option value="beginner">Beginner</option>
                    <option value="advanced">Advanced</option>
                    <option value="professional">Professional</option>
                </select>
            </div>
            <div class="create-group-gender create-group-input">
                <p>Gender</p>
                <select name="gender" class="@error('gender') is-invalid @enderror">
                    <option value="">Choose Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="create-group-group-type create-group-input">
                <p>Group Type</p>
                <select name="group_type" class="@error('gender') is-invalid @enderror" id="group_type">
                    <option value="">Choose Group Type</option>
                    <option value="weightLoss">Weight Loss</option>
                    <option value="bodyBeauty">Body Beauty</option>
                </select>
            </div>

            <div class="create-group-form-btns-contaier">
                <button type="submit" class="customer-primary-btn">Confirm</button>
                <button type="reset" class="customer-secondary-btn" data-bs-dismiss="modal" aria-label="Close" onclick="clearCreateGroupInputs()">Cancel</button>
            </div>
         </form>

        </div>

      </div>
    </div>
</div>
    <div class="customer-main-content-container">
        <div class="trainer-main-content-container">
            <button data-bs-toggle="modal" data-bs-target="#CreateGroupModal" class="trainer-create-gp-modal-btn customer-primary-btn">
                <iconify-icon icon="akar-icons:circle-plus" class="trainer-create-gp--modal-btn-icon"></iconify-icon>
                <p>Group</p>
            </button>
            @yield('content')

        </div>
    </div>


    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.1.3/axios.min.js" integrity="sha512-0qU9M9jfqPw6FKkPafM3gy2CBAvUWnYVOfNPDYKVuRTel1PrciTj+a9P3loJB+j0QmN2Y0JYQmkBBS8W+mbezg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
    @stack('scripts')


    {{-- Sweet Alert --}}
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@joeattardi/emoji-button@3.0.3/dist/index.min.js"></script>
    <!--theme-->
    <script src="{{asset('js/theme.js')}}"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/emoji-picker/1.1.5/js/emoji-picker.min.js" integrity="sha512-EDnYyP0SRH/j5K7bYQlIQCwjm8dQtwtsE+Xt0Oyo9g2qEPDlwE+1fbvKqXuCoMfRR/9zsjSBOFDO6Urjefo28w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <!-- <script src="../js/emoji.js"></script> -->
    <script>

        function clearCreateGroupInputs(){
            const inputs = document.querySelectorAll(".create-group-form input"+",.create-group-form select")
            // console.log(inputs)
            for(var i = 0;i < inputs.length;i++){
                // console.log("hi")
                // console.log(inputs[i])
                inputs[i].value = ""
            }
        }

        const groupChatImgInput = document.querySelector('#groupChatImg');
        const groupChatImgPreview = document.querySelector('.groupChatImg');
        const cancelBtn = document.querySelector(".group-chat-img-cancel")
        const messageInput = document.querySelector(".group-chat-send-form-input")

        const button = document.querySelector('#emoji-button');

        const picker = new EmojiButton();

        button.addEventListener('click', () => {
        picker.togglePicker(button);

        });

        picker.on('emoji', emoji => {
            messageInput.value += emoji;
        });


        if(!groupChatImgPreview.hasAttribute("src")){
            groupChatImgPreview.remove()
            // $('.video-prev').remove();
            cancelBtn.remove()
        }


        groupChatImgInput.addEventListener('change', (e) =>{
        // console.log(e.target.value)
        // groupChatImgInput.value = ""
        var  fileExtension;

        fileExtension = e.target.value.replace(/^.*\./, '');
        console.log(fileExtension)
        if(fileExtension === "jpg" || fileExtension === "jpeg" || fileExtension === "png" || fileExtension === "jfif"){
            const reader = new FileReader();
            reader.onloadend = e => groupChatImgPreview.setAttribute('src', e.target.result);
            reader.readAsDataURL(groupChatImgInput.files[0]);
            groupChatImgInput.value = ""
            $('.video-preview').removeAttr("src")
            $('.video-prev').hide();
            // if(groupChatImgPreview.hasAttribute("src")){
                console.log(reader)
                messageInput.remove()
                document.querySelector(".group-chat-send-form-message-parent-container").append(groupChatImgPreview)
                document.querySelector(".group-chat-send-form-message-parent-container").append(cancelBtn)
            // }
        }

        if(fileExtension === "mp4"){
            var fileUrl = window.URL.createObjectURL(groupChatImgInput.files[0]);
            $(".video-preview").attr("src", fileUrl)
            groupChatImgInput.value = ""
            groupChatImgPreview.removeAttribute("src")
            groupChatImgPreview.remove()
            messageInput.remove()
            document.querySelector(".group-chat-send-form-message-parent-container").append(cancelBtn)
            // document.querySelector(".group-chat-send-form-message-parent-container").append($(".video-prev"))
            $(".video-prev").show()
            }
    });//


        function clearGroupChatImg(){
            groupChatImgPreview.removeAttribute("src")
            groupChatImgPreview.remove()
            cancelBtn.remove()
            $('.video-preview').removeAttr("src")
            $('.video-prev').hide();
            document.querySelector(".group-chat-send-form-message-parent-container").append(messageInput)
            groupChatImgInput.value = ""

        }



    </script>
  </body>
</html>


