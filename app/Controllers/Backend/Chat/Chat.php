<?php
namespace App\Controllers\Backend\Chat;
use App\Controllers\BaseController;

class Chat extends BaseController{




	public function __construct(){


	}

	public function index($page = 1){
        // dd(123);
      $template = route('backend.chat.index');
		return view(route('backend.dashboard.layout.home'),
         compact(
            'template', 'article', 'module', 'dropdown'
         )
      );
	}


}
