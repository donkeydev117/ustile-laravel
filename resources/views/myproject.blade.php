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
    .recylebin-container{
        width: 60px;
        height: 60px;
        background-color: #958383;
        float: right;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 30px;
        cursor: pointer;
        margin-right: 20px;
    }
    .empty-project-content-container{
        background-image: url('/images/empty-project.png');
        height: 250px;
        width: 100%;
        position: relative;
    }
    .empty-project-content{
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgb(65, 65, 65, 0.5);
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    
</style>
<div class="container-fluid">
    <div class="row mt-4">
        <div class="col-sm-12" id="project_container">
            <div class="container empty-project-content-container">
                <div class="empty-project-content">
                    <h4 class="text-white text-uppercase d-block">Project</h4>
                    <p class="text-white">Save Your Project Tile Collections And Get a Free Quote</p>
                </div>
            </div>
        </div>
    </div>

    <a 
        href="{{url('')}}/projects/recylebin" 
        class="recylebin-container"
        data-toggle="tooltip"
        data-placement="bottom"
        title="View Recylebin"
        data-original-title="View Recylebin"
    >
        <i class="fa fa-trash" style="color: white; font-size:20px"></i>
    </a>
    
</div>
@include("includes.projects.product-template")
@include("includes.projects.project-template")


<div class="modal fade" id="editProductTagsModal" tabindex="-1" role="dialog" aria-labelledby="editProductTagsModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProductTagsModalTitle">Edit Product Tags</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="edit_project_product_id"/>
            <div class="row">
                <div class="col-sm-12 form-group">
                    <label>Tags</label>
                    <select class="form-control select2" multiple="multiple" id="edit_project_select_tag" style="width: 100%; display: block">
                        <?php $tags = getProjectTags(); ?>
                        @foreach($tags as $tag)
                        <option value="{{ $tag->title }}">{{ $tag->title }}</option>
                        @endforeach
                      </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_edit_product_tags_btn">Close</button>
          <button type="button" class="btn btn-primary" id="submit_edit_product_btn">Submit</button>
        </div>
      </div>
    </div>
</div>


<div class="modal fade" id="cloneProductModal" tabindex="-1" role="dialog" aria-labelledby="cloneProductModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="cloneProductModalTitle">Clone Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="clone_product_project_product_id"/>
            <div class="row">
                <div class="col-sm-12 form-group">
                    <label>Project</label>
                    <div class="w-100">
                        <select class="form-control" id="clone_product_project_select">
                            <option>Select a project</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_clone_product_modal_btn">Close</button>
          <button type="button" class="btn btn-primary" id="clone_product_submit">Clone</button>
        </div>
      </div>
    </div>
  </div>
   
@endsection
@section('script')
<script async src="https://static.addtoany.com/menu/page.js"></script>
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
    
    var sortabelOptions = {
        insertZonePlus: true,
        placeholderCss: {'background-color': 'green'},
        hintCss: {'background-color':'blue'},
        ignoreClass : 'clickable',
        onChange: function( cEl )
        {
            console.log( 'onChange' );
        },
        complete: function( cEl )
        {
            console.log('onComplete');
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

    function getProjectTags(){
        $.ajax({
            type: "get",
            url: "{{ url('') }}" + '/api/client/projects/product/get_tags',
            dataType: "json",
            headers: {
                'Authorization': 'Bearer ' + customerToken,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            success: function(res){
                // console.log(res);
                const tags = res.tags;
                $("#edit_project_select_tag").html("");
                tags.forEach(function(tag){
                    var option = `<option value='${tag.title}'>${tag.title}</option>`;
                    $("#edit_project_select_tag").append(option);
                })
                $("#edit_project_select_tag").select2({
                    tags: true
                });
            },
            error: function(error){
                console.log(error);
            }
        })
    }


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
              
                $(".sortable").sortableLists(sortabelOptions);
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
            $(clone).find(".project-template-li-container").addClass(`project_${project.project.id}`);
            $(clone).find(".project-template-li-container").data("value", "project");
            $(clone).find(".project-title").text(project.project.title);
            $(clone).find(".btn-icon").data("id", project.project.id);
            $(clone).find(".project-template-li-container").data("module", "project");
            $(clone).find(".btn-remove").attr("onclick", "removeProject(this)");
            $(clone).find(".btn-share").attr("onclick", "shareProject(this)");
            var childClone = renderProject(project.children);
            $(clone).find(".project-template-li-container").append(childClone);
            var products = project.products;
            products.forEach(function(product){
                console.log(product);
                const productClone = productTempl.content.cloneNode(true);
                
                $(productClone).find(".product-image").prop("src",product.product.gallary.detail[0].path);
                $(productClone).find(".product-template-container-li").data("module", "product");
                $(productClone).find(".product-template-container-li").prop("id", product.id).addClass(`product_${product.id}`);

                $(productClone).find(".product-template-container-li").data("value", "product");
                $(productClone).find(".product-title").text(product.product.detail[0].title).attr("href", `/product/${product.product.id}/${product.product.product_slug}`);
                $(productClone).find(".product-price").text(product.product.price);
                var tags = product.tags;
                tags.forEach(function(tag){
                    var tagElement = `<span class='badge badge-secondary ml-1'>${tag.tag}</span>`;
                    $(productClone).find('.product-tags').append(tagElement);
                });

                $(productClone).find(".btn-remove").data("id", product.id);
                $(productClone).find(".btn-remove").attr("onclick", "removeProduct(this)");
                $(productClone).find(".btn-edit").data("id", product.id);
                $(productClone).find(".btn-edit").attr("onclick", "editTags(this)");
                $(productClone).find(".btn-edit").attr("data-toggle", 'modal');
                $(productClone).find(".btn-edit").attr("data-target", "#editProductTagsModal");
                $(productClone).find(".btn-clone").data("id", product.id);
                $(productClone).find(".btn-clone").data('slug', product.product.product_slug);
                $(productClone).find(".btn-clone").attr("data-toggle", "modal");
                $(productClone).find(".btn-clone").attr("data-target", "#cloneProductModal");
                $(productClone).find(".btn-clone").attr("onclick", "cloneProject(this)");
                $(productClone).find(".add-to-cart-icon").attr("data-id", product.product_id);
                $(productClone).find(".add-to-cart-icon").attr("onclick", 'showAddToCartModal(this)');

                $(clone).find("ul:first").append(productClone);
            })
            html.append(clone);
        })
        return html;
    }

    function removeProduct(input){
        var confirm = window.confirm("Are you sure?");
        if(!confirm) return;
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
                window.location.reload();
            },
            error: function(error){
                console.log(error);
            }
        });
    }

    function editTags(input){
        var id = $(input).data("id");
        $.ajax({
            type: 'get',
            url: "{{ url('') }}" + '/api/client/projects/product/' + id + "/tags",
            dataType: "json",
            headers: {
                'Authorization': 'Bearer ' + customerToken,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            success: function(res){
                var tags = res.tags.map(function(tag) { return tag.tag});
                $("#edit_project_product_id").val(id);
                $("#edit_project_select_tag").val(tags);
                $("#edit_project_select_tag").trigger('change.select2');

            }
        })
    }

    $("#submit_edit_product_btn").on("click", function(){

        var id = $("#edit_project_product_id").val();
        var tags = $("#edit_project_select_tag").val();

        var $this = $(this);
        if(tags.length === 0 ) return;

        $.ajax({
            type: 'post',
            url: "{{ url('') }}" + '/api/client/projects/product/' + id + "/update",
            dataType: "json",
            headers: {
                'Authorization': 'Bearer ' + customerToken,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            data: {
                tags : tags
            }, 
            success: function(res){
                toastr.success("Product has been updated successfully!");
                $(`.product_${id}`).find('.product-tags').html("");
                tags.forEach(function(tag){
                    var element = `<span class='badge badge-secondary ml-1'>${tag}</span>`;
                    $(`.product_${id}`).find('.product-tags').append(element);
                });
                $("#close_edit_product_tags_btn").trigger("click");
                getProjectTags();
            },
            error: function (error) {
                toastr.error("{{ trans('response.some_thing_went_wrong') }}");
            }
        })
    })

    function cloneProject(input){
        var id = $(input).data("id");
        var slug = $(input).data("slug");
        $("#clone_product_project_product_id").val(id);
        $("#clone_product_project_product_id").data('slug', slug);

    }

    $("#clone_product_submit").on("click", function(){
        var id = $("#clone_product_project_product_id").val();
        var project = $("#clone_product_project_select").val();
        var slug = $("#clone_product_project_product_id").data('slug');
        if(id === "" || id === undefined || project === null || project === "" || project === undefined) return;

        $.ajax({
            type: "post",
            url: "{{ url('') }}" + '/api/client/projects/product/' + id + "/clone",
            dataType: "json",
            headers: {
                'Authorization': 'Bearer ' + customerToken,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            data: {
                project: project
            }, 
            success: function(res){
                const newId = res.id;
                var $clone = $(`.product_${id}`).clone();
                $clone.removeClass(`.product_${id}`).addClass(`.product_${newId}`);
                $clone.attr("id", newId);
                $clone.find(".product-template-container-li").prop("id", newId);
                $clone.find(".product-template-container-li").data("value", "product");
                $clone.find(".product-title").attr("href", `/product/${newId}/${slug}`);
                $clone.find(".btn-remove").data("id", newId);
                $clone.find(".btn-remove").attr("onclick", "removeProduct(this)");
                $clone.find(".btn-edit").data("id", newId);
                $clone.find(".btn-edit").attr("onclick", "editTags(this)");
                $clone.find(".btn-edit").attr("data-toggle", 'modal');
                $clone.find(".btn-edit").attr("data-target", "#editProductTagsModal");
                $clone.find(".btn-clone").data("id", newId);
                $clone.find(".btn-clone").attr("data-toggle", "modal");
                $clone.find(".btn-clone").attr("data-target", "#cloneProductModal");
                $clone.find(".btn-clone").attr("onclick", "cloneProject(this)");
                if($(`.project_${project}`).find("ul:first")){
                    $(`.project_${project}`).find("ul:first").append($clone);
                } else {
                    $(`.project_${project}`).append("ul");
                    $(`.project_${project}`).find("ul:first").append($clone);
                }

                $("#close_clone_product_modal_btn").trigger("click");
                toastr.success("Product has been cloned successfully!");
            },
            error: function(error){
                console.log(error);
                toastr.error("Something went wrong!");
            }
        })


    });

    function shareProject(input){
        var projectId = $(input).data("id");

        $.ajax({
            type: 'post',
            url: "{{ url('') }}" + '/api/client/projects/shareProject',
            dataType: "json",
            headers: {
                'Authorization': 'Bearer ' + customerToken,
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
                clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
            },
            data: {
                project_id : projectId
            },
            success: function(res){
                var $addToAnyElement = $('<div class="a2a_kit a2a_kit_size_32 a2a_default_style share-this"></div>');
                $addToAnyElement.append("<a class='a2a_button_facebook a2a-share-btn'></a>");
                $addToAnyElement.append("<a class='a2a_button_twitter a2a-share-btn'></a>");
                $addToAnyElement.append("<a class='a2a_button_pinterest a2a-share-btn'></a>");
                $addToAnyElement.append("<a class='a2a_button_whatsapp a2a-share-btn'></a>");
                $addToAnyElement.append("<a class='a2a_button_email a2a-share-btn'></a>");
                $addToAnyElement.attr("data-a2a-url", "{{url('')}}/share/projects/" + res.code);
                $addToAnyElement.attr("data-a2a-title", "Project");
                $(`.project_${projectId}`).find(".project-content").find('.actions').prepend($addToAnyElement);
                a2a.init("page");
                $(`.project_${projectId}`).find(".project-content").find('.actions').find(".btn-share").remove();
            },
            error: function(error){
                console.log("Error", error);
            }

        })

    }

    $(document).ready(function(){
        getProjects();
    })
</script>
@endsection