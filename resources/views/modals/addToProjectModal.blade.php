
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
            <input type="hidden" name="add_to_project_product_id" id="add_to_project_product_id"/>
            <div class="row">
                <div class="col-sm-12 form-group">
                    <label>Project</label>
                    <div class="w-100">
                        <select class="form-control" id="add_to_project_select_project">
                            <option>Select a project</option>
                        </select>
                    </div>
                    <p class="mt-2 text-right mb-0 d-flex justify-content-between">Can't you find the project? <a data-toggle="modal" data-target="#createProjectModal" href="#">Create Project</a></p>
                </div>
                <div class="col-sm-12 form-group">
                    <label>Tags</label>
                    <select class="form-control select2" multiple="multiple" id="add_to_project_select_tag" style="width: 100%; display: block">
                        <?php $tags = getProjectTags(); ?>
                        @foreach($tags as $tag)
                        <option value="{{ $tag->title }}">{{ $tag->title }}</option>
                        @endforeach
                      </select>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_add_to_project_btn">Close</button>
          <button type="button" class="btn btn-primary" id="add_to_project_btn">Add to Project</button>
        </div>
      </div>
    </div>
  </div>
  