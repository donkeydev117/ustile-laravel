
<style>
    .variation-title{
        font-size: 12px;
    }
    .variation-price {
        font-weight: 700
    }
    .variation-checkbox{
        position: relative !important;
    }
</style>
<div class="modal fade" id="addToCartModal" tabindex="-1" role="dialog" aria-labelledby="addToCartModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addToCartModalTitle">Add To Cart</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="add_to_cart_modal_content">
            <input type="hidden" name="add_to_cart_product_id" id="add_to_cart_product_id"/>
            <template id="shopping-cart-modal-item-content-template">
                <div class="row align-items-center mt-2 variation-container" >
                    <div class="col-sm-1">
                        <div class="form-check">
                            <input class="form-check-input mt-0 variation-checkbox" type="checkbox" value=""">
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <img src="" class="variation-image w-100" />
                    </div>
                    <div class="col-sm-6">
                        <label class="control-label variation-title mb-0">Default checkbox</label>
                        <label class="control-label variation-price"></label>
                    </div>
                    <div class="col-sm-2">
                        <div class="form-group mb-0">
                            <input type="number" step="1" class="form-control qty" value="0" />
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_to_shopping_cart_btn">Close</button>
          <button type="button" class="btn btn-primary" id="add_to_shopping_cart_btn">Add to Cart</button>
        </div>
      </div>
    </div>
  </div>
  