@extends('layouts.master')
@section('content')

<div class="cotainer-fluid mt-4 pl-4 pr-4">
    <div class="row">
        <div class="col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Parent</th>
                            <th>Deleted At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="recylebin-main-table-body">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
   
@endsection
@section('script')
<script>
    loggedIn = $.trim(localStorage.getItem("customerLoggedin"));
    if (loggedIn != '1') {
        window.location.href = "{{ url('/') }}";
    }

    cartSession = $.trim(localStorage.getItem("cartSession"));
    if (cartSession == null || cartSession == 'null') {
        cartSession = '';
    }
    loggedIn = $.trim(localStorage.getItem("customerLoggedin"));
    customerToken = $.trim(localStorage.getItem("customerToken"));
    customerId = $.trim(localStorage.getItem("customerId"));
    
    function getItems(){
        $.ajax({
            type: 'get',
            url: "{{ url('') }}" + '/api/client/projects/get_recylebin_items/' + customerId,
            headers: {
                'Authorization': 'Bearer ' + customerToken,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            success: function(res){
                const items = res.items;
                items.forEach(function(item){
                    const $tr = $("<tr></tr>");
                    // Title
                    if(item.image != "") {
                        $tr.append(`<td><img src='${item.image}' style='width: 50px; height: 50px;' /></td>`);
                    } else {
                        $tr.append("<td></td>");
                    }
                    $tr.append(`<td>${item.title}</td>`);
                    $tr.append(`<td>${item.type}</td>`);
                    $tr.append(`<td>${item.parentTitle ?? ""}</td>`);
                    $tr.append(`<td>${new Date(item.updated_at).toLocaleDateString()}</td>`);
                    $tr.append(`<td>
                        <button class='btn btn-link' data-type='${item.type}' data-id='${item.id}' onclick='restoreItem(this)'>Restore</button>
                        <button class='btn btn-link' data-type='${item.type}' data-id='${item.id}' onclick='deleteItem(this)'>Delete</button>
                    </td>`);

                    $("#recylebin-main-table-body").append($tr);
                })
            }
        });
    }    

    function restoreItem(input){
        const confirm = window.confirm("Would you restore this item?");
        if(!confirm) return;
        var type = $(input).data('type');
        var id = $(input).data('id');
        $.ajax({
            type: 'post',
            url: "{{ url('') }}" + '/api/client/projects/restore_item_from_recylebin',
            headers: {
                'Authorization': 'Bearer ' + customerToken,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            data: {
                type : type,
                id : id
            },
            success: function(res){
                window.location.reload();
            },
            error: function(error){
                console.log(error);
            }
        })
    }

    function deleteItem(input){
        const confirm = window.confirm("Would you delete this item permantely form project?");
        if(!confirm) return;
        var type = $(input).data('type');
        var id = $(input).data('id');
        $.ajax({
            type: 'post',
            url: "{{ url('') }}" + '/api/client/projects/delete_item_from_recylebin',
            headers: {
                'Authorization': 'Bearer ' + customerToken,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            data: {
                type : type,
                id : id
            },
            success: function(res){
                window.location.reload();
            },
            error: function(error){
                console.log(error);
            }
        })
    }

    $(document).ready(function(){
        getItems();
    })
</script>
@endsection