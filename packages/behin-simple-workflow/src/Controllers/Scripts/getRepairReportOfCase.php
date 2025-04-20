<?php

namespace Behin\SimpleWorkflow\Controllers\Scripts;

use App\Http\Controllers\Controller;
use Behin\SimpleWorkflow\Controllers\Core\CaseController;
use Behin\SimpleWorkflow\Controllers\Core\InboxController;
use Behin\SimpleWorkflow\Controllers\Core\ProcessController;
use Behin\SimpleWorkflow\Controllers\Core\TaskController;
use Behin\SimpleWorkflow\Controllers\Core\VariableController;
use Behin\SimpleWorkflow\Models\Core\Process;
use Behin\SimpleWorkflow\Models\Core\Task;
use Behin\SimpleWorkflow\Models\Core\Variable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Behin\SimpleWorkflow\Models\Entities\Configs;
use Behin\SimpleWorkflow\Models\Entities\Repair_reports;

class getRepairReportOfCase extends Controller
{
    private $case;
    public function __construct()
    {
        // $this->case = CaseController::getById($case->id);
    }

    public function execute(Request $request = null)
    {
        $caseId = $request->caseId;
        $case = CaseController::getById($caseId);
        
        if(!$caseId){
            return "شناسه پرونده خالیست";
        }
        
        
        return Repair_reports::where('case_number', $case->number)->get()->each(function($row){
            $row->mapa_expert_name = getUserInfo($row->mapa_expert)?->name;
        });
    }
}