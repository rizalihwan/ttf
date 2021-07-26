<?php

namespace App\Http\Controllers;

use App\Models\LogActivity;
use SimpleSoftwareIO\QrCode\Generator;

class HomeController extends Controller
{
    public function home()
    {
        // mengambil data log activity yang deleted_at nya null
        $logs = LogActivity::latest()->get();
        return view('home', compact('logs'));
    }

    public function trash()
    {
        $logs = LogActivity::latest()->onlyTrashed()->get();
        return view('trash', compact('logs'));
    }

    public function DestroyLogActivity(LogActivity $logActivity)
    {
        try {
            $logActivity->delete();
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to move Log Activity ' . $e->getMessage());
        }
        return back()->with('success', 'Log Activity Has Been Move to Trash!');
    }

    public function DestroyLogPermanent($id)
    {
        try {
            $logActivity = LogActivity::onlyTrashed()->findOrFail($id);
            $logActivity->forceDelete();
        } catch (\Exception $e) {
            return back()->with('error', 'Failed ' . $e->getMessage());
        }
        return back()->with('success', 'Log Activity Has Been deleted!');
    }

    public function deleteAllTrash()
    {
        try {
            LogActivity::onlyTrashed()->forceDelete();
        } catch (\Exception $e) {
            return back()->with('error', 'Failed ' . $e->getMessage());
        }
        return back()->with('success', 'All Data inside Trash deleted Permanent!');
    }

    public function restoreLogActivity($id)
    {
        try {
            $logActivity = LogActivity::onlyTrashed()->findOrFail($id);
            $logActivity->restore();
        } catch (\Exception $e) {
            return back()->with('error', 'Failed ' . $e->getMessage());
        }
        return back()->with('success', 'Log Activity Has Been Restored!');
    }

    public function restoreAllTrash()
    {
        try {
            LogActivity::onlyTrashed()->restore();
        } catch (\Exception $e) {
            return back()->with('error', 'Failed ' . $e->getMessage());
        }
        return back()->with('success', 'All Data inside Trash has been Restored!');
    }

}
