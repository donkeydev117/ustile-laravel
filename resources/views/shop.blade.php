@extends('layouts.master')
@section('content')

@include('includes.shop.shop')

<link rel="stylesheet" type="text/css" href="/assets/front/css/toggle-switch.css">
<style>
  .variation_active{
    border: 1px solid;
  }
  .price-active{
    border: 1px solid;
  }
</style>
@endsection
@section('script')
<script>
  var language_id = localStorage.getItem('languageId');
  var attribute_id = [];
  var attribute = [];
  var variation_id = [];
  var variation =[];
  var sortBy = "";
  var sortType = "";
  var priceFromSidebar = "{{ isset($_GET['price']) ? $_GET['price']:'' }}";
  var shopStyle = "{{ getSetting()['shop'] }}";
  $(document).ready(function() {
    fetchProduct(1);
    $(".variaion-filter").each(function() {
      if($(this).val() != ""){
        attribute_id.push($(this).attr('data-attribute-id'));
        variation_id.push($(this).val());
        attribute.push($(this).attr('data-attribute-name'));
        variation.push($('option:selected', this).attr('data-variation-name'));
      }
    });

    $(".filter-item").on("click", function(){
      var id = $(this).data("id");
      var filter = $(this).data('filter');
      $(this).toggleClass("filter-selected");
      fitlerProducts();
    })
  });

  $('.sortBy').change(function(){
    sortBy = $('option:selected', this).attr('data-sort-by')
    sortType = $('option:selected', this).attr('data-sort-type')
    $(".shop_page_product_card").html('');
    fetchProduct(1);
  })

  function showProductQuickViewOrAddCompare(input, show="show"){
    const product_type = $.trim($(input).attr('data-type'));
    const product_id = $.trim($(input).attr('data-id'));
    $(".quick-view-right-menu").html("");
    $.ajax({
      type: 'get',
      url: "{{ url('') }}" + '/api/client/products/' + product_id +
          '?getCategory=1&getDetail=1&language_id=' + languageId + '&currency=' + localStorage.getItem(
              "currency"),
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          clientid: "{{ isset(getSetting()['client_id']) ? getSetting()['client_id'] : '' }}",
          clientsecret: "{{ isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : '' }}",
      },
      beforeSend: function() {},
      success: function(data) {
        if (data.status == 'Success') {
          const templ = document.getElementById("product-quick-view-item-template");
          const clone = templ.content.cloneNode(true);
          if (data.data.product_gallary != null && data.data.product_gallary != 'null' && data.data.product_gallary != '') {
            if (data.data.product_gallary.detail != null && data.data.product_gallary.detail !=
                'null' && data.data.product_gallary.detail != '') {
                clone.querySelector(".quick-view-image").setAttribute('src', data.data.product_gallary.detail[1].gallary_path);
                clone.querySelector(".quick-view-image").setAttribute('rel', 'lightbox');
                clone.querySelector(".quick-view-image-lightbox").setAttribute('href', data.data.product_gallary.detail[1].gallary_path);
                clone.querySelector(".quick-view-image-lightbox").setAttribute('data-lightbox', data.data.product_gallary.gallary_name);
                clone.querySelector(".quick-view-image-lightbox").setAttribute('rel', 'lightbox');
                // $(clone).find(".quick-view-image-lightbox").lightbox();
                console.log(data.data.product_gallary_detail);
            }
          }
          if (data.data.detail != null && data.data.detail != 'null' && data.data.detail != '') {
              clone.querySelector(".quick-view-image").setAttribute('alt', data.data.detail[0].title);
          }
          if (data.data.category != null && data.data.category != 'null' && data.data.category !='') {
              for (j = 0; j < data.data.category.length; j++) {
                  if (data.data.category[j].category_detail != null && data.data.category[j].category_detail != 'null' && data.data.category[j].category_detail != '') {
                      if (data.data.category[j].category_detail.detail != null && data.data.category[j].category_detail.detail != 'null' && data.data.category[j].category_detail.detail != '') {
                          clone.querySelector(".quick-view-categories").innerHTML ='<li><a href="javascript:void(0)">' + data.data.category[j].category_detail.detail[0].name + '</a></li>';
                      }
                  }
              }
          }
          if (data.data.detail != null && data.data.detail != 'null' && data.data.detail != '') {
              clone.querySelector(".product-quick-view-title").innerHTML = data.data.detail[0].title;
              clone.querySelector(".product-quick-view-description").innerHTML = data.data.detail[0].desc.replace(/<\/?[^>]+>/gi, '').substring(0,250)
          }
          clone.querySelector('.product-quick-view-price').innerHTML=data.data.product_price_symbol;
          clone.querySelector(".product-quick-view-product-id").value = data.data.product_id;
          clone.querySelector(".product-quick-view-product-id").classList.add("product-id-" + data.data.product_id);
          var detailLink = "";
          if(data.data.variations.length  === 0){
            detailLink = '/product/' + data.data.product_id+'/'+data.data.product_slug;
          } else if(data.data.primary_variation.length === 0){
            detailLink = '/product/' + data.data.product_id+'/'+data.data.product_slug + "/variation/" + data.data.variations[0].id;
          } else {
            detailLink = '/product/' + data.data.product_id+'/'+data.data.product_slug + "/variation/" + data.data.primary_variation[0].id;
          }
          clone.querySelector(".product-quick-view-detail-link").setAttribute("href", detailLink);

          if(data.data.is_featured == "1"){
            $(clone).find(".product-quick-view-features-container").append('<span class="badge badge-success ml-2">featured</span>');
          }
          if(data.data.made_in_usa == "1"){
            $(clone).find('.product-quick-view-features-container').append('<span class="badge badge-danger ml-2">Made in USA</span>');
          }
          const shipping_status = data.data.shipping_status;
          shipping_status.forEach(function(item, index){
            $(clone).find(".product-quick-view-features-container").append(`<span class='badge badge-info ml-2'>${item.status.name}</span>`);
          })

          if(show == "show"){
            $(".right-menu-content").addClass("d-none");
            const compare_content = $(clone).clone();
            $(".quick-view-right-menu").html(clone).removeClass("d-none");
            $(".compare-view-right-menu").html(compare_content);
            $("#switch-quick-view-view").prop("checked", "checked");
            $("#right-menu-switch-container").removeClass("d-none");
          } else if(show == "compare"){
            $(".right-menu-content").addClass("d-none");
            if($(".compare-view-right-menu").find(".product-id-" + data.data.product_id).length == 0){
              $(".compare-view-right-menu").append(clone);
            }
            $(".compare-view-right-menu").removeClass("d-none");
            $("#switch-quick-view-compare").prop("checked", "checked");
          }
        }
      }
    });
  }

  $("#switch-quick-view-filter-label").on("click", function(){
    $("#switch-quick-filter-view").prop("checked", "checked");
    $(".quick-view-right-menu").addClass("d-none");
    $(".compare-view-right-menu").addClass("d-none");
    $(".filter-view-right-menu").removeClass("d-none");
  });

  $("#switch-quick-view-view-label").on("click", function(){
    $("#switch-quick-view-view").prop("checked", "checked");
    $(".filter-view-right-menu").addClass("d-none");
    $(".compare-view-right-menu").addClass("d-none");
    $(".quick-view-right-menu").removeClass("d-none");

  });

  $("#switch-quick-view-compare-label").on("click", function(){
    $("#switch-quick-compare-view").prop("checked", "checked");
    $(".filter-view-right-menu").addClass("d-none");
    $(".quick-view-right-menu").addClass("d-none");
    $(".compare-view-right-menu").removeClass("d-none");

  });



  function fetchProduct(page){
    var limit = "{{ isset($_GET['limit']) ? $_GET['limit']:'12' }}";
    var category = "{{ isset($_GET['category']) ? $_GET['category'] :"" }}";
    var varations = "{{ isset($_GET['variation_id']) ? $_GET['variation_id'] :"" }}";
    var price_range = "{{ isset($_GET['price']) ? $_GET['price'] :"" }}";

    var url = "{{ url('') }}"+'/api/client/products?page='+page+'&limit='+limit+'&getDetail=1&language_id='+language_id+'&currency='+localStorage.getItem("currency");

    if(category != "")
        url += "&productCategories="+category;   
    if(varations != "")
        url += "&variations="+varations;
    if(price_range != ""){
        price_range = price_range.split("-");
        url += "&price_from="+price_range[0];
        url += "&price_to="+price_range[1];
    }

    if(sortBy != "" && sortType != "")
        url += "&sortBy="+sortBy+"&sortType="+sortType;
    var searchinput = "{{ isset($_GET['search']) ? $_GET['search']:'' }}";
    if(searchinput != "")
      url +=  "&searchParameter="+searchinput;
    var appendTo = 'shop_page_product_card';
    $.ajax({
      type: 'get',
      url: url,
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        clientid: "{{isset(getSetting()['client_id']) ? getSetting()['client_id'] : ''}}",
        clientsecret: "{{isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : ''}}",
      },
      beforeSend: function() {},
      success: function(data) {
        if (data.status == 'Success') {
          console.log("products:", data.data);
          
          const templ = document.getElementById("product-card-template");
          for (i = 0; i < data.data.length; i++) {
            const clone = templ.content.cloneNode(true);
            // clone.querySelector(".single-text-chat-li").classList.add("bg-blue-100");
            var detailLink = "";
            if(data.data[i].variations.length  === 0){
              detailLink = '/product/' + data.data[i].product_id+'/'+data.data[i].product_slug;
            } else if(data.data[i].primary_variation.length === 0){
              detailLink = '/product/' + data.data[i].product_id+'/'+data.data[i].product_slug + "/variation/" + data.data[i].variations[0].id;
            } else {
              detailLink = '/product/' + data.data[i].product_id+'/'+data.data[i].product_slug + "/variation/" + data.data[i].primary_variation[0].id;
            }
            clone.querySelector(".div-class").classList.add('col-12');
            clone.querySelector(".div-class").classList.add('col-lg-4');
            clone.querySelector(".div-class").classList.add('col-md-4');
            clone.querySelector(".div-class").classList.add("col-sm-6");
            clone.querySelector(".div-class").classList.add('griding');
            clone.querySelector(".wishlist-icon").setAttribute('data-id', data.data[i].product_id);
            clone.querySelector(".wishlist-icon").setAttribute('data-type', data.data[i].product_type);
            clone.querySelector(".compare-icon").setAttribute('data-id', data.data[i].product_id);
            clone.querySelector(".compare-icon").setAttribute('data-type', data.data[i].product_type);
            clone.querySelector(".quick-view-icon").setAttribute('data-id', data.data[i].product_id);
            clone.querySelector(".wishlist-icon").setAttribute('onclick', 'addWishlist(this)');
            clone.querySelector(".compare-icon").setAttribute('onclick', 'showProductQuickViewOrAddCompare(this, "compare")');
            clone.querySelector(".quick-view-icon").setAttribute('onclick', 'showProductQuickViewOrAddCompare(this, "show")');
            clone.querySelector(".project-icon").setAttribute('data-id', data.data[i].product_id);
            clone.querySelector(".project-icon").setAttribute('onclick', 'showAddToProjectModal(this)');
            clone.querySelector(".add-to-cart-icon").setAttribute('data-id', data.data[i].product_id);
            clone.querySelector('.add-to-cart-icon').setAttribute('onclick', 'showAddToCartModal(this)');
            clone.querySelector('.add-to-cart-link').setAttribute('data-id', data.data[i].product_id);
            clone.querySelector('.add-to-cart-link').setAttribute('onclick', 'showAddToCartModal(this)');


            if (data.data[i].product_gallary != null) {
              if (data.data[i].product_gallary.detail != null) {
                clone.querySelector(".product-card-image").setAttribute('src', data.data[i].product_gallary.detail[0].gallary_path);
              }
            }
            if (data.data[i].detail != null) {
              clone.querySelector(".product-card-image").setAttribute('alt', data.data[i].detail[0].title);
            }
            if (data.data[i].category != null) {
              if (data.data[i].category[0].category_detail.detail != null) {
                clone.querySelector(".product-card-category").innerHTML = data.data[i].category[0].category_detail.detail[0].name;
              }
            }
            if (data.data[i].detail != null) {
              clone.querySelector(".product-card-name").innerHTML = data.data[i].detail[0].title;
              clone.querySelector(".product-card-name").setAttribute('href', detailLink);
                var desc = data.data[i].detail[0].desc;
              // clone.querySelector(".product-card-desc").innerHTML = desc.substring(0, 50);
            }

              if (data.data[i].product_type == 'simple') {
                  if (data.data[i].product_discount_price == '' || data.data[i]
                      .product_discount_price == null || data.data[i].product_discount_price ==
                      'null') {
                      clone.querySelector(".product-card-price").innerHTML = data.data[i]
                          .product_price_symbol;
                  } else {
                    
                      clone.querySelector(".product-card-price").innerHTML = data.data[i]
                                        .product_discount_price_symbol + '<span>' +data.data[i].product_price_symbol + '</span>';
                  }
              } else {
                  if (data.data[i].product_combination != null && data.data[i]
                      .product_combination != 'null' && data.data[i].product_combination != '') {
                      clone.querySelector(".product-card-price").innerHTML = data.data[i]
                          .product_combination[0].product_price_symbol;
                  }
              }

              if (data.data[i].product_type == 'simple') {
                  clone.querySelector(".product-card-link").setAttribute('onclick', "addToCart(this)");
                  clone.querySelector(".product-card-link").setAttribute('data-id', data.data[i].product_id);
                  clone.querySelector(".product-card-link").setAttribute('data-type', data.data[i].product_type);
                  clone.querySelector(".product-card-link").innerHTML = 'Add To Cart';
              }
              else{
                  clone.querySelector(".product-card-link").setAttribute('href', detailLink);
              }
            
            $("."+appendTo).append(clone);
          }

          if(data.meta.last_page == 1 || data.meta.last_page < page){
              $(".pagination").css('display', 'none');
            return;
          }
          var nextPage = parseInt(data.meta.current_page)+1;
          var pagination = `<a href="javascript:void(0)" class="load-more-products" data-page="${nextPage}">
            <img src="/images/arrow-bottom.png">
            <span class="d-block">View More</span>
          </a>`;

          $('.pagination').html(pagination);
        }
      },
      error: function(data) {},
    });
  }

  function fitlerProducts(){
    var filterOptions = {};
    $(".filter-selected").each(function(){
      var option = $(this).data("filter");
      var value = $(this).data("id");
      filterOptions[option] = filterOptions[option] ? [...filterOptions[option], value] : [value];
    });

    $.ajax({
      type: "post",
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        clientid: "{{isset(getSetting()['client_id']) ? getSetting()['client_id'] : ''}}",
        clientsecret: "{{isset(getSetting()['client_secret']) ? getSetting()['client_secret'] : ''}}",
      },
      url: "{{ url('') }}"+'/api/client/products',
      data: filterOptions,
      dataType: "json",
      success: function(data){
        var appendTo = 'shop_page_product_card';
        $("."+appendTo).html("");
        $(".pagination").html("");
        const templ = document.getElementById("product-card-template");
        for (i = 0; i < data.data.length; i++) {
          const clone = templ.content.cloneNode(true);
          clone.querySelector(".div-class").classList.add('col-12');
          if(shopStyle.split('style')[1] == 1)
            clone.querySelector(".div-class").classList.add('col-lg-3');
          else
            clone.querySelector(".div-class").classList.add('col-lg-4');
            clone.querySelector(".div-class").classList.add('col-md-6');
            clone.querySelector(".div-class").classList.add('griding');
            clone.querySelector(".wishlist-icon").setAttribute('data-id', data.data[i].product_id);
            clone.querySelector(".wishlist-icon").setAttribute('data-type', data.data[i].product_type);
            clone.querySelector(".compare-icon").setAttribute('data-id', data.data[i].product_id);
            clone.querySelector(".compare-icon").setAttribute('data-type', data.data[i].product_type);
            clone.querySelector(".quick-view-icon").setAttribute('data-id', data.data[i].product_id);
            clone.querySelector(".wishlist-icon").setAttribute('onclick', 'addWishlist(this)');
            clone.querySelector(".compare-icon").setAttribute('onclick', 'showProductQuickViewOrAddCompare(this, "compare")');
            clone.querySelector(".quick-view-icon").setAttribute('onclick', 'showProductQuickViewOrAddCompare(this, "show")');

          if (data.data[i].product_gallary != null) {
            if (data.data[i].product_gallary.detail != null) {
              clone.querySelector(".product-card-image").setAttribute('src', data.data[i].product_gallary.detail[0].gallary_path);
            }
          }
          if (data.data[i].detail != null) {
            clone.querySelector(".product-card-image").setAttribute('alt', data.data[i].detail[0].title);
          }
          if (data.data[i].category != null) {
            if (data.data[i].category[0].category_detail.detail != null) {
              clone.querySelector(".product-card-category").innerHTML = data.data[i].category[0].category_detail.detail[0].name;
            }
          }
          if (data.data[i].detail != null) {
            var detailLink = "";
            if(data.data[i].variations.length  === 0){
              detailLink = '/product/' + data.data[i].product_id+'/'+data.data[i].product_slug;
            } else if(data.data[i].primary_variation.length === 0){
              detailLink = '/product/' + data.data[i].product_id+'/'+data.data[i].product_slug + "/variation/" + data.data[i].variations[0].id;
            } else {
              detailLink = '/product/' + data.data[i].product_id+'/'+data.data[i].product_slug + "/variation/" + data.data[i].primary_variation[0].id;
            }
            clone.querySelector(".product-card-name").innerHTML = data.data[i].detail[0].title;
            clone.querySelector(".product-card-name").setAttribute('href', detailLink);
              var desc = data.data[i].detail[0].desc;
            // clone.querySelector(".product-card-desc").innerHTML = desc.substring(0, 50);
          }

          if (data.data[i].product_type == 'simple') {
              if (data.data[i].product_discount_price == '' || data.data[i]
                  .product_discount_price == null || data.data[i].product_discount_price ==
                  'null') {
                  clone.querySelector(".product-card-price").innerHTML = data.data[i]
                      .product_price_symbol;
              } else {
                
                  clone.querySelector(".product-card-price").innerHTML = data.data[i]
                                    .product_discount_price_symbol + '<span>' +data.data[i].product_price_symbol + '</span>';
              }
          } else {
              if (data.data[i].product_combination != null && data.data[i]
                  .product_combination != 'null' && data.data[i].product_combination != '') {
                  clone.querySelector(".product-card-price").innerHTML = data.data[i]
                      .product_combination[0].product_price_symbol;
              }
          }

          if (data.data[i].product_type == 'simple') {
              clone.querySelector(".product-card-link").setAttribute('onclick', "addToCart(this)");
              clone.querySelector(".product-card-link").setAttribute('data-id', data.data[i].product_id);
              clone.querySelector(".product-card-link").setAttribute('data-type', data.data[i].product_type);
              clone.querySelector(".product-card-link").innerHTML = 'Add To Cart';
          }
          else{
              clone.querySelector(".product-card-link").setAttribute('href', '/product/' + data.data[i].product_id+'/'+data.data[i].product_slug);
          }
            
          $("."+appendTo).append(clone);
        }

        if(data.data.length == 0){
          var empty = "<p class='text-center w-100'>No tiles.</p>";
          $("."+appendTo).html(empty);
        }
      }
    })

  }


  var limit = "{{ isset($_GET['limit']) ? $_GET['limit']:'12' }}";
  var shopRedirecturl = "{{ url('/shop') }}"+'?limit='+limit;
  $('.category-filter').change(function(){
    $(this).attr('selected',true);
  })
  $('.price-filter').change(function(){
    $(this).attr('selected',true);
  })  

  $('.variaion-filter').on('change',function(){

    if(attribute_id.indexOf($(this).attr('data-attribute-id')) === -1 ){
      attribute_id.push($(this).attr('data-attribute-id'));
      variation_id.push($(this).val());
      attribute.push($(this).attr('data-attribute-name'));
      variation.push($('option:selected', this).attr('data-variation-name'));
    }else{
      
      var index = attribute_id.indexOf($(this).attr('data-attribute-id'));
      if($(this).val() == ""){
        attribute_id.splice(index, 1);
        variation_id.splice(index, 1);
        attribute.splice(index, 1);
        variation.splice(index, 1);
      }else{
        attribute_id[index] = $(this).attr('data-attribute-id');
        variation_id[index] = $(this).val();
        attribute[index] = $(this).attr('data-attribute-name');
        variation[index] = $('option:selected', this).attr('data-variation-name');
      }
      
    }
    
    
  })

  $('.price-range-list').on('click',function(){
    var price_range = $(this).attr('data-price-range');
    $('.price-range-list').each(function(){
      $('.price-range-list').removeClass( "price-active" );
    })
    $('.price-range-list'+'-'+price_range).addClass( "price-active" );
    priceFromSidebar = price_range;
  });

  $('.variation_list_item').on('click',function(){
    var variation_name = $(this).attr('data-variation-name');
    var attribute_name = $(this).attr('data-attribute-name').split(' ').join('_');

    $('.attribute_'+attribute_name+'_div').each(function(){
      $('.attribute_'+attribute_name+'_div').removeClass( "variation_active" );
    })

    $('.'+variation_name+'-'+attribute_name).addClass( "variation_active" );

    if(attribute_id.indexOf($(this).attr('data-attribute-id')) === -1 ){
      attribute_id.push( $(this).attr('data-attribute-id') );
      attribute.push( $(this).attr('data-attribute-name') );
      variation_id.push( $(this).attr('data-variation-id') );
      variation.push( $(this).attr('data-variation-name') );
    
    }else{
      
      var index = attribute_id.indexOf($(this).attr('data-attribute-id'));
      if($(this).attr('data-variation-id') == ""){
        attribute_id.splice(index, 1);
        variation_id.splice(index, 1);
        attribute.splice(index, 1);
        variation.splice(index, 1);
      }else{
        attribute_id[index] = $(this).attr('data-attribute-id');
        variation_id[index] = $(this).attr('data-variation-id');
        attribute[index] = $(this).attr('data-attribute-name');
        variation[index] = $(this).attr('data-variation-name');
      }
      
    }
  })

  $('#filter').click(function(e){
    e.preventDefault();

      filter();
  })

  $('.filter-from-sidebar').click(function(){
    filter();
  })

  function filter(){
    var limit = "{{ isset($_GET['limit']) ? $_GET['limit']:'12' }}";
    var searchinput = "{{ isset($_GET['search']) ? $_GET['search']:'' }}";

    if($('.category-filter').val() != "" && $('.category-filter').val() != undefined){
      shopRedirecturl += "&category="+$('.category-filter').val() ;
    }
    if($('.price-filter').val() != "" && $('.price-filter').val() != undefined){
      shopRedirecturl += "&price="+$('.price-filter').val() ;
    }else if(priceFromSidebar != ""){
      shopRedirecturl += "&price="+priceFromSidebar;
    }

    if(searchinput != "")
    shopRedirecturl +=  "&searchParameter="+searchinput;
    if(variation_id.length > 0)
      shopRedirecturl += "&attribute="+attribute;
    if(variation_id.length > 0)
      shopRedirecturl += "&variation="+variation;
    if(variation_id.length > 0)
      shopRedirecturl += "&attribute_id="+attribute_id;  
    if(variation_id.length > 0)
      shopRedirecturl += "&variation_id="+variation_id;
    window.location.href = shopRedirecturl;
  }

  $(document).on('click','.load-more-products',function(){
    var pageToLoad = $(this).attr('data-page');
    fetchProduct(pageToLoad);
  })


</script>
@endsection