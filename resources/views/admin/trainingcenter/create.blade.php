@extends('layouts.app')
@section('training-center-active', 'active')

@section('content')
<link rel="stylesheet" href="{{asset('css/globals.css')}}">
<link rel="stylesheet" href="{{asset('css/adminchat/trainingcenter.css')}}">
<!--create gp modal-->
<button data-bs-toggle="modal" data-bs-target="#CreateGroupModal">Create Group</button>
<div class="modal fade" id="CreateGroupModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header  customer-transaction-modal-header">
          <h5 class="modal-title text-center" id="exampleModalLabel">Create Group</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="clearCreateGroupInputs()"></button>
        </div>
        <div class="modal-body">
         <form class="create-group-form" action="{{route('traininggroup.store')}}" method="POST">
            @method('POST')
            @csrf
            {{-- <input type="hidden" name="trainer_id" value="{{auth()->user()->id}}"> --}}
            <div class="mb-2">
                <label>Group Name</label>
                <input class="form-control" type="text" name="group_name" required>
            </div>
            <div class="mb-2">
                <label>Member Type</label>
                <select class="form-control" name="member_type" class="@error('member_type') is-invalid @enderror" required>
                    <option value="">Choose Member Type</option>
                    @foreach ($members as $member)
                    <option value="{{$member->member_type}}">{{$member->member_type}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-2">
                <label>Level</label>
                <select class="form-control" name="member_type_level" class="@error('member_type_level') is-invalid @enderror" required>
                    <option value="">Choose Level</option>
                    <option value="beginner">Beginner</option>
                    <option value="advanced">Advanced</option>
                    <option value="professional">Professional</option>
                </select>
                @error('member_type_level')
                        <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-2">
                <label>Gender</label>
                <select class="form-control" name="gender" class="@error('gender') is-invalid @enderror" required>
                    <option value="">Choose Gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Group Type</label>
                <select class="form-control" name="group_type" class="@error('gender') is-invalid @enderror" id="group_type" required>
                    <option value="">Choose Group Type</option>
                    <option value="weight gain">Weight Gain</option>
                    <option value="body beauty">Body Beauty</option>
                    <option value="weight loss">Weight Loss</option>
                </select>
            </div>

            <div class="">
                <button type="submit" class="btn btn-primary me-2">Confirm</button>
                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal" aria-label="Close" onclick="clearCreateGroupInputs()">Cancel</button>
            </div>
         </form>

        </div>

      </div>
    </div>
</div>
{{-- end modal box --}}

        <div class="customer-main-content-container">
            <div class="trainer-main-content-container">
                <button data-bs-toggle="modal" data-bs-target="#CreateGroupModal" class="trainer-create-gp-modal-btn customer-primary-btn">
                    <iconify-icon icon="akar-icons:circle-plus" class="trainer-create-gp--modal-btn-icon"></iconify-icon>
                    <p>Group</p>
                </button>

                <div class="trainer-two-columns-container">
                    <div class="trainer-group-chats-parent-container">
                        <p>Groups</p>
                        <div class="trainer-group-chats-container">
                            <!-- <a href="#" class="tainer-group-chat-name-container">
                                <img src="../imgs/avatar.png"/>
                                <p>Group Name</p>
                            </a> -->
                            @forelse ($groups as $group)
                                <div class="tainer-group-chat-name-container">
                                    <img src="../imgs/avatar.png"/>
                                    <p>{{$group->group_name}}</p>
                                </div>
                                @empty
                                <p>Not Found </p>
                            @endforelse

                        </div>
                    </div>
                    <div class="group-chat-container">
                        <div class="group-chat-header">
                            <a href="../htmls/trainerGroupChatViewMembers.html" class="group-chat-header-name-container">
                                <img src="../imgs/avatar.png"/>
                                <div class="group-chat-header-name-text-container">
                                    <p>Group Name</p>
                                    <span>group member, group member,group member,group member,group member,</span>
                                </div>
                            </a>

                            <a href="../htmls/trainerTrainingCenterViewMedia.html" class="group-chat-view-midea-link">
                                <p>View Media</p>
                                <iconify-icon icon="akar-icons:arrow-right" class="group-chat-view-midea-link-icon"></iconify-icon>
                            </a>
                        </div>

                        <div class="group-chat-messages-container">
                            <div class="group-chat-receiver-container">
                                <img src="../imgs/avatar.png"/>
                                <div class="group-chat-receiver-text-container">
                                    <span>Group Member</span>
                                    <p>This is a long text message.This is a long text message.This is a long text message.This is a long text message.This is a long text message.</p>
                                </div>
                            </div>
                            <div class="group-chat-receiver-container">
                                <img src="../imgs/avatar.png"/>
                                <div class="group-chat-receiver-text-container">
                                    <span>Group Member</span>
                                    <p>This is a long text message</p>
                                </div>
                            </div>
                            <div class="group-chat-receiver-container">
                                <img src="../imgs/avatar.png"/>
                                <div class="group-chat-receiver-text-container">
                                    <span>Group Member</span>
                                    <p>This is a long text message</p>
                                </div>
                            </div>
                            <div class="group-chat-receiver-container">
                                <img src="../imgs/avatar.png"/>
                                <div class="group-chat-receiver-text-container">
                                    <span>Group Member</span>
                                    <p>This is a long text message</p>
                                </div>
                            </div>
                            <div class="group-chat-receiver-container">
                                <img src="../imgs/avatar.png"/>
                                <div class="group-chat-receiver-text-container">
                                    <span>Group Member</span>
                                    <p>This is a long text message</p>
                                </div>
                            </div>

                            <div class="group-chat-sender-container">
                                <div class="group-chat-sender-text-container">

                                    <p>This is a long text message</p>
                                </div>
                                <img src="../imgs/avatar.png"/>
                            </div>
                            <div class="group-chat-sender-container">
                                <div class="group-chat-sender-text-container">

                                    <p>This is a long text message This is a long text message This is a long text message This is a long text message</p>
                                </div>
                                <img src="../imgs/avatar.png"/>
                            </div>
                            <div class="group-chat-sender-container">
                                <div class="group-chat-sender-text-container">

                                    <img src="../imgs/avatar.png">
                                </div>
                                <img src="../imgs/avatar.png"/>
                            </div>
                            <div class="group-chat-sender-container">
                                <div class="group-chat-sender-text-container">

                                    <video width="200" height="auto" controls>
                                        <source src="../imgs/movie.mp4" type="video/mp4">
                                    </video>
                                </div>
                                <img src="../imgs/avatar.png"/>
                            </div>
                        </div>

                        <form class="group-chat-send-form-container">
                            <div class="group-chat-send-form-message-parent-container">
                                <div class="group-chat-send-form-img-emoji-container">
                                    <label class="group-chat-send-form-img-contaier">
                                        <iconify-icon icon="bi:images" class="group-chat-send-form-img-icon">

                                        </iconify-icon>
                                        <input type="file" id="groupChatImg" name="groupChatImg">
                                    </label>
                                    <button type="button" id="emoji-button" class="emoji-trigger">
                                        <iconify-icon icon="bi:emoji-smile" class="group-chat-send-form-emoji-icon"></iconify-icon>
                                    </button>

                                </div>

                                <textarea id="mytextarea"  class="group-chat-send-form-input" placeholder="Message..." required ></textarea>
                                <img class="group-chat-img-preview groupChatImg">
                                <div style="display: none;" class='video-prev'>
                                    <video height="200" width="300" class="video-preview" controls="controls"></video>
                                </div>
                                <button type="reset"  class="group-chat-img-cancel" onclick="clearGroupChatImg()">
                                    <iconify-icon icon="charm:cross" class="group-chat-img-cancel-icon"></iconify-icon>
                                </button>
                            </div>

                            <button type="submit" class="group-chat-send-form-submit-btn">
                                <iconify-icon icon="akar-icons:send" class="group-chat-send-form-submit-btn-icon"></iconify-icon>
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>

@endsection
