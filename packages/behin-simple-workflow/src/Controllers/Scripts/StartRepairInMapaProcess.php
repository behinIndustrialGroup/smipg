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
use Behin\SimpleWorkflow\Models\Core\Inbox;
use Behin\SimpleWorkflow\Models\Core\Variable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StartRepairInMapaProcess extends Controller
{
    private $case;
    public function __construct($case)
    {
        $this->case = CaseController::getById($case->id);
    }

    public function execute()
    {
        $previousVariables = $this->case->variables();
        $task = TaskController::getById("9f6b7b5c-155e-4698-8b05-26ebb061bb7d");
        
        //شروه فرایند جدید پذیرش در مدارپرداز
        $inbox = ProcessController::startFromScript(
            $task->id, 42, $this->case->number, $this->case->id
        );
        Log::info($inbox);
        //ویرایش نام پرونده در ردیف کارتابل کارشناس
        InboxController::editCaseName($inbox->id, "پذیرش دستگاه از فرایند خارجی");
        
        //ذخیره برخی از اطلاعات مشتری در پرونده داخلی
        VariableController::save(
            $task->process->id,
            $inbox->case_id,
            'customer_workshop_or_ceo_name',
            $previousVariables->where('key', 'customer_workshop_or_ceo_name')->first()->value
        );
        
        VariableController::save(
            $task->process->id,
            $inbox->case_id,
            'customer_mobile',
            $previousVariables->where('key', 'customer_mobile')->first()->value
        );
        
        
    }
}