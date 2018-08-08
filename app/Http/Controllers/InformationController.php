<?php

namespace App\Http\Controllers;

class InformationController extends Controller
{
	public function site ()
	{
	    $info = [
	        'name' => 'quick-blog',
            'version' => 'v0.1',
            'your-ip-address' => request()->getClientIp()
        ];
	    return $this->ok($info);
	}
}
