<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\QuestionItem;
use App\Models\CsoUser;
use App\Exports\CsoUsersExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $keywords = $request->get('keywords');
        $query = CsoUser::where('id', '<>', 0);
        if($keywords != '') $query->where('division', 'like', '%'.$keywords.'%');
        $report = $query->paginate();

        return view('report.index', ['report' => $report, 'keywords' => $keywords]);
    }
    
    public function export() 
    {
        return Excel::download(new CsoUsersExport, 'CsoList.xlsx');
    }
}