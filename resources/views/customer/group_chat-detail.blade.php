@extends('customer.layouts.app_home')
@section('content')
<div class="social-media-right-container">

    <div class="modal fade" id="createGroupModal" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Members</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="{{route('socialmedia.group.addmember',$id)}}" class="create-group-form" method="POST">
                @csrf
                <div class="create-group-addfris">
                    <p>Add Your Friends</p>
                    <select class="js-example-basic-multiple" name="members[]" multiple="multiple">
                        @foreach ($friends as $friend)
                            <option value="{{$friend->id}}">{{$friend->name}}</option>
                        @endforeach
                      </select>
                </div>

                <button type="submit" class="customer-primary-btn create-group-submit-btn">Create</button>
              </form>
            </div>

          </div>
        </div>
    </div>


    <div class="group-chat-header">
        <div class="group-chat-header-name-container">
            <a href="{{route('socialmedia.group',$group->id)}}" class="group-chat-header-name-container">
                <img src="../imgs/avatar.png"/>
                <div class="group-chat-header-name-text-container">
                    <p>{{$group->group_name}}</p>
                </div>
            </a>
        </div>
        <div class="chat-header-call-icons-container">
            <iconify-icon icon="ant-design:phone-outlined" class="chat-header-phone-icon"></iconify-icon>
            <iconify-icon icon="eva:video-outline" class="chat-header-video-icon"></iconify-icon>

            <a href="../htmls/trainerTrainingCenterViewMedia.html" class="group-chat-view-midea-link">
                <p>View Media</p>
                <iconify-icon icon="akar-icons:arrow-right" class="group-chat-view-midea-link-icon"></iconify-icon>
            </a>
        </div>


    </div>

    <button type="button" class="social-media-allchats-header-add-btn customer-primary-btn group-chat-add-btn" data-bs-toggle="modal" data-bs-target="#createGroupModal">
        <iconify-icon icon="akar-icons:circle-plus" class="social-media-allchats-header-plus-icon"></iconify-icon>
        <p>Member</p>
    </button>

    <div class="social-media-view-members-container">
        @forelse ($members as $member)

            <form action="{{route('socialmedia.group.memberkick')}}" method="post">
                @csrf
                <input type="text" value="{{$member->group_id}}" name="groupId" hidden>
                <input type="text" value="{{$member->member_id}}" name="memberId" hidden>
                <div class="social-media-view-memers-row">
                    <div class="social-media-view-memers-row-name">

                        {{-- @if ($member->user->profiles[0]->profile_image != null)
                            <img src="{{asset('storage/post'.$member->user->profiles[0]->profile_image)}}">
                        @else
                            <img class="nav-profile-img" src="{{asset('img/customer/imgs/user_default.jpg')}}"/>
                        @endif --}}
                        <img class="nav-profile-img" src="{{asset('img/customer/imgs/user_default.jpg')}}"/>
                        <p>{{$member->user->name}}</p>
                    </div>
                    <div class="social-media-view-members-row-btns">
                        <a href="{{route('socialmedia.profile',$member->member_id)}}" class="customer-secondary-btn">View Profile</a>
                        <button type="submit" class="customer-red-btn">Kick</button>
                    </div>
                </div>
            </form>
        @empty
            <div class="social-media-view-memers-row">
                <p>Empty group member. Please add member.</p>
            </div>
        @endforelse


    </div>
</div>
@endsection
@push('scripts')
<script>

    $(document).ready(function(){
        $('.js-example-basic-multiple').select2(
                { dropdownParent: "#createGroupModal" }
        );

        $('.select2-container').attr('style', '');
    })

</script>
@endpush