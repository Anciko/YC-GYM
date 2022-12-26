
        $(".chat-backdrop").hide();
        // var voice_receive_user_img = @json($receiver_user->user_profile);
        var profile

        let onlineUsers = []
        let client = null
        let callPlaced = false
        let localStream = null
        let incomingCaller = "";
        let agoraChannel = null
        let incomingCall = false;
        let incomingAudioCall = false;
        let videoCallEvent = false;
        let audioCallEvent = false;
        let mutedVideo = false
        let mutedAudio = false
        const agora_id = 'e8d6696cc7dc449dbd78ebbd1e15ee13'

        let authuser = "yak"
        let authuserId = "3"
        console.log('-----------------------------------------------------------------------------',authuserId);
        let receiverUserName = document.getElementById('receiverUserName').value
        let receiver_user_id = document.getElementById('recieveUser').value
        console.log('-------------------------------------------',receiver_user_id);

        let incoming_call = document.getElementById('incoming_call')
        let video_container = document.getElementById('video-main-container')
        let incomingCallContainer = document.querySelector('#incomingCallContainer')

        // let friends;

        // $(document).ready(function(){
        //     friends = @json($friends);
        // })

        // if (voice_receive_user_img == null) {
        //     profile = `img/customer/imgs/user_default.jpg`
        // } else {
        //     var image = @json($receiver_user->user_profile?->profile_image);
        //     profile = `storage/post/${image}`
        // }

        Echo.channel('agora-videocall')
            .listen(".MakeAgoraCall", ({
                data
            }) => {
                console.log('listening-------------------------', data);
                if (parseInt(data.userToCall) === parseInt(authuserId)) {

                    // console.log('caller index', callerIndex);
                    // incomingCaller = onlineUsers[callerIndex]["name"]
                    incomingCall = true


                    // console.log('incomingcaller', incomingCaller);

                    console.log('llllllrweer', incomingCall);

                    console.log('incoming audio calll checkkkkk', incomingAudioCall);
                    if (incomingCall) {
                        $(".chat-backdrop").show();

                        incomingCallContainer.innerHTML += `<div class="row my-5" id="incoming_call">

                                <div class="card shadow p-4 col-12">
                                    <p>
                                        Video Call From <span>${receiverUserName}</span>
                                    </p>
                                    <div class="d-flex justify-content-center gap-3">
                                        <button type="button" class="btn btn-sm btn-danger"  id="" onclick="declineCall()">
                                            Decline
                                        </button>
                                        <button type="button" class="btn btn-sm btn-success ml-5" onclick="acceptCall()">
                                            Accept
                                        </button>
                                    </div>
                                </div>
                            </div>`;


                    }
                    agoraChannel = data.channelName
                }
            }).listen(".MakeAgoraAudioCall", ({
                data
            }) => {
                console.log('listening-------------------------', data);
                if (parseInt(data.userToCall) === parseInt(authuserId)) {

                    // console.log('caller index', callerIndex);
                    // incomingCaller = onlineUsers[callerIndex]["name"]
                    incomingCall = true
                    incomingAudioCall = true

                    if (incomingCall) {
                        $(".chat-backdrop").show();
                        if (incomingAudioCall) {
                            incomingCallContainer.innerHTML += `<div class="row my-5" id="incoming_call">

                                <div class="card shadow p-4 col-12">
                                    <p>
                                        Audio Call From <span>${receiverUserName}</span>
                                    </p>
                                    <div class="d-flex justify-content-center gap-3">
                                        <button type="button" class="btn btn-sm btn-danger"  id="" onclick="declineCall()">
                                            Decline
                                        </button>
                                        <button type="button" class="btn btn-sm btn-success ml-5" onclick="acceptCall()">
                                            Accept
                                        </button>
                                    </div>
                                </div>
                            </div>`;

                        }


                    }
                    agoraChannel = data.channelName
                }
            }).listen(".DeclineCallUser", ({
                data
            }) => {
                if (parseInt(data.userFromCall) == parseInt(authuserId)) {
                    video_container.innerHTML = "";
                    $(".chat-backdrop").hide();
                    location.reload(true)
                }
            })



        async function placeCall(id, call_name) {
            // console.log(id, call_name);
            try {
                const channelName = `${authuser}_${call_name}`;
                const tokenRes = await generateToken(channelName)

                console.log(tokenRes.data);
                console.log(tokenRes, "call Token")
                axios.post("/agora/call-user", {
                    user_to_call: id,
                    username: authuser,
                    channel_name: channelName,
                });
                initializeAgora()
                joinRoom(tokenRes.data, channelName)
                callPlaced = true

                videoCallEvent = true;

                // if(callPlaced){
                //     video_container.classList.remove('hide')
                // }
            } catch (error) {
                console.log("No internet connection");
            }
        }

        async function placeCallAudio(id, call_name) {
            try {
                const channelName = `${authuser}_${call_name}`;
                const tokenRes = await generateToken(channelName);

                console.log(tokenRes.data);

                axios.post("/agora/call-audio-user", {
                    user_to_call: id,
                    username: authuser,
                    channel_name: channelName,
                });
                initializeAgora()
                joinRoom(tokenRes.data, channelName)
                callPlaced = true;
                incomingAudioCall = true;

                audioCallEvent = true;
                // if(callPlaced){
                //     video_container.classList.remove('hide')
                // }
            } catch (error) {
                console.log(error);
            }
        }


        function generateToken(channelName) {
            return axios.post("/agora/token", {
                channelName,
            });
        }

        function initializeAgora() {
            client = AgoraRTC.createClient({
                mode: "rtc",
                codec: "h264"
            });
            client.init(
                agora_id,
                () => {
                    console.log("AgoraRTC client initialized");
                },
                (err) => {
                    console.log("AgoraRTC client init failed", err);
                }
            );
        }

        async function acceptCall() {
            console.log('call accept');
            initializeAgora();
            const tokenRes = await generateToken(agoraChannel);
            joinRoom(tokenRes.data, agoraChannel);
            incomingCall = false;
            callPlaced = true;
            videoCallEvent = true;
            incomingCallContainer.innerHTML = ""
            console.log(tokenRes, "accept")
        }

        function declineCall() {
            incomingCall = false;
            incomingCallContainer.innerHTML = "";
            $(".chat-backdrop").hide();
            // nc start
            axios.post("/agora/decline-call-user", {
                user_from_call: receiver_user_id
            });
        }

        async function joinRoom(token, channel) {
            console.log(token, channel);
            client.join(
                token,
                channel,
                authuser,
                (uid) => {
                    console.log("User " + uid + " join channel successfully");
                    callPlaced = true

                    console.log("incoming audio call lay pr", incomingAudioCall);

                    if (callPlaced) {
                        // parent.document.body.classList.add('backdrop')
                        $("#video-main-container").show()
                        $(".chat-backdrop").show();
                        if (incomingAudioCall) {
                            video_container.innerHTML += `
                                                    <div id="audio-container">
                                                       <div id="local-audio"></div>
                                                        <div id="remote-audio"></div>
                                                    <div class="text-center ">
                                                        <img src="{{ asset('${profile}') }}" class="rounded-circle img-thumbnail img-fluid shadow" style="width:150px; height:150px;"/>
                                                        <p class="mb-0 mt-3" style="color:#3CDD57;">${receiverUserName}</p>
                                                    </div>
                                                    <div class="action-btns">
                                                        <button type="button" class="btn btn-info p-2 me-3" id="muteAudio" onclick="handleAudioToggle(this)">
                                                            <i class="fa-solid fa-microphone-slash" style="width:30px"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger p-2" onclick="endCall()">
                                                            <i class="fa-solid fa-phone-slash" style="width:30px"></i>
                                                        </button>
                                                    </div></div>
                                        `;

                            createAudioLocalStream();
                            initializedAgoraListeners();
                        } else {
                            video_container.innerHTML += `
                                                    <div id="video-container">
                                                        <div id="local-video"></div>
                                                    <div id="remote-video"></div>
                                                    <div class="action-btns">
                                                        <button type="button" class="btn btn-info p-2" id="muteAudio" onclick="handleAudioToggle(this)">
                                                            <i class="fa-solid fa-microphone-slash" style="width:30px"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-primary mx-4 p-2" id="muteVideo" onclick="handleVideoToggle(this)">
                                                            <i class="fa-solid fa-video-slash" style="width:30px"></i>
                                                        </button>
                                                        <button type="button" class="btn btn-danger p-2" onclick="endCall()">
                                                            <i class="fa-solid fa-phone-slash" style="width:30px"></i>
                                                        </button>
                                                    </div></div>
                                        `;
                            createLocalStream();
                            initializedAgoraListeners();
                        }

                    }

                },
                (err) => {
                    console.log("Join channel failed", err);
                }
            );
        }

        function initializedAgoraListeners() {
            //   Register event listeners
            client.on("stream-published", function(evt) {
                console.log("Publish local stream successfully");
                console.log(evt);
            });
            //subscribe remote stream
            client.on("stream-added", ({
                stream
            }) => {
                console.log("New stream added: " + stream.getId());
                client.subscribe(stream, function(err) {
                    console.log("Subscribe stream failed", err);
                });
            });
            client.on("stream-subscribed", (evt) => {
                // Attach remote stream to the remote-video div
                // evt.stream.play("remote-video");
                //     client.publish(evt.stream);
                if (videoCallEvent) {
                    evt.stream.play("remote-video");
                    client.publish(evt.stream);
                }

                if (audioCallEvent) {
                    evt.stream.play("remote-audio");
                    client.publish(evt.stream);
                }



            });
            client.on("stream-removed", ({
                stream
            }) => {
                console.log(String(stream.getId()));
                stream.close();
            });
            client.on("peer-online", (evt) => {
                console.log("peer-online", evt.uid);
            });
            client.on("peer-leave", (evt) => {
                var uid = evt.uid;
                var reason = evt.reason;
                console.log("remote user left ", uid, "reason: ", reason);
            });
            client.on("stream-unpublished", (evt) => {
                console.log(evt);
            });
        }


        function createLocalStream() {
            localStream = AgoraRTC.createStream({
                audio: true,
                video: true,
            });
            // Initialize the local stream
            localStream.init(
                () => {
                    // Play the local stream
                    localStream.play("local-video");
                    // Publish the local stream
                    client.publish(localStream, (data) => {
                        console.log("publish local stream", data);
                    });
                },
                (err) => {
                    console.log(err);
                }
            );
        }

        function createAudioLocalStream() {
            localStream = AgoraRTC.createStream({
                audio: true,
                video: false,
            });
            // Initialize the local stream
            localStream.init(
                () => {
                    // Play the local stream
                    localStream.play("local-audio");
                    // Publish the local stream
                    client.publish(localStream, (data) => {
                        console.log("publish local stream", data);
                    });
                },
                (err) => {
                    console.log(err);
                }
            );
        }

        function endCall() {
            localStream.close();
            client.leave(
                () => {
                    console.log("Leave channel successfully");
                    callPlaced = false;
                },
                (err) => {
                    console.log("Leave channel failed");
                }
            );
            video_container.innerHTML = "";
            $(".chat-backdrop").hide()
            location.reload(true)
            axios.post("/agora/decline-call-user", {
                user_from_call: receiver_user_id
            });
        }

        function handleAudioToggle(e) {
            if (mutedAudio) {
                localStream.unmuteAudio();
                mutedAudio = false;
                e.innerHTML = `<i class="fa-solid fa-microphone-slash" style="width:30px"></i>`;
            } else {
                localStream.muteAudio();
                mutedAudio = true;
                e.innerHTML = `<i class="fa-solid fa-microphone" style="width:30px"></i>`;
            }
        }

        function handleVideoToggle(e) {
            if (mutedVideo) {
                localStream.unmuteVideo();
                mutedVideo = false;
                e.innerHTML = ` <i class="fa-solid fa-video-slash" style="width:30px"></i>`;
            } else {
                localStream.muteVideo();
                mutedVideo = true;
                e.innerHTML = `<i class="fa-solid fa-video" style="width:30px"></i>`;
            }
        }
