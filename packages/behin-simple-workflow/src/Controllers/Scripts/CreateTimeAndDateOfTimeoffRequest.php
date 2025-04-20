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



class CreateTimeAndDateOfTimeoffRequest extends Controller
{
    private $case;
    public function __construct($case = null)
    {
        $this->case = CaseController::getById($case->id);
    }

    public function execute(Request $request = null)
    {
        $variables = $this->case->variables();
        $type = $variables->where('key', 'timeoff_request_type')->first()?->value;
        if($type == 'ساعتی'){
            $start = $variables->where('key', 'timeoff_start_time')->first()?->value;
            $end = $variables->where('key', 'timeoff_end_time')->first()?->value;
            $date = $variables->where('key', 'timeoff_hourly_request_start_date')->first()?->value;
            
            if(!$start){
                return "زمان شروع اجباریست";
            }
            if(!$end){
                return "زمان پایان اجباریست";
            }
            if(!$date){
                return "تاریخ شروع اجباریست";
            }
            
            $date= convertPersianToEnglish($date);
            $gregorianDate = Jalalian::fromFormat('Y-m-d', $date)->toCarbon()->format('Y-m-d');
            $requestDateTimestamp = strtotime("$gregorianDate $start");
            
            $now = Carbon::now()->addMinutes(2)->timestamp;
            // return Carbon::now();
            if( $requestDateTimestamp < $now ){
                return "تاریخ و ساعت شروع برای زمان گذشته است. شما نمیتوانید برای تاریخ گذشته مرخصی ثبت کنید";
            }
            
            $startTime = Carbon::createFromFormat("H:i", $start)->timestamp;
            
            $endTime = Carbon::createFromFormat("H:i", $end)->timestamp;
            
            
            $duration = ($endTime - $startTime) /3600;
            if($duration < 0){
                return "ساعت پایان باید از ساعت شروع بیشتر باشد";
            }
            $requestDate = explode('-', $date);
            
        }else{
            $date = $variables->where('key', 'timeoff_start_date')->first()?->value;
            if(!$date){
                return "تاریخ شروع وارد نشده است";
            }
            $date= convertPersianToEnglish($date);
            $requestDateTimestamp = Jalalian::fromFormat('Y-m-d', $date)->toCarbon()->timestamp;
            $now = Carbon::today()->timestamp;
            if( $requestDateTimestamp < $now ){
                return "تاریخ شروع برای زمان گذشته است. شما نمیتوانید برای تاریخ گذشته مرخصی ثبت کنید";
            }
            $endDate = $variables->where('key', 'timeoff_end_date')->first()?->value;
            if(!$endDate){
                return "تاریخ پایان وارد نشده است";
            }
            $endDate= convertPersianToEnglish($endDate);
            $requestEndDateTimestamp = Jalalian::fromFormat('Y-m-d', $endDate)->toCarbon()->timestamp;
            
            if($requestEndDateTimestamp < $requestDateTimestamp){
                return "تاریخ شروع از تاریخ پایان بزرگتر است";
            }
            
            $requestDate = explode('-', $date);
            $request = new Request([
                'timeoff_start_date' => $this->case->getVariable('timeoff_start_date'),
                'timeoff_end_date' => $this->case->getVariable('timeoff_end_date')
                ]);
            $duration = CalculateDailyTimeoffDuration::execute($request);
            if(!is_numeric($duration)){
                return "خطا در محاسبه مدت زمان مرخصی، با پشتیبانی تماس بگیرید";
            }
            VariableController::save(
                $this->case->process->id,     
                $this->case->id,
                'timeoff_daily_request_duration',
                $duration
            );
            
        }
        
        
        $now = Carbon::now();
        $nowTimestamp = $now->timestamp;
        $now = toJalali($now);
        
        VariableController::save(
            $this->case->process->id,     
            $this->case->id,
            'creator',
            $this->case->creator
        );
        VariableController::save(
            $this->case->process->id,     
            $this->case->id,
            'timeoff_register_datetime',
            $now
        );
        VariableController::save(
            $this->case->process->id,     
            $this->case->id,
            'timeoff_register_date_timestamp',
            $nowTimestamp
        );
        
        $uniqueId = $variables->where('key', 'timeoff_uniqueId')->first()?->value;
        if(!$uniqueId){
            $uniqueId = rand(100000,1000000 );
            VariableController::save(
                $this->case->process->id,     
                $this->case->id,
                'timeoff_uniqueId',
                $uniqueId
            );
        }
        
        Timeoffs::updateOrCreate([
            'uniqueId' => $uniqueId
            ],
            [
            'user' => $this->case->creator,
            'type' => $type,
            'duration' => $duration,
            'request_day' => $requestDate[2],
            'request_month' => $requestDate[1],
            'request_year' => $requestDate[0],
            'approved' => 0
        ]);
        
    }
}