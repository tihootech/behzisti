<?php

namespace App\Http\Controllers;

use App\Madadju;
use App\User;
use App\Organ;
use App\Operator;
use App\Introduce;
use App\Rules\NationalCode;
use App\Rules\PersianDate;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MadadjuController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('organ')->only('show');
        $this->middleware('operator')->except('show');
    }

    public function index(Request $request)
    {
        $query = Madadju::query();
        $query = $query->leftJoin('introduces', 'madadjus.id', '=', 'introduces.madadju_id')
            ->select('madadjus.*', \DB::raw("COUNT(introduces.madadju_id) AS icount"))->groupBy('madadjus.id');

        // national code
        if ($phrase = $request->national_code) {
            $query = $query->where('national_code', 'like', "%$phrase%");
        }

        // first name or last name
        if ($phrase = $request->full_name) {
            $query = $query->where(function ($query) use ($phrase) {
                $query->where('first_name', 'like', "%$phrase%")->orWhere('last_name', 'like', "%$phrase%");
            });
        }

        // gender
        if ($request->male !== null) {
            $query = $query->where('male', $request->male);
        }

        // education grade
        if ($array = $request->education_grade) {
            $query = $query->whereIn('education_grade', $array);
        }

        // education field
        if ($phrase = $request->education_field) {
            $query = $query->where('education_field', 'like', "%$phrase%");
        }

        // education subfield
        if ($phrase = $request->education_subfield) {
            $query = $query->where('education_subfield', 'like', "%$phrase%");
        }

        $madadjus = $query->orderBy('icount')->paginate(25);
        $organs = Organ::all();
        return view('madadjus.index', compact('madadjus', 'organs'));
    }

    public function show(Madadju $madadju)
    {
        if (
            (only_organ() && !$madadju->introduced(auth()->id())) // organ check
            ||
            (only_operator() && $madadju->region != auth()->user()->region()) // operator check
        ) {
            abort(404);
        }
        return view('madadjus.show', compact('madadju'));
    }

    public function create()
    {
        $madadju = new Madadju;
        return view('madadjus.form', compact('madadju'));
    }

    public function store(Request $request)
    {
        $data = self::validation();
        Madadju::create($data);
        return back()->withMessage('مددجو جدید اضافه شد.');
    }

    public function edit(Madadju $madadju)
    {
        if ( only_operator() && $madadju->region != auth()->user()->region() ) {
            abort(404);
        }
        return view('madadjus.form', compact('madadju'));
    }

    public function update(Request $request, Madadju $madadju)
    {
        if ( only_operator() && $madadju->region != auth()->user()->region() ) {
            abort(404);
        }
        $data = self::validation($madadju->id);
        $madadju->update($data);
        return redirect('madadju')->withMessage('مددجو موردنظر ویرایش شد.');
    }

    public function destroy(Madadju $madadju)
    {
        Introduce::where('madadju_id', $madadju->id)->delete();
        $madadju->delete();
        return back()->withMessage('مددجوی موردنظر از سیستم حذف شد.');
    }

    public static function validation($id=0)
    {
        $data =  request()->validate([
            "state" => "required|string",
            "city" => "required|string",
            "first_name" => "required|string",
            "last_name" => "required|string",
            "national_code" => [
                "required",
                "unique:madadjus,national_code,$id",
                new NationalCode,
            ],
            "support_type" => "required|string",
            "disabilty_type" => "required|string",
            "disabilty_level" => "required|string",
            "male" => "required|boolean",
            "education_grade" => "required|string",
            "education_field" => "nullable|string",
            "education_subfield" => "nullable|string",
            "address" => "required|string",
            "mobile" => "required|string|digits:11",
        ]);

        if (only_operator()) {
            $data['region'] = auth()->user()->region();
            $data['operator_id'] = auth()->user()->owner_id;
        }else {
            $data['operator_id'] = 0;
        }

        return $data;
    }
}
