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
use Illuminate\Support\Facades\Auth;
use BehinUserRoles\Models\User;
use BehinUserRoles\Controllers\DepartmentController;
use Illuminate\Support\Carbon;
use Morilog\Jalali\Jalalian;
use Mkhodroo\Nerkhnameh\Models\NerkhnamehModel;
use Illuminate\Support\Facades\DB;
use Behin\SimpleWorkflow\Models\Entities\Nerkhnameh;
use App\Http\Controllers\SmsController;



class SendNekhnamehIssued extends Controller
{
    private $case;
    public function __construct($case = null)
    {
        // $this->case = CaseController::getById($case->id);
    }

    public function execute(Request $request = null)
    {
        return SmsController::send('09376922176', '801453', [
            'otp' => '123'
            ]);
        
    }
}