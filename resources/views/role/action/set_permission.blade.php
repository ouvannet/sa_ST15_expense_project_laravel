<?php 
    function permission_in_role($permission_id,$permission_role){
        foreach ($permission_role as $pr) {
            if ($pr['permission_id'] == $permission_id) {
                return true;
                break;
            }
        }
        return false;
    }
?>
<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="addExpenseLabel">Set Permission</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form id="setPermissionRoleForm">
                @csrf
                <input type="hidden" name="role_id" value="{{$role_id}}">
                <div class="row">
                    <!-- Budget -->
                    @foreach ($permission as $per)
                        <div class="col-md-6 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" name="permission_id[]" value="{{$per->id}}" type="checkbox" role="switch" id="flexSwitchCheckChecked" {{permission_in_role($per->id,$permission_role)?'checked':''}}>
                                <label class="form-check-label" for="flexSwitchCheckChecked">{{$per->name}}</label>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="text-end">
                    <button id="btn_submit_set_permission_role" type="button" class="btn btn-success">Set Permission</button>
                </div>
            </form>
        </div>
    </div>
</div>