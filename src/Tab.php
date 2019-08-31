<?php

namespace StefanBauer\LaracastsTab;

use Facade\Ignition\Tabs\Tab as BaseTab;

class Tab extends BaseTab
{
    public function name(): string
    {
        return 'Laracasts';
    }

    public function component(): string
    {
        return 'ignition-laracasts-tab';
    }

    public function registerAssets()
    {
        $this->script('ignition-laracasts-tab', __DIR__ . '/../dist/js/tab.js');
    }

    public function meta(): array
    {
        return [
            'title' => $this->name(),
        ];
    }
}
