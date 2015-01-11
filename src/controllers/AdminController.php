<?php
/**
 * @author: Vitaliy Ofat <i@vitaliy-ofat.com>
 */

namespace Ofat\InlineContent;

use Nayjest\Common\Controller\Resource;
use View;

class AdminController extends \BaseController
{

    /**
     * @param ContentEntity $model
     */
    public function __construct(ContentEntity $model)
    {
        $this->model = $model;
    }

    /**
     * @param string $type
     * @throws \Exception
     */
    protected function checkType($type)
    {
        $availableTypes = ['pages', 'blocks', 'page', 'block'];
        if(!in_array($type, $availableTypes))
            throw new \Exception('Wrong content type');
    }

    /**
     * @param $name
     * @param array $data
     * @return \Illuminate\View\View
     */
    protected function makeView($name, array $data)
    {
        return View::make('content::admin.'.$name, $data);
    }

    /**
     * @param $type
     * @return \Illuminate\View\View
     * @throws \Exception
     */
    public function getIndex($type)
    {
        $this->checkType($type);

        $models = $this->model->whereType($type)->get();

        return $this->makeView('index', compact('models', 'type'));
    }

    /**
     * @param $type
     * @return \Illuminate\View\View
     * @throws \Exception
     */
    public function getCreate($type)
    {
        $this->checkType($type);
        $model = $this->model;
        return $this->makeView('form_'.$type, compact('model', 'type'));
    }


}