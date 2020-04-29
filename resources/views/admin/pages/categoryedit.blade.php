<div class="modal fade" id="editCategoryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="frmEditCategory">
                <div class="modal-header">
                    <h4 class="modal-title">
                        {{ trans('page.edit') }}
                    </h4>
                    <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                        {{ trans('page.x') }}
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id="edit-error-bag">
                        <ul id="edit-task-errors">
                        </ul>
                    </div>
                    <div class="form-group">
                        <label>
                            {{ trans('page.name') }}
                        </label>
                        <input class="form-control" id="task" name="name" required="" type="text">
                        </input>
                    </div>
                    <div class="form-group">
                        <label>
                            {{ trans('page.description') }}
                        </label>
                        <input class="form-control" id="description" name="description" required="" type="text">
                        </input>
                    </div>
                    <div class="form-group">
                        <label>
                            {{ trans('page.parent') }}
                        </label>
                        <select name="parent_id" >
                            <option value="{{ $category->parent_id }}">{{ $category->name }}</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        </input>
                    </div>
                </div>
                <div class="modal-footer">
                    <input id="category_id" name="id" type="hidden" value="0">
                        <button class="btn btn-info" id="btn-edit" type="button" value="add">
                            {{ trans('page.save') }}
                        </button>
                        </input>
                    </input>
                </div>
            </form>
        </div>
    </div>
</div>
