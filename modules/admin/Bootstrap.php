<?php
/**
 * Created by PhpStorm.
 * User: achernys
 * Date: 1/26/2017
 * Time: 2:45 PM
 */

namespace app\modules\admin;

use yii\base\BootstrapInterface;
use Yii;
use yii\base\Exception;
use app\modules\admin\helpers\ClassMapHelper;

class Bootstrap implements BootstrapInterface
{
    /*
     * @param \yii\base\Application $app
     */

    public function bootstrap($app)
    {
        if($app->hasModule('admin') && $app->getModule('admin') instanceof Module) {
            $map = $this->buildClassMap($app->getModule('admin')->classMap);
            $this->initContainer($app, $map);
        }
    }

    protected function initContainer($app, $map)
    {
        $di = Yii::$container;

        try {
            //events
            $di->set(events\ItemEvent::class);

            //forms
            $di->set(forms\CountryCreateEditForm::class);
            $di->set(forms\TeamCreateEditForm::class);

            // helpers
            $di->set(helpers\TournamentHelper::class);

            //services
            $di->set(services\ItemCreateService::class);

            // validators
            $di->set(validator\AjaxRequestModelValidator::class);

            // class map models + query classes
            $modelClassMap = [];
            foreach ($map as $class => $definition) {
                $di->set($class, $definition);
                $model = is_array($definition) ? $definition['class'] : $definition;
                $name = (substr($class, strrpos($class, '\\') + 1));
                $modelClassMap[$class] = $model;
                if (in_array($name, ['Country', 'Team', 'Tournament'])) {
                    $di->set(
                        "app\\modules\\admin\\models\\query\\{$name}Query",
                        function () use ($model) {
                            return $model::find();
                        }
                    );
                }
            }

            $di->setSingleton(ClassMapHelper::class, ClassMapHelper::class, [$modelClassMap]);

            // search classes
            if (!$di->has(models\search\CountrySearch::class)) {
                $di->set(models\search\CountrySearch::class);
            }
            if (!$di->has(models\search\TeamSearch::class)) {
                $di->set(models\search\TeamSearch::class);
            }
            if (!$di->has(models\search\TournamentSearch::class)) {
                $di->set(models\search\TournamentSearch::class);
            }

        } catch (Exception $e) {
            die($e);
        }
    }

    /**
     * Builds class map according to user configuration.
     *
     * @param array $userClassMap user configuration on the module
     *
     * @return array
     */
    protected function buildClassMap(array $userClassMap)
    {
        $map = [];

        $defaults = [
            // --- models
            'Country' => 'app\modules\admin\models\Country',
            'Team' => 'app\modules\admin\models\Team',
            'Tournament' => 'app\modules\admin\models\Tournament',

            // --- search
            'CountrySearch' => 'app\modules\admin\models\search\CountrySearch',
            'TeamSearch' => 'app\modules\admin\models\search\TeamSearch',
            'TournamentSearch' => 'app\modules\admin\models\search\TournamentSearch',

            // --- forms
            'CountryCreateEditForm' => 'app\modules\admin\forms\CountryCreateEditForm',
            'TeamCreateEditForm' => 'app\modules\admin\forms\TeamCreateEditForm',

        ];

        $routes = [
            'app\modules\admin\models' => [
                'Country',
                'Team',
                'Tournament',
            ],
            'app\modules\admin\models\search' => [
                'TeamSearch',
                'CountrySearch',
                'TournamentSearch',
            ],
            'app\modules\admin' => [
                'CountryCreateEditForm',
                'TeamCreateEditForm',
            ],
        ];

        $mapping = array_merge($defaults, $userClassMap);

        foreach ($mapping as $name => $definition) {
            $map[$this->getRoute($routes, $name) . "\\$name"] = $definition;
        }

        return $map;
    }

    /**
     * Returns the parent class name route of a short class name.
     *
     * @param array  $routes class name routes
     * @param string $name
     *
     * @return int|string
     *
     * @throws Exception
     */
    protected function getRoute(array $routes, $name)
    {
        foreach ($routes as $route => $names) {
            if (in_array($name, $names)) {
                return $route;
            }
        }
        throw new Exception("Unknown configuration class name '{$name}'");
    }
}