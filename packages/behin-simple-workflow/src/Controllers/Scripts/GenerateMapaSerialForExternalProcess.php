<?php

namespace Behin\SimpleWorkflow\Controllers\Scripts;

use App\Http\Controllers\Controller;
use Behin\SimpleWorkflow\Controllers\Core\VariableController;
use Behin\SimpleWorkflow\Controllers\Core\CaseController;
use Behin\SimpleWorkflow\Models\Core\Process;
use Behin\SimpleWorkflow\Models\Core\Task;
use Behin\SimpleWorkflow\Models\Core\Variable;
use Behin\Sms\Controllers\SmsController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Behin\SimpleWorkflow\Models\Core\Cases;

class GenerateMapaSerialForExternalProcess extends Controller
{
    protected $case;
    public function __construct($case = null)
    {
        // $this->case = $case;
    }

    public function execute(Request $request)
    {
        $this->case = $request->caseId;
        
        try{
            $this->case = CaseController::getById($this->case);
            $creator = $this->case->creator;
            $processId = $this->case->process_id;
            $today = Carbon::today(); // گرفتن تاریخ امروز
            $todayJalali = toJalali($today);
            $mapaExpert = $this->case->getVariable('mapa_expert');
            $mapaExpert = getUserInfo($mapaExpert);
            
            $casesCount = Cases::where('process_id', $processId)->whereDate('created_at', $today)->count() + 1;
            $const =  $mapaExpert->id . " " . $todayJalali->format('y') . " " . $todayJalali->getMonth() . " " . $todayJalali->format('d');
            return "$const";
        }catch(Exception $e){
            return $e->getMessage();
        }
        

    }
}