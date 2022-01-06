@extends('layouts.master')
@section('content')
<style>
    .btn-icon{
        padding: 0.25rem 0.375rem;
    }
    .product-image{
        width:  100px;
        height: 100px;
    }
    .sortable  li, #s-l-base li { 
        padding-left:50px 
    }
    .product-template-container-li{
        padding: 0.25rem 0.375rem;
    }
    ul {
        list-style-type: none;
        margin: 0;
        padding:0; 
    }
    .project-content{
        padding: 0.375rem 0.5rem;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
        background-color: rgb(124, 122, 122);
        margin-bottom: 0.5rem;
        color: #fff
    }
    .c3{
        color: #f77720
    }
    
</style>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12" id="project_container">
        </div>
    </div>

    <form id="remove_product_form">
        @csrf
        <input type="hidden" id="remove_product_product_id" name="product_id"/>
        <input type="hidden" id="remove_product_project_id" name="project_id" />
    </form>
</div>
@include("includes.projects.product-template")
@include("includes.projects.project-template")

   
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
    
    function getProjects(){
        $.ajax({
            type: 'get',
            url: "{{ url('') }}" + '/api/client/projects/get_projects_with_products/' + customerId,
            headers: {
                'Authorization': 'Bearer ' + customerToken,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            success: function(res){
                const projects = res.data;
                const html = renderProject(projects);
                html.addClass("sortable");
                $("#project_container").append(html);
                var options = {
                    insertZonePlus: true,
                    placeholderCss: {'background-color': 'green'},
                    hintCss: {'background-color':'blue'},
                    ignoreClass : 'btn',
                    onChange: function( cEl )
                    {
                        console.log( 'onChange' );
                    },
                    complete: function( cEl )
                    {
                        console.log( 'complete' );
                        const arrayData = $(".sortable").sortableListsToArray();
                        $.ajax({
                            type: 'post',
                            url: "{{ url('') }}" + '/api/client/projects/updateProjects' ,
                            headers: {
                                'Authorization': 'Bearer ' + customerToken,
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
                            },
                            data: {
                                data: arrayData
                            },
                            success: function(res){
                                console.log(res);
                                // window.location.reload();
                            },
                            error: function(error){
                                console.log(error);
                            }

                        })
                        // console.log(cEl);
                        // console.log(cEl.data("module"));
                    },
                    isAllowed: function( cEl, hint, target )
                    {
                        // Be carefull if you test some ul/ol elements here.
                        // Sometimes ul/ols are dynamically generated and so they have not some attributes as natural ul/ols.
                        // Be careful also if the hint is not visible. It has only display none so it is at the previous place where it was before(excluding first moves before showing).
                        if( target.data('module') === 'product' )
                        {
                            hint.css('background-color', '#ff9999');
                            return false;
                        }
                        else
                        {
                            hint.css('background-color', '#99ff99');
                            return true;
                        }
                    },
                    opener: {
                        active: true,
                        as: 'html',  // if as is not set plugin uses background image
                        close: '<i class="fa fa-minus c3"></i>',  // or 'fa-minus c3'
                        open: '<i class="fa fa-plus"></i>',  // or 'fa-plus'
                        openerCss: {
                            'display': 'inline-block',
                            'float': 'left',
                            'margin-left': '-35px',
                            'margin-right': '5px',
                            'font-size': '1.1em'
                        }
                    },
                };
                $(".sortable").sortableLists(options);
            }
        });
    }


    function renderProject(projects){
        var html = $("<ul class=''></ul>");
        const templ = document.getElementById("project_template");
        const productTempl = document.getElementById('product_template');
        projects.forEach(function(project){
            const clone = templ.content.cloneNode(true);
            $(clone).find(".project-template-li-container").prop("id", project.project.id);
            $(clone).find(".project-template-li-container").data("value", "project");
            $(clone).find(".project-title").text(project.project.title);
            $(clone).find(".btn-icon").data("id", project.project.id);
            $(clone).find(".project-template-li-container").data("module", "project");
            $(clone).find(".btn-remove").attr("onclick", "removeProject(this)");

            var childClone = renderProject(project.children);
            $(clone).find(".project-template-li-container").append(childClone);
            var products = project.products;
            products.forEach(function(product){
                const productClone = productTempl.content.cloneNode(true);
                $(productClone).find(".product-image").prop("src",product.product.gallary.detail[0].path);
                $(productClone).find(".product-template-container-li").data("module", "product");
                $(productClone).find(".product-template-container-li").prop("id", product.id);
                $(productClone).find(".product-template-container-li").data("value", "product");
                $(productClone).find(".product-title").text(product.product.detail[0].title)
                $(productClone).find(".product-price").text(product.product.price);
                $(clone).find("ul:first").append(productClone);
            })
            html.append(clone);
        })
        return html;
    }

    function removeProduct(input){
        var confirm = window.confirm("Are you sure?");
        if(!confirm) return;
        var product_id = $(input).data('id');
        var project_id = $(input).data('projectid');
        var id = $(input).data("id");

        $.ajax({
            type: 'post',
            url: "{{ url('') }}" + '/api/client/projects/removeProduct' ,
            headers: {
                'Authorization': 'Bearer ' + customerToken,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            data: {
                projectProductId : id
            },
            success: function(res){
                window.location.reload();
            },
            error: function(error){
                console.log(error);
            }

        })
    }

    function removeProject(input){
        var confirm = window.confirm("Are you sure?");
        if(!confirm) return;
        var id = $(input).data("id");

        $.ajax({
            type: 'post',
            url: "{{ url('') }}" + '/api/client/projects/removeProject' ,
            headers: {
                'Authorization': 'Bearer ' + customerToken,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            data: {
                project_id : id
            },
            success: function(res){
                console.log(res);
                window.location.reload();
            },
            error: function(error){
                console.log(error);
            }
        });
    }

    $(document).ready(function(){
        getProjects();
    })
</script>
@endsection