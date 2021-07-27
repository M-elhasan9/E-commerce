<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use App\Models\Group;
use App\Models\Material;

/**
 * Class CategoryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class CategoryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Category::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/category');
        CRUD::setEntityNameStrings('فئة', 'الفئات');

        if (!backpack_user()->is_admin) {
            $this->crud->denyAccess('delete');
            $this->crud->denyAccess('update');
            $this->crud->denyAccess('create');
        }
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        //CRUD::setFromDb(); // columns
        CRUD::addColumn(['name' => 'title', 'type' => 'text','label'=>'عنوان الفئة']);
        CRUD::addColumn([
            'label'     => 'المواد',
            'type'      => 'select_multiple',
            'name'      => 'materials',
            'entity'    => 'materials',
            'attribute' => 'name',
            'model'     => 'App\Models\Material',
        ]);

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']);
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(CategoryRequest::class);

        //CRUD::setFromDb(); // fields
        CRUD::addField(['name' => 'title', 'type' => 'text','label'=>'عنوان الفئة']);
        CRUD::addField([
            'label'     => "المواد",
            'type'      => 'select2_multiple',
            'name'      => 'materials',
            'entity'    => 'materials',
            'model'     => "App\Models\Material",
            'attribute' => 'name',
            'pivot'     => true,
            'options'   => (function ($query) {
                return $query->orderBy('name', 'ASC')->get();
            }),
        ],);



        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number']));
         */
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation(){

        CRUD::addColumn(['name' => 'title', 'type' => 'text','label'=>'عنوان الفئة']);
        CRUD::addColumn([
            'label'     => 'المواد',
            'type'      => 'select_multiple',
            'name'      => 'materials',
            'entity'    => 'materials',
            'attribute' => 'name',
            'model'     => 'App\Models\Material',
        ]);

    }
}
