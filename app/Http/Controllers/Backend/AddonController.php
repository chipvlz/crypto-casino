<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\PackageManager;
use App\Helpers\ReleaseManager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class AddonController extends Controller
{
    public function index(PackageManager $packageManager, ReleaseManager $releaseManager)
    {
        return view('backend.pages.addons', [
            'releases' => $releaseManager->getInfo(),
            'packages' => $packageManager->getAll()
        ]);
    }

    /**
     * Disable add-on
     *
     * @param $packageId
     * @param PackageManager $packageManager
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function disable($packageId, PackageManager $packageManager)
    {
        $package = $packageManager->get($packageId);
        if (!$package)
            return back()->withErrors(__('Package ":id" does not exist.', ['id' => $packageId]));

        try {
            if (Storage::disk('local')->put('packages/' . $packageId . '/disabled', '')) {
                Artisan::call('view:clear');
                return back()->with('success', __('Add-on ":name" successfully disabled.', ['name' => $package->name]));
            } else {
                return back()->withErrors(__('Could not disable the add-on. Please check that storage/app folder is writable.'));
            }
        } catch(\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    /**
     * Enable add-on
     *
     * @param $packageId
     * @param PackageManager $packageManager
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function enable($packageId, PackageManager $packageManager)
    {
        $package = $packageManager->get($packageId);
        if (!$package)
            return back()->withErrors(__('Package ":id" does not exist.', ['id' => $packageId]));

        try {
            if (Storage::disk('local')->delete('packages/' . $packageId . '/disabled')) {
                Artisan::call('view:clear');
                return back()->with('success', __('Add-on ":name" successfully enabled.', ['name' => $package->name]));
            } else {
                return back()->withErrors(__('Could not enable the add-on. Please check that storage/app folder is writable.'));
            }
        } catch(\Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }
}
