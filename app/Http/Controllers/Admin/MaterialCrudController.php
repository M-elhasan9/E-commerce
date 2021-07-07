<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MaterialRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class MaterialCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MaterialCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Material::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/material');
        CRUD::setEntityNameStrings('material', 'المواد');
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


        CRUD::addColumn(['name' => 'name', 'type' => 'text','label'=>'الاسم']);
        CRUD::addColumn(['name' => 'description', 'type' => 'text','label'=>'الوصف']);
        CRUD::addColumn(['name' => 'serial', 'type' => 'text','label'=>'الرقم التسلسلي']);
        CRUD::addColumn(['name' => 'image', 'type' => 'image','label'=>'الصورة']);
        CRUD::addColumn(['name' => 'cost_price', 'type' => 'number','label'=>'سعر التكلفة']);
        CRUD::addColumn(['name' => 'selling_price', 'type' => 'number','label'=>'سعر البيع']);
        CRUD::addColumn(['name' => 'group', 'type' => 'text','label'=>'المجموعة']);
        CRUD::addColumn(['name' => 'is_visible', 'type' => 'boolean','label'=>'مرئية']);
        CRUD::addColumn(['name' => 'is_available', 'type' => 'boolean','label'=>'متاحة']);
        CRUD::addColumn(['name' => 'user', 'type' => 'text','label'=>'المسخدم الذي اضاف المادة']);
        CRUD::addColumn(['name' => 'not', 'not' => 'text','label'=>'ملاحظات']);



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
        CRUD::setValidation(MaterialRequest::class);

        //CRUD::setFromDb(); // fields

        CRUD::addField(['name' => 'name', 'type' => 'text','label'=>'الاسم']);
        CRUD::addField(['name' => 'description', 'type' => 'text','label'=>'الوصف']);
        CRUD::addField(['name' => 'serial', 'type' => 'text','label'=>'الرقم التسلسلي']);
        CRUD::addField(['name' => 'image', 'type' => 'image','label'=>'الصورة']);
        CRUD::addField(['name' => 'cost_price', 'type' => 'number','label'=>'سعر التكلفة']);
        CRUD::addField(['name' => 'selling_price', 'type' => 'number','label'=>'سعر البيع']);
        CRUD::addField(['name' => 'group', 'type' => 'text','label'=>'المجموعة']);
        CRUD::addField(['name' => 'is_visible', 'type' => 'boolean','label'=>'مرئية']);
        CRUD::addField(['name' => 'is_available', 'type' => 'boolean','label'=>'متاحة']);
        CRUD::addField(['name' => 'user', 'type' => 'text','label'=>'المسخدم الذي اضاف المادة']);
        CRUD::addField(['name' => 'not', 'not' => 'text','label'=>'ملاحظات']);

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
}
