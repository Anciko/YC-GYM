@extends('customer.shop.layouts.app_shop')

@section('content')
@include('sweetalert::alert')

<div class="shop-right-container">
    <div class="shop-main-search-container">
        <input type="text" placeholder="Search...">
        <iconify-icon icon="akar-icons:search" class="shop-main-search-icon"></iconify-icon>
    </div>

    <div  class="shop-main-shops-container">
        @forelse ($shops as $shop)
            <a  href = {{route('shoppost',$shop->id)}} class="shop-main-shop-container">
                <div class="shop-main-shop-details-container">
                    <img src="https://www.hussle.com/blog/wp-content/uploads/2020/12/Gym-structure-1080x675.png">
                    <div class="shop-main-shop-name">
                        <p>{{$shop->name}}'s Shop</p>
                    </div>
                </div>
                <div class="shop-noofposts-container">
                    <p>Number of posts</p>
                    <span>10</span>
                </div>

                <iconify-icon icon="material-symbols:arrow-forward-ios-rounded" class="shop-main-shop-icon"></iconify-icon>
            </a>
        @empty
        <p class="text-secondary p-1">No Shop Post</p>
        @endforelse
    </div>
</div>
@endsection
<script>
$('#search').on('keyup', function(){
    search();
});
search();
function search(){
    var keyword = $('#search').val();
    // console.log(keyword);
    var group_id = {{$selected_group->id}};

    var search_url = "{{ route('trainer/member/search',':id') }}";
    search_url = search_url.replace(':id', group_id);
    $.post(search_url,
    {
        _token: $('meta[name="csrf-token"]').attr('content'),
        keyword:keyword
    },
    function(data){
        table_post_row(data);
        console.log(data);
    });
}
// table row with ajax
function table_post_row(res){
let htmlView = '';
    if(res.members.length <= 0){
        htmlView+= `
        No data found.
        `;
    }
    for(let i = 0; i < res.members.length; i++){
        id = res.members[i].id;
        group_id = {{$selected_group->id}};
        console.log("select",group_id);
        var url = "{{ route('addMember',[':id',':group_id']) }}";
        url = url.replace(':id', id);
        url = url.replace(':group_id', group_id);
        // console.log(url);
        htmlView += `
            <div class="add-member-row">
                <div class="add-member-name-container">
                    <img src="{{ asset('image/default.jpg') }}" />
                    <p>`+res.members[i].name+`</p>
                </div>
                <div class="add-member-row-btns-container">
                    <a href="?id=` + res.members[i].id+`" class="customer-secondary-btn add-member-btn" id="`+group_id+`">Add</a>
                    <a class="customer-secondary-btn add-member-view-profile-btn" id="`+res.members[i].id+`">View Profile</a>

                </div>
            </div>`
    }
    $('.trainer-group-chat-members-container').html(htmlView);
}
</script>
