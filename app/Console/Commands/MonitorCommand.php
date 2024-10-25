<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

use App\Models\Monitors;
use App\Mail\NotificationMail;

class MonitorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:monitor-command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $cpuLoad = sys_getloadavg()[0];
        $memoryUsage = $this->getMemPercentage();
        $diskUsage = $this->getDiscPercentage();
        $this->saveToDB(round($cpuLoad), round($memoryUsage), round($diskUsage));
        $this->checkThreshold($cpuLoad);

        //
    }
    protected function getDiscPercentage()
    {
        $disk = disk_total_space('/');
        $disk_free = disk_free_space('/');
        $disk_used = $disk - $disk_free;
        $disk_percentage = ($disk_used / $disk) * 100;
        return $disk_percentage;
    }
    protected function getMemPercentage()
    {
        $vmStat = shell_exec('vm_stat');
        $lines = explode("\n", $vmStat);

        $pageSize = 4096;


        $pagesFree = intval(preg_replace('/\D/', '', $lines[1]));
        $pagesActive = intval(preg_replace('/\D/', '', $lines[2]));
        $pagesInactive = intval(preg_replace('/\D/', '', $lines[3]));
        $pagesWired = intval(preg_replace('/\D/', '', $lines[6]));

        $totalMemory = ($pagesFree + $pagesActive + $pagesInactive + $pagesWired) * $pageSize;
        $usedMemory = ($pagesActive + $pagesWired) * $pageSize;
        $memoryUsage = ($usedMemory / $totalMemory) * 100;

        return $memoryUsage;
    }
    protected function saveToDB($cpuLoad, $memoryUsage, $diskUsage)
    {
        $monitor = new Monitors;
        $monitor->cpu_load = $cpuLoad;
        $monitor->memory_usage = $memoryUsage;
        $monitor->disk_usage = $diskUsage;
        $monitor->save();
    }

    protected function checkThreshold($cpuLoad)
    {
        if ($cpuLoad < 80) {
            $this->sendEmail();
        }
        return;
    }
    protected function sendEmail()
    {
        Mail::to('Yazan@mail.com')->send(new NotificationMail());
    }
}
