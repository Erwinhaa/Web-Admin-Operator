<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;
use DB;

class RecentNews extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        $ticket = DB::table('tickets')->get();
        return view('widgets.recent_news', [
            'config' => $this->config,
            'ticket' => $ticket,
        ]);
    }
}
