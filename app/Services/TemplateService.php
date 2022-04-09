<?php

namespace App\Services;

use App\Models\Template;

class TemplateService
{
    /**
     * Global variable
     * **/
    protected $template = null;

    /**
     * Constructor
     * **/
    public function __construct(Template $template)
    {
        $this->template = $template;
    }

    /**
     * Get list template
     * **/
    public function getAll()
    {
        return $this->template->all();
    }

    /**
     * Update template
     * 
     * @param $request
     * @return boolean
     * **/
    public function update($request)
    {
        return $this->template->find($request['id'])->update([
            'html' => $request['html']
        ]);
    }
}