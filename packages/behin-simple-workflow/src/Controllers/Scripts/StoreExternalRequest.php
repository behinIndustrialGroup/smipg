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
use Behin\SimpleWorkflow\Models\Entities;
use Illuminate\Support\Str;


class StoreExternalRequest extends Controller
{
    public  $case;
    public function __construct($case = null)
    {
        $this->case = CaseController::getById($case->id);
    }

    public function execute(Request $request = null)
    {
        $case = $this->case;
        $customer = Entities\Customers::updateOrCreate([
            'customer_workshop_or_ceo_name' => $case->getVariable('customer_workshop_or_ceo_name'),
            'mobile' => $case->getVariable('customer_mobile'),
            'national_id' => $case->getVariable('customer_nid'),
            'province' => $case->getVariable('customer_city'),
            'address' => $case->getVariable('customer_address'),
        ], []);
        $repair_request = Entities\Repair_requests::create([
            'number' => $case->number,
            'creation_date' => $case->getVariable('admision_date'),
            'customer_initial_description' => $case->getVariable('customer_initial_description'),
            'mapa_expert_head' => $case->getVariable('mapa_expert_head'),
            'customer_id' => $customer->id
        ]);

        $device = Entities\Devices::create([
            'request_id' => $repair_request->id,
            'name' => $case->getVariable('device_name'),
            'model' => $case->getVariable('device_model'),
            'control_system' => $case->getVariable('device_control_system'),
            'control_system_model' => $case->getVariable('device_control_model'),
            'has_electrical_map' => $case->getVariable('has_electrical_map'),
            'mapa_serial' => $case->getVariable('mapa_serial'),
            'serial' => $case->getVariable('device_serial'),
        ]);

        VariableController::save($case->process_id, $case->id, 'customer_id', $customer->id);
        VariableController::save($case->process_id, $case->id, 'repair_request_id', $repair_request->id);
        VariableController::save($case->process_id, $case->id, 'device_id', $device->id);
        
        
    }
}