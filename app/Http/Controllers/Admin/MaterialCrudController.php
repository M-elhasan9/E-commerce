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
        CRUD::addColumn(['description' => 'description', 'type' => 'text','label'=>'الوصف']);
        CRUD::addColumn(['serial' => 'serial', 'type' => 'text','label'=>'الرقم التسلسلي']);
        CRUD::addColumn(['image' => 'image', 'type' => 'text','label'=>'الصورة']);
        CRUD::addColumn(['cost_price' => 'cost_price', 'type' => 'number','label'=>'سعر التكلفة']);
        CRUD::addColumn(['selling_price' => 'selling_price', 'type' => 'number','label'=>'سعر البيع']);
        CRUD::addColumn(['group' => 'group', 'type' => 'text','label'=>'المجموعة']);
        CRUD::addColumn(['is_visible' => 'is_visible', 'type' => 'boolean','label'=>'مرئية']);
        CRUD::addColumn(['is_available' => 'is_available', 'type' => 'boolean','label'=>'متاح']);
        CRUD::addColumn(['user' => 'user', 'type' => 'text','label'=>'المسخدم الذي اضاف السلعة']);
        CRUD::addColumn(['user' => 'not', 'not' => 'text','label'=>'ملاحظات']);



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

        CRUD::setFromDb(); // fields

//        CRUD::addField(['name' => 'الاسم', 'type' => 'text']);
//        CRUD::addField(['description' => 'الوصف', 'type' => 'text']);
//        CRUD::addField(['serial' => 'الرقم التسلسلي', 'type' => 'text']);
//        CRUD::addField(['image' => 'الصورة', 'type' => 'text']);
//        CRUD::addField(['cost_price' => 'سعر التكلفة', 'type' => 'number']);
//        CRUD::addField(['selling_price' => 'سعر البيع', 'type' => 'number']);
//        CRUD::addField(['group' => 'المجموعة', 'type' => 'text']);
//        CRUD::addField(['is_visible' => 'مرئية', 'type' => 'boolean']);
//        CRUD::addField(['is_available' => 'متاح', 'type' => 'boolean']);
//        CRUD::addField(['user' => 'المسخدم الذي اضاف السلعة', 'type' => 'text']);
//        CRUD::addField(['not' => 'ملاحظات', 'type' => 'text']);


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
