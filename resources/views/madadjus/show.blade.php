@extends('layouts.dashboard')
@section('main')

	@operator
		<div class="tile">
			<h4 class="mb-4 text-info"> <i class="fa fa-history ml-1"></i> تاریخچه شخص </h4>
			<hr>
			@if ($madadju->introduces->count())
				<ul>
					@foreach ($madadju->introduces as $introduce)
						<li class="my-2">
							در تاریخ
							<b class="text-info mx-1"> {{human_date($introduce->crated_at)}} </b>
							به موسسه
							<b class="text-info mx-1"> {{$introduce->organ->agency_name ?? '-'}} </b>
							معرفی شد و این موسسه
							@if ($introduce->status == 1)
								<b class="text-secondary mx-1"> هنوز وضعیت شخص را مشخص نکرده است. </b>
							@elseif ($introduce->status == 2)
								<b class="text-success mx-1"> شخص را در تاریخ {{human_date($introduce->updated_at)}} تایید کرد. </b>
							@elseif ($introduce->status == 3)
								<b class="text-danger mx-1"> شخص را رد کرد ({{$introduce->information}}) </b>
							@endif
							@unless ($introduce->confirmed)
								<span class="text-info mx-1"> لازم به ذکر است که هنوز وضعیت این شخص توسط مددکارها تایید نشده است. </span>
							@endunless
						</li>
					@endforeach
				</ul>
			@else
				<div class="alert alert-warning">
					هنوز برای این شخص تاریخچه ای ایجاد نشده است.
				</div>
			@endif
		</div>
	@endoperator

	<div class="tile">
		<h4 class="mb-4 text-info"> <i class="fa fa-list ml-1"></i> مشخصات </h4>
		<hr>
		<div class="row justify-content-center">
			<div class="col-md-4 my-2">
				<div class="card">
					<div class="card-body">
						<b> نام و نام خانوادگی : </b> <span class="text-info"> {{$madadju->full_name()}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-4 my-2">
				<div class="card">
					<div class="card-body">
						<b> شماره تماس : </b> <span class="text-info"> {{$madadju->mobile}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-4 my-2">
				<div class="card">
					<div class="card-body">
						<b> استان و شهرستان : </b> <span class="text-info"> {{$madadju->state ?? '?'}} - {{$madadju->city ?? '?'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-3 my-2">
				<div class="card">
					<div class="card-body">
						<b> کدملی : </b> <span class="text-info"> {{$madadju->national_code ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-3 my-2">
				<div class="card">
					<div class="card-body">
						<b> نوع حمایت : </b> <span class="text-info"> {{$madadju->support_type}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-3 my-2">
				<div class="card">
					<div class="card-body">
						<b> جنسیت : </b> <span class="text-info"> {{$madadju->male ? 'مرد' : 'زن'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-4 my-2">
				<div class="card">
					<div class="card-body">
						<b> مقطع تحصیلی : </b> <span class="text-info"> {{$madadju->education_grade ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-4 my-2">
				<div class="card">
					<div class="card-body">
						<b> رشته تحصیلی : </b> <span class="text-info"> {{$madadju->education_field ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-4 my-2">
				<div class="card">
					<div class="card-body">
						<b> گرایش تحصیلی : </b> <span class="text-info"> {{$madadju->education_subfield ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-3 my-2">
				<div class="card">
					<div class="card-body">
						<b> نوع معلولیت: </b> <span class="text-info"> {{$madadju->disabilty_type ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-3 my-2">
				<div class="card">
					<div class="card-body">
						<b> شدت معلولیت: </b> <span class="text-info"> {{$madadju->disabilty_level ?? '-'}}  </span>
					</div>
				</div>
			</div>
			<div class="col-md-12 my-2">
				<div class="card">
					<div class="card-body">
						<b> آدرس : </b> <span class="text-info"> {{$madadju->address ?? '-'}}  </span>
					</div>
				</div>
			</div>
		</div>
	</div>

	@operator
		<div class="tile">
			<h4 class="mb-4 text-info"> <i class="fa fa-tasks ml-1"></i> عملیات </h4>
			<hr>
			<a href="{{url("madadju/$madadju->id/edit")}}" class="btn btn-outline-success mx-2"> <i class="fa fa-edit ml-1"></i> ویرایش </a>
			@include('partials.delete', ['key' => 'madadju', 'dtype'=>'text'])
		</div>
	@endoperator

@endsection
