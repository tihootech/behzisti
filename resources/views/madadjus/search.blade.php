<form id="searchbox" class="collapse" autocomplete="off">
	<hr>

	<div class="row justify-content-center">
		<div class="col-md-3 form-group">
			<label for="full-name"> نام یا نام خانوادگی </label>
			<input type="text" class="form-control" id="full-name" name="full_name" value="{{request('full_name')}}">
		</div>
		<div class="col-md-3 form-group">
			<label> کدملی </label>
			<input type="text" class="form-control mx-2" name="national_code" value="{{request('national_code')}}">
		</div>
		<div class="col-md-2 form-group">
			<label for="male"> جنسیت </label>
			<select class="form-control" name="male" id="male">
				<option value=""> -- همه موارد -- </option>
				<option @if( request('male') === '1' ) selected @endif value="1"> مرد </option>
				<option @if( request('male') === '0' ) selected @endif value="0"> زن </option>
			</select>
		</div>
		<div class="col-md-4 form-group">
			<label for="education-grade"> مقطع تحصیلی </label>
			<select class="select2" name="education_grade[]" id="education-grade" multiple>
				<option @if(is_array(request('education_grade')) && in_array('دیپلم', request('education_grade'))) selected @endif > دیپلم </option>
				<option @if(is_array(request('education_grade')) && in_array('فوق دیپلم', request('education_grade'))) selected @endif > فوق دیپلم </option>
				<option @if(is_array(request('education_grade')) && in_array('لیسانس', request('education_grade'))) selected @endif > لیسانس </option>
				<option @if(is_array(request('education_grade')) && in_array('فوق لیسانس', request('education_grade'))) selected @endif > فوق لیسانس </option>
				<option @if(is_array(request('education_grade')) && in_array('دکتری', request('education_grade'))) selected @endif > دکتری </option>
			</select>
		</div>
		<div class="col-md-3 form-group">
			<label for="education-field-search"> رشته تحصیلی </label>
			<input type="text" class="form-control" id="education-field-search" name="education_field" value="{{request('education_field')}}">
		</div>
		<div class="col-md-3 form-group">
			<label for="education-subfield-search"> گرایش تحصیلی </label>
			<input type="text" class="form-control" id="education-subfield-search" name="education_subfield" value="{{request('education_subfield')}}">
		</div>
	</div>

	<hr>
	<div class="text-center">
		<a href="{{url("madadju")}}" class="btn btn-warning mx-1"> <i class="fa fa-times ml-1"></i> لغو جستجو </a>
		<button type="submit" class="btn btn-primary mx-1"> <i class="fa fa-search ml-1"></i> جستجو </button>
	</div>
</form>
