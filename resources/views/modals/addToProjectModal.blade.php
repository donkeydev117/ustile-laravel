
<div class="modal fade" id="addToProjectModal" tabindex="-1" role="dialog" aria-labelledby="addToProjectModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addToProjectModalTitle">Add To Project</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" name="add_to_project_product_id" />
            <div class="row">
                <div class="col-sm-12 form-group">
                    <label>Project</label>
                    <div class="w-100">
                        <ul id="add_to_project_select_project">
                            <li>Item 1</li>
                            <li data-dropdown-text="Item 2">
                                <ul>
                                    <li data-dropdown-text="Item 2.1">
                                        <ul>
                                            <li>Item 2.1.1</li>
                                            <li>Item 2.1.2</li>
                                            <li>Item 2.1.3</li>
                                        </ul>
                                    </li>
                                    <li data-dropdown-text="Item 2.2">
                                        <ul>
                                            <li>Item 2.2.1</li>
                                            <li>Item 2.2.2</li>
                                            <li>Item 2.2.3</li>
                                        </ul>
                                    </li>
                                    <li data-dropdown-text="Item 2.3">
                                        <ul>
                                            <li>Item 2.3.1</li>
                                            <li>Item 2.3.2</li>
                                            <li>Item 2.3.3</li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>Item 3</li>
                        </ul>
                    </div>
                    <p class="mt-2 text-right mb-0 d-flex justify-content-between">Can't you find the project? <a data-toggle="modal" data-target="#createProjectModal" href="#">Create Project</a></p>
                </div>
                <div class="col-sm-12 form-group">
                    <label>Tags</label>
                    <select class="form-control" multiple="multiple" id="add_to_project_select_tag" style="width: 100%; display: block">
                        <?php $tags = getProjectTags(); ?>
                        @foreach($tags as $tag)
                        <option value="{{ $tag->title }}">{{ $tag->title }}</option>
                        @endforeach
                      </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Add to Project</button>
        </div>
      </div>
    </div>
  </div>
  