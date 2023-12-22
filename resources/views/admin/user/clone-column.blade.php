<div class="row item" id="item_{{ $rowIndex }}">
    <div class="mb-3 col-md-9 form-group">
        <label for="address" class="form-label">Address</label>
        <textarea class="form-control" id="address_{{$rowIndex}}" name="multiple_addresses[{{$rowIndex}}][address]"> 
            {{ old("multiple_addresses.$rowIndex.address", isset($oldAddress['address']) ? $oldAddress['address'] : '') }}
        </textarea>
        @error("multiple_addresses.$rowIndex.address")
            <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    <div class="mb-3 col-md-1 form-check pt-5">
        <input class="form-check-input" type="radio" id="is_default_{{$rowIndex}}" name="is_default" value="{{$rowIndex}}"
        @if (old("multiple_addresses.$rowIndex.is_default", isset($oldAddress['is_default']) && $oldAddress['is_default'] == 1)) checked @endif>
        <label class="form-check-label" for="is_default">
            Mark as Default
        </label>
    </div>
    @if(isset($totalItem) &&  $totalItem == $rowIndex)
        <div class="mb-3 col-md-1 pt-5 add_more_btn" id="add_more_btn_{{$rowIndex}}">
            <input type="button" class="btn btn-secondary add_field_button"  id="add_more_{{$rowIndex}}" value="Add more" style="display: block;">
        </div>
        <div class="mb-3 col-md-1 pt-5 remove_btn" id="remove_btn_{{$rowIndex}}">
            <input type="button" class="btn btn-secondary remove_field_button" value="Remove" id="remove_{{$rowIndex}}" style="display: block;">
        </div>
    @elseif(isset($totalItem))
        <div class="mb-3 col-md-1 pt-5 remove_btn" id="remove_btn_{{$rowIndex}}">
            <input type="button" class="btn btn-secondary remove_field_button" value="Remove" id="remove_{{$rowIndex}}" style="display: block;">
        </div>
    @else
        <div class="mb-3 col-md-1 pt-5 add_more_btn" id="add_btn_more_{{$rowIndex}}">
            <input type="button" class="btn btn-secondary add_field_button" id="add_more_{{$rowIndex}}" value="Add more"  style="display: block;">
        </div>
        <div class="mb-3 col-md-1 pt-5 remove_btn" id="remove_btn_{{$rowIndex}}">
            <input type="button" class="btn btn-secondary remove_field_button" value="Remove" id="remove_{{$rowIndex}}"  style="display: none;">
        </div>
    @endif
</div>