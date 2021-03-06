
<div class="modal fade" id="createProjectModal" tabindex="-1" role="dialog" aria-labelledby="createProjectModalTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createProjectModalTitle">Add To Project</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-12 form-group">
                    <label>Project Title</label>
                    <input type="text" class="form-control" name="project_name" id="create_project_project_name" />
                </div>
                <div class="col-sm-12 form-group">
                    <label>Parent Project</label>
                    <select class="form-control" id="create_projcet_parent_id">
                        <option value="0">Select a parent project</option>
                    </select>
                </div>

                {{-- <div class="col-sm-12 form-group">
                  <label class="control-lable">Expire at</label>
                  <input type="date" class="form-control" id="create_project_expire_at" />
                </div> --}}
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close_create_project_modal">Close</button>
          <button type="button" class="btn btn-primary" id="create_project_btn">Create Project</button>
        </div>
      </div>
    </div>
  </div>
  