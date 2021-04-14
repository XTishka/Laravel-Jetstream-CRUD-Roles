<?php

namespace Modules\Finance\Http\Livewire\Currencies;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Finance\Entities\Currency;

class Index extends Component
{
    use WithPagination;

    public $searchTerm;

    public function render()
    {
        $query = '%' . $this->searchTerm . '%';

        return view('finance::currencies.livewire.index', [
            'currencies' =>    Currency::where(function ($sub_query) {
                $sub_query->where('title', 'like', '%' . $this->searchTerm . '%')
                    ->orWhere('code', 'like', '%' . $this->searchTerm . '%');
            })->paginate(10)
        ]);
    }
}
