<?php

namespace Ofat\InlineContent;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Nayjest\Common\ViewsIntegration;

class ServiceProvider extends BaseServiceProvider
{

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('ofat/inline-content');

		ViewsIntegration::apply('inline-content');

		$this->app['html']->macro('inlineContent', function($slug){
			return EditableMacros::render($slug);
		});

        include __DIR__ . '/../../routes.php';
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
