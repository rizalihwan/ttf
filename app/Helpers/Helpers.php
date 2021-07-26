<?php

namespace App\Helpers;

use App\Models\LogActivity;
use Request;

class Helpers
{
	public static function addToLog($subject)
	{
		$log = [];
		$log['subject'] = $subject;
		$log['url'] = Request::fullUrl();
		$log['method'] = Request::method();
		$log['ip'] = Request::ip();
		$log['agent'] = Request::header('user-agent');
		$log['user_id'] = auth()->check() ? auth()->user()->id : null;
		try {
			LogActivity::create($log);
		} catch (\Exception $e) {
			return abort(403, 'Failed to save Log because ' . $e->getMessage());
		}
	}

	public static function setActive($path, $active = 'style="color: blue;"')
	{
		return call_user_func_array('Route::is', (array)$path) ? $active : '';
	}
}
