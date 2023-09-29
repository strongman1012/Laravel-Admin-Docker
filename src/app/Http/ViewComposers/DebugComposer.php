<?php
namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;

class DebugComposer {
    /**
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        \Debugbar::info($view->getData());
    }
}