<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Facades\DB; 


class footer_comp extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        
        $cities =DB::table('city_content')->get(['city_name','city_id','city_title_sku']); // Replace 'your_table_name' with the actual table name from your database
        
        return view('components.footer_comp', [
            'cities' => $citiess
        ]);
    }
    
}

