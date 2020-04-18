@extends('layouts.dashboard')
@section('main')

	<div class="text-left">
		<a href="{{url("madadju")}}" class="btn btn-outline-primary">
			<i class="fa fa-users ml-1"></i>
			لیست مددجویان
		</a>
	</div>
	<hr>

	<div class="tile">
		<form class="row justify-content-center" action="{{url("madadju/$madadju->id")}}" method="post" autocomplete="off">

			@if ($madadju->id)
				@method('PUT')
			@endif
			@csrf

			<h5 class="col-12 text-info mb-4"> <i class="fa fa-address-book-o ml-1"></i> اطلاعات شخصی </h5>

			<div class="col-md-3 form-group">
				<label for="state"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> استان </label>
				<input type="text" class="form-control" id="state" name="state" value="{{old('state') ?? $madadju->state}}" required>
			</div>

			<div class="col-md-3 form-group">
				<label for="city"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> شهرستان </label>
				<input type="text" class="form-control" id="city" name="city" value="{{old('city') ?? $madadju->city}}" required>
			</div>

			<div class="col-md-3 form-group">
				<label for="first-name"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> نام </label>
				<input type="text" class="form-control" id="first-name" name="first_name" value="{{old('first_name') ?? $madadju->first_name}}" required>
			</div>

			<div class="col-md-3 form-group">
				<label for="last-name"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> نام خانوادگی </label>
				<input type="text" class="form-control" id="last-name" name="last_name" value="{{old('last_name') ?? $madadju->last_name}}" required>
			</div>

			<div class="col-md-3 form-group">
				<label for="national-code"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> کدملی </label>
				<input type="text" class="form-control" id="national-code" name="national_code" value="{{old('national_code') ?? $madadju->national_code}}" required>
			</div>

			<div class="col-md-3 form-group">
				<label for="male"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> جنسیت </label>
				<select class="form-control" name="male" id="male" required>
					<option @if( select_old('male', 1, $madadju) ) selected @endif value="1"> مرد </option>
					<option @if( select_old('male', 0, $madadju) ) selected @endif value="0"> زن </option>
				</select>
			</div>

			<div class="col-md-3 form-group">
				<label for="mobile"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> موبایل  </label>
				<input type="text" class="form-control" id="mobile" name="mobile" value="{{old('mobile') ?? $madadju->mobile}}" required>
			</div>

			<div class="col-md-12 form-group">
				<label for="address"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> آدرس </label>
				<textarea name="address" id="address" name="address" rows="2" class="form-control" required>{{old('address') ?? $madadju->address}}</textarea>
			</div>

			<hr class="w-100">
			<h5 class="col-12 text-info mb-4"> <i class="fa fa-graduation-cap ml-1"></i> تحصیلات </h5>

			<div class="col-md-3 form-group">
				<label for="education-grade"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> مقطع تحصیلی </label>
				<select class="form-control" name="education_grade" id="education-grade" required>
					<option value=""> -- انتخاب کنید -- </option>
					<option @if((old('education_grade') ?? $madadju->education_grade) == 'دیپلم') selected @endif > دیپلم </option>
					<option @if((old('education_grade') ?? $madadju->education_grade) == 'فوق دیپلم') selected @endif > فوق دیپلم </option>
					<option @if((old('education_grade') ?? $madadju->education_grade) == 'لیسانس') selected @endif > لیسانس </option>
					<option @if((old('education_grade') ?? $madadju->education_grade) == 'فوق لیسانس') selected @endif > فوق لیسانس </option>
					<option @if((old('education_grade') ?? $madadju->education_grade) == 'دکتری') selected @endif > دکتری </option>
				</select>
			</div>

			<div class="col-md-3 form-group">
				<label for="education-field"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> رشته تحصیلی </label>
				<input type="text" class="form-control" id="education-field" name="education_field" value="{{old('education_field') ?? $madadju->education_field}}">
			</div>

			<div class="col-md-3 form-group">
				<label for="education-subfield"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> گرایش تحصیلی </label>
				<input type="text" class="form-control" id="education-subfield" name="education_subfield" value="{{old('education_subfield') ?? $madadju->education_subfield}}">
			</div>

			<hr class="w-100">
			<h5 class="col-12 text-info mb-4"> <i class="fa fa-list ml-1"></i> سایر اطلاعات </h5>

			<div class="col-md-3 form-group">
				<label for="support_type"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> نوع حمایت </label>
				<select class="form-control" name="support_type" id="support_type" required>
					<option value=""> -- انتخاب کنید -- </option>
					<option value="توانبخشی" @if( select_old('support_type', 'توانبخشی', $madadju) ) selected @endif> توانبخشی </option>
					<option value="اجتماعی" @if( select_old('support_type', 'اجتماعی', $madadju) ) selected @endif> اجتماعی </option>
				</select>
			</div>

			<div class="col-md-3 form-group">
				<label for="disabilty_type"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> نوع معلولیت </label>
				<select class="form-control" name="disabilty_type" id="disabilty_type" required>
					<option value=""> -- انتخاب کنید -- </option>
					<option value="جسمی حرکتی" @if( select_old('disabilty_type', 'جسمی حرکتی', $madadju) ) selected @endif> جسمی حرکتی </option>
					<option value="بینایی" @if( select_old('disabilty_type', 'بینایی', $madadju) ) selected @endif> بینایی </option>
					<option value="شنوایی" @if( select_old('disabilty_type', 'شنوایی', $madadju) ) selected @endif> شنوایی </option>
					<option value="ذهنی" @if( select_old('disabilty_type', 'ذهنی', $madadju) ) selected @endif> ذهنی </option>
					<option value="روانی" @if( select_old('disabilty_type', 'روانی', $madadju) ) selected @endif> روانی </option>
				</select>
			</div>

			<div class="col-md-3 form-group">
				<label for="disabilty_level"> <small><i class="fa fa-asterisk ml-1 text-danger"></i></small> شدت معلولیت </label>
				<select class="form-control" name="disabilty_level" id="disabilty_level" required>
					<option value=""> -- انتخاب کنید -- </option>
					<option value="خفیف" @if( select_old('disabilty_level', 'خفیف', $madadju) ) selected @endif> خفیف </option>
					<option value="متوسط" @if( select_old('disabilty_level', 'متوسط', $madadju) ) selected @endif> متوسط </option>
					<option value="شدید" @if( select_old('disabilty_level', 'شدید', $madadju) ) selected @endif> شدید </option>
					<option value="خیلی شدید" @if( select_old('disabilty_level', 'خیلی شدید', $madadju) ) selected @endif> خیلی شدید </option>
				</select>
			</div>

			<hr class="w-100">

			<div class="col-md-2 mx-auto">
				@include('partials.submit')
			</div>

		</form>
	</div>

@endsection
