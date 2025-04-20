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
use Illuminate\Support\Facades\Auth;
use BehinUserRoles\Models\User;
use BehinUserRoles\Controllers\DepartmentController;
use Illuminate\Support\Carbon;
use Behin\SimpleWorkflow\Models\Entities\Timeoffs;
use Morilog\Jalali\Jalalian;
use Behin\SimpleWorkflow\Models\Core\Cases;



class RemoveCase extends Controller
{
    private $case;
    public function __construct($case = null)
    {
        $this->case = CaseController::getById($case->id);
    }

    public function execute(Request $request = null)
    {
        $case = $this->case;
        $removeCaseNumber = $case->getVariable('case_number');
        $removeCase = Cases::where('number', $removeCaseNumber)->first();
        if(!$removeCase){
            return "پرونده پیدا نشد";
        }
        $inboxes = $removeCase->whereIs();
        foreach($inboxes as $inbox){
            $inbox->delete();
        }
        $removeCase->delete();
        return "حذف شد";
        
    }
}