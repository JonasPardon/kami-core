<?php

namespace JonasPardon\KamiCore\Services;

use Illuminate\Support\Str;

class PreviewDefinerService
{
    protected $defaultView = 'page';

    /**
     * @param array $data
     *
     * @return array
     */
    public function parseData(array $data)
    {
        $data = $this->setTargetEntity($data);

        $entity = Str::studly($data['target_entity']);
        $methodName = "parse{$entity}Data";

        if(method_exists($this, $methodName)) {
            $data = $this->$methodName($data);
        }

        $data['target_view'] = $this->getView($data);

        return $data;
    }

    /**
     * @param $data
     *
     * @return array
     */
    protected function parsePageData(array $data) {
        return $data;
    }

    /**
     *
     *
     * @param array $data
     * @return string
     */
    public function getView(array $data)
    {
        $entity = Str::studly($data['target_entity']);
        $methodName = "get{$entity}View";

        if(method_exists($this, $methodName)) {
            $view = $this->$methodName($data);
        } else {
            $view = $this->getDefaultView();
        }

        return $view;
    }

    protected function getPageView(array $data) {
        return 'page';
    }

    /**
     * @return string
     */
    public function getDefaultView(): string
    {
        return $this->defaultView;
    }

    /**
     * @param string $defaultView
     */
    public function setDefaultView(string $defaultView): void
    {
        $this->defaultView = $defaultView;
    }

    protected function setTargetEntity(array $data)
    {
        $data[$data['target_entity']] = (new $data['model'])->forceFill($data['data']);

        return $data;
    }
}
