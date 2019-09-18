<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\CommandManager;
use App\Helpers\ReleaseManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class MaintenanceController extends Controller
{
    private $log = 'laravel.log';
    
    public function index(CommandManager $commandManager, ReleaseManager $releaseManager)
    {
        return view('backend.pages.maintenance', [
            'system_info'   => 'PHP ' . PHP_VERSION . ' ' . php_uname(),
            'log_size'      => Storage::disk('logs')->exists($this->log) ? round(Storage::disk('logs')->size($this->log) / 1048576, 2) : 0,
            'commands'      => $commandManager->all(),
            'releases'      => $releaseManager->getInfo(),
        ]);
    }

    public function viewLog()
    {
        return Storage::disk('logs')->exists($this->log) ? Storage::disk('logs')->get($this->log) : __('No application log file found.');
    }

    public function downloadLog()
    {
        return Storage::disk('logs')->exists($this->log) ? Storage::disk('logs')->download($this->log) : __('No application log file found.');
    }

    /**
     * Enable maintenance mode
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function enable(Request $request)
    {
        Artisan::call('down', [
            '--message' => $request->message
        ]);

        return $this->success();
    }

    /**
     * Disable maintenance mode
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function disable()
    {
        Artisan::call('up');
        return $this->success();
    }

    /**
     * Clear all caches
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cache()
    {
        Cache::flush();
        Artisan::call('view:clear');
        return $this->success();
    }

    /**
     * Run migrations
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function migrate()
    {
        // Forcing Migrations To Run In Production
        Artisan::call('migrate', [
            '--force' => TRUE,
        ]);
        // run seeders
        Artisan::call('db:seed', [
            '--force' => TRUE,
        ]);

        return $this->success();
    }

    /**
     * Run cron
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cron()
    {
        set_time_limit(1800);
        Artisan::call('schedule:run');
        return $this->success();
    }

    public function task(Request $request, CommandManager $commandManager)
    {
        $command = $commandManager->get($request->command);

        if (!$command)
            return redirect()->route('backend.maintenance.index')->withErrors(__('Such task does not exist.'));

        return view('backend.pages.tasks.run', [
            'command' => $command
        ]);
    }

    public function runTask(Request $request, CommandManager $commandManager)
    {
        $command = $commandManager->get($request->command);

        if (!$command)
            return redirect()->route('backend.maintenance.index')->withErrors(__('Such task does not exist.'));

        set_time_limit(1800);

        // ensure only supported arguments are passed
        $params = $request->only(array_column($command['arguments'], 'id'));

        // execute artisan command
        Artisan::call($command['signature'], $params);

        return $this->success();
    }

    private function success()
    {
        return redirect()->route('backend.maintenance.index')->with('success', __('Operation performed successfully.'));
    }
}
