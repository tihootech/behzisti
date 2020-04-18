<table class="table table-bordered table-hover table-striped table-sm table-responsive-lg">
	<thead>
		<tr>
			<th scope="col">#</th>
			@if ($check)
				<th scope="col"> <i class="fa fa-square-o" data-checked="0" data-check="all"></i> </th>
			@endif
			<th scope="col"> نام و نام خانوادگی </th>
			<th scope="col"> شهرستان </th>
			<th scope="col"> جنسیت </th>
			<th scope="col"> نوع معلولیت </th>
			<th scope="col"> شدت معلولیت </th>
			<th scope="col"> شماره تماس </th>
			<th scope="col"> تعداد معرفی </th>
			<th scope="col" colspan="3"> عملیات </th>
		</tr>
	</thead>
	<tbody>
		@foreach ($madadjus as $index => $madadju)
			<tr>
				<th scope="row">{{$index+1}}</th>
				@if ($check)
					<td> <i class="fa fa-square-o" data-checked="0" data-check="{{$madadju->id}}"></i> </td>
				@endif
				<td class="@if($madadju->introduces->count()) bg-red-light @endif">
					{{$madadju->full_name() }}
				</td>
				<td>
					 {{$madadju->city ?? '-'}}
				</td>
				<td>{{$madadju->male ? 'مرد' : 'زن'}}</td>

				<td> {{$madadju->disabilty_type ?? '-'}} </td>
				<td> {{$madadju->disabilty_level ?? '-'}} </td>
				<td> {{$madadju->mobile ?? '-'}} </td>

				<td @unless($madadju->icount) class="text-success" @endunless>
					{{$madadju->icount ? $madadju->icount : 'صفر'}}
				</td>
				<td align="center">
					<a href="{{url("madadju/$madadju->id")}}" class="btn btn-sm btn-outline-primary" data-toggle="popover" data-content="جزییات" data-trigger="hover" data-placement="top">
						<i class="fa fa-list ml-1"></i>
					</a>
				</td>
				<td align="center">
					<a href="{{url("madadju/$madadju->id/edit")}}" class="btn btn-sm btn-outline-success" data-toggle="popover" data-content="ویرایش" data-trigger="hover" data-placement="top">
						<i class="fa fa-edit ml-1"></i>
					</a>
				</td>
				<td align="center" class="text-center">
					@include('partials.delete', ['key' => 'madadju', 'dtype'=>'hover', 'btn_sm'=>true])
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
