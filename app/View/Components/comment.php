<?php

namespace App\View\Components;

use App\Models\Comment as ModelsComment;
use Illuminate\View\Component;

class comment extends Component
{
    public ModelsComment $comment;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.comment');
    }
}
