<div class="row item" id="item_{{ $rowIndex }}">
    <div class="mb-3 col-md-9 form-group">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" id="address_{{$rowIndex}}" rows="3" name="multiple_addresses[{{$rowIndex}}][address]"></textarea>
    </div>
    <div class="mb-3 col-md-1 form-check pt-5">
        <input class="form-check-input" type="checkbox" value="1" id="is_default_{{$rowIndex}}" name="multiple_addresses[{{$rowIndex}}][is_default]">
        <label class="form-check-label" for="is_default">
            Mark as Default
        </label>
    </div>
    <div class="mb-3 col-md-1 pt-5 add_more_{{$rowIndex}}" style="display: block;">
        <input type="button" class="btn btn-secondary add_field_button" id="add_more_{{$rowIndex}}" value="Add more">
    </div>
    <div class="mb-3 col-md-1 pt-5 remove_{{$rowIndex}}" style="display: none;">
        <input type="button" class="btn btn-secondary remove_field_button" value="Remove" id="remove_{{$rowIndex}}">
    </div>
</div>
