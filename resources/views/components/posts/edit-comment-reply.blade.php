    <div class="alert js-alert margin-bottom-lg" role="alert"> <!-- /.alert--is-visible -->
      <div class="flex items-center justify-between">
        <div class="flex items-center">
          <svg aria-hidden="true" class="icon margin-right-xxxs" viewBox="0 0 32 32" ><title>info icon</title><g><path d="M16,0C7.178,0,0,7.178,0,16s7.178,16,16,16s16-7.178,16-16S24.822,0,16,0z M18,7c1.105,0,2,0.895,2,2 s-0.895,2-2,2s-2-0.895-2-2S16.895,7,18,7z M19.763,24.046C17.944,24.762,17.413,25,16.245,25c-0.954,0-1.696-0.233-2.225-0.698 c-1.045-0.92-0.869-2.248-0.542-3.608l0.984-3.483c0.19-0.717,0.575-2.182,0.036-2.696c-0.539-0.514-1.794-0.189-2.524,0.083 l0.263-1.073c1.054-0.429,2.386-0.954,3.523-0.954c1.71,0,2.961,0.855,2.961,2.469c0,0.151-0.018,0.417-0.053,0.799 c-0.066,0.701-0.086,0.655-1.178,4.521c-0.122,0.425-0.311,1.328-0.311,1.765c0,1.683,1.957,1.267,2.847,0.847L19.763,24.046z"></path></g></svg>
          <div class="alert-message"></div><!-- /.alert-message -->
        </div>
      </div>
    </div>

    <div class="margin-top-md">
      <label class="margin-bottom-sm">Description</label>
      <textarea class="form-control width-100% margin-top-sm" type="text" name="description" id="description" cols="10" rows="15" @error('description') aria-invalid="true" @enderror>{!!$comments->content!!}</textarea>
      <div role="alert" class="form-error-msg"></div> <!-- /.form-error-msg--is-visible -->
    </div>


    
    
