<?php 

namespace App\GardenRevolution\Repositories;

use App\Models\WebPage;
use App\GardenRevolution\Repositories\Contracts\PageRepositoryInterface;

class PageRepository implements PageRepositoryInterface
{
    private $page;

    public function __construct(WebPage $page)
    {
        $this->page = $page;
    }

    public function save(WebPage $page)
    {
        $page->save();
        return $page;
    }

    public function update(WebPage $page)
    {
        return $page->save();
    }

    public function delete($id)
    {
        $this->page = $this->page->newInstance()->find($id);

        if( is_null($this->page) ) 
        {
            return false;
        }

        else 
        {
            return $this->page->delete();
        }
    }

    public function find($id, $columns = array('*')) 
    {
        $this->page = $this->page->newInstance()->find($id,$columns);
        return $this->page;
    }
}
