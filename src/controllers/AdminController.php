<?php
/**
 * @author: Vitaliy Ofat <i@vitaliy-ofat.com>
 */

namespace Ofat\InlineContent;

use Nayjest\Common\Controller\Resource;
use Redirect;
use View;

class AdminController extends \BaseController
{

    use Resource;

    /**
     * @param ContentEntity $model
     */
    public function __construct(ContentEntity $model)
    {
        $this->model = $model;
    }

    /**
     * @param $name
     * @param array $data
     * @return \Illuminate\View\View
     */
    protected function makeView($name, array $data)
    {
        return View::make('inline-content::admin.'.$name, $data);
    }

    /**
     * @return \Illuminate\View\View
     * @internal param $type
     */
    public function getIndex()
    {
        $models = $this->model->paginate();

        return $this->makeView('index', compact('models'));
    }

    /**
     * @return \Illuminate\View\View
     * @throws \Exception
     */
    public function getCreate()
    {
        $model = $this->model;
        return $this->makeView('form', compact('model'));
    }

    public function postCreate()
    {
        $attributes = \Input::all();
        $attributes['author'] = \Auth::user()->id;

        $translations = $attributes['translations'];
        unset($attributes['translations']);

        $validation = $this->validate($attributes);
        if($validation->passes()) {
            $model = $this->model->create($attributes);
            foreach($translations as $lang => $tr) {
                $model->createTranslation($lang)->fill($tr)->save();
            }

            return  Redirect::action(get_class($this) . '@getIndex')
                ->with('message', 'Entity created.')
                ->with('message_type', 'success');
        }

        return  Redirect::action(get_class($this) . '@getCreate')
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    public function postInlineSave()
    {
        $data = \Input::only(['content', 'id', 'language']);
        $model = $this->model->withTranslation($data['language'])->whereId($data['id'])->first();
        $model->translation->content = $data['content'];
        $model->translation->save();

        \Cache::forget($model->slug.'-'.\App::getLocale());
    }

}