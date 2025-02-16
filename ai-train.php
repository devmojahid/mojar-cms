at first i train you to be a good assistant. i give you the core laravel cms code for your better result.This is a Laravel 9 cms project. i am extend it from juzaweb cms. and make this better and more powerful.


in modules we have our cms core and full application logic strucutre like 
    -> API 
        -> Actions
        -> Http
        -> Providers
        -> resources
        -> routes
        -> Support
    -> Backend
        -> Actions
        -> Commands
        -> Events
        -> Helpers
        -> Http
        -> Models
        -> Providers
        -> Repositories
        -> resources [all dashboard style and layout]
        -> routes
        -> Support
    -> CMS
        -> Abstracts
        -> config
        -> Console
        -> Contracts
        -> Database
        -> Exceptions
        -> Extension
        -> Facades
        -> Events
        -> Helpers
        -> Http
        -> Interfaces
        -> Models
        -> Providers
        -> Repositories
        -> resources
        -> routes
        -> Support
            -> Activators
            -> Collections
            -> FileManager
            -> Imports
            -> Media
            -> Permission
            -> Updater
            etc many more
        -> Trait
    -> DevTool
    -> Frontend
    -> Multilang
    and more

modules\CMS\Abstracts\Action.php
namespace Juzaweb\CMS\Abstracts;

use Juzaweb\CMS\Contracts\HookActionContract;
use Juzaweb\CMS\Facades\Hook;

abstract class Action
{
    public const INIT_ACTION = 'mojar.init';
    public const BACKEND_INIT = 'backend.init';
    public const NETWORK_INIT = 'backend.init';
    public const FRONTEND_INIT = 'frontend.init';
    public const API_DOCUMENT_INIT = 'api.document_init';
    public const BACKEND_CALL_ACTION = 'backend.call_action';
    public const FRONTEND_CALL_ACTION = 'frontend.call_action';
    public const FRONTEND_HEADER_ACTION = 'theme.header';
    public const FRONTEND_FOOTER_ACTION = 'theme.footer';
    public const BACKEND_MENU_INDEX_ACTION = 'backend.menu.index';
    public const BACKEND_DASHBOARD_ACTION = 'backend.dashboard';
    public const POSTS_FORM_LEFT_ACTION = 'post_types.form.left';
    public const POSTS_FORM_RIGHT_ACTION = 'post_types.form.right';
    public const POST_FORM_RIGHT_ACTION = 'post_type.{name}.form.right';
    public const POST_FORM_LEFT_ACTION = 'post_type.{name}.form.left';
    public const RESOURCE_FORM_LEFT_ACTION = 'resource.{name}.form_left';
    public const RESOURCE_FORM_RIGHT_ACTION = 'resource.{name}.form_right';
    public const PERMALINKS_SAVED_ACTION = 'permalinks.saved';
    public const BACKEND_HEADER_ACTION = 'mojar_header';
    public const BACKEND_FOOTER_ACTION = 'mojar_footer';
    public const WIDGETS_INIT = 'mojar.widget_init';
    public const BLOCKS_INIT = 'mojar.block_init';
    public const BACKEND_USER_FORM_RIGHT = 'user.form.right';
    public const BACKEND_USER_BEFORE_SAVE = 'user.before_save';
    public const BACKEND_USER_AFTER_SAVE = 'user.after_save';
    public const BEFORE_PERMISSION_ADMIN = 'before.permission.admin';
    public const AFTER_PERMISSION_ADMIN = 'after.permission.admin';

    public const DATATABLE_SEARCH_FIELD_TYPES_FILTER = 'datatable.search_field_types';
    public const FRONTEND_SEARCH_QUERY = 'frontend.search_query';
    public const FRONTEND_AFTER_BODY = 'theme.after_body';
    public const PERMISSION_INIT = 'permission_init';

    protected HookActionContract $hookAction;

    public function __construct()
    {
        $this->hookAction = app(HookActionContract::class);
    }

    abstract public function handle();

    /**
     * Adds an action hook.
     *
     * @param string   $tag       The name of the action hook.
     * @param callable $callback  The callback function to be executed when the action is triggered.
     * @param int      $priority  Optional. The priority of the action. Default is 20.
     * @param int      $arguments Optional. The number of arguments that the callback function accepts. Default is 1.
     * @throws Some_Exception_Class Description of the exception that can be thrown.
     * @return void
     */
    protected function addAction($tag, $callback, $priority = 20, $arguments = 1): void
    {
        Hook::addAction($tag, $callback, $priority, $arguments);
    }

    /**
     * Adds a filter to the specified tag.
     *
     * @param string $tag The tag to add the filter to.
     * @param callable $callback The callback function to execute when the filter is applied.
     * @param int $priority The priority of the filter. Default is 20.
     * @param int $arguments The number of arguments the callback function accepts. Default is 1.
     * @throws Some_Exception_Class A description of the exception that may be thrown.
     * @return void
     */
    protected function addFilter($tag, $callback, $priority = 20, $arguments = 1): void
    {
        Hook::addFilter($tag, $callback, $priority, $arguments);
    }

    /**
     * Apply filters to a given value using a specified tag.
     *
     * @param string $tag The tag to apply filters with.
     * @param mixed $value The value to apply filters to.
     * @param mixed ...$args Additional arguments to pass to the filters.
     * @return mixed The filtered value.
     */
    protected function applyFilters($tag, $value, ...$args): mixed
    {
        return Hook::filter($tag, $value, ...$args);
    }
}


modules\CMS\Abstracts\PaymentMethodAbstract.php
<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     Mojahid
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\CMS\Abstracts;

use Juzaweb\CMS\Traits\Loggers\PaymentLogger;
use Juzaweb\CMS\Traits\TransactionManager;
use Juzaweb\CMS\Models\PaymentMethod;
use Juzaweb\CMS\Contracts\Payment\PaymentMethodInterface;
use Juzaweb\CMS\Enums\PaymentStatus;
use Juzaweb\CMS\Exceptions\PaymentException;

/**
 * @method void beforeFinish()
 * @method void afterFinish()
 * @method void afterUpdateFileAndFolder()
 */
abstract class PaymentMethodAbstract implements PaymentMethodInterface
{
    use PaymentLogger, TransactionManager;


    protected PaymentMethod $paymentMethod;


    protected bool $redirect = false;
    protected bool $successful = false;
    protected string $redirectURL = '';
    protected string $message = '';
    protected array $errors = [];
    protected PaymentStatus $status;

    public function __construct(PaymentMethod $paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
        $this->status = PaymentStatus::PENDING;
    }

    abstract public function purchase(array $params): PaymentMethodInterface;

    abstract public function completed(array $params): PaymentMethodInterface;

    public function isRedirect(): bool
    {
        return $this->redirect;
    }

    public function getRedirectURL(): null|string
    {
        if ($this->isRedirect()) {
            return $this->redirectURL;
        }

        return null;
    }
    public function getMessage(): string
    {
        return $this->message ?: __('Thank you for your order.');
    }


    protected function setRedirectURL(string $url): void
    {
        $this->redirectURL = $url;
    }

    protected function setRedirect(bool $redirect): void
    {
        $this->redirect = $redirect;
    }

    protected function setSuccessful(bool $successful): void
    {
        $this->successful = $successful;
    }

    protected function setMessage(string $message): void

    {
        $this->message = $message;
    }

    protected function processPurchase(array $params): PaymentMethodInterface
    {
        try {
            $this->beginTransaction();
            $this->validatePurchase($params);
            $result = $this->purchase($params);

            $this->commitTransaction();
            return $result;
        } catch (\Exception $e) {
            $this->status = PaymentStatus::FAILED;
            $this->rollbackTransaction();
            $this->logError('Purchase failed', [
                'params' => $params,
                'error' => $e->getMessage()
            ]);
            throw new PaymentException($e->getMessage(), $this->errors, $this->currentTransactionId);
        }
    }

    protected function validatePurchase(array $params): void
    {
        if (empty($params['amount']) || !is_numeric($params['amount'])) {
            throw new PaymentException('Invalid amount');
        }

        if ($params['amount'] <= 0) {
            throw new PaymentException('Amount must be greater than 0');
        }

        // Add more validation as needed
    }

    public function getStatus(): PaymentStatus
    {
        return $this->status;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function hasErrors(): bool
    {
        return !empty($this->errors);
    }

    protected function addError(string $message): void
    {
        $this->errors[] = $message;
    }
}


modules\CMS\Abstracts\ResourceController.php
<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://mojar.com/cms
 * @license    GNU V2
 */

namespace Juzaweb\CMS\Abstracts;

use Juzaweb\CMS\Traits\ResourceController as ResourceControllerTrait;

abstract class ResourceController
{
    use ResourceControllerTrait;
}


modules\CMS\Traits\ResourceController.php
namespace Juzaweb\CMS\Traits;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Inertia\Response;
use Juzaweb\CMS\Abstracts\DataTable;

/**
 * @method void getBreadcrumbPrefix(...$params)
 */
trait ResourceController
{
    public function index(...$params): View|Response
    {
        $this->checkPermission(
            'index',
            $this->getModel(...$params),
            ...$params
        );

        if (method_exists($this, 'getBreadcrumbPrefix')) {
            $this->getBreadcrumbPrefix(...$params);
        }

        return $this->view(
            "{$this->viewPrefix}.index",
            $this->getDataForIndex(...$params)
        );
    }

    public function create(...$params): View|Response
    {
        $this->checkPermission('create', $this->getModel(...$params), ...$params);

        $indexRoute = str_replace(
            '.create',
            '.index',
            Route::currentRouteName()
        );

        if (method_exists($this, 'getBreadcrumbPrefix')) {
            $this->getBreadcrumbPrefix(...$params);
        }

        $this->addBreadcrumb(
            [
                'title' => $this->getTitle(...$params),
                'url' => route($indexRoute, $params),
            ]
        );

        $model = $this->makeModel(...$params);

        return $this->view(
            "{$this->viewPrefix}.form",
            array_merge(
                [
                    'title' => trans('cms::app.add_new'),
                    'linkIndex' => action([static::class, 'index'], $params)
                ],
                $this->getDataForForm($model, ...$params)
            )
        );
    }

    public function edit(...$params): View|Response
    {
        $indexRoute = str_replace(
            '.edit',
            '.index',
            Route::currentRouteName()
        );

        $indexParams = $params;
        unset($indexParams[$this->getPathIdIndex($indexParams)]);
        $indexParams = collect($indexParams)->values()->toArray();

        if (method_exists($this, 'getBreadcrumbPrefix')) {
            $this->getBreadcrumbPrefix(...$params);
        }

        $this->addBreadcrumb(
            [
                'title' => $this->getTitle(...$params),
                'url' => route($indexRoute, $indexParams),
            ]
        );

        $model = $this->getDetailModel($this->makeModel(...$indexParams), ...$params);
        $this->checkPermission('edit', $model, ...$params);

        return $this->view(
            $this->viewPrefix . '.form',
            array_merge(
                [
                    'title' => $model->{$model->getFieldName()},
                    'linkIndex' => action([static::class, 'index'], $indexParams)
                ],
                $this->getDataForForm($model, ...$params)
            )
        );
    }

    public function store(Request $request, ...$params): JsonResponse|RedirectResponse
    {
        $this->checkPermission('create', $this->getModel(...$params), ...$params);

        $validator = $this->validator($request->all(), ...$params);
        if (is_array($validator)) {
            $validator = Validator::make($request->all(), $validator);
        }

        $validator->validate();
        $data = $this->parseDataForSave($request->all(), ...$params);

        DB::beginTransaction();

        try {
            $this->beforeStore($request, ...$params);
            $model = $this->makeModel(...$params);
            $slug = $request->input('slug');

            if ($slug && method_exists($model, 'generateSlug')) {
                $data['slug'] = $model->generateSlug($slug);
            }

            $this->beforeSave($data, $model, ...$params);

            $model->fill($data);

            $model->save();

            $this->afterStore($request, $model, ...$params);
            $this->afterSave($data, $model, ...$params);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        if (method_exists($this, 'storeSuccess')) {
            $this->storeSuccess($request, $model, ...$params);
        }

        if (method_exists($this, 'saveSuccess')) {
            $this->saveSuccess($request, $model, ...$params);
        }

        return $this->storeSuccessResponse(
            $model,
            $request,
            ...$params
        );
    }

    public function update(Request $request, ...$params): JsonResponse|RedirectResponse
    {
        $validator = $this->validator($request->all(), ...$params);
        if (is_array($validator)) {
            $validator = Validator::make($request->all(), $validator);
        }

        $validator->validate();
        $data = $this->parseDataForSave($request->all(), ...$params);

        $model = $this->getDetailModel($this->makeModel(...$params), ...$params);
        $this->checkPermission('edit', $model, ...$params);

        DB::beginTransaction();
        try {
            $this->beforeUpdate($request, $model, ...$params);
            $slug = $request->input('slug');
            if ($slug && method_exists($model, 'generateSlug')) {
                $data['slug'] = $model->generateSlug($slug);
            }

            $model->fill($data);
            $this->beforeSave($data, $model, ...$params);
            $model->save();

            $this->afterUpdate($request, $model, ...$params);
            $this->afterSave($data, $model, ...$params);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        if (method_exists($this, 'updateSuccess')) {
            $this->updateSuccess($request, $model, ...$params);
        }

        if (method_exists($this, 'saveSuccess')) {
            $this->saveSuccess($request, $model, ...$params);
        }

        return $this->updateSuccessResponse(
            $model,
            $request,
            ...$params
        );
    }

    public function datatable(Request $request, ...$params): JsonResponse
    {
        $this->checkPermission(
            'index',
            $this->getModel(...$params),
            ...$params
        );

        $table = $this->getDataTable(...$params);
        $table->setCurrentUrl(action([static::class, 'index'], $params, false));
        list($count, $rows) = $table->getData($request);

        $results = [];
        $columns = $table->columns();

        foreach ($rows as $index => $row) {
            $columns['id'] = $row->id;
            foreach ($columns as $col => $column) {
                if (!empty($column['formatter'])) {
                    $formatter = $column['formatter'](
                        $row->{$col} ?? null,
                        $row,
                        $index
                    );

                    if ($formatter instanceof Renderable) {
                        $formatter = $formatter->render();
                    }

                    $results[$index][$col] = $formatter;
                } else {
                    $results[$index][$col] = $row->{$col};
                }

                if (!empty($column['detailFormater'])) {
                    $results[$index]['detailFormater'] = $column['detailFormater'](
                        $index,
                        $row
                    );
                }
            }
        }

        return response()->json(
            [
                'total' => $count,
                'rows' => $results,
            ]
        );
    }

    public function bulkActions(Request $request, ...$params): JsonResponse|RedirectResponse
    {
        $request->validate(
            [
                'ids' => 'required|array',
                'action' => 'required',
            ]
        );

        $action = $request->post('action');
        $ids = $request->post('ids');

        $table = $this->getDataTable(...$params);
        $results = [];

        foreach ($ids as $id) {
            $model = $this->makeModel(...$params)->find($id);
            $permission = $action != 'delete' ? 'edit' : 'delete';

            if (!$this->hasPermission($permission, $model, ...$params)) {
                continue;
            }

            $results[] = $id;
        }

        $table->bulkActions($action, $results);

        return $this->success(
            [
                'message' => trans('cms::app.successfully'),
            ]
        );
    }

    public function getDataForSelect(Request $request, ...$params): JsonResponse
    {
        $queries = $request->query();
        $exceptIds = $request->get('except_ids');
        $model = $this->makeModel(...$params);
        $limit = $request->get('limit', 10);

        if ($limit > 100) {
            $limit = 100;
        }

        $query = $model::query();
        $query->select(
            [
                'id',
                $model->getFieldName() . ' AS text',
            ]
        );

        $query->whereFilter($queries);

        if ($exceptIds) {
            $query->whereNotIn('id', $exceptIds);
        }

        $paginate = $query->paginate($limit);
        $data['results'] = $query->get();
        if ($paginate->nextPageUrl()) {
            $data['pagination'] = ['more' => true];
        }

        return response()->json($data);
    }

    protected function getDetailModel(Model $model, ...$params): Model
    {
        return $model
            ->where($this->editKey ?? 'id', $this->getPathId($params))
            ->firstOrFail();
    }

    protected function beforeStore(Request $request, ...$params)
    {
        //
    }

    protected function afterStore(Request $request, $model, ...$params)
    {
        //
    }

    protected function beforeUpdate(Request $request, $model, ...$params)
    {
        //
    }

    protected function afterUpdate(Request $request, $model, ...$params)
    {
        //
    }

    protected function beforeSave(&$data, &$model, ...$params)
    {
        //
    }

    /**
     * After Save model
     *
     * @param  array  $data
     * @param  \Juzaweb\CMS\Models\Model  $model
     * @param  mixed  $params
     */
    protected function afterSave($data, $model, ...$params)
    {
        //
    }

    /**
     * @param $params
     * @return \Juzaweb\CMS\Models\ResourceModel
     */
    protected function makeModel(...$params)
    {
        return app($this->getModel(...$params));
    }

    protected function parseDataForSave(array $attributes, ...$params)
    {
        return $attributes;
    }

    /**
     * Get data for form
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return array
     * @throws \Exception
     */
    protected function getDataForForm($model, ...$params)
    {
        $data = [
            'model' => $model
        ];

        if (method_exists($this, 'getSetting')) {
            $data['setting'] = $this->getSetting(...$params);
        }

        return $data;
    }

    /**
     * @throws \Exception
     */
    protected function getDataForIndex(...$params)
    {
        $dataTable = $this->getDataTable(...$params);
        $dataTable->setDataUrl(action([static::class, 'datatable'], $params));
        $dataTable->setActionUrl(action([static::class, 'bulkActions'], $params));
        $dataTable->setCurrentUrl(action([static::class, 'index'], $params, false));

        $canCreate = $this->hasPermission(
            'create',
            $this->getModel(...$params),
            ...$params
        );

        $data = [
            'title' => $this->getTitle(...$params),
            'dataTable' => $dataTable,
            'canCreate' => $canCreate,
            'linkCreate' => action([static::class, 'create'], $params),
        ];

        if (method_exists($this, 'getSetting')) {
            $data['setting'] = $this->getSetting(...$params);
        }

        return $data;
    }

    protected function getPathIdIndex($params)
    {
        return count($params) - 1;
    }

    protected function getPathId($params)
    {
        return $params[$this->getPathIdIndex($params)];
    }

    protected function storeSuccessResponse($model, $request, ...$params)
    {
        $indexRoute = str_replace(
            '.store',
            '.index',
            Route::currentRouteName()
        );

        return $this->success(
            [
                'message' => trans('cms::app.created_successfully'),
                'redirect' => route($indexRoute, $params),
            ]
        );
    }

    protected function updateSuccessResponse($model, $request, ...$params)
    {
        return $this->success(
            [
                'message' => trans('cms::app.updated_successfully'),
            ]
        );
    }

    protected function isUpdateRoute()
    {
        return Route::getCurrentRoute()->getName() == 'admin.resource.update';
    }

    protected function checkPermission($ability, $arguments = [], ...$params)
    {
        $this->authorize($ability, $arguments);
    }

    protected function hasPermission($ability, $arguments = [], ...$params)
    {
        $response = Gate::inspect($ability, $arguments);
        return $response->allowed();
    }

    /**
     * Get data table resource
     *
     * @return DataTable
     */
    abstract protected function getDataTable(...$params);

    /**
     * Validator for store and update
     *
     * @param  array  $attributes
     * @param  mixed  ...$params
     * @return Validator|array
     */
    abstract protected function validator(array $attributes, ...$params);

    /**
     * Get model resource
     *
     * @param  array  $params
     * @return string // namespace model
     */
    abstract protected function getModel(...$params);

    /**
     * Get title resource
     *
     * @param  array  $params
     * @return string
     */
    abstract protected function getTitle(...$params);
}

modules\CMS\Contracts\HookActionContract.php
<?php

namespace Juzaweb\CMS\Contracts;

use Exception;
use Illuminate\Support\Collection;
use Juzaweb\API\Support\Swagger\SwaggerDocument;

interface HookActionContract
{
    public function addAction($tag, $callback, $priority = 20, $arguments = 1): void;
    public function addFilter($tag, $callback, $priority = 20, $arguments = 1): void;

    public function registerPostType(string $key, array $args = []): void;

    public function registerPermalink(string $key, array $args = []): void;

    public function registerTaxonomy(string $taxonomy, array|string $objectType, array $args = []): void;
    public function registerResource(string $key, ?string $postType = null, ?array $args = []): void;
    public function registerMenuBox(string $key, array $args = []): void;
    public function addSettingForm(string $key, array $args = []): void;
    public function addAdminMenu(string $menuTitle, string $menuSlug, array $args = []): void;
    public function addMasterAdminMenu(string $menuTitle, string $menuSlug, array $args = []): void;

    public function addThumbnailSizes(string $postType, string|array $size): void;
    public function applyFilters(string $tag, mixed $value, ...$args): mixed;
    public function getMenuBoxs(string|array $keys = []): array;
    public function enqueueScript(string $key, string $src = '', string $ver = '1.0', bool $inFooter = false): void;

    public function enqueueStyle(string $key, string $src = '', string $ver = '1.0', bool $inFooter = false): void;
    public function enqueueFrontendScript(
        string $key,
        string $src = '',
        string $ver = '1.0',
        bool   $inFooter = false
    ): void;

    public function enqueueFrontendStyle(
        string $key,
        string $src = '',
        string $ver = '1.0',
        bool   $inFooter = false
    ): void;

    public function getProfilePages($key = null): Collection;
    public function registerPermission(string $key, array $args = []): void;
    public function registerPermissionGroup(string $key, array $args = []): void;
    public function registerResourcePermissions(string $resource, string $name): void;

    public function registerConfig(array|string $key, array $args = []): void;


    public function getPermissions(?string $key = null): Collection;

    public function getConfigs(string|null $key = null): Collection;

    public function getTaxonomies(string|array|null $postType = null): Collection;

    public function addMetaPostTypes(string $postType, array $metas): void;

    public function registerEmailTemplate(string $key, array $args = []): void;

    public function getThumbnailSizes(?string $postType = null): Collection;

    public function getPostTypes(string $postType = null): Collection;

    public function getEmailTemplates(?string $key = null): ?Collection;

    public function registerAdminPage(string $key, array $args): void;

    public function getAPIDocuments(?string $key = null): null|Collection|SwaggerDocument;

    public function getDataByKey(string $dataKey, string $key = null): ?Collection;

    public function registerEmailHook(string $key, array $args = []): void;

    public function registerSidebar(string $key, array $args = []): void;
    public function registerWidget(string $key, array $args = []): void;
    public function registerPageBlock(string $key, array $args = []): void;

    public function registerSettingPage(string $key, array $args = []): void;

    public function registerAdminAjax(string $key, array $args = []): void;

    public function registerNavMenus(array $locations = []): void;

    public function registerFrontendAjax(string $key, array $args = []): void;

    public function registerThemeTemplate(string $key, array $args = []): void;

    public function registerThemeSetting(string $name, string $label, array $args = []): void;

    public function getPermalinks(?string $key = null): array|Collection|null;

    public function getEmailHooks(?string $key = null): ?Collection;

    public function getWidgets(?string $key = null): ?Collection;

    public function getPageBlocks(?string $key = null): ?Collection;

    public function getFrontendAjaxs(string $key = null): Collection|bool;

    public function getThemeTemplates(string $key = null): ?Collection;
}
modules\CMS\Http\Controllers\FrontendController.php
namespace Juzaweb\CMS\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\View\View;
use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Juzaweb\CMS\Facades\Theme;
use Juzaweb\CMS\Traits\ResponseMessage;
use Symfony\Component\HttpFoundation\Response;

class FrontendController extends Controller
{
    use ResponseMessage;

    protected string $template;

    public function callAction($method, $parameters): Response|string|View|\Inertia\Response
    {
        $this->template = Theme::currentTheme()->getTemplate();

        /**
         * Action after call action frontend
         * Add action to this hook add_action('frontend.call_action', $callback)
         */
        do_action(Action::FRONTEND_CALL_ACTION, $method, $parameters);

        do_action(Action::WIDGETS_INIT);

        do_action(Action::BLOCKS_INIT);

        return parent::callAction($method, $parameters);
    }

    protected function getPermalinks($base = null)
    {
        if ($base) {
            return collect(HookAction::getPermalinks())
                ->where('base', $base)
                ->first();
        }

        return collect(HookAction::getPermalinks());
    }

    protected function view($view, $params = []): Factory|ViewContract|string|\Inertia\Response
    {
        return Theme::render($view, $params);
    }
}

modules\CMS\Http\Controllers\BackendController.php

<?php

/**
 * Mojar - Laravel CMS for Your Project
 *
 * @package    mojar/cms
 * @author     The Anh Dang
 * @link       https://github.com/mojar/cms
 * @license    GNU V2
 *
 * Created by JUZAWEB.
 * Date: 5/25/2021
 * Time: 10:10 PM
 */

namespace Juzaweb\CMS\Http\Controllers;

use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;
use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Traits\ResponseMessage;

class BackendController extends Controller
{
    use ResponseMessage;

    /**
     * @var string $template Support blade,inertia
     */
    protected string $template = 'blade';

    public function callAction($method, $parameters)
    {
        do_action(Action::BACKEND_CALL_ACTION, $method, $parameters);

        return parent::callAction($method, $parameters);
    }

    /**
     * A description of the entire PHP function.
     *
     * @param string|null $view The name of the view to render. Defaults to null.
     * @param array $data An associative array of data to pass to the view. Defaults to an empty array.
     * @return View|Response Returns an instance of the View or Response class.
     */
    protected function view(?string $view = null, array $data = []): View|Response
    {
        return match ($this->template) {
            'inertia' => $this->inertiaViewRender($view, $data),
            default => view($view, $data),
        };
    }

    /**
     * Renders an Inertia view with optional data.
     *
     * @param ?string $view The name of the view to render. If null, the default view will be used.
     * @param array $data Optional data to pass to the view.
     * @return Response The rendered Inertia view.
     */
    protected function inertiaViewRender(?string $view = null, array $data = []): Response
    {
        // Remove backend blade prifix
        $view = Str::replace('cms::backend.', '', $view);

        // Replate . to /
        $view = Str::replace('.', '/', $view);

        // Render Inertia view
        return Inertia::render($view, $data);
    }

    /**
     * Adds a breadcrumb item to the specified breadcrumb list.
     *
     * @param array $item The breadcrumb item to be added.
     * @param string  $name The name of the breadcrumb list. Default is 'admin'.
     * @return void
     *@throws Exception If there is an error adding the breadcrumb item.
     */
    protected function addBreadcrumb(array $item, string $name = 'admin'): void
    {
        add_filters(
            $name . '_breadcrumb',
            function ($items) use ($item) {
                $items[] = $item;

                return $items;
            }
        );
    }

    /**
     * Adds a message to the backend message system.
     *
     * @param string $key The key for the message.
     * @param string|array $message The message or an array of messages.
     * @param string $type The type of the message (default: 'warning').
     * @throws Exception If an error occurs while adding the message.
     * @return void
     */
    protected function addMessage(
        string $key,
        string|array $message,
        string $type = 'warning'
    ): void {
        $message = is_string($message) ? [$message] : $message;

        add_backend_message(
            $key,
            $message,
            $type
        );
    }
}



now i give you theme structure and module structure
my system theme folder strucutre 

|- theme-name
    |- assets 
        |- css
          - all css
        |- css
          - all js
        |- public
            - css [build css by mix]
            - js [build js by mix]
        |- mix.js
    |- data (optional)
        |- blocks
        |- widgets
    |- views
        |- auth (optional)
            - login.twig
            - register.twig
            - forgot_password.twig
        |- profile (optional)
            - index.twig
        |- components
            |- blocks (optional)
            |- widgets (optional)
            - pagination.twig
        |- template-parts
            - content.twig
            - single.twig
            - taxonomy.twig
        |- templates (optional)
        - 404.twig (optional)
        - footer.twig
        - header.twig
        - index.twig
        - search.twig
    - changelog.yml
    - register.json
    - theme.json

    # This project uses  
Mojar is a Content Management System (CMS) developed based on Laravel Framework and web platform whose sole purpose is to make your development workflow simple again. Project develop by Juzaweb @https://github.com/juzaweb/cms


    ## Twig Template Engine
- Follow All best prectises of Twig Template Engine

themes\edufax\views\index.twig

{% extends 'cms::layouts.frontend' %}

{% block content %}

    {# 
        {% include 'theme::components.breadcrumb' with {
            is_dynamic: true,
            post: post,
            background_image: post.thumbnail ?? theme_assets('images/breadcrumb_bg.jpg')
        } %}
     #}

    {% include 'theme::components.breadcrumb' with {
        title: 'Blog List',
        background_image: 'images/breadcrumb_bg.jpg',
        items: [
            {'label': 'Home', 'url': '/'},
            {'label': 'Blogs'}
        ]
    } %}

    <section class="tf__blog_page pt_120 xs_pt_80 pb_120 xs_pb_80">
        <div class="container">
            <form class="tf__blog_search_area" id="post-filter-form">
                <div class="row justify-content-between wow fadeInUp" data-wow-duration="1s">
                    <div class="col-xl-4 col-md-6 col-lg-5">
                        <div class="tf__blog_search_item">
                            <label>Search Here</label>
                            <div class="tf__blog_search_input">
                                <input type="text" name="keyword" placeholder="Type here" class="post-filter">
                                <button type="submit"><i class="far fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-md-6 col-lg-5">
                        <div class="tf__blog_search_item">
                            <label>By Category</label>
                            <div class="tf__blog_search_input">
                                <select class="select_js post-filter" name="category">
                                    <option value=""> Please Select </option>
                                    {% for category in get_taxonomies('categories') %}
                                        <option value="{{ category.id }}">{{ category.name }}</option>
                                    {% endfor %}
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <div class="row mt_35" id="post-list">
                {% for post in page.data %}
                    {{ get_template_part(post, 'content') }}
                {% endfor %}
            </div>
            <div class="tf__pagination mt_60">
                <div class="row">
                    <div class="col-12" id="pagination">
                        {{ paginate_links(page, 'theme::components.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
{% endblock %}

themes\edufax\views\profile\index.twig
{% extends 'cms::layouts.frontend' %}

{% block content %}
    {% include 'theme::components.breadcrumb' with {
        title: page.title,
        background_image: 'images/breadcrumb_bg.jpg',
        items: [
            {'label': 'Home', 'url': '/'},
            {'label': page.title}
        ]
    } %}
    <section class="tf__dashboard mt_190 xs_mt_95">
        <div class="container">
            <div class="tf__dashboard_area">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 wow fadeInLeft" data-wow-duration="1s">
                        <div class="tf__dashboard_sidebar">
                            <div class="tf__dashboard_sidebar_user">
                                <div class="img">
                                    <img src="{{ user.avatar }}" alt="user" class="img-fluid w-100">
                                    <label for="upload">
                                        <img src="images/camera_icon.png" alt="upload" class="img-fluid w-100">
                                    </label>
                                    <input type="file" id="upload" hidden>
                                </div>
                                <h2>{{ user.name }}</h2>
                                <p>{{ user.role }}</p>
                            </div>
                            <div class="tf__dashboard_sidebar_menu">
                                <ul>
                                    {% for menu_page in pages %}
                                        <li>
                                            <a class="{% if page.key is defined and page.key == menu_page.key %}active{% endif %}" 
                                            href="{{ route('profile', [menu_page.key]) }}">
                                                <i class="{{ menu_page.icon }}"></i> {{ menu_page.title }}
                                            </a>
                                        </li>
                                    {% endfor %}
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-9 col-lg-8 wow fadeInRight" data-wow-duration="1s">
                        <div class="tf__dashboard_body">
                            <h2>{{ page.title }}</h2>
                            <div class="tf__dashboard_overview">
                                {% if page.contents is defined and page.contents is not empty %}
                                    {% include page.contents with {
                                        data: page.data|default([])
                                    } %}
                                {% else %}
                                    <div class="alert alert-info">
                                        {{ __('No content available for this section.') }}
                                    </div>
                                {% endif %}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

{% endblock %}


now i give you plugin structure and module structure [this is the main from hear]
plugins\ecommerce\composer.json
{
    "name": "mojahid/ecommerce",
    "description": "This plugin Developed For Maintain Ecommerce",
    "extra": {
        "mojar": {
            "name": "Ecommerce",
            "domain": "ecomm",
            "cms_min": "3.3",
            "version": "1.0.0",
            "providers": [
                "Mojahid\\Ecommerce\\Providers\\EcommerceServiceProvider"
            ]
        }
    },
    "autoload": {
        "psr-4": {
            "Mojahid\\Ecommerce\\": "src/"
        },
        "files": [
            "helpers/helpers.php"
        ]
    }
}

plugins\ecommerce\config\ecommerce.php
<?php

return [
    /**
     * Cart Helper class support
     */
    'cart' => \Mojahid\Ecommerce\Supports\DBCart::class,

    /**
     * Payment method supported
     */
    'payment_methods' => [
        'cod' => 'Cash on delivery',
        'paypal' => 'Paypal',
        'custom' => 'Custom',
    ],
];

plugins\ecommerce\src\Actions\EcommerceAction.php
<?php

namespace Mojahid\Ecommerce\Actions;

use Mojahid\Ecommerce\Models\Product;
use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Illuminate\Support\Arr;
use Juzaweb\CMS\Http\Resources\PaymentMethodCollectionResource;
use Juzaweb\CMS\Models\PaymentMethod;
use Mojahid\Ecommerce\Supports\Manager\CurrencyManager;
use Mojahid\Ecommerce\Http\Controllers\Frontend\CartController as FrontendCartController;
use Mojahid\Ecommerce\Http\Controllers\Frontend\CheckoutController as FrontendCheckoutController;

class EcommerceAction extends Action
{
    public function handle(): void
    {
        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerConfigs']
        );
        

        $this->addFilter(
            'theme.get_view_page',
            [$this, 'addCheckoutPage'],
            20,
            2
        );

        $this->addFilter(
            'theme.get_params_page',
            [$this, 'addCheckoutParams'],
            20,
            2
        );

        /**
         * Convert and format price
         */
        $this->addFilter(
             'ecommerce.format_price',
             [$this, 'convertAndFormatPrice'],
             20,
             2
        );

        $this->addAction(
            Action::FRONTEND_CALL_ACTION,
            [$this, 'registerFrontendAjaxs']
        );
    }



    public function registerConfigs(): void
    {
        HookAction::registerConfig(
            [
                '_checkout_page',
                '_thanks_page',
            ]

        );
    }

    public function addCheckoutPage($view, $page): string
    {
        $checkoutPage = get_config('_checkout_page');
        $thanksPage = get_config('_thanks_page');


        if ($checkoutPage == $page->id) {
            return 'ecomm::frontend.checkout.index';
        }

        if ($thanksPage == $page->id) {
            return 'ecomm::frontend.checkout.thankyou';
        }

        return $view;
    }

    public function addCheckoutParams($params, $page)
    {
        $checkoutPage = get_config('_checkout_page');
        $thanksPage = get_config('_thanks_page');

        if ($checkoutPage == $page->id) {
            $methods = PaymentMethod::active()->get();

            $params['payment_methods'] = (new PaymentMethodCollectionResource($methods))->toArray(request());
        }

        return $params;
    }

    /**
     * Convert and format price
     */
    public function convertAndFormatPrice($formatted, $basePrice = null)
    {
        return app(CurrencyManager::class)->formatPrice(
            app(CurrencyManager::class)->convertPrice($basePrice)
        );
    }

    public function registerFrontendAjaxs(): void
    {
        HookAction::registerFrontendAjax(
            'checkout',
            [
                'callback' => [FrontendCheckoutController::class, 'checkout'],
                'method' => 'POST',
            ]
        );

        HookAction::registerFrontendAjax(
            'cart.add-to-cart',
            [
                'callback' => [FrontendCartController::class, 'addToCart'],
                'method' => 'POST',
            ]
        );

        HookAction::registerFrontendAjax(
            'cart.get-items',
            [
                'callback' => [FrontendCartController::class, 'getCartItems'],
            ]
        );

        HookAction::registerFrontendAjax(
            'cart.remove-item',
            [
                'callback' => [FrontendCartController::class, 'removeItem'],
            ]
        );

        HookAction::registerFrontendAjax(
            'cart.update',
            [
                'callback' => [FrontendCartController::class, 'update'],
                'method' => 'POST',
            ]
        );

        HookAction::registerFrontendAjax(
            'payment.cancel',
            [
                'callback' => [FrontendCheckoutController::class, 'cancel'],
            ]
        );

        HookAction::registerFrontendAjax(
            'payment.completed',
            [
                'callback' => [FrontendCheckoutController::class, 'completed'],
            ]
        );
    }
}

plugins\ecommerce\src\Actions\EcommercePostTypeAction.php
<?php

namespace Mojahid\Ecommerce\Actions;

use Illuminate\Support\Arr;
use Juzaweb\CMS\Abstracts\Action;
use Juzaweb\CMS\Facades\HookAction;
use Mojahid\Ecommerce\Models\DownloadLink;
use Mojahid\Ecommerce\Models\Product;
use Mojahid\Ecommerce\Models\ProductVariant;
use Juzaweb\Backend\Models\Post;
use Mojahid\Ecommerce\Http\Resources\ProductVariantResource;

class EcommercePostTypeAction extends Action
{
    public function handle(): void
    {
        $this->addAction(
            Action::INIT_ACTION,
            [$this, 'registerPostTypes']
        );
        
        $this->addAction(
            'post_type.products.form.left',
            [$this, 'addFormProduct']
        );

        $this->addFilter(
            'post_type.products.parseDataForSave',
            [$this, 'parseDataForSave']
        );
        
        $this->addAction(
            "post_type.products.after_save",
            [$this, 'saveDataProduct'],
            20,
            2
        );

        $this->addFilter('post.withFrontendDetailBuilder', [$this, 'addWithVariantsProductDetail']);

        $this->addFilter('jw.resource.post.products', [$this, 'addVariantsProductDetail'], 20, 2);
    }

    /**
     * Register post types
    */
    public function registerPostTypes(): void
    {
        $productInvisibleMetas = [
            'price',
            'sku_code',
            'barcode',
            'quantity',
            'inventory_management',
            'disable_out_of_stock',
            'downloadable',
        ];

        HookAction::registerPostType(
            'products',
            [
                'label' => trans('ecomm::content.products'),
                'menu_icon' => '<svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-package"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 3l8 4.5l0 9l-8 4.5l-8 -4.5l0 -9l8 -4.5" /><path d="M12 12l8 -4.5" /><path d="M12 12l0 9" /><path d="M12 12l-8 -4.5" /><path d="M16 5.25l-8 4.5" /></svg>',
                'menu_position' => 10,
                'supports' => [
                    'category',
                    'tag'
                ],
                'metas' => collect($productInvisibleMetas)
                    ->mapWithKeys(
                        fn ($item) => [$item => ['visible' => false]]
                    )
                    ->toArray(),
            ]
        );

        HookAction::registerTaxonomy(
            'brands',
            'products',
            [
                'label' => trans('ecomm::content.brands'),
                'menu_position' => 11,
            ]
        );

        HookAction::registerTaxonomy(
            'vendors',
            'products',
            [
                'label' => trans('ecomm::content.vendors'),
                'menu_position' => 12,
            ]
        );
    }

    public function addFormProduct($model): void
    {
        $variant = ProductVariant::findByProduct($model->id);
        if ($variant === null) {
            $variant = new ProductVariant();
        }

        echo e(
            view(
                'ecomm::backend.product.form',
                compact(
                    'variant',
                    'model'
                )
            )
        );
    }

    public function parseDataForSave($data)
    {
        $metas = (array) $data['meta'];
        if ($metas['price']) {
            $metas['price'] = parse_price_format($metas['price']);
        }

        if ($metas['compare_price']) {
            $metas['compare_price'] = parse_price_format($metas['compare_price']);
        }

        $metas['inventory_management'] = $metas['inventory_management'] ?? 0;
        $metas['disable_out_of_stock'] = $metas['disable_out_of_stock'] ?? 0;
        $metas['downloadable'] = $metas['downloadable'] ?? 0;

        if ($metas['quantity']) {
            $metas['quantity'] = (int) $metas['quantity'];
            $metas['quantity'] = max($metas['quantity'], 0);
        }

        $data['meta'] = $metas;
        return $data;
    }

    public function saveDataProduct($model, $data): void
    {
        if (Arr::has($data, 'meta')) {
            $variant = ProductVariant::findByProduct($model->id);
            $variantData = $data['meta'];
            $variantData['thumbnail'] = $data['thumbnail'];
            $variantData['description'] = seo_string(strip_tags($data['content']), 320);

            if ($variant) {
                $variant->update($variantData);
            } else {
                $variantData['title'] = 'Default';
                $variantData['names'] = ['Default'];
                $variantData['post_id'] = $model->id;

                $variant = ProductVariant::updateOrCreate(
                    ['id' => $variant->id ?? 0],
                    $variantData
                );
            }

            if ($downloadLinks = Arr::get($data, 'download_links')) {
                foreach ($downloadLinks as $link) {
                    $link['product_id'] = $model->id;
                    $ids[] = DownloadLink::updateOrCreate(
                        [
                            'id' => $link['id'],
                            'product_id' => $model->id,
                            'variant_id' => $variant->id,
                        ],
                        $link
                    )->id;
                }

                DownloadLink::whereNotIn('id', $ids)
                    ->where(['product_id' => $model->id, 'variant_id' => $variant->id])
                    ->delete();
            }
        }
    }

    
    public function addWithVariantsProductDetail(array $with): array
    {
        $with['variants'] = fn ($q) => $q->cacheFor(
            config('juzaweb.performance.query_cache.lifetime')
        );

        return $with;
    }

    public function addVariantsProductDetail(array $data, Post $resource): array
    {
        $data['variants'] = ProductVariantResource::collection($resource->variants)
            ->response()
            ->getData(true)['data'];
        return $data;
    }

}

plugins\ecommerce\src\Contracts\CartContract.php
<?php

namespace Mojahid\Ecommerce\Contracts;

use Illuminate\Support\Collection;
use Mojahid\Ecommerce\Models\Cart;

interface CartContract
{
    public function make(string|Cart $cart): static;
    public function add(int $postId, string $type, int $quantity): bool;
    public function update(int $postId, string $type, int $quantity): bool;
    public function addOrUpdate(int $postId, string $type, int $quantity): bool;
    public function bulkUpdate(array $items): bool;
    public function removeItem(int $postId, string $type): bool;
    public function remove(): bool;
    public function getItems(): array;
    public function isEmpty(): bool;
    public function isNotEmpty(): bool;
    public function totalItems(): int;
    public function totalPrice(): float;
    public function getCollectionItems(): Collection;
    public function getCode(): string;
    public function toArray(): array;
}

plugins\ecommerce\src\Contracts\CartManagerContract.php
<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Contracts;

use Mojahid\Ecommerce\Models\Cart;

interface CartManagerContract
{
    public function find(string|Cart $cart = null): CartContract;

    public function getCodeCurrentCart(): string;
}
plugins\ecommerce\src\Contracts\OrderCreaterContract.php
<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Contracts;

use Juzaweb\CMS\Models\User;
use Mojahid\Ecommerce\Models\Order;

interface OrderCreaterContract
{
    public function create(array $data, array $items, User $user): Order;
}

plugins\ecommerce\src\Contracts\OrderManagerContract.php
<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Contracts;

use Juzaweb\CMS\Models\User;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Supports\OrderInterface;

/**
 * @see \Juzaweb\Ecommerce\Supports\Manager\OrderManager
 */
interface OrderManagerContract
{
    public function find(Order|string|int $order): null|OrderInterface;

    public function createByCart(CartContract $cart, array $data, User $user): OrderInterface;

    public function createByItems(array $data, array $items, User $user): OrderInterface;
}

plugins\ecommerce\src\Extensions\TwigExtension.php
<?php

namespace Mojahid\Ecommerce\Extensions;

use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

class TwigExtension extends AbstractExtension
{
    public function getName(): string
    {
        return 'App_Extension_Ecommerce_Custom';
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('ecom_get_cart_items', 'ecom_get_cart_items'),
            new TwigFunction('ecom_get_payment_methods', 'ecom_get_payment_methods'),
            new TwigFunction('ecom_get_cart', 'ecom_get_cart'),
        ];
    }
}

plugins\ecommerce\src\Http\Controllers\Frontend\CartController.php
<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Http\Controllers\Frontend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Juzaweb\CMS\Http\Controllers\FrontendController;
use Mojahid\Ecommerce\Contracts\CartContract;
use Mojahid\Ecommerce\Contracts\CartManagerContract;
use Mojahid\Ecommerce\Http\Requests\AddToCartRequest;
use Mojahid\Ecommerce\Http\Requests\BulkUpdateCartRequest;
use Mojahid\Ecommerce\Http\Requests\RemoveItemCartRequest;
use Mojahid\Ecommerce\Http\Resources\CartResource;
use Juzaweb\CMS\Abstracts\Action;

class CartController extends FrontendController
{
    protected CartManagerContract $cartManager;
    protected bool $themeView = false;
    protected const VIEW_PATH = 'ecomm::frontend.cart.index';
    protected const THEME_VIEW_PATH = 'theme::frontend.cart.index';

    public function __construct(CartManagerContract $cartManager)
    {
        $this->cartManager = $cartManager;
    }

    public function index(): View
    {
        $this->initializeThemeView();
        $cart = $this->cartManager->find();

        return view($this->getViewPath(), $this->getViewData($cart));
    }

    protected function initializeThemeView(): void 
    {
        if ($this->isCartRoute() && $this->themeViewExists()) {
            $this->themeView = true;
            $this->initializeThemeActions();
        }
    }

    protected function isCartRoute(): bool
    {
        return request()->route()->getName() === 'ecomm.cart';
    }

    protected function themeViewExists(): bool
    {
        return view()->exists(self::THEME_VIEW_PATH);
    }

    protected function initializeThemeActions(): void
    {
        do_action('ecomm.cart.index');
        do_action(Action::WIDGETS_INIT);
        do_action(Action::BLOCKS_INIT);
    }

    protected function getViewPath(): string
    {
        return $this->themeView ? self::THEME_VIEW_PATH : self::VIEW_PATH;
    }

    protected function getViewData(CartContract $cart): array
    {
        return [
            'title' => trans('ecomm::content.shopping_cart'),
            'cart' => $cart,
            'items' => new CartResource($cart),
            'total_items' => $cart->totalItems(),
            'total_price' => ecom_price_with_unit($cart->totalPrice())
        ];
    }

    public function addToCart(AddToCartRequest $request): HttpResponse|JsonResponse|RedirectResponse
    {
        $postId = $request->input('post_id');
        $type = $request->input('type', 'product');
        $quantity = $request->input('quantity');

        $cart = $this->cartManager->find();

        DB::beginTransaction();
        try {
            $cart->addOrUpdate($postId, $type, $quantity);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return $this->error([
                'message' => $e->getMessage(),
            ]);
        }

        return $this->responseCartWithCookie(
            $cart,
            trans('ecomm::content.added_to_cart_successfully')
        );
    }

    public function removeItem(RemoveItemCartRequest $request): JsonResponse|RedirectResponse
    {
        $postId = $request->input('post_id');
        $type = $request->input('type', 'product');

        $cart = $this->cartManager->find();

        DB::beginTransaction();
        try {
            $cart->removeItem($postId, $type);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return $this->error([
                'message' => $e->getMessage(),
            ]);
        }

        return $this->responseCartWithCookie(
            $cart,
            trans('ecomm::content.item_removed_successfully')
        );
    }

    public function bulkUpdate(
        BulkUpdateCartRequest $request
    ): HttpResponse|JsonResponse|RedirectResponse {
        $items = (array) $request->input('items');
        $cart = $this->cartManager->find();

        DB::beginTransaction();
        try {
            $cart->bulkUpdate($items);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return $this->error([
                'message' => $e->getMessage(),
            ]);
        }

        return $this->responseCartWithCookie(
            $cart,
            trans('ecomm::content.cart_updated_successfully')
        );
    }

    public function remove(): JsonResponse|RedirectResponse
    {
        $cart = $this->cartManager->find();

        DB::beginTransaction();
        try {
            $cart->remove();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            return $this->error([
                'message' => $e->getMessage(),
            ]);
        }

        return $this->success([
            'message' => trans('ecomm::content.cart_cleared_successfully'),
            'cart' => new CartResource($cart),
        ]);
    }

    public function getCartItems(): JsonResponse
    {
        $cart = $this->cartManager->find();

        return response()->json([
            'code' => $cart->getCode(),
            'total_items' => $cart->totalItems(),
            'total_price' => ecom_price_with_unit($cart->totalPrice()),
            'items' => new CartResource($cart)
        ]);
    }

    protected function responseCartWithCookie(CartContract $cart, string $message): JsonResponse|RedirectResponse
    {
        $cookie = Cookie::make('jw_cart', $cart->getCode(), 43200);

        return $this->success([
            'cart' => new CartResource($cart),
            'message' => $message,
        ])->withCookie($cookie);
    }
}
plugins\ecommerce\src\Http\Controllers\Frontend\CheckoutController.php
<?php


namespace Mojahid\Ecommerce\Http\Controllers\Frontend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Juzaweb\Backend\Events\Users\RegisterSuccessful;
use Juzaweb\CMS\Events\EmailHook;
use Juzaweb\CMS\Http\Controllers\FrontendController;
use Juzaweb\CMS\Models\User;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Contracts\CartManagerContract;
use Mojahid\Ecommerce\Contracts\OrderManagerContract;
use Mojahid\Ecommerce\Events\OrderSuccess;
use Mojahid\Ecommerce\Events\PaymentSuccess;
use Mojahid\Ecommerce\Http\Requests\CheckoutRequest;

class CheckoutController extends FrontendController
{
    protected CartManagerContract $cartManager;

    protected OrderManagerContract $orderManager;

    public function __construct(
        CartManagerContract $cartManager,
        OrderManagerContract $orderManager
    ) {
        $this->cartManager = $cartManager;
        $this->orderManager = $orderManager;
    }

    /**
     * @throws \Throwable
     */
    public function checkout(CheckoutRequest $request): JsonResponse|RedirectResponse
    {
        $cart = $this->cartManager->find();

        if ($cart->isEmpty()) {
            return $this->error(
                [
                    'message' => __('Cart is empty.'),
                ]
            );
        }

        DB::beginTransaction();
        try {
            $user = $this->getOrderUser($request);

            $newOrder = $this->orderManager->createByCart(
                $cart,
                $request->all(),
                $user
            );

            $cart->remove();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        event(new OrderSuccess($newOrder, $user));

        $params = apply_filters(
            'ecom_checkout_success_email_params',
            [
                'name' => $user->name,
                'email' => $user->email,
                'order_code' => $newOrder->getOrder()->code,
            ],
            $user,
            $newOrder->getOrder()
        );

        event(
            new EmailHook(
                'checkout_success',
                [
                    'to' => $user->email,
                    'params' => $params,
                ]
            )
        );

        try {
            $purchase = $newOrder->purchase();

            $redirect = $purchase->isRedirect() ?
                $purchase->getRedirectURL() :
                    $this->getThanksPageURL($newOrder->getOrder());

            return $this->success(
                [
                    'redirect' => $redirect,
                    'message' => trans('ecomm::content.order_thanks'),
                ]
            );
        } catch (\Exception $e) {
            report($e);

            return $this->error(
                [
                    'redirect' => $this->getThanksPageURL($newOrder->getOrder()),
                    'message' => 'Cannot get payment url.',
                ]
            );
        }
    }

    public function cancel(Request $request): RedirectResponse
    {
        $order = Order::findByCode($request->input('order'));

        return redirect()->to($this->getThanksPageURL($order));
    }

    public function completed(Request $request): RedirectResponse
    {
        $helper = $this->orderManager->find($request->input('order'));
        $order = $helper->getOrder();

        if ($order->isPaymentCompleted()) {
            return redirect()->to($this->getThanksPageURL($order));
        }

        if ($helper?->completed($request->all())) {
            $params = apply_filters(
                'ecom_payment_success_email_params',
                [
                    'name' => $helper->getOrder()?->user->name,
                    'email' => $helper->getOrder()?->user->email,
                    'order_code' => $helper->getOrder()->code,
                ],
                $order?->user,
                $order
            );

            if ($order?->user->email) {
                event(
                    new EmailHook(
                        'payment_success',
                        [
                            'to' => $order->user->email,
                            'params' => $params,
                        ]
                    )
                );
            }

            event(new PaymentSuccess($order));
        }

        return redirect()->to($this->getThanksPageURL($order));
    }

    protected function getOrderUser(Request $request): User
    {
        global $jw_user;

        if ($jw_user) {
            return $jw_user;
        }

        $email = $request->input('email');
        if ($user = User::whereEmail($email)->first()) {
            return $user;
        }

        $password = Hash::make(Str::random());
        $user = new User();
        $user->fill(
            [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
            ]
        );

        $user->setAttribute('password', $password);
        $user->save();

        event(new RegisterSuccessful($user));

        return $user;
    }

    protected function getThanksPageURL(Order $order): string
    {
        if (!$thanksPage = get_config('ecom_thanks_page')) {
            return '/';
        }

        $thanksPage = get_page_url($thanksPage);

        if (empty($thanksPage)) {
            return '/';
        }

        return "{$thanksPage}/{$order->token}";
    }
}

plugins\ecommerce\src\Http\Controllers\Frontend\OrderController.php
<?php

namespace Mojahid\Ecommerce\Http\Controllers\Frontend;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Inertia\Response;
use Juzaweb\CMS\Contracts\HookActionContract;
use Juzaweb\CMS\Http\Controllers\FrontendController;
use Mojahid\Ecommerce\Http\Resources\OrderResource;
use Mojahid\Ecommerce\Models\DownloadLink;
use Mojahid\Ecommerce\Models\Order;
use Symfony\Component\HttpFoundation\StreamedResponse;

class OrderController extends FrontendController
{
    public function __construct(
        protected HookActionContract $hookAction
    ) {
    }

    public function download(Order $order): View|Factory|Response|string
    {
        abort_unless($order->isPaymentCompleted(), 403);

        $pages = $this->hookAction->getProfilePages()
            ->where('show_menu', true)
            ->map(function ($item) {
                $item['active'] = $item['slug'] === 'ecommerce/orders';
                return $item;
            })
            ->toArray();

        $title = __('Download').": #{$order->code}";

        $page = [
            'title' => $title,
            'contents' => 'ecomm::frontend.profile.orders.download',
        ];

        $order->load([
            'downloadableProducts' => fn ($q) => $q
                ->with(['downloadLinks'])
                ->select(['posts.id', 'posts.title', 'posts.slug'])
        ]);

        return $this->view(
            'theme::profile.index',
            array_merge(
                compact('pages', 'page', 'title'),
                [
                    'order' => OrderResource::make($order)->resolve(),
                ]
            )
        );
    }

}

plugins\ecommerce\src\Http\Controllers\Backend\OrderController.php
<?php

namespace Mojahid\Ecommerce\Http\Controllers\Backend;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Juzaweb\CMS\Http\Controllers\BackendController;
use Juzaweb\CMS\Traits\ResourceController;
use Mojahid\Ecommerce\Http\Datatables\OrderDatatable;
use Mojahid\Ecommerce\Models\Order;
use Juzaweb\CMS\Models\PaymentMethod;

class OrderController extends BackendController
{
    use ResourceController {
        getDataForForm as DataForForm;
    }

    protected string $viewPrefix = 'ecomm::backend.order';

    protected function getDataTable(...$params): OrderDatatable
    {
        return new OrderDatatable();
    }

    protected function validator(array $attributes, ...$params): \Illuminate\Validation\Validator
    {
        return Validator::make(
            $attributes,
            [
                'title' => 'nullable|string|max:250',
                'type' => 'required|string|max:50',
                'status' => 'required|string|in:' . implode(',', array_keys($this->getStatuses())),
                'code' => 'required|string|max:150|unique:orders,code,' . ($params[0] ?? null),
                'name' => 'required|string|max:150',
                'email' => 'nullable|email|max:150',
                'phone' => 'nullable|string|max:50',
                'address' => 'nullable|string',
                'country_code' => 'nullable|string|max:15',
                'quantity' => 'required|integer|min:1',
                'total_price' => 'required|numeric|min:0',
                'total' => 'required|numeric|min:0',
                'discount' => 'nullable|numeric|min:0',
                'discount_codes' => 'nullable|string|max:150',
                'payment_method_id' => 'nullable|exists:payment_methods,id',
                'payment_method_name' => 'required|string|max:250',
                'payment_status' => 'required|string|in:' . implode(',', array_keys($this->getPaymentStatuses())),
                'delivery_status' => 'required|string|in:' . implode(',', array_keys($this->getDeliveryStatuses())),
                'notes' => 'nullable|string',
                'user_id' => 'nullable|exists:users,id',
                'meta' => 'nullable|array'
            ]
        );
    }

    protected function getDataForForm($model, ...$params): array
    {
        $data = $this->DataForForm($model, $params);
        
        $data['paymentMethods'] = PaymentMethod::get(['id', 'name'])
            ->mapWithKeys(
                function ($item) {
                    return [$item->id => $item->name];
                }
            )->toArray();

        $data['statuses'] = $this->getStatuses();
        $data['paymentStatuses'] = $this->getPaymentStatuses();
        $data['deliveryStatuses'] = $this->getDeliveryStatuses();
        
        return $data;
    }

    protected function beforeSave(array $data, $model, ...$params): array
    {
        if (empty($data['title'])) {
            $data['title'] = "Order #{$data['code']}";
        }

        if (empty($data['type'])) {
            $data['type'] = 'ecommerce';
        }

        return $data;
    }

    protected function afterSave($data, $model, ...$params): void
    {
        parent::afterSave($data, $model, ...$params);

        if (isset($data['meta'])) {
            $model->syncMetasWithoutDetaching($data['meta']);
        }

        do_action('order.after_save', $model, $data);
    }

    public function updateStatus(Request $request, $id): JsonResponse
    {
        $order = Order::findOrFail($id);
        $status = $request->input('status');
        $type = $request->input('type', 'status');

        DB::beginTransaction();
        try {
            switch ($type) {
                case 'payment':
                    if (!array_key_exists($status, $this->getPaymentStatuses())) {
                        throw new \Exception('Invalid payment status.');
                    }
                    $order->update(['payment_status' => $status]);
                    break;
                case 'delivery':
                    if (!array_key_exists($status, $this->getDeliveryStatuses())) {
                        throw new \Exception('Invalid delivery status.');
                    }
                    $order->update(['delivery_status' => $status]);
                    break;
                default:
                    if (!array_key_exists($status, $this->getStatuses())) {
                        throw new \Exception('Invalid status.');
                    }
                    $order->update(['status' => $status]);
            }

            do_action('order.update_status', $order, $status, $type);
            
            DB::commit();

            return $this->success([
                'message' => trans('cms::app.updated_successfully')
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error([
                'message' => $e->getMessage()
            ]);
        }
    }

    protected function getModel(...$params): string
    {
        return Order::class;
    }

    protected function getTitle(...$params): string
    {
        return trans('ecomm::content.orders');
    }

    private function getStatuses(): array
    {
        return [
            Order::STATUS_PENDING => trans('ecomm::content.pending'),
            Order::STATUS_PROCESSING => trans('ecomm::content.processing'),
            Order::STATUS_COMPLETED => trans('ecomm::content.completed'),
            Order::STATUS_CANCELLED => trans('ecomm::content.cancelled'),
        ];
    }

    private function getPaymentStatuses(): array
    {
        return [
            Order::PAYMENT_STATUS_PENDING => trans('ecomm::content.pending'),
            Order::PAYMENT_STATUS_COMPLETED => trans('ecomm::content.completed'),
            Order::PAYMENT_STATUS_FAILED => trans('ecomm::content.failed'),
        ];
    }

    private function getDeliveryStatuses(): array
    {
        return [
            Order::DELIVERY_STATUS_PENDING => trans('ecomm::content.pending'),
            Order::DELIVERY_STATUS_PROCESSING => trans('ecomm::content.processing'),
            Order::DELIVERY_STATUS_SHIPPED => trans('ecomm::content.shipped'),
            Order::DELIVERY_STATUS_DELIVERED => trans('ecomm::content.delivered'),
        ];
    }
}

plugins\ecommerce\src\Http\Datatables\OrderDatatable.php
<?php

namespace Mojahid\Ecommerce\Http\Datatables;

use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Juzaweb\CMS\Abstracts\DataTable;
use Mojahid\Ecommerce\Models\Order;

class OrderDatatable extends DataTable
{
    /**
     * Columns datatable
     *
     * @return array
     */
    public function columns(): array
    {
        return [
            'code' => [
                'label' => trans('ecomm::content.code'),
                'width' => '15%',
            ],
            'name' => [
                'label' => trans('ecomm::content.name'),
                'formatter' => [$this, 'rowActionsFormatter'],
                'width' => '20%',
            ],
            'phone' => [
                'label' => trans('ecomm::content.phone'),
            ],
            'email' => [
                'label' => trans('ecomm::content.email'),
            ],
            'total' => [
                'label' => trans('ecomm::content.total'),
            ],
            'created_at' => [
                'label' => trans('cms::app.created_at'),
                'width' => '15%',
                'align' => 'center',
                'formatter' => function ($value, $row, $index) {
                    return jw_date_format($row->created_at);
                }
            ]
        ];
    }

    /**
     * Query data datatable
     *
     * @param  array  $data
     * @return Builder
     */
    public function query(array $data): \Illuminate\Contracts\Database\Query\Builder
    {
        $query = Order::select(
            [
                'id',
                'code',
                'name',
                'email',
                'phone',
                'total',
                'created_at',
            ]
        );

        if ($keyword = Arr::get($data, 'keyword')) {
            $query->where(
                function (Builder $q) use ($keyword) {
                    $q->where('name', JW_SQL_LIKE, '%'. $keyword .'%');
                    $q->orWhere('email', JW_SQL_LIKE, '%'. $keyword .'%');
                    $q->orWhere('phone', JW_SQL_LIKE, '%'. $keyword .'%');
                }
            );
        }

        return $query;
    }

    public function bulkActions($action, $ids): void
    {
        switch ($action) {
            case 'delete':
                Order::destroy($ids);
                break;
        }
    }
}
plugins\ecommerce\src\Http\Middleware\EcommerceTheme.php
<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\View;
use Mojahid\Ecommerce\Contracts\CartManagerContract;
use Mojahid\Ecommerce\Http\Resources\CartResource;

class EcommerceTheme
{
    public function handle($request, Closure $next)
    {
        $cart = app(CartManagerContract::class)->find();

        View::share(
            [
                'cart' => (new CartResource($cart))
                    ->toArray($request),
            ]
        );

        return $next($request);
    }
}
plugins\ecommerce\src\Http\Requests\AddToCartRequest.php
<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Juzaweb\Backend\Models\Post;
use Illuminate\Support\Facades\Log;

class AddToCartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'post_id' => [
                'bail',
                'required',
                'integer'
            ],
            'type' => [
                'bail', 
                'required',
                'string',
                'in:products,events'
            ],
            'quantity' => [
                'bail',
                'required',
                'integer',
                'min:1',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'post_id.exists' => 'Product not found or not available',
            'post_id.required' => 'Product ID is required',
            'quantity.min' => 'Quantity must be at least 1',
            'type.in' => 'Invalid product type specified'
        ];
    }

    protected function prepareForValidation()
    {
        Log::info('AddToCart Request Data:', $this->all());
    }
}
plugins\ecommerce\src\Http\Requests\BulkUpdateCartRequest.php
<?php

namespace Mojahid\Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Juzaweb\Backend\Models\Post;

class BulkUpdateCartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'items' => ['required', 'array'],
            'items.*.post_id' => [
                'bail',
                'required',
                'integer',
                'min:1',
                Rule::exists(Post::class, 'id')->where('type', 'product'),
            ],
            'items.*.type' => [
                'bail',
                'required',
                'string',
                'in:product,event'
            ],
            'items.*.quantity' => [
                'bail',
                'required',
                'integer',
                'min:1',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'items.*.post_id.exists' => trans('ecomm::content.product_not_found'),
            'items.*.quantity.min' => trans('ecomm::content.quantity_must_be_at_least_1'),
        ];
    }
}
plugins\ecommerce\src\Http\Requests\CheckoutRequest.php
<?php

namespace Mojahid\Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Juzaweb\CMS\Models\PaymentMethod;

class CheckoutRequest extends FormRequest
{
    public function rules(): array
    {
        global $jw_user;

        $rules = [];

        if (empty($jw_user)) {
            $rules['email'] = [
                'bail',
                'required',
                'email:rfc,dns',
                'max:150',
            ];

            $rules['name'] = [
                'bail',
                'required',
                'max:150',
            ];
        }

        $rules['notes'] = [
            'bail',
            'nullable',
            'max:500',
        ];

        $rules['payment_method_id'] = [
            'bail',
            'required',
            'integer',
            Rule::modelExists(PaymentMethod::class),
        ];

        return $rules;
    }
}
plugins\ecommerce\src\Http\Requests\RemoveItemCartRequest.php
<?php

namespace Mojahid\Ecommerce\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Juzaweb\Backend\Models\Post;

class RemoveItemCartRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'post_id' => [
                'bail',
                'required', 
                'integer',
                Rule::exists(Post::class, 'id')->where('type', 'product'),
            ],
            'type' => [
                'bail',
                'required',
                'string',
                'in:product,event'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'post_id.exists' => trans('ecomm::content.product_not_found'),
        ];
    }
}
plugins\ecommerce\src\Http\Resources\CartItemResource.php
<?php

namespace Mojahid\Ecommerce\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'post_id' => $this->post_id,
            'type' => $this->type,
            'title' => $this->title,
            'thumbnail' => upload_url($this->thumbnail),
            'price' => ecom_price_with_unit($this->price),
            'price_without_unit' => $this->price,
            'quantity' => (int)$this->quantity,
            'line_price' => ecom_price_with_unit($this->line_price),
            'line_price_without_unit' => $this->line_price,
            'sku_code' => $this->sku_code,
            'barcode' => $this->barcode,
            'url' => $this->url,
        ];
    }
} 

plugins\ecommerce\src\Http\Resources\CartItemCollectionResource.php
<?php

namespace Mojahid\Ecommerce\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CartItemCollectionResource extends ResourceCollection
{
    public function toArray($request): array
    {
        return $this->collection->map(
            function ($item) {
                return [
                    'id' => $item->id,
                    'sku_code' => $item->sku_code,
                    'barcode' => $item->barcode,
                    'title' => $item->product->title,
                    'thumbnail' => upload_url($item->product->thumbnail),
                    'description' => $item->product->description,
                    'names' => $item->names,
                    'price' => ecom_price_with_unit($item->price),
                    'compare_price' => ecom_price_with_unit($item->compare_price),
                    'stock' => $item->stock,
                    'type' => $item->type,
                    'url' => $item->product->getLink(),
                    'line_price' => ecom_price_with_unit($item->line_price),
                    'quantity' => (int) $item->quantity,
                ];
            }
        )->toArray();
    }
}
plugins\ecommerce\src\Http\Resources\CartResource.php
<?php

namespace Mojahid\Ecommerce\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'code' => $this->resource->getCode(),
            'total_items' => $this->resource->totalItems(),
            'total_price' => ecom_price_with_unit($this->resource->totalPrice()),
            'total_price_without_unit' => $this->resource->totalPrice(),
            'discount' => $this->resource->discount ?? 0,
            'discount_codes' => $this->resource->discount_codes,
            'items' => CartItemResource::collection($this->resource->getCollectionItems()),
        ];
    }
}

<?php

namespace Mojahid\Ecommerce\Models;

use Juzaweb\CMS\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Juzaweb\CMS\Models\User;

class Cart extends Model
{
    protected $table = 'ecomm_carts';
    protected $fillable = [
        'code',
        'items',
        'user_id',
        'discount',
        'discount_codes',
        'discount_target_type',
        'site_id'
    ];


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}

<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Models; 

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;
use Juzaweb\CMS\Models\Model;
use Juzaweb\CMS\Models\User;
use Juzaweb\CMS\Traits\ResourceModel;
use Juzaweb\CMS\Models\PaymentMethod;
use Juzaweb\CMS\Traits\UseMetaData;
use Juzaweb\Backend\Models\Post;

/**
 * Juzaweb\Ecommerce\Models\Order
 *
 * @property int $id
 * @property string $title
 * @property string $type
 * @property string $status
 * @property string $code
 * @property string $token
 * @property string $name
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $address
 * @property string|null $country_code
 * @property int $quantity
 * @property string $total_price
 * @property string $total
 * @property string $discount
 * @property string|null $discount_codes
 * @property string|null $discount_target_type
 * @property int|null $payment_method_id
 * @property string $payment_method_name
 * @property string|null $notes
 * @property int $other_address
 * @property string $payment_status
 * @property string $delivery_status
 * @property int|null $user_id
 * @property int $site_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read PaymentMethod|null $paymentMethod
 * @property-read User|null $user
 * @method static Builder|Order newModelQuery()
 * @method static Builder|Order newQuery()
 * @method static Builder|Order query()
 * @method static Builder|Order whereAddress($value)
 * @method static Builder|Order whereCode($value)
 * @method static Builder|Order whereCountryCode($value)
 * @method static Builder|Order whereCreatedAt($value)
 * @method static Builder|Order whereDeliveryStatus($value)
 * @method static Builder|Order whereDiscount($value)
 * @method static Builder|Order whereDiscountCodes($value)
 * @method static Builder|Order whereDiscountTargetType($value)
 * @method static Builder|Order whereEmail($value)
 * @method static Builder|Order whereId($value)
 * @method static Builder|Order whereKey($value)
 * @method static Builder|Order whereName($value)
 * @method static Builder|Order whereNotes($value)
 * @method static Builder|Order whereOtherAddress($value)
 * @method static Builder|Order wherePaymentMethodId($value)
 * @method static Builder|Order wherePaymentMethodName($value)
 * @method static Builder|Order wherePaymentStatus($value)
 * @method static Builder|Order wherePhone($value)
 * @method static Builder|Order whereQuantity($value)
 * @method static Builder|Order whereTotal($value)
 * @method static Builder|Order whereTotalPrice($value)
 * @method static Builder|Order whereUpdatedAt($value)
 * @method static Builder|Order whereUserId($value)
 * @method static Builder|Order whereToken($value)
 * @property-read string $payment_status_text
 * @property-read string $delivery_status_text
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Juzaweb\Ecommerce\Models\OrderItem> $orderItems
 * @property-read int|null $order_items_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Juzaweb\Ecommerce\Models\Product> $products
 * @property-read int|null $products_count
 * @method static Builder|Order whereFilter(array $params = [])
 * @method static Builder|Order whereSiteId($value)
 * @mixin Eloquent
 */
class Order extends Model
{
    use ResourceModel;
    use UseMetaData;

    protected $table = 'orders';

    protected $fillable = [
        'title',
        'type',
        'status',
        'code',
        'token',
        'name',
        'phone',
        'email',
        'address',
        'country_code',
        'quantity',
        'total_price',
        'total',
        'discount',
        'discount_codes',
        'discount_target_type',
        'payment_method_id',
        'payment_method_name',
        'payment_status',
        'delivery_status',
        'notes',
        'user_id',
        'site_id'
    ];

    protected string $fieldName = 'title';

    protected $appends = [
        'payment_status_text',
        'delivery_status_text'
    ];

    public const STATUS_PENDING = 'pending';
    public const STATUS_PROCESSING = 'processing';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_CANCELLED = 'cancelled';

    public const PAYMENT_STATUS_PENDING = 'pending';
    public const PAYMENT_STATUS_COMPLETED = 'completed';
    public const PAYMENT_STATUS_FAILED = 'failed';

    public const DELIVERY_STATUS_PENDING = 'pending';
    public const DELIVERY_STATUS_PROCESSING = 'processing';
    public const DELIVERY_STATUS_SHIPPED = 'shipped';
    public const DELIVERY_STATUS_DELIVERED = 'delivered';

    protected $casts = [
        'total_price' => 'float',
        'total' => 'float',
        'discount' => 'float',
        'quantity' => 'integer'
    ];

    public static function findByCode(string $code, array $columns = ['*']): null|static
    {
        return static::whereCode($code)->first($columns);
    }

    public static function findByToken(string $token, array $columns = ['*']): null|static
    {
        return static::whereToken($token)->first($columns);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(
            Post::class,
            'order_items',
            'order_id',
            'post_id',
            'id',
            'id'
        );
    }

    public function downloadableItems()
    {
        return $this->posts()->whereMeta('downloadable', 1);
    }

    public function isPaymentCompleted(): bool
    {
        return $this->payment_status == static::PAYMENT_STATUS_COMPLETED;
    }

    public function getPaymentStatusTextAttribute(): string
    {
        return match ($this->payment_status) {
            self::PAYMENT_STATUS_COMPLETED => trans('ecomm::content.completed'),
            self::PAYMENT_STATUS_FAILED => trans('ecomm::content.failed'),
            default => trans('ecomm::content.pending'),
        };
    }

    public function getDeliveryStatusTextAttribute(): string
    {
        return match ($this->delivery_status) {
            self::DELIVERY_STATUS_PROCESSING => trans('ecomm::content.processing'),
            self::DELIVERY_STATUS_SHIPPED => trans('ecomm::content.shipped'),
            self::DELIVERY_STATUS_DELIVERED => trans('ecomm::content.delivered'),
            default => trans('ecomm::content.pending'),
        };
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->title)) {
                $model->title = "Order #{$model->code}";
            }
        });
    }

    protected function getMetaModel(): string 
    {
        return OrderMeta::class;
    }

    protected function getMetaForeignKey(): string
    {
        return 'order_id';
    }
}

<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Juzaweb\CMS\Models\Model;
use Juzaweb\CMS\Traits\UseMetaData;
use Juzaweb\Backend\Models\Post;

/**
 * Juzaweb\Ecommerce\Models\OrderItem
 *
 * @property int $id
 * @property string $title
 * @property string|null $thumbnail
 * @property string $price
 * @property string $line_price
 * @property int $quantity
 * @property string|null $compare_price
 * @property string|null $sku_code
 * @property string|null $barcode
 * @property int $order_id
 * @property int|null $product_id
 * @property int|null $variant_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Product|null $product
 * @method static Builder|OrderItem newModelQuery()
 * @method static Builder|OrderItem newQuery()
 * @method static Builder|OrderItem query()
 * @method static Builder|OrderItem whereBarcode($value)
 * @method static Builder|OrderItem whereComparePrice($value)
 * @method static Builder|OrderItem whereCreatedAt($value)
 * @method static Builder|OrderItem whereId($value)
 * @method static Builder|OrderItem whereLinePrice($value)
 * @method static Builder|OrderItem whereOrderId($value)
 * @method static Builder|OrderItem wherePrice($value)
 * @method static Builder|OrderItem whereProductId($value)
 * @method static Builder|OrderItem whereQuantity($value)
 * @method static Builder|OrderItem whereSkuCode($value)
 * @method static Builder|OrderItem whereThumbnail($value)
 * @method static Builder|OrderItem whereTitle($value)
 * @method static Builder|OrderItem whereUpdatedAt($value)
 * @method static Builder|OrderItem whereVariantId($value)
 * @mixin Eloquent
 */
class OrderItem extends Model
{
    use UseMetaData;

    protected $table = 'order_items';

    protected $fillable = [
        'title',
        'type',
        'thumbnail',
        'price',
        'line_price',
        'quantity',
        'compare_price',
        'sku_code',
        'barcode',
        'order_id',
        'post_id'
    ];

    protected $casts = [
        'price' => 'float',
        'line_price' => 'float',
        'compare_price' => 'float',
        'quantity' => 'integer'
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->type)) {
                $model->type = 'product';
            }
        });
    }
}

<?php

namespace Mojahid\Ecommerce\Providers;

use Juzaweb\CMS\Support\ServiceProvider;
use Juzaweb\CMS\Facades\ActionRegister;
use Juzaweb\CMS\Facades\MacroableModel;
use Juzaweb\CMS\Support\Payment;
use Mojahid\Ecommerce\Actions\ConfigAction;
use Mojahid\Ecommerce\Actions\EcommerceAction;
use Mojahid\Ecommerce\Actions\MenuAction;
use Mojahid\Ecommerce\Contracts\CartContract;
use Mojahid\Ecommerce\Contracts\CartManagerContract;
use Mojahid\Ecommerce\Contracts\OrderCreaterContract;
use Mojahid\Ecommerce\Contracts\OrderManagerContract;
use Mojahid\Ecommerce\Supports\Creaters\OrderCreater;
use Mojahid\Ecommerce\Supports\Manager\AddonManager;
use Mojahid\Ecommerce\Supports\Manager\CartManager;
use Mojahid\Ecommerce\Supports\Manager\OrderManager;
use Mojahid\Ecommerce\Repositories\CartRepository;
use Mojahid\Ecommerce\Repositories\CartRepositoryEloquent;
use Mojahid\Ecommerce\Repositories\ProductRepository;
use Mojahid\Ecommerce\Repositories\ProductRepositoryEloquent;
use Mojahid\Ecommerce\Repositories\VariantRepositoryEloquent;
use Juzaweb\Backend\Models\Post;
use Mojahid\Ecommerce\Actions\EcommercePostTypeAction;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Models\OrderItem;
use Mojahid\Ecommerce\Models\ProductVariant;

class EcommerceServiceProvider extends ServiceProvider
{
    public array $bindings = [
        CartRepository::class => CartRepositoryEloquent::class,
        VariantRepositoryEloquent::class => VariantRepositoryEloquent::class,
        ProductRepository::class => ProductRepositoryEloquent::class,
    ];

    public function boot()
    {
        ActionRegister::register([
            EcommerceAction::class,
            MenuAction::class,
            ConfigAction::class,
        ]);

        if (get_config('ecom_enable_products', true)) {
            ActionRegister::register([
                EcommercePostTypeAction::class,
            ]);
        }

        $addonManager = app(AddonManager::class);
        $addonManager->loadAddons();
        $addonManager->initAddons();

        MacroableModel::addMacro(
            Post::class,
            'orderItems',
            function () {
                /**
                 * @var Post $this
                 */
                return $this->hasMany(
                    OrderItem::class,
                    'product_id',
                    'id'
                );
            }
        );

        MacroableModel::addMacro(
            Post::class,
            'orders',
            function () {
                /**
                 * @var Post $this
                 */
                return $this->belongsToMany(
                    Order::class,
                    OrderItem::getTableName(),
                    'product_id',
                    'order_id'
                );
            }
        );

        MacroableModel::addMacro(
            Post::class,
            'variants',
            function () {
                /**
                 * @var Post $this
                 */
                return $this->hasMany(
                    ProductVariant::class,
                    'post_id',
                    'id'
                );
            }
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../../config/ecommerce.php',
            'ecommerce'
        );

        $this->app->singleton(
            CartManagerContract::class,
            function () {
                return new CartManager();
            }
        );

        $this->app->bind(
            CartContract::class,
            config('ecommerce.cart')
        );

        $this->app->singleton(
            OrderCreaterContract::class,
            OrderCreater::class
        );

        $this->app->singleton(
            OrderManagerContract::class,
            function ($app) {
                return new OrderManager(
                    $app[OrderCreaterContract::class],
                    app(Payment::class)
                );
            }
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}

<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Supports\Manager;

use Juzaweb\CMS\Models\User;
use Juzaweb\CMS\Support\Payment;
use Mojahid\Ecommerce\Contracts\CartContract;
use Mojahid\Ecommerce\Contracts\OrderManagerContract;
use Mojahid\Ecommerce\Models\Order;
use Mojahid\Ecommerce\Supports\Creaters\OrderCreater;
use Mojahid\Ecommerce\Supports\OrderInterface;

class OrderManager implements OrderManagerContract
{
    protected OrderCreater $orderCreater;

    protected Payment $payment;

    public function __construct(
        OrderCreater $orderCreater,
        Payment $payment
    ) {
        $this->orderCreater = $orderCreater;
        $this->payment = $payment;
    }

    public function find(Order|string|int $order): null|OrderInterface
    {
        if ($order instanceof Order) {
            return $this->createOrder($order);
        }

        $model = Order::findByCode($order);

        return $model ? $this->createOrder($model) : null;
    }

    public function createByCart(
        CartContract $cart,
        array $data,
        User $user
    ): OrderInterface {
        return $this->createByItems(
            $data,
            $cart->getItems(),
            $user
        );
    }

    public function createByItems(array $data, array $items, User $user): OrderInterface
    {
        $order = $this->orderCreater->create($data, $items, $user);

        return $this->createOrder($order);
    }

    protected function createOrder(Order $order): OrderInterface
    {
        return new Order(
            $order,
            $this->payment
        );
    }
}
plugins\ecommerce\src\routes\theme.php
<?php 

use Mojahid\Ecommerce\Http\Controllers\Frontend\CartController;
use Illuminate\Support\Facades\Route;

Route::middleware('web')->name('ecomm.')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
});

this is cart page from plugn plugins\ecommerce\src\resources\views\frontend\cart\index.twig
{% extends 'cms::layouts.frontend' %}

{% block content %}
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3>{{ trans('ecomm::content.shopping_cart') }}</h3>
                </div>
                <div class="card-body">
                    {% if cart.total_items > 0 %}
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ trans('ecomm::content.product') }}</th>
                                    <th>{{ trans('ecomm::content.price') }}</th>
                                    <th>{{ trans('ecomm::content.quantity') }}</th>
                                    <th>{{ trans('ecomm::content.total') }}</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                {% for item in cart.items %}
                                    <tr>
                                        <td>
                                            <div class="d-flex">
                                                <img src="{{ item.thumbnail }}" alt="{{ item.title }}" class="img-thumbnail mr-3" style="width: 80px">
                                                <div>
                                                    <h5>{{ item.title }}</h5>
                                                    {% if item.sku_code %}
                                                        <small>SKU: {{ item.sku_code }}</small>
                                                    {% endif %}
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ item.price }}</td>
                                        <td>
                                            <div class="input-group" style="width: 130px">
                                                <button class="btn btn-outline-secondary btn-sm quantity-decrease" type="button">-</button>
                                                <input type="number" class="form-control form-control-sm text-center quantity-input" value="{{ item.quantity }}" min="1" data-id="{{ item.id }}">
                                                <button class="btn btn-outline-secondary btn-sm quantity-increase" type="button">+</button>
                                            </div>
                                        </td>
                                        <td>{{ item.line_price }}</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm remove-item" data-id="{{ item.id }}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                {% endfor %}
                            </tbody>
                        </table>
                    {% else %}
                        <div class="text-center py-5">
                            <i class="fa fa-shopping-cart fa-3x text-muted mb-3"></i>
                            <h4>{{ trans('ecomm::content.cart_empty') }}</h4>
                            <a href="/" class="btn btn-primary mt-3">
                                {{ trans('ecomm::content.continue_shopping') }}
                            </a>
                        </div>
                    {% endif %}
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h3>{{ trans('ecomm::content.order_summary') }}</h3>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <td>{{ trans('ecomm::content.subtotal') }}</td>
                            <td class="text-right">{{ cart.total_price }}</td>
                        </tr>
                        {% if cart.discount %}
                            <tr>
                                <td>{{ trans('ecomm::content.discount') }}</td>
                                <td class="text-right">-{{ cart.discount }}</td>
                            </tr>
                        {% endif %}
                        <tr>
                            <td><strong>{{ trans('ecomm::content.total') }}</strong></td>
                            <td class="text-right"><strong>{{ cart.total_price }}</strong></td>
                        </tr>
                    </table>

                    {% if cart.total_items > 0 %}
                        <a href="{{ route('checkout') }}" class="btn btn-primary btn-block">
                            {{ trans('ecomm::content.proceed_to_checkout') }}
                        </a>
                    {% endif %}
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Update quantity
    $('.quantity-input').change(function() {
        let id = $(this).data('id');
        let quantity = $(this).val();
        
        $.ajax({
            url: '#',
            type: 'POST',
            data: {
                id: id,
                quantity: quantity,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 'success') {
                    location.reload();
                }
            }
        });
    });

    // Remove item
    $('.remove-item').click(function() {
        let id = $(this).data('id');
        
        $.ajax({
            url: '#',
            type: 'DELETE',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.status === 'success') {
                    location.reload();
                }
            }
        });
    });

    // Quantity buttons
    $('.quantity-decrease').click(function() {
        let input = $(this).next('.quantity-input');
        let value = parseInt(input.val());
        if (value > 1) {
            input.val(value - 1).change();
        }
    });

    $('.quantity-increase').click(function() {
        let input = $(this).prev('.quantity-input');
        input.val(parseInt(input.val()) + 1).change();
    });
});
</script> 

{% endblock %} 


plugins\ecommerce\src\resources\views\frontend\checkout\index.twig
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" class="anyflexbox boxshadow display-table">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ title }} - {{ trans('ecomm::content.payment_order') }}" />
    <title>{{ title }} - {{ trans('ecomm::content.payment_order') }}</title>
    <link rel="shortcut icon" href="{{ upload_url(config('icon')) }}" type="image/x-icon" />

    <link rel="stylesheet" href="{{ asset('jw-styles/plugins/juzaweb/ecommerce/assets/css/checkout.min.css') }}">

    <script> var Juzaweb = Juzaweb || {}; Juzaweb.store = ''; Juzaweb.theme = {"id":606449,"role":"main","name":"{{ shop_name }}"}; Juzaweb.template = ''; </script>

    <script type="text/javascript">if (typeof Juzaweb == 'undefined') { Juzaweb = {}; }
        Juzaweb.Checkout = {};
        Juzaweb.Checkout.token = "{{ cart.token }}";
        Juzaweb.Checkout.apiHost = "";
    </script>
</head>
<body class="body--custom-background-color ">
<div class="banner" data-header="">
    <div class="wrap">
        <div class="shop logo logo--left ">

            <h1 class="shop__name">
                <a href="/">
                    {{ title }}
                </a>
            </h1>

        </div>
    </div>
</div>
<button class="order-summary-toggle" bind-event-click="Juzaweb.StoreCheckout.toggleOrderSummary(this)">
    <div class="wrap">
        <h2>
            <label class="control-label">{{ trans('ecomm::content.order') }}</label>
            <label class="control-label hidden-small-device">
                ({{ cart.item_count }} {{ trans('ecomm::content.products') }})
            </label>
            <label class="control-label visible-small-device inline">
                ({{ cart.item_count }})
            </label>
        </h2>

        <a class="underline-none expandable pull-right" href="javascript:void(0)">
            {{ trans('ecomm::content.view_detail') }}
        </a>
    </div>
</button>

<div context="paymentStatus" define='{ paymentStatus: new Juzaweb.PaymentStatus(this,{payment_processing:"",payment_provider_id:"",payment_info:{} }) }'>

</div>
<form
        method="post"
        action="{{ route('ajax', ['checkout']) }}"
        data-toggle="validator"
        class="content stateful-form formCheckout"
>

    {{ csrf_field() }}

    <div class="wrap" context="checkout" define='{checkout: new Juzaweb.StoreCheckout(this,{ token: "{{ cart.token }}", email: "{{ user.email }}", totalOrderItemPrice: "{{ cart.total_price|default('$0') }}", shippingFee: 0, freeShipping: false, requiresShipping: {{ requires_shipping ? 'true' : 'false' }}, existCode: false, code: "", discount: 0, settingLanguage: "vi", moneyFormat: "", discountLabel: "{{ trans('ecomm::content.free') }}", districtPolicy: "optional", wardPolicy: "hidden", district: "", ward: "", province:"", otherAddress: false, shippingId: 0, shippingMethods: {}, customerAddressId: 0, reductionCode: "" })}'>
        <div class='sidebar '>
            <div class="sidebar_header">
                <h2>
                    <label class="control-label">{{ trans('ecomm::content.order') }} ({{ cart.item_count }} {{ trans('ecomm::content.products') }})</label>
                </h2>
                <hr class="full_width"/>
            </div>
            <div class="sidebar__content">
                <div class="order-summary order-summary--product-list order-summary--is-collapsed">
                    <div class="summary-body summary-section summary-product" >
                        <div class="summary-product-list">
                            <table class="product-table">
                                <tbody>
                                    {% for item in cart.items %}
                                        <tr class="product product-has-image clearfix">
                                            <td>
                                                <div class="product-thumbnail">
                                                    <div class="product-thumbnail__wrapper">
                                                        <img src="{{ item.thumbnail }}" class="product-thumbnail__image" alt="" />
                                                    </div>
                                                    <span class="product-thumbnail__quantity" aria-hidden="true">{{ item.quantity }}</span>
                                                </div>
                                            </td>
                                            <td class="product-info">
                                                <span class="product-info-name">
                                                    {{ item.title }}
                                                </span>
                                            </td>

                                            <td class="product-price text-right">
                                                {{ item.line_price }}
                                            </td>
                                        </tr>
                                    {% endfor %}
                                </tbody>
                            </table>
                            <div class="order-summary__scroll-indicator">
                                {{ trans('ecomm::content.scroll_mouse_to_view_more') }}
                                <i class="fa fa-long-arrow-down" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <hr class="m0"/>
                </div>
                <div class="order-summary order-summary--discount">
                    <div class="summary-section">
                        <div class="form-group m0" bind-show="!existCode || !applyWithPromotion || code == null || !code.length">
                            <div class="field__input-btn-wrapper">
                                <div class="field__input-wrapper">
                                    <input bind="code" name="code" type="text" class="form-control discount_code" placeholder="{{ trans('ecomm::content.enter_discount_code') }}" value="" id="checkout_reduction_code"/>
                                </div>
                                <button bind-event-click="reduction_code = false, caculateShippingFee('')" class="btn btn-primary event-voucher-apply" type="button">{{ trans('ecomm::content.apply') }}</button>
                            </div>
                        </div>

                        <div bind-class="{'warning' : existCode && !freeShipping && discount == 0,'success' : existCode && ( freeShipping || discount >0 )}" class="clearfix hide" bind-show="code!= null && code.length && existCode && applyWithPromotion">
                            <div class="pull-left">
                                <i class="fa fa-check applied-discount-status-success" aria-hidden="true"></i>
                                <i class="fa fa-exclamation-triangle applied-discount-status-warning" aria-hidden="true"></i>
                            </div>
                            <div bind="code" class="pull-left applied-discount-code">

                            </div>
                            <div bind="(discountShipping && freeShipping) ? '{{ trans('ecomm::content.free') }}' : discount" class="pull-right">
                                0
                            </div>
                            <input bind-event-click="removeCode('')" class="btn btn-delete" type="button" value="×" name="commit">
                        </div>
                        <div class="error mt10 hide" bind-show="inValidCode">
                            {{ trans('ecomm::content.discount_code_is_not_valid') }}
                        </div>
                        <div class="error mt10 hide" bind-show="!applyWithPromotion && existCode">

                        </div>
                    </div>
                    <hr class="m0"/>
                </div>
                <div class="order-summary order-summary--total-lines">
                    <div class="summary-section border-top-none--mobile">
                        <div class="total-line total-line-subtotal clearfix">
                            <span class="total-line-name pull-left">
                                {{ trans('ecomm::content.total_price') }}
                            </span>

                            <span bind="totalOrderItemPrice" class="total-line-subprice pull-right">
                                {{ cart.total_line_price }}
                            </span>
                        </div>

                        <div class="total-line total-line-shipping clearfix" bind-show="requiresShipping">
                            <span class="total-line-name pull-left">
                                {{ trans('ecomm::content.shipping_fee') }}
                            </span>
                            <span bind="shippingFee !=  0 ? shippingFee : ((requiresShipping && shippingMethods.length == 0) ? 'This area does not support transportation': '{{ trans('ecomm::content.free') }}')" class="total-line-shipping pull-right" >
                                {{ trans('ecomm::content.free') }}
                            </span>
                        </div>

                        <div class="total-line total-line-total clearfix">
                            <span class="total-line-name pull-left">
                                {{ trans('ecomm::content.total') }}
                            </span>
                            <span bind="totalPrice" class="total-line-price pull-right">
                                {{ cart.total_price }}
                            </span>
                        </div>
                    </div>
                </div>
                <div class="form-group clearfix hidden-sm hidden-xs">
                    <div class="field__input-btn-wrapper mt10">
                        <a class="previous-link" href="/cart">
                            <i class="fa fa-angle-left fa-lg" aria-hidden="true"></i>
                            <span>{{ trans('ecomm::content.back_to_cart') }}</span>
                        </a>
                        <input class="btn btn-primary btn-checkout" data-loading-text="{{ trans('ecomm::content.please_wait') }}" type="button" bind-event-click="paymentCheckout('AIzaSyAjQYbV19v7UMDVk0cDZ54yKh3OP1hQhbk;AIzaSyCLd-YkfOzBXlNGfS_FNLnpolyME1tRAJI;AIzaSyDdvilzaJlb50t2IRC3PrfSb1lNzf6n3pQ')" value="{{ trans('ecomm::content.order')|upper }}" />
                    </div>
                </div>
                <div class="form-group has-error">
                    <div class="help-block ">
                        <ul class="list-unstyled">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="main" role="main">
            <div class="main_header">
                <div class="shop logo logo--left ">
                    <h1 class="shop__name">
                        <a href="/">
                            {{ config('sitename') }}
                        </a>
                    </h1>
                </div>
            </div>

            <div class="main_content">
                <div class="row">
                    <div class="col-md-6 col-lg-6">
                        <div class="section" define="{billing_address: {}}">
                            <div class="section__header">
                                <div class="layout-flex layout-flex--wrap">
                                    <h2 class="section__title layout-flex__item layout-flex__item--stretch">
                                        <i class="fa fa-id-card-o fa-lg section__title--icon hidden-md hidden-lg" aria-hidden="true"></i>
                                        <label class="control-label">{{ trans('ecomm::content.information') }}</label>
                                    </h2>

                                {% if guest %}
                                    <a class="layout-flex__item section__title--link" href="{{ route('login') }}?redirect=/{{ url().current() }}">
                                        <i class="fa fa-user-circle-o fa-lg" aria-hidden="true"></i>
                                        {{ trans('ecomm::content.login') }}
                                    </a>
                                {% endif %}
                                </div>
                            </div>

                            <div class="section__content">
                                <div class="form-group" bind-class="{'has-error' : invalidEmail}">
                                    <div>
                                        <label class="field__input-wrapper" bind-class="{ 'js-is-filled': email }">
                                            <span class="field__label" bind-event-click="handleClick(this)">
                                                {{ trans('ecomm::content.email') }}
                                            </span>
                                            <input name="email" type="email" {% if guest %} bind-event-change="changeEmail()" bind-event-focus="handleFocus(this)" bind-event-blur="handleFieldBlur(this)" pattern="^([a-zA-Z0-9_\-\.\+]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" {% endif %} bind="email" class="field__input form-control" id="_email" data-error="{{ trans('ecomm::content.email_is_malformed') }}" required value="{{ user.email }}" {% if auth %} disabled {% endif %} />
                                        </label>
                                    </div>
                                    <div class="help-block with-errors">
                                    </div>
                                </div>

                                <div class="billing">
                                    <div>
                                        <div class="form-group">
                                            <div class="field__input-wrapper" bind-class="{ 'js-is-filled': billing_address.full_name }">
                                                    <span class="field__label" bind-event-click="handleClick(this)">
                                                        {{ trans('ecomm::content.full_name') }}
                                                    </span>
                                                <input name="name" type="text" bind-event-change="saveAbandoned()" bind-event-focus="handleFocus(this)" bind-event-blur="handleFieldBlur(this)" class="field__input form-control" id="_billing_address_last_name" data-error="{{ trans('ecomm::content.please_enter_full_name') }}" required bind="billing_address.full_name" autocomplete="off" value="{{ user.name }}" {% if auth %} disabled {% endif %} />
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>

                                        <div class="form-group">
                                            <div class="field__input-wrapper" bind-class="{ 'js-is-filled': billing_address.phone }">
                                                <span class="field__label" bind-event-click="handleClick(this)">
                                                    {{ trans('ecomm::content.phone') }}
                                                </span>
                                                <input name="phone" bind-event-change="saveAbandoned()" type="tel" bind-event-focus="handleFocus(this)" bind-event-blur="handleFieldBlur(this)" class="field__input form-control" id="_billing_address_phone" data-error="{{ trans('ecomm::content.please_enter_full_phone') }}" pattern="^([0-9,\+,\-,\(,\),\.]{8,20})$" bind="billing_address.phone" value="{{ user.phone }}" {% if auth %} disabled {% endif %} />
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>


                                        {% include 'ecomm::frontend.checkout.components.order_address' %}


                                    </div>
                                </div>
                            </div>
                        </div>

                        {% include 'ecomm::frontend.checkout.components.shipping_to_other_address' %}

                        <div class="section" bind-class="{ 'pt0': otherAddress, 'pt10': !otherAddress}">
                            <div class="section__content">
                                <div class="form-group m0">
                                    <div>
                                        <label class="field__input-wrapper" bind-class="{'js-is-filled': note}" style="border: none">
												<span class="field__label" bind-event-click="handleClick(this)" >
													{{ trans('ecomm::content.note') }}
												</span>
                                            <textarea name="notes"
                                                      bind-event-change="saveAbandoned()"
                                                      bind-event-focus="handleFocus(this)"
                                                      bind-event-blur="handleFieldBlur(this)"
                                                      bind="note"
                                                      class="field__input form-control m0"></textarea>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6">

                        {#<div class="section shipping-method hide" bind-show="shippingMethodsLoading || shippingMethods.length > 0">
                            <div class="section__header">
                                <h2 class="section__title">
                                    <i class="fa fa-truck fa-lg section__title--icon hidden-md hidden-lg" aria-hidden="true"></i>
                                    <label class="control-label">{{ trans('ecomm::content.shipping') }}</label>
                                </h2>
                            </div>
                            <div class="section__content">
                                <div class="wait-loading-shipping-methods hide" bind-show="shippingMethodsLoading" style="margin-bottom:10px">
                                    <div class="next-spinner">
                                        <svg class="icon-svg icon-svg--color-accent icon-svg--size-32 icon-svg--spinner">
                                            <use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#next-spinner"></use>
                                        </svg>
                                    </div>
                                </div>
                                <div class="content-box" bind-show="!shippingMethodsLoading && shippingMethods.length > 0">

                                </div>
                            </div>
                        </div>#}

                        <div class="section payment-methods" bind-class="{'p0--desktop': shippingMethods.length == 0}">
                            <div class="section__header">
                                <h2 class="section__title">
                                    <i class="fa fa-credit-card fa-lg section__title--icon hidden-md hidden-lg" aria-hidden="true"></i>
                                    <label class="control-label">{{ trans('ecomm::content.payment') }}</label>
                                </h2>
                            </div>
                            <div class="section__content">
                                {% include 'ecomm::frontend.checkout.components.payment_methods' %}
                            </div>
                        </div>
                        <div class="section hidden-md hidden-lg">
                            <div class="form-group clearfix m0">
                                <input class="btn btn-primary btn-checkout" data-loading-text="Đang xử lý" type="button" bind-event-click="paymentCheckout('AIzaSyAjQYbV19v7UMDVk0cDZ54yKh3OP1hQhbk;AIzaSyCLd-YkfOzBXlNGfS_FNLnpolyME1tRAJI;AIzaSyDdvilzaJlb50t2IRC3PrfSb1lNzf6n3pQ')" value="{{ trans('ecomm::content.order') }}" />
                            </div>
                            <div class="text-center mt20">
                                <a class="previous-link" href="/cart">
                                    <i class="fa fa-angle-left fa-lg" aria-hidden="true"></i>
                                    <span>{{ trans('ecomm::content.back_to_cart') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="main_footer footer unprint">
                <div class="mt10"></div>
            </div>

            <div class="modal fade" id="refund-policy" data-width="" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                            <h4 class="modal-title">{{ trans('ecomm::content.refund_policy') }}</h4>
                        </div>
                        <div class="modal-body">
                            <pre></pre>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="privacy-policy" data-width="" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                            <h4 class="modal-title">{{ trans('ecomm::content.privacy_policy') }}</h4>
                        </div>
                        <div class="modal-body">
                            <pre></pre>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="terms-of-service" data-width="" tabindex="-1" role="dialog">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                            <h4 class="modal-title">{{ trans('ecomm::content.terms_of_service') }}</h4>
                        </div>
                        <div class="modal-body">
                            <pre></pre>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<div id="icon-symbols" style="display: none;">
    <svg xmlns="http://www.w3.org/2000/svg">
        <symbol id="spinner-large"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-270 364 66 66"><path d="M-237 428c-17.1 0-31-13.9-31-31s13.9-31 31-31v-2c-18.2 0-33 14.8-33 33s14.8 33 33 33 33-14.8 33-33h-2c0 17.1-13.9 31-31 31z"/></svg></symbol><symbol id="chevron-right"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 10 10"><path d="M2 1l1-1 4 4 1 1-1 1-4 4-1-1 4-4" /></svg></symbol><symbol id="success"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 24C5.373 24 0 18.627 0 12S5.373 0 12 0s12 5.373 12 12-5.373 12-12 12zm0-2c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10zm3.784-13.198c.386-.396 1.02-.404 1.414-.018.396.386.404 1.02.018 1.414l-5.85 6c-.392.403-1.04.403-1.432 0l-3.15-3.23c-.386-.396-.378-1.03.018-1.415.395-.385 1.028-.377 1.414.018l2.434 2.5 5.134-5.267z"/></svg></symbol><symbol id="arrow"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"><path d="M16 8.1l-8.1 8.1-1.1-1.1L13 8.9H0V7.3h13L6.8 1.1 7.9 0 16 8.1z" /></svg></symbol><symbol id="spinner-button"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M20 10c0 5.523-4.477 10-10 10S0 15.523 0 10 4.477 0 10 0v2c-4.418 0-8 3.582-8 8s3.582 8 8 8 8-3.582 8-8h2z"/></svg></symbol>
        <symbol id="next-spinner"><svg preserveAspectRatio="xMinYMin"><circle class="next-spinner__ring" cx="50%" cy="50%" r="45%"></circle></svg></symbol>
    </svg>
</div>
<script>var code_langs = {'choose_province': '{{ trans('ecomm::content.choose_province') }}'};</script>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" type="text/javascript"></script>
<script src="{{ asset('jw-styles/plugins/juzaweb/ecommerce/assets/js/checkout.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
    $(document).ajaxStart(function () {
        NProgress.start();
    });
    $(document).ajaxComplete(function () {
        NProgress.done();
    });

    context = {};

    $(function () {
        Twine.reset(context).bind().refresh();
    });

    $(document).ready(function () {
        var $select2 = $('.filter-dropdown').select2({
            containerCssClass: 'field__input',
            dropdownCssClass: 'field__input',
            dropdownParent: $('.main_content'),
            language: {
                noResults: function () { return "{{ trans('ecomm::content.no_results') }}" },
                searching: function () { return "{{ trans('ecomm::content.searching') }}…" }
            }
        });

        setTimeout(function() {
            Twine.context(document.body).checkout.calculateFeeAndSave('');
        }, 50);

    });
</script>

</body>
</html>

plugins\ecommerce\src\resources\views\frontend\checkout\components\payment_methods.twig
{% for index,paymentMethod in payment_methods %}
    <div class="content-box">

        <div class="content-box__row">
            <div class="radio-wrapper">
                <div class="radio__input">
                    <input class="input-radio" type="radio" value="{{ paymentMethod.id }}" name="payment_method_id" id="payment_method_{{ paymentMethod.id }}" data-check-id="4" bind="payment_method_id" {% if index == 0 %} checked {% endif %}>
                </div>

                <label class="radio__label" for="payment_method_{{ paymentMethod.id }}">
                    <span class="radio__label__primary">{{ paymentMethod.name }}</span>
                    <span class="radio__label__accessory">
                        <ul>
                            <li class="payment-icon-v2 payment-icon--4">
                                <i class="fa fa-money payment-icon-fa" aria-hidden="true"></i>
                            </li>
                        </ul>
                    </span>
                </label>
            </div>
        </div>

        <div class="radio-wrapper content-box__row content-box__row--secondary hide" id="payment-gateway-subfields-{{ paymentMethod.id }}" bind-show="payment_method_id == {{ paymentMethod.id|default(0) }}">
            <div class="blank-slate">
                <p>{{ paymentMethod.description }}</p>
            </div>
        </div>

    </div>
{% endfor %}

<?php

namespace Mojahid\Ecommerce\Supports;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Mojahid\Ecommerce\Contracts\CartContract;
use Mojahid\Ecommerce\Models\Cart;
use Mojahid\Ecommerce\Models\ProductVariant;
use Illuminate\Support\Facades\Cookie;
use Mojahid\Ecommerce\Repositories\CartRepository;
use Juzaweb\Backend\Models\Post;
use Illuminate\Support\Facades\Log;

class DBCart implements CartContract
{
    protected CartRepository $cartRepository;

    protected Cart $cart;

    protected float $totalPrice = 0;

    public function __construct(
        CartRepository $cartRepository
    ) {
        $this->cartRepository = $cartRepository;
    }

    public function make(string|Cart $cart): static
    {
        global $jw_user;

        if ($cart instanceof Cart) {
            $this->cart = $cart;
        } else {
            $this->cart = $this->cartRepository->firstOrNew(['code' => $cart]);
        }

        if ($jw_user) {
            $this->cart->user_id = $jw_user->id;
        }

        return $this;
    }

    public function add(int $postId, string $type, int $quantity): bool
    {
        return $this->addOrUpdate($postId, $type, $quantity);
    }

    public function update(int $postId, string $type, int $quantity): bool
    {
        return $this->addOrUpdate($postId, $type, $quantity);
    }

    public function addOrUpdate(int $postId, string $type, int $quantity): bool
    {
        try {

            $post = Post::where('id', $postId)
                ->where('type', 'products')
                ->where('status', 'publish')
                ->first();

            if (!$post) {
                Log::error('Post not found:', [
                    'post_id' => $postId,
                    'type' => $type
                ]);
                throw new \Exception('Product not found');
            }

            $items = is_array($this->cart->items) ? $this->cart->items : [];
            $key = "{$type}_{$postId}";

            $price = (float) ($post->getMeta('price') ?? 0);
            $comparePrice = (float) ($post->getMeta('compare_price') ?? 0);
            $skuCode = (string) ($post->getMeta('sku_code') ?? '');
            $barcode = (string) ($post->getMeta('barcode') ?? '');

            $items[$key] = [
                'post_id' => $post->id,
                'type' => $type,
                'quantity' => (int) $quantity,
                'price' => $price,
                'title' => (string) $post->title,
                'thumbnail' => (string) $post->thumbnail,
                'sku_code' => $skuCode,
                'barcode' => $barcode,
                'compare_price' => $comparePrice,
            ];

            $this->cart->items = $items;
            $this->cart->save();

            return true;
        } catch (\Exception $e) {
            Log::error('Error in addOrUpdate:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function bulkUpdate(array $items) : bool
    {
        $newItems = [];
        foreach ($items as $item) {
            $post = Post::where('id', $item['post_id'])
                ->where('type', $item['type'])
                ->first();

            if (!$post) {
                continue;
            }

            $key = "{$item['type']}_{$item['post_id']}";
            $newItems[$key] = [
                'post_id' => $post->id,
                'type' => $post->type,
                'quantity' => $item['quantity'],
                'price' => (float) $post->getMeta('price', 0),
                'title' => $post->title,
                'thumbnail' => $post->thumbnail,
                'sku_code' => $post->getMeta('sku_code'),
                'barcode' => $post->getMeta('barcode'),
                'compare_price' => (float) $post->getMeta('compare_price'),
            ];
        }

        $this->cart->items = $newItems;
        $this->cart->save();
        return true;
    }

    public function removeItem(int $postId, string $type) : bool
    {
        $items = $this->cart->items ?? [];
        $key = "{$type}_{$postId}";
        
        if (isset($items[$key])) {
            unset($items[$key]);
            $this->cart->items = $items;
            $this->cart->save();
        }

        return true;
    }

    public function remove(): bool
    {
        Cookie::queue(Cookie::forget('jw_cart'));
        $this->cart->delete();
        return true;
    }

    public function getItems() : array
    {
        return $this->cart->items ?? [];
    }

    public function isEmpty(): bool
    {
        return empty($this->getItems());
    }

    public function isNotEmpty(): bool
    {
        return !$this->isEmpty();
    }

    public function getCollectionItems(): Collection
    {
        $items = $this->cart->items ?? [];
        
        return collect($items)->map(function($item) {
            $item['line_price'] = $item['price'] * $item['quantity'];
            return $item;
        });
    }

    public function getCode(): string
    {
        return $this->cart->code;
    }

    public function totalPrice(): float
    {
        return $this->getCollectionItems()->sum('line_price');
    }

    public function totalItems(): int
    {
        return count($this->cart->items ?? []);
    }

    public function toArray(): array
    {
        return [
            'code' => $this->getCode(),
            'items' => $this->getItems(),
        ];
    }
}

<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Supports;

use Illuminate\Support\Collection;
use Mojahid\Ecommerce\Models\Order as OrderModel;
use Juzaweb\CMS\Contracts\Payment\PaymentMethodInterface;
use Juzaweb\CMS\Support\Payment;

class Order implements OrderInterface
{
    protected OrderModel $order;

    protected Payment $payment;

    public function __construct(
        OrderModel $order,
        Payment $payment
    ) {
        $this->order = $order;

        $this->payment = $payment;
    }

    public function purchase(): PaymentMethodInterface
    {
        return $this->payment->purchase(
            $this->order->paymentMethod,
            $this->getPurchaseParams()
        );
    }

    public function completed(?array $input): bool
    {
        $params = array_merge($this->getPurchaseParams(), $input);

        $completed = $this->payment->completed(
            $this->order->paymentMethod,
            $params
        );

        if ($completed->isSuccessful()) {
            $this->order->update(
                [
                    'payment_status' => OrderModel::PAYMENT_STATUS_COMPLETED
                ]
            );

            return true;
        }

        return false;
    }

    public function getPaymentRedirectURL(): string
    {
        $response = $this->purchase();

        return $response->getRedirectURL();
    }

    public function getOrder(): OrderModel
    {
        return $this->order;
    }

    public function getItems(): Collection
    {
        return $this->order->orderItems;
    }

    public function getPurchaseParams(): array
    {
        return [
            'amount' => $this->order->total,
            'currency' => get_config('ecom_currency', 'USD'),
            'cancelUrl' => $this->getCancelURL(),
            'returnUrl' => $this->getReturnURL(),
        ];
    }

    protected function getReturnURL(): string
    {
        return route('ajax', ['payment/completed'])
            . $this->getOrderUrlQuery();
    }

    protected function getCancelURL(): string
    {
        return route('ajax', ['payment/cancel'])
            . $this->getOrderUrlQuery();
    }

    protected function getOrderUrlQuery(): string
    {
        return '?order=' . $this->order->code . '&method='. $this->order->payment_method_id;
    }
}

<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Supports;

use Illuminate\Support\Collection;
use Mojahid\Ecommerce\Models\Order;
use Juzaweb\CMS\Contracts\Payment\PaymentMethodInterface;

interface OrderInterface
{
    public function purchase(): PaymentMethodInterface;

    public function completed(?array $input): bool;

    public function getItems(): Collection;

    public function getOrder(): Order;

    public function getPaymentRedirectURL(): string;
}


<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Supports\Manager;   

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;
use Mojahid\Ecommerce\Contracts\CartContract;
use Mojahid\Ecommerce\Contracts\CartManagerContract;
use Mojahid\Ecommerce\Models\Cart;

class CartManager implements CartManagerContract
{
    public function __construct()
    {
        //
    }

    public function find(string|Cart $cart = null): CartContract
    {
        if (empty($cart)) {
            $cart = $this->getCodeCurrentCart();

            return $this->createCart($cart);
        }

        return $this->createCart($cart);
    }

    public function getCodeCurrentCart(): string
    {
        $cart = Cookie::get('jw_cart');

        if (empty($cart)) {
            return Str::uuid()->toString();
        }

        return $cart;
    }

    protected function createCart(string|Cart $cart): CartContract
    {
        return app(CartContract::class)->make($cart);
    }
}


<?php

namespace Mojahid\Ecommerce\Supports\Manager;

use Mojahid\Ecommerce\Models\Currency;

class CurrencyManager
{
    protected ?string $currentCurrencyCode = null; // e.g. from session

    public function getCurrentCurrencyCode(): string
    {
        // 1) if user selected currency in session, return it
        // 2) if auto detect is on, attempt IP geolocation or accept-languages
        // 3) else fallback to default currency
        if ($this->currentCurrencyCode) {
            return $this->currentCurrencyCode;
        }

        $this->currentCurrencyCode = Currency::where('is_default', true)->first()->code;
        return $this->currentCurrencyCode;
    }

    public function convertPrice(float $basePrice, ?string $toCurrency = null): float
    {
        if (!$toCurrency) {
            $toCurrency = $this->getCurrentCurrencyCode();
        }
        // find the currency row in DB
        $currency = Currency::where('currency_code', $toCurrency)->first();
        if (!$currency || !$currency->is_enabled) {
            // fallback
            $currency = Currency::where('is_default', true)->first();
        }

        // multiply by exchange_rate
        return $basePrice * ($currency->exchange_rate ?? 1.0);
    }

    public function formatPrice(float $amount, ?string $currencyCode = null): string
    {
        // get symbol, custom format
        $currencyCode = $currencyCode ?: $this->getCurrentCurrencyCode();
        $currency = Currency::where('currency_code', $currencyCode)->first();
        if (!$currency) {
            // fallback
        }

        $symbol = $currency->symbol ?? '$';
        // If there's a custom format, e.g. {symbol}{amount}
        return $symbol . number_format($amount, 2);
    }

    public function updateExchangeRatesAutomatically()
    {
        // check config('ecom_auto_update_exchange')
        // pick the API from config('ecom_exchange_rate_api')
        // fetch new rates, update DB for each currency
        // handle errors robustly (log them, etc.)

        if (!get_config('ecom_auto_update_exchange', false)) {
            return;
        }


        $api = get_config('ecom_exchange_rate_api');
        $apiKey = get_config('ecom_exchange_rate_api_key');

        if ($api == 'api_layer') {
            $this->updateViaApiLayer($apiKey);
        } elseif ($api == 'open_exchange') {
            $this->updateViaOpenExchange($apiKey);
        } else {
            // no API
        }
    }

    private function updateViaApiLayer($apiKey)
    {
        // call https://apilayer.com/ ...
        // parse JSON, update each currency's exchange_rate
    }

    private function updateViaOpenExchange($apiKey)
    {
        // ...
    }
}


plugins\ecommerce\src\Supports\Creaters\OrderCreater.php
<?php
/**
 * JUZAWEB CMS - The Best CMS for Laravel Project
 *
 * @package    juzaweb/cms
 * @author     The Anh Dang <dangtheanh16@gmail.com>
 * @link       https://juzaweb.com/cms
 * @license    MIT
 */

namespace Mojahid\Ecommerce\Supports\Creaters;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Juzaweb\CMS\Models\User;
use Juzaweb\CMS\Models\PaymentMethod;
use Mojahid\Ecommerce\Models\Order;

class OrderCreater
{
    public function create(array $data, array $items, User $user): Order
    {
        $items = collect($items);

        if ($items->isEmpty()) {
            throw new \Exception('Product items is empty.');
        }

        $paymentMethod = $this->getPaymentMethod($data);

        $filldata = array_except(
            $data,
            [
                'code',
                'payment_status',
                'delivery_status',
                'user_id',
                'total_price',
                'total',
                'quantity',
            ]
        );

        $order = new Order();
        $order->fill($filldata);
        $order->code = $this->generateOrderCode();
        $order->token = $this->generateOrderToken();
        $order->user_id = $user->id;
        $order->total_price = $items->sum('line_price');
        $order->total = $order->total_price;
        $order->quantity = $items->sum('quantity');
        $order->name = $user->name;
        $order->phone = $user->phone;
        $order->email = $user->email;
        $order->payment_method_name = $paymentMethod->name;
        $order->save();

        foreach ($items as $item) {
            $order->orderItems()->create(
                [
                    'title' => $item->product->title,
                    'variant_title' => $item->title,
                    'thumbnail' => $item->getThumbnail(),
                    'quantity' => (int) $item->quantity,
                    'line_price' => $item->line_price,
                    'price' => $item->price,
                    'compare_price' => $item->compare_price,
                    'sku_code' => $item->sku_code,
                    'barcode' => $item->barcode,
                    'product_id' => $item->post_id,
                    'variant_id' => $item->id,
                ]
            );
        }

        return $order;
    }


    public function generateOrderCode(): string
    {
        $i=1;
        do {
            $code = date('YmdHis').$i;
            $i++;
        } while (Order::where('code', '=', $code)->exists());

        return $code;
    }

    public function generateOrderToken(): string
    {
        do {
            $token = Str::uuid()->toString();
        } while (Order::where('token', '=', $token)->exists());

        return $token;
    }

    protected function getPaymentMethod(array $data): PaymentMethod
    {
        $paymentMethod = PaymentMethod::find(
            Arr::get($data, 'payment_method_id')
        );

        if (empty($paymentMethod)) {
            throw new \Exception('Payment method does not exist');
        }

        return $paymentMethod;
    }
}
