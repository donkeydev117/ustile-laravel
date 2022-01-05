@extends('layouts.master')
@section('content')

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
                $("#project_container").html(html);
            }
        });
    }

    function renderProject(projects){
        var html = "";
        projects.forEach(function(item){
            html += `<div id='accordian-${item.project.id}'>
                <div class='card'>
                    <div class="card-header" id='headingOne-${item.project.id}'>
                        <h5 class="mb-0">
                            <button class="btn btn-link" data-toggle='collapse' data-target="#project-${item.project.id}" aria-expanded='true' aria-controls='collapseOne' >
                                ${item.project.title}
                            </button>
                        </h5>
                    </div>
                    <div class='collapse show' id='project-${item.project.id}' aria-labelledby='headingOne-${item.project.id}' data-parent='#accordian-${item.project.id}'>
                        <div class="card-body">
                            <div class="row">`
                             item.products.forEach(function(product){
                                 console.log(product);
                                html += `<div class="col-sm-4 col-md-3">
                                    <div class="div-class">
                                        <div class="product product13 ratingstar">
                                            <article>
                                                <div class="thumb">
                                                    <div class="product-hover d-none d-lg-block d-xl-block">
                                                        <div class="icons">
                                                            <a href="javascript:void(0)" class="wishlist-icon icon active swipe-to-top" data-toggle="tooltip"
                                                                data-placement="bottom" title="" data-original-title="Wishlist" data-id="${product.product.id}" >
                                                                <i class="fas fa-heart"></i>
                                                            </a>
                                                            <div class="icon swipe-to-top quick-view-icon" data-tooltip="tooltip" data-placement="bottom" title="" data-original-title="Quick View" data-id="${product.product.id}">
                                                                <i class="fas fa-eye"></i>
                                                            </div>
                                                            <div class="icon swipe-to-top project-icon" data-tooltip="tooltip" data-placement="bottom" title="Add to Project" data-original-title="Add to Project" data-toggle="modal" data-target="#addToProjectModal" data-id="${product.product.id}>">
                                                                <i class="fas fa-folder" data-fa-transform="rotate-90"></i>
                                                            </div>
                                                            <div 
                                                                class="icon swipe-to-top remove-icon" 
                                                                data-tooltip="tooltip" 
                                                                data-placement="bottom" 
                                                                title="Remove from project" 
                                                                data-original-title="Remove from project" 
                                                                data-id="${product.product.id}"
                                                                data-projectId="${item.project.id}" 
                                                            >
                                                                <i class="fas fa-trash" data-fa-transform="rotate-90"></i>
                                                            </div>
                                                        </div>
                                                        <a class="btn btn-block btn-secondary swipe-to-top product-card-link" href="javascript:void(0)"
                                                        data-toggle="tooltip" data-placement="bottom" title=""
                                                        data-original-title="View Detail">View Detail</a>
                                                    </div>
                                                    <img class="img-fluid product-card-image" src="${product.product.gallary.detail[0].path}" alt="${product.product.detail[0].title}">
                                                </div>
                                                <div class="content">
                                                    <h5 class="title"><a href="javascript:void(0)" class="product-card-name">${product.product.detail[0].title}</a></h5>
                                                </div>
                                            </article>
                                        </div>
                                    </div>
                                    <div class="mb-3">`;
                                    product.tags.forEach(function(tag){
                                        html += `<span class="badge badge-secondary">${tag.tag}</span>`;
                                    })
                                html += `</div>
                                </div>`;
                             })

            html +=        `</div>`
            html += renderProject(item.children);
            html +=   `</div>
                    </div>
                </div>
            </div>`;
        });
        return html;
    }

    $(document).ready(function(){
        getProjects();
    })
</script>
@endsection