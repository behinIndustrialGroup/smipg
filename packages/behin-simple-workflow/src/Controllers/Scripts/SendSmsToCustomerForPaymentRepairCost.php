<?php

namespace Behin\SimpleWorkflow\Controllers\Scripts;

use App\Http\Controllers\Controller;
use Behin\SimpleWorkflow\Controllers\Core\VariableController;
use Behin\SimpleWorkflow\Models\Core\Process;
use Behin\SimpleWorkflow\Models\Core\Task;
use Behin\SimpleWorkflow\Models\Core\Variable;
use Behin\Sms\Controllers\SmsController;
use Illuminate\Http\Request;

class SendSmsToCustomerForPaymentRepairCost extends Controller
{
    protected $case;
    public function __construct($case)
    {
        $this->case = $case;
        // return VariableController::save(
        //     $this->case->process_id, $this->case->id, 'manager', 2
        // );
    }

    public function execute()
    {
        $variables = $this->case->variables();
        $customer_mobile = $variables->where('key', 'customer_mobile')->first()?->value;
        $fix_cost = $variables->where('key', 'fix_cost')->first()?->value;
        $account_number = $variables->where('key', 'account_number')->first()?->value;
        if($customer_mobile && $fix_cost && $account_number){
            
                $params = array([
                    "name" => "FIX_COST",
                    "value" => $fix_cost
                ],
                [
                    "name" => "ACCOUNT_NUMBER",
                    "value" => $account_number
                ]);
                $result = SmsController::sendByTemp($customer_mobile, 285563, $params);
            
        }
    }
}