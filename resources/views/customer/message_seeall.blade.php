@extends('customer.layouts.app_home')

@section('content')

<div class="social-media-right-container ">

            <div class="modal fade" id="createGroupModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    <form action="{{route('socialmedia.group.create')}}" class="create-group-form" method="POST">
                        @csrf
                        <div class="create-group-name">
                            <p>Group Name</p>
                            <input type="text" name="group_name" required>
                        </div>
                        {{-- <div class="create-group-addfris">
                            <p>Add Your Friends</p>
                            <select class="js-example-basic-multiple" name="members[]" multiple="multiple">
                                @foreach ($friends as $friend)
                                    <option value="{{$friend->id}}">{{$friend->name}}</option>
                                @endforeach
                            </select>
                        </div> --}}
                        <button type="submit" class="customer-primary-btn create-group-submit-btn">Create</button>
                    </form>
                    </div>

                </div>
                </div>
            </div>

            <div class="social-media-allchats-header">
                <p>Messages</p>
                <div class="social-media-allchats-header-btn-container">
                    <button class="social-media-allchats-header-search-btn customer-primary-btn">
                        <iconify-icon icon="akar-icons:search" class="social-media-allchats-header-search-icon"></iconify-icon>
                    </button>
                    <button type="button" class="social-media-allchats-header-add-btn customer-primary-btn" data-bs-toggle="modal" data-bs-target="#createGroupModal">
                        <iconify-icon icon="akar-icons:circle-plus" class="social-media-allchats-header-plus-icon"></iconify-icon>
                        <p>Group</p>
                    </button>
                </div>
            </div>

            <div class="social-media-allchats-messages-container">
                    @forelse ($messages as $list)
                    <div class="social-media-allchats-message-row">
                        <a href="{{route('message.chat',$list->id)}}" class="social-media-allchats-message-row">
                            <div class="social-media-allchats-message-img">
                                @if ($list->profile_image==null)
                                                <img  class="nav-profile-img" src="{{asset('img/customer/imgs/user_default.jpg')}}"/>
                                            @else
                                                <img  class="nav-profile-img" src="{{asset('storage/post/'.$list->profile_image)}}"/>
                                            @endif

                                <p>{{$list->name}}</p>
                            </div>

                            <p>{{$list->text}}</p>

                            <span>{{ \Carbon\Carbon::parse($list->created_at)->format('d M Y , g:i A')}}</span>
                        </a>

                        <div  data-id="{{$list->from_id}}" class="converstion_delete" id="{{$list->to_id}}">Delete</div>
                        {{-- <iconify-icon icon="bi:three-dots-vertical" class="social-media-seeallmessage-header-icon"></iconify-icon> --}}
                    </div>

                    @empty
                        <p>No Message</p>
                    @endforelse
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function(){

        $('.converstion_delete').click(function(e){
            var from_id=$(this).data('id');
            var to_id=$(this).attr('id');

            Swal.fire({
                text: "Delete Conversation?",
                showClass: {
                        popup: 'animate__animated animate__fadeInDown'
                    },
                    hideClass: {
                        popup: 'animate__animated animate__fadeOutUp'
                    },
                showCancelButton: true,
                timerProgressBar: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',

                }).then((result) =>{
                        var add_url = "{{ route('message.all.delete')}}";
                    $.ajax({
                                method: "GET",
                                url: add_url,
                                data:{ from_id : from_id , to_id:to_id},
                                success:function(data){
                                    Swal.fire({
                                            text: data.success,
                                            timerProgressBar: true,
                                            timer: 5000,
                                            icon: 'success',
                                        })
                                }
                            })
                    })

        })
        $('.social-media-seeallmessage-header-icon').click(function(){
            $(this).next().toggle()
        })

        $('.js-example-basic-multiple').select2(
                { dropdownParent: "#createGroupModal" }
        );

        $('.select2-container').attr('style', '');
    })

</script>
@endpush

